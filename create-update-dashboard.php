<?php
include "header.php";
include "left-navbar.php";
// $connection = mysqli_connect("localhost","root","","school");
//include "session.php";

$num ='';
$check ='';
$CategoryTypeErrorMessage='';
if(isset($_GET['edit']))
{    
    $project_id =$_GET['edit'];
    $query = "SELECT * FROM project where project_id = $project_id";
   
    $select_project = mysqli_query($connection,$query);  

     while($row = mysqli_fetch_assoc($select_project))
        {
        $project_name = $row['project_name'];
        $expense = $row['expense'];
        $cost_budget = $row['cost_budget'];
        $date_start = $row['date_start'];
        $newDate_event = date("M-Y", strtotime($date_start));
        $date_end=$row['date_end'];
        $newDate_end=date("M-Y",strtotime($date_end));
        $contract_price=$row['contract_price']; 
        $project_photo = $row['project_photo'];
        $progress = $row['progress'];

       }
   }
   if(isset($_GET['edit_category']))
{    
  $num = 1;
    $expense_id =$_GET['edit_category'];

    $query = "SELECT * FROM expense where expense_id = $expense_id";
  
    $select_project = mysqli_query($connection,$query);  

     while($row = mysqli_fetch_assoc($select_project))
        {
          $expense_id = $row['expense_id'];
         $Image=$row['expense_photo'];
      $Amount=$row['expense'];
      $Category=$row['expense_type']; 
      $Notes=$row['expense_note'];
      $date = date("d-m-Y",strtotime($row['date']));

       }
   }
                
  if(isset($_POST['Submit']))
  {
    $Image=$_POST['Image'];
    $Amount=$_POST['Amount'];
    $Category=$_POST['Category']; 
    $Notes=$_POST['Notes'];
    $date = date('d/m/Y');

  $query="SELECT expense_type FROM expense_type where expense_type_id = $Category";
  $expense_type_results = mysqli_query($connection,$query);  

  while($row = mysqli_fetch_assoc($expense_type_results))
   {
        $Category_name=$row['expense_type'];
    }
 
    
    if($_FILES['Image']['name'])
    {
     
      $path=$_FILES['Image']['name']; 
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      $profileImageName =  time().$project_name.'.'.$ext;
      $target_dir = "app/img/user/";
      $target_file = $target_dir . basename($profileImageName);
      // echo $target_file;
      // exit();
      
      if($_FILES['Image']['size'] > 200000)
      {
        $error = "Image size should not be greated than 200Kb";
        $msg_class = "alert-danger";
      }
      else
      {
        if(move_uploaded_file($_FILES["Image"]["tmp_name"],$target_file))
        {
          if($num==1)
           {
             $query="update expense set expense_type='$Category_name',expense='$Amount',date='$date',expense_photo='$profileImageName',expense_note='$Notes' where expense_id=$expense_id";
            }
            else
            {
              
             $query="insert into expense(project_id,expense_type,expense,date,expense_photo,expense_note) values('$project_id','$Category_name','$Amount','$date','$profileImageName','$Notes')";
            }
          if(mysqli_query($connection, $query))
          {
            $msg = "Updated successfully with file";
            $msg_class = "alert-success";
              
                header("Location: project-view.php?edit=$project_id");   
              
          }
          else 
          {
            $error= "There was an error in the database";
            $msg_class = "alert-danger";
          }
        }
      }
    }
    else
    {   
      if($num==1)
           {
             $query="update expense set expense_type='$Category_name',expense='$Amount',date='$date',expense_note='$Notes' where expense_id=$expense_id";
            }
            else
            {
          
           $query="insert into expense(project_id,expense_type,expense,date,expense_note) values('$project_id','$Category_name','$Amount','$date','$Notes')";
          }
    
      if(mysqli_query($connection, $query))
      {
        $msg = "Updated successfully  asds";
        $msg_class = "alert-success";
        
                header("Location: project-view.php?edit=$project_id");
               
         
      }
      else
      {
        $error= "There was an error in the database";
        $msg_class = "alert-danger";
      }
    }
   
   }
   
  
?>

      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
          <h3>
               <div class="pull-right text-center">
                 
               </div>Expenses
               <!-- <small>Hi, <?php //if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{//header("Location: login-form.php");}?>. Welcome back!</small> -->
            </h3>
            <!-- START row-->
            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                    <div class="row">
                     <div class="col-lg-12">
                       <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="100" class="panel widget">    
                         <div class="panel-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <p><h3><?php if(isset($project_name)){echo $project_name;}?></h3></p>
                                      <strong><p class="text-muted"><?php if(isset($newDate_event)){echo $newDate_event;}?> - <?php if(isset($newDate_end)){echo $newDate_end;}?> </p></strong>
                                    
                                </div>
                                  <div class="col-md-4 text-right">
                                      <table>
                                        <tbody>
                                           <tr  style="color: red;">
                                              <td><strong>Expences  :</strong>&nbsp;&nbsp;&nbsp;</td>
                                              <td class="text-left"><?php if(isset($expense)){echo $expense;}?></td> 
                                            </tr>
                                            <tr>
                                              <td><strong>Cost :</strong>&nbsp;&nbsp;&nbsp;</td>
                                              <td class="text-left"> <?php if(isset($cost_budget)){echo $cost_budget;}?></td>
                                               </tr>
                                              <tr>
                                              <td><strong>Contract :</strong>&nbsp;&nbsp;&nbsp;</td>
                                                <td class="text-left"><?php if(isset($contract_price)){echo $contract_price;}?></td>
                                          </tr>
                                      </tbody>
                                    </table>
                                 </div> 
                                 <div class="col-md-2 text-right">
                                  <div class="form-group">
                                   <!-- <a href='create_project.php?source=edit_user&edit_user=<?php //echo $project_id;?>'><button type="button"  class="btn btn-primary  btn-sm fa fa-edit float-right" style="float: right;"></button></a> -->
                                  </div>
                                  <br><br>
                                  <div class="form-group">
                                  <div class="text-center">
                                   <a href="categories.php?from=create-update-dashboard.php?edit=<?php echo $project_id ;?>"><button type="submit" class="btn btn-sm btn-primary" name="Category">Add Expense Category</button></a>
                                </div>
                               </div>
                            </div>  
                        </div>
                      <div class="row">
                       <form method="post" enctype="multipart/form-data">
                         <div class="col-md-6">
                          <label class="control-label"><?php if(isset($date)){ echo $date ;}?></label>
                            <div class="form-group">
                                  <?php if (!empty($msg)): ?>
                                  <div class="alert <?php echo $msg_class ?>" role="alert">
                                       <?php echo $msg; ?>
                                  </div>
                                        <?php endif; ?>
                                        <?php if (!empty($error)): ?>
                                  <div class="alert <?php echo $msg_class ?>" role="alert">
                                        <?php echo $error; ?>
                                  </div>
                                        <?php endif; ?>
                                  <div class="form-group text-left" style="position: relative;" >
                                  <span class="img-div">
                                     <div class="img-placeholder"  onClick="triggerClick()">
                                      <label>Click Here to Upload Image</label>
                                      </div>
                                      <?php 
                                      if($num == 1)
                                      {
                                         ?>
                                         <img src="<?php if( $Image){ echo 'app/img/user/' . $Image;}else { echo 'app/img/user/' .'avatar.jpg';}?>" width="150" height="150" alt="picture" onClick="triggerClick()" id="profileDisplay">
                                          <?php 
                                      }
                                      else
                                      {
                                      ?>
                                     <img src="<?php  echo 'app/img/user/' .'avatar.jpg';?>" width="150" height="150" alt="" onClick="triggerClick()" id="profileDisplay">
                                   <?php } ?>
                                </span>       
                             <input type="file" name="Image" onChange="displayImage(this)" id="profileImage" value="<?php echo  $Image; ?>" class="form-control" style="display: none;">   
                          </div>
                        </div>
                    </div>
                           <div class="col-md-6">
                               <label class="control-label">Amount :</label>
                              <input type="text" name="Amount" value="<?php if(isset($Amount)){ echo  $Amount ;}?>" required class="form-control">
                            <div class="form-group">
                              <label class="control-label">Category : </label>
                              <?php
                              $select_query = "SELECT expense_type_id,expense_type FROM `expense_type`";
                              $select_query_run = mysqli_query($connection, $select_query);
                                                          
                              echo "<select required name = 'Category' class = 'form-control' >";

                              echo "<option value=''>Select teacher name</option>";
                                while($select_query_array = mysqli_fetch_assoc($select_query_run))
                              {
                                $selected='';
                                if($Category==$select_query_array['expense_type']){
                                  $selected="selected";
                                }
                              echo "<option value='".$select_query_array['expense_type_id']."' ".$selected." >".$select_query_array['expense_type']."</option>";                        
                              }
                              echo "</select>";
                              ?>
                         
                            </div>
                           </div>
                           <div class="col-md-12">
                             <div class="form-group">
                              <label>Notes :</label>
                               <textarea  class="form-control" rows=5 name="Notes"><?php if(isset($Notes)){ echo $Notes ;}?></textarea>
                           </div>
                           <div class="form-group">
                            <div class="text-center">
                               <button type="submit" class="btn btn-sm btn-primary" name="Submit">Submit</button>
                            </div>
                          </div>
                         </div>
                      </form>                    
                  </div>   
                </div>
              </div>
          </div>
        </div>
      </div>
  </div>
</div>
</section>
      <!-- END Main section-->
  <script src="vendor/jquery/dist/jquery.min.js"></script>
 <!--   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script> -->
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>  
   <!-- <style>
.toggle.ios, .toggle-Yes.ios, .toggle-No.ios { border-radius: 20px; }
.toggle.ios .toggle-handle { border-radius: 20px; }
</style> -->
   <script type="text/javascript">
    function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
   console.log('asdsad');
  if (e.files[0]) {
   console.log(e.files[0]);
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
 </script>
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
  <?php include "footer.php" ?>

