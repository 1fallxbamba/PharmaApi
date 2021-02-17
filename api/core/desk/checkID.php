<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include 'config/sqldbconf.php';

// read current data

try {

	$pOfficial=isset($_GET['pOID']) ? $_GET['pOID'] : die('ERROR: Record ID not found.');


	// prepare select query 

	$query = "SELECT p_Name from pharmacies WHERE p_OfficialID = '$pOfficial'";

	$stmt = $con->prepare($query);

	$stmt->bindParam(1, $pOfficial);

	$stmt->execute();

	// store retrieved row to a variable

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($row) 
	{
		$result = ["exists", $row];
	}
	else
	{
		$result = ["does not exist", $row];;
	}


	echo json_encode($result);


}

// show error 

catch(PDOException $exception) {
	die('Error: ' . $exception->getMessage());
}


?>