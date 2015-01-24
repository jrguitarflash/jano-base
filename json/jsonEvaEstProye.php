<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	/* OBTENER ESTADO DE CENTRO DE COSTO */

	$sql=sql::cc_getEstProy($_GET['idCent']);
	$valEstaProye=negocio::getVal($sql,'estaProye');

	$dataEstProy=Array();
	$dataEstProy[0]['estaProye']=$valEstaProye;

	echo json_encode($dataEstProy);

?>