<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

// include database connection
include '../../../../config/sqldbconf.php';


$pharmacy=isset($_GET['name']) ? $_GET['name'] : die('ERROR: Record ID not found.');


$query = "UPDATE drugs SET d_AvailAT = JSON_ARRAY_APPEND(d_AvailAT, '$','$pharmacy')";

 
$stmt = $con->prepare($query);

$stmt->execute();


?>