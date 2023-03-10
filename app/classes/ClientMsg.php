<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * ClientMsg Class
 */
class ClientMsg{
	

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}




	// clientProposalMethod 
	public function clientProposalMethod($data){
		$name 				= $this->fm->validation($data['name']);
		$email 				= $this->fm->validation($data['email']);
		$budget 			= $this->fm->validation($data['budget']);
		$frameworks 	= $this->fm->validation($data['frameworks']);



		$name 				= mysqli_real_escape_string($this->db->link, $name);
		$email 				= mysqli_real_escape_string($this->db->link, $email);
		$budget 			= mysqli_real_escape_string($this->db->link, $budget);
		$frameworks 	= mysqli_real_escape_string($this->db->link, $frameworks);
		
		

		$pregExp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		if ($name == "" || $email == "" || $budget == "" || $frameworks == "") {
	     
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
		
		}else{
				//Client Proposal Message
				
				date_default_timezone_set("Asia/Dhaka");
				$Date 		= new DateTime();
				$Date 		= date_format($Date, 'Y-m-d H:i:s');
				$form 	 = $email;
				$to 	 = "nababurdev@gmail.com";
				$subject = 'New Job proposal from Benzi Admin Dashboard !';
				$headers = "From: " . strip_tags($form) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($form) . "\r\n";
				$headers .= "CC: nababurdev@gmail.com\r\n";
				$headers .= 'MIME-Version: 1.0';
				$headers .= 'Content-type: text/html; charset=iso-8859-1';
				$message  = "Client name : " . strip_tags($name) . "\r\n";
				$message .= "Client E-mail : " . strip_tags($email) . "\r\n";
				$message .= "Client Budget : " . strip_tags($budget) . "\r\n";
				$message .= "Client framework choice : " . strip_tags($frameworks) . "\r\n";
				$message .= "Proposal Email Date : " . strip_tags($Date) . "\r\n";
				$message .= "This Email come from your Benzi Admin Dashboard Client proposal Pannel.";
		        $sendmail 	= mail($to, $subject, $message);


		        if ($sendmail) {
				         $msg = ' <div class="alert alert-success " id="flash-msg">
    <strong>Success! </strong> Your Proposal has been send Successfully, We will reply as soon as possible. Thanks !</div>';
		        echo $msg;
		        }else{
					$msg =   '<div class="alert alert-danger " id="flash-msg">
    <strong>Error !</strong> Something went wrong!</div>';
		        echo $msg;
		        }

					
		    }
	}


	





}