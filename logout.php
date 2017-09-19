<?php
session_start();
session_unset($_SESSION['user']);
$_SESSION = [];
header('Location: index.php');
?>