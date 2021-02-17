<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include '../../../config/senpharma.php';

$p_id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: No ID provided');

try {

	$s_pharma = new SenPharma();

	$s_pharma->getPharmacyById($p_id);

} catch (Exception $e) {

	$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error the requested operation can not be processed'));

	echo $response;
	
}


?>