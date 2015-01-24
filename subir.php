<?php
include("include/comun.php");
session_start();
$tabla_id=($_GET['tabla_id']+0);
$formid=($_SESSION['operador']['formId']+0);
$operador_id=$_SESSION['operador']['operador_id'];
$path=variable("ruta_d")."\\".date('Ymd')."\\".$tabla_id;
if($_FILES['archivo']>''){
	if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
		$type=substr($_FILES['archivo']['name'],strrpos($_FILES['archivo']['name'],'.'));
		if($type==""){$type=$_FILES['archivo']['type'];}
		if(!is_dir($path)){mkdir($path,0,true);}
		$_POST['docu_ext']=$type;
		$id=documento::edit('I',0);
		$path=$path."\\".$id.$type;
		if(move_uploaded_file($_FILES['archivo']['tmp_name'],$path)){
			echo "<script>window.close();window.opener.documentos(".($formid+0).");</script>";
		}else{
			echo "<script>alert('Error');</script>";
		}
	}
}
?>
<html>
<head>
<title>Subir archivo</title>
<LINK href="css/default.css" rel="stylesheet">
</head>
<body bgcolor="gainsboro" onLoad="document.form1.docu_rotulo.focus();">
<form method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="tabla_id" value="<?=$tabla_id?>">
<input type="hidden" name="tabla_id_origen" value="<?=$formid?>">
<input type="hidden" name="docu_ruta" value="<?=$path?>">
<table width="100%" class="edit1" cellpadding="0" cellspacing="0" align="center">
<tr class="edit11">
<td height="25px;">Subir archivo</td>
<td align="right"><a href="#" title="Guardar" onClick="document.form1.submit();"><img width="25px" src="images/guardar.png"></a><a href="#" onClick="window.close();" title="Cerrar"><img src="images/b_drop.png" width="25px"></a></td>
</tr>
<tr>
<td class="edit112">Entidad:</td>
<td class="edit113"><?php echo tabla::tbl_nombre($tabla_id);?></td>
</tr>
<tr>
<td class="edit112">Referencia:</td>
<td class='edit113'><?php echo tabla::reg_nombre($tabla_id,$formid);?></td>
</tr>
<tr>
<td class="edit112">Rótulo:</td>
<td><input type="text" name="docu_rotulo" size="50"></td>
</tr>
<tr>
<td class="edit112">Rótulo:</td>
<td><select name="docu_tipo_id"><?php echo docu_tipo_ddl($reg['docu_tipo_id']);?></select></td>
</tr>
<tr>
<td class="edit112" valign="top">Descripción:</td>
<td><textarea name="docu_descripcion" cols="50" rows="5"></textarea></td>
</tr>
<tr>
<td class="edit112">Archivo:</td>
<td><input type="file" name="archivo"></td>
</tr>
<tr><td align="center" colspan="2">&nbsp;</td></tr>
</table>
</form>
</body>
</html>