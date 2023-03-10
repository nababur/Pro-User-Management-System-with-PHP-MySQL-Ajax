<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * Changepassword Class
 */
class Changepassword{
	
	private $table = "tbl_users";
	private $db;
	private $fm;

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}





	// User Password Change method
	public function updatePassword($userid, $data){
		$old_password 		= $this->fm->validation($data['old_password']);
		$new_password 		= $this->fm->validation($data['new_password']);
		$confirm_password 	= $this->fm->validation($data['confirm_password']);

		$old_password 		= mysqli_real_escape_string($this->db->link, $old_password);
		$new_password 		= mysqli_real_escape_string($this->db->link, $new_password);
		$confirm_password 	= mysqli_real_escape_string($this->db->link, $confirm_password);
		

		if (empty($old_password) OR empty($new_password) OR empty($confirm_password)) {
		       $msg = "<div id='flash-msg' class='alert alert-danger'><strong>Error ! </strong>Password field must not be Empty!</div>";
		       return $msg;
		       exit();
		       
		}elseif (strlen($new_password) <= '6') {
				$msg = '<div class="alert alert-danger " id="flash-msg">
	    <strong>Error !</strong> Your Password Must Contain At Least 6 Characters !</div>';
		return $msg;
			 exit();
	    }elseif(!preg_match("#[0-9]+#",$new_password)) {
			$msg = '<div class="alert alert-danger " id="flash-msg">
    <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
		return $msg;
			 exit();
	    }elseif(!preg_match("#[a-z]+#",$new_password)) {
			$msg = '<div class="alert alert-danger " id="flash-msg">
    <strong>Error !</strong> Your Password Must be Contain At Least 1 Lowercase Letter !</div>';
		return $msg;
			 exit();
	    }elseif($new_password != $confirm_password) {
	        $msg =   '<div class="alert alert-danger " id="flash-msg">
	    <strong>Error !</strong> Password did not matched, please try agian and use same password two fields.</div>';
			return $msg;
			 exit();
		}elseif($old_password == $confirm_password) {
	        $msg =   '<div class="alert alert-danger " id="flash-msg">
	    <strong>Hey !</strong> You have entered your old password, please re-type again for new Password !</div>';
			return $msg;
			 exit();
		}else{
			
	    	$chKOldPassword = "SELECT * FROM $this->table WHERE  userid = '$userid' LIMIT 1";
	    	$result = $this->db->select($chKOldPassword);
			if ($result != false) {
				$value = $result->fetch_assoc();

				if (password_verify($old_password, $value['password'] )) {
					   

			    	// Has password Generator
			    	$has_pass 	= password_hash($new_password, PASSWORD_DEFAULT);
			    	// Update query
			    	$query = "UPDATE $this->table
			    			SET  
			    			password 		= '$has_pass'
			    			WHERE userid 	= '$userid'
			    	";
		        	$updated_pass = $this->db->update($query);
				    if ($updated_pass) {

						//User Password changed thanks giving message
						$Date 		= new DateTime();
						$Date 		= date_format($Date, 'Y-m-d H:i:s');
						$email 				= $value['email'];
						$name 		= $value['name'];
						$form 		= 'nababurdev@gmail.com';
						$to 		= "$email";
						$subject 	= 'You have been changed your password Successfully.';
						$headers 	= "From: " . strip_tags($form) . "\r\n";
						$headers 	.= "Reply-To: ". strip_tags($form) . "\r\n";
						$headers 	.= "CC: nababurdev@gmail.com\r\n";
						$headers 	.= 'MIME-Version: 1.0';
						$headers 	.= 'Content-type: text/html; charset=iso-8859-1';


						$message  	= "Your name is : " . strip_tags($name) . "\r\n";
						$message 	.= "Your E-mail is : " . strip_tags($email) . "\r\n";
						$message 	.= "Your New generate password is: " . strip_tags($new_password) . "\r\n";
						$message 	.= "Password changed date is: " . strip_tags($Date) . "\r\n";
						$message 	.= "Message : Please visit our website to login.";
				        $sendmail 	= mail($to, $subject, $message);
				        if ($sendmail) {
					        $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Wow ! </strong> Your Password has been Successfully Changed !</div>';
					        return $msg;
				        }else{
				        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Error !</strong> Something went wrong !</div>';
				        return $msg;
				        }



				    }else {
				        $msg =   '<div class="alert alert-danger alert-dismissible" id="flash-msg">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Error !</strong> Something went wrong !</div>';
				        return $msg;
				    }

				}else {
					$msg = '<div class="alert alert-danger" id="flash-msg"><strong>Error !</strong>  Your old password did not Matched, Please try again !</div>';
					return $msg;
					 exit();
				}




			}else{
		       $msg = "<div id='flash-msg' class='alert alert-danger'><strong>Error ! </strong> Something went wrong, try again please !</div>";
		       return $msg;
		       exit();
		       
			}

			
		}


	}














}