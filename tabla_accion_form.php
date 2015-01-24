<?php
include("include/comun.php");
if($_GET['accion']>''){
	tabla_accion::edit($_GET['accion'],$_GET['id']);
	echo "<script>Javascript:window.parent.accion_form(0,'',0,0);</script>";
}
$reg=tabla_accion::edit('S',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Columnas</title>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<style type="text/css">
table{	
        font-family:Arial, Helvetica, sans-serif;
        font-size:11px;
}
.error {
	float: none; color: red; vertical-align: middle; 	
}
</style>
<script language="javascript">
$(document).ready(function(){
	$("#form1").validate();
	//$("#btnSave").click(function(){		
		//$("#form1").submit();
//	});
});
</script>
</head>

<body bgcolor="#CCCCCC">
<form name="form1" id="form1" method="get">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="hidden" name="tabla_id" value="<?=$_GET['tabla_id']?>">
<table width="100%" border="0">
  
  <tr>
    <td>Tipo:</td>
    <td><select name="tbl_accion_tipo" id="tbl_accion_tipo"><?=tbl_accion_tipo_ddl('L',$reg['tbl_accion_tipo'])?></select>
    </td>
  </tr>
  <tr>
    <td>Nombre:</td>
    <td><input name="tbl_accion_nombre" type="text" id="tbl_accion_nombre" value="<?=$reg['tbl_accion_nombre']?>" size="40" /></td>
  </tr>
  <tr>
    <td>URL:</td>
    <td><input name="tbl_accion_url" type="text" id="tbl_accion_url" value="<?=$reg['tbl_accion_url']?>" size="40" /></td>
  </tr>
  <tr>
    <td>Función</td>
    <td><input name="tbl_accion_func" type="text" id="tbl_accion_func" value="<?=$reg['tbl_accion_func']?>" size="40" /></td>
  </tr>
  <tr>
    <td>Icono</td>
    <td><input name="tbl_accion_icono" type="text" id="tbl_accion_icono" value="<?=$reg['tbl_accion_icono']?>" size="40" /></td>
  </tr>
  <tr>
    <td>Orden:</td>
    <td><input name="tbl_accion_orden" type="text" id="tbl_accion_orden" value="<?=$reg['tbl_accion_orden']?>" size="10" /></td>
  </tr>
  <tr>
    <td>Descripción:</td>
    <td><textarea name="tbl_accion_descripcion" cols="40" rows="4" id="tbl_accion_descripcion"><?=$reg['tbl_accion_descripcion']?></textarea></td>
  </tr>      
  <tr>
    <td height="32" colspan="2" align="center"><input type="submit" name="Submit" value="    Grabar    " /></td>
  </tr>
</table>
</form>
</body>
</html>