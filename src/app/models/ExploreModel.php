<?php

class ExploreModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getGenres(){
        $query = "SELECT DISTINCT genre FROM music;";
        $result = $this->database->query($query);
        return $result;
    }

    public function search($keyword, $filtertype='albums', $filtergenre='all', $sort='title asc'){
        if ($filtertype==='albums'){
            // albums
            if ($sort==='title asc') {
                $sort = 'name asc';
            } else if ($sort==='title desc'){
                $sort = 'name desc';
            }
            $query = 
                "SELECT album_id, cover_file, name AS title
                FROM album
                WHERE name ILIKE '" . $keyword . "'
                ORDER BY $sort
                LIMIT 5;";
        } else {
            // songs
            if ($filtergenre==='all'){
                $query = 
                    "SELECT music_id, cover_file, title, artist.name, duration
                    FROM music NATURAL JOIN artist
                    WHERE (title ILIKE '" . $keyword . "' OR artist.name ILIKE '" . $keyword . "')
                    ORDER BY $sort
                    LIMIT 5;";
            } else {
                $query = 
                    "SELECT music_id, cover_file, title, artist.name, duration
                    FROM music NATURAL JOIN artist
                    WHERE (title ILIKE '" . $keyword . "' OR artist.name ILIKE '" . $keyword . "') AND genre = '" . $filtergenre . "'
                    ORDER BY $sort
                    LIMIT 5;";
            }
        }
        $result = $this->database->query($query);
        return $result;
    }

    // public function searchAlbums($keyword, $filtergenre='all', $sort='name asc'){
    //     $query = 
    //         "SELECT album_id, cover_file, name
    //         FROM album
    //         WHERE name ILIKE '" . $keyword . "'
    //         ORDER BY $sort
    //         LIMIT 5;";
    //     $result = $this->database->query($query);
    //     return $result;
    // }

    // public function searchSongs($keyword, $filtergenre='all', $sort='title asc'){
    //     if ($filtergenre==='all'){
    //         $query = 
    //             "SELECT music_id, cover_file, title, artist.name, duration
    //             FROM music NATURAL JOIN artist
    //             WHERE (title ILIKE '" . $keyword . "' OR artist.name ILIKE '" . $keyword . "')
    //             ORDER BY $sort
    //             LIMIT 5;";
    //     } else {
    //         $query = 
    //             "SELECT music_id, cover_file, title, artist.name, duration
    //             FROM music NATURAL JOIN artist
    //             WHERE (title ILIKE '" . $keyword . "' OR artist.name ILIKE '" . $keyword . "') AND genre = '" . $filtergenre . "'
    //             ORDER BY $sort
    //             LIMIT 5;";
    //     }
    //     $result = $this->database->query($query);
    //     return $result;
    // }

}