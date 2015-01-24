<?php
include("include/comun.php");
//echo $_GET['tabla_id']."<br>".$_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<script type="text/javascript" src="js/ajaxupload.js"></script>
</head>
<body>
<div class="box">
	<div class="heading">
    	<h1>Asientos Importaci&oacute;n </h1>
	  	<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Procesar</span></a>
			<a class="button" href="index.php?menu=contac_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<form action="index.php?menu=asientos_importacion" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$accion?>">
<input type="hidden" name="id" value="<?=$id?>">

<table width="50%" class="form">
  <tr>
    <td>Compras</td>
    <td><div id="file_source" style="border:solid blue 1px;background-color:gray">Seleccionar archivo</div></td>
  </tr>
  <tr>
    <td>Ventas</td>
    <td><div id="file_source" style="border:solid blue 1px;background-color:gray">Seleccionar archivo</div></td>
  </tr>
  
  <tr>
    <td>Fecha carga :</td>
    <td><input name="cont_fec_ini" type="text" id="cont_fec_ini"  value='<?php echo $reg[0]['cont_fec_ini']?>' size="20" /></td>
  </tr>  
</table>
</form>
    </div>
</div>
</body>
</html>