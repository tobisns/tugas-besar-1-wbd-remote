<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';

class UserController extends Controller implements ControllerInterface
{
    public function index()
    {
        $profileView = $this->view('user', 'ProfileView');
        $profileView->render();
    }

    public  function login()
    {
        $loginView = $this->view('user', 'LoginView');
        $loginView->render();
    }

    public  function register()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $registerView = $this->view('user', 'RegisterView');
                    $registerView->render();
                    exit;

                    break;
                case 'POST':
                    // Kembalikan redirect_url
                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode($_POST);
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }

    }
}