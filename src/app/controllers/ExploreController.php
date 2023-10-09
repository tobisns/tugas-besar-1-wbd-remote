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
                    $token = (TokenMiddleware::getSessionToken('admin') ?? TokenMiddleware::setNewToken('admin'));

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $albumModel = $this->model('AlbumModel');
                    $songModel = $this->model('SongModel');
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    if($sub_div == 'albums'){
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name asc';
                        $res = $albumModel->readAlbumPaged($page, $search, $sort);
                        $total_page = ceil($albumModel->albumCount($search) / 5);
                        $genres = $songModel->getGenres();

                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUser($_SESSION['username']);
                        $isAdmin = $userModel->isAdmin($_SESSION['username']);

                        $albumView = $this->view('explore', 'ExploreView', ['from_admin' => false, 'username' => $user, 'admin' => $isAdmin, 'current_page' => $page, 'total_page' => $total_page, 'content' => $sub_div, 'albums' => $res, 'genres' => $genres]);
                        $albumView->render();
                    } else if($sub_div == 'songs') {
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'title asc';
                        $filter = isset($_GET['filtergenre']) ? $_GET['filtergenre'] : 'all';
                        $songModel = $this->model('SongModel');
                        $musics = $songModel->readSongPaged($search, $filter, $sort);
                        $genres = $songModel->getGenres();

                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUser($_SESSION['username']);
                        $isAdmin = $userModel->isAdmin($_SESSION['username']);

                        $exploreSongView = $this->view('explore', 'ExploreView', ['from_admin' => false, 'username' => $user, 'admin' => $isAdmin, 'content' => $sub_div, 'albums' => null, 'musics' => $musics, 'genres' => $genres]);
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
                case 'POST':
                    //prevent crsf
                    if(!TokenMiddleware::verifyToken('admin')){
                        exit;
                    }

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();
                    if($sub_div == 'songs') {

                        $result = false;
                        $songModel = $this->model('SongModel');
                        if(isset($_POST['music_id'])){
                            $result = $songModel->delete($_POST['music_id']);
                        }
                        if($result){
                            http_response_code(201);
                            echo json_encode(["redirect_url" => BASE_URL . "/admin/songs"]);
                            exit;
                        }else{
                            http_response_code(500);
                            echo "Delete Gagal";
                            exit;
                        }
                    }
                    break;
                    exit;

                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
    public function song_render(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUser($_SESSION['username']);
                    $isAdmin = $userModel->isAdmin($_SESSION['username']);

                    $songModel = $this->model('SongModel');
                    $musics = $songModel->readSongAll();
                    $genres = $songModel->getGenres();

                    $SongView = $this->view('admin', 'SongView', ['from_admin' => false, 'username' => $user, 'admin' => $isAdmin, 'albums' => null, 'musics' => $musics, 'genres' => $genres]);
                    ob_start();
                    $SongView->render();
                    $return = ob_get_clean();
                    header('Content-Type: text/html');
                    http_response_code(201);
                    echo $return;

                    exit;
                    break;
                
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
    
}