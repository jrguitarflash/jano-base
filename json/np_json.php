<?php

	require("../conf.php");
	require("../clases/sql/sql.class.php");
	require("../clases/negocio/negocio.class.php");

	switch ($_REQUEST['json']) 
	{
		case 'acciNuevItem':

			$sql=sql::np_detNot_ingre($_GET['idNot'],
	 								  $_GET['idLine'],
	 								  $_GET['cant']);

	    	$filAfect1=negocio::getVal($sql,'response');

	    	$msj=array();
	    	$msj[0]=$filAfect1;

	    	echo json_encode($msj);

		break;

		case 'detNot_eli':

			$sql=sql::np_detNot_eli($_GET['idDet']);
			$filAfect1=negocio::getVal($sql,'response');

			$msj=array();
			$msj[0]=$filAfect1;

			echo json_encode($msj);

		break;

		case 'notPed_eli':

			$sql=sql::np_notPed_eli($_GET['idNot']);
			$filAfect1=negocio::getVal($sql,'response');

			$msj=array();
			$msj[0]=$filAfect1;

			echo json_encode($msj);

		break;

		case 'emailPer_obte':

			$sql=sql::np_emailPer_obte($_GET['perId']);
			$dataPer=negocio::getData($sql);

			$msj=array();
			$msj=$dataPer;

			echo json_encode($msj);

		break;

		case 'mailPer_edit':

			$sql=sql::np_mailPer_edit($_GET['perId'],$_GET['perEmail']);
			$filAfect1=negocio::getVal($sql,'response');

			$msj=array();
			$msj[0]=$filAfect1;

			echo json_encode($msj);

		break;

		default:

		break;

	}

?>