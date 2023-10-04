<?php

class UserModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isUsernameExists($params)
    {
        $conn = $this->database->getConn();

        $result = pg_prepare($conn, "my_query", 'SELECT * FROM users WHERE username = $1');

        $result = pg_execute($conn, "my_query", array($params));

        return  pg_fetch_all($result)[0]["username"] == $params;
    }

    public function register(
        $username,
        $displayname,
        $profpic,
        $phone,
        $password
    )
    {
        $conn = $this->database->getConn();

        if ($this->isUsernameExists($username)) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, display_name, profile_picture_file, phone, password_hash, admin) VALUES ($1, $2, $3, $4, $5, false)";
        $result = pg_prepare($conn, "insert_user_query", $query);
        $result = pg_execute($conn, "insert_user_query", array($username, $displayname, $profpic, $phone, $hashedPassword));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        $conn = $this->database->getConn();

        // Prepare and execute the query to retrieve user data by username
        $query = "SELECT * FROM users WHERE username = $1";
        $result = pg_prepare($conn, "get_user_query", $query);
        $result = pg_execute($conn, "get_user_query", array($username));

        $user = pg_fetch_assoc($result);

        // Check if a user with the given username exists
        if (!$user) {
            return "usernotexist"; // User does not exist
        }
        $hash = substr( $user['password_hash'], 0, 60 );
        // Verify the password against the hashed password stored in the database
        if (password_verify($password, $hash)) {
            return $user['username']; // Login successful
        } else {
            return false; // Password does not match
        }
    }
}