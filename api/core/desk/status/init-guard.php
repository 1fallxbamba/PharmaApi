<?php

			/// Script to be run every monday

header('Content-Type: text/html; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

// include database connection
include 'config/sqldbconf.php';

$state= "Non";

$query = "UPDATE pharmacies SET p_GuardThisWeek = '$state'" ;

$stmt = $con->prepare($query);

$stmt->execute();


?>