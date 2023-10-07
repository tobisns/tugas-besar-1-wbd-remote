<?php

class AlbumModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function readAlbumPaged($page=1, $search='', $sort='name')
    {
        $offset = ((int) $page - 1) * 5;
        $query = "SELECT album_id, name, upload_date, cover_file FROM album WHERE name LIKE '%{$search}%' ORDER BY {$sort} ASC LIMIT 5 OFFSET {$offset}";
        
        $result = $this->database->query($query);

        return $result;
    }

    public function albumCount($search){
        $query = "SELECT count(album_id) as count FROM album WHERE name LIKE '%{$search}%'";
        
        $q_result = $this->database->query($query);
        $albumCount = pg_fetch_array($q_result);

        return (int) $albumCount['count'];
    }

    public function upload($name, $upload_date, $cover_file){
        $conn = $this->database->getConn();

        $query = "INSERT INTO album(name, upload_date, cover_file) VALUES ($1, $2, $3)";
        $result = pg_prepare($conn, "insert_user_query", $query);
        $result = pg_execute($conn, "insert_user_query", array($name, $upload_date, $cover_file));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function readAlbumSongs($album_id){
        $query = "SELECT * FROM music NATURAL JOIN album_music WHERE album_id = {$album_id}";
        $songs = $this->database->query($query);

        return $songs;
    }

    public function getAlbumData($album_id){
        $query = "SELECT * FROM album WHERE album_id = {$album_id}";
        $q_result = $this->database->query($query);

        return pg_fetch_assoc($q_result);
    }
}