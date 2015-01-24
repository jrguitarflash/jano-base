<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	//echo $_POST['val'];

	$sql=sql::getVentCobran($_GET['idCobran']);
	$dataCobran=negocio::getData($sql);
	$facArray=Array();
	$facArray=str_split($dataCobran[0]['CO_C_DOCUM']);

	$dataCobran[0]['CO_C_DOCUM1']=$facArray[0].$facArray[1].$facArray[2].$facArray[3];
	$dataCobran[0]['CO_C_DOCUM2']=$facArray[4].$facArray[5].$facArray[6].$facArray[7].$facArray[8].$facArray[9];

	$sql=sql::getDesAnexo($dataCobran[0]['CO_C_CLIEN']);
	$valCli=negocio::getVal($sql,'desCli');
	$dataCobran[0]['desCli']=$valCli;

	echo json_encode($dataCobran);

?>

		
