<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
class LoginController extends Controller implements ControllerInterface{
    public function index(){
        $loginView = $this->view('user', 'LoginView');
        $loginView->render();
    }
}