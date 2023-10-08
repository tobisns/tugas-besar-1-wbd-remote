<?php

class ArtistModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function readArtist($search='', $sort='name'){
        $query = "SELECT * FROM artist WHERE name LIKE '%{$search}%' ORDER BY {$sort} ASC";
        $result = $this->database->query($query);

        return $result;
    }
}