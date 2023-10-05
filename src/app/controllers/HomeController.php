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
                    // $result = $isAuth->isAuthenticated();

                    $homeView = $this->view('home', 'HomeView');
                    $homeView->render();
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
        // $homeView = $this->view('home', 'HomeView');
        // $homeView->render();
    }
}