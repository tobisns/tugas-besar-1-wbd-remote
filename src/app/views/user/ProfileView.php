<?php

class profileView implements ViewInterface
{
    private $data;
    public function __construct($data = [])
    {
        $this->data = array("display-name"=>"fajarherawan", "username"=>"fajarmhrwn", "phone-number"=>"0812235314337");
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/user/ProfilePage.php';
    }
}