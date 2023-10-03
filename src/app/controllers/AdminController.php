<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';

class AdminController extends Controller implements ControllerInterface
{
    public function index()
    {
        $notFoundView = $this->view('admin', 'AdminAlbumSongView');
        $notFoundView->render();
    }
}