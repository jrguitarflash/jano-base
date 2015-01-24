<?php
include("include/comun.php");
$tabla_id=$_GET['tabla_id'];
$id=$_GET['id'];
if($_POST['accion']=='I'){
    //echo $_POST['accion'];
    $html=CotizacionSalida(1);
    //echo $html;
    ExportarPDF($html,'archivos/','cotizacion.pdf');
}
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
<!--
$(document).ready(function(){
	//$("#form1").validate();
	//$("#btnSave").click(function(){		
		//$("#form1").submit();
//	});
});
function Generar(){
    document.form1.accion.value="I";
    document.form1.submit();
    
}


//-->
</script>
</head>

<body>
<form name="form1" id="form1" method="post">
<input type="hidden" name="accion">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="hidden" name="tabla_id" value="<?=$_GET['tabla_id']?>">
<div id="ui-tabs">
	<ul>
	<li><a href="#tab-general">General</a></li>	
	</ul>
<div id="tab-general">
<table width="100%" border="0">
  
  <tr>
    <td align="right">Para:</td>
    <td colspan="3"><select name="contacto_id_para" style="width:250px"><?=contacto_ddl($_POST['contacto_id_para'])?></select></td>
    </tr>
  <tr>
    <td align="right">CC</td>
    <td colspan="3"><select name="contacto_id_cc" style="width:250px"><?=contacto_ddl($_POST['contacto_id_para'])?></select>
    </select></td>
  </tr>
  
  <tr>
    <td align="right">Asunto:</td>
    <td colspan="3"><input name="t2" type="text" class="required" id="t2" size="50" /></td>
    </tr>
  
  <tr>
    <td align="right" valign="top">Mensaje:</td>
    <td colspan="3"><textarea name="tabla_col_desc" cols="60" rows="5" id="tabla_col_desc"><?=$reg['tabla_col_desc']?></textarea></td>
    </tr>
  </table>
  
  </div>

</div>
<p align="right"><input type="button" name="Submit" value="    Grabar    " onclick="Generar();" /></p>
</form>
</body>
</html>
<script language="javascript">
$(document).ready(function(){
    $('#ui-tabs').tabs();
});


</script> 
