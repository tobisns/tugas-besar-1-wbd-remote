<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';

class AdminController extends Controller implements ControllerInterface
{
    public function index($sub_div = 'albums', $page = 1)
    {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $albumModel = $this->model('AlbumModel');
                    if($sub_div == 'albums'){
                        $res = $albumModel->readAlbumPaged($page);

                        $adminAlbumView = $this->view('admin', 'AdminAlbumSongView', ['content' => $sub_div, 'albums' => $res, 'songs' => null]);
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
                        
                        $adminAlbumView = $this->view('admin', 'AdminAlbumSongView', ['content' => $content, 'albums' => $res, 'songs' => null]);
                        $adminAlbumView->render_album();
                    } else {
                        $res = $albumModel->readAlbumPaged(1);
                        
                        $adminAlbumView = $this->view('admin', 'AdminAlbumSongView', ['content' => $content, 'albums' => $res, 'songs' => null]);
                        $adminAlbumView->render_song();
                    }
                    $scriptContent = ob_get_clean(); // get captured output script

                    header('Content-Type: text/html');
                    http_response_code(200);
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