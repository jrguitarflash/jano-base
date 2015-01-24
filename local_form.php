<?php
include("include/comun.php");
if($_GET['accion']>''){
	local::edit($_GET['accion'],$_GET['id']);
	echo "<script>Javascript:window.parent.local_form(0,'',0,0);</script>";
}
$reg=local::edit('S',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body bgcolor="#CCCCCC">
<form name="form1" method="get">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="hidden" name="empresa_id" value="<?=$_GET['empresa_id']?>">
<table width="100%" border="0">
  <tr>
    <td>Siglas:</td>
    <td><input name="local_siglas" type="text" id="local_siglas" value="<?=$reg['local_siglas']?>" /></td>
  </tr>
  <tr>
    <td>Direcci&oacute;n:</td>
    <td><input name="local_direccion" type="text" id="local_direccion" value="<?=$reg['local_direccion']?>" /></td>
  </tr>
  <tr>
    <td>Telef&oacute;no:</td>
    <td><input name="local_telef" type="text" id="local_telef" value="<?=$reg['local_telef']?>" /></td>
  </tr>
  <tr>
    <td>Ubigeo:</td>
    <td><select name="ubigeo_id"><?=pers_dir_ubigeo_ddl($reg['ubigeo_id'])?></select></td>
  </tr>
  <tr>
    <td>Responsable:</td>
    <td><input name="local_respons" type="text" id="local_respons" value="<?=$reg['local_respons']?>" /></td>
  </tr>
  <tr>
    <td valign="top">Comentario:</td>
    <td><textarea name="local_coment" cols="40" rows="3" id="local_coment"><?=$reg['local_coment']?></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="Submit" value="    Grabar    " /></td>
  </tr>
</table>
</form>
</body>
</html>
