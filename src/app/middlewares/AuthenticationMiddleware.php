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
            throw new Exception('Unauthorized', 401);
        }
        $conn = $this->database->getConn();
        $query = 'SELECT username FROM users WHERE username = $1 LIMIT 1';


        $result = pg_prepare($conn, "get_user_query", $query);
        $result = pg_execute($conn, "get_user_query", array($_SESSION['username']));

        $user = pg_fetch_assoc($result);
        if (!$user) {
            throw new Exception('Unauthorized', 401);
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
        if ($isAdmin === true) {
            throw new Exception('Unauthorized', 401);
        }
    }
}