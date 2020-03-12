
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
$num ='';
$Name='Create ';
if(isset($_POST['submit'])){
            $projectName=$_POST['projectName'];
            $dateStart=$_POST['dateStart'];
            $startDate = date("Y-m-d", strtotime($dateStart));
            $dateEnd=$_POST['dateEnd'];
            $endDate = date("Y-m-d", strtotime( $dateEnd));
            $contractPrice= $_POST['contractPrice'];
            $costBudget= $_POST['costBudget'];
            $progress=45;
            $phoneNumber=$_POST['phoneNumber'];
            $status=$_POST['status'];
            $created_by = $_SESSION['login_user'];

            // if($status==1){
            //     $status="Active";
            //      }else{
            //     $status="Inactive";
            //     }
            if($_FILES["fileToUpload"]["name"])
            {
                $target_dir = "uploads/";
                $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
               
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                if ($uploadOk == 0){
                   
                    echo"<script>setTimeout(\"location.href = 'create_project.php';\",1500);</script>";
                     // if everything is ok, try to upload file
                    } 
                else{
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } 
                else{
                
                }
                }
                //above code for fileuploads
            if($endDate>=$startDate){
                if(isset($_GET['edit_project'])){ 
               

                $user_id=$_GET['edit_project'];
                
                
                $sql="UPDATE project SET project_name='$projectName',date_start='$startDate',date_end='$endDate',contract_price=$contractPrice,cost_budget=$costBudget,progress='$progress',phone_number=$phoneNumber,project_photo='$target_file',project_status='$status' WHERE project_id=$user_id";
           
                if($connection->query($sql)){
                  
					$msg="updated successfully";
					$alert="alert alert-success";
				
                    echo"<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
                 }else{
                
                    $msg="not updated successfully";
					     $alert="alert alert-danger";
                    echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
                 }
             }else{
                
                $sql ="INSERT INTO project(project_name,created_by,date_start,date_end,contract_price,cost_budget,progress,phone_number,project_photo,project_status)VALUES('$projectName','$created_by','$startDate','$endDate','$contractPrice','$costBudget','$progress','$phoneNumber','$target_file','$status')";
                
                if($connection->query($sql)){
				    $msg="added successfully";
                $alert="alert alert-success";
               
                  echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
   
                 } 
               else {
                    $msg="not added successfully";
					     $alert="alert alert-danger";
                    echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
                  }
    
}
            }
else{
   $msg="end date should be greater than or equal to start date";
      $alert="alert alert-danger";
     }


}
else
{
   if($endDate>=$startDate){
      if(isset($_GET['edit_project'])){ 
     

      $user_id=$_GET['edit_project'];
      
      
      $sql="UPDATE project SET project_name='$projectName',date_start='$startDate',date_end='$endDate',contract_price=$contractPrice,cost_budget=$costBudget,progress='$progress',phone_number=$phoneNumber,project_status='$status' WHERE project_id=$user_id";
 
      if($connection->query($sql)){
        
     $msg="updated successfully";
     $alert="alert alert-success";
  
          echo"<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
       }else{
      
          $msg="not updated successfully";
          $alert="alert alert-danger";
          echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
       }
   }else{
      
      $sql ="INSERT INTO project(project_name,created_by,date_start,date_end,contract_price,cost_budget,progress,phone_number,project_status)VALUES('$projectName','$created_by','$startDate','$endDate','$contractPrice','$costBudget','$progress','$phoneNumber','$status')";
      
      if($connection->query($sql)){
      $msg="added successfully";
      $alert="alert alert-success";
     
        echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";

       } 
     else {
          $msg="not added successfully";
          $alert="alert alert-danger";
          echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
        }

}
  }
else{
$msg="end date should be greater than or equal to start date";
$alert="alert alert-danger";
}
}
}
else{
    if(isset($_GET['edit_project']))
    {
      $num = 1;
      $Name='Update ';
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
            <h3><?php echo $Name ;?>Project </h3>
            <!-- START row-->
            <div class="row">
               <div class="col-lg-6">
			  
                  <form method="post" action="" id="form" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                     <!-- START panel-->
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="panel-title"></div>
						        
                           <div class="<?php echo $alert;?>"><?php echo $msg;?>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                              <label class="control-label">Project Name<span style="color:red">*</span></label>
                              <input type="text" name="projectName" data-parsley-maxlength="20" value="<?php echo $projectName;?>" required class="form-control">
                           </div>
                           <div class="form-group">
                           <label class="control-label">Start date<span style="color:red">*</span></label>
                           <input type="date"  id="start"  data-parsley-start= ''  value="<?php echo $startDate;?>" name="dateStart" required class="form-control">
                           </div>
                           <div class="form-group">
                           <label class="control-label">End date<span style="color:red">*</span></label>
                           <input type="date" id="end"   data-parsley-end= '' value="<?php echo $endDate;?>"  name="dateEnd" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Contract Price<span style="color:red">*</span></label>
                              <input type="number" min="1" data-parsley-maxlength="10" oninput="validity.valid||(value='');" step="any" name="contractPrice" value="<?php echo  $contractPrice;?>" required class="form-control">
                           </div>
						          <div class="form-group">
                              <label class="control-label">Cost Budget<span style="color:red">*</span></label>
                              <input type="number" min="1" data-parsley-maxlength="10" oninput="validity.valid||(value='');" step="any" name="costBudget"  value="<?php echo  $costBudget;?>" required class="form-control">
                           </div>
                           <div class="form-group">
                           <label class="control-label">Progress</label>
                           <div class="progress progress-striped progress-xs">
                           <div role="progressbar" aria-valuenow="45" name="progress" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-purple progress-50">
                              
                           </div>
                           </div>
                           </div>
						         <div class="form-group">
                              <label class="control-label">Phone Number<span style="color:red">*</span></label>
                              <input type="text" name="phoneNumber" data-parsley-error-message="Enter a 10-digit phone number." data-parsley-type="digits" data-parsley-length="[10,10]" value="<?php echo $phoneNumber;?>" required class="form-control">
                           </div>
                           <div class="form-group">
                                <label class="control-label">Project Photos</label>
                                <input type="file"  class="form-control" value="<?php if(isset($target_file)){echo  $target_file;}else{ echo 'uploads/'.'no-image.png';} ?>" name="fileToUpload" id="fileToUpload">
                                <?php 
                                 if($num == 1)
                                      {
                                         ?>
                                         <img src="<?php if($target_file){ echo $target_file;}else{echo 'uploads/'.'no-image.png';} ?>" width="150" height="150" alt="picture" onClick="triggerClick()" id="profileDisplay">
                                          <?php 
                                      }//<?php if($Image){ echo 'app/img/user/' . $Image;}else 
                                 //      else
                                 //      {
                                 //      ?>
                                 <!-- //     <img src="<?php  //echo 'uploads/'.'no-image.png';?>" width="150" height="150" alt="" onClick="triggerClick()" id="profileDisplay"> -->
                                 <?php// } ?>
                               
                                <!-- <img src="<?php// echo $target_file;?>" height=67px  > -->
                            </div>
                            <div class="form-group">
                           <label class="col-sm-2 control-label">Activation</label>
                           <div class="col-sm-10">
                              <label class="switch">
                                  <input type="checkbox" data-toggle="toggle" data-style="ios" id="status"
                                     name="status" <?php if($status){echo 'checked'; }?> value=1>
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        </div>

                        <div class="panel-footer">
						                              
                           <div class="clearfix">
                              
                               
                              <div class="pull-right">
                              <?php
                              if($num == 1)
                              {
                              ?>
                          <a href="project-view.php?edit=<?php echo $user_id ;?>" class="btn btn-danger">Cancel</a>
                          <?php
                           }
                           else
                           {
                          ?>
                           <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                           <?php } ?>
                                 <input type="submit"  name="submit" value="submit" class="btn btn-primary">
								
								 
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
//   $(document).ready(function() {
//    var start = document.getElementById('start');
//    var end = document.getElementById('end');
   // $("#end").rules('add', { greaterThan: "#start" });
   // start.addEventListener('change', function() {
  
   //    if (start.value)
   //        end.min =start.value;
   //       // $(this).parsley().validate();
   //   }, false);
   //   end.addEventListener('change', function() {
   //    if (end.value)
   //        start.max =new Date(end.value);
   //        //$(this).parsley().validate();
   //   }, false);
//    window.Parsley.addValidator('start', {
//   validateString: function (value) {
//             var now = new Date();
//             var date = new Date(value);
//             return date < now;
//         },
//   messages: {
//     en: 'Please insert tomorrow or anydate in the future'
//   }
// });

//Return date
//    window.Parsley.addValidator('end', {
//    validateString: function (value) {
//                var now = new Date();
//                var date = new Date(value);
//                return date < now;
//    },
//    messages: {
//       en: 'Your return date should be 3 days or more after departure date'
//    }
//    });
// });




// 
// $(document).ready(function() {
//         $.validator.addMethod("end", function(value, element) {
//             var startDate = $('start').val();
//             return Date.parse(startDate) <= Date.parse(value) || value == "";
//         }, "* End date must be after start date");
//         $('#form').validate();
//     });

 </script>

  
</body>
</html>

<?php include "footer.php";?>