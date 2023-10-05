<?php

class AlbumModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function readAlbumPaged($page)
    {
        $offset = ((int) $page - 1) * 5; 
        $query = 'SELECT album_id, name, upload_date, cover_file FROM album ORDER BY album_id ASC LIMIT 5 OFFSET ' . $offset;

        $result = $this->database->query($query);

        return $result;
    }

    public function albumCount(){
        $query = 'SELECT count(album_id) as count FROM album';
        
        $q_result = $this->database->query($query);
        $albumCount = pg_fetch_array($q_result);

        return (int) $albumCount['count'];
    }
}