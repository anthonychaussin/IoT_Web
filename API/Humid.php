<?php 
/**
 * Classe Humidite
 */
class Humid
{
	public $Humidite;
	
	function __construct($Humidite)
	{
		if ($Humidite < 0) {$Humidite = 0;}
		$this->Humidite = $Humidite;
	}
}
 ?>