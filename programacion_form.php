<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles_popup.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script language="javascript">
$(document).ready(function(){
	$("#form1").validate();
	$("#btnSave").click(function(){
		$("#form1").submit();
	});
});

</script>
<div class="box">
    <div class="heading">
        <h1>Programación: <span></span></h1>        <div class="buttons">
        <a id='btnSave'><img src='images/grabar.png' width='20' height='20' title='Grabar'></a><img src='images/split_img.png'><a href='#' onclick="getGuia(1,118)"><img src='images/ayuda.png' title='Ayuda'></a>	</div>
    </div>
    <div class="content">
<!-- Tabs --><form id="form1" action="" method="post" name="form1">
              <input type="hidden" id="tab" name="tab" value="0">
              <input type="hidden" id="accion" name="accion" value="U">
              <input type="hidden" id="id" name="id" value="27">              
              <div id="ui-tabs"><ul><li><a onclick="Enfocar('General');" href="#tab-General">General</a></li></ul><div id="tab-General"><table width="100%">
          <tr>
            <td  valign="top">
            <table width="100%" align="center" class="form"><input type="hidden" id="programacion_id" name="programacion_id" value="27"><tr><td><a class="link_texto" onclick="col_form(1,'U',1208,118);">Tarea</a></td><td width="5">:</td><td width="5"></td><td><input  size="0" type="text" id="prog_tarea_nombre" name="prog_tarea_nombre" value="Emitir Factura"></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1166,118);">Fec. Incio</a></td><td width="5">:</td><td width="5"></td><td><input type="text" size="12" name="prog_fec_ini" id="prog_fec_ini" value="2002-01-07"><script>Javascript:Calendario('prog_fec_ini');</script></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1201,118);">Duración</a></td><td width="5">:</td><td width="5"></td><td><input  maxlength="50" size="0" type="text" id="proc_tarea_duracion" name="proc_tarea_duracion" value="0"></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1167,118);">Fec. Fin</a></td><td width="5">:</td><td width="5"></td><td><input type="text" size="12" name="prog_fec_fin" id="prog_fec_fin" value="2002-01-07"><script>Javascript:Calendario('prog_fec_fin');</script></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1168,118);">Confirmación</a></td><td width="5">:</td><td width="5"></td><td><input  maxlength="50" size="0" type="text" id="prog_tarea_confirmacion" name="prog_tarea_confirmacion" value="Documento entregado"></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1169,118);">Observación</a></td><td width="5">:</td><td width="5"></td><td><textarea  rows="4" cols="40" id="prog_descripcion" name="prog_descripcion"></textarea></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1171,118);">Estado</a></td><td width="5">:</td><td width="5"></td><td><select id="proc_tarea_estado_id" name="proc_tarea_estado_id"  style="min-width:100px"><option value=""></option><option value="4" >Cancelado</option><option value="2" >Ok</option><option value="1"  selected >Pendiente</option><option value="3" >Retrazado</option></select></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1205,118);">Tabla</a></td><td width="5">:</td><td width="5"></td><td><input  size="0" type="text" id="tabla_id" name="tabla_id" value="69"></td></tr><tr><td><a class="link_texto" onclick="col_form(1,'U',1174,118);">Registro Id</a></td><td width="5">:</td><td width="5"></td><td><input  maxlength="50" size="0" type="text" id="oc_id" name="oc_id" value=""></td></tr></table>
            </td>
            <td>&nbsp;</td>
            <td valign="top">
            <table width="100%" align="center" class="form"></table>
            </td>
          </tr>
          </table></div></div></form><!-- Fin Tabs -->    </div>
</div>
  
  
  
 </body></html>
 
<script language="javascript">
$('#ui-tabs').tabs(); 
function col_form(sw,accion,id,tabla_id){
	//alert(id);
	switch(sw){
		case 1:
			$('#dialogx').remove();	
			$('#contentx').prepend('<div id="dialogx" style="padding: 3px 0px 0px 0px;"><iframe src="tabla_col_form.php?a='+accion+'&id='+id+'&tabla_id='+tabla_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#dialogx').dialog({
			title: 'Columna',
			bgiframe: false,
			width: 550,
			height: 380,
			resizable: false,
			close: function (event, ui) {
				window.location.reload();
			},
			modal: true

	});
			break;
		case 0:
			$('#dialogx').dialog('close');
			break;
	}
	
};
</script>