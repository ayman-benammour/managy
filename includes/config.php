<?php

// Errors
error_reporting(E_ALL);
ini_set('display_errors', false);

// // Function curl and create cache
// function apiCall($url)
// {
//     $fileName = md5($url);
//     $filePath = './cache/' . $fileName;
//     $fileExists = file_exists($filePath);

//     if($fileExists)
//     {
//         $fileTime = filemtime($filePath);
//         $time = time();

//         if($fileTime < $time - 60 * 60 * 24 * 7)
//         {
//             unlink($filePath);
//             $fileExists = false;
//         }
//     }

//     if($fileExists)
//     {
//         $result = file_get_contents($filePath);
//     }
//     else
//     {
//         $curl = curl_init();
//         curl_setopt($curl, CURLOPT_URL, $url);
//         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    
//         $result = curl_exec($curl);
//         curl_close($curl);

//         file_put_contents($filePath, $result);
//     }

//     $result = json_decode($result);
//     return $result;
// }

// Database with MySQL
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'benammour_ayman_partiel');
define('DB_USER', 'root');
define('DB_PASS', '');

$pdo = new PDO(
    'mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT,
    DB_USER,
    DB_PASS
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);