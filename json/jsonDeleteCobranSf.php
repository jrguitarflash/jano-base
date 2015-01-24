<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	//echo $_POST['val'];
	
	$sql=sql::deleteCobran($_GET['idCob']);
	$afecInsert=negocio::setData($sql);

	if ($afecInsert>0)
	{
		$notifi=1;
	}
	else
	{
		$notifi=0;
	}


	$result=Array();
	$result['noti']=$notifi;

	echo json_encode($result);

?>

		
