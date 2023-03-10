<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * Permissions Roles Class
 */
class Permissions{
	
	private $table = "tbl_permissions";
	private $db;
	private $fm;

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}





	// Select Role Method 
	public function selectAllPermissions(){
		$query = "SELECT * FROM $this->table ORDER BY perid DESC";
		$result = $this->db->select($query);
		return $result;
	}


	



}