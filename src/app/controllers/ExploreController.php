<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';

class ExploreController extends Controller implements ControllerInterface{
    public function index($sub_div = 'albums', $page = 1){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $albumModel = $this->model('AlbumModel');
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    if($sub_div == 'albums'){
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name asc';
                        $res = $albumModel->readAlbumPaged($page, $search, $sort);
                        $total_page = ceil($albumModel->albumCount($search) / 5);

                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUser($_SESSION['username']);
                        $isAdmin = $userModel->isAdmin($_SESSION['username']);

                        $exploreAlbumView = $this->view('explore', 'ExploreView', ['username' => $user, 'admin' => $isAdmin, 'current_page' => $page, 'total_page' => $total_page, 'content' => $sub_div, 'albums' => $res]);
                        $exploreAlbumView->render();
                    } else if($sub_div == 'songs') {
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'title asc';
                        $filter = isset($_GET['filtergenre']) ? $_GET['filtergenre'] : 'all';
                        $songModel = $this->model('SongModel');
                        $musics = $songModel->readSongAll();

                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUser($_SESSION['username']);
                        $isAdmin = $userModel->isAdmin($_SESSION['username']);

                        $exploreSongView = $this->view('explore', 'ExploreView', ['username' => $user, 'admin' => $isAdmin, 'content' => $sub_div, 'albums' => null, 'musics' => $musics]);
                        $exploreSongView->render();
                    } else {
                        $notFoundView = $this->view('not-found', 'NotFoundView');
                        $notFoundView->render();
                    }

                    break;

                    // $keyword = '';
                    // if (isset($_GET['keyword'])) {
                    //     $keyword = $_GET['keyword'];
                    // }

                    // $exploreModel = $this->model('ExploreModel');
                    // $resultGenres = $exploreModel->getGenres();
                    // $result = $exploreModel->search($keyword);

                    // $userModel = $this->model('UserModel');
                    // $user = $userModel->getUser($_SESSION['username']);
                    // $isAdmin = $userModel->isAdmin($_SESSION['username']);

                    // $exploreView = $this->view('song', 'ExploreView', ['username' => $user, 'admin' => $isAdmin, 'genres' => $resultGenres, 'result' => $result]);
                    // $exploreView->render();
                    // exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    
}