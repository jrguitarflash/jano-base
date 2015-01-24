<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::getDetCuxId($_GET['idDet']);
$detCu=negocio::getData($sql);

$sql=sql::getIdBanxIdCu($_GET['idDet']);
$detCu[0]['idBan']=negocio::getVal($sql,'banco_id');

echo json_encode($detCu);

?>