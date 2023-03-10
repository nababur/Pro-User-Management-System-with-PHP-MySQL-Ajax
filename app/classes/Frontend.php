<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

/**
 * Frontend Class
 */
class Frontend{
	
	private $table = "tbl_app_settings";
	private $db;
	private $fm;

	// Construct auto Load
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}





	// Select All contents form this Table
	public function selectfrontendpart(){
		$query = "SELECT * FROM $this->table";
		$result = $this->db->select($query);
		return $result;
	}















}