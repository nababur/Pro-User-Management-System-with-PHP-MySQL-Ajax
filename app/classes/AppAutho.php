<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * AppAutho Class
 */
class AppAutho{
	
	private $table = "tbl_app_autho";
	private $db;
	private $fm;

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}





	// Select only User ID
	public function selectOnlyAppId(){
		$query = "SELECT * FROM $this->table ";
		$result = $this->db->select($query);
		return $result;
	}




	// Add email switch values 
	public function addEmailValuse($allow_email, $id_autho){
		$id_autho 		= $this->fm->validation($id_autho);
		$allow_email 	= $this->fm->validation($allow_email);
		$allow_email 	= mysqli_real_escape_string($this->db->link ,$allow_email);

    	$query = "UPDATE $this->table
    			SET  
    			allow_email 	= '$allow_email'
    			WHERE id_autho = '$id_autho'
    	";
    	$updated_row = $this->db->update($query);
		if ($updated_row) {
			echo $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success! </strong>Allow Registration Changed Save Successfully !</div>';
			
			exit();
		}else{
			echo $msg = ' <div class="alert alert-danger alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error! </strong>Something went wrong !</div>';
			exit();
		}


	}


	// Add Facebook switch values 
	public function addFacebookAutho($fb_autho, $id_autho){
		$id_autho 	= $this->fm->validation($id_autho);
		$fb_autho 	= $this->fm->validation($fb_autho);
		$fb_autho 	= mysqli_real_escape_string($this->db->link ,$fb_autho);

    	$query = "UPDATE $this->table
    			SET  
    			fb_autho 		= '$fb_autho'
    			WHERE id_autho 	= '$id_autho'
    	";
    	$updated_row = $this->db->update($query);
		if ($updated_row) {
			echo $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success! </strong>Allow Registration Changed Save Successfully !</div>';
			
			exit();
		}else{
			echo $msg = ' <div class="alert alert-danger alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error! </strong>Something went wrong !</div>';
			exit();
		}


	}


	// Add Twitter switch values 
	public function addTwitterAutho($tw_autho, $id_autho){
		$id_autho 	= $this->fm->validation($id_autho);
		$tw_autho 	= $this->fm->validation($tw_autho);
		$tw_autho 	= mysqli_real_escape_string($this->db->link ,$tw_autho);

    	$query = "UPDATE $this->table
    			SET  
    			tw_autho 		= '$tw_autho'
    			WHERE id_autho 	= '$id_autho'
    	";
    	$updated_row = $this->db->update($query);
		if ($updated_row) {
			echo $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success! </strong>Allow Registration Changed Save Successfully !</div>';
			
			exit();
		}else{
			echo $msg = ' <div class="alert alert-danger alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error! </strong>Something went wrong !</div>';
			exit();
		}



	}





	// Add Google switch values 
	public function addGoogleValuse($gle_autho, $id_autho){
		$id_autho 	= $this->fm->validation($id_autho);
		$gle_autho 	= $this->fm->validation($gle_autho);
		$gle_autho 	= mysqli_real_escape_string($this->db->link ,$gle_autho);

    	$query = "UPDATE $this->table
    			SET  
    			gle_autho 		= '$gle_autho'
    			WHERE id_autho 	= '$id_autho'
    	";
    	$updated_row = $this->db->update($query);
		if ($updated_row) {
			echo $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success! </strong>Allow Registration Changed Save Successfully !</div>';
			
			exit();
		}else{
			echo $msg = ' <div class="alert alert-danger alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error! </strong>Something went wrong !</div>';
			exit();
		}



	}






	// Add Github switch values 
	public function addGithubValuse($git_autho, $id_autho){
		$id_autho 	= $this->fm->validation($id_autho);
		$git_autho 	= $this->fm->validation($git_autho);
		$git_autho 	= mysqli_real_escape_string($this->db->link ,$git_autho);

    	$query = "UPDATE $this->table
    			SET  
    			git_autho 		= '$git_autho'
    			WHERE id_autho 	= '$id_autho'
    	";
    	$updated_row = $this->db->update($query);
		if ($updated_row) {
			echo $msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success! </strong>Allow Registration Changed Save Successfully !</div>';
			
			exit();
		}else{
			echo $msg = ' <div class="alert alert-danger alert-dismissible" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error! </strong>Something went wrong !</div>';
			exit();
		}



	}





}