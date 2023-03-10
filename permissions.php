<?php include 'app/inc/header.php'; ?>




<!--====== Start Main Wrapper Section======-->
<section class="d-flex" id="wrapper">
<?php include 'app/inc/sidebar.php'; ?>

    <div class="page-content-wrapper">
       <!--  Header BreadCrumb -->
        <div class="content-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="material-icons">home</i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permissions details</li>
              </ol>
            </nav>

        </div>
          <!--  Header BreadCrumb --> 
      <?php 

      $completeProfile = $usr->profileCompleteNotify($userEmail, $userid);

      if (isset($completeProfile)) {
        echo $completeProfile;
      }

       ?>
          <!-- Create New User -->   
        <div class="main-content">

            <div class="card bg-white">
                <div class="card-body mt-3 mb-3">
                    
                    <div class="permissions">
                        
                        <div class="form-group row">
                            <div class="col-md-2">Permissions</div>
                            <div class="col-md-8">
                                <table class="table table-striped table-bordered">


                                <?php 

                                    $rolelist = $rol->selectAllRole();
                                    if ($rolelist) {
                                        while ($result = $rolelist->fetch_assoc()) {
                                            


                                 ?>

                                    <tr>
                                        <td>
                                            
                                            <?php if ($result['status'] == '1') { ?>
                                            <h5 class="mb-2"><span class="badge badge-warning text-white"><?php echo $result['rolename']; ?></span></h5>
                                            <?php }else{  ?>
                                            <h5 class="mb-2"><span class="badge badge-secondary text-white"><?php echo $result['rolename']; ?></span></h5>
                                            <?php } ?>

                                            <div>
                                                <?php 

                                                 

                                         $list = explode(',', $result['permission_items']);    
                                         foreach ($list as $item)
                                         {
                                            if ($item) { ?>
                                                 <span class="mr-4"><i class="material-icons md-18 text-success">check_circle</i> <?php echo $item; ?></span>
                                            <?php }else{ ?> 
                                       
                                                <span class="mr-4"><i class="material-icons md-18 text-danger">check_circle</i> Nothing</span>

                                            <?php } ?>

                                         <?php }



                                                 ?>

                                           

                                              
                                            </div>
                                        </td>
                                    </tr>


                                <?php }}else{ echo "<script>window.location='permissions.php';</script>"; }?>



                                    
                                </table>
                             </div>
                        </div>

                    </div>

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