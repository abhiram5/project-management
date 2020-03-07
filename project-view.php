<?php
include "header.php";
include "left-navbar.php";

?>
    <section>
        <div class="content-wrapper">
            <h3>
               <div class="pull-right text-center">
                 <a href="dashboard.php" ><button type="button"  class="btn btn-danger  btn-sm fa fa-arrow-left float-right" style="float: right;">Go Back</button></a>
               </div>Project List
               <!-- <small>Hi, <?php //if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{//header("Location: login-form.php");}?>. Welcome back!</small> -->
            </h3>
<?php
if(isset($_GET['edit']))
{    
    $project_id =$_GET['edit'];
    $query = "SELECT * FROM `project` where project_id = $project_id";
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

?>  
              <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                    <div class="panel-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <p><h3><?php if(isset($project_name)){echo $project_name;}?></h3></p>
                                   <strong><p class="text-muted"><?php if(isset($newDate_event)){echo $newDate_event;}?> - <?php if(isset($newDate_end)){echo $newDate_end;}?> </p></strong>
                                       <div class="progress progress-xs m0">
                                              <div role="progressbar" aria-valuenow="<?php if(isset($progress)){echo $progress;}?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-purple progress-<?php echo $progress;?>"style="width: <?php echo $progress.'px' ?>">
                                                <span class="sr-only"><?php echo $progress ?> Complete</span>
                                              </div>
                                          </div>
                                  <br><br>
                                </div>
                                  <div class="col-md-4 text-right" style="text-align: -webkit-center;">
                                      <table>
                                        <tbody>
                                           <tr  style="color: red;">
                                              <td><strong>Expences  :</strong>&nbsp;&nbsp;&nbsp;</td>
                                              <td class="text-left"><?php if(isset($expense)){echo $expense;}?></td> 
                                            </tr>
                                            <tr>
                                              <td><strong>Cost &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;&nbsp;</td>
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
                                  <a href='create_project.php?source=edit_project&edit_project=<?php echo $project_id;?>'><button type="button"  class="btn btn-primary  btn-sm fa fa-edit float-right" style="float: right;"></button></a>
                                </div>     
                            </div>
                          <div class="row">
                          <div class="col-lg-12">
                            <table id="datatable1" class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Date</th>
                                          <th>Category</th>
                                          <th>Expense</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php 
                                          $query = "SELECT expense_id,date,expense_type,expense FROM `expense` where project_id = $project_id";
                                          $select_expense = mysqli_query($connection,$query);  

                                        while($row = mysqli_fetch_assoc($select_expense))
                                            {
                                            $expense_id = $row['expense_id'];
                                            $date = $row['date'];
                                            $newDate = date("M-Y", strtotime($date));
                                            $expense = $row['expense'];
                                            $expense_type = $row['expense_type'];
                                            
                                          ?>
                                          <tr>
                                              <td><?php echo $newDate;?></td>
                                              <td><?php echo $expense_type;?></td>
                                              <td><a href="<?php echo 'create-update-dashboard.php?edit_category='.
                                      $expense_id.'&edit='.$project_id.''?>"><?php echo $expense;?></a></td>
                                          </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                          <?php
                                          $query = "SELECT SUM(expense) AS total FROM `expense` WHERE project_id = $project_id";
                                          $select_expense = mysqli_query($connection,$query);  

                                        while($row = mysqli_fetch_assoc($select_expense))
                                            {
                                            $total = $row['total'];
                                          }
                                          ?>
                                          <tr>
                                            <td>Total</td>
                                            <td></td>
                                            <td><?php echo $total;?></td>
                                          </tr>
                                        </tfoot>
                                  </table>
                            </div>
                         </div>
                      </div>
                    </div>
                 </div>
               </div>
             </div>
          </div>           
       </section>
   <?php include "footer.php";?>
   <style type="text/css">
     .table > thead {
      line-height: 0px !importent;
     }
   </style>