<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * App Class
 */
class App{
	

	private $table = "tbl_app_settings";
	private $db;
	private $fm;

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}




	

	// Select update settings 
	public function selectAllAppSettings(){
		$query = "SELECT * FROM $this->table";
		$result = $this->db->select($query);
		return $result;
	}




	// App Update Settings Method 
	public function updateAppSettings($data, $file, $app_id){
		$app_id 	= $this->fm->validation($data['app_id']);
		$app_name 	= $this->fm->validation($data['app_name']);
		$title 		= $this->fm->validation($data['title']);
		$front_name 		= $this->fm->validation($data['front_name']);
		$app_id 	= mysqli_real_escape_string($this->db->link, $app_id);
		$app_name 	= mysqli_real_escape_string($this->db->link, $app_name);
		$title 		= mysqli_real_escape_string($this->db->link, $title);
		$front_name 		= mysqli_real_escape_string($this->db->link, $front_name);

	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['favicon']['name'];
	    $file_size = $file['favicon']['size'];
	    $file_temp = $file['favicon']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 15).'.'.$file_ext;
	    $uploaded_image = "app/uploads/logo/".$unique_image;


	    // Logo Upload method
	    $file_logo_name = $file['logo']['name'];
	    $file_logo_size = $file['logo']['size'];
	    $file_logo_temp = $file['logo']['tmp_name'];

	    $div = explode('.', $file_logo_name);
	    $file_logo_ext = strtolower(end($div));
	    $unique_logo_image = substr(md5(time()), 0, 20).'.'.$file_logo_ext;
	    $uploaded_logo_image = "app/uploads/logo/".$unique_logo_image;

		if ($app_name == "" ) {
	     
	        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Error !</strong> Input & Upload fields must not be Empty!</div>';
	        return $msg;
		       exit();
		}else{
				
				if (!empty($file_name) OR !empty($file_logo_name)) {

				    if($file_size >1048567 OR $file_logo_size >1048567) {
				        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> Image Size should be less then 1MB!</div>';
				        return $msg;
					    } elseif (in_array($file_ext, $permited) === false OR in_array($file_logo_ext, $permited) === false) {
					        $msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> You can upload only:-'.implode(', ', $permited).'</div>';
					        return $msg;
					    }else{

					    	// Unlink Image 
							$unlinkfavicon = "SELECT favicon FROM $this->table WHERE app_id = '$app_id' ";
							$unlink_favicon = $this->db->select($unlinkfavicon);

							if ($unlink_favicon == TRUE) {
								while ($delimg  = $unlink_favicon->fetch_assoc()) {
									$favicon = $delimg['favicon'];

									if(is_file($favicon)){

								        unlink($favicon);
									}
								    

									
								}
							}

					    	// Unlink Logo Image 
							$unlinklogo = "SELECT logo FROM $this->table WHERE app_id = '$app_id' ";
							$unlink_Logo = $this->db->select($unlinklogo);

							if ($unlink_Logo == TRUE) {
								while ($delimg  = $unlink_Logo->fetch_assoc()) {
									$logo = $delimg['logo'];
									if(is_file($logo)){
										
								        unlink($logo);
									}
								    
								}
							}


							// Move Favicon Uploaded file
					    	move_uploaded_file($file_temp, $uploaded_image);

							// Move Logo Uploaded file
					    	move_uploaded_file($file_logo_temp, $uploaded_logo_image);


					    	// Update query
					    	$query = "UPDATE $this->table
					    			SET  
					    			app_name 	= '$app_name',
					    			title 		= '$title',
					    			front_name 		= '$front_name',
					    			favicon 	= '$uploaded_image',
					    			logo 		= '$uploaded_logo_image'
					    			WHERE app_id = '$app_id'
					    	";
				        	$updated_row = $this->db->update($query);
						    if ($updated_row) {
						        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Success! </strong> App Settings Contents Updated Successfully !</div>';
						        return $msg;
						    }else {
						        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> Settings not Updated!</div>';
						        return $msg;
						    }
					    }}else{
					    	
					    	$query = "UPDATE $this->table
					    			SET  
					    			app_name 	= '$app_name',
					    			title 		= '$title',
					    			front_name 		= '$front_name'
					    			WHERE app_id = '$app_id'
					    	";
				        	$updated_row = $this->db->update($query);
						    if ($updated_row) {
						        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Success! </strong> App Settings Contents Updated Successfully !</div>';
						        return $msg;

						    }else {
						        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> Settings Data not Updated!</div>';
						        return $msg;
						    }
					    }
		}
	}

	





}