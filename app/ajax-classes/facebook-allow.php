<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/AppAutho.php");
$apa = new AppAutho();


// Swithch to Facebook
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$fb_autho 	  = $_POST['fb_autho'];
	$id_autho 	  = $_POST['id_autho'];
	$addFacebook = $apa->addFacebookAutho($fb_autho, $id_autho);
}


