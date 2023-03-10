<?php include 'app/inc/header.php'; ?>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createrole'])) {
    $addRole = $rol->addNewRole($_POST);

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
               <li class="breadcrumb-item active" aria-current="page">Add new role</li>
            </ol>
         </nav>
         <div class="create-item">
            <a href="createrole.php" class="theme-primary-btn btn btn-primary"><i class="material-icons">add</i>Add New
               Role</a>
         </div>
      </div>
      <!--  Header BreadCrumb -->
      <!-- Flash Message -->
      <?php if (isset($addRole)) {
              echo $addRole;
          } ?>
      <!-- Flash Message -->
      <!-- Create New User -->
      <div class="main-content">

         <div class="card bg-white">
            <div class="card-body mt-5 mb-5">

               <div class="viewuser">

                  <form action="" method="POST">
                     <div class="form-group row">
                        <div class="col-md-2">Role Name</div>
                        <div class="col-md-8">
                           <input id="rolename" type="text" placeholder="Add new role" class="form-control"
                              name="rolename" value="" autofocus="">

                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-2">Display Name</div>
                        <div class="col-md-8">
                           <input id="roledname" type="text" placeholder="Display Name" class="form-control"
                              name="roledname" value="" autofocus="">

                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-2">Permissions Item</div>
                        <div class="col-md-8">

                           <!--TAGS-->
                           <div class="form-group">

                              <div>
                                 <select name="permission_items[]" id="select2-example-tags"
                                    class="form-control select-tag-primary" multiple="multiple" style="width: 100%">
                                    <optgroup>
                                       <?php 

                                            $permission_list = $prm->selectAllPermissions();
                                            if ($permission_list) {
                                                
                                                while ($allow = $permission_list->fetch_assoc()) {
                                                   
                                                  

                                         ?>
                                       <option value="<?php echo $allow['per_access']; ?>">
                                          <?php echo $allow['per_access']; ?></option>
                                       <option value="<?php echo $allow['per_create']; ?>">
                                          <?php echo $allow['per_create']; ?></option>
                                       <option value="<?php echo $allow['per_show']; ?>">
                                          <?php echo $allow['per_show']; ?></option>
                                       <option value="<?php echo $allow['per_edit']; ?>">
                                          <?php echo $allow['per_edit']; ?></option>
                                       <option value="<?php echo $allow['per_delete']; ?>">
                                          <?php echo $allow['per_delete']; ?></option>
                                       <option value="<?php echo $allow['ban_activ_user']; ?>">
                                          <?php echo $allow['ban_activ_user']; ?></option>
                                       <option value="<?php echo $allow['per_onlyUser']; ?>">
                                          <?php echo $allow['per_onlyUser']; ?></option>


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
                           <button class="theme-primary-btn btn btn-success" type="submit" name="createrole">Create
                              role</button>
                           <button class="btn btn-warning text-white" type="reset">Reset</button>
                        </div>
                     </div>

                  </form>

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