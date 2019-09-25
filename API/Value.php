<?php 
/**
 * Classe Value
 */
class Value
{
	public $Date;
	public $Temperature;
	public $Humidite; 
	
	function __construct($Date, $Temperature, $Humidite)
	{
		$this->Date = $Date;
		$this->Temperature = new Temp($Temperature);
		$this->Humidite = new Humid($Humidite);
	}
	public function In_Time($Start_Datetime, $End_Datetime)
	{
		return ($this->Date < $Start_Datetime && $this->Date > $End_Datetime)
	}
}
 ?>