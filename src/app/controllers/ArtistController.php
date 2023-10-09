<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';


class ArtistController extends Controller implements ControllerInterface
{

    public function index($sub_div = 'albums', $page = 1)
    {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    break;      
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch(Exception $e){
            http_response_code($e->getCode());
            exit;
        }
        
    }

    public function fetch(){
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';

                    $artistModel = $this->model('ArtistModel');
                    $qres = $artistModel->readArtist($search, $sort);
                    if($qres){
                        $artists = array();
                        while ($row = pg_fetch_assoc($qres)) {
                            $artists[] = $row;
                        }

                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode($artists);
                        exit;
                    } else {
                        http_response_code(401);
                        echo "error occured";
                        exit;
                    }
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