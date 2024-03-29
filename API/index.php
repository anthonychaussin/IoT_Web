<?php 

require 'Humid.php';
require 'Temp.php';
require 'Value.php';
require 'Parameters.php';

$sgbd = "mysql";
$Server_Name = "localhost";
$DataBase_Name = "iot";
$User_Id = "admin";
$PWD = "admin";



$db = new PDO("$sgbd:server=$Server_Name;Database=$DataBase_Name", $User_Id, $PWD);

$Query_Values = 'SELECT date_value AS "Date", temp_value AS "Temperature", humid_value AS "Pourcentage_Humidite" FROM iot.value';

$Result = $db->prepare($Query_Values);
$Result->execute();


$infoReq = $Result->errorInfo();
		$infoBDD = $db->errorInfo();
		if ($infoReq[1] != NULL || $infoBDD[1] != 0) {
			var_dump($Result->queryString);
			var_dump($infoReq);
			var_dump($infoBDD);
		}


$Result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Value');
$Tab_Value = $Result->fetchAll();

if (isset($_GET)) {
	if (isset($_GET['Start_Datetime']) && isset($_GET['End_Datetime'])) {
		foreach ($Tab_Value as $key => $value) {
			if (!$value->In_Time($_GET['Start_Datetime'], $_GET['End_Datetime'])) {
				unset($Tab_Value[$key]);
			}
		}
	}
}

$Query_Parameters = 'SELECT temp_max AS "Temperature_Max", temp_min AS "Temperature_Min", humid_max AS "Humidite_Max", humid_min AS "Humidite_Min" FROM iot.parameters';

$Result = $db->prepare($Query_Parameters);
$Result->execute();

$infoReq = $Result->errorInfo();
		$infoBDD = $db->errorInfo();
		if ($infoReq[1] != NULL || $infoBDD[1] != 0) {
			var_dump($Result->queryString);
			var_dump($infoReq);
			var_dump($infoBDD);
		}

$Result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Parameters');
$Param_Value = $Result->fetchAll();

$JSON = array('Parameters' => $Param_Value, 'Value' => $Tab_Value );
$JSON_String = json_encode($JSON);
echo $JSON_String;
