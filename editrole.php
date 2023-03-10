<?php include 'app/inc/header.php'; ?>

<?php 


 $roleid = isset($_GET['roleid']) ? $_GET['roleid'] : '';
  if (!isset($roleid) && $roleid == NULL) {
      //header("Location:role.php");
      echo "<script>location.href='role.php';</script>";
      exit();
  }else{
     $roleid = preg_replace('/[^a-zA-Z0-9-]/', '', $roleid);
      $getRol = $rol->editRoleById($roleid);
  }

   

 ?>


<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateRole = $rol->updateUserRole($_POST, $roleid);

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
               <li class="breadcrumb-item"><a href="role.php">Role</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit User Role</li>
            </ol>
         </nav>

      </div>
      <!--  Header BreadCrumb -->
      <!-- Flash Message -->
      <?php if (isset($updateRole)) {
              echo $updateRole;
          } ?>
      <!-- Flash Message -->
      <!-- Create New User -->
      <div class="main-content">

         <div class="card bg-white">
            <div class="card-body mt-5 mb-5">

               <div class="viewuser">
                  <?php 

                        if ($getRol) {
                            
                            while ($result = $getRol->fetch_assoc()) {

                       ?>
                  <form action="" method="POST">
                     <div class="form-group row">
                        <div class="col-md-2">Role Name</div>
                        <div class="col-md-8">
                           <input id="rolename" type="text" class="form-control" readonly="readonly"
                              value="<?php echo $result['rolename']; ?>" autofocus="">

                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-2">Display Name</div>
                        <div class="col-md-8">
                           <input id="roledname" type="text" class="form-control" name="roledname"
                              value="<?php echo $result['roledname']; ?>" autofocus="">

                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-2">Permissions Edit</div>
                        <div class="col-md-8">

                           <!--TAGS-->
                           <div class="form-group">

                              <div>
                                 <select required="readonly" name="permission_items[]" id="select2-example-tags"
                                    class="form-control select-tag-primary" multiple="multiple" style="width: 100%">
                                    <optgroup>


                                       <?php 

                                            $permission_list = $prm->selectAllPermissions();
                                            if ($permission_list) {
                                                
                                                while ($allow = $permission_list->fetch_assoc()) {
                                                   
                                               
                                         $list = explode(',', $result['permission_items']);    
                                         foreach ($list as $item)
                                         {
                                              $item;


                                          echo '<option value="'.$item.'"';

                                            if (in_array($item,$allow)) {
                                              echo 'selected';
                                              echo '>'.$item.'</option>';

                                            }






                                          }

                                         ?>






                                       <?php  } }?>



                                    </optgroup>

                                 </select>

                              </div>
                           </div>

                        </div>
                     </div>


                     <div class="form-group pt-2 row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                           <button class="theme-primary-btn btn btn-success" type="submit" name="update">Update
                              Role</button>
                           <button class="btn btn-warning text-white" type="reset">Reset</button>
                        </div>
                     </div>

                  </form>
                  <?php
        }}else{
          echo "<script>window.location='role.php';</script>";
        }
      ?>

               </div>

            </div>
         </div>
      </div>
      <!-- Create New User-->

      <div class="row mt-3">

         <div class="col-md-12">
            <div class="card ">
               <div class="card-body footer-p">
                  <p>Design and developed by Nababur rahaman send a thanks giving mail or do you want any support :)
                     <a href="mailto:nababurdev@gmail.com">nababurdev@gmail.com</a>
                  </p>
                  <p>Do you want to develop any php or laravel or wordpress project ? send a mail:) <a
                        href="mailto:nababurdev@gmail.com">nababurdev@gmail.com</a> </p>
                  <p>CEO of GridTemaplate: <a target="_blank"
                        href="https://www.gridtemplate.com/">https://www.gridtemplate.com/</a>
                  </p>
                  <p>Connect with Github: <a target="_blank"
                        href="https://github.com/nababur">https://github.com/nababur</a>
                  </p>

               </div>
            </div>
         </div>


      </div>


   </div>
   <!--  main-content -->
   </div>

</section>

<!--====== End Main Wrapper Section======-->

<?php include 'app/inc/footer.php'; ?>