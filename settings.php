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
               <li class="breadcrumb-item active" aria-current="page">General settings</li>
            </ol>
         </nav>
      </div>
      <!--  Header BreadCrumb -->

      <?php 



    




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['app-update'])) {
    $app_id =  preg_replace('/[^a-zA-Z0-9-]/', '', $_POST['app_id']);
    $app_update = $app->updateAppSettings($_POST, $_FILES, $app_id);

    if (isset($app_update)) {
      echo $app_update;
    }


}


 ?>
      <div id="msg"></div>
      <!-- Create New User -->
      <div class="main-content">

         <div class="card bg-white">
            <div class="card-body mt-3 mb-3">
               <div class="geleral-settings">
                  <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#app-setting">App Settings</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#authotication" role="tab"
                           aria-controls="profile" aria-selected="false">Auth Authoticaion</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">

                     <div class="tab-pane fade show active" id="app-setting" role="tabpanel" aria-labelledby="home-tab">

                        <?php 

                              $getApp = $app->selectAllAppSettings();
                              if ($getApp) {
                                  while ($appResult = $getApp->fetch_assoc()) {
                                  

                           ?>

                        <form action="" method="POST" enctype="multipart/form-data">


                           <div class="form-group row">
                              <div class="col-md-2 text-right">App Name</div>
                              <div class="col-md-4">
                                 <input id="app_name" type="text" value="<?php echo $appResult['app_name']; ?>"
                                    class="form-control" name="app_name" autofocus="">

                              </div>
                           </div>


                           <div class="form-group row">
                              <div class="col-md-2 text-right">App Title</div>
                              <div class="col-md-4">
                                 <input id="title" type="text" value="<?php echo $appResult['title']; ?>"
                                    class="form-control" name="title" autofocus="">

                              </div>
                           </div>

                           <div class="form-group row">
                              <div class="col-md-2 text-right">Front-end app Name</div>
                              <div class="col-md-4">
                                 <input id="front_name" type="text" value="<?php echo $appResult['front_name']; ?>"
                                    class="form-control" name="front_name" autofocus="">

                              </div>
                           </div>

                           <div class="form-group row">
                              <div class="col-md-2 pt-5 text-right">Upload favicon</div>
                              <div class="col-md-4">
                                 <div class="set_thumb">

                                    <div id='settings-favicon'>
                                       <?php if (file_exists($appResult['favicon'])) { ?>
                                       <img id="preview-favicon" align='middle'
                                          src="<?php echo $appResult['favicon']; ?>" alt="your image" title='' />
                                       <?php } else{?>
                                       <img id="preview-favicon" align='middle' src="assets/images/icons/favicon.png"
                                          alt="your image" title='' />
                                       <?php } ?>
                                    </div>
                                    <div class="fileUploadInput">
                                       <input type="file" name="favicon" id="file-input-favicon" />
                                       <button class="input-file-btn"><i class="material-icons"> cloud_upload
                                          </i></button>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="form-group row">
                              <div class="col-md-2 pt-5 text-right">Upload Website Logo</div>
                              <div class="col-md-4">
                                 <div class="set_thumb">

                                    <div id='settings-logo'>

                                       <?php if (file_exists($appResult['logo'])) { ?>
                                       <img id="preview-thumb" align='middle' src="<?php echo $appResult['logo']; ?>"
                                          alt="your image" title='' />
                                       <?php } else{?>
                                       <img id="preview-thumb" align='middle' src="assets/images/icons/favicon.png"
                                          alt="your image" title='' />
                                       <?php } ?>

                                    </div>
                                    <div class="fileUploadInput">
                                       <input type="file" name="logo" id="file-input-logo" />
                                       <button class="input-file-btn"><i class="material-icons"> cloud_upload
                                          </i></button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group pt-2 row">
                              <div class="col-md-2"></div>
                              <div class="col-md-4">
                                 <input type="hidden" id="app_id" name="app_id"
                                    value="<?php echo $appResult['app_id']; ?>">
                                 <button class="theme-primary-btn btn btn-success" name="app-update"
                                    type="submit">Update settings</button>

                              </div>
                           </div>



                        </form>
                        <?php }} ?>


                     </div>


                     <div class="tab-pane fade" id="authotication" role="tabpanel" aria-labelledby="profile-tab">
                        <?php 
                                    $getAppid = $apa->selectOnlyAppId();
                                    if ( $getAppid) {
                                        while ($getApp =  $getAppid->fetch_assoc()) {
                                        
                                ?>
                        <form id="allow_authotication" action="" method="POST">

                           <div class="form-group email-user row">
                              <div class="col-md-3 text-right">Allow Registration - E-Mail</div>
                              <div class="col-md-4">
                                 <div class="checkbox">

                                    <div id="switch-btn">
                                       <label class="switch">
                                          <input type="checkbox" name="allow_email" id="allow_email" <?php if ($getApp['allow_email'] == '1') {
                                               echo 'checked="checked"';
                                              } ?>>
                                          <span class="slider round"></span>
                                       </label>
                                    </div>

                                    <input type="hidden" name="hidden_email" id="hidden_email"
                                       value="<?php echo $getApp['allow_email']; ?>" />

                                 </div>


                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-md-3 text-right">Allow Login from - Facebook</div>
                              <div class="col-md-4">
                                 <div id="switch-btn">
                                    <label class="switch">
                                       <input type="checkbox" name="fb_autho" id="fb_autho" <?php if ($getApp['fb_autho'] == '1') {
                                               echo 'checked="checked"';
                                              } ?>>
                                       <span class="slider round"></span>
                                    </label>
                                 </div>
                                 <input type="hidden" name="hidden_facebook" id="hidden_facebook"
                                    value="<?php echo $getApp['fb_autho']; ?>" />
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-md-3 text-right">Allow Login from - Twitter</div>
                              <div class="col-md-4">
                                 <div id="switch-btn">
                                    <label class="switch">
                                       <input type="checkbox" name="tw_autho" id="tw_autho" <?php if ($getApp['tw_autho'] == '1') {
                                               echo 'checked="checked"';
                                              } ?>>
                                       <span class="slider round"></span>
                                    </label>
                                 </div>
                                 <input type="hidden" name="hidden_twitter" id="hidden_twitter"
                                    value="<?php echo $getApp['tw_autho']; ?>" />
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-md-3 text-right">Allow Login from - Google</div>
                              <div class="col-md-4">
                                 <div id="switch-btn">
                                    <label class="switch">
                                       <input type="checkbox" name="gle_autho" id="gle_autho" <?php if ($getApp['gle_autho'] == '1') {
                                               echo 'checked="checked"';
                                              } ?>>
                                       <span class="slider round"></span>
                                    </label>
                                 </div>
                                 <input type="hidden" name="hidden_google" id="hidden_google"
                                    value="<?php echo $getApp['gle_autho']; ?>" />
                              </div>
                           </div>

                           <div class="form-group row">
                              <div class="col-md-3 text-right">Allow Login from - Github</div>
                              <div class="col-md-4">
                                 <div id="switch-btn">
                                    <label class="switch">
                                       <input type="checkbox" name="git_autho" id="git_autho" <?php if ($getApp['git_autho'] == '1') {
                                               echo 'checked="checked"';
                                              } ?>>
                                       <span class="slider round"></span>
                                    </label>
                                 </div>
                                 <input type="hidden" name="hidden_github" id="hidden_github"
                                    value="<?php echo $getApp['git_autho']; ?>" />
                              </div>
                           </div>

                           <div class="form-group pt-2 row">
                              <div class="col-md-2"></div>
                              <div class="col-md-4">
                                 <input type="hidden" name="id_autho" id="id_autho"
                                    value="<?php echo $getApp['id_autho']; ?>" />
                                 <button class="theme-primary-btn btn btn-success" type="submit">Update
                                    settings</button>

                              </div>
                           </div>



                        </form>
                        <?php }} ?>

                     </div>




                  </div>
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