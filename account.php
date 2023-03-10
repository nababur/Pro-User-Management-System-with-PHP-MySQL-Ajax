<?php include 'app/inc/header.php'; ?>


<?php 

$myid = isset($_GET['myid']) ? $_GET['myid'] : '';
  if (!isset($myid) && $myid == NULL) {
      //header("dashboard.php");
      echo "<script>location.href='dashboard.php';</script>";
      exit();

  }else{
    $myid = preg_replace('/[^a-zA-Z0-9-]/', '', $myid);
    $myprofile = $usr->getUserById($myid);
  }

   

 ?>


<!--====== Start Main Wrapper Section======-->
<section class="d-flex" id="wrapper">

   <?php include 'app/inc/sidebar.php'; ?>

   <div class="page-content-wrapper">

      <?php 

            if ($myprofile) {
                
                while ($result = $myprofile->fetch_assoc()) {

           ?>

      <!--  Header BreadCrumb -->
      <div class="content-header">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="dashboard.php"><i class="material-icons">home</i>Home</a></li>
               <?php if ( isset($edit) == '$edit') { ?>
               <li class="breadcrumb-item"><a href="editprofile.php?edituser=<?php echo Session::get("userid")?>">My
                     profile</a></li>
               <?php } ?>

               <li class="breadcrumb-item active" aria-current="page"><?php echo $result['name']; ?></li>
            </ol>
         </nav>
         <div class="create-item">

            <?php if ( isset($edit) == '$edit') { ?>
            <a href="editprofile.php?edituser=<?php echo Session::get("userid")?>"
               class="theme-primary-btn btn btn-primary"><i class="material-icons">add</i>Edit profile</a>
            <a href="changepass.php" name='export' class=" btn btn-secondary"><i class="material-icons">add</i>Password
               change</a>
            <?php } ?>



         </div>
      </div>
      <!--  Header BreadCrumb -->
      <!-- Create New User -->
      <div class="main-content">

         <div class="card bg-white">
            <div class="card-body mt-3 mb-5">

               <div class="viewuser row">

                  <div class="col-md-6">
                     <div class="form-group row">
                        <div class="user-thumb d-mobile">


                           <?php 

                                   $photo_u =  $result['profilePhoto'];
                                  
                                   if(file_exists($photo_u)){ ?>
                           <img id="profile-photo" src="<?php echo $photo_u; ?>" alt="">
                           <?php }else{?>
                           <img id="profile-photo" align='middle' src="app/uploads/userAvatar/dev.jpg" alt="your image"
                              title='' />
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">Name</div>
                        <div class="col-md-8">
                           <?php echo $result['name']; ?>

                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-4">Phone number</div>
                        <div class="col-md-8">
                           <?php echo $result['phone']; ?>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-4">Address</div>
                        <div class="col-md-8">
                           <?php echo $result['address']; ?>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-4">About myself</div>
                        <div class="col-md-8">
                           <?php echo $result['information']; ?>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-4">City</div>
                        <div class="col-md-8">
                           <?php echo $result['city']; ?>

                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">Contry</div>
                        <div class="col-md-8">
                           <?php echo $result['country']; ?>

                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-4">E-Mail Address</div>
                        <div class="col-md-8">
                           <?php echo $result['email']; ?>

                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-4">Role</div>
                        <div class="col-md-8">
                           <span
                              class="badge badge-lg badge-secondary text-white"><?php echo $result['rolename']; ?></span>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">Status</div>
                        <div class="col-md-8">
                           <?php if ($result['status'] == '0') {?>
                           <span class="badge badge-lg badge-success text-white">Active</span>
                           <?php }elseif($result['status'] == '1'){  ?>
                           <span class="badge badge-lg badge-warning text-white">Deactive</span>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">Gendar</div>
                        <div class="col-md-8">
                           <?php if ($result['gendar'] == 'male') {?>
                           <span class="badge badge-lg badge-secondary text-white">Male</span>
                           <?php }elseif($result['gendar'] == 'female'){  ?>
                           <span class="badge badge-lg badge-secondary text-white">Female</span>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-4">Account created</div>
                        <div class="col-md-8">

                           <span
                              class="badge badge-lg badge-dark"><?php echo $fm->formatDate($result['create_date']); ?></span>

                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 d-desktop">
                     <div class="user-thumb">


                        <?php 

                                 $photo_u =  $result['profilePhoto'];
                                
                                 if(file_exists($photo_u)){ ?>
                        <img id="profile-photo" src="<?php echo $photo_u; ?>" alt="">
                        <?php }else{?>
                        <img id="profile-photo" align='middle' src="app/uploads/userAvatar/dev.jpg" alt="your image"
                           title='' />
                        <?php } ?>
                     </div>

                  </div>



               </div>

            </div>
         </div>
      </div>
      <!-- Create New User-->


      <?php
        }}else{
          echo "<script>window.location='dashboard.php';</script>";
        }
      ?>

   </div>
   <!--  main-content -->
   </div>

</section>

<!--====== End Main Wrapper Section======-->

<?php include 'app/inc/footer.php'; ?>