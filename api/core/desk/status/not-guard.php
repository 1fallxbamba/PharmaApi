<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include '../../../../config/sqldbconf.php';


$guard = "Non";


try {

	$uname=isset($_GET['uname']) ? $_GET['uname'] : die('ERROR: Record ID not found.');

	// prepare select query 

	$query = "UPDATE pharmacies SET p_GuardThisWeek = '$guard' WHERE p_Username = '$uname'" ;

	$stmt = $con->prepare($query);

 	$stmt->execute();


}

// show error 

catch(PDOException $exception) {
	die('Error: ' . $exception->getMessage());
}


?>