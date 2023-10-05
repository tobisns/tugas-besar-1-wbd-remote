<?php

class SongModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getSong($id)
    {
        $conn = $this->database->getConn();

        $query = "SELECT s.title, a.name,s.audio_file
              FROM music s
              INNER JOIN artist a ON s.artist_id = a.artist_id
              WHERE s.music_id = $1";

        $result = pg_prepare($conn, "get_song_query", $query);
        $result = pg_execute($conn, "get_song_query", array($id));

        $song = pg_fetch_assoc($result);
        if($song){
            return $song;
        }else{
            return false;
        }
    }
}