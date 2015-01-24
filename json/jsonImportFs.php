<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* Iniciar indices */

$cotiId=$_GET['cotiId'];
$fsId=$_GET['fsId'];

/* Asociar el fs en el fl */
$sql=sql::ce_asocFs($cotiId,$fsId);
$filAfect1=negocio::setData($sql);

/* Obtener data de fs */
$sql=sql::ce_getFsDetxId($fsId);
$dataFs=negocio::getData($sql);

/* Evaluar tamaño de items actual de detalle cotizacion */
$sql=sql::ce_evaTamItems($cotiId);
$tamItems=negocio::getVal($sql,'contItems')+1;


foreach($dataFs as $data)
{

	/* Incluir descripcion de data como productos nuevos */
	$sql=sql::ce_incluDesProd(1,1,$data['des'],$data['des'],$data['des']);
	$filAfect2=negocio::setData($sql);

	/* Capturar Id de productos añadidos */
	$idFilAfect2=negocio::getInsertId();
	$prodIdServ=$idFilAfect2;

	/* Incluir el detalle del fs en el detalle del fl de la data obtenida */
	$sql=sql::ce_setDetFs($prodIdServ,$data['moneId'],$data['unid'],$data['preUnit'],$data['preUnit'],$data['cant'],$data['tot'],1,$cotiId,2,
							$data['des'],$data['tipDet'],$tamItems++);
	$filAfect3=negocio::setData($sql);

}

$mensaje=Array();
$mensaje[0]=$filAfect3;

echo json_encode($mensaje);

?>