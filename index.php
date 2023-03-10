<?php

$filepath = realpath(dirname(__FILE__));
include ($filepath.'/app/lib/Session.php');
Session::init();
Session::checkUserLogin();
Session::checkUserSession();




 ?>