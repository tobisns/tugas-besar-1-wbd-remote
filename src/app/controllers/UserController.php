<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';

class UserController extends Controller implements ControllerInterface
{
    public function index()
    {
        $profileView = $this->view('user', 'ProfileView');
        $profileView->render();
    }

    public  function login()
    {
        $loginView = $this->view('user', 'LoginView');
        $loginView->render();
    }

    public  function register()
    {
        $registerView = $this->view('user', 'RegisterView');
        $registerView->render();
    }
}