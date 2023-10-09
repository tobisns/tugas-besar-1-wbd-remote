<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';


class AlbumController extends Controller implements ControllerInterface
{

    public function index($page = 1)
    {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUser($_SESSION['username']);
                    $isAdmin = $userModel->isAdmin($_SESSION['username']);

                    $from_admin = isset($_GET['admin']) ? $_GET['admin'] : false;

                    $albumModel = $this->model('AlbumModel');
                    $res = $albumModel->readAlbumPaged($page);
                    $total_page = ceil($albumModel->albumCount('') / 5);
                    if($res && $total_page){
                        $AlbumView = $this->view('album', 'AlbumView', ['from_admin' => $from_admin, 'username' => $user, 'admin' => $isAdmin, 'current_page' => $page, 'total_page' => $total_page, 'albums' => $res]);
                        ob_start();
                        $AlbumView->render();
                        $return = ob_get_clean();
                        header('Content-Type: text/html');
                        http_response_code(201);
                        echo $return;
                        exit;
                    } else {
                        http_response_code(401);
                        echo "error occured";
                        exit;
                    }
                    exit;
                    break;
                
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch(Exception $e){
            http_response_code($e->getCode());
            exit;
        }
        
    }

    public function album_details($album_id){
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('details') ?? TokenMiddleware::setNewToken('details'));


                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $albumModel = $this->model('AlbumModel');
                    $res = $albumModel->readAlbumSongs($album_id);

                    $from_admin = isset($_GET['admin']) ? $_GET['admin'] : false;

                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUser($_SESSION['username']);
                    $isAdmin = $userModel->isAdmin($_SESSION['username']);

                    $album = $albumModel->getAlbumData($album_id);
                    $AlbumDetailsView = $this->view('album', 'AlbumDetailsView', ['from_admin' => $from_admin, 'username' => $user, 'admin' => $isAdmin, 'musics' => $res, 'album' => $album]);
                    ob_start();
                    $AlbumDetailsView->render();
                    $return = ob_get_clean();
                    header('Content-Type: text/html');
                    http_response_code(201);
                    echo $return;

                    exit;
                    break;
                case 'POST':
                    //prevent crsf
                    if(!TokenMiddleware::verifyToken('details')){
                        exit;
                    }

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();

                    $result = false;
                    $AlbumModel = $this->model('AlbumModel');

                    $result = $AlbumModel->delete($album_id);
                    if($result){
                        http_response_code(201);
                        echo json_encode(["redirect_url" => BASE_URL . "/admin/albums"]);
                        exit;
                    }else{
                        http_response_code(500);
                        echo "Delete Gagal";
                        exit;
                    }
                    break;
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
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

                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';

                    $albumModel = $this->model('AlbumModel');
                    $qres = $albumModel->readAlbumPaged($page, $search, $sort);
                    $total_page = ceil($albumModel->albumCount($search) / 5);
                    if($qres && $total_page){
                        $albums = array();
                        while ($row = pg_fetch_assoc($qres)) {
                            $albums[] = $row;
                        }
                        $response = array(
                            "albums" => $albums,
                            "total_page" => $total_page
                        );
                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode($response);
                        exit;
                    } else {
                        http_response_code(401);
                        echo "error occured";
                        exit;
                    }
                    exit;
                    break;
                
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch(Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    } 

}