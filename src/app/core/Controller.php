<?php
class Controller
{
    public function view($folder, $view, $data = [])
    {
        require_once __DIR__ . '/../views/' . $folder . '/' . $view . '.php';
        return new $view($data);
    }
}