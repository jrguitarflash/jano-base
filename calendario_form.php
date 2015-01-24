<?php
include("include/comun.php");
if($_GET['accion']>''){
	evento::edit($_GET['accion'],$_GET['id']);
	echo "<script>Javascript:window.parent.col_form('C',0,'',0,0);</script>";
	
}
$reg=evento::edit('S',$_GET['id']);
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
    <td colspan="3"><input name="evento_fecha" type="text" id="evento_fecha" value="<?=$reg['evento_fecha']?>" /></td>
    </tr>
  <tr>
    <td align="right">Hora ini:</td>
    <td colspan="3"><input name="evento_hora_ini" type="text" id="evento_hora_ini" value="<?=$reg['evento_hora_ini']?>" /></td>
    </tr>
  <tr>
    <td align="right">Hora fin:</td>
    <td colspan="3"><input name="evento_hora_fin" type="text" id="evento_hora_fin" value="<?=$reg['evento_hora_fin']?>" /></td>
  </tr>
  <tr>
    <td align="right">Nombre:</td>
    <td colspan="3"><input size="50" name="evento_nombre" type="text" id="evento_nombre" value="<?=$reg['evento_nombre']?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="top">Descripci&oacute;n:</td>
    <td colspan="3"><textarea cols="50" rows="5" name="tabla_col_desc" cols="40" rows="3" id="tabla_col_desc"><?=$reg['tabla_col_desc']?></textarea></td>
    </tr>
  </table>
  
  </div>
  
  
</div>
<p align="right"><input type="submit" name="Submit" value="    Grabar    " /></p>
</form>
</body>
</html>
<script language="javascript">
$('#ui-tabs').tabs(); 
Calendario('evento_fecha');
</script> 
