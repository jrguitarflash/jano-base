<?php

//------------ CLASE AÑADIDA -----------------//
include("../conf.php");
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

// TEST1

/*
	$sql="select * from test-user";
	$data=negocio::getData($sql,$cn2)

	foreach($data as $data)
	{
		echo $data['user']."</br>";
	}
*/

// TEST2

$sql=sql::kd_lineProd_sub(5);
$data1=negocio::getData($sql);
print_r($data1);

?>

