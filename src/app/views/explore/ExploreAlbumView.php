<?php

class ExploreAlbumView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/explore/ExploreAlbum.php';
    }
}