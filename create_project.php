
 <?php
 include "header.php";
 include "left-navbar.php";
$projectName="";
$startDate ="";
$dateEnd="";
$endDate ="";
$contractPrice="";
$costBudget="";
$progress="";
$phoneNumber="";
$msg="";
$alert="hidden";
$status="";
$target_file="";
$datemsg="";

if(isset($_POST['submit'])){
            $projectName=$_POST['projectName'];
            $dateStart=$_POST['dateStart'];
            $startDate = date("d/m/Y", strtotime($dateStart));
            $dateEnd=$_POST['dateEnd'];
            $endDate = date("d/m/Y", strtotime( $dateEnd));
            $contractPrice= $_POST['contractPrice'];
            $costBudget= $_POST['costBudget'];
            $progress=$_POST['progress'];
            $phoneNumber=$_POST['phoneNumber'];
            $status=$_POST['status'];
            
            
          
			   if($status==1){
                $status="Active";
                 }else{
                $status="Inactive";
                }
                $target_dir = "uploads/";
                $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ){
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    echo"<script>setTimeout(\"location.href = 'create_project.php';\",1500);</script>";
                     // if everything is ok, try to upload file
                    } 
                else{
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } 
                else{
                echo "Sorry,there was an error uploading your file.";
                }
                }
                //above code for fileuploads
            
            if(isset($_GET['edit_project'])){
                $user_id=$_GET['edit_project'];
                
                
                $sql="UPDATE project SET project_name='$projectName',date_start='$startDate',date_end='$endDate',contract_price=$contractPrice,cost_budget=$costBudget,progress='$progress',phone_number=$phoneNumber,project_photo='$target_file',project_status='$status' WHERE project_id=$user_id";
            //echo "UPDATE assets SET Asset_Name='$assetname',Asset_Type_Id=$assettypeid,Loc_Id=$locationid,Vendor='$vendor',Serial_Number='$serialnumber',Price=$price,Warranty=$warranty,Date_Of_Purchase='$dateformat',Status='$status' WHERE ID=$user_id";
            // "INSERT INTO students(FirstName,LastName,Password,CPassword,Branch,CourseYear,Email,Gender,DOB,Address)VALUES($firstname,$lastname,$password,$confirmpassword,$branch,$courseyear,$email,$gender,$DOB,$address)";
                if($connection->query($sql)){
                  
					$msg="updated successfully";
					$alert="alert alert-success";
				
                    echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
                 }else{
                
                    $msg="not updated successfully";
					     $alert="alert alert-danger";
                    echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
                 }
             }else{
                $sql ="INSERT INTO project(project_name,date_start,date_end,contract_price,cost_budget,progress,phone_number,project_photo,project_status)VALUES('$projectName','$startDate','$endDate','$contractPrice','$costBudget','$progress','$phoneNumber','$target_file','$status')";
                // "INSERT INTO students(FirstName,LastName,Password,CPassword,Branch,CourseYear,Email,Gender,DOB,Address)VALUES($firstname,$lastname,$password,$confirmpassword,$branch,$courseyear,$email,$gender,$DOB,$address)";
  
                if($connection->query($sql)){
				    $msg="added successfully";
					$alert="alert alert-success";
                    
                    echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
    // echo"<script>window.open('Assets.php');</script>";
                 } 
               else {
                    $msg=" not added successfully";
					     $alert="alert alert-danger";
                    echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
    }
    }

}
else{
    if(isset($_GET['edit_project']))
    {
        $user_id=$_GET['edit_project'];
        $view="SELECT *FROM project WHERE project_id=$user_id";
        $viewresult=mysqli_query($connection,$view);
        while($rows=mysqli_fetch_assoc($viewresult))
        {
            $projectName=$rows['project_name'];
            $startDate =$rows['date_start'];
            $endDate =$rows['date_end'];
            $contractPrice=$rows['contract_price'];
            $costBudget=$rows['cost_budget'];
            $progress=$rows['progress'];
            $phoneNumber=$rows['phone_number'];
            $target_file=$rows['project_photo'];
            $status=$rows['project_status'];
        }
    }
}   

   
?>
						
      <!-- END aside-->
      <!-- START Main section-->
	  	
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Form </h3>
            <!-- START row-->
            <div class="row">
               <div class="col-lg-6">
			  
                  <form method="post" action="" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                     <!-- START panel-->
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
						        
                           <div class="<?php echo $alert;?>"><?php echo $msg;?>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                              <label class="control-label">Project Name<span style="color:red">*</span></label>
                              <input type="text" name="projectName" value="<?php echo $projectName;?>" required  class="form-control">
                           </div>
                           <div class="form-group">
                           <?php echo $datemsg;?>
						           <label class="control-label">Date Start<span style="color:red">*</span></label>
                              <div data-format="DD/MM/YYYY" class="datetimepicker input-group date mb-lg">
                                 <input type="text" id="start_date" name="dateStart"  value="<?php echo $startDate;?>" class="form-control" required>
                                 <span class="input-group-addon" >
                                    <span class="fa fa-calendar"></span>
                                 </span>
                              </div>
                           </div>
                           <div class="form-group">
						    <label class="control-label">Date End<span style="color:red">*</span></label>
                              <div data-format="DD/MM/YYYY" class="datetimepicker input-group date mb-lg">
                                 <input type="text" id="end_date" name="dateEnd"  value="<?php echo $endDate;?>" class="form-control" required>
                                 <span class="input-group-addon" >
                                    <span class="fa fa-calendar"></span>
                                 </span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Contract Price<span style="color:red">*</span></label>
                              <input type="number" min="0" oninput="validity.valid||(value='');" step="any" name="contractPrice"   value="<?php echo  $contractPrice;?>" required  class="form-control">
                           </div>
						   <div class="form-group">
                              <label class="control-label">Cost Budget<span style="color:red">*</span></label>
                              <input type="number" min="0" oninput="validity.valid||(value='');" name="costBudget"  value="<?php echo  $costBudget;?>" required  class="form-control">
                           </div>
                           <div class="form-group">
                           <label class="control-label">Progress</label>
                           <input type="text" name="progress"  data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $progress;?>" data-slider-orientation="horizontal" class="slider slider-horizontal form-control">
                           </div>
						   <div class="form-group">
                              <label class="control-label">Phone Number<span style="color:red">*</span></label>
                              <input type="text" name="phoneNumber" id="phone"  value="<?php echo $phoneNumber;?>" required  class="form-control">
                           </div>
                           <div class="form-group">
                                <label class="control-label">Project Photos<span style="color:red">*</span></label>
                                <input type="file"  class="form-control" name="fileToUpload" id="fileToUpload">
                                <img src="<?php echo $target_file;?>" height=67px  >
                            </div>
						   <div class="form-group">
                           <label class="col-sm-2 control-label">Status</label>
                           <div class="col-sm-10">
                              <label class="switch">
                                 <input type="checkbox"  id="status" name="status" value=1 <?php if($status=='Active'){ echo"checked";}?>>
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        </div>

                        <div class="panel-footer">
						                              
                           <div class="clearfix">
                              
                               
                              <div class="pull-right">
                              
							     <a href="create_project.php" class="btn btn-danger">Cancel</a>
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
      <!-- END Main section-->
   </div>
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
  
<script>
function validate(){
   var a=document.getElementById("start_date").value;
  

   var b=document.getElementById("end_date").value;
   var c=document.getElementById("phone").value;
   if(a>=b){
      alert("end date shouls be greater than start date");
      return false;

   }
if(c=="")
{
alert("please Enter the Contact Number");
return false;
}
if(isNaN(a))
{
alert("Enter the valid Mobile Number(Like : 9566137117)");
return false;
}
if((a.length < 1) || (a.length > 10))
{
alert(" Your Mobile Number must be 1 to 10 Integers");
return false;
}
   return true;
}
</script>
  
</body>

</html>
<?php include "footer.php";?>