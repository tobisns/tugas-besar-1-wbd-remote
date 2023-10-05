<?php
// URL
define('BASE_URL', 'http://localhost:8080/public');
define('STORAGE_URL', 'http://localhost:8080/storage');
// Database
define('HOST', $_ENV['DB_HOST']);
define('DBNAME', $_ENV['DB_NAME']);
define('USER', $_ENV['DB_USER']);
define('PASSWORD', $_ENV['DB_PASSWORD']);
define('PORT', $_ENV['DB_PORT']);
//DEBOUNCE
define('DEBOUNCE_DELAY', 300);
//FILE
define('MAX_SIZE', 10 * 1024 * 1024);
define('ALLOWED_AUDIOS', [
    'audio/mpeg' => '.mp3'
]);
define('ALLOWED_IMAGES', [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png'
]);
//SESSION
define('SESSION_TIME',30*60);