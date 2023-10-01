<?php
// Read database connection details from environment variables
$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

// Establish the PostgreSQL database connection
$conn = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPassword");

/*
 * if you get error make sure you install pdo pdo_pgsql pgsql extension
 * see it in this link https://onesoftwaretester.wordpress.com/2018/05/22/docker-a-dockerfile-to-fix-the-call-to-undefined-function-pg_connect-error-when-using-php-with-postgres/
*/

/*
 * postgres image maybe doesn't affect, it is use for development purposes
 * but you can use your local postgres and this will affect
 */

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Use $conn for database operations
$result = pg_query($conn, "select * from users");
var_dump(pg_fetch_all($result));
?>
