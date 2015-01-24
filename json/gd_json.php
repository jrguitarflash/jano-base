<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");
session_start();

switch ($_REQUEST['json']) 
{

	case 'gd_gestDoc_cread':

	    $_GET['usuId']=$_SESSION['SIS'][2];

		$sql=sql::gd_gestDoc_cread($_GET['doc'],
						$_GET['gest'],
						$_GET['fech'],
						$_GET['hora'],
						$_GET['lugar'],
						$_GET['usuId'],
						$_GET['estaGest'],
						$_GET['lati'],
						$_GET['longi']);

		$gestAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$gestAfect;

		echo json_encode($data);

	break;

	case 'gd_gestDoc_cont':

		$sql=sql::gd_gestDoc_cont($_GET['estaId'],$_GET['fechGest']);
		$cantGest=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$cantGest;

		echo json_encode($data);

	break;

	case 'gd_gestDocxId_cap':

		$sql=sql::gd_gestDocxId_cap($_GET['gestId']);
		$dataGestDoc=negocio::getData($sql);

		$data=Array();
		$data=$dataGestDoc;

		echo json_encode($data);

	break;

	case 'gd_gestDoc_edit':

		$sql=sql::gd_gestDoc_edit($_GET['idGest'],
								  $_GET['doc'],
								  $_GET['gest'],
								  $_GET['fech'],
								  $_GET['hora'],
								  $_GET['lugar'],
								  $_GET['estaGest']);

		$gestAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$gestAfect;

		echo json_encode($data);

	break;

	case 'gd_gestDoc_eli':

		$sql=sql::gd_gestDoc_eli($_GET['idGest']);
		$gestAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$gestAfect;

		echo json_encode($data);

	break;

	case 'gd_gestFechxEsta_cont':

		$fechGest=date('Y-m-d');
		$estaGest=1;

		$sql=sql::gd_gestFechxEsta_cont($fechGest,$estaGest);
		$gestAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$gestAfect;

		echo json_encode($data);

	break;

	case 'gd_rutGest_cread':

		$admId=$_SESSION['SIS'][2];
		$sql=sql::gd_rutGest_cread($_GET['respId'],$admId,$_GET['estaRutId'],$_GET['fechRut'],$_GET['hourRut']);
		$rutAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$rutAfect;

		echo json_encode($data);

	break;

	case 'gd_rutxId_cap':

		$sql=sql::gd_rutxId_cap($_GET['rutId']);
		$dataRut=negocio::getData($sql);

		echo json_encode($dataRut);

	break;

	case 'gd_rutGest_cont':

		$sql=sql::gd_rutGest_cont($_GET['estaId'],$_GET['fechRut']);
		$rutAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$rutAfect;

		echo json_encode($data);

	break;

	case 'gd_rutGest_actu':

		$sql=sql::gd_rutGest_actu($_GET['idRut'],
								$_GET['estaRutId'],
								$_GET['fechRut'],
								$_GET['hourRut'],
								$_GET['respId']);

		$rutAfect=negocio::getVal($sql,'response');

		//evaluar estado de ruta
		if($_GET['estaRutId']==1)
		{
			$estaGest=3;
		}
		else
		{
			$estaGest=2;
		}

		desconectar();
		conectar();
		$sql=sql::gd_detRutxId_concre($_GET['idRut'],$estaGest);
		$detAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$rutAfect;

		echo json_encode($data);

	break;

	case 'gd_rutGest_eli':

		$sql=sql::gd_rutGest_eli($_GET['rutId']);
		$rutAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$rutAfect;

		echo json_encode($data);

	break;

	case 'gd_rutGest_det':

		$acum=0;

		for($i=0;$i<count($_POST['gestDocId']);$i++)
		{
			$sql=sql::gd_rutGest_det($_POST['rutId'],$_POST['gestDocId'][$i]);
			$rutAfect=negocio::getVal($sql,'response');
			$acum=$acum+$rutAfect;	
		}

		$data=Array();
		$data[0]=$rutAfect;

		echo json_encode($data);
		

	break;

	case 'gd_detRutxId_eli':

		$sql=sql::gd_detRutxId_eli($_GET['detRutId']);
		$detAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$detAfect;

		echo json_encode($data);

	break;

	case 'gd_detRutxId_concre':

		$detAfectAcum=0;

		for($i=0;$i<count($_POST['rutId']);$i++)
		{
			//concretar ruta
			desconectar();
			conectar();
			$sql=sql::gd_rutxId_concre($_POST['rutId'][$i]);
			$rutAfect=negocio::getVal($sql,'response');

			//finalizar detalle de gestiones
			desconectar();
			conectar();
			$sql=sql::gd_detRutxId_concre($_POST['rutId'][$i],2);
			$detAfect=negocio::getVal($sql,'response');
			$detAfectAcum=$detAfectAcum+$detAfect;
		}

		$data=Array();
		$data[0]=$detAfectAcum;

		echo json_encode($data);

	break;


	default:
	break;

}