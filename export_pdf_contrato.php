<?php
include("include/comun.php");
session_start();
$id=$_REQUEST['id'];
$reg=contrato::edit('S',$id);

$search  = array('[REPRESENTANTE]','[REPRESENTANTE_DNI]','[TRABAJADOR]', '[TRABAJADOR_DNI]','[DIRECCION]','[AREA]','[CARGO]','[REMUNERACION]','[DURACION]','[INICIO]','[FIN]','[FECHA]');
$replace = array($reg['representante'],$reg['representante_dni'],$reg['trabajador'],$reg['trabajador_dni'],$reg['trabajador_direccion'],$reg['cont_area'],$reg['cont_cargo'],$reg['cont_remuneracion'],$reg['cont_duracion'],$reg['cont_fec_ini'],$reg['cont_fec_fin'],$reg['cont_fecha']);
$str=str_replace($search, $replace, $reg['formato']);

$html='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Contrato</title>
</head>
<body>';
$html.=$str;
$html.='</body></html>';

ExportarPDF(2,$html,'','contrato.pdf','P')

?>
