<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");


switch($_REQUEST['json'])
{
	case 'ordComp':
		$sql=sql::scc_datOrdComp($_GET['idOrd']);
		$data_datOrdComp=negocio::getData($sql);
		echo json_encode($data_datOrdComp);
	break;

	case 'ingreAdel':

		 $sql=sql::scc_evaExisAdel($_GET['idSegui'],$_GET['idOrd'],$_GET['tipAdelId']);
		 $filAfect1=negocio::getVal($sql,'response');

		 desconectar();
		 conectar();

		 $sql=sql::scc_valiFlujAdel($_GET['idSegui'],$_GET['idOrd'],$_GET['tipAdelId']);
		 $filAfect2=negocio::getVal($sql,'response');

		 desconectar();
		 conectar();

		 if($filAfect1==0)
		 {
		 	 if($filAfect2==1)
		 	 {
				 $sql=sql::scc_adelOrdSegui($_GET['tipAdelId'],$_GET['fechAdel'],$_GET['desAdel'],$_GET['idSegui'],$_GET['idOrd']);
				 $filAfect2=negocio::getVal($sql,'response');
				 $msj=$filAfect2;
			 }
			 else
			 {
			 	$msj="<div class=success>La orden no ha completado los adelantos requeridos...!</div>";
			 }
		 }
		 else
		 {
		 	$msj="<div class=success>La orden ya tiene generado el tipo de adelanto....!</div>";
		 }
		 $mensaje=Array();
		 $mensaje[0]=$msj;
		 echo json_encode($mensaje);
	break;

	case 'eliAdel':
		 $sql=sql::scc_eliAdelSegui($_GET['idAdel']);
		 $filAfect1=negocio::getVal($sql,'response');
		 $mensaje=Array();
		 $mensaje[0]=$filAfect1;
		 echo json_encode($mensaje);
	break;

	case 'prevEdit':
		 $sql=sql::scc_adelSeguixId($_GET['idAdel']);
		 $data_adelSeguixId=negocio::getData($sql);
		 echo json_encode($data_adelSeguixId);
	break;

	case 'editAdel':
		 $sql=sql::scc_actuAdelxId($_GET['idAdel'],$_GET['tipAdelId'],$_GET['fechAdel'],$_GET['desAdel']);
		 $filAfect1=negocio::getVal($sql,'response');
		 $mensaje=Array();
		 $mensaje[0]=$filAfect1;
		 echo json_encode($mensaje);
	break;

	case 'geneSegui':

		$sql=sql::scc_evaExiSegui($_GET['idSegui'],$_GET['idOrd']);
		$filAfect1=negocio::getVal($sql,'response');

		desconectar();
		conectar();

		if($filAfect1==0)
		{
			$sql=sql::scc_geneSeguiOrd($_GET['idSegui'],$_GET['idOrd']);
			$filAfect2=negocio::getVal($sql,'response');
			$msj=$filAfect2;
		}
		else
		{
			$msj="<div class=success>La orden ya tiene un seguimiento generado....!</div>";
		}

		$mensaje=Array();
		$mensaje[0]=$msj;
		echo json_encode($mensaje);

	break;

	case 'validSegui':

		$rowAten=0;

		for($i=0;$i<count($_POST['arrValid']);$i++)
		{
			$sql=sql::scc_valiSeguiOrd($_POST['arrValid'][$i],$rowAten);
			$filAfect1=negocio::getVal($sql,'response');
			$rowAten++;
			desconectar();
			conectar();
		}

			$mensaje=Array();
		 	$mensaje[0]=$filAfect1;
		 	echo json_encode($mensaje);
	break;

	case 'reverSegui':

		$rowAten=0;

		for($i=0;$i<count($_POST['arrValid']);$i++)
		{
			$sql=sql::scc_reverValiSegui($_POST['arrValid'][$i],$rowAten);
			$filAfect1=negocio::getVal($sql,'response');
			$rowAten++;
			desconectar();
			conectar();
		}

			$mensaje=Array();
		 	$mensaje[0]=$filAfect1;
		 	echo json_encode($mensaje);

	break;

	case 'lineTime':
		$sql=sql::scc_seguiOrdPlaz($_GET['id']);
		$data_seguiOrdPlaz=negocio::getData($sql);
		#$data=Array();
		echo json_encode($data_seguiOrdPlaz);
	break;

	case 'actFechReal':

		for($i=0;$i<count($_POST['fechRealArrId']);$i++)
		{
			$sql=sql::scc_actFechaReal($_POST['fechRealArrVal'][$i],$_POST['fechRealArrId'][$i]);
			$filAfect1=negocio::getVal($sql,'response');
		}
			$mensaje=Array();
			$mensaje[0]=$filAfect1;
			echo json_encode($mensaje);
	break;

	case 'actuPlazProv':
		$sql=sql::scc_actuPlazFab($_GET['plazProv'],$_GET['idOrd']);
		$val_actuPlazFab=negocio::getVal($sql,'response');
		$mensaje=Array();
		$mensaje[0]=$val_actuPlazFab;
		echo json_encode($mensaje);
	break;

	case 'plazAdi_actu':
		$sql=sql::scc_plazAdi_actu($_GET['diAd'],$_GET['segId']);
		$val_plazAdi_actu=negocio::getVal($sql,'response');
		$mensaje=Array();
		$mensaje[0]=$val_plazAdi_actu;
		echo json_encode($mensaje);
	break;

	case 'actuPlaz':

		$sql=sql::scc_plazOrd_actu($_GET['idOrd'],$_GET['plaz'],$_GET['tip']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	default:
	break;
}

?>