<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	//echo $_POST['val'];
	
	$sql=sql::updateTipCamb($_GET['valFecha'],$_GET['valComp'],$_GET['valVent']);
	$afecInsert=negocio::setData($sql);

	if ($afecInsert>0)
	{
		$notifi="Tipo de cambio actualizado correctamente";
	}
	else
	{
		$notifi="Tipo de cambio no actualizado correctamente";
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

		
