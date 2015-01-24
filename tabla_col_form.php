<?php
include("include/comun.php");
if($_GET['accion']>''){
	tabla_col::edit($_GET['accion'],$_GET['id']);
	echo "<script>Javascript:window.parent.col_form(0,'',0,0);</script>";
	
}
$reg=tabla_col::edit('S',$_GET['id']);
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
	<li><a href="#tab-form">Fomulario</a></li>
	<li><a href="#tab-list">Listado</a></li>
	<li><a href="#tab-otros">Otros</a></li>
	</ul>
<div id="tab-general">
<table width="100%" border="0">
  
  <tr>
    <td align="right">Nombre:</td>
    <td colspan="3"><input name="tabla_col_nombre" class="required" type="text" id="tabla_col_nombre" value="<?=$reg['tabla_col_nombre']?>" /></td>
    </tr>
  <tr>
    <td align="right">Rotulo:</td>
    <td colspan="3"><input name="tabla_col_rotulo" class="required" type="text" id="tabla_col_rotulo" value="<?=$reg['tabla_col_rotulo']?>" /></td>
    </tr>
  
  <tr>
    <td align="right" valign="top">Descripci&oacute;n:</td>
    <td colspan="3"><textarea name="tabla_col_desc" cols="40" rows="3" id="tabla_col_desc"><?=$reg['tabla_col_desc']?></textarea></td>
    </tr>
  </table>
  
  </div>
  <div id="tab-form">
  <table width="100%">
  
  <tr>
    <td align="right">Grupo:</td>
    <td><select name="tabla_grupo_id" class="required" id="tabla_grupo_id">
      <? echo tbl_grupo_ddl($_GET['tabla_id'],$reg['tabla_grupo_id'])?>
    </select></td>
    <td align="right">Control:</td>
    <td><select name="col_control" id="col_control" class="required">
      <?=tbl_col_tipo_ddl($reg['col_control'])?>
    </select></td>
  </tr>
  <tr>
    <td align="right">Lado Panel</td>
    <td><select name="tabla_col_panel_pos" id="tabla_col_panel_pos">
      <?=tbl_col_panel_ddl($reg['tabla_col_panel_pos'])?>
    </select></td>
    <td align="right">Orden:</td>
    <td><input name="tabla_col_orden" type="text" id="tabla_col_orden" value="<?=$reg['tabla_col_orden']?>" size="10" /></td>
  </tr>
  <tr>
    <td align="right">Ancho:</td>
    <td><input name="tabla_col_ancho" type="text" id="tabla_col_ancho" value="<?=$reg['tabla_col_ancho']?>" size="10" /></td>
    <td align="right">Obligatorio:</td>
    <td><input name="tabla_col_obligatorio" type="checkbox" id="tabla_col_obligatorio" value="1" <?=($reg['tabla_col_obligatorio']=='1')?' checked ':'';?> /></td>
  </tr>
   <tr>
     <td align="right">Caract. Max.</td>
     <td><input name="ctr_max_length" type="text" id="ctr_max_length" value="<?=$reg['ctr_max_length']?>" size="10" /></td>
     <td align="right">Virtual</td>
     <td><input name="tabla_col_virtual" type="checkbox" id="tabla_col_virtual" value="1" <?=($reg['tabla_col_virtual']=='1')?' checked ':'';?> /></td>
   </tr>   
   <tr>
    <td align="right">Valor inicial: </td>
    <td><input name="tbl_col_valor_ini" type="text" id="tbl_col_valor_ini" value="<?=$reg['tbl_col_valor_ini']?>" /></td>
    <td align="right">Orden SP:</td>
    <td><input name="ctr_orden_sp" type="text" id="ctr_orden_sp" value="<?=$reg['ctr_orden_sp']?>" size="10" /></td>
  </tr>
  <tr>
     <td align="right">Estilo(CSS)</td>
     <td><input name="tbl_col_css" type="text" id="tbl_col_css" value="<?=$reg['tbl_col_css']?>" /></td>
     <td align="right">Ficha</td>
     <td><input name="tbl_col_ficha" type="text" id="tbl_col_ficha" value="<?=$reg['tbl_col_ficha']?>" /></td>
     </tr>
  </table>
  </div>
  <div id="tab-list">
  <table width="100%">
  
  <tr>
    <td align="right">Ancho:</td>
    <td><input name="lst_ancho" type="text" id="lst_ancho" value="<?=$reg['lst_ancho']?>" size="10" /></td>
    <td align="right">Alineación:</td>
    <td><select name="lst_align" id="lst_align">
      <?=tbl_col_align_ddl($reg['lst_align'])?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">Orden:</td>
    <td><input name="tbl_col_orden_lst" type="text" id="tbl_col_orden_lst" value="<?=$reg['tbl_col_orden_lst']?>" size="10" /></td>
	<td align="right">Estilo(CSS) </td>
	<td><input name="tbl_col_lst_css" type="text" id="tbl_col_lst_css" value="<?=$reg['tbl_col_lst_css']?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="top">Fuente lista </td>
    <td colspan="3"><textarea name="fuente_tbl" cols="65" rows="4" id="fuente_tbl"><?=$reg['fuente_tbl']?></textarea></td>
  </tr>
  <tr>
    <td align="right">Dependencia:</td>
    <td colspan="3"><input name="tbl_col_dependencia" type="text" id="tbl_col_dependencia" value="<?=$reg['tbl_col_dependencia']?>" size="40" /></td>
  </tr>
  <tr>
    <td align="right" valign="top">Formula:</td>
    <td colspan="3"><textarea name="lst_formula" cols="65" rows="4" id="lst_formula"><?=$reg['lst_formula']?></textarea></td>
  </tr>
  <tr>
    <td align="right">Pie:</td>
    <td colspan="3"><input name="tbl_col_pie" type="text" id="tbl_col_pie" value="<?=$reg['tbl_col_pie']?>" size="50" /></td>
    </tr>
  <tr>
    <td align="right">Editable:</td>
    <td colspan="3"><input name="tbl_col_lst_editable" type="checkbox" id="tabla_col_obligatorio" value="1" <?=($reg['tbl_col_lst_editable']=='1')?' checked ':'';?> /></td>
    </tr>
  <tr>
    <td colspan="4" align="center"><hr></td>
  </tr>
</table>

</div>
<div id="tab-otros">
  <table width="100%" >
    <tr>
      <td width="25%" align="right">Filtrar lista </td>
      <td width="25%"><input name="tbl_col_filtro" type="checkbox" id="tbl_col_filtro" value="1" <?=($reg['tbl_col_filtro']=='1')?' checked ':'';?> /></td>
      <td width="25%" align="right">Enviar parametro </td>
      <td width="25%"><input name="tbl_col_param" type="checkbox" id="tbl_col_param" value="1" <?=($reg['tbl_col_param']=='1')?' checked ':'';?> /></td>
    </tr>
    <tr>
      <td align="right">Control Filtro </td>
      <td><input name="tbl_col_ctrl_filtro" type="checkbox" id="tbl_col_ctrl_filtro" value="1" <?=($reg['tbl_col_ctrl_filtro']=='1')?' checked ':'';?> /></td>
      <td align="right">Busqueda Avanzada: </td>
      <td><input name="tbl_col_busqueda" type="checkbox" id="tbl_col_busqueda" value="1" <?=($reg['tbl_col_busqueda']=='1')?' checked ':'';?> /></td>
    </tr>
    
    <tr>
      <td align="right">Filtro Inicial </td>
      <td><input name="tbl_col_filtro_ini" type="text" id="tbl_col_filtro_ini" value="<?=$reg['tbl_col_filtro_ini']?>" /></td>
      <td align="right">Mayuscula</td>
      <td><input name="tbl_col_mayus" type="checkbox" id="tbl_col_mayus" value="1" <?=($reg['tbl_col_mayus']=='1')?' checked ':'';?> /></td>
    </tr>
    <tr>
      <td align="right">Calculo</td>
      <td colspan="3"><input name="tbl_col_calculo" type="text" id="tbl_col_calculo" value="<?=$reg['tbl_col_calculo']?>" size="50" /></td>
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

</script> 
