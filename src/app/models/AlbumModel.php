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
}