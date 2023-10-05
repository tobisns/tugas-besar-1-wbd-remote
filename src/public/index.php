<?php

require_once '../app/init.php';

if (session_status() === PHP_SESSION_ACTIVE) {
    $current_time = time();
    if ($current_time - $_SESSION['created_at'] > SESSION_TIME) {
        session_unset();
        session_destroy();
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $current_time = time();
    $_SESSION['created_at'] = $current_time;

}
$app = new App;