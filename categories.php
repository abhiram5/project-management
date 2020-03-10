<?php
include "header.php";
include "left-navbar.php";
$Name='Create ';
$redirect ="categorylist.php";
if(isset($_GET['from']))
{

	$redirect = $_GET['from'];
}
if(isset($_GET['edit']))
    {
      $Name='Update ';
      $NUM=1;
      $expense_type_Id=$_GET['edit'];
      $query="SELECT expense_type FROM expense_type where expense_type_id = $expense_type_Id";
     
      $select_query = mysqli_query($connection,$query);
      
      while($row = mysqli_fetch_assoc($select_query))
      {
       $expense_Type=$row['expense_type'];
      }
    }
if(isset($_POST['Category']))
    {
      $ExpenseCategorytype=$_POST['ExpenseCategorytype'];
      $query="SELECT count(expense_type) as ctype FROM expense_type where expense_type = '$ExpenseCategorytype'";
     
        $insert_query = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_assoc($insert_query))
        {
         $count=$row['ctype'];
         
        }
        if($count>=1)
        {
          $CategoryTypeErrorMessage=$ExpenseCategorytype.' Already Exitsts!';
        }
        else
        {
          if($NUM==1)
          {
            $query="update expense_type set expense_type='$ExpenseCategorytype' where expense_type_id = $expense_type_Id";
            $insert_query = mysqli_query($connection,$query);
            if(!$insert_query)
              {
  
            die("query faild..".mysqli_error($connection));
            }
            else
            {
              $CategoryTypeMessage=$ExpenseCategorytype.' updated successfully';
  
                            if(!empty($CategoryTypeMessage))
                            { ?>
                               <div class="alert alert-success alert-dismissable">
                             <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> 
                              <?php  echo "<center> $CategoryTypeMessage </center>"; 
                             ?> 
                          </div>
                          <?php
                            }
                         
          header("Location: $redirect ");
            }
          }
          else{
            $query="insert into expense_type(expense_type) values('$ExpenseCategorytype')";
            $insert_query = mysqli_query($connection,$query);
            if(!$insert_query)
              {
  
            die("query faild..".mysqli_error($connection));
            }
            else
            {
              $CategoryTypeMessage=$ExpenseCategorytype.' Added successfully';
  
                            if(!empty($CategoryTypeMessage))
                            { ?>
                               <div class="alert alert-success alert-dismissable">
                             <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> 
                              <?php  echo "<center> $CategoryTypeMessage </center>"; 
                             ?> 
                          </div>
                          <?php
                            }
                         
          header("Location: $redirect ");
            }
          }
          
          
        }
      
    }
   
    
?>

<section>
	<div class="content-wrapper">
            <h3>
               <?php echo $Name ; ?>Category
            </h3>
            <div class="row">
                <div class="col-lg-6">
                 <div class="panel panel-default">
                 	 <form method="post" data-parsley-validate="" novalidate="" >
                       <div class="panel-body">
                       	<?php
                        if(!empty($CategoryTypeErrorMessage)){?>
                        <div class="alert alert-danger alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> 
                            <?php  echo "<center> $CategoryTypeErrorMessage </center>"; 
                           ?> 
                        </div>
                        	<?php } ?>
                           <div class="form-group">
                              <label class="control-label">Expense Category type <strong style="font-size:18px;color:red;">*</strong>:</label>
                             <input type="text" data-parsley-maxlength="16" value="<?php if(isset($expense_Type)){ echo  $expense_Type ;}?>" placeholder="Enter Expense Category type" class="form-control" required name="ExpenseCategorytype">
                           </div>
                     	</div>
                     	<div class="panel-footer">	
                            <div class="clearfix ">
                            	<div class="pull-right">
	                              <a href="<?php echo $redirect; ?>"><button type="button"  class="btn btn-danger">Cancel</button></a>
	                              <input type="submit" name="Category" class="btn btn-primary"  value="Save" >
	                          	</div>
                            </div>
                        </div>
                      </form>
                  </div>
               </div>         
	         </div>
	     </div>
	 </div>
 </section>
 <script src="vendor/jquery/dist/jquery.min.js"></script>
 <!--   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script> -->
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>  
<?php include "footer.php";?>