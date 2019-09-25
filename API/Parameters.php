<?php 
/**
 * Classe Parametrs
 */
class Parameters
{
	public $Temperature_Max;
	public $Temperature_Min;
	public $Humidite_Max;
	public $Humidite_Min;
	
	function __construct($Temperature_Max, $Temperature_Min, $Humidite_Max, $Humidite_Min)
	{
		$this->Temperature_Max = new Temp($Temperature_Max);
		$this->Temperature_Min = new Temp($Temperature_Min);
		$this->Humidite_Max = new Humid($Humidite_Max);
		$this->Humidite_Min = new Humid($Humidite_Min);
	}
}

 ?>