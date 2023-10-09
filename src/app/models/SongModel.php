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

        $query = "SELECT s.title, a.name,s.audio_file, a.artist_id, s.upload_date, s.genre, s.duration, s.cover_file, s.music_id  
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
                ORDER BY {$sort}";
        } else {
            $query = 
                "SELECT music_id, cover_file, title, artist.name, duration
                FROM music NATURAL JOIN artist
                WHERE (title ILIKE '%{$keyword}%' OR artist.name ILIKE '%{$keyword}%') AND genre = '%{$filtergenre}%'
                ORDER BY {$sort}";
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
                LIMIT 100";
        } else {
            $query = 
                "SELECT music_id, cover_file, title, artist.name, duration
                FROM music NATURAL JOIN artist
                WHERE (title ILIKE '%{$keyword}%' OR artist.name ILIKE '%{$keyword}%') AND genre = '%{$filtergenre}%'
                ORDER BY {$sort}
                LIMIT 100";
        }
        $result = $this->database->query($query);
        return $result;
    }

    public function getGenres(){
        $query = "SELECT DISTINCT genre FROM music;";
        $result = $this->database->query($query);
        return $result;
    }

    public function upload($title, $artist_id,
                            $genre, $duration, $upload_date,
                            $audio_file, $cover_file){
        $conn = $this->database->getConn();
        $query = "INSERT INTO music(title, artist_id, genre, duration, upload_date, audio_file, cover_file) VALUES ($1, $2, $3, $4, $5, $6, $7)";
        $result = pg_prepare($conn, "insert_user_query", $query);
        $result = pg_execute($conn, "insert_user_query", array($title, $artist_id, $genre, $duration, $upload_date, $audio_file, $cover_file));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($music_id){
        $conn = $this->database->getConn();
        $query = "SELECT audio_file, cover_file from music WHERE music_id = $1;";
        $result = pg_prepare($conn, "get_file", $query);
        $result = pg_execute($conn, "get_file", array($music_id));

        if($result){
            $files = pg_fetch_assoc($result);
            $image = new AccessStorage("music");
            $uploadedImage = $image->deleteFile($files['audio_file']);

        } else {
            return false;
        }

        $query1 = "DELETE from album_music WHERE music_id = $1;";
        $query2 = "DELETE from music WHERE music_id = $1;";
        $result1 = pg_prepare($conn, "delete_album_music_query", $query1);
        $result2 = pg_prepare($conn, "delete_music_query", $query2);
        $result1 = pg_execute($conn, "delete_album_music_query", array($music_id));
        $result2 = pg_execute($conn, "delete_music_query", array($music_id));

        if($result1 && $result2){
            return true;
        } else {
            echo "Error deleting record: " . pg_last_error($conn);
            return false;
        }
    }

    public function update($music_id, $title, $artist_id,
                            $genre, $duration, $upload_date,
                            $audio_file, $cover_file){
        $conn = $this->database->getConn();
        $query = "UPDATE music SET title = $1, artist_id = $2, genre = $3, duration = $4, upload_date = $5, audio_file = $6, cover_file = $7 
                WHERE music_id = $8";
        $result = pg_prepare($conn, "insert_user_query", $query);
        $result = pg_execute($conn, "insert_user_query", array($title, $artist_id, $genre, $duration, $upload_date, $audio_file, $cover_file, $music_id));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}