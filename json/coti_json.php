<?php 

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

session_start();

switch ($_REQUEST['json']) 
{

	case 'emp_obte':

		$sql=sql::kd_emp_obte($_GET['filBus']);
		$dataEmp=negocio::getData($sql);

		echo json_encode($dataEmp);

	break;

	case 'nuevProye_crear':

		$proyNom=$_GET['proyNom'];
		$empId=$_SESSION['SIS'][5];
		$usuResp=$_SESSION['SIS'][2];
		$cliId=$_GET['cliId'];
		$fechAdju=$_GET['fechAdju'];

		$sql=sql::cot_nuevProye_crear($proyNom,$empId,$cliId,$fechAdju,$usuResp);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'ediProy_ini':

		$empId=$_SESSION['SIS'][5];
		$sql=sql::cot_ediProy_ini($_GET['proyeId'],$empId);
		$dataProye=negocio::getData($sql);

		echo json_encode($dataProye);

	break;

	case 'proye_edit':

		//restriccion de edicion de proyecto
		$usuActi=$_SESSION['SIS'][2];
		$sql=sql::cot_ediProye_restri($_GET['idProye'],$usuActi);
		$filAfect1=negocio::getVal($sql,'response');

		if($filAfect1>0)
		{
			//edicion de proyecto
			desconectar();
			conectar();
			$sql=sql::cot_proye_edit($_GET['idProye'],$_GET['proyNom'],$_GET['cliId'],$_GET['fechAdju']);
			$filAfect1=negocio::getVal($sql,'response');
		}
		else
		{
			$filAfect1=3;
		}


		$msj=array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevUsuFin_crear':

		$sql=sql::cot_nuevUsuFin_crear($_GET['desEmp'],$_GET['rucEmp'],$_GET['direEmp'],$_GET['telEmp'],$_GET['mailEmp']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);


	break;

	default:

	break;

}