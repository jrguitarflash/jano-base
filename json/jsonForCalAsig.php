<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	$sql=sql::vaca_getForCal($_GET['trabId'],$_GET['perId']);
	$valForCal=negocio::getVal($sql,'forCal');

	$dataResul=Array();
	$dataResul[0]=$valForCal;
	echo json_encode($dataResul);

?>

		
