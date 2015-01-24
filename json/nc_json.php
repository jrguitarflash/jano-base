<?php

/*----------------------------------*/
	#Peticiones Json
/*----------------------------------*/

require("../conf.php");
require("../clases/negocio/negocio.class.php");
require("../clases/sql/sql.class.php");
require("../utils_func.php");

switch ($_REQUEST['json']) 
{

	case 'nc_centCost_obte':

		$sql=sql::nc_centCost_obte();
		$dataCentCost=negocio::getData($sql);

		echo json_encode($dataCentCost);

	break;

	case 'nc_noConfor_cre':

		$sql=sql::nc_noConfor_cre($_GET['centId'],
									$_GET['detecId'],
									$_GET['procId'],
									$_GET['tipObs'],
									$_GET['estaConfor'],
									$_GET['fechRecep'],
									$_GET['desConfor'],
									$_GET['respInme'],
									$_GET['fechCie'],
									$_GET['tipConfor'],
									$_GET['medPrev'],
									$_GET['obsId'],
									$_GET['oriObs']);

		$conforAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$conforAfect;

		echo json_encode($data);

	break;

	case 'nc_datCent_obte':

		$sql=sql::nc_datCent_obte($_GET['centId']);
		$dataCent=negocio::getData($sql);

		echo json_encode($dataCent);

	break;

	//New update 14/01/2015 - OPEN

	case 'nc_noConforxFil_cont':

		$sql=sql::nc_noConforxFil_cont($_GET['fechRecep'],$_GET['estaConfor'],$_GET['obsId'],$_GET['oriObs']);
		$cont=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$cont;

		echo json_encode($data);

	break;

	case 'nc_noConforxId_obte':

		$sql=sql::nc_noConforxId_obte($_GET['conforId']);
		$dataConfor=negocio::getData($sql);

		echo json_encode($dataConfor);

	break;

	case 'nc_noConfor_edit':

		$sql=sql::nc_noConfor_edit($_GET['conforId'],
									 $_GET['centId'],
									 $_GET['detecId'],
									 $_GET['procId'],
									 $_GET['tipObs'],
									 $_GET['tipConfor'],
									 $_GET['estaConfor'],
									 $_GET['desConfor'],
									 $_GET['fechRecep'],
									 $_GET['respInme'],
									 $_GET['fechCie'],
									 $_GET['medPrev'],
									 $_GET['obsId'],
									 $_GET['oriObs']);

		$conforAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$conforAfect;

		echo json_encode($data);

	break;

	case 'nc_infoAdju_borra':

		$sql=sql::nc_infoAdju_borra($_GET['adjuId']);
		$adjuAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$adjuAfect;

		echo json_encode($data);
	
	break;

	case 'nc_detEquip_cre':

		$detAfectAcum=0;

		for($i=0;$i<count($_POST['detCompId']);$i++)
		{
			desconectar();
			conectar();

			$sql=sql::nc_detEquip_cre($_POST['conforId'],$_POST['detCompId'][$i]);
			$detAfect=negocio::getVal($sql,'response');
			$detAfectAcum=$detAfectAcum+$detAfect;
		}

		$data=Array();
		$data[0]=$detAfectAcum;

		echo json_encode($data);

	break;

	case 'nc_detEquip_borra':

		$sql=sql::nc_detEquip_borra($_GET['equiId']);
		$detAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$detAfect;

		echo json_encode($data);

	break;

	case 'nc_medCorre_cre':

		$sql=sql::nc_medCorre_cre($_GET['conforId'],
									$_GET['medDes'],
									$_GET['respMed'],
									$_GET['fechCorrec'],
									$_GET['ingAsig']);

		$medAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$medAfect;

		echo json_encode($data);

	break;

	case 'nc_medxId_ini':

		$sql=sql::nc_medxId_ini($_GET['medId']);
		$dataMed=negocio::getData($sql);

		echo json_encode($dataMed);

	break;

	case 'nc_medCorrec_edit':

		$sql=sql::nc_medCorrec_edit($_GET['medId'],
									$_GET['medDes'],
									$_GET['fechCorrec'],
									$_GET['ingAsig'],
									$_GET['respMed']);

		$medAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$medAfect;

		echo json_encode($data);

	break;

	case 'nc_medCorrec_borra':

		$sql=sql::nc_medCorrec_borra($_GET['medId']);
		$medAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$medAfect;

		echo json_encode($data);

	break;

	case 'nc_noConfor_borrar':

		$sql=sql::nc_noConfor_borrar($_GET['conforId']);
		$conforAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$conforAfect;

		echo json_encode($data);

	break;

	//New Update 08/01/2015 - CLOSE
	//			 12/01/2015 

	case 'nc_medPrev_cre':

		$sql=sql::nc_medPrev_cre($_GET['noConforId'],$_GET['desPrev'],$_GET['fechPrev']);
		$filAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$filAfect;

		echo json_encode($data);

	break;

	case 'nc_medPrevxId_borra':

		$sql=sql::nc_medPrevxId_borra($_GET['medId']);
		$filAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$filAfect;

		echo json_encode($data);

	break;

	case 'nc_medPrevxId_obte':

		$sql=sql::nc_medPrevxId_obte($_GET['medId']);
		$dataPrev=negocio::getData($sql);

		echo json_encode($dataPrev);

	break;

	case 'nc_medPrev_edit':

		$sql=sql::nc_medPrev_edit($_GET['medId'],$_GET['desPrev'],$_GET['fechPrev']);
		$filAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$filAfect;

		echo json_encode($data);

	break;

	default:
	break;
}

?>