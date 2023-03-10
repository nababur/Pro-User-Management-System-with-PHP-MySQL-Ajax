
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/Users.php");
$usr = new Users();

//setting header to json
header('Content-Type: application/json');


//execute query
$result = $usr->getMonthlyNewUser();

//loop through the returned data

  if ($result) {
   $count = mysqli_num_rows($result);
   if ($count > 0) {
    $data= $count;
   }
  }


//now print the data
print json_encode($data);






                    



