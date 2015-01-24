<?php
include("include/comun.php");
if($_GET['accion']>''){
	persona::contacto_edit($_GET['accion'],$_GET['id']);
	echo "<script>Javascript:window.parent.contac_form(0,'',0,0);</script>";
	
}
$reg=persona::contacto_edit('S',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Columnas</title>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
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
<input type="hidden" name="empresa_id" value="<?=$_GET['empresa_id']?>">
<table width="100%" border="0">
  <tr bgcolor="#A3B2CC">
    <td height="20" colspan="2"><b>General</b></td>
    </tr>
  <tr>
    <td align="right">Nombres:</td>
    <td><input name="pers_nombres" type="text" id="pers_nombres" value="<?=$reg[0]['pers_nombres']?>" /></td>
  </tr>
  <tr>
    <td align="right">Apellido Paterno: </td>
    <td><input name="pers_apepat" type="text" id="pers_apepat" value="<?=$reg[0]['pers_apepat']?>" /></td>
  </tr>
  <tr>
    <td align="right">Apellido Materno: </td>
    <td><input name="pers_apemat" type="text" id="pers_apemat" value="<?=$reg[0]['pers_apemat']?>" /></td>
  </tr>
  <tr>
    <td align="right">Email</td>
    <td><input name="pers_mail" type="text" id="pers_mail" value="<?=$reg[0]['pers_mail']?>" /></td>
  </tr>
  <tr>
    <td align="right">Teléfono:</td>
    <td><input name="cont_telef" type="text" id="cont_telef" value="<?=$reg[0]['cont_telef']?>" /></td>
    </tr>
  <tr>
    <td align="right">Area:</td>
    <td><input name="cont_area" type="text" id="cont_area" value="<?=$reg[0]['cont_area']?>" /></td>
    </tr>
  
  <tr>
    <td align="right" valign="top">Cargo:</td>
    <td><input name="cont_cargo" type="text" id="cont_cargo" value="<?=$reg[0]['cont_cargo']?>" /></td>
    </tr>
  
  
  
  <tr>
    <td colspan="2" align="right"><input type="submit" name="Submit" value="    Grabar    " /></td>
  </tr>
</table>
</form>
</body>
</html>
