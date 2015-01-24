<?php
include("include/comun.php");
session_start();
if($_GET['accion']>''){
	recurso::edit($_GET['accion'],$_GET['id']);
	echo "<script>Javascript:window.parent.col_form('',0,'',0,0);</script>";
	
}
$reg=recurso::edit('S',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Columnas</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<style type="text/css">
html {
	margin: 0 2px 0 2px;
	padding: 0;
}
body {
	margin: 0 2px 0 2px;
	padding: 0;	
	background: #CCCCCC;
}
table{	
        font-family:Arial, Helvetica, sans-serif;
        font-size:11px;
}
.error {
	float:none;color:red;vertical-align:middle;
}
</style>

</head>

<body>
<form name="form1" id="form1" method="get">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="hidden" name="tabla_id" value="<?=$_GET['tabla_id']?>">
<div id="ui-tabs">
	<ul>
	<li><a href="#tab-general">General</a></li>	
	</ul>
<div id="tab-general">
<table width="100%" border="0">
  
  <tr>
    <td align="right">Fecha:</td>
    <td colspan="3"><input name="rec_cal_fecha" type="text" id="rec_cal_fecha" value="<?=$reg['rec_cal_fecha']?>" /></td>
  </tr>
  <tr>
    <td align="right">Tipo recurso:</td>
    <td colspan="3"><select name="recurso_tipo_id" id="recurso_tipo_id"><?=recurso_tipo_ddl($reg['recurso_tipo_id'])?></select></td>
  </tr>
  <tr>
    <td align="right">Recurso:</td>
    <td colspan="3"><select id="recurso_id" name="recurso_id"><?=recurso_ddl($reg['recurso_tipo_id'],$reg['recurso_id'])?></select></td>
  </tr>
  <tr>
    <td align="right">Actividad:</td>
    <td colspan="3"><input size="50" name="rec_cal_actividad" type="text" id="rec_cal_actividad" value="<?=$reg['rec_cal_actividad']?>" /></td>
  </tr>
  <tr>
    <td align="right">Hora ini:</td>
    <td colspan="3"><input name="rec_cal_hora_ini" type="text" id="rec_cal_hora_ini" value="<?=$reg['rec_cal_hora_ini']?>" /></td>
    </tr>
  <tr>
    <td align="right">Hora fin:</td>
    <td colspan="3"><input name="rec_cal_hora_fin" type="text" id="rec_cal_hora_fin" value="<?=$reg['rec_cal_hora_fin']?>" /></td>
  </tr>  
  <tr>
    <td align="right" valign="top">Descripci&oacute;n:</td>
    <td colspan="3"><textarea cols="50" rows="5" name="rec_cal_descrip" cols="40" rows="3" id="tabla_col_desc"><?=$reg['rec_cal_descrip']?></textarea></td>
    </tr>
  </table>
  
  </div>
  
  
</div>
<p align="right"><input type="submit" name="Submit" value="    Grabar    " /></p>
</form>
</body>
</html>
<script language="javascript">
$(document).ready(function(){
    $("#recurso_tipo_id").change(function(event){
        $("#recurso_id").load("ajax.php?a=recurso_ddl&tipo="+$(this).val());
    });        
    $('#ui-tabs').tabs();
});
Calendario('rec_cal_fecha');
</script>