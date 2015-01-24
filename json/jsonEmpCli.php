<?php
//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

// OBTENER EMPRESAS DE TIPO CLIENTE

$sql=sql::cs_empCLi();
$dataCli=negocio::getData($sql);

echo json_encode($dataCli);

?>