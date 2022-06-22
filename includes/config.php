<?php

// Errors
error_reporting(E_ALL);
ini_set('display_errors', true);

// Categories
$categories = [
    'hobbies' => 'Hobbies',
    'work' => 'Work',
    'food' => 'Food',
    'others' => 'Others',
];

// Database with MySQL
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'managy');
define('DB_USER', 'root');
define('DB_PASS', '');

$pdo = new PDO(
    'mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT,
    DB_USER,
    DB_PASS
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);