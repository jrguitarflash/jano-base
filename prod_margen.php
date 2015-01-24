<?php
include("include/comun.php");
$cotizacion_id=$_REQUEST['id'];
if($_POST['accion']=='I'){
	cotizacion::edit('M',$cotizacion_id);
	echo '<script>Javascript:window.parent.$("#cot_margen").val("'.$_POST['cot_margen'].'");window.parent.$("#mgn_'.$_REQUEST['control'].'").html("'.$_POST['cot_margen'].'");window.parent.$("#margen").dialog("close");</script>';
}
$reg=cotizacion::edit('S',$cotizacion_id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles/styles_popup.css" />
<script language="javascript">
function Enviar(){
	if($.trim($("#cot_margen").val())==""){
		alert("Ingrese valor");
		$("#cot_margen").focus();
	}else{
		document.form1.accion.value='I';
		document.form1.submit();
	}
}


</script>
</head>

<body>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="accion" id="accion">
<input type="hidden" name="control" id="control" value="<?=$_REQUEST['control']?>">
<input type="hidden" name="id" id="id" value="<?=$cotizacion_id?>">

<table width="98%" border="0" align="center">
  <tr>
    <td>Actual</td>
    <td><b><?=$reg['cot_margen']?></b></td>
  </tr>
  <tr>
    <td>Nuevo</td>
    <td><input name="cot_margen" type="text" id="cot_margen" /></td>
  </tr>
  <tr>
    <td>Autoriza</td>
    <td><select class="required" name="trabajador_id" id="trabajador_id"><?=trabajador_ddl()?>
    </select></td>
  </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
    $("#cot_margen").focus();
</script>