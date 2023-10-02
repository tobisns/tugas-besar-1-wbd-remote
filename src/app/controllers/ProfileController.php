<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';

class ProfileController implements ControllerInterface
{
    public function index()
    {
        echo "Profile";
    }
}