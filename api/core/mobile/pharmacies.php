<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include '../../../config/senpharma.php';


try {

	$s_pharma = new SenPharma();

	$s_pharma->getPharmacies();

} catch (Exception $e) {

	$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error the requested operation can not be processed'));

	echo $response;
	
}



?>