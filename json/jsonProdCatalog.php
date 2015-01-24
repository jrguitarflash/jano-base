<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	$dataResul=negocio::evaClasiProd($_GET['tipClasi']);
	echo json_encode($dataResul);

?>

		
