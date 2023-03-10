<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * Visitor Users Class
 */
class Users{

	private $apptable 		= "tbl_app_autho";
	private $table 			= "tbl_users";
	private $table_session 	= "tbl_online_user";
	private $db;
	private $fm;

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}





   /**
	 * Suppose, you are browsing in your localhost 
	 * http://localhost/myproject/index.php?id=8
	 */
	public function getBaseUrl() 
	{
		// output: /myproject/index.php
		$currentPath = $_SERVER['PHP_SELF']; 

		// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
		$pathInfo = pathinfo($currentPath); 

		// output: localhost
		$hostName = $_SERVER['HTTP_HOST']; 

		// output: http://
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

		// return: http://localhost/myproject/
		// return $protocol.'://'.$hostName.$pathInfo['dirname']."/";
		return $protocol.'://'.$hostName;
	}



	// Users Login Method
	public function userLoginAuthotication($data){
		$email 		= $this->fm->validation($data['email']);
		$password 	= $this->fm->validation($data['password']);

		$email 		= mysqli_real_escape_string($this->db->link, $email);
		$password 	= mysqli_real_escape_string($this->db->link, $password);
		

		if (empty($email) OR empty($password)) {
		       $msg = "<div id='flash-msg' class='alert alert-danger'><strong>Error ! </strong>Email or Password field must not be Empty!</div>";
		       return $msg;
		       exit();
		       
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = '<div class="alert alert-danger" id="flash-msg"><strong>Error !</strong> Invalid email address !</div>';
			return $msg;
			 exit();
		}else{
			$query = "SELECT * FROM $this->table WHERE email = '$email'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();

					if (password_verify($password, $value['password'] )) {
						   if(!empty($data['remember']))   
							   {  
							    setcookie ("email",$email,time()+ (10 * 365 * 24 * 60 * 60));  
							    setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
							   
							   }  
							   else  
							   {  
							    if(isset($_COOKIE["email"]))   
							    {  
							     setcookie ("email","");  
							    }  
							    if(isset($_COOKIE["password"]))   
							    {  
							     setcookie ("password","");  
							    }  
						   }
						$userid = $value['userid'];
						$userOn = $this->userActive_ON($userid);
						if ($value['status'] == '1') {
							$msg = '<div class="alert alert-danger" id="flash-msg"><strong>Error !</strong>  Your Account is Disabled, conact with Author !</div>';
							return $msg;
							 exit();
						}else{
							Session::set("userLogin", true);
							Session::set("login", true);
							Session::set("userid", $value['userid']);
							Session::set("userName", $value['name']);
							Session::set("userEmail", $value['email']);
							Session::set("profilePhoto", $value['profilePhoto']);
							Session::set("rolename", $value['rolename']);
							echo "<script>location.href='dashboard.php';</script>";
							exit();
						}
					}
					else {
						$msg = '<div class="alert alert-danger" id="flash-msg"><strong>Error !</strong>  Your password did not Matched !</div>';
						return $msg;
						 exit();
					}




			}else{
		       $msg = "<div id='flash-msg' class='alert alert-danger'><strong>Error ! </strong>Email or Password not Matched !</div>";
		       return $msg;
		       exit();
		       
			}
		}


	}

	// User logout Method 
	public function userLogOut(){
	    session_destroy();
	    echo "<script>location.href='login.php';</script>";
	    session_unset();
	    exit();

	}




	// newUserRegistration Method
	public function newUserRegistration($data){
		$name 				= $this->fm->validation($data['name']);
		$email 				= $this->fm->validation($data['email']);
		$password 			= $this->fm->validation($data['password']);
		$confirm_password 	= $this->fm->validation($data['confirm_password']);



		$name 				= mysqli_real_escape_string($this->db->link, $name);
		$email 				= mysqli_real_escape_string($this->db->link, $email);
		$password 			= mysqli_real_escape_string($this->db->link, $password);
		$confirm_password 	= mysqli_real_escape_string($this->db->link, $confirm_password);
		
		


		$pregExp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		if ($name == "" || $email == "" || $password == "" || $confirm_password == "") {
	     
	        $msg =   '<div class="alert alert-danger " id="flash-msg">
	    <strong>Error !</strong> Input fields must not be Empty!</div>';
	        echo $msg;
		       exit();
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = '<div class="alert alert-danger" id="flash-msg">
    <strong>Error !</strong> Please fill up Valid Email !</div>';
			echo $msg;
		}elseif(!preg_match($pregExp, $email)) {
			$msg = '<div class="alert alert-danger " id="flash-msg">
    <strong>Error !</strong> Please fill up Valid Email !</div>';
			echo  $msg;
		
		}elseif (strlen($password) < '6') {
				$msg = '<div class="alert alert-danger " id="flash-msg">
	    <strong>Error !</strong> Your Password Must Contain At Least 6 Characters !</div>';
				echo $msg;
	    }elseif(!preg_match("#[0-9]+#",$password)) {
			$msg = '<div class="alert alert-danger " id="flash-msg">
    <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
			echo $msg;
	    }elseif(!preg_match("#[a-z]+#",$password)) {
			$msg = '<div class="alert alert-danger " id="flash-msg">
    <strong>Error !</strong> Your Password Must be Contain At Least 1 Lowercase Letter !</div>';
			echo $msg;
	    }elseif($password != $confirm_password) {
	        $msg =   '<div class="alert alert-danger " id="flash-msg">
	    <strong>Error !</strong> Password did not matched, please try agian and use same password two fields.</div>';
	        echo $msg;
		    }else{
			    	$checkUserEmail = "SELECT email FROM $this->table WHERE email = '$email' LIMIT 1";
			    	$mailCheck = $this->db->select($checkUserEmail);
			    	if ($mailCheck != false) {
						$msg = '<div class="alert alert-danger" id="flash-msg">
			    <strong>Error !</strong> Email already Used, Please use another Email. !</div>';
						echo $msg;
						exit();
			    	}else{

				    	// This is query for handle use registeration permission
						$onQuery = "SELECT * FROM $this->apptable";
						$allowRegistration = $this->db->select($onQuery);
						$value = $allowRegistration->fetch_assoc();
						if ($value['allow_email'] === '1') {

							$msg = '<div class="alert alert-danger" id="flash-msg">
				    <strong>Error !</strong> New user Registration is closed by Author !</div>';
							echo $msg;
							exit();
						}else{


							// Has password 
					    	$has_pass 	= password_hash($password, PASSWORD_DEFAULT);
					    	$query = "INSERT INTO $this->table(name,  email, password, rolename) VALUES('$name', '$email', '$has_pass', 'Only user')";
				        	$inserted_rows = $this->db->insert($query);
						    if ($inserted_rows) {
								// Select Query for only author access
								$query 	= "SELECT * FROM $this->table WHERE rolename = 'Author' LIMIT 1";
								$author = $this->db->select($query);
									$getAuthor 	= $author->fetch_assoc();
									$author 	= $getAuthor['email'];

								//User Registration thanks giving message
								$base_url   = $this->getBaseUrl();
								$Date 		= new DateTime();
								$Date 		= date_format($Date, 'Y-m-d H:i:s');
								$form 		= 'nababurdev@gmail.com';
								$to 		= "$email, $author";
								$subject = 'You have been registered Successfully.';
								$headers = "From: " . strip_tags($form) . "\r\n";
								$headers .= "Reply-To: ". strip_tags($form) . "\r\n";
								$headers .= "CC: nababurdev@gmail.com\r\n";
								$headers .= 'MIME-Version: 1.0';
								$headers .= 'Content-type: text/html; charset=iso-8859-1';
								$message  = "Your name is : " . strip_tags($name) . "\r\n";
								$message .= "Your E-mail is : " . strip_tags($email) . "\r\n";
								$message .= "Your Role is : User Only "."\r\n";
								$message .= "Registration Date : " . strip_tags($Date) . "\r\n";
								$message .= "Message : Please visit our website to login here ".$base_url." ";
						        $sendmail 	= mail($to, $subject, $message);


						        if ($sendmail) {
								         $msg = ' <div class="alert alert-success " id="flash-msg">
				    <strong>Success! </strong> You have Registered Successfully !</div>';
						        echo $msg;
						        }else{
									$msg =   '<div class="alert alert-danger " id="flash-msg">
				    <strong>Error !</strong> Something went wrong!</div>';
						        echo $msg;
						        }


						    }else {
						        $msg =   '<div class="alert alert-danger " id="flash-msg">
				    <strong>Error !</strong> Something went wrong!</div>';
						        echo $msg;
						    }


						}


					

				}
		    }
	}






	// createNewUserData Method 
	public function createNewUserData($data, $file){
		$name 				= $this->fm->validation($data['name']);
		$phone 				= $this->fm->validation($data['phone']);
		$address 			= $this->fm->validation($data['address']);
		$information 		= $this->fm->validation($data['information']);
		$email 				= $this->fm->validation($data['email']);
		$city 				= $this->fm->validation($data['city']);
		$country 			= $this->fm->validation($data['country']);
		$password 			= $this->fm->validation($data['password']);
		$confirm_password 	= $this->fm->validation($data['confirm_password']);
		$rolename 			= $this->fm->validation($data['rolename']);
		$status 			= $this->fm->validation($data['status']);
		$create_date 		= $this->fm->validation($data['create_date']);
		$gendar 			= $this->fm->validation($data['gendar']);

		$name 				= mysqli_real_escape_string($this->db->link, $name);
		$phone 				= mysqli_real_escape_string($this->db->link, $data['phone']);
		$address 			= mysqli_real_escape_string($this->db->link, $address);
		$information 		= mysqli_real_escape_string($this->db->link, $information);
		$email 				= mysqli_real_escape_string($this->db->link, $email);
		$city 				= mysqli_real_escape_string($this->db->link, $data['city']);
		$country 			= mysqli_real_escape_string($this->db->link, $country);
		$password 			= mysqli_real_escape_string($this->db->link, $password);
		$confirm_password 	= mysqli_real_escape_string($this->db->link, $confirm_password);
		$rolename 			= mysqli_real_escape_string($this->db->link, $rolename);
		$status 			= mysqli_real_escape_string($this->db->link, $status);
		$create_date 		= mysqli_real_escape_string($this->db->link, $create_date);
		$gendar 			= mysqli_real_escape_string($this->db->link, $gendar);


	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['profilePhoto']['name'];
	    $file_size = $file['profilePhoto']['size'];
	    $file_temp = $file['profilePhoto']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "app/uploads/userAvatar/".$unique_image;

		if ($name == "" ||$phone == "" ||$address == "" ||$email == "" ||$city == "" ||$country == "" ||$password == ""||$confirm_password == ""||$rolename == ""||$status == ""||$create_date == "" ||$gendar == ""  ) {
	     
	        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Error !</strong> Input fields must not be Empty!</div>';
	        return $msg;
		       exit();
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = '<div class="alert alert-danger text-center alert-dismissible" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Please fill up Valid Email !</div>';
			return $msg;
		
		    }elseif (strlen($password) <= '6') {
				$msg = '<div class="alert alert-danger text-center alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Error !</strong> Your Password Must Contain At Least 6 Characters !</div>';
				return $msg;

	    }elseif($password != $confirm_password) {
	        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Error !</strong> Password did not matched, please try agian and use same password two fields.</div>';
	        return $msg;
		    }elseif($file_size >1048567) {
	        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Error !</strong> Image Size should be less then 1MB!</div>';
	        return $msg;
		    } elseif (in_array($file_ext, $permited) === false) {
		        $msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Error !</strong> You can upload only:-'.implode(', ', $permited).'</div>';
		        return $msg;
		    }else{
			    	$checkUserEmail = "SELECT email FROM $this->table WHERE email = '$email' LIMIT 1";
			    	$mailCheck = $this->db->select($checkUserEmail);
			    	if ($mailCheck != false) {
						$msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Error !</strong> Email already Exist, Please use another Email for create new User. !</div>';
						return $msg;
						exit();
			    	}else{
			    	move_uploaded_file($file_temp, $uploaded_image);
			    	$has_pass 	= password_hash($password, PASSWORD_DEFAULT);
			    	$query = "INSERT INTO $this->table(name,  phone, address, information,email,city,country, password,  profilePhoto, rolename,  status, gendar,  create_date) VALUES('$name', '$phone', '$address','$information', '$email','$city','$country', '$has_pass', '$uploaded_image','$rolename', '$status', '$gendar', '$create_date')";
		        	$inserted_rows = $this->db->insert($query);

				    if ($inserted_rows) {
						// Select Query for only author access
						$query 	= "SELECT * FROM $this->table WHERE rolename = 'Author' LIMIT 1";
						$author = $this->db->select($query);
							$getAuthor 	= $author->fetch_assoc();
							$author 	= $getAuthor['email'];

						if (Session::get('userName') == TRUE && Session::get('rolename') == TRUE) {
							//User Registration thanks giving message
							$base_url   = $this->getBaseUrl();
							$Date 		= new DateTime();
							$Date 		= date_format($Date, 'Y-m-d H:i:s');
							$form = 'nababurdev@gmail.com';
							$to 		= "$email, $author";
							$subject = 'You have been registered Successfully.';
							$headers = "From: " . strip_tags($form) . "\r\n";
							$headers .= "Reply-To: ". strip_tags($form) . "\r\n";
							$headers .= "CC: nababurdev@gmail.com\r\n";
							$headers .= 'MIME-Version: 1.0';
							$headers .= 'Content-type: text/html; charset=iso-8859-1';
							$message  	 = "Account user information: ". "\r\n";
							$message  	.= "User name is: " . strip_tags($name) . "\r\n";
							$message 	.= "User E-mail is: " . strip_tags($email) . "\r\n";
							$message 	.= "======================". "\r\n";
							$message  	.= "Admin information: ". "\r\n";
							$message 	.= "Account creator  : " . Session::get('userName') . "\r\n";
							$message 	.= "Account creator Role : " . Session::get('rolename') . "\r\n";
							$message 	.= "Account Registration Date : " . strip_tags($Date) . "\r\n";
							$message 	.= "Message : Please visit our website to login ".$base_url." ";
							$sendmail 	= mail($to, $subject, $message);

						}else{
							//User Registration thanks giving message
							$base_url   = $this->getBaseUrl();
							$Date 		= new DateTime();
							$Date 		= date_format($Date, 'Y-m-d H:i:s');
							$form = 'nababurdev@gmail.com';
							$to 		= "$email";
							$subject = 'You have been registered Successfully.';
							$headers = "From: " . strip_tags($form) . "\r\n";
							$headers .= "Reply-To: ". strip_tags($form) . "\r\n";
							$headers .= "CC: nababurdev@gmail.com\r\n";
							$headers .= 'MIME-Version: 1.0';
							$headers .= 'Content-type: text/html; charset=iso-8859-1';
							$message  	 = "Account user information: ". "\r\n";
							$message  	.= "Your name is: " . strip_tags($name) . "\r\n";
							$message 	.= "Your E-mail is: " . strip_tags($email) . "\r\n";
							$message 	.= "Your Role is: " . strip_tags($rolename) . "\r\n";
							$message 	.= "Account Registration Date : " . strip_tags($Date) . "\r\n";
							$message 	.= "Message : Please visit our website to login ".$base_url." ";
							$sendmail 	= mail($to, $subject, $message);
						}




				        if ($sendmail) {
					        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Success! </strong> New User Created Successfully !</div>';
					        return $msg;
				        }else{
					        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Error !</strong> New User not Created, Something went wrong!</div>';
					        return $msg;
				        }



				    }else {
				        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Error !</strong> New User not Created, Something went wrong!</div>';
				        return $msg;
				    }


				}
		    }
	}



	// User Inserted Method BY Id 
	public function updateUserById($data, $file, $id){
		$id = preg_replace('/[^a-zA-Z0-9-]/', '', $id);
		$name 				= $this->fm->validation($data['name']);
		$phone 				= $this->fm->validation($data['phone']);
		$address 			= $this->fm->validation($data['address']);
		$information 		= $this->fm->validation($data['information']);
		$email 				= $this->fm->validation($data['email']);
		$city 				= $this->fm->validation($data['city']);
		$country 			= $this->fm->validation($data['country']);
		$rolename 			= $this->fm->validation($data['rolename']);
		$status 			= $this->fm->validation($data['status']);
		$create_date 		= $this->fm->validation($data['create_date']);
		$gendar	 			= $this->fm->validation($data['gendar']);



		$name 				= mysqli_real_escape_string($this->db->link, $name);
		$phone 				= mysqli_real_escape_string($this->db->link, $phone);
		$address 			= mysqli_real_escape_string($this->db->link, $address);
		$information 		= mysqli_real_escape_string($this->db->link, $information);
		$email 				= mysqli_real_escape_string($this->db->link, $email);
		$city 				= mysqli_real_escape_string($this->db->link, $city);
		$country 			= mysqli_real_escape_string($this->db->link, $country);
		$rolename 			= mysqli_real_escape_string($this->db->link, $rolename);
		$status 			= mysqli_real_escape_string($this->db->link, $status);
		$create_date 		= mysqli_real_escape_string($this->db->link, $create_date);
		$gendar 			= mysqli_real_escape_string($this->db->link, $gendar);

	
	    $permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['profilePhoto']['name'];
	    $file_size = $file['profilePhoto']['size'];
	    $file_temp = $file['profilePhoto']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "app/uploads/userAvatar/".$unique_image;

		if ($name == "" ||$phone == "" ||$address == "" ||$email == "" ||$city == "" ||$country == "" ||$rolename == ""||$status == ""|| $create_date == ""  || $gendar == ""  ) {
	     
	        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Error !</strong> Input fields must not be Empty!</div>';
	        return $msg;
		       exit();
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = '<div class="alert alert-danger text-center alert-dismissible" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Please fill up Valid Email !</div>';
			return $msg;
		
		    }else{
				
				if (!empty($file_name)) {

				    if($file_size >1048567) {
				        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> Image Size should be less then 1MB!</div>';
				        return $msg;
					    } elseif (in_array($file_ext, $permited) === false) {
					        $msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> You can upload only:-'.implode(', ', $permited).'</div>';
					        return $msg;
					    }else{



							// Move Uploaded file
					    	move_uploaded_file($file_temp, $uploaded_image);

					    	// Unlink Image 
							$unlinkQuery = "SELECT * FROM $this->table WHERE userid = '$id' ";
							$unlink_img = $this->db->select($unlinkQuery);

							if ($unlink_img) {
								while ($delimg  = $unlink_img->fetch_assoc()) {
									$delink = $delimg['profilePhoto'];
									if(is_file($delink)){

								        unlink($delink);
									}
								}
							}

					    	// Update query
					    	$query = "UPDATE $this->table
					    			SET  
					    			name 	= '$name',
					    			phone 			= '$phone',
					    			address 		= '$address',
					    			information 	= '$information',
					    			email 			= '$email',
					    			city 			= '$city',
					    			country 		= '$country',
					    			profilePhoto 	= '$uploaded_image',
					    			rolename 		= '$rolename',
					    			status 			= '$status',
					    			gendar 			= '$gendar',
					    			create_date 	= '$create_date'

					    			WHERE userid = '$id'
					    	";
				        	$updated_row = $this->db->update($query);
						    if ($updated_row) {

								$query 	= "SELECT * FROM $this->table WHERE userid = '$id' LIMIT 1";
								$result = $this->db->select($query);
								$value 	= $result->fetch_assoc();
								$email 	= $value['email'];
								$name 	= $value['name'];

								// Select Query for only author access
								$query 	= "SELECT * FROM $this->table WHERE rolename = 'Author' LIMIT 1";
								$author = $this->db->select($query);
									$getAuthor 	= $author->fetch_assoc();
									$author 	= $getAuthor['email'];



								if (Session::get('userName') == TRUE && Session::get('rolename') == TRUE) {
									//User Registration thanks giving message
									$base_url   = $this->getBaseUrl();
									$Date 		= new DateTime();
									$Date 		= date_format($Date, 'Y-m-d H:i:s');
									$form 		= 'nababurdev@gmail.com';
									$to 		= "$email, $author";
									$subject 	= 'Profile update notification';
									$headers 	= "From: " . strip_tags($form) . "\r\n";
									$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
									$headers 	.= "CC: nababurdev@gmail.com\r\n";
									$headers 	.= 'MIME-Version: 1.0';
									$headers 	.= 'Content-type: text/html; charset=iso-8859-1';
									$message  	 = "Account user information: ". "\r\n";
									$message  	.= "User name is: " . strip_tags($name) . "\r\n";
									$message 	.= "User E-mail is: " . strip_tags($email) . "\r\n";
									$message 	.= "=======================". "\r\n";
									$message  	.= "Admin information: ". "\r\n";
									$message 	.= "Account creator  : " . Session::get('userName') . "\r\n";
									$message 	.= "Account creator Role : " . Session::get('rolename') . "\r\n";
									$message 	.= "Account Registration Date : " . strip_tags($Date) . "\r\n";
									$message 	.= "Message : Please visit our website to login ".$base_url." ";
									
									$sendmail 	= mail($to, $subject, $message);

								}else{
									//User Registration thanks giving message
									$base_url   = $this->getBaseUrl();
									$Date 		= new DateTime();
									$Date 		= date_format($Date, 'Y-m-d H:i:s');
									$form 		= 'nababurdev@gmail.com';
									$to 		= "$email";
									$subject 	= 'Profile update notification';
									$headers = "From: " . strip_tags($form) . "\r\n";
									$headers .= "Reply-To: ". strip_tags($form) . "\r\n";
									$headers .= "CC: nababurdev@gmail.com\r\n";
									$headers .= 'MIME-Version: 1.0';
									$headers .= 'Content-type: text/html; charset=iso-8859-1';
									$message  	 = "Account user information: ". "\r\n";
									$message  	.= "Your name is: " . strip_tags($name) . "\r\n";
									$message 	.= "Your E-mail is: " . strip_tags($email) . "\r\n";
									$message 	.= "Your Role is: " . strip_tags($rolename) . "\r\n";
									$message 	.= "Profile update Date : " . strip_tags($Date) . "\r\n";
									$message 	.= "Message : Hey, ". strip_tags($name) ." Recently you have update your profile.";
									$message 	.= "Message : Please visit our website to login ".$base_url." ";
									$sendmail 	= mail($to, $subject, $message);
								}




						        if ($sendmail) {
							        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Success! </strong> User Data Updated Successfully !</div>';
							        return $msg;
						        }else{
							        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Error !</strong> User not Updated!</div>';
							        return $msg;
						        }


						    }else {
						        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> User not Updated!</div>';
						        return $msg;
						    }
					    }}else{
					    	
					    	$query = "UPDATE $this->table
					    			SET  
					    			name 	= '$name',
					    			phone 			= '$phone',
					    			address 		= '$address',
					    			information 	= '$information',
					    			email 			= '$email',
					    			city 			= '$city',
					    			country 		= '$country',
					    			rolename 		= '$rolename',
					    			status 			= '$status',
					    			gendar 			= '$gendar',
					    			create_date 	= '$create_date'
					    			WHERE userid = '$id'
					    	";
				        	$updated_row = $this->db->update($query);
						    if ($updated_row) {
								$query 	= "SELECT * FROM $this->table WHERE userid = '$id' LIMIT 1";
								$result = $this->db->select($query);
								$value 	= $result->fetch_assoc();
								$email 	= $value['email'];
								$name 	= $value['name'];


								// Select Query for only author access
								$query 	= "SELECT * FROM $this->table WHERE rolename = 'Author' LIMIT 1";
								$author = $this->db->select($query);
									$getAuthor 	= $author->fetch_assoc();
									$author 	= $getAuthor['email'];



								if (Session::get('userName') == TRUE && Session::get('rolename') == TRUE) {
									//User Registration thanks giving message
									$base_url   = $this->getBaseUrl();
									$Date 		= new DateTime();
									$Date 		= date_format($Date, 'Y-m-d H:i:s');
									$form 		= 'nababurdev@gmail.com';
									$to 		= "$email, $author";
									$subject 	= 'Profile update notification';
									$headers 	= "From: " . strip_tags($form) . "\r\n";
									$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
									$headers 	.= "CC: nababurdev@gmail.com\r\n";
									$headers 	.= 'MIME-Version: 1.0';
									$headers 	.= 'Content-type: text/html; charset=iso-8859-1';
									$message  	 = "Account user information: ". "\r\n";
									$message  	.= "User name is: " . strip_tags($name) . "\r\n";
									$message 	.= "User E-mail is: " . strip_tags($email) . "\r\n";
									$message 	.= "=======================". "\r\n";
									$message  	.= "Admin information: ". "\r\n";
									$message 	.= "Profile update by  : " . Session::get('userName') . "\r\n";
									$message 	.= "Profile updater Role : " . Session::get('rolename') . "\r\n";
									$message 	.= "Profile update Date : " . strip_tags($Date) . "\r\n";
									$message 	.= "Message : Please visit our website to login ".$base_url." ";
									$sendmail 	= mail($to, $subject, $message);

								}else{
									//User Registration thanks giving message
									$base_url   = $this->getBaseUrl();
									$Date 		= new DateTime();
									$Date 		= date_format($Date, 'Y-m-d H:i:s');
									$form 		= 'nababurdev@gmail.com';
									$to 		= "$email";
									$subject 	= 'Profile update notification';
									$headers 	= "From: " . strip_tags($form) . "\r\n";
									$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
									$headers 	.= "CC: nababurdev@gmail.com\r\n";
									$headers 	.= 'MIME-Version: 1.0';
									$headers 	.= 'Content-type: text/html; charset=iso-8859-1';
									$message  	 = "Account user information: ". "\r\n";
									$message  	.= "Your name is: " . strip_tags($name) . "\r\n";
									$message 	.= "Your E-mail is: " . strip_tags($email) . "\r\n";
									$message 	.= "Your Role is: " . strip_tags($rolename) . "\r\n";
									$message 	.= "Profile update Date : " . strip_tags($Date) . "\r\n";
									$message 	.= "Message : Hey, ". strip_tags($name) ." Recently you have update your profile.";
									$message 	.= "Message : Please visit our website to login ".$base_url." ";
									$sendmail 	= mail($to, $subject, $message);
								}


						        if ($sendmail) {
							        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Success! </strong> User Data Updated Successfully !</div>';
							        return $msg;
						        }else{
							        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Error !</strong> User not Updated!</div>';
							        return $msg;
						        }

						    }else {
						        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Error !</strong> User Data not Updated!</div>';
						        return $msg;
						    }
					    }
		}
	}



	// Delete User By Id 
	public function deleteUserById($id){
		$id = preg_replace('/[^a-zA-Z0-9-]/', '', $id);

 		// Select Query for get Individual Id
		$query 	= "SELECT * FROM $this->table WHERE userid = '$id' LIMIT 1";
		$result = $this->db->select($query);
		$value 	= $result->fetch_assoc();
		$email 	= $value['email'];
		$name 	= $value['name'];

		// Select Query for only author access
		$query 	= "SELECT * FROM $this->table WHERE rolename = 'Author' LIMIT 1";
		$author = $this->db->select($query);
		$getAuthor 	= $author->fetch_assoc();
		$author 	= $getAuthor['email'];


    	// Unlink Image 
		$unlinkQuery = "SELECT * FROM $this->table WHERE userid = '$id' ";
		$unlink_img = $this->db->select($unlinkQuery);

		if ($unlink_img) {
			while ($delimg  = $unlink_img->fetch_assoc()) {
				$delink = $delimg['profilePhoto'];
				if(is_file($delink)){

			        unlink($delink);
				}
			}
		}

		$query = "DELETE FROM $this->table WHERE userid = '$id'";
		$delete_row = $this->db->delete($query);
		if ($delete_row) {

			//User Registration thanks giving message
			$base_url   = $this->getBaseUrl();
			$Date 		= new DateTime();
			$Date 		= date_format($Date, 'Y-m-d H:i:s');
			$form 		= 'nababurdev@gmail.com';
			$to 		= "$author";
			$subject 	= 'User account was Delete.';
			$headers 	= "From: " . strip_tags($form) . "\r\n";
			$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
			$headers 	.= "CC: nababurdev@gmail.com\r\n";
			$headers 	.= 'MIME-Version: 1.0';
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1';
			$message  	 = "Account user information: ". "\r\n";
			$message  	.= "User name was: " . strip_tags($name) . "\r\n";
			$message 	.= "User E-mail was: " . strip_tags($email) . "\r\n";
			$message 	.= "======================". "\r\n";
			$message  	.= "Admin information: ". "\r\n";
			$message 	.= "Account was deleted by  : " . Session::get('userName') . "\r\n";
			$message 	.= "Role was : " . Session::get('rolename') . "\r\n";
			$message 	.= "Account Deleted Time : " . strip_tags($Date) . "\r\n";
			$message 	.= "Message : Please visit our website to login ".$base_url." ";
			// $message 	.= "Message : Sad news ! We are sorry if you have any Question contact with Author.";
	        $sendmail 	= mail($to, $subject, $message);

	        if ($sendmail) {
			        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success! </strong> User Account Deleted Successfully !</div>';
		        return  $msg;
		        exit();
	        }else{
				$msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error !</strong> Something went wrong...</div>';
				return $msg;
		       exit();
	        }




		}else{
			$msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Something went wrong...</div>';
			return $msg;
	       exit();
	       
		}
	}


	// Get All Userlist Method 
	public function selectAllUsers(){
		$query = "SELECT * FROM $this->table ORDER BY userid DESC";
		$result = $this->db->select($query);
		return $result;
	}



	// View User By Id Method 
	public function getUserById($viewuser){
		//$viewuser = preg_replace('/[^a-zA-Z0-9-]/', '', $viewuser);
		$query = "SELECT * FROM $this->table WHERE userid = '$viewuser'";
		$result = $this->db->select($query);
		return $result;
	}



	// Edit User By Id Method 
	public function editUserById($edituser){
		$editpro = preg_replace('/[^a-zA-Z0-9-]/', '', $edituser);
		$query = "SELECT * FROM $this->table WHERE userid = '$edituser' LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}


	// Select only User ID
	public function selectOnlyUesrId(){
		$query = "SELECT userid FROM $this->table LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}




	// Public funciton disable method 
	public function DisableUserById($disid){
		$query="
			UPDATE $this->table 
			SET 
			status = '1'
			WHERE userid = '$disid'";
		$update_row = $this->db->update($query);
	 	if ($update_row) {

			$query 	= "SELECT * FROM $this->table WHERE userid = '$disid' LIMIT 1";
			$result = $this->db->select($query);
			$value 	= $result->fetch_assoc();
			$email 	= $value['email'];
			$name 	= $value['name'];
			// Select Query for only author access
			$query 	= "SELECT * FROM $this->table WHERE rolename = 'Author' LIMIT 1";
			$author = $this->db->select($query);
				$getAuthor 	= $author->fetch_assoc();
				$author 	= $getAuthor['email'];

			//User Registration thanks giving message
			$base_url   = $this->getBaseUrl();
			$Date 		= new DateTime();
			$Date 		= date_format($Date, 'Y-m-d H:i:s');
			$form 		= 'nababurdev@gmail.com';
			$to 		= "$author";
			$subject 	= 'User account was Disable';
			$headers 	= "From: " . strip_tags($form) . "\r\n";
			$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
			$headers 	.= "CC: nababurdev@gmail.com\r\n";
			$headers 	.= 'MIME-Version: 1.0';
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1';
			$message  	 = "Account user information: ". "\r\n";
			$message  	.= "Account name is: " . strip_tags($name) . "\r\n";
			$message 	.= "Account E-mail is: " . strip_tags($email) . "\r\n";
			$message 	.= "Account Status is:  Disable". "\r\n";
			$message 	.= "==========================". "\r\n";
			$message  	.= "Admin information: ". "\r\n";
			$message 	.= "Account was disable by  : " . Session::get('userName') . "\r\n";
			$message 	.= "Account Role was : " . Session::get('rolename') . "\r\n";
			$message 	.= "Account disabled Time is: " . strip_tags($Date) . "\r\n";
			$message 	.= "Message : Please visit our website to login ".$base_url." ";
			

	        $sendmail 	= mail($to, $subject, $message);
	        if ($sendmail) {
			        $msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success! </strong> User Account is Disabled !</div>';
		        return  $msg;
		        exit();
	        }else{
				$msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error !</strong> Something went wrong...</div>';
				return $msg;
		       exit();
	        }

	 	}else{
			$msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Something went wrong...</div>';
			return $msg;
	       exit();
	 	}
	}


	// Public funciton Enable method 
	public function EnableUserById($enid){
		$query="
			UPDATE $this->table
			SET 
			status = '0'
			WHERE userid = '$enid'";
		$update_row = $this->db->update($query);
	 	if ($update_row) {


	 		// Select Query for get Individual Id
			$query 	= "SELECT * FROM $this->table WHERE userid = '$enid' LIMIT 1";
			$result = $this->db->select($query);
			$value 	= $result->fetch_assoc();
			$email 	= $value['email'];
			$name 	= $value['name'];

			// Select Query for only author access
			$query 	= "SELECT * FROM $this->table WHERE rolename = 'Author' LIMIT 1";
			$author = $this->db->select($query);
				$getAuthor 	= $author->fetch_assoc();
				$author 	= $getAuthor['email'];


			//User Registration thanks giving message
			$base_url   = $this->getBaseUrl();
			$Date 		= new DateTime();
			$Date 		= date_format($Date, 'Y-m-d H:i:s');
			$form 		= 'nababurdev@gmail.com';
			$to 		= "$author";
			$subject 	= 'User account Activated';
			$headers 	= "From: " . strip_tags($form) . "\r\n";
			$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
			$headers 	.= "CC: nababurdev@gmail.com\r\n";
			$headers 	.= 'MIME-Version: 1.0';
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1';
			$message  	 = "Account user information: ". "\r\n";
			$message  	.= "Account name is: " . strip_tags($name) . "\r\n";
			$message 	.= "Account E-mail is: " . strip_tags($email) . "\r\n";
			$message 	.= "Account Status is:  Activated". "\r\n";
			$message 	.= "========================". "\r\n";
			$message  	.= "Admin information: ". "\r\n";
			$message 	.= "Account was Activated by  : " . Session::get('userName') . "\r\n";
			$message 	.= "Account Role was : " . Session::get('rolename') . "\r\n";
			$message 	.= "Account Activated Time : " . strip_tags($Date) . "\r\n";
			$message 	.= "Message : Please visit our website to login ".$base_url." ";
			
	        $sendmail 	= mail($to, $subject, $message);

	        if ($sendmail) {
			        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success! </strong> User Account is Activate Successfully !</div>';
		        return  $msg;
		        exit();
	        }else{
				$msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error !</strong> Something went wrong...</div>';
				return $msg;
		       exit();
	        }


	 	}else{
			$msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Something went wrong...</div>';
			return $msg;
	       exit();
	 	}
	}



	// New Users method
	public function newUsers(){
		$query = "SELECT * FROM $this->table WHERE create_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND status = '0' ORDER BY userid DESC";
		$result = $this->db->select($query);
		return $result; 
	}



	// Only for Active user select
	public function onlyActiveUsers(){
		$query = "SELECT * FROM $this->table WHERE lastactivity = '1' ORDER BY userid DESC";
		$result = $this->db->select($query);
		return $result; 
	}

	// Band Or Deactive Users Method
	public function bandUsers(){
		$query = "SELECT * FROM $this->table WHERE status = '1'";
		$result = $this->db->select($query);
		return $result; 
	}



	// Total Users Method
	public function totalUsers(){
		$query = "SELECT * FROM $this->table";
		$result = $this->db->select($query);
		return $result; 
	}


	// Select All Author Query
	public function selectAuthorFrom(){
		$query = "SELECT rolename FROM $this->table WHERE rolename ='Author' ";
		$result = $this->db->select($query);
		return $result; 
	}


	// Band Users Method
	public function onlyBandUsers(){
		$query = "SELECT * FROM $this->table WHERE status = '1'  ORDER BY name DESC";
		$result = $this->db->select($query);
		return $result; 
	}





	// For Chart Js statics Query Select Monthly user registration query
	public function getMonthlyNewUser(){
		$query = "SELECT * FROM $this->table WHERE create_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY userid DESC";
		$result = $this->db->select($query);
		return $result; 
	}

	// Generat Custom New Password
	public function randomPasswordGenerator() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 10; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	

	// User Reset Password 
	public function userResetPassword($data){
		$email 				= $this->fm->validation($data['email']);
		$email 				= mysqli_real_escape_string($this->db->link, $email);
		$pregExp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";

		if ($email == "" ) {
	     
	        $msg =   '<div class="alert alert-danger " id="flash-msg">
	    <strong>Error !</strong> E-mail field must not be Empty !</div>';
	        echo $msg;
		       exit();
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = '<div class="alert alert-danger" id="flash-msg">
    <strong>Error !</strong> Please fill up Valid Email !</div>';
			echo $msg;
		}elseif(!preg_match($pregExp, $email)) {
			$msg = '<div class="alert alert-danger " id="flash-msg">
    <strong>Error !</strong> Please fill up Valid Email !</div>';
			echo  $msg;
		
		}else{

	    	$checkUserEmail = "SELECT * FROM $this->table WHERE email = '$email' LIMIT 1";
	    	$mailCheck = $this->db->select($checkUserEmail);
			if ($mailCheck != false) {
				while ($value = $mailCheck->fetch_assoc()) {
					$userid 	= $value['userid'];
					$name 	 	= $value['name'];
				}

				// $text = substr($email,0, 3);
				// $rand = rand(10000, 99999);
				// $newpass = "$text$rand";
				$newpass = $this->randomPasswordGenerator();
				$password = password_hash($newpass, PASSWORD_DEFAULT);

				// Update Qiuery
		        $updateQuery = "UPDATE $this->table
		        		SET 
		        		password = '$password' 
		        		WHERE userid = '$userid'";
		        $update_pass = $this->db->update($updateQuery);


		        if ($update_pass) {

			        //User Request Password changed thanks giving message
					$base_url   = $this->getBaseUrl();
					$Date 		= new DateTime();
					$Date 		= date_format($Date, 'Y-m-d H:i:s');
					$form 		= 'nababurdev@gmail.com';
					$to 		= "$email";
					$subject 	= 'Request to change your Password.';
					$headers 	= "From: " . strip_tags($form) . "\r\n";
					$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
					$headers 	.= "CC: nababurdev@gmail.com\r\n";
					$headers 	.= 'MIME-Version: 1.0';
					$headers 	.= 'Content-type: text/html; charset=iso-8859-1';
					$message 	 = "Your name is : " . strip_tags($name) . "\r\n";
					$message 	.= "Your E-mail is : " . strip_tags($email) . "\r\n";
					$message 	.= "Your New generate password is  : " . strip_tags($newpass) . "\r\n";
					$message 	.= "Password changed Date : " . strip_tags($Date) . "\r\n";
					$message 	.= "Message : Please visit our website to login ".$base_url." ";
			        $sendmail 	= mail($to, $subject, $message);
			        if ($sendmail) {
					        $msg = ' <div class="alert alert-success " id="flash-msg">
			    <strong>Success! </strong> Please check your Email for new password !</div>';
					        echo $msg;
			        }else{
						$msg = '<div class="alert alert-danger " id="flash-msg">
			    <strong>Error !</strong> Email not sent !</div>';
						echo  $msg;
			        }


		        }
			}else{
				$msg = '<div class="alert alert-danger " id="flash-msg">
	    <strong>Error !</strong> Email not Exists !</div>';
				echo  $msg;
			}

		}





	}


	// Profile Complete Notification
	public function profileCompleteNotify($userEmail, $userid){
		$query = "SELECT * FROM $this->table WHERE email = '$userEmail'  && userid = '$userid' && status = '0' ";
		$result 		= $this->db->select($query)->fetch_assoc();

		$name 			= $result['name'];
		$phone 			= $result['phone'];
		$profilePhoto 	= $result['profilePhoto'];
		$rolename 		= $result['rolename'];
		$gendar 		= $result['gendar'];
		$country 		= $result['country'];

		if (empty($phone) || empty($profilePhoto) || empty($rolename) || empty($gendar)|| empty($country)) {
			 $msg 	= '<div class="alert alert-danger animated fadeInUp bg-danger text-white alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>In-complete Profile !</strong> Hey ( '.$name.' ) Please before Complete your profile, then browse Dashboard. ! <a href="editprofile.php?edituser='.$userid.'"><span class="badge badge-lg badge-dark text-white">Go to profile </span></a> </div>';
    		return $msg;
    		exit();
		}


	}



	// User Login Date activity Statics
	public function userActive_OFF($userid){
		$lastactivity	= date("Y-m-d H:i:s");
    	$query = "UPDATE $this->table
    			SET  
    			lastactivity 	= '0'
    			WHERE userid 	= '$userid'
    			 && status = '0' 
    	";
		$update_row = $this->db->update($query);
		return $update_row;
	 	
	}




	// User Login Date activity Statics
	public function userActive_ON($userid){
		$lastactivity	= date("Y-m-d H:i:s");
    	$query = "UPDATE $this->table
    			SET  
    			lastactivity 	= '1'
    			WHERE userid 	= '$userid'
    			 && status = '0' 
    	";
		$update_row = $this->db->update($query);
		return $update_row;
	 	
	}












}