<?php

class HomeModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function fetchNewAlbums(){
        $query = 'SELECT album_id, cover_file, name FROM album ORDER BY upload_date LIMIT 5';
        $result = $this->database->query($query);

        return $result;
    }
    
    public function fetchNewSongs(){
        $query = 'SELECT music_id, cover_file, title, artist.name FROM music NATURAL JOIN artist ORDER BY upload_date LIMIT 5';
        $result = $this->database->query($query);

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