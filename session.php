<?php
session_start();

 if(isset($_SESSION['login_user']))
{
	$name=$_SESSION['login_user'];
	$user_id=$_SESSION['userid'];
   $role_id = $_SESSION['role_id'];
                     
}
else
{
header("Location: login.php");
}?>