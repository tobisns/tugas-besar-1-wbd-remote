<?php

class UserModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}