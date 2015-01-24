<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	/* INICIAR EL ID DE DETALLE Y ARRAY DE CAPTURA  */
	$idDet=$_GET['idDet'];
	$acci=$_GET['acci'];
	$detFl=Array();

	/* INICIAR DATA SESSION */
	session_start();

	/* RECORRER DATA SESSION */

	switch($acci)
	{
		case 'edit':
			foreach ($_SESSION['arrCotiFl'] as $data) 
			{
				if($data['idDet']==$idDet)
				{
					$detFl[0]['idDet']=$data['idDet'];
					$detFl[0]['tipDoc']=$data['tipDoc'];
					$detFl[0]['tipDocDes']=negocio::evaTipMone($data['tipDoc']);
					$detFl[0]['moneId']=$data['moneId'];
					$detFl[0]['moneDes']=negocio::getMonexId($data['moneId']);
					$detFl[0]['proveId']=$data['proveId'];
					$detFl[0]['proveDes']=negocio::getProvexId($data['proveId']);
					$detFl[0]['plazo']=$data['plazo'];
					$detFl[0]['desOrd']=$data['desOrd'];
				}
			}
		break;

		case 'edit2':

				# OBTENER DATA A EDITAR
				$sql=sql::cc_getDetProyexIdDet($_GET['idDet']);
				$dataCentxId=negocio::getData($sql);

				# LLENAR ARRAY A FORMATEAR
				$detFl[0]['idDet']=$dataCentxId[0]['cc_detCentCostId'];
				$detFl[0]['tipDoc']=$dataCentxId[0]['cc_tipOrden'];
				$detFl[0]['tipDocDes']=negocio::evaTipMone($dataCentxId[0]['cc_tipOrden']);
				$detFl[0]['moneId']=$dataCentxId[0]['cc_moneId'];
				$detFl[0]['moneDes']=negocio::getMonexId($dataCentxId[0]['cc_moneId']);
				$detFl[0]['proveId']=$dataCentxId[0]['cc_provId'];
				$detFl[0]['proveDes']=negocio::getProvexId($dataCentxId[0]['cc_provId']);
				$detFl[0]['plazo']=$dataCentxId[0]['cc_plazo'];
				$detFl[0]['desOrd']=$dataCentxId[0]['cc_desOrd'];

		break;

		default:
		break;
	}

	echo json_encode($detFl);

?>

		
