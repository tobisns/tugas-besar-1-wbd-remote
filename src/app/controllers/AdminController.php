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
                    $token = (TokenMiddleware::getSessionToken('admin') ?? TokenMiddleware::setNewToken('admin'));

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();


                    if($sub_div == 'albums'){
                        $albumModel = $this->model('AlbumModel');
                        $songModel = $this->model('SongModel');
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
                        $res = $albumModel->readAlbumPaged($page, $search, $sort);

                        $total_page = ceil($albumModel->albumCount($search) / 5);
                        $genres = $songModel->getGenres();

                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUser($_SESSION['username']);
                        $isAdmin = $userModel->isAdmin($_SESSION['username']);

                        

                        $adminAlbumView = $this->view('admin', 'AdminView', ['from_admin' => true, 'username' => $user, 'admin' => $isAdmin, 'current_page' => $page, 'total_page' => $total_page, 'content' => $sub_div, 'albums' => $res, 'genres' => $genres]);
                        $adminAlbumView->render();
                    } else if($sub_div == 'songs') {
                        
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUser($_SESSION['username']);
                        $isAdmin = $userModel->isAdmin($_SESSION['username']);

                        $songModel = $this->model('SongModel');
                        $musics = $songModel->readSongAll();
                        $genres = $songModel->getGenres();

                        $SongView = $this->view('admin', 'AdminView', ['from_admin' => true, 'username' => $user, 'admin' => $isAdmin, 'content' => $sub_div, 'albums' => null, 'musics' => $musics, 'genres' => $genres]);
                        $SongView->render();
                    } else {
                        $notFoundView = $this->view('not-found', 'NotFoundView');
                        $notFoundView->render();
                    }

                    break;
                    exit;
                case 'POST':
                    //prevent crsf
                    if(!TokenMiddleware::verifyToken('admin')){
                        exit;
                    }

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();
                    if($sub_div == 'songs') {

                        $result = false;
                        $songModel = $this->model('SongModel');
                        if(isset($_POST['music_id'])){
                            $result = $songModel->delete($_POST['music_id']);
                        }
                        if($result){
                            http_response_code(201);
                            echo json_encode(["redirect_url" => BASE_URL . "/admin/songs"]);
                            exit;
                        }else{
                            http_response_code(500);
                            echo "Delete Gagal";
                            exit;
                        }
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

    public function song_render(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUser($_SESSION['username']);
                    $isAdmin = $userModel->isAdmin($_SESSION['username']);

                    $songModel = $this->model('SongModel');
                    $musics = $songModel->readSongAll();
                    $genres = $songModel->getGenres();

                    $SongView = $this->view('admin', 'SongView', ['from_admin' => true, 'username' => $user, 'admin' => $isAdmin, 'albums' => null, 'musics' => $musics, 'genres' => $genres]);
                    ob_start();
                    $SongView->render();
                    $return = ob_get_clean();
                    header('Content-Type: text/html');
                    http_response_code(201);
                    echo $return;

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
                    if(!TokenMiddleware::verifyToken('add')){
                        exit;
                    }
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

    public function add_song(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('add') ?? TokenMiddleware::setNewToken('add'));

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();

                    $adminSongView = $this->view('admin', 'AddSongView', []);
                    $adminSongView->render();

                    break;
                case 'POST':
                    //prevent crsf
                    if(!TokenMiddleware::verifyToken('add')){
                        exit;
                    }
                    $uploadedImage = null;
                    $uploadedAudio = null;
                    
                    // echo json_encode($_FILES['audio_file']['tmp_name']);

                    if(isset($_FILES['cover_file'])){
                        $image = new AccessStorage("images");
                        $uploadedImage = $image->saveImage($_FILES['cover_file']['tmp_name']);
                    }
                    if(isset($_FILES['audio_file'])){
                        $image = new AccessStorage("music");
                        $uploadedAudio = $image->saveAudio($_FILES['audio_file']['tmp_name']);
                    }



                    $userModel = $this->model('SongModel');
                    $result = $userModel->upload(
                        $_POST["title"],
                        $_POST["artist_id"],
                        $_POST["genre"],
                        $_POST["duration"],
                        $_POST["upload_date"],
                        $uploadedAudio,
                        $uploadedImage
                    );

                    header('Content-Type: application/json');

                    if($result){
                        http_response_code(201);
                        echo json_encode(["redirect_url" => BASE_URL . "/admin/songs"]);
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

    public function add_to_album($album_id){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $token = (TokenMiddleware::getSessionToken('add') ?? TokenMiddleware::setNewToken('add'));

                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAdmin();

                    $adminSongView = $this->view('admin', 'AddSongToAlbumView', ["album_id" => $album_id]);
                    $adminSongView->render();

                    break;
                case 'POST':
                    //prevent crsf
                    if(!TokenMiddleware::verifyToken('add')){
                        exit;
                    }

                    $userModel = $this->model('AlbumModel');
                    $result = $userModel->addSong(
                        $_POST["music_id"],
                        $album_id
                    );

                    header('Content-Type: application/json');

                    if($result){
                        http_response_code(201);
                        echo json_encode(["redirect_url" => BASE_URL . "/admin/songs"]);
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