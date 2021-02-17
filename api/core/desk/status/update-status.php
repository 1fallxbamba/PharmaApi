<?php

header('Content-Type: text/html; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

date_default_timezone_set("Africa/Dakar");

// include database connection
include 'config/sqldbconf.php';


$t = time();

$d = time();

$real_time = (int)date("H", $t);

$real_date = (int)date("w", $t);

$open = "Ouverte";

$close = "Fermée";

$guard = "En garde";

// select all data
$query = "SELECT * FROM pharmacies";
 
$stmt = $con->prepare($query);

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($real_date == 0)
{

	for ($x = 0; $x < count($results); $x++)
	{
		if ($results[$x]["p_GuardThisWeek"] == "Oui")
		{
			$uname = $results[$x]["p_Username"];

			$query2 = "UPDATE pharmacies SET p_Status = '$guard' WHERE p_Username = '$uname'" ;

			$stmt2 = $con->prepare($query2);

 	 		$stmt2->execute();
		}
	}

}

else
{
	for ($x = 0; $x < count($results); $x++)
	{

		if ((int)$results[$x]["p_Open"] <= $real_time)
		{

			$uname = $results[$x]["p_Username"];

			$query3 = "UPDATE pharmacies SET p_Status = '$open' WHERE p_Username = '$uname'" ;

			$stmt3 = $con->prepare($query3);

 	 		$stmt3->execute();

		}

		if ((int)$results[$x]["p_Close"] <= $real_time) 
		{

			$uname = $results[$x]["p_Username"];

			$query4 = "UPDATE pharmacies SET p_Status = '$close' WHERE p_Username = '$uname'" ;

			$stmt4 = $con->prepare($query4);

 	 		$stmt4->execute();
		
		}

	}

}


?>