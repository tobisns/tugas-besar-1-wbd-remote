<?php

class HomeModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function fetchNewAlbums(){
        // $conn = $this->database->getConn();

        $query = 'SELECT album_id, cover_file, name FROM album LIMIT 5';
        $result = $this->database->query($query);
        // $albums = $this->database->fetch();
        // return $albums;

        // $result = pg_prepare($conn, "fetchAlbums", $query);
        // $result = pg_execute($conn, "fetchAlbums", $params);

        return $result;
    }

    // public function check(){
    //     $conn = $this->database->getConn();

    //     $result = pg_prepare($conn, "check_query", "SELECT * FROM album");
    //     $result = pg_execute($conn, "check_query", array());

    //     if ($result){
    //         echo 'OK!!!';
    //     } else {
    //         echo 'FAILED!!!';
    //     }

    //     return true;
    // }
}