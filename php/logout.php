<?php
require_once 'Auth.class.php';
session_start();
Auth::deconnecter();
header('Location: login.php');
exit;
?>
