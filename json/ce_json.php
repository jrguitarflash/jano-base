<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");
session_start();

switch ($_REQUEST['json']) 
{
	case 'ce_perEw_listar':
		$sql=sql::ce_perEw_listar();
		$data_perEw_listar=negocio::getData($sql);
		echo json_encode($data_perEw_listar);
	break;

	case 'ce_evenEw_agregar':

		$persoEmpId=$_SESSION['SIS']['10'];
		$funAreId=$_SESSION['SIS']['9'];

		$sql=sql::ce_evenRepi_vali($_GET['fechIni'],$_GET['fechFin'],$_GET['horaEvenIni'],$_GET['horaEvenFin'],$persoEmpId,0);
		$valVeri=negocio::getVal($sql,'response');

		desconectar();
		conectar();

		// validar ingreso de actividad con vacaciones existentes
		$paramVali=0;
		if($_GET['checkVali']==1 or $_GET['checkVali']==0)
		{
			$sql=sql::ce_evenExis_vali($persoEmpId,$_GET['fechIni'],$_GET['fechFin'],0);
			$valVeri2=negocio::getVal($sql,'response');
			$paramVali=$valVeri2;
		}

		desconectar();
		conectar();


		if($valVeri==1)
		{
			$msj=Array();
			$msj[0]=$valVeri;
			$msj[1]="El Horario asignado no se encuentra disponible...!";
			echo json_encode($msj);
		}
		else if($paramVali>0)
		{
			$msj=Array();
			$msj[0]=2;
			$msj[1]="Existen actividades en el rango de vacaciones deseadas";
			echo json_encode($msj);
		}
		else
		{
			$sql=sql::ce_evenEw_agregar($persoEmpId,$funAreId,$_GET['fechIni'],$_GET['fechFin'],$_GET['horaEvenIni'],$_GET['horaEvenFin'],$_GET['desEven'],$_GET['checkVali']);
			$val_evenEw_agregar=negocio::getVal($sql,'response');
			$msj=Array();
			$msj[0]=$val_evenEw_agregar;
			echo json_encode($msj);
		}

	break;

	case 'ce_evenPer_capturar':
		$sql=sql::ce_evenPer_capturar();
		$data_evenPer_capturar=negocio::getData($sql);
		echo json_encode($data_evenPer_capturar);
	break;

	case 'ce_evenxId_capturar':
		$sql=sql::ce_evenxId_capturar($_SESSION['SIS']['10']);
		$data_evenxId_capturar=negocio::getData($sql);
		echo json_encode($data_evenxId_capturar);
	break;

	case 'ce_evenxId_traer':
		$sql=sql::ce_evenxId_traer($_GET['evenId']);
		$data_evenxId_traer=negocio::getData($sql);
		echo json_encode($data_evenxId_traer);
	break;

	case 'ce_evenxId_actualizar':

		$persoEmpId=$_SESSION['SIS']['10'];
		$funAreId=$_SESSION['SIS']['9'];

		$sql=sql::ce_evenRepi_vali($_GET['fechIni'],$_GET['fechFin'],$_GET['horaEvenIni'],$_GET['horaEvenFin'],$persoEmpId,$_GET['evenId']);
		$valVeri=negocio::getVal($sql,'response');

		desconectar();
		conectar();

		// validar ingreso de actividad con vacaciones existentes
		$paramVali=0;
		if($_GET['checkVali']==1)
		{
			$sql=sql::ce_evenExis_vali($persoEmpId,$_GET['fechIni'],$_GET['fechFin'],$_GET['evenId']);
			$valVeri2=negocio::getVal($sql,'response');
			$paramVali=$valVeri2;
		}

		desconectar();
		conectar();

		if($valVeri==1)
		{
			$msj=Array();
			$msj[0]=$valVeri;
			$msj[1]="El Horario asignado no se encuentra disponible...!";
			echo json_encode($msj);
		}
		else if($paramVali>0)
		{
			$msj=Array();
			$msj[0]=2;
			$msj[1]="Existen actividades en el rango de vacaciones deseadas";
			echo json_encode($msj);
		}
		else
		{
			$sql=sql::ce_evenxId_actualizar($_GET['evenId'],$persoEmpId,$funAreId,$_GET['fechIni'],$_GET['fechFin'],$_GET['horaEvenIni'],$_GET['horaEvenFin'],$_GET['desEven'],$_GET['checkVali']);
			$filAfect1=negocio::getVal($sql,'response');
			$msj=Array();
			$msj[0]=$filAfect1;
			echo json_encode($msj);
		}

	break;

	case 'ce_evenxId_eliminar':

		$sql=sql::ce_evenxId_eliminar($_GET['evenId']);
		$filAfect1=negocio::getVal($sql,'response');
		$msj=Array();
		$msj[0]=$filAfect1;
		echo json_encode($msj);

	break;
	
	default:
	break;
}

?>