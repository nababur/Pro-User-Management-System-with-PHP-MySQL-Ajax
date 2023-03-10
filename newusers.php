<?php include 'app/inc/header.php'; ?>


<?php 

// Delete Role By Id 
$delid = isset($_GET['delid']) ? $_GET['delid'] : '';
if (isset($_GET['delid']) && isset($_GET['remove']) == 'removeid') {
    $delid = preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['delid']);
    $deUserByid = $usr->deleteUserById($delid);
}
 ?>

<?php 
// Id disable method 
$disid = isset($_GET['disid']) ? $_GET['disid'] : '';
if(isset($_GET['disid'])){
    $disid = preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['disid']);
    $disableId = $usr->DisableUserById($disid);
}


// Id Enable method 
$enid = isset($_GET['enid']) ? $_GET['enid'] : '';
if(isset($_GET['enid'])){
    $enid = preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['enid']);
    $enableId = $usr->EnableUserById($enid);
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
                 <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">New register user</li>
              </ol>
            </nav>
            <div class="create-item">
               
               <a href="users.php" class="btn btn-secondary"><i class="material-icons md-18">arrow_back</i>Back To Userlist</a>
      

            </div>
        </div>
          <!--  Header BreadCrumb -->  

          <?php 
            if (isset($deUserByid)) {
                echo $deUserByid;
            }
            if (isset($enableId)) {
                echo $enableId;
            }
            if (isset($disableId)) {
                echo $disableId;
            }
           ?>
          <!--  main-content -->   
        <div class="main-content">


        
        <!-- Users DataTable-->
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body mt-3">
                      <div class="table-responsive">
                          <table id="usersTable" class="table table-striped table-borderless" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                               <?php 

                                    $userlist = $usr->newUsers();
                                    if ($userlist) {
                                        $i = 0;
                                        while ($result = $userlist->fetch_assoc()) {
                                            $i++;
                                          

                                 ?>

                                <tr>
                                    <td class="pt-4" <?php if ($result['status'] == '1') { ?>
                                       style='color:red'
                                    <?php } ?>><?php echo $i; ?>
                                        
                                    </td>

                                        <?php 

                                       $avatar =  $result['profilePhoto'];
                                      
                                       if(is_file($avatar)){ ?>
                                         
                                        <td><img id="avatar-css" width="50" height="50" align='middle'src="<?php echo $avatar; ?>"  alt="your image" title=''/></td>
                                      <?php }else{?>
                                        
                                        <td><img id="avatar-css" width="50" height="50" align='middle'src="app/uploads/userAvatar/dev.jpg"  alt="your image" title=''/></td>
                                      <?php } ?>
                                    


                                    <td class="pt-4"><?php echo $result['name']; ?></td>
                                    <td class="pt-4"><?php echo $result['email']; ?></td>
                                    <td class="pt-4"><span class="badge badge-lg badge-secondary text-white"><?php echo $result['rolename']; ?></span></td>
                                    <td class="pt-4">
                                        <?php if ($result['status'] == '0') {?>
                                        <span class="badge badge-lg badge-success text-white">Active</span>
                                        <?php }elseif($result['status'] == '1'){  ?>
                                        <span class="badge badge-lg badge-info text-white">Deactive</span>
                                        <?php } ?>

                                    </td>
                                    <td class="text-center pt-3">
                                        
                                        <a class="btn btn-secondary" href="viewuser.php?viewuser=<?php echo $result['userid']; ?>">&nbspView user&nbsp</a>  
                                        
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure to Delete account ?')" href="?remove=removeid&&delid=<?php echo $result['userid']; ?>">&nbspDelete&nbsp</a></td>
                                </tr>
                              
                                <?php }}else{  ?>

                                    <tr>
                                        <td colspan="6" class="text-center">No new Users yet !</td>
                                    </tr>
                                <?php } ?>

                        </table>
                      </div>
                    </div>
                </div>
            </div>

        </div>

         <!-- Users DataTable-->   






        </div>  
        <!--  main-content -->   
    </div> 

</section>

<!--====== End Main Wrapper Section======-->

<?php include 'app/inc/footer.php'; ?>