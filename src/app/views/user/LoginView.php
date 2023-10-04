<?php
require_once __DIR__ . '/../../middlewares/TokenMiddleware.php';

class LoginView implements ViewInterface
{
    private $data;
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/user/LoginPage.php';
    }
}