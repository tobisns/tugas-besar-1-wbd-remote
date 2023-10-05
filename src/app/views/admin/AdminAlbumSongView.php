<?php

class AdminAlbumSongView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/admin/AdminPageWrapper.php';
    }

    public function render_album()
    {
        require_once __DIR__ . '/../../components/admin/AddAlbumPage.php';
    }

    public function render_song()
    {
        require_once __DIR__ . '/../../components/admin/AddSongPage.php';
    }
}