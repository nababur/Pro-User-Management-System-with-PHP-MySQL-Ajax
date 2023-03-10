<?php

$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../lib/Session.php');
Session::init();
Session::checkUserSession();
include ($filepath.'/../lib/Database.php');
include ($filepath.'/../helpers/Format.php');

spl_autoload_register(function($class){
  include_once 'app/classes/'.$class.".php";
});

$db = new Database();
$fm = new Format();
$usr = new Users();
$rol = new Roles();
$prm = new Permissions();
$app = new App();
$apa = new AppAutho();
$fr = new Frontend();
$chn = new Changepassword();




 ?>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
header("Pragma: no-cache"); 
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>

<?php 

$userEmail = Session::get('userEmail');
$userid = Session::get('userid');
$rolename =  Session::get("rolename");
 ?>
<?php 
    
      $ChkPermission = $rol->selectPermissionItem($rolename);

        if ($ChkPermission) {
            while ($selecRole = $ChkPermission->fetch_assoc()) {
                
             $list = explode(',', $selecRole['permission_items']);    
                foreach($list as $key => $value) {
                   if ($value == 'Access') {
                       $access = "Access";
                   }
                   elseif ($value == 'Create') {
                       $create = "Create";
                   }
                   elseif ($value == 'Show') {
                       $show = "Show";
                   }
                   elseif ($value == 'Edit') {
                       $edit = "Edit";
                   }
                   elseif ($value == 'Delete') {
                       $delete = "Delete";
                   }
                   elseif ($value == 'Ban/Active user') {
                       $banactive = "Ban/Active user";
                   }
                   elseif ($value == 'User only') {
                       $useronly = "User only";
                   }
                }
        }


            }

?>


<!DOCTYPE html>
<html lang="en">

<head>

   <!--====== Required meta tags ======-->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">

   <?php 

        $header_contents = $fr->selectfrontendpart();
        if ($header_contents) {
          while ($result = $header_contents->fetch_assoc()) {
          

       ?>
   <!--====== Title ======-->
   <title><?php  if (isset($result['title'])) {
        echo $result['title'];
      } ?></title>
   <!--====== Favicon Icon ======-->
   <link rel="shortcut icon" href="<?php  if (isset($result['favicon'])) {
        echo $result['favicon'];
      } else{ echo "assets/images/icons/favicon.png";}?>" type="image/png">
   <?php }} ?>




   <!--====== Google Fonts ======-->
   <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

   <!--====== Material Icons ======-->
   <link rel="stylesheet" href="assets/iconfont/material-icons.css">

   <!--====== datetimepicker Icons ======-->
   <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

   <!--====== select2 css ======-->
   <link rel="stylesheet" href="assets/css/select2.min.css">
   <link rel="stylesheet" href="assets/css/select2-bootstrap.min.css">

   <!-- Icofont Icons css-->
   <link rel="stylesheet" href="assets/icofont/icofont.min.css">


   <!-- dataTables.bootstrap4.min css-->
   <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="screen">

   <!-- Chart.min css-->
   <link href="assets/css/Chart.min.css" rel="stylesheet" media="screen">

   <!-- animate css-->
   <link href="assets/css/animate.css" rel="stylesheet" media="screen">
   <!-- normalize css-->
   <link href="assets/css/normalize.css" rel="stylesheet" media="screen">
   <!--====== Bootstrap css ======-->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">

   <!--====== Style css ======-->
   <link rel="stylesheet" href="assets/css/style.css">
   <!--====== Style css ======-->
   <link rel="stylesheet" href="assets/css/responsive.css">



</head>

<body>

   <!-- Prealoder -->
   <div class="spinner_body">
      <div class="spinner"></div>
   </div>

   <!-- Prealoder -->
   <?php 
    if (isset($_GET['action']) && $_GET['action'] == "logout" && $_GET['sunset'] == "id") {
        $userid = Session::get('userid');
        $update_off = $usr->userActive_OFF($userid);
        $logOut = $usr->userLogOut();
        
    }
 ?>


   <!--====== Start Header Section======-->
   <header>
      <div class="header">


         <div class="navigation">
            <nav class="navbar navbar-expand-lg navbar-bg">

               <div class="brand-logo">
                  <a class="navbar-brand" href="dashboard.php" id="menu-action">
                     <?php 

              $header_contents = $fr->selectfrontendpart();
              if ($header_contents) {
                while ($result = $header_contents->fetch_assoc()) {
                

             ?>
                     <!--====== App Name ======-->
                     <span>
                        <?php if (isset($result['logo'])) { ?>
                        <img width="40" align='middle' src="assets/images/icons/favicon.png" alt="your image"
                           title='' />
                        <?php }else{ ?>
                        <img width="40" align='middle' src="assets/images/icons/favicon.png" alt="your image" title=''>
                        <?php } ?>

                        <?php  if (isset($result['app_name'])) {
              echo $result['app_name'];
            } else{?>
                     </span>
                     <span>Benzi - Admin Panel</span>
                     <?php }} }?>

                  </a>
                  <div id="nav-toggle">
                     <div class="cta">
                        <div class="toggle-btn type1"></div>
                     </div>
                  </div>
               </div>


               <div class="for-mobile d-mobile">
                  <a href="#mobile-authotication" id="mobile-toggle"><span></span></a>

                  <div id="mobile-authotication">
                     <ul>
                        <li>
                           <span><?php 

                       $profilePhoto = Session::get('profilePhoto');
                      
                       if(file_exists($profilePhoto)){ ?>
                              <img width="70" src="<?php echo $profilePhoto; ?>" alt="">
                              <?php }else{?>
                              <img width="70" align='middle' src="app/uploads/userAvatar/dev.jpg" alt="your image"
                                 title='' />
                              <?php } ?>
                           </span>

                        </li>
                        <li><span><strong>Welcome ! </strong><?php echo $userName = Session::get('userName'); ?></span>
                        </li>
                        <li><a href="account.php?myid=<?php echo Session::get("userid")?>">
                              <i class="material-icons">
                                 supervisor_account
                              </i>
                              Account Settings</a></li>
                        <li><a href="?action=logout&&sunset=id"><i class="material-icons pr-1">exit_to_app</i>Logout</a>
                        </li>
                     </ul>
                  </div>
               </div>

               <div class="collapse navbar-collapse pr-3" id="#">




                  <ul class="navbar-nav user-info d-desktop ml-auto mt-2 mt-lg-0">
                     <li class="nav-item dropdown show">
                        <a href="#" class="navbar-nav-link dropdown-toggle text-light" data-toggle="dropdown"
                           aria-expanded="true">
                           <div class="user-photo">
                              <?php 

                       $profilePhoto = Session::get('profilePhoto');
                      
                       if(file_exists($profilePhoto)){ ?>
                              <img width="70" src="<?php echo $profilePhoto; ?>" alt="">
                              <?php }else{?>
                              <img width="70" align='middle' src="app/uploads/userAvatar/dev.jpg" alt="your image"
                                 title='' />
                              <?php } ?>


                           </div>
                           <strong>Welcome ! </strong><?php echo $userName = Session::get('userName'); ?>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">


                           <a href="account.php?myid=<?php echo Session::get("userid")?>" class="dropdown-item">
                              <i class="material-icons">
                                 supervisor_account
                              </i>
                              Account Settings</a>


                           <div class="menu-dropdown-divider"></div>
                           <a class="dropdown-item" href="?action=logout&&sunset=id"><i
                                 class="material-icons">exit_to_app</i>Logout</a>
                        </div>
                     </li>
                  </ul>

               </div>
            </nav>

         </div>
      </div>
   </header>
   <!--====== End Header Section======-->