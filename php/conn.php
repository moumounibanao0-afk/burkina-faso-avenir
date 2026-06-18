<?php
if (basename($_SERVER['SCRIPT_FILENAME']) === 'conn.php') {
    header('HTTP/1.0 403 Forbidden');
    die('Accès interdit.');
}

$host     = 'localhost';
$login    = 'burkina_user';
$password = '1234';
$database = 'burkina_db';

$conn = mysqli_connect($host, $login, $password, $database);
if (!$conn) {
    die('Erreur de connexion : ' . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8mb4');
?>
