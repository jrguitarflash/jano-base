<?
include("include/comun.php");
if($_POST['accion']>''){
	persona::edit($_POST['accion'],$_POST['persona_id_asoc']);
	echo '<script>Javascript:window.opener.location.href="index.php?menu=personas";window.close();</script>';
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seleccionar</title>
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<style type="text/css">
<!--
body {
	background-color: #A3B2CC;
}
-->
</style></head>

<body>
<form name="form1" method="post">
<input type="hidden" name="accion" />
<input type="hidden" name="persona_id_asoc" value="<?=$_GET['ids']?>" />
<table width="100%" border="0">
  <tr>
    <td height="34" align="center"><b>Seleccionar Perfil</b></td>
  </tr>
  <tr>
    <td height="32" align="center"><select name="persona_perfil_id">
            <?php echo persona_perfil_ddl($_GET['perfil'])?>
          </select>    </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><div class="buttons"><a onclick="document.form1.accion.value='A';document.form1.submit();" class="button"><span style="width:50px">Asociar</span></a><a class="button"><span style="width:50px">Ir a..</span></a><a class="button"><span style="width:50px">Cancelar</span></a></div></td>
  </tr>
</table>
</form>
</body>
</html>