<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	$sql=sql::vaca_eliVacaxId($_GET['vacaId']);
	$numFilAfect=negocio::setData($sql);

	$dataResul=Array();
	$dataResul[0]=$numFilAfect;
	echo json_encode($dataResul);

?>

		
