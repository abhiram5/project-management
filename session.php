<?php
session_start();

 if(isset($_SESSION['login_user']))
{
	$name=$_SESSION['login_user'];
	$user_id=$_SESSION['userid'];

                     
}
else
{
	//   echo "hello";
   //     exit();
header("Location: login.php");
}?>