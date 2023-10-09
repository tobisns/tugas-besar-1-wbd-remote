<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/AccessStorage.php';
require_once __DIR__ . '/../middlewares/TokenMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthenticationMiddleware.php';
class SongController extends controller implements ControllerInterface
{

    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();
                    $songModel = $this->model("SongModel");
                    $user = $songModel->getSong($_GET["music_id"]);
                    $_SESSION["music"]["id"] = $_GET["music_id"];
                    if($user){
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : 1;
                        $filtergenre = isset($_GET['filtergenre']) ? $_GET['filtergenre'] : 1;
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 1;
    
                        $qres = $songModel->readSongsPaged($page, $keyword, $filtergenre, $sort);
                        // $total_page = ceil($songModel->songsCount($keyword) / 5);

                        $genres = $songModel->getGenres();
    
                        if ($qres && $total_page) {
                            $songs = array();
                            while ($row = pg_fetch_assoc($qres)){
                                $songs[] = $row;
                            }
                            $response = array(
                                "songs" => $songs,
                                "total_page" => $total_page
                            );
                            header('Content-Type: application/json');
                            http_response_code(201);
                            echo json_encode($user) ;
                            exit;
                        } else {
                            http_response_code(401);
                            echo "error occured";
                            exit;
                        }
                    }else{
                        http_response_code(401);
                        echo $_GET["music_id"];
                        echo "Login Gagal";
                        exit;
                    }


                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            $errorView = $this->view('error', 'ErrorView');
            $errorView->render();
            http_response_code($e->getCode());
        }
    }

    public function fetch(){
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();

                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
                    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

                    $songModel = $this->model('SongModel');
                    $qres = $songModel->readSongsPaged(1 ,$search, $filter, $sort);
                    $genres = $songModel->getGenres();
                    if($qres){
                        $songs = array();
                        while ($row = pg_fetch_assoc($qres)) {
                            $songs[] = $row;
                        }

                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode($songs);
                        exit;
                    } else {
                        http_response_code(401);
                        echo "error occured";
                        exit;
                    }
                    exit;
                    break;
                
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch(Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    }


    public function play()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $isAuth = new AuthenticationMiddleware();
                    $result = $isAuth->isAuthenticated();
                    $songModel = $this->model("SongModel");
                    $song = $songModel->getSong($_GET["song_id"]);
                    $_SESSION["music"]["id"] = $_GET["song_id"];
                    if($song){
                        http_response_code(201);
                        echo json_encode($song) ;
                        exit;
                    }else{
                        http_response_code(401);
                        echo $_GET["song_id"];
                        echo "Login Gagal";
                        exit;
                    }
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
}