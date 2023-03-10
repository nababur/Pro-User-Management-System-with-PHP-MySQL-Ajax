<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * Visitor Roles Class
 */
class Roles{
	
	private $table = "tbl_roles";
	private $db;
	private $fm;

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}



	// Add new Role Insert Method
	public function addNewRole($data){
		$rolename 				= $this->fm->validation($data['rolename']);
		$roledname 				= $this->fm->validation($data['roledname']);
		//$permission_items 		= $data['permission_items'];

		$rolename 				= mysqli_real_escape_string($this->db->link, $rolename);
		$roledname 				= mysqli_real_escape_string($this->db->link, $roledname);
		//$permission_items 		= mysqli_real_escape_string($this->db->link, $permission_items);

		if (empty($rolename) OR empty($roledname) ) {
			$msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error ! </strong>Role Name and Display Name field must not be Empty!</div>';
		       return $msg;
		       exit();
		       
		}else{

            $checkName = "SELECT * FROM $this->table WHERE rolename = '$rolename' LIMIT 1 ";
            $CheckColumn = $this->db->select($checkName);
            if($CheckColumn == TRUE){
			$msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error ! </strong> Role is already added in Database !</div>';
			       return $msg;
			       exit();
            }else{

					$permission = array();
					$permission = $data['permission_items'];

			
				  foreach ($permission as  $value) {
				        if(is_array($value)) {
				            foreach($value as $val){
				                $arr[] = $val;
				            }
				        } else {
				            $arr[] = $value;
				        }
				    }
				    $run = implode(",", $arr);

				     
					$query = "INSERT INTO $this->table(rolename, roledname, permission_items) VALUES('$rolename', '$roledname', '$run') ";
					$result = $this->db->insert($query); 
				if ($result) {
					$msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				        <strong>Success! </strong> New user Role added Successfully !</div>';
				        return  $msg;
				        exit();
				}else{
					$msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Error ! </strong>Something went wrong , Data not inserted.</div>';
			       return $msg;
			       exit();
			       
				}
			}
		}

	}




	// Select Role Method 
	public function selectAllRole(){
		$query = "SELECT * FROM $this->table ORDER BY roledname";
		$result = $this->db->select($query);
		return $result;
	}




	// Edit Role By Id Method 
	public function editRoleById($roleid){
		$roleid = preg_replace('/[^a-zA-Z0-9-]/', '', $roleid);
		$query = "SELECT * FROM $this->table WHERE roleid = '$roleid'";
		$result = $this->db->select($query);
		return $result;
	}


	// Update Role By Id Method 
	public function updateUserRole($data, $roleid){
		$roleid = preg_replace('/[^a-zA-Z0-9-]/', '', $roleid);
		$roledname 				= $this->fm->validation($data['roledname']);
		$roledname 				= mysqli_real_escape_string($this->db->link, $roledname);

		if (empty($roledname)) {
			$msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error ! </strong>Display Name field must not be Empty!</div>';
		       return $msg;
		       exit();
		       
		}else{


            $query = "UPDATE $this->table
                SET
                roledname 			= '$roledname'
                WHERE roleid = '$roleid'
                
            ";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
					$msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        <strong>Success! </strong> User Role Updated Successfully !</div>';
			        return  $msg;
			        exit();
			}else{
			$msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error ! </strong>Something went wrong , Data not updated.</div>';
		       return $msg;
		       exit();
		       
			}
		}
	}


	// Delete Role By Id Method 
	public function deleteRoleById($roleid){
		$roleid = preg_replace('/[^a-zA-Z0-9-]/', '', $roleid);
		$query = "DELETE FROM $this->table WHERE roleid = '$roleid'";
		$delete_row = $this->db->delete($query);
		if ($delete_row) {
					$msg = ' <div class="alert alert-success alert-dismissible" id="flash-msg">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success! </strong> User Role Deleted Successfully !</div>';
		        return  $msg;
		        exit();
		}else{
			$msg = '<div class="alert alert-danger alert-dismissible" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error ! </strong>Something went wrong , Data not Deleted.</div>';
	       return $msg;
	       exit();
	       
		}
	}

	// Select Permission list
	public function selectPermissionItem($data){
		$query = "SELECT * FROM $this->table where rolename = '$data'";
		return $result = $this->db->select($query);
 

        

	    
	



     }

















}