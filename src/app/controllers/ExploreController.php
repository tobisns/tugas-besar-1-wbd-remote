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

                    $exploreView = $this->view('song', 'ExploreView');
                    $exploreView->render();
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }

        // $isAuth = new AuthenticationMiddleware();
        //             $result = $isAuth->isAuthenticated();
        // $exploreView = $this->view('song', 'exploreView');
        // $exploreView->render();
    }
}