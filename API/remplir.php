<?php 

$sgbd = "mysql";
$Server_Name = "localhost";
$DataBase_Name = "iot";
$User_Id = "admin";
$PWD = "admin";



$db = new PDO("$sgbd:server=$Server_Name;Database=$DataBase_Name", $User_Id, $PWD);

$humid = 30;
$temp = 50;
$count = 0;

while ($count <= 300) {
	$count++;
	if(rand(0,1)==0){$humid += rand(0,100)*0.01;}
	else{$humid -= rand(0,100)*0.01;}

	if(rand(0,1)==0){$temp += rand(0,100)*0.01;	}
	else{$temp -= rand(0,100)*0.01;	}

	$Query_Values = 'INSERT INTO value (id_value, date_value, temp_value, humid_value, parameters) VALUES (NULL, CURRENT_TIMESTAMP, ?, ?, 1)';

	$Result = $db->prepare($Query_Values);
	$Result->execute([$temp, $humid]);


	$infoReq = $Result->errorInfo();
	$infoBDD = $db->errorInfo();
	if ($infoReq[1] != NULL || $infoBDD[1] != 0) {
		var_dump($Result->queryString);
		var_dump($infoReq);
		var_dump($infoBDD);
	}

}



 ?>