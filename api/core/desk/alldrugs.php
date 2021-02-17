<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

// include database connection
include 'config/sqldbconf.php';


$query = "SELECT * FROM drugs";
 
$stmt = $con->prepare($query);

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($results);

//echo $json;
?>