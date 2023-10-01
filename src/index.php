<?php
// Read database connection details from environment variables
$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

// Establish the PostgreSQL database connection
$conn = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPassword");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Use $conn for database operations
$result = pg_query($conn, "select * from users");
var_dump(pg_fetch_all($result));
?>
