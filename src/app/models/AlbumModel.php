<?php

class AlbumModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function readAlbumPaged($page=1, $search='', $sort='name asc')
    {
        $offset = ((int) $page - 1) * 5;
        $query = "SELECT album_id, name, upload_date, cover_file FROM album WHERE name ILIKE '%{$search}%' ORDER BY {$sort} LIMIT 5 OFFSET {$offset}";
        
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
        $query = "SELECT * FROM (music NATURAL JOIN album_music)a NATURAL JOIN artist WHERE album_id = {$album_id}";
        $songs = $this->database->query($query);

        return $songs;
    }

    public function getAlbumData($album_id){
        $query = "SELECT * FROM album WHERE album_id = {$album_id}";
        $q_result = $this->database->query($query);

        return pg_fetch_assoc($q_result);
    }

    public function delete($album_id){
        $conn = $this->database->getConn();
        $query = "SELECT cover_file from album WHERE album_id = $1;";
        $result = pg_prepare($conn, "get_file", $query);
        $result = pg_execute($conn, "get_file", array($album_id));

        if($result){
            $files = pg_fetch_assoc($result);
            $image = new AccessStorage("images");
            if($files['cover_file']){
                $uploadedImage = $image->deleteFile($files['cover_file']);
            }

        } else {
            return false;
        }

        $query1 = "DELETE from album_music WHERE album_id = $1;";
        $query2 = "DELETE from album WHERE album_id = $1;";
        $result1 = pg_prepare($conn, "delete_album_music_query", $query1);
        $result2 = pg_prepare($conn, "delete_album_query", $query2);
        $result1 = pg_execute($conn, "delete_album_music_query", array($album_id));
        $result2 = pg_execute($conn, "delete_album_query", array($album_id));

        if($result1 && $result2){
            return true;
        } else {
            echo "Error deleting record: " . pg_last_error($conn);
            return false;
        }
    }

    public function addSong($music_id, $album_id){
        $conn = $this->database->getConn();
        $query = "INSERT INTO album_music VALUES ($1,$2);";
        $result = pg_prepare($conn, "get_file", $query);
        $result = pg_execute($conn, "get_file", array($album_id, $music_id));

        return $result;
    }
}