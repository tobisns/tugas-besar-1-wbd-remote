<?php

class AuthenticationMiddleware
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isAuthenticated()
    {
        if (!isset($_SESSION["username"])) {
            throw new Exception('Session id not found', 402);
        }
        $conn = $this->database->getConn();
        $query = 'SELECT username FROM users WHERE username = $1 LIMIT 1';

        $username = $_SESSION["username"];

        $result = pg_prepare($conn, "user_query", $query);
        $result = pg_execute($conn, "user_query", array($username));
        $user = pg_fetch_assoc($result);


        if (!$user["username"]) {
            throw new Exception('User id not found', 401);
        }else{
            return true;
        }
    }

    public function isAdmin()
    {
        if (!$this->isAuthenticated()) {
            return false;
        }

        $conn = $this->database->getConn();
        $query = 'SELECT admin FROM users WHERE username = $1 LIMIT 1';

        $result = pg_prepare($conn, "check_admin_query", $query);
        $result = pg_execute($conn, "check_admin_query", array($_SESSION['username']));

        $isAdmin = pg_fetch_result($result, 0, "admin");
        if ($isAdmin !== 't') {
            throw new Exception('Unauthorized', 401);
        }
    }
}