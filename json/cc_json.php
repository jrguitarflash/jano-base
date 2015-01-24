<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//Inicio de sesion
session_start();

switch ($_REQUEST['json']) 
{

	/**************************************/
	// MODULO FINANZAS & CENTRO DE COSTOS
	/**************************************/

	case 'opeBanTem_eli':

		$sql=sql::finan_opeBanTem_eli($_GET['opeBanId'],$_GET['tipCent']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'opeBanTem_actu':

		$filAfect1=0;

		$sql=sql::finan_opeBanTem_actu($_GET['moneId'],
								   $_GET['monto'],
								   $_GET['fechCli'],
								   $_GET['fechDoc'],
								   $_GET['opeIdBan'],
								   $_GET['tipCent'],
								   $_GET['fechIni'],
								   $_GET['tasAnu'],
								   $_GET['comisInte'],
								   $_GET['estaVenci'],
								   $_GET['estaEntre'],
								   $_GET['correOpe']);

		$filAfect1=negocio::getVal($sql,'response');			

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'comisInte_calcu':

		$rowAfect=0;

		for($i=0;$i<count($_POST['opeIdBan']);$i++)
		{
			$sql=sql::finan_comisInte_calcu($_POST['opeIdBan'][$i],$_POST['tipCent']);
			$rowAfect+=negocio::getVal($sql,'response');		
		}

		$data=Array();
		$data[0]=$rowAfect;

		echo json_encode($data);

	break;

	case 'opeBan_reno':

		$rowAfect=0;

		for($i=0;$i<count($_POST['opeIdBan']);$i++)
		{
			$sql=sql::finan_opeBan_reno($_POST['opeIdBan'][$i],$_POST['tipCent']);
			$rowAfect+=negocio::getVal($sql,'response');		
		}

		$data=Array();
		$data[0]=$rowAfect;

		echo json_encode($data);

	break;

	//--------------------------o-----------------------------------

	/*****************************************************/
		# CENTRO DE COSTOS
	/****************************************************/

	case 'impuVisi':
		
		for($i=0;$i<count($_POST['idVisiArr']);$i++)
		{
			$paramArr=Array();
			$paramArr=explode('|',$_POST['idVisiArr'][$i]);
			$sql=sql::cc_visiCent_asociar($paramArr[1],$paramArr[2],$paramArr[3]);
			$filAfect=negocio::getVal($sql,'response');
		}

		$msj=Array();
		$msj[0]=$filAfect;

		echo json_encode($msj);

	break;

	case 'persoEw':
		$sql=sql::cc_perEw_capturar();
		$data_perEw_capturar=negocio::getData($sql);
		echo json_encode($data_perEw_capturar);
	break;

	case 'cc_centAnu_cre':

		$sql=sql::cc_flCent_cre($_GET['cc_alias']);
		$flId=negocio::getVal($sql,'response');

		desconectar();
		conectar();

		$sql=sql::cc_proyeCent_cre($_GET['cc_proyDes']);
		$idProye=negocio::getVal($sql,'response');

		desconectar();
		conectar();

		$sql=sql::cc_centAnu_cre($_GET['cc_correCent'],
								$flId,
								$_SESSION['SIS'][5],
								$idProye,
								$_GET['cc_fechApe']);

		$centAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$centAfect;

		echo json_encode($data);

	break;

	//New update 05/01/2015 - CLOSE
	//           06/01/2015

	case 'cc_ordEmp_obte':

		$empId=$_SESSION['SIS'][5];
		$sql=sql::cc_ordEmp_obte($empId);
		$dataOrd=negocio::getData($sql);

		echo json_encode($dataOrd);

	break;

	case 'cc_centEmp_obte':

		$empId=$_SESSION['SIS'][5];
		$sql=sql::cc_centEmp_obte($empId);
		$dataCent=negocio::getData($sql);

		echo json_encode($dataCent);

	break;

	case 'cc_centDest_obte':

		$empId=$_SESSION['SIS'][5];
		$sql=sql::cc_centDest_obte($empId);
		$dataCent=negocio::getData($sql);

		echo json_encode($dataCent);

	break;

	case 'cc_ordxDest_actu':

		$afectAcum=0;

		for($i=0;$i<count($_POST['ordId']);$i++)
		{
			$sql=sql::cc_ordxDest_actu($_POST['centDest'],$_POST['ordId'][$i]);
			$filAfect=negocio::getVal($sql,'response');
			$afectAcum=$afectAcum+$filAfect;
		}

		$msj=Array();
		$msj[0]=$afectAcum;

		echo json_encode($msj);

	break;

	
	default:
		# code...
	break;

	//-----------------------o-------------------------------
}

?>