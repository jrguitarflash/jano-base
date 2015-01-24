<?php
$ruta=$_POST['ruta'];
$id=$_POST['id'];
$control=$_POST['control'];
if($_FILES['file']>''){
	//if(is_uploaded_file($_FILES['file']['tmp_name'])){
		if(substr($_FILES['file']['type'],0,5)=='image'){
			$ext=substr($_FILES['file']['name'],strrpos($_FILES['file']['name'],'.'));
			//$file=$id.$ext;
                        $file=$_FILES['file']['name'];
			$path=$ruta.$file;
			if(!is_dir($ruta)){
				echo "<script>alert('No existe el directorio: ".$ruta."');</script>";		
			}else{				
				if(move_uploaded_file($_FILES['file']['tmp_name'],$path)){
					echo "<script>Javascript:window.parent.CargarImagen(0,'".$ruta."',0,'".$control."','".$file."');</script>";
				}else{
					echo "<script>alert('Error al cargar.');</script>";
				}	
			}			
		}else{
			echo "<script>alert('Solo se permite cargar imagenes.');</script>";
		}									
	//}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
</head>

<body bgcolor="#CCCCCC">
<form method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="ruta" value="<?=$_GET['ruta']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="hidden" name="control" value="<?=$_GET['control']?>">
<table width="100%" border="0">
  <tr>
    <td>Cargar:</td>
    <td><input type="file" name="file" /></td>
  </tr>
  
  
  
  <tr>
    <td height="33" colspan="2" align="center"><input type="submit" name="Submit" value="Aceptar" /></td>
  </tr>
</table>
</form>
</body>
</html>