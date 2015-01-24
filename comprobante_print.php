<?php
include("include/funciones_empresa.php");
$reg = cp::cp_edit($_GET['id'],'S');
$cliente=cliente::cliente_edit($reg[0]['cliente_id'],'E');
$ocs=ocs::ocs_edit($reg[0]['ocs_id'],'S');
$imagen=array(1=>"ScannedImage-2.jpg",2=>"ScannedImage-4.jpg",4=>"ScannedImage-3.jpg");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	margin: 0;
	padding: 0;
	font-size:11px;
	font-family: Arial, Helzvetica, sans-serif;	
}
</style>
<title>Comprobante</title>
<script type="text/javascript" src="js/sistema.js"></script>
<script language="javascript">

function wPrint(){
	document.getElementById('NoPrint').style.display='none';
	document.getElementById('img_cp').style.display='none';
	window.print();
	window.close();
	//document.getElementById('NoPrint').style.display='block';
	//document.getElementById('img_cp').style.display='block';
}
</script>
</head>

<body bgcolor="#E5E5E5" onLoad="carga();">
<form name="form1">
<table width="100%" border="0" >
  <tr>
    <td align="right">
	<span id="NoPrint">
	<input name="button" type="button" value="Imprimir" onclick="wPrint();" />
    <input type="button" name="Submit" value="Cancelar" onclick="window.close();" />
	</span>
	</td>
  </tr>
  <tr>
    <td>
	<div id="print">
	
	<img id="img_cp" src="imagenes/<?=$imagen[$reg[0]['cp_tipo_id']]?>" width="675" height="450" />
	<?=mostrar_capa('capa1',$reg[0]['cp_tipo_id'])?>
	<font size="+1"><?=$reg[0]['cp_nro']?></font>
	</div>
	<?=mostrar_capa('capa2',$reg[0]['cp_tipo_id'])?>
	<?=$cliente['cli_nombre']?>
	</div>
	<?=mostrar_capa('capa3',$reg[0]['cp_tipo_id'])?>
	<?=substr($reg[0]['cp_fec_emis'],0,10)?>
	</div>
	<?=mostrar_capa('capa4',$reg[0]['cp_tipo_id'])?>
	<?=$reg[0]['cp_monto_tot']?>
	</div>
	<?=mostrar_capa('capa5',$reg[0]['cp_tipo_id'])?>
	<?=comp_det_lista_print($_GET['id'],0,$reg[0]['cp_tipo_id'],'pro_cantidad,pro_nombre,pro_precio_venta','10,60,15,15')?>
	</div>
	<?=mostrar_capa('capa6',$reg[0]['cp_tipo_id'])?>
	<?=$cliente['cli_ruc']?>
	</div>
	<?=mostrar_capa('capa7',$reg[0]['cp_tipo_id'])?>
	<?=$cliente['cli_direccion']?>
	</div>
	<?=mostrar_capa('capa8',$reg[0]['cp_tipo_id'])?>
	<?=$ocs[0]['ocs_nro']?>
	</div>
		
	</div>
	</td>
  </tr>
</table>

</form>
<div id="msg" style="display:none"></div>
</body>
</html>
