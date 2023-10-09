<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';

class UserController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('edit') ?? TokenMiddleware::setNewToken('edit'));

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUser($_SESSION['username']);

                    $profileView = $this->view('user', 'ProfileView',$user);
                    $profileView->render();
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            $errorView = $this->view('error', 'ErrorView');
            $errorView->render();
            http_response_code($e->getCode());
        }

    }

    public  function login()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('login') ?? TokenMiddleware::setNewToken('login'));
                    $loginView = $this->view('user', 'LoginView');
                    $loginView->render();
                    exit;
                case 'POST':
                    //prevent crsf
                    TokenMiddleware::verifyToken('login');

                    $userModel = $this->model('UserModel');
                    $result = $userModel->login(
                        $_POST["username"],
                        $_POST["password"]
                    );

                    if($result){
                        http_response_code(201);
                        $_SESSION["username"] = $result;
                        echo $_SESSION["username"];
                        exit;
                    }else{
                        http_response_code(401);
                        echo "Login Gagal";
                        exit;
                    }
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }

    }

    public  function register()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('register') ?? TokenMiddleware::setNewToken('register'));

                    $registerView = $this->view('user', 'RegisterView');
                    $registerView->render();
                    exit;
                case 'POST':
                    //prevent crsf
                    TokenMiddleware::verifyToken('register');
                    $uploadedImage = null;

                    if(isset($_FILES['file'])){
                        $image = new AccessStorage("images");
                        $uploadedImage = $image->saveImage($_FILES['file']['tmp_name']);
                    }


                    $userModel = $this->model('UserModel');
                    $result = $userModel->register(
                        $_POST["username"],
                        $_POST["displayname"],
                        $uploadedImage,
                        $_POST["phonenumber"],
                        $_POST["password"]
                    );

                    header('Content-Type: application/json');

                    if($result){
                        http_response_code(201);
                        echo json_encode(["redirect_url" => BASE_URL . "/user/login"]);
                        exit;
                    }else{
                        http_response_code(401);
                        echo "Registrasi Gagal";
                        exit;
                    }

                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public  function username()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $userModel = $this->model('UserModel');
                    header('Content-Type: application/json');
                    http_response_code(201);
                    if($userModel->isUsernameExists($_GET["username"])){
                        echo "true";
                    }else{
                        echo "false";
                    }

                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public  function logout()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    //check auth
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    unset($_SESSION['username']);
                    unset($_SESSION['music']);
                    header('Location: ' . BASE_URL . '/user/login');
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public  function edit()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'PUT':
                    //check auth
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $_PUT = array();
                    $input = file_get_contents('php://input');
                    $_PUT = (array) json_decode($input);

                    // crsf verify
                    TokenMiddleware::verifyToken('edit',false,$_PUT["csrftoken"]);


                    $userModel = $this->model('UserModel');
                    $result = $userModel->updateUser(
                        $_PUT["username"],
                        $_PUT["displayname"],
                        $_PUT["file"],
                        $_PUT["phonenumber"],
                        $_PUT["password"]
                    );

                    header('Content-Type: application/json');

                    if($result){
                        http_response_code(201);
                        exit;
                    }else{
                        http_response_code(500);
                        echo "Update Gagal";
                        exit;
                    }

                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }

    }

    public  function delete()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'DELETE':
                    //check auth
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();
                    $userModel = $this->model('UserModel');
                    $responses = $userModel->deleteUser($_SESSION["username"]);
                    unset($_SESSION['username']);
                    unset($_SESSION['music']);
                    http_response_code(201);
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function updateImage(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    //check auth
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();
                    $userModel = $this->model('UserModel');
                    $responses = $userModel->getImage($_SESSION["username"]);
                    $oldImage = new AccessStorage("images");
                    if($responses){
                        $oldImage->deleteFile($responses);
                    }
                    $uploadedImage ='';
                    if(isset($_FILES['file'])){
                        $newImage = new AccessStorage("images");
                        $uploadedImage = $newImage->saveImage($_FILES['file']['tmp_name']);
                    }

                    if($uploadedImage !== '' && isset($_FILES['file'])){
                        http_response_code(201);
                        echo $uploadedImage;
                    }else if(!isset($_FILES['file'])){
                        http_response_code(201);
                    }
                    else{
                        http_response_code(500);
                    }
                    exit;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}