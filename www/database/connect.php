<?php
$user = 'root';
$pass = 'root';
$host = 'mysql2';
$db = 'customers';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

$dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';

try{
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $i) {
    die('Error connection with database');
}
