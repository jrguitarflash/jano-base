<?php
include("include/comun.php");
session_start();
if($_REQUEST['tipo']==1){
$titulo="LETRAS POR COBRAR";
}else{
$titulo="LETRAS POR PAGAR";

}

$html='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
.list {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #000000;
	border-left: 1px solid #000000;
	margin-bottom: 5px;
}
.list td {
	border-right: 1px solid #000000;
	border-bottom: 1px solid #000000;
}
.list thead td {
	background-color: #EFEFEF;
	font-weight: bold;

}
.list tbody td {
	vertical-align: middle;
	padding: 1px 5px;
	/*background: #FFFFFF;*/
}
table.form {
	width: 100%;
	border-collapse: collapse;
	margin-bottom: 2px;
}

table.form > tbody > tr > td {
	padding: 2px 2px 2px 2px;
	color: #000000;
	border-bottom: 1px dotted #CCCCCC;
}

table.form .titulo {
	font-weight: bold;
}
.titulo{
border-top:solid 1px black;
border-bottom:solid 1px black;
background-color:#FFFF99;
text-align:center;
font-size:11pt;
}
.condiciones{
border:solid 1px black;
}

</style>
</head>
<body>';
$html.='<table width="100%" border="0">
  <tr>
    <td width="80%"><b>ELECTROWERKE S.A. </b></td>
    <td width="20%" align="right">'.date('Y-m-d').'</td>
  </tr>
  <tr>
    <td>'.$titulo.'</td>
    <td>&nbsp;</td>
  </tr>
</table><br>';
$html.=letra_lista_reporte($_REQUEST['tipo']);
$html.='</body></html>';

ExportarPDF(2,$html,'','letras.pdf','L')

?>
