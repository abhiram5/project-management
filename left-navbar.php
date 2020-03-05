<?php 
include "header.php";
include "session.php";
?>

<aside class="aside">
         <!-- START Sidebar (left)-->
         <nav class="sidebar">
            <!-- START user info-->
            <div class="item user-block">
               <!-- User picture-->
               <div class="user-block-picture">
                  <div class="user-block-status">
                     <?php
                     if($role_name == 'Teacher')
                     {
                     $results = mysqli_query($connection, "SELECT teacher_image FROM teachers where teacher_id = $i_id");
                            $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                              foreach ($users as $user):
                              ?>
                             <img src="<?php if($user['teacher_image']){ echo 'app/img/user/' . $user['teacher_image'];}else { echo 'app/img/user/' .'avatar.jpg';}?>" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                              <?php endforeach;
                              }
                              else
                              {
                            $results = mysqli_query($connection, "SELECT student_image FROM students where student_id = $i_id");
                            $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                              foreach ($users as $user):
                              ?>
                             <img src="<?php if($user['student_image']){ echo 'app/img/user/' . $user['student_image'];}else { echo 'app/img/user/' .'avatar.jpg';}?>" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle">
                              <?php endforeach;
                              }
                               ?>
                     <!-- <img src="app/img/user/14.jpg" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle"> -->
                     <div class="circle circle-success circle-lg"></div>
                  </div>
                  <!-- Status when collapsed-->
               </div>
               <!-- Name and Role-->
               <div class="user-block-info">
                  <span class="user-block-name item-text">Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?></span>
                  <span class="user-block-role"><a href="logout.php">Logout</a></span>
               </div>
            </div>
            <!-- END user info-->
            <ul class="nav">
               <!-- START Menu-->
               <li class="active">
                 <!--  <a href="dashboard.php" title="Dashboard" data-toggle="collapse-next" class="no-submenu">
                     <em class="fa fa-tachometer"></em>
                     <span class="item-text">Dashboard</span>
                  </a> -->
                   <a href="dashboard.php" title="Dashboard" data-toggle="" class="no-submenu">
                           <em class="fa fa-tachometer"></em>
                           <span class="item-text">Dashboard</span>
                        </a>
                  </li>
                  <li class="active">
                  <a href="events-datatable.php" title="Events" data-toggle="" class="no-submenu">
                     <em class="fa fa-calendar"></em>
                     <span class="item-text">Events</span>
                  </a>
                  </li>
                  <li class="active">
                  <a href="class-datatable.php" title="Classes" data-toggle="" class="no-submenu">
                     <em class="fa fa-list"></em>
                     <span class="item-text">Classes</span>
                  </a>
                  </li>
                  <li class="active">
                  <a href="student-datatable.php" title="Students" data-toggle="" class="no-submenu">
                     <em class="fa fa-book"></em>
                     <span class="item-text">Students</span>
                  </a>
                  </li>
                   <li class="active">
                  <a href="profile.php" title="Profile" data-toggle="" class="no-submenu">
                     <em class="fa fa-user"></em>
                     <span class="item-text">Profile</span>
                  </a>
                  </li>
               
            </ul>
         </nav>
         <!-- END Sidebar (left)-->
      </aside>