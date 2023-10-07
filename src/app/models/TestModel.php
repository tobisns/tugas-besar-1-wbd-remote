<?php

class TestModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}

