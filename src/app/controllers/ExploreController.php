<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';

class ExploreController extends Controller implements ControllerInterface{
    public function index(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // $isAuth = new AuthenticationMiddleware();
                    // $result = $isAuth->isAuthenticated();

                    $keyword = '';
                    if (isset($_GET['keyword'])) {
                        $keyword = $_GET['keyword'];
                    }

                    $exploreModel = $this->model('ExploreModel');
                    $resultGenres = $exploreModel->getGenres();
                    // $resultAlbums = $exploreModel->searchAlbums($keyword);
                    // $resultSongs = $exploreModel->searchSongs($keyword);
                    $result = $exploreModel->search($keyword);

                    $exploreView = $this->view('song', 'ExploreView', ['genres' => $resultGenres, 'result' => $result]);
                    // $exploreView = $this->view('song', 'ExploreView', ['genres' => $resultGenres, 'albums' => $resultAlbums, 'songs' => $resultSongs]);
                    $exploreView->render();
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    
}