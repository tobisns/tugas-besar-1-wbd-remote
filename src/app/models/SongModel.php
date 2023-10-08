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

    public function readSongsPaged($page=1, $keyword='', $filtergenre='all', $sort='title asc')
    {
        $offset = ((int) $page - 1) * 5;
        if ($filtergenre==='all'){
            $query = 
                "SELECT music_id, cover_file, title, artist.name, duration
                FROM music NATURAL JOIN artist
                WHERE (title ILIKE '%{$keyword}%' OR artist.name ILIKE '%{$keyword}%')
                ORDER BY {$sort}
                LIMIT 5
                OFFSET {$offset};";
        } else {
            $query = 
                "SELECT music_id, cover_file, title, artist.name, duration
                FROM music NATURAL JOIN artist
                WHERE (title ILIKE '%{$keyword}%' OR artist.name ILIKE '%{$keyword}%') AND genre = '%{$filtergenre}%'
                ORDER BY {$sort}
                LIMIT 5
                OFFSET {$offset};";
        }
        $result = $this->database->query($query);
        return $result;
    }

    public function songsCount($keyword){
        $query = "SELECT count(music_id) as count FROM music WHERE title ILIKE '%{$keyword}%'";
        
        $q_result = $this->database->query($query);
        $songsCount = pg_fetch_array($q_result);

        return (int) $songsCount['count'];
    }

    public function readSongAll($keyword='', $filtergenre='all', $sort='title asc'){
        if ($filtergenre==='all'){
            $query = 
                "SELECT music_id, cover_file, title, artist.name, duration
                FROM music NATURAL JOIN artist
                WHERE (title ILIKE '%{$keyword}%' OR artist.name ILIKE '%{$keyword}%')
                ORDER BY {$sort}
                LIMIT 5";
        } else {
            $query = 
                "SELECT music_id, cover_file, title, artist.name, duration
                FROM music NATURAL JOIN artist
                WHERE (title ILIKE '%{$keyword}%' OR artist.name ILIKE '%{$keyword}%') AND genre = '%{$filtergenre}%'
                ORDER BY {$sort}
                LIMIT 5";
        }
        $result = $this->database->query($query);
        return $result;
    }
}