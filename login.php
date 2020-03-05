<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vjp"; 
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$Uerr="";
$Perr="";
$credentialserr="";
if(isset($_POST['submit']))
  {
   
     $myusername=$_POST['username2'];
     $mypassword=$_POST['password2']; 
     $_SESSION['User_Name']=$myusername;
      
     $sql="SELECT*FROM user";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_array($result);
     //$count=mysqli_num_rows($result);
     if(($row['username']!=$myusername)&&($row['password']!=$mypassword)){
        $credentialserr="invalid username and password";
     }
     else if($row['username']!=$myusername){
         $Uerr="invalid username";
        ////header("location:login.php?login=username");
    }else if($row['password']!=$mypassword){
        $Perr="invalid password";
        //header("location:login.php?login=password");
    }else if(($row['username']==$myusername)&&($row['password']==$mypassword)){
         header("location:assets.php");
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
   <title>BeAdmin - Bootstrap Admin Theme</title>
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
                  <img src="app/img/sixthblock2.png" alt="Image" width=30%; height=30%; class="block-center img-rounded">
               </a>
               <p class="text-center mt-lg">
                  <strong>SIGN IN TO CONTINUE.</strong>
               </p>
            </div>
            <div class="panel-body">
			 <div class="alert-danger"><?php echo $credentialserr;?></div>
               <form role="form" action="" method="post" class="mb-lg">
                  
                  <div class="form-group has-feedback">
                     <input type="text" class="form-control" Placeholder="Username" id="username2"  name="username2" required><div class="alert-danger"><?php echo $Uerr;?></div>
                     <span class="fa fa-user form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" class="form-control" Placeholder="Password" id="password2" name="password2" required><div class="alert-danger"><?php echo $Perr;?></div>
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="clearfix">
                     <div class="pull-right"><a href="#" class="text-muted">Need to Signup?</a>
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
   <script src="vendor/jquery/dist/jquery.min.js"></script>
   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- Animo-->
   <script src="vendor/animo.js/animo.min.js"></script>
   <!-- Custom script for pages-->
   <script src="app/js/pages.js"></script>
   <!-- END Scripts-->
</body>

</html>