<?php

class HomeView implements ViewInterface{
    private $data;
    public function __construct($data = []){
        $this->data = $data;
        require_once __DIR__ . '/../../core/Database.php';
    }

    public function render(){
        require_once __DIR__ . '/../../components/home/Home.php';
    }
}