<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


include '../../../config/senpharma.php';

$p_status=isset($_GET['status']) ? $_GET['status'] : die('ERROR: No name provided');

try {

	$s_pharma = new SenPharma();

	$s_pharma->filterPharmaciesByStatus($p_status);

} catch (Exception $e) {

	$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error the requested operation can not be processed'));

	echo $response;
	
}


?>