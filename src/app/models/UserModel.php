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

        $user = pg_fetch_assoc($result);

        if(empty($user["username"])){
            return false;
        }else{
            return true;
        }
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
            return false; // User does not exist
        }
        $hash = substr( $user['password_hash'], 0, 60 );
        // Verify the password against the hashed password stored in the database
        if (password_verify($password, $hash)) {
            return $user['username']; // Login successful
        } else {
            return false; // Password does not match
        }
    }

    public function getUser($username)
    {
        $conn = $this->database->getConn();

        $query = "SELECT * FROM users WHERE username = $1";
        $result = pg_prepare($conn, "get_user", $query);
        $result = pg_execute($conn, "get_user", array($username));

        $image = pg_fetch_assoc($result);
        if (!$image) {
            return false;
        }else{
            return $image;
        }
    }

    public function isAdmin($username)
    {
        $conn = $this->database->getConn();

        $query = "SELECT * FROM users WHERE username = $1 AND admin='t'";
        $result = pg_prepare($conn, "get_isAdmin", $query);
        $result = pg_execute($conn, "get_isAdmin", array($username));

        $isAdmin = pg_fetch_assoc($result);
        if (!$isAdmin) {
            return false;
        }else{
            return true;
        }
    }

    public function updateUser(
        $username,
        $displayname,
        $profpic,
        $phone,
        $password
    )
    {
            $conn = $this->database->getConn();

            $existingUser = $this->isUsernameExists($_SESSION["username"]);
            if (!$existingUser) {
                return false;
            }

            $query = "UPDATE users SET ";
            $params = array();
            $paramCount = 1;

            if ($username !== "") {
                $query .= "username = $" . $paramCount . ", ";
                $params[] = $username;
                $paramCount++;
            }

            if ($displayname !== "") {
                $query .= "display_name = $" . $paramCount . ", ";
                $params[] = $displayname;
                $paramCount++;
            }

            if ($profpic !== null) {
                $query .= "profile_picture_file = $" . $paramCount . ", ";
                $params[] = $profpic;
                $paramCount++;
            }

            if ($phone !== "") {
                $query .= "phone = $" . $paramCount . ", ";
                $params[] = $phone;
                $paramCount++;
            }

            if ($password !== "") {
                $query .= "phone = $" . $paramCount . ", ";
                $params[] = password_hash($password, PASSWORD_DEFAULT);
                $paramCount++;
            }
            if($paramCount == 1){
                return false;
            }

            $query = rtrim($query, ', ');

            $query .= " WHERE username = $" . $paramCount;
            $params[] = $_SESSION["username"];

            $result = pg_prepare($conn, "update_user_query", $query);
            $result = pg_execute($conn, "update_user_query", $params);

            if ($result) {
                return true;
            } else {
                return false;
            }
    }
    public function deleteUser($username)
    {
        $conn = $this->database->getConn();

        // Check if the user exists before attempting to delete
        if (!$this->isUsernameExists($username)) {
            return false; // User does not exist
        }

        $query = "DELETE FROM users WHERE username = $1";
        $result = pg_prepare($conn, "delete_user_query", $query);
        $result = pg_execute($conn, "delete_user_query", array($username));

        if ($result) {
            return true; // User successfully deleted
        } else {
            return false; // Deletion failed
        }
    }


    public function getImage($username)
    {
        $conn = $this->database->getConn();

        // Check if the user exists before attempting to delete
        if (!$this->isUsernameExists($username)) {
            return false; // User does not exist
        }

        $query = "SELECT profile_picture_file FROM users WHERE username = $1";
        $result = pg_prepare($conn, "get_image_query", $query);
        $result = pg_execute($conn, "get_image_query", array($username));
        $image = pg_fetch_assoc($result);
        if (!$image["profile_picture_file"]) {
            return $image["profile_picture_file"]; // User successfully deleted
        } else {
            return false; // Deletion failed
        }
    }


}