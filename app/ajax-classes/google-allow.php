<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/AppAutho.php");
$apa = new AppAutho();


// Swithch to Google account
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$gle_autho 	  = $_POST['gle_autho'];
	$id_autho 	  = $_POST['id_autho'];
	$addGoogleValue = $apa->addGoogleValuse($gle_autho, $id_autho);
}


