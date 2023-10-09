<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';


class TestController extends Controller implements ControllerInterface
{

    public function index()
    {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('edit') ?? TokenMiddleware::setNewToken('edit'));

                    $testModel = $this->model('TestModel');
                    $testView = $this->view('test', 'testView', []);
                    $testView->render();

                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch(Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    }

    public function testo()
    {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('edit') ?? TokenMiddleware::setNewToken('edit'));

                    header('Content-Type: text/html');
                    http_response_code(201);
                    echo $_GET['test'];

                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch(Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    }
}