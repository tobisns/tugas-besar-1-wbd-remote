<?php
require_once __DIR__ . '/../../middlewares/TokenMiddleware.php';

class RegisterView implements ViewInterface
{

    private $data;
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/user/RegisterPage.php';
    }
}