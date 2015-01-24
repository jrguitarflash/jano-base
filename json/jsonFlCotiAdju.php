<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	$sql=sql::cc_flCotiAdju();
	$dataResul=negocio::getData($sql);
	echo json_encode($dataResul);

?>

		
