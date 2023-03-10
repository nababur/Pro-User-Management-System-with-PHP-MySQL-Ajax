<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/AppAutho.php");
$apa = new AppAutho();


// Swithch to Github
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$git_autho 	  = $_POST['git_autho'];
	$id_autho 	  = $_POST['id_autho'];
	$addGithubValue = $apa->addGithubValuse($git_autho, $id_autho);
}


