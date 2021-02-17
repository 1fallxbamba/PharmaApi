<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


include '../../../config/senpharma.php';

$p_name=isset($_GET['name']) ? $_GET['name'] : die('ERROR: No name provided');

try {

	$s_pharma = new SenPharma();

	$s_pharma->searchPharmacy($p_name);

} catch (Exception $e) {

	$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error the requested operation can not be processed'));

	echo $response;
	
}



?>