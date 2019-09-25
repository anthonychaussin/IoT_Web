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
$Query_Values = 'SELECT date_value AS [Date], temp_value AS [Temperature], humid_value AS [Pourcentage_Humidite] FROM value';

$Result = $db->query($Query_Values);

$Result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Value');
$Tab_Value = $Result->fetch();
/*
if (isset($_GET)) {
	if (isset($_GET['Start_Datetime']) && isset($_GET['End_Datetime'])) {
		foreach ($Tab_Value as $key => $value) {
			if (!$value->In_Time($_GET['Start_Datetime'], $_GET['End_Datetime'])) {
				unset($Tab_Value[$key]);
			}
		}
	}
}

$Query_Parameters = 'SELECT temp_max AS [Temperature_Max], temp_min AS [Temperature_Min], humid_max AS [Humidite_Max], humid_min AS [Humidite_Min] FROM parameters';

$Result = $db->query($Query_Parameters);

$Result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Parameters');
$Param_Value = $Result->fetch();

$JSON = array('Parameters' => $Param_Value, 'Value' => $Param_Value );
echo json_encode($JSON);
*/