<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/ClientMsg.php");
$clientMsg = new ClientMsg();



// Client Proposal message
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$clientMsg = $clientMsg->clientProposalMethod($_POST);
	exit();
}


