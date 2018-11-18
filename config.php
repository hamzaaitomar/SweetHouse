<?php
$dsn = 'mysql:dbname=domisep;host=localhost';
$user = 'root';
$password = '';
try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
session_start();
?>