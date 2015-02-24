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

	//New 23/02/2015

	case 'nc_grafTip':

		$arrIterar=Array();
		$ind=0;

		if($_GET['nc_tipObs']==1)
		{

		    desconectar();
			conectar();
			$sql=sql::nc_obs_obte();
			$dataObs=negocio::getData($sql);

			foreach($dataObs as $data)
			{
				//nc_obsId
				desconectar();
				conectar();
				
				$sql=sql::nc_porcexTip_obte(6,$data['nc_obsId'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceConfor=negocio::getVal($sql,'response');

				$arrIterar[$ind]['obsDes']=$data['nc_obsDes'];
				$arrIterar[$ind]['obsPor']=$porceConfor;
				$ind++;
			}

		}
		else if($_GET['nc_tipObs']==2)
		{
			desconectar();
			conectar();
			$sql=sql::nc_tipConfxId_obte(1);
			$dataTipConf=negocio::getData($sql);

			foreach($dataTipConf as $data) 
			{
				//nc_tipConfVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(4,$data['nc_tipNoConforId'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceConfor=negocio::getVal($sql,'response');

				$arrIterar[$ind]['obsDes']=$data['nc_des'];
				$arrIterar[$ind]['obsPor']=$porceConfor;
				$ind++;
			}
		}

		else if($_GET['nc_tipObs']==3)
		{
			desconectar();
			conectar();
			$sql=sql::nc_tipConfxId_obte(2);
			$dataTipConf=negocio::getData($sql);
			$iterar="";

			foreach($dataTipConf as $data) 
			{
				//nc_tipConfVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(4,$data['nc_tipNoConforId'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceConfor=negocio::getVal($sql,'response');

				$arrIterar[$ind]['obsDes']=$data['nc_des'];
				$arrIterar[$ind]['obsPor']=$porceConfor;
				$ind++;
			}
		}

		else if($_GET['nc_tipObs']==4)
		{
			$sql=sql::nc_detec_obte();
			$dataDetec=negocio::getData($sql);
			$iterar="";

			foreach($dataDetec as $data) 
			{
				//nc_detecVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(1,$data['nc_detecVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceDetec=negocio::getVal($sql,'response');

				$arrIterar[$ind]['obsDes']=$data['nc_detecDes'];
				$arrIterar[$ind]['obsPor']=$porceDetec;
				$ind++;
			}
		}

		else if($_GET['nc_tipObs']==5)
		{
			desconectar();
			conectar();
			$sql=sql::nc_procAfect_obte();
			$dataProc=negocio::getData($sql);
			$iterar="";

			foreach($dataProc as $data)
			{
				//nc_proceVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(2,$data['nc_proceVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceProce=negocio::getVal($sql,'response');

				$arrIterar[$ind]['obsDes']=$data['nc_proceDes'];
				$arrIterar[$ind]['obsPor']=$porceProce;
				$ind++;

			}
		}

		else if($_GET['nc_tipObs']==6)
		{
			desconectar();
			conectar();
			$sql=sql::nc_tipObs_obte();
			$dataObs=negocio::getData($sql);
			$iterar="";

			foreach($dataObs as $data) 
			{

				//nc_obsVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(3,$data['nc_obsVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceObs=negocio::getVal($sql,'response');

				$arrIterar[$ind]['obsDes']=$data['nc_obsDes'];
				$arrIterar[$ind]['obsPor']=$porceObs;
				$ind++;

			}
		}

		else if($_GET['nc_tipObs']==7)
		{
			desconectar();
			conectar();
			$sql=sql::nc_estaConfor_obte();
			$dataEstaConfor=negocio::getData($sql);
			$iterar="";

			foreach($dataEstaConfor as $data)
			{
				//nc_estaConforVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(5,$data['nc_estaConforVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceEsta=negocio::getVal($sql,'response');

				$arrIterar[$ind]['obsDes']=$data['nc_estaConforDes'];
				$arrIterar[$ind]['obsPor']=$porceEsta;
				$ind++;
			}
		}


		print json_encode($arrIterar);

	break;

	default:
	break;
}

?>