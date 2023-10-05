<?php

class AccessStorage
{
    private $storageDir;
    public function __construct($foldername)
    {
        $this->storageDir = __DIR__ . '/../../storage/' . $foldername . '/';
    }

    private function isExist($filename)
    {
        return file_exists($this->storageDir . $filename);
    }

    public function saveAudio($tempfile)
    {
        $sizeAudio = filesize($tempfile);
        if ($sizeAudio > MAX_SIZE) {
            throw new Exception('Request Entity Too Large', 413);
        }

        $audioType = mime_content_type($tempfile);
        if (!in_array($audioType, array_keys(ALLOWED_AUDIOS))) {
            throw new Exception('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_AUDIOS[$audioType];
            $valid = !$this->isExist($filename);
        }

        $success = move_uploaded_file($tempfile, $this->storageDir . $filename);
        if (!$success) {
            throw new Exception('Internal Server Error', 500);
        }

        return $filename;
    }

    public function saveImage($tempfile)
    {
        $sizeImage = filesize($tempfile);
        if ($sizeImage > MAX_SIZE) {
            throw new Exception('Request Entity Too Large', 413);
        }

        $imgType = mime_content_type($tempfile);
        if (!in_array($imgType, array_keys(ALLOWED_IMAGES))) {
            throw new Exception('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_IMAGES[$imgType];
            $valid = !$this->isExist($filename);
        }

        $success = move_uploaded_file($tempfile, $this->storageDir . $filename);
        if (!$success) {
            throw new Exception('Internal Server Error', 500);
        }

        return $filename;
    }

    public function deleteFile($filename)
    {
        if (!$this->isExist($filename)) {
            return;
        }

        $success = unlink($this->storageDir . $filename);
        if (!$success) {
            throw new Exception('Internal Server Error', 500);
        }
    }

}