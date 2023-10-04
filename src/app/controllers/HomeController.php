<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
class HomeController extends Controller implements ControllerInterface{
    public function index(){
        $loginView = $this->view('home', 'HomeView');
        $loginView->render();
    }
}