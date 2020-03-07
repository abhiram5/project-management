<?php 
include "header.php";
include "left-navbar.php";
$num ='';
$Name='Create ';
$project_status='';

if(isset($_GET['edit_project']))
    {
       $num=1;
       $Name='Update ';
        $project_id=$_GET['edit_project'];
        $view="SELECT *FROM project WHERE project_id=$project_id";
        $viewresult=mysqli_query($connection,$view);
        while($rows=mysqli_fetch_assoc($viewresult))
        {
            $projectName=$rows['project_name'];
            $startDate =$rows['date_start'];
            $new_startdate=date("d-m-Y",strtotime($startDate));
            $endDate =$rows['date_end'];
            $new_enddate = date("d-m-Y", strtotime($endDate));
            $contractPrice=$rows['contract_price'];
            $costBudget=$rows['cost_budget'];
            $progress=$rows['progress'];
            $phoneNumber=$rows['phone_number'];
            $Image=$rows['project_photo'];
            $project_status=$rows['project_status'];
         
        }
    }
    ?>
    <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3><?php echo $Name ;?>Project </h3>
            <!-- START row-->
            <div class="row">
               <div class="col-lg-6">
              
                  <form method="post" action="" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                     <!-- START panel-->
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
                        <div class="panel-body">
                        <?php 
                        if(isset($_session['message'])){
                        $error = $_session['message'];?>
                        <div class="alert alert-success alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>  
                           <?php  echo "<center> $error </center>"; 
                                ?>
                            </div>
                        <?php }
                        ?>
    <?php
     unset($_SESSION["message"]);
if(isset($_POST['submit']))
{
   $message ='';
   $projectName=$_POST['projectName'];
   $dateStart=$_POST['dateStart'];
   $startDate = date("d/m/Y", strtotime($dateStart));
   $dateEnd=$_POST['dateEnd'];
   $endDate = date("d/m/Y", strtotime( $dateEnd));
   $contractPrice= $_POST['contractPrice'];
   $costBudget= $_POST['costBudget'];
   $progress=45;
   $phoneNumber=$_POST['phoneNumber'];
   $status=isset($_POST['post_status'])?$_POST['post_status']:0;
   //$Image=$_POST['Image'];

   if($_FILES['Image']['name'])
   {
    
     $path=$_FILES['Image']['name']; 
     $ext = pathinfo($path, PATHINFO_EXTENSION);
     $profileImageName =  time().$projectName.'.'.$ext;
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
            $query="UPDATE project SET project_name='$projectName',date_start='$startDate',date_end='$endDate',contract_price=$contractPrice,cost_budget=$costBudget,progress='$progress',phone_number=$phoneNumber,project_photo='$profileImageName',project_status='$status' WHERE project_id=$project_id";
         }
           else
           {
             
            $query="INSERT INTO project(project_name,date_start,date_end,contract_price,cost_budget,progress,phone_number,project_photo,project_status)VALUES('$projectName','$startDate','$endDate','$contractPrice','$costBudget','$progress','$phoneNumber','$profileImageName','$status')";
           }
         if(mysqli_query($connection, $query))
         {
           $msg = "Updated successfully with file";
           $msg_class = "alert-success";
             if($num==1)
             {
               header("Location: project-view.php?edit=$project_id");
             }
             else{
               $_session['message'] ="Added successfully.";
               header("Location: create-pro.php");
               
             }    
             
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
            $query="UPDATE project SET project_name='$projectName',date_start='$startDate',date_end='$endDate',contract_price=$contractPrice,cost_budget=$costBudget,progress='$progress',phone_number=$phoneNumber,project_status='$status' WHERE project_id=$project_id";
           
         }
           else
           {
         
          $query="INSERT INTO project(project_name,date_start,date_end,contract_price,cost_budget,progress,phone_number,project_status)VALUES('$projectName','$startDate','$endDate','$contractPrice','$costBudget','$progress','$phoneNumber','$status')";
         }
   
     if(mysqli_query($connection, $query))
     {
       $msg = "Updated successfully  asds";
       $msg_class = "alert-success";
       
       if($num==1)
       {
         header("Location: project-view.php?edit=$project_id");
       }
       else{
         $_session['message'] ="Added successfully.";
         header("Location: create-pro.php");
         
       }    
      
     }
     else
     {
       $error= "There was an error in the database";
       $msg_class = "alert-danger";
     }
   }
}

?>


                           <div class="form-group">
                              <label class="control-label">Project Name<span style="color:red">*</span></label>
                              <input type="text" name="projectName" value="<?php if(isset($projectName)){echo $projectName;}?>" required  class="form-control">
                             <!-- //  -->
                           </div>
                           <div class="form-group">
						           <label class="control-label">Date Start<span style="color:red">*</span></label>
                              <div data-format="DD/MM/YYYY" class="datetimepicker input-group date mb-lg">
                                 <input type="text" id="tsdate"  value="<?php if(isset($projectName)){ echo $new_startdate;}?>" name="dateStart" class="form-control" required>
                                 <span class="input-group-addon" >
                                    <span class="fa fa-calendar"></span>
                                 </span>
                              </div>
                           </div>
                           <div class="form-group">
						    <label class="control-label">Date End<span style="color:red">*</span></label>
                              <div data-format="DD/MM/YYYY" class="datetimepicker input-group date mb-lg">
                                 <input type="text" id="tedate" name="dateEnd" value="<?php if(isset($projectName)){ echo $new_enddate;}?>"  class="form-control" required>
                                 <span class="input-group-addon" >
                                    <span class="fa fa-calendar"></span>
                                 </span>
                              </div>
                           </div>
                           
                           <div class="form-group">
                              <label class="control-label">Contract Price<span style="color:red">*</span></label>
                              <input type="number" min="1"  step="any" name="contractPrice"  value="<?php if(isset($projectName)){echo  $contractPrice;}?>"  required  class="form-control">
                           </div>
						       <div class="form-group">
                              <label class="control-label">Cost Budget<span style="color:red">*</span></label>
                              <input type="number" min="1" name="costBudget" value="<?php if(isset($projectName)){echo  $costBudget;}?>" required  class="form-control">
                           </div>
                           <div class="form-group">
                           <label class="control-label">Progress</label>
                           <input type="text" name="progress"  data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($projectName)){ echo $progress;}?>" data-slider-orientation="horizontal" class="slider slider-horizontal form-control">
                           </div>
						       <div class="form-group">
                              <label class="control-label">Phone Number<span style="color:red">*</span></label>
                              <input type="tel" pattern="^\d{10}$" name="phoneNumber" id="phone"  value="<?php if(isset($projectName)){ echo $phoneNumber;}?>" required  class="form-control">
                           </div>
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
                                         <img src="<?php if($Image){ echo 'app/img/user/' . $Image;}else{echo 'app/img/user/' .'avatar.jpg';} ?>" width="150" height="150" alt="picture" onClick="triggerClick()" id="profileDisplay">
                                          <?php 
                                      }//<?php if($Image){ echo 'app/img/user/' . $Image;}else 
                                      else
                                      {
                                      ?>
                                     <img src="<?php  echo 'app/img/user/' .'avatar.jpg';?>" width="150" height="150" alt="" onClick="triggerClick()" id="profileDisplay">
                                   <?php } ?>
                                </span>       
                             <input type="file" name="Image" value="<?php if(isset($Image)){echo  $Image;}else{ echo 'app/img/user/' .'avatar.jpg';} ?>" onChange="displayImage(this)" id="profileImage"  class="form-control" style="display: none;">   
                          </div><!-- value="" -->
                        </div>
                    </div>
                    <div class="form-group">
                           <label class="col-sm-2 control-label">Activation</label>
                           <div class="col-sm-10">
                              <label class="switch">
                                  <input type="checkbox" data-toggle="toggle" data-style="ios" id="status"
                                     name="post_status" <?php if($project_status){echo 'checked'; }?> value=1>
                                 <span></span>
                              </label>
                           </div>
                        </div>
               </div>

                        <div class="panel-footer">
						                              
                           <div class="clearfix">
                              
                               
                              <div class="pull-right">
                              
							     <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                                 <input type="submit" onClick="return validate()" name="submit" value="submit" class="btn btn-primary">
								
								 
                              </div>
                           
                        </div>
                     </div>
                     <!-- END panel-->
                  </form>
               </div>
              
            <!-- END row-->
            <!-- START row-->
            
         </div>
         <!-- END Page content-->
      </section>
      <script type="text/javascript">
    function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
   console.log(e.files[0]);
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

 
    //Validation for Stratdate & Enddate for New Ticket creation form                       

    $("#tedate").change(function () {

        var objFromDate = document.getElementById("tsdate").value; 
        var objToDate = document.getElementById("tedate").value;

        var FromDate = new Date(objFromDate);
        var ToDate = new Date(objToDate);

        if(strtotime(FromDate) > strtotime(ToDate) )
        {
            alert("Due Date Should Be Greater Than Start Date");
            document.getElementById("tedate").value = "";
            return false; 
        }

    });
</script>
      <?php include "footer.php"; ?>