<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';

class AdminController extends Controller implements ControllerInterface
{
    public function index($sub_page = 'albums')
    {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':


                    $notFoundView = $this->view('admin', 'AdminAlbumSongView', ['content' => $sub_page]);
                    $notFoundView->render();

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