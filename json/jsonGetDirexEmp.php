<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$dataDir=Array();
$sql=sql::getDirexEmp($_GET['emp']);
$dire=negocio::getVal($sql,'dire');
$dataDir['dire']=$dire;

echo json_encode($dataDir);

?>