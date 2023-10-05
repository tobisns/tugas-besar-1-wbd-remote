<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';
class SongController extends controller implements ControllerInterface
{

    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();
                    $songModel = $this->model("SongModel");
                    $user = $songModel->getSong($_GET["song_id"]);
                    $_SESSION["music"]["id"] = $_GET["song_id"];
                    if($user){
                        http_response_code(201);
                        echo json_encode($user) ;
                        exit;
                    }else{
                        http_response_code(401);
                        echo $_GET["song_id"];
                        echo "Login Gagal";
                        exit;
                    }
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            $errorView = $this->view('error', 'ErrorView');
            $errorView->render();
            http_response_code($e->getCode());
        }
    }
}