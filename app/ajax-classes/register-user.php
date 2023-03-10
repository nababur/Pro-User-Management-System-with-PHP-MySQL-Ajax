<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/Users.php");
$usr = new Users();



// User Login Authotication
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$register = $usr->newUserRegistration($_POST);
	exit();
}


