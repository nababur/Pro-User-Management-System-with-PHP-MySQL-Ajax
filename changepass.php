<?php include 'app/inc/header.php'; ?>


<?php 

$userid = Session::get("userid");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {

  $updatepass = $chn->updatePassword($userid, $_POST);
}



 ?>


<!--====== Start Main Wrapper Section======-->
<section class="d-flex" id="wrapper">
  
<?php include 'app/inc/sidebar.php'; ?>

    <div class="page-content-wrapper">


       <!--  Header BreadCrumb -->
        <div class="content-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="material-icons">home</i>Home</a></li>
              
                
               <li class="breadcrumb-item active" aria-current="page">Password change</li>
              </ol>
            </nav>
            <div class="create-item">

              <a href="dashboard.php" class="btn btn-secondary"><i class="material-icons md-18">arrow_back</i>Back To Home</a>
            </div>
        </div>
          <!--  Header BreadCrumb -->  
        <?php 

          if (isset($updatepass)) {
              echo $updatepass;
                
          } 

         ?>  
          <!-- Create New User -->   
        <div class="main-content">

            <div class="card bg-white">
                <div class="card-body mt-5 mb-5">
                    
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <div class="form-group row">
                            <div class="col-md-2">Old Password</div>
                            <div class="col-md-4">
                                <input id="old_password" type="password" placeholder="Please enter old Password" class="form-control" name="old_password"  autofocus="">

                             </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">New Password</div>
                            <div class="col-md-4">
                                <input id="new_password" type="password" placeholder="Please enter new Password" class="form-control" name="new_password" autofocus="">

                             </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">Retype Password</div>
                            <div class="col-md-4">
                                <input id="confirm_password" type="text" placeholder="Please confirm new Password" class="form-control" name="confirm_password"  autofocus="">

                             </div>
                        </div>

                        <div class="form-group pt-2 row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <button class="theme-primary-btn btn btn-success" type="submit" name="changepass">Update Password</button>
                                <button class="btn btn-warning text-white" type="reset">Reset</button>
                             </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
         <!-- Create New User-->   



        </div>  
        <!--  main-content -->   
    </div> 

</section>

<!--====== End Main Wrapper Section======-->

<?php include 'app/inc/footer.php'; ?>