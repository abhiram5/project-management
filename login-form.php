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
         <?php
             session_start();     
                  if(isset($_SESSION['error'])){
                  $error = $_SESSION['error'];?>
              <div class="alert alert-danger" role="alert">
                  <?php  echo "<center> $error </center>"; 
                  ?>
             </div>
              <?php }     
                  if(isset($_SESSION['error1'])){
                  $error = $_SESSION['error1'];?>
              <div class="alert alert-success" role="alert">
                  <?php  echo "<center> $error </center>"; 
                  ?>
             </div>
              <?php }?>
         <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
               <a href="#">
                  <img src="app/img/sixthblock2.png" width="210" alt="Image" class="block-center img-rounded">
               </a>
               <p class="text-center mt-lg">
                  <strong>SIGN IN TO CONTINUE.</strong>
               </p>
            </div>
               <form action="login.php" method="post" role="form" class="mb-lg" data-parsley-validate="" novalidate="">
                 
                  <div class="panel-body">
                           <div class="form-group">
                              <label class="control-label">Username *</label>
                              <input type="text" name="Username" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Password *</label>
                              <input type="password" name="password" required class="form-control">
                           </div>
                           <div><label>Login As <strong style="font-size: 18px;color: red;">*</strong>:</label>
                            </div>
                              <div class="custom-control custom-radio">
                             <input type="radio" class="custom-control-input" id="defaultUnchecked" name="name" required value="teacher">
                               <label class="custom-control-label" for="defaultUnchecked">Teacher</label>
                              <input type="radio" class="custom-control-input" id="defaultChecked" name="name" value="student">
                              <label class="custom-control-label" for="defaultChecked">Student</label>
                          </div>
                          <div class="text-right mb-sm"><a href="main-registration.php" class="text-muted">Need to Signup?</a>
                       </div>
                        <div class="panel-footer text-center">
                           <input type="submit" name="Login" class="btn btn-primary" value="Login">
                        </div>
                        </div>
            
               </form>
         </div>
         <!-- END panel-->
      </div>
   </div>
             <?php
              unset($_SESSION["error"]);
              unset($_SESSION["error1"]);
              ?>
   <!-- END wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
    <script src="vendor/screenfull/dist/screenfull.min.js"></script>
   <script src="vendor/jquery/dist/jquery.min.js"></script>
   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>   
   <script src="vendor/jquery/dist/jquery.min.js"></script>
   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- Animo-->
   <script src="vendor/animo.js/animo.min.js"></script>
   <!-- Custom script for pages-->
   <script src="app/js/pages.js"></script>     
</body>

</html>