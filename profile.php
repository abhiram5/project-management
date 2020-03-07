<?php
include "header.php";
include "left-navbar.php";
//include "session.php";

$query="SELECT * FROM `user` WHERE userid= $user_id";
      $select_teacher = mysqli_query($connection, $query);  

      while($row = mysqli_fetch_assoc($select_teacher)) 
      {
      $userid = $row['userid'];
      $name = $row['name'];
      $username = $row['username'];
      $password = $row['password'];
      $role = $row['user_role'];
  }
   

if(isset($_POST['update_post']))
  {
      $name = $_POST['name'];
      $username = $_POST['username'];
      $enteredpassword = $_POST['password'];
      $role = $_POST['role'];
    $status = $_POST['toggle'];
   if($enteredpassword==$password)
   {
    $query= "update user set name='$name',username='$username',user_role='$role',account_status='$status' where userid=$user_id";

   }
   else{
    $encryptedPassword = md5($enteredpassword);
    $query= "update user set name='$name',username='$username',password='$encryptedPassword',user_role='$role',account_status='$status' where userid=$user_id";
    $password=$encryptedPassword;
    }
    $results=mysqli_query($connection,$query);
    if($results)
    {
        $CategoryTypeMessage=' updated successfully'; 

    }

  }
  
?>
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>
               <div class="pull-right text-center"> 
               </div> Profile
            </h3>
      <div class="row">
               <!-- START dashboard main content-->
         <section class="col-md-6">
           <form action="" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="row">
                
                     <div class="col-md-12">
                         <?php
                     if(!empty($CategoryTypeMessage))
                          { ?>
                             <div class="alert alert-success alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> 
                            <?php  echo "<center> $CategoryTypeMessage </center>"; 
                           ?> 
                        </div>
                        <?php
                          } ?>
                        <br><br>
                        <!-- START widget-->
                                <div class="form-group">
                                    <label for="name">Name <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                    <input type="text" data-parsley-maxlength="15" name="name" id="" class="form-control" value="<?php  echo $name; ?>" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                    <input type="text" data-parsley-maxlength="10" name="username" id="" class="form-control" value="<?php  echo $username; ?>" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                    <input type="password" data-parsley-maxlength="10" name="password" id="password" class="form-control" value="<?php echo $password;?>" aria-describedby="helpId" required="password">
                                </div>
                                <div><label>Role : <strong style="font-size: 18px;color: red;">*</strong>:</label>
                            </div>
                              <div class="custom-control custom-radio">
                             <input <?php if ($role == 'admin') echo 'checked="checked"'; ?> type="radio" class="custom-control-input" id="defaultUnchecked" name="role" value="admin">
                               <label class="custom-control-label" for="defaultUnchecked">Admin</label>
                              <input <?php if ($role == 'staff') echo 'checked="checked"'; ?> type="radio" class="custom-control-input" id="defaultChecked" name="role" value="staff">
                              <label class="custom-control-label" for="defaultChecked">Staff</label>
                          </div>
                              <div class="form-group">
                                    <input type="hidden" checked data-toggle="toggle" data-style="ios" name="toggle" value=1>
                              </div>
                               
                        <div class="form-group">
                          <div class="row">
                            <div class="clearfix text-center">
                              <a href="dashboard.php"><button type="button"  class="btn btn-danger">Cancel</button></a>
                              <input type="submit" name="update_post" class="btn btn-primary"  value="Save" >
                            </div>
                          </div> 
                        </div>
                     
                    </div>
                  </div>
               </div>
            </div>
             </form>
          </section>
               
              
               <!-- END dashboard sidebar-->
            </div>
         </div>
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
 
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <?php include "footer.php";?> 