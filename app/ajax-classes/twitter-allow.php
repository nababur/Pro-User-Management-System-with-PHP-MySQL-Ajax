<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/AppAutho.php");
$apa = new AppAutho();


// Swithch to Twitter
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$tw_autho 	  = $_POST['tw_autho'];
	$id_autho 	  = $_POST['id_autho'];
	$addTwitter = $apa->addTwitterAutho($tw_autho, $id_autho);
}


