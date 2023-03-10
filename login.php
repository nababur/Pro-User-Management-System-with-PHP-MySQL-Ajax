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


   <?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $chkUserLogin = $usr->userLoginAuthotication($_POST);

}


 ?>


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
               <span class="benzi">BENZIN</span> - Login/User Management
            </h3>
            <?php } ?>




         </div>
         <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
               <div class="panel-content bg-scale-0">
                  <form action="" method="post" id="login-user">
                     <div class="form-group mt-md">
                        <?php if (isset( $chkUserLogin)) {
                               echo  $chkUserLogin;
                           } ?>

                     </div>
                     <div class="form-group mt-md">
                        <span class="input-with-icon">
                           <?php if(isset($_COOKIE["email"])) {  ?>
                           <input type="email" class="form-control" name="email" id="email"
                              value="<?php echo $_COOKIE["email"]; ?>">
                           <?php }else{ ?>
                           <input type="email" class="form-control" name="email" id="email"
                              placeholder="Enter your E-Mail ...">
                           <?php } ?>
                           <i class="icofont-email"></i>
                        </span>
                     </div>
                     <div class="form-group">
                        <span class="input-with-icon">
                           <?php if(isset($_COOKIE["password"])) {  ?>
                           <input type="password" class="form-control" name="password" id="password"
                              value="<?php echo $_COOKIE["password"]; ?>">
                           <?php }else{ ?>
                           <input type="password" class="form-control" name="password" id="password"
                              placeholder="Enter your Password ...">
                           <?php } ?>



                           <i class="icofont-lock"></i>
                        </span>
                     </div>
                     <div class="form-group">
                        <div class="checkbox-custom checkbox-primary">
                           <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["email"])) { ?>
                              checked <?php } ?> />
                           <label class="check" for="remember">Remember me</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="login" id="login"
                           class="btn text-white theme-primary-btn btn-primary btn-block">Sign In</button>
                     </div>
                     <div class="form-group text-center">
                        <a href="reset-password.php">Forgot password?</a>
                        <hr />
                        <div class="social-login">
                           <div class="test">
                              <a class="fb" data-toggle="modal" href="#warning-modal"><i
                                    class="icofont-facebook"></i></a>

                              <a class="tw" data-toggle="modal" href="#warning-modal"><i
                                    class="icofont-twitter"></i></a>

                              <a class="gl" data-toggle="modal" href="#warning-modal"><i
                                    class="icofont-google-plus"></i></a>

                              <a class="gt" data-toggle="modal" href="#warning-modal"><i class="icofont-github"></i></a>

                           </div>
                        </div>
                        <hr />
                        <span>Don't have an account?</span>
                        <a href="register.php" class="  mt-sm">Register</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
      </div>
   </div>
   <!--====== End Main Wrapper Section======-->
   <!--Start Reset Password Modal Form  -->
   <div class="modal mymodal fade" data-easein="swing" data-backdrop="static" data-keyboard="false" id="warning-modal"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <!-- form heading -->
               <div class="row">
                  <div class="subscribe-icon text-center">
                     <span><i class="icofont-unlock"></i></span>
                  </div>
               </div>
               <div class="row">
                  <div class="form-title text-center">
                     <h3>Order Pro Version</h3>
                  </div>
               </div>
               <div class="row">
                  <div class="form-title text-center">
                     <div id="client_msg"></div>
                     <?php if (isset($clientMsg)) {
                               echo $clientMsg;
                           } ?>

                  </div>
               </div>

               <!-- form heading -->
               <!-- Start Login form -->
               <form id="proposal" method="POST" action="" role="form">

                  <!-- Start row -->
                  <div class="row">
                     <div class="col form-group mt-md">
                        <input type="text" name="client_name" id="client_name" class="form-control"
                           placeholder="Your name please" required="required">
                     </div>
                  </div>
                  <!-- End row -->
                  <!-- Start row -->
                  <div class="row">
                     <div class="col form-group mt-md">
                        <input type="email" name="client_email" id="client_email" class="form-control"
                           placeholder="Your E-mail please" required="required">
                     </div>
                  </div>
                  <!-- End row -->
                  <!-- Start row -->
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label for="client_budget">Your Budget Please</label>
                           <select class="form-control" name="client_budget" id="client_budget">
                              <option>$ 30</option>
                              <option>$ 50</option>
                              <option>$ 100</option>
                              <option>$ 150</option>
                              <option>$ 200</option>
                              <option>$ 300</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <!-- End row -->
                  <!-- Start row -->
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label for="frameworks">Software Framework</label>
                           <select class="form-control" name="frameworks" id="frameworks">
                              <option>Core PHP </option>
                              <option>CodeIgniter</option>
                              <option>Laravel</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <!-- End row -->

                  <!-- Start row -->
                  <div class="row text-center">
                     <div class="col">
                        <div class="form-group text-center">
                           <button type="submit" name="submit_proposal"
                              class="btn text-white theme-primary-btn btn-primary btn-block">Send</button>
                        </div>
                     </div>


                  </div>
                  <!-- End row -->
                  <div class="default-space-20"></div>
               </form>
               <!-- Start Login form -->
            </div>

         </div>
      </div>
   </div>
   <!-- End Reset Password Modal Form  -->



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
   <script src="assets/js/plugins.js"></script>
   <script src="assets/js/script.js"></script>
   <script>
   //Client Proposal 
   $("#proposal").on('submit', function(event) {
      event.preventDefault();



      var name = $("#client_name").val();
      var email = $("#client_email").val();
      var budget = $("#client_budget").val();
      var frameworks = $("#frameworks").val();

      var dataString = 'name=' + name + '&email=' + email + '&budget=' + budget + '&frameworks=' + frameworks;

      if (dataString != '') {
         // Email login Authotication
         $.ajax({
            url: "app/ajax-classes/client_budget.php",
            type: "POST",
            data: dataString,
            async: false,
            success: function(data) {
               $("#client_msg").html(data);
               $("#flash-msg").delay(8000).fadeOut("slow");
               //$('.mymodal').hide().delay(9000).fadeOut("slow");
            }

         });


      }


      return false;
   });
   </script>



</body>

</html>