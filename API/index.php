<?php 

/**
 * Classe Value
 */
class Value extends AnotherClass
{
	public $Date;
	public $Température
	public $Humidité; 
	
	function __construct($Date, $Température, $Humidité)
	{
		$this->Date = $Date;
		$this->Température = new Temp($Température);
		$this->Humidité = new Humid($Humidité);
	}
	public function In_Time($Start_Datetime, $End_Datetime)
	{
		if ($this->Date < $Start_Datetime && $this->Date > $End_Datetime) {
			return true;
		}
		else{return false;}
	}
}

/**
 * Classe Température
 */
class Temp extends AnotherClass
{
	public $Température
	
	function __construct($Température)
	{
		$this->Température = $Température;
	}
}

/**
 * Classe Humidité
 */
class Humid extends AnotherClass
{
	public $Humidité
	
	function __construct($Humidité)
	{
		if ($Humidité < 0) {$Humidité = 0;}
		$this->Humidité = $Humidité;
	}
}

/**
 * Classe Parametrs
 */
class Parameters extends AnotherClass
{
	public $Température_Max;
	public $Température_Min;
	public $Humidité_Max;
	public $Humidité_Min;
	
	function __construct($Température_Max, $Température_Min, $Humidité_Max, $Humidité_Min)
	{
		$this->Température_Max = new Temp($Température_Max);
		$this->Température_Min = new Temp($Température_Min);
		$this->Humidité_Max = new Humid($Humidité_Max);
		$this->Humidité_Min = new Humid($Humidité_Min);
	}
}

$sgbd = "";
$Server_Name = "";
$DataBase_Name = "";
$User_Id = "";
$PWD = "";



$db = new PDO("$sgbd:server=$Server_Name;Database=$DataBase_Name", $User_Id, $PWD);
$Query_Values = 'SELECT date_value AS [Date], temp_value AS [Température], humid_value AS [Pourcentage_Humidité] FROM value'

$Result = $db->query($Query_Values);

$Result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Value');
$Tab_Value = $Result->fetch();

if (isset($_GET)) {
	if (isset($_GET['Start_Datetime']) && isset($_GET['End_Datetime'])) {
		foreach ($Tab_Value as $key => $value) {
			if (!$value->In_Time($_GET['Start_Datetime'], $_GET['End_Datetime'])) {
				unset($Tab_Value[$key]);
			}
		}
	}
}

$Query_Parameters = 'SELECT temp_max AS [Température_Max], temp_min AS [Température_Min], humid_max AS [Humidité_Max], humid_min AS [Humidité_Min] FROM parameters'

$Result = $db->query($Query_Parameters);

$Result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Parameters');
$Param_Value = $Result->fetch();

$JSON = array('Parameters' => $Param_Value, 'Value' => $Param_Value );
echo json_encode($JSON);
 ?>