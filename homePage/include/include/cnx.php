<?php

$dsn = "mysql:host=localhost;dbname=PHPBlog";
$user = "root";
$pwd = "password";

try {
    $cnx = new PDO($dsn, $user, $pwd);
} catch (PDOException $e) {
    echo 'Une erreur de connexion est intervenue';
}