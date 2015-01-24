<?php
//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* INICIAR DATOS GENERALES A ACTUALIZAR */
$param=Array();
$param['fechCoti']=$_GET['fechCoti'];
$param['cliId']=$_GET['cliId'];
$param['respComerId']=$_GET['respComerId'];
$param['desServ']=$_GET['desServ'];
$param['priorId']=$_GET['priorId'];
$param['estServId']=$_GET['estServId'];
$param['cotiServId']=$_GET['cotiServId'];
$param['moneId']=$_GET['moneId'];
$sql=sql::cs_actuCotServ(1,$param);
$filAfect1=negocio::setData($sql);

/* INICIAR DATOS CONDICION A ACTUALIZAR */
$param=Array();
$param['reqCond']=$_GET['reqCond'];
$param['tiemEje']=$_GET['tiemEje'];
$param['garanCond']=$_GET['garanCond'];
$param['cotiServId']=$_GET['cotiServId'];
$param['condPag']=$_GET['condPag'];
$param['tiemVali']=$_GET['tiemVali'];
$sql=sql::cs_actuCotServ(2,$param);
$filAfect2=negocio::setData($sql);

/* INICIAR NOTIFICACION */
$notifi=$filAfect1." Cotizacion grabada correctamente...!";
$mensaje=negocio::msjNotifi($notifi);
$dataMen=Array();
$dataMen[0]=$mensaje;

/* ACTUALIZAR ORDEN DE SERVICIO REFERENCIAL EN CENTRO DE COSTO  */

	// Obtener el correlativo de os 
	$sql=sql::os_getCorreOs($_GET['cotiServId']);
	$valCorre=negocio::getVal($sql,'correServ');

	// Actualizar datos referencial os
	$sql=sql::os_actuOsRef($_GET['cliId'],$_GET['moneId'],$valCorre);
	$filAfect3=negocio::setData($sql);


echo json_encode($dataMen);

?>