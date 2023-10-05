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
                        $res = $albumModel->readAlbumPaged($page);

                        $total_page = ceil($albumModel->albumCount() / 5);

                        $adminAlbumView = $this->view('admin', 'AdminAlbumSongView', ['current_page' => $page, 'total_page' => $total_page, 'content' => $sub_div, 'albums' => $res, 'songs' => null]);
                        $adminAlbumView->render();
                    } else if($sub_div == 'songs') {
                        $res = $albumModel->readAlbumPaged($page);
                        $adminSongView = $this->view('admin', 'AdminAlbumSongView', ['content' => $sub_div, 'albums' => $res, 'songs' => null]);
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

    public function get_sub_div($content){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $albumModel = $this->model('AlbumModel');
                    ob_start(); // capture script output
                    if ($content == 'albums') {
                        $res = $albumModel->readAlbumPaged(1);
                        $total_page = ceil($albumModel->albumCount() / 5);
                        
                        $adminAlbumView = $this->view('admin', 'AdminAlbumSongView', ['total_page' => $total_page, 'albums' => $res, 'songs' => null]);
                        $adminAlbumView->render_album();
                    } else {
                        $res = $albumModel->readAlbumPaged(2);
                        
                        $adminAlbumView = $this->view('admin', 'AdminAlbumSongView', ['total_page' => $content, 'albums' => $res, 'songs' => null]);
                        $adminAlbumView->render_song();
                    }
                    $scriptContent = ob_get_clean(); // get captured output script

                    header('Content-Type: text/html');
                    http_response_code(201);
                    echo $scriptContent;
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
}