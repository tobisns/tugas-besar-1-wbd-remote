<?php

class AccessStorage
{
    private $storageDir;
    public function __construct($namefolder)
    {
        $this->storageDir = __DIR__ . '/../../storage/' . $namefolder . '/';
    }

    private function doesFileExist($filename)
    {
        return file_exists($this->storageDir . $filename);
    }

    public function saveAudio($tempname)
    {
        $sizeAudio = filesize($tempname);
        if ($sizeAudio > MAX_SIZE) {
            throw new Exception('Request Entity Too Large', 413);
        }

        $audioType = mime_content_type($tempname);
        if (!in_array($audioType, array_keys(ALLOWED_AUDIOS))) {
            throw new Exception('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_AUDIOS[$audioType];
            $valid = !$this->doesFileExist($filename);
        }

        $success = move_uploaded_file($tempname, $this->storageDir . $filename);
        if (!$success) {
            throw new Exception('Internal Server Error', 500);
        }

        return $filename;
    }

    public function saveImage($tempname)
    {
        $sizeImage = filesize($tempname);
        if ($sizeImage > MAX_SIZE) {
            throw new Exception('Request Entity Too Large', 413);
        }

        $imgType = mime_content_type($tempname);
        if (!in_array($imgType, array_keys(ALLOWED_IMAGES))) {
            throw new Exception('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_IMAGES[$imgType];
            $valid = !$this->doesFileExist($filename);
        }

        $success = move_uploaded_file($tempname, $this->storageDir . $filename);
        if (!$success) {
            throw new Exception('Internal Server Error', 500);
        }

        return $filename;
    }

    public function deleteFile($filename)
    {
        if (!$this->doesFileExist($filename)) {
            return;
        }

        $success = unlink($this->storageDir . $filename);
        if (!$success) {
            throw new Exception('Internal Server Error', 500);
        }
    }

}