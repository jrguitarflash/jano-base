<?php
include("include/comun.php");
session_start();
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
.list .left {
	text-align: left;
	/*padding: 7px;*/
}
.list .right {
	text-align: right;
	/*padding: 7px;*/
}
.list .center {
	text-align: center;
	/*padding: 7px;*/
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
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table><br>';
$html.=doc_financiero_lista_reporte();
$html.='</body></html>';

ExportarPDF(2,$html,'','doc_financieros.pdf','L')

?>