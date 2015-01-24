<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	//echo $_POST['val'];

	$sql=sql::getRucxProv($_GET['valCli']);
	$valRuc=negocio::getVal($sql,'anex_ruc');

	if ($_GET['valMone']=='MN') 
	{
		$valImpon=floatval($_GET['valImpo']);
		$valImponus=floatval($_GET['valImpo'])*floatval($_GET['cambVenta']);
	}
	else
	{
		$valImponus=floatval($_GET['valImpo']);
		$valImpon=floatval($_GET['valImpo'])/floatval($_GET['cambVenta']);
	}

	$valRetenn=(floatval($_GET['valReten'])/100)*floatval($valImpon);
	$valRetenus=(floatval($_GET['valReten'])/100)*floatval($valImponus);

	$sql=sql::updateCobran($_GET['valTipCob'],
						   $_GET['fechPagCob'],
						   $_GET['valFac'],
						   $valRuc,
						   $_GET['valMovi'],
						   $valImpon,
						   $valImponus,
						   $valRetenn,
						   $valRetenus,
						   $_GET['valMone'],
						   $_GET['docum'],
						   $_GET['valFechVto'],
						   $_GET['valIdCob']);

	$afecInsert=negocio::setData($sql);

	if ($afecInsert>0)
	{
		$notifi="Cobranza actualizada correctamente";
	}
	else
	{
		$notifi="Cobranza no actualizada correctamente";
	}

	$msjNotifi="<div class='success' id='success'>
					<label class='msjControInf'>"
					.$notifi.
					"</label>
				</div>";

	$result=Array();
	$result['noti']=$msjNotifi;

	echo json_encode($result);

?>

		
