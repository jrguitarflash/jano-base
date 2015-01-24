<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	$sql=sql::vaca_getPeriAnxTod();
	$dataPeri=negocio::getData($sql);

	$valEvaDispo=negocio::evaPeriDispo($_GET['trabId'],$dataPeri);

	$dataResul=Array();
	$dataResul[0]=$valEvaDispo;
	echo json_encode($dataResul);

?>

		
