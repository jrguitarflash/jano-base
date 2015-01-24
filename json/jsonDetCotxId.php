<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

// Iniciando identificador de detalle cotizacion
$idCot=$_GET['idCot'];

// Obtener data de detalle cotizacion servicios
$sql=sql::cs_detCotServxId($idCot);
$dataDetCot=negocio::getData($sql);

// Enviar data en formato json
echo json_encode($dataDetCot);

?>