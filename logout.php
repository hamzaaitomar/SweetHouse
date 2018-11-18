<?php
include 'config.php';
$_SESSION = array();
session_destroy();
header("Location: inscription.php");
die();
?>