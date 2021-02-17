<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

// include database connection
include '../../../../config/sqldbconf.php';


$pharmacy=isset($_GET['pharma']) ? $_GET['pharma'] : die('ERROR: Record ID not found.');

$drug=isset($_GET['drug']) ? $_GET['drug'] : die('ERROR: Record ID not found.');


$query = "SELECT d_AvailAT FROM drugs WHERE d_Name = '$drug'";

$stmt = $con->prepare($query);

$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
$pharmacies_where_drug_available = json_encode($row["d_AvailAT"]);



$query2 = "SELECT JSON_SEARCH($pharmacies_where_drug_available, 'one', '$pharmacy') AS Res ";

$stmt2 = $con->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

$pos = $row2["Res"];



$query3 = "UPDATE drugs SET d_AvailAT = JSON_REMOVE(d_AvailAT, $pos) WHERE d_Name = '$drug'";

$stmt3 = $con->prepare($query3);
$stmt3->execute();


if ($pos) {

	echo json_encode("Record successfully deleted, the drug is not available anymore in the pharmacy");

}
else {

	echo json_encode("The drug is already not available in the pharmacy");

}


?>