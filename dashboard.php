<?php
include "header.php";
include "left-navbar.php";
?>
<section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>
                <div class="pull-right text-center">
                 <a href="create_project.php" ><button type="button"  class="btn btn-primary  btn-sm fa fa-plus float-right" style="float: right;">Add project</button></a>
               </div>Project List
              <!--  <small>Hi, <?php// if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{//header("Location: login-form.php");}?>. Welcome back!</small> -->
            </h3>
<?php
$query = "SELECT project_id,project_name,expense,date_start,date_end,cost_budget,contract_price,project_photo,progress
 FROM `project`";

    $select_events = mysqli_query($connection,$query);  

    
?>


                  <div class="row">
                    <?php 
                        while($row = mysqli_fetch_assoc($select_events))
                        {
                         $project_id = $row['project_id'];
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
                    ?>
                     <div class="col-md-6">
                        <!-- START widget-->
                        <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="100" class="panel widget">
                        <div class="panel-body">
                        <a href="<?php echo 'dashboard2.php?edit='.
                            $project_id.'' ?>">
                            <div class="row">
                          <div class="col-md-6">
                              
                                 <div class="text-left">
                                      <p class="mb0"><h3><?php if(isset($project_name)){echo $project_name;}?></h3></p>
                                      <strong><p class="text-muted"><?php if(isset($newDate_event)){echo $newDate_event;}?> - <?php if(isset($newDate_end)){echo $newDate_end;}?> </p></strong>
                                      <div class="progress progress-striped progress-xs">
                                               <div role="progressbar" aria-valuenow="<?php if(isset($progress)){echo $progress;}?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-purple progress-<?php if(isset($progress)){echo $progress;}?>">
                                                  <span class="sr-only"><?php if(isset($progress)){echo $progress;}?>% Complete</span>
                                               </div>
                                            </div>
                                    <div class="progress progress-striped progress-xs">
                                       <div role="progressbar" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100" class="<?php echo 'progress-bar progress-bar-warning progress-'.$progress ?>">
                                          <span class="sr-only">60% Complete</span>
                                       </div>
                                    </div>
                                    </div>
                                 
                                </div>
                                  <div class="col-md-6 text-right">
                                      <table>
                                        <tbody>
                                           <tr style="color: red;">
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
                              </div></a>
                              <div class="row">
                               <div class="col-md-6">
                                  <div class=" text-left">
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
                                    <div class="form-group" style="position: relative;" >
                                    <span class="img-div">
                                     <div class="text-center img-placeholder"  onClick="triggerClick()">
                                      </div>
                                     <img src="<?php if(isset($project_photo)){echo $project_photo;}?>" width="100" height="100" alt=""  id="profileDisplay">
                                      </span>      
                                     </div>
                                  </div>
                                </div>
                                </div>
                              <div class="col-md-6">
                                 <div class="text-center" style=" padding-top: 51px;padding-right: 89px;">
                                 <!--  <button><em class="fa fa-phone-square" ></em></button> -->&nbsp;&nbsp;&nbsp;
                                 <a href=""></a><button class="btn btn-purple text-right "><em class="fa fa-plus"></em></button>  
                               </div> 
                                </div>
                              </div>
                    </div>
                  </div>
                </div>
                  <!-- START chart-->
                  
               <!-- END dashboard sidebar-->
           
        
         <?php 
          }  
         ?>
         </div>
          </div>
          <style type="text/css">
            .back-to-top {
        position: fixed;
        display: none;
        background: #50d8af;
        color: #fff;
        padding: 6px 12px 9px 12px;
        font-size: 16px;
        border-radius: 2px;
        right: 15px;
        bottom: 15px;
        transition: background 0.5s;
        }
          </style>
          <a href="#" class="back-to-top" style="display: inline;"><i class="fa fa-chevron-up"></i></a>
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
 
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <?php include "footer.php";?>