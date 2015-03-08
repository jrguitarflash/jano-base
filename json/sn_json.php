<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

switch ($_REQUEST['json']) 
{
	case 'sn_desProd_obte':
		$sql=sql::sn_desProd_obte($_GET['idDet']);
		$filAfect1=negocio::getVal($sql,'response');
		$msj=Array();
		$msj[0]=$filAfect1;
		echo json_encode($msj);
	break;

	case 'sn_numSeri_agre':

		$sql=sql::sn_numSerixId_eli($_POST['idDetComp']);
		$filAfect1=negocio::getVal($sql,'response');

		for($i=1;$i<count($_POST['arrInputDina']);$i++)
		{
			desconectar();
			conectar();

			$sql=sql::sn_numSeri_agre($_POST['idDetComp'],$_POST['fechAlm'],$_POST['fechAct'],strtoupper($_POST['arrInputDina'][$i]),1);
			$filAfect2=negocio::getVal($sql,'response');
		}

		$msj=Array();
		$msj[0]=$filAfect2;
		echo json_encode($msj);

	break;

	case 'sn_numSeri_eli':
		$sql=sql::sn_numSeri_eli($_GET['idNumSeri']);
		$filAfect1=negocio::getVal($sql,'response');
		$msj=Array();
		$msj[0]=$filAfect1;
		echo json_encode($msj);
	break;

	case 'sn_desCan_obte':
		$sql=sql::sn_desCan_obte($_GET['idDet']);
		$data1=negocio::getData($sql);
		echo json_encode($data1);
	break;

	case 'sn_numSerixId_obte':
		$sql=sql::sn_numSerixId_obte($_GET['idDetComp']);
		$data1=negocio::getData($sql);
		echo json_encode($data1);
	break;

	default:
	break;
}