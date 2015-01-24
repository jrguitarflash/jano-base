
<?php
//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* INICIAR CAMPOS DE DETALLE COTIZACION SERVICIO */
$detDes=$_GET['detDes'];
$detUnid=$_GET['detUnid'];
$detPreUni=$_GET['detPreUni'];
$detCant=$_GET['detCant'];
$cotServId=$_GET['cotServId'];
$totDetCoti=$detCant*$detPreUni;
$detCotId=$_GET['detCotId'];
$detTip=$_GET['detTip'];

/* TAREAS A EFECTUAR EN DETALLE DE COTIZACION SERVICIO */
switch ($_GET['tare']) 
{
	case 'add':
		$sql=sql::cs_addCotServ($detDes,$detUnid,$detPreUni,$detCant,$totDetCoti,$cotServId,$detTip);
		$filAfect1=negocio::setData($sql);
	break;

	case 'edit':
		$sql=sql::cs_actuDetCoti($detDes,$detUnid,$detPreUni,$detCant,$totDetCoti,$detCotId,$detTip);
		$filAfect1=negocio::setData($sql);
	break;

	case 'delete':
		$sql=sql::cs_deleDetCot($detCotId);
		$filAfect1=negocio::setData($sql);
	break;
	
	default:
	break;
}

/* INICIAR NOTIFICACION */
$notifi=$filAfect1." Detalle grabada correctamente...!";
$mensaje=negocio::msjNotifi($notifi);
$dataMen=Array();
$dataMen[0]=$mensaje;

echo json_encode($dataMen);

?>