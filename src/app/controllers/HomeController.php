<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';

class HomeController extends Controller implements ControllerInterface{
    public function index(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // $isAuth = new AuthenticationMiddleware();
                    //  $result = $isAuth->isAuthenticated();

                    // $this->model('HomeModel')->check();
                    
                    $homeModel = $this->model('HomeModel');
                    $newAlbums = $homeModel->fetchNewAlbums();
                    $newSongs = $homeModel->fetchNewSongs();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUser($_SESSION['username']);
                    $isAdmin = $userModel->isAdmin($_SESSION['username']);

                    $homeView = $this->view('home', 'HomeView', ['username' => $user, 'admin' => $isAdmin, 'albums' => $newAlbums, 'songs' => $newSongs]);
                    $homeView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            $errorView = $this->view('error', 'ErrorView');
            $errorView->render();
            http_response_code($e->getCode());
        }
        // $homeView = $this->view('home', 'HomeView');
        // $homeView->render();
    }
}