<?php session_start();
$_SESSION['login_user']= null;
header("Location: login.php");
?>