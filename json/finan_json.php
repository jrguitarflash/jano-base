<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

switch ($_REQUEST['json']) 
{
	case 'finan_obteCentCost':

		$sql=sql::finan_obteCentCost();
		$data=negocio::getData($sql);

		print json_encode($data);

	break;

	case 'finan_datCentxId':

		$sql=sql::finan_datCentxId($_GET['centId']);
		$data=negocio::getData($sql);

		print json_encode($data);

	break;

	case 'finan_opeProye_crear':

		$sql=sql::finan_centProye_eva($centId);
		$flagEva=negocio::getVal($sql,'response');

		$data=Array();

		if($flagEva==0)
		{
			desconectar();
			conectar();
			
			$sql=sql::finan_opeProye_crear($_GET['centId']);
			$filAfect=negocio::getVal($sql,'response');

			$data[0]=$filAfect;
		}
		else
		{
			$data[0]='ya existe';
		}

		print json_encode($data);

	break;

	case 'finan_opeProyexId_obte':

		$sql=sql::finan_opeProyexId_obte($_GET['opeId']);
		$data=negocio::getData($sql);

		print json_encode($data);		

	break;

	case 'finan_opeProye_actu':

		$sql=sql::finan_centProye_eva($_GET['centId']);
		$flagEva=negocio::getVal($sql,'response');

		$data=Array();

		if($flagEva==0)
		{
			desconectar();
			conectar();

			$sql=sql::finan_opeProye_actu($_GET['idOpeProye'],$_GET['centId']);
			$filAfect=negocio::getVal($sql,'response');

			$data=Array();
			$data[0]=$filAfect;
		}
		else
		{
			$data[0]='ya existe';
		}

		print json_encode($data);

	break;

	case 'finan_opeProye_eli':

		$sql=sql::finan_opeProye_eli($_GET['opeId']);
		$filAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$filAfect;

		print json_encode($data);

	break;

	case 'finan_adjuOpe_eli':

		$sql=sql::finan_adjuOpe_eli($_GET['adjuId']);
		$filAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$filAfect;

		print json_encode($data);

	break;

	case 'finan_opeProye_cerrar':

		$sql=sql::finan_opeProye_cerrar($_GET['opeId']);
		$filAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$filAfect;

		print json_encode($data);

	break;

	case 'finan_opeProye_ope':

		$filAfect=0;

		for($i=0;$i<count($_POST['opeId']);$i++)
		{
			desconectar();
			conectar();
			$sql=sql::finan_opeProye_ope($_POST['opeId'][$i]);
			$filAfect=negocio::getVal($sql,'response');
		}

		$data=Array();
		$data[0]=$filAfect;

		print json_encode($data);

	break;

	/*******************************************/
		// MODULO FINANZAS & CENTRO DE COSTOS
	/*******************************************/

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

	default:
	break;
}

?>