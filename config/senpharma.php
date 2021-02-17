<?php

/**
 * 
 */
class SenPharma
{

	private static $_sqlConnexion;

	public function __construct()
	{

		self::_connect();

	}

	private static function _connect()
	{

		$host = "localhost";
		$db_name = "pharmacydb";
		$username = "root";
		$password = "";

		try {

			self::$_sqlConnexion = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
		}

		// show error
		catch(PDOException $exception) {
			echo "Connection error: " . $exception->getMessage();
		}

	}


	public function getPharmacies()
	{
		$query = "SELECT p_Name, p_Location, p_Number, p_Status, p_Open, p_Close, p_GuardThisWeek FROM pharmacies";

		try {

			$stmt = self::$_sqlConnexion->prepare($query);

			$stmt->execute();

			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if ($results !== null) {

				$pharmacies = json_encode($results);

				echo $pharmacies;

			} else {

				$response = json_encode(array('STATUS' => 'No-Pharmacies-Error' , 'CODE' => 'NPF', 'DESCRIPTION' => 'No Pharmacies Found : The query returned an empty result.'));

				echo $response;

			}
			
		} catch (Exception $exception) {

			$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error, the operation can not proceed'));

			echo $response;
			
		}
	}


	public function getPharmacyById($id)
	{
		$query = "SELECT p_Name, p_Location, p_Number, p_Status, p_Open, p_Close from pharmacies WHERE p_ID = $id";

		try {

			$stmt = self::$_sqlConnexion->prepare($query);

			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($result) {

				$pharmacy = json_encode($result);

				echo $pharmacy;

			} else {

				$response = json_encode(array('STATUS' => 'No-Pharmacy-Error' , 'CODE' => 'NPF', 'DESCRIPTION' => 'Not Pharmacy Found : No pharmacy matching the provided ID has been found.'));

				echo $response;

			}
			
		} catch (Exception $exception) {

			$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error, the operation can not proceed'));

			echo $response;
			
		}
	}


	public function getPharmacyByName($name)
	{
		$query = "SELECT p_Name, p_Location, p_Number, p_Status, p_Open, p_Close from pharmacies WHERE p_Name = '$name'";

		try {

			$stmt = self::$_sqlConnexion->prepare($query);

			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($result) {

				$pharmacy = json_encode($result);

				echo $pharmacy;

			} else {

				$response = json_encode(array('STATUS' => 'No-Pharmacy-Error' , 'CODE' => 'NPF', 'DESCRIPTION' => 'No Pharmacy Found : No pharmacy matching the provided name has been found.'));

				echo $response;

			}
			
		} catch (Exception $exception) {

			$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error, the operation can not proceed'));

			echo $response;
			
		}
	}


	public function searchPharmacy($name)
	{
		$query = "SELECT p_Name, p_Location, p_Number, p_Status, p_Open, p_Close from pharmacies WHERE p_Name LIKE '%$name%'";

		try {

			$stmt = self::$_sqlConnexion->prepare($query);

			$stmt->execute();

			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (count($results) > 0) {

				$found_pharmacies = json_encode($results);

				echo $found_pharmacies;

			} else {

				$response = json_encode(array('STATUS' => 'No-Pharmacies-Error' , 'CODE' => 'NPF', 'DESCRIPTION' => 'No Pharmacies Found : No pharmacies matching the provided name have been found.'));

				echo $response;

			}
			
		} catch (Exception $exception) {

			$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error, the operation can not proceed'));

			echo $response;
			
		}
	}

	public function filterPharmaciesByStatus($status)
	{
		$query = "SELECT p_Name, p_Location, p_Number, p_Status, p_Open, p_Close, p_GuardThisWeek from pharmacies WHERE p_Status = '$status'";

		try {

			$stmt = self::$_sqlConnexion->prepare($query);

			$stmt->execute();

			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if ($results !== null) {

				$pharmacies = json_encode($results);

				echo $pharmacies;

			} else {

				$response = json_encode(array('STATUS' => 'No-Pharmacies-Error' , 'CODE' => 'NPF', 'DESCRIPTION' => 'No Pharmacies Found : No pharmacies matching the provided status have been found.'));

				echo $response;

			}
			
		} catch (Exception $exception) {

			$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error, the operation can not proceed'));

			echo $response;
			
		}
	}


	public function getDrugByName($name)
	{
		$query = "SELECT d_Name, d_AvailAT from drugs WHERE d_Name LIKE '%$name%'";

		try {

			$stmt = self::$_sqlConnexion->prepare($query);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!empty($row)) {

				$drug_available_in = json_encode($row);

				echo $drug_available_in;

			} else {

				$response = json_encode(array('STATUS' => 'No-Drug-Error' , 'CODE' => 'DNF', 'DESCRIPTION' => 'No Drug Found : No drug matching the provided name has been found.'));

				echo $response;

			}
			
		} catch (Exception $exception) {

			$response = json_encode(array('STATUS' => 'Unexpected-Error' , 'CODE' => 'UNEX', 'DESCRIPTION' => 'Due to an unexpected error, the operation can not proceed'));

			echo $response;
			
		}
	}

}

?>