<?php
class Database
{
    private $host = HOST;
    private $db_name = DBNAME;
    private $user = USER;
    private $password = PASSWORD;
    private $port = PORT;

    private $db_connection;
    public function __construct(){
        $conn_str = "host=$this->host port=$this->port dbname=$this->db_name user=$this->user password=$this->password";
        var_dump($conn_str);
        $this->db_connection = pg_connect($conn_str);
        if (!$this->db_connection) {
            die("Connection failed: " . pg_last_error());
        }
    }

    public function query($query){
        $result = pg_query($this->db_connection, $query);
        if (!$result) {
            echo "An error occurred.\n";
            exit;
        }
        return $result;
    }

}