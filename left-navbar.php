<?php 
include "dbcon.php";
include "session.php";
?>

<aside class="aside">
         <!-- START Sidebar (left)-->
         <nav class="sidebar">
            <!-- START user info-->
            
               <!-- User picture-->
           
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
                  <a href="dashboard.php" title="Projects" data-toggle="" class="no-submenu">
                     <em class="fa fa-calendar"></em>
                     <span class="item-text">Projects</span>
                  </a>
                  </li>
                  <li class="active">
                  <a href="categorylist.php" title="Expense Categories" data-toggle="" class="no-submenu">
                     <em class="fa fa-list"></em>
                     <span class="item-text">Expense Categories</span>
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