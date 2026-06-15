<?php
$host     = 'localhost';
$login    = 'burkina_user';
$password = 'burkina2026';
$database = 'burkina_db';

$conn = mysqli_connect($host, $login, $password, $database);

if (!$conn) {
    die('Erreur de connexion : ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
?>
