<?php
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="informe_doc.xls"');
header("Content-Transfer-Encoding: binary");
ob_clean();
flush();
session_start();

include("include/comun.php");
$tbl_id=$_REQUEST['tbl_id'];
$accion=($tbl_id==14)?"REGISTRO DE COMPRAS":"REGISTRO DE VENTAS";
$accion_id=($tbl_id==14)?1:2;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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


</style>
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td><h3><b><?=$_SESSION['SIS'][6]?></b></h3></td>
    <td><b><?=date("Y-m-d")?></b></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><h5><b><?=$accion?></b></h5></td>
    </tr>    
  <tr>
  <tr>
    <td colspan="2"><?php echo cp_lista_reporte($accion_id)?></td>
    </tr>
</table>

</body>
</html>