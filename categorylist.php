<?php
include "header.php";
include "left-navbar.php";
 
?>
<section>
<div class="content-wrapper">
            <h3>Expense Categories
            <a href="categories.php" ><button type="button"  class="btn btn-primary  btn-sm fa fa-plus float-right" style="float: right;">Add Expense</button></a>
            </h3>
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                       <!-- Categories -->
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>S.no</th>
                                 <th>Expense Type</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                               <?php
                               $query = "SELECT * FROM expense_type order BY expense_type_id DESC";
  
                               $select_project = mysqli_query($connection,$query);  
                               $index=1;
 
                                while($row = mysqli_fetch_assoc($select_project))
                                   {
                                   $expense_type_id=$row['expense_type_id'];
                               ?>
                              <tr class="gradeX">
                                 <td><?php echo $index; ?></td>
                                 <td><?php echo $row['expense_type']; ?></td>
                                 <td><a 
                            href="<?php echo 'categorylist.php?delete='.$expense_type_id.'' ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a> &nbsp; &nbsp;
                            <a href="<?php echo 'categories.php?edit='.
                            $expense_type_id.'' ?>"><i class="fa fa-edit"></i></a></td>  
                              </tr>
                                   <?php
                                    $index++; } 
                                   ?>
                           </tbody>
                        </table>
                        <?php
                        if(isset($_GET['delete']))
                        {
                           $expense_type_Id=$_GET['delete'];
                           $query = "delete expense_type from expense_type where expense_type_id = $expense_type_Id ";
                           $delete_query = mysqli_query($connection,$query);
                           $message='Deleted successfully';
                           header("Location: categorylist.php");
                        } 
                        ?>
                     </div>
                  </div>
               </div>
            </div>
</div>
</section>
<?php include "footer.php";?>