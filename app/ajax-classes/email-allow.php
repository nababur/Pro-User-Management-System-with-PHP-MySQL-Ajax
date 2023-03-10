<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/AppAutho.php");
$apa = new AppAutho();


// Swithch to Email
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$allow_email 	  = $_POST['allow_email'];
	$id_autho 	  = $_POST['id_autho'];
	$addEmailValue = $apa->addEmailValuse($allow_email, $id_autho);
}


