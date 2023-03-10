  <!--   Left Sidebar  -->
      <aside>
        <div class="left-sidebar" id="wrapper-sidebar">
          <ul>
              <?php if ( isset($access) == '$access' ) { ?>
            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'dashboard') {
                  echo " class='active' ";
                }

               ?>
             href="dashboard.php"><i class="material-icons">dashboard</i><span>Dashboard</span></a></li>
            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'users') {
                  echo " class='active' ";
                }elseif ($current == 'adduser') {
                  echo " class='active' ";
                }elseif ($current == 'viewuser') {
                  echo " class='active' ";
                }elseif ($current == 'editprofile') {
                  echo " class='active' ";
                }elseif ($current == 'newusers') {
                  echo " class='active' ";
                }elseif ($current == 'activeusers') {
                  echo " class='active' ";
                }elseif ($current == 'bandusers') {
                  echo " class='active' ";
                }

               ?>
             href="users.php"><i class="material-icons">supervisor_account</i><span>Users</span></a></li>
           

            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'role') {
                  echo " class='active' ";
                }elseif ($current == 'editrole') {
                  echo " class='active' ";
                }elseif ($current == 'createrole') {
                  echo " class='active' ";
                }


               ?>
             href="role.php"><i class="material-icons">perm_data_setting</i><span>Rolse</span></a></li>


            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'permissions') {
                  echo " class='active' ";
                }

               ?>
             href="permissions.php"><i class="material-icons">lock_open</i><span>Permissions</span></a></li>
            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'settings') {
                  echo " class='active' ";
                }

               ?>


             href="settings.php"><i class="material-icons">settings</i><span>General Settings</span></a></li>

             
           <?php }else{ ?>
            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'dashboard') {
                  echo " class='active' ";
                }elseif ($current == 'newusers') {
                  echo " class='active' ";
                }elseif ($current == 'activeusers') {
                  echo " class='active' ";
                }elseif ($current == 'bandusers') {
                  echo " class='active' ";
                }

               ?>
             href="dashboard.php"><i class="material-icons">dashboard</i><span>Dashboard</span></a></li>
            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'users') {
                  echo " class='active' ";
                }elseif ($current == 'adduser') {
                  echo " class='active' ";
                }elseif ($current == 'viewuser') {
                  echo " class='active' ";
                }elseif ($current == 'editprofile') {
                  echo " class='active' ";
                }elseif ($current == 'newusers') {
                  echo " class='active' ";
                }elseif ($current == 'activeusers') {
                  echo " class='active' ";
                }elseif ($current == 'bandusers') {
                  echo " class='active' ";
                }

               ?>
             href="users.php"><i class="material-icons">supervisor_account</i><span>Users</span></a></li>
            <li><a
              <?php 

                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'permissions') {
                  echo " class='active' ";
                }

               ?>
             href="permissions.php"><i class="material-icons">lock_open</i><span>Permissions</span></a></li>
              <?php } ?>
            </ul>
        </div>  
      </aside>
  <!--   Left Sidebar  -->