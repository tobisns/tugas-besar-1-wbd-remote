<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';


class AdminController extends Controller implements ControllerInterface
{

    public function index($sub_div = 'albums', $page = 1)
    {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();

                    $albumModel = $this->model('AlbumModel');
                    if($sub_div == 'albums'){
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
                        $res = $albumModel->readAlbumPaged($page, $search, $sort);

                        $total_page = ceil($albumModel->albumCount($search) / 5);

                        $adminAlbumView = $this->view('admin', 'AdminView', ['current_page' => $page, 'total_page' => $total_page, 'content' => $sub_div, 'albums' => $res, 'songs' => null]);
                        $adminAlbumView->render();
                    } else if($sub_div == 'songs') {
                        $res = $albumModel->readAlbumPaged($page);
                        $adminSongView = $this->view('admin', 'AdminView', ['content' => $sub_div, 'albums' => $res, 'songs' => null]);
                        $adminSongView->render();
                    } else {
                        $notFoundView = $this->view('not-found', 'NotFoundView');
                        $notFoundView->render();
                    }

                    break;
                
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch(Exception $e){
            http_response_code($e->getCode());
            exit;
        }
        
    }

    public function test(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    json_encode($_GET);
                    http_response_code(201);
                    echo (json_encode($_GET));
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

    public function add_album(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('add') ?? TokenMiddleware::setNewToken('add'));

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();

                    $adminAlbumView = $this->view('admin', 'AddAlbumView', []);
                    $adminAlbumView->render();

                    break;
                case 'POST':
                    //prevent crsf
                    TokenMiddleware::verifyToken('add');
                    $uploadedImage = null;

                    if(isset($_FILES['cover_file'])){
                        $image = new AccessStorage("images");
                        $uploadedImage = $image->saveImage($_FILES['cover_file']['tmp_name']);
                    }

                    $userModel = $this->model('AlbumModel');
                    $result = $userModel->upload(
                        $_POST["name"],
                        $_POST["upload_date"],
                        $uploadedImage,
                    );

                    header('Content-Type: application/json');

                    if($result){
                        http_response_code(201);
                        echo json_encode(["redirect_url" => BASE_URL . "/admin/albums"]);
                        exit;
                    }else{
                        http_response_code(500);
                        echo "Update Gagal";
                        exit;
                    }

                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}