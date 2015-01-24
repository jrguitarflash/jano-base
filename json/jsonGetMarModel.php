<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	
	$sql=sql::cc_marcaModelxId($_GET['prodId']);
	$dataResul=negocio::getData($sql);
	$valMar=negocio::evaModelMar($dataResul[0]['marca']);
	$valMod=negocio::evaModelMar($dataResul[0]['modelo']);
	$arrMarMod=Array();
	$arrMarMod[0]=$valMar;
	$arrMarMod[1]=$valMod;
	echo json_encode($arrMarMod);

?>

		
