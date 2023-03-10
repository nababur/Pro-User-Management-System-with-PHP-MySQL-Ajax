<?php

$filepath = realpath(dirname(__FILE__));
include ($filepath.'/app/lib/Session.php');
Session::init();
Session::checkUserLogin();
include ($filepath.'/app/lib/Database.php');

spl_autoload_register(function($class){
  include_once 'app/classes/'.$class.".php";
});

$db = new Database();
$usr = new Users();
$fr = new Frontend();



 ?>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
header("Pragma: no-cache"); 
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
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

   <!-- animate css-->
   <link href="assets/css/animate.css" rel="stylesheet" media="screen">

   <!-- Icofont Icons css-->
   <link rel="stylesheet" href="assets/icofont/icofont.min.css">

   <!-- normalize css-->
   <link href="assets/css/normalize.css" rel="stylesheet" media="screen">
   <!--====== Bootstrap css ======-->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">

   <!--====== Style css ======-->
   <link rel="stylesheet" href="assets/css/authotication.css">
   <!--====== Style css ======-->
   <link rel="stylesheet" href="assets/css/responsive.css">


</head>

<body>

   <!-- Prealoder -->
   <div class="spinner_body">
      <div class="spinner"></div>
   </div>

   <!-- Prealoder -->





   <!--====== Start Main Wrapper Section======-->
   <div class="wrap">
      <!-- page BODY -->
      <!-- ========================================================= -->
      <div class="page-body animated slideInDown">
         <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
         <!--LOGO-->
         <div class="login-text">
            <?php 

        $header_contents = $fr->selectfrontendpart();
        if ($header_contents) {
          while ($result = $header_contents->fetch_assoc()) {
          

       ?>
            <!--====== Title ======-->
            <h3 class="text-center"><?php  if (isset($result['front_name'])) {
        $front_name = $result['front_name'];
        if (isset($front_name)) {
           $words=str_word_count($front_name, 1);
        echo "<span class='benzi'>$words[0]</span>".' '.$words[1].' '.$words[2].' '.$words[3].' '.$words[4];
        }
        

      } ?></h3>
            <!--====== Favicon Icon ======-->



            <?php }} else{?>

            <h3 class="text-center">
               <span class="benzi">BENZI</span> - Login/User Management
            </h3>
            <?php } ?>
         </div>
         <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
               <div class="panel-content bg-scale-0">
                  <form method="POST" id="register_user" action="" role="form">
                     <div class="form-group mt-md">
                        <div id="msg"></div>
                        <?php if (isset($register)) {
                               echo $register;
                           }
                           
                           
                           
                           ?>
                     </div>
                     <div class="form-group mt-md">
                        <span class="input-with-icon">
                           <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                           <i class="icofont-ui-user"></i>
                        </span>
                     </div>
                     <div class="form-group mt-md">
                        <span class="input-with-icon">
                           <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                           <i class="icofont-email"></i>
                        </span>
                     </div>
                     <div class="form-group">
                        <span class="input-with-icon">
                           <input type="password" name="password" class="form-control" id="password"
                              placeholder="Password">
                           <i class="icofont-lock"></i>
                        </span>
                     </div>
                     <div class="form-group">
                        <span class="input-with-icon">
                           <input type="text" class="form-control" name="confirm_password" id="confirm_password"
                              placeholder="Confirm Password">
                           <i class="icofont-unlock"></i>
                        </span>
                     </div>
                     <div class="form-group">
                        <div class="checkbox-custom checkbox-primary">
                           <a href="#">Pleaes check before Terms and Conditions...</a>
                        </div>
                     </div>
                     <div class="form-group">
                        <button class="btn theme-primary-btn btn-primary btn-block" type="submit"
                           name="register">Register</button>
                     </div>
                     <div class="form-group text-center">
                        Have an account? <a href="login.php">Sign In</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
      </div>
   </div>
   <!--====== End Main Wrapper Section======-->




   <!--====== JQuery from CDN ======-->
   <script src="assets/js/jquery.min.js"></script>

   <!--====== Bootstrap js ======-->
   <script src="assets/js/bootstrap.min.js"></script>
   <script src="assets/js/popper.min.js"></script>

   <!--====== datepicker js ======-->
   <script src="assets/js/moment-with-locales.min.js"></script>
   <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

   <!--====== select2.min.js ======-->
   <script src="assets/js/select2.min.js"></script>

   <!--====== dataTables js ======-->
   <script src="assets/js/dataTables.bootstrap4.min.js"></script>
   <script src="assets/js/jquery.dataTables.min.js"></script>

   <!--====== Chart.min js ======-->
   <script src="assets/js/Chart.bundle.min.js"></script>

   <!--====== wow.min js ======-->
   <script src="assets/js/wow.min.js"></script>
   <!--====== Main js ======-->
   <script src="assets/js/script.js"></script>


</body>

</html>