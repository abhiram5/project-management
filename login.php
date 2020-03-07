<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vjp"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$Uerr="";
$Perr="";
$credentialserr="";
$err="";
if($_SERVER["REQUEST_METHOD"] == "POST")
  {
   // username and password sent from form 
     $myusername=$_POST['Username'];
     $mypassword=md5($_POST['Password']);
   
     $sql="SELECT * FROM user WHERE username='$myusername' and password='$mypassword'";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
     
     $count=mysqli_num_rows($result);
 
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1)
    {
      $userid=$row['userid'];
     $_SESSION['login_user']=$myusername;
     $_SESSION['login_password']=$mypassword;
     $_SESSION['userid'] = $userid;    
     header("location:dashboard.php");
    }
    else 
    {
    $err="Your Login Name or Password is invalid";
    header("location: login.php");
    }
  
  
}
     
     
     
 ?>  
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="ie ie7 lt-ie9 lt-ie8"        lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie ie8 lt-ie9"               lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie ie9"                      lang="en"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-ie">
<!--<![endif]-->

<head>
   <!-- Meta-->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">
   <title>Project Management</title>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
   <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
   <!-- Bootstrap CSS-->
   <link rel="stylesheet" href="app/css/bootstrap.css">
   <!-- Vendor CSS-->
   <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="vendor/animo.js/animate-animo.css">
   <!-- App CSS-->
   <link rel="stylesheet" href="app/css/app.css">
   <link rel="stylesheet" href="app/css/common.css">
   <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!-- Modernizr JS Script-->
   <script src="vendor/modernizr/modernizr.custom.js" type="application/javascript"></script>
   <!-- FastClick for mobiles-->
   <script src="vendor/fastclick/lib/fastclick.js" type="application/javascript"></script>
</head>

<body>
   <!-- START wrapper-->
   <div class="row row-table page-wrapper">
      <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
         <!-- START panel-->
         <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
               <a href="#">
                  <img src="app/img/projectmgntLogo.png" alt="Image" width=90%; height=10%; class="block-center img-rounded">
               </a>
               <p class="text-center mt-lg">
                  <strong style="color: black;">SIGN IN TO CONTINUE.</strong>
               </p>
            </div>
            <div class="panel-body">
			 <div class="alert-danger"><?php echo $err;?></div>
               <form role="form" action=""  method="post" class="mb-lg" data-parsley-validate="" novalidate="" >
                  
                  <div class="form-group has-feedback">
                     <input type="text" Placeholder="Username" id="username"  name="Username" required class="form-control">
                     <span class="fa fa-user form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password"  Placeholder="Password" id="password" name="Password" required class="form-control">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  
                  </div>
                  <input type="submit" name="submit" value="Login" class="btn btn-block btn-primary">
               </form>
            </div>
         </div>
         <!-- END panel-->
      </div>
   </div>
   <!-- END wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <!-- Form Validation-->
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>
   <script src="vendor/jquery/dist/jquery.min.js"></script>
   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- Animo-->
   <script src="vendor/animo.js/animo.min.js"></script>
   <!-- Custom script for pages-->
   <script src="app/js/pages.js"></script>
   <!-- END Scripts-->
</body>
</html>