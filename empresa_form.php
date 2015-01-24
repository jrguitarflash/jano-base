<?php
if($_POST['accion']>''){
	empresa::edit($_POST['accion'],$_POST['id']);
	echo "<script>window.location.href='index.php?menu=empresa_list'</script>";
}
$reg=empresa::edit('S',$_GET['id']);
$perfil=($_GET['perfil']>0)?$_GET['perfil']:$reg['empresa_perfil_id'];
?>
<?php if($msj==1){?><div class="success">Datos Grabados</div><? } ?>

<div class="box">
	<div class="heading">
    	<h1>Empresa: <small>RUC : <?php echo $reg['emp_ruc']?> - <?php echo $reg['emp_nombre']?></small></h1>
	  	<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=empresa_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<div id="ui-tabs">
	<ul>
	<li><a href="#tab-empresa">Empresa</a></li>
	<li><a href="#tab-contacto">Contactos</a></li>
	<li><a href="#tab-local">Locales</a></li>
	</ul>
<div id="tab-empresa">
<form action="index.php?menu=empresa_form" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<table width="100%" class="form">
  <tr>
    <td align="center">Perfil</td>
    <td>RUC:</td>
    <td><input name="emp_ruc" type="text" id="emp_ruc"  value='<?php echo $reg['emp_ruc']?>' size="20" /></td>
  </tr>
  <tr>
    <td align="center"><select name="empresa_perfil_id" id="empresa_perfil_id"><?=empresa_perfil_ddl($_GET['perfil'])?></select>
    </td>
    <td>Nombre:</td>
    <td><input name="emp_nombre" type="text" id="emp_nombre"  value='<?php echo $reg['emp_nombre']?>' size="50" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tipo:</td>
    <td><select name="empresa_tipo_id" id="empresa_tipo_id"><?=emp_tipo_ddl($reg['empresa_tipo_id'])?></select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Email:</td>
    <td><input name="emp_email" type="text" id="emp_email"  value='<?php echo $reg['emp_email']?>' size="50" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Direcci&oacute;n</td>
    <td><input name="emp_direccion" type="text" id="emp_direccion"  value='<?php echo $reg['emp_direccion']?>' size="50" /></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>Tel&eacute;fono:</td>
    <td><input name="emp_telef" type="text" id="emp_telef"  value='<?php echo $reg['emp_telef']?>' size="20" /></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>Ubigeo:</td>
    <td><select name="ubigeo_id" id="ubigeo_id">
      <?php echo pers_dir_ubigeo_ddl(3,$reg['ubigeo_id']);?>
    </select>
      </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>Estado:</td>
    <td><select name="pers_estado_id">
      <?php echo pers_estado_ddl($reg['pers_estado_id']);?>
    </select></td>
  </tr>
</table>
</form>
</div>
<div id="tab-contacto">
<table width="100%">
<tr><td>&nbsp;</td><td align="right">
	<div class="buttons">
	<a href="#" onclick="contac_form(1,'I',0,<?=(int)$_GET['id']?>);" class="button"><span>Insertar</span></a>			
	</div></td></tr>
<tr><td colspan="2">
<div id="contac_list">
<?=contacto_lista($_GET['id'])?>
</div>
</td></tr>
</table>
</div>
<div id="tab-local">
<table width="100%">
<tr><td>&nbsp;</td><td align="right">
	<div class="buttons">
	<a href="#" onclick="local_form(1,'I',0,<?=(int)$_GET['id']?>);" class="button"><span>Insertar</span></a>			
	</div></td></tr>
<tr><td colspan="2">
<div id="local_list">
<?=local_lista($_GET['id'])?>
</div>
</td></tr>
</table>
</div>
</div>
    </div>
  </div>
<script type="text/javascript"><!--
function local_form(sw,accion,id,empresa_id){
	switch(sw){
		case 1:
			$('#dialog').remove();
	
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="local_form.php?a='+accion+'&id='+id+'&empresa_id='+empresa_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#dialog').dialog({
			title: 'Local',		
			bgiframe: false,
			width: 500,
			height: 300,
			resizable: false,
			close: function (event, ui) {
				$('#local_list').load('ajax.php?a=local_list&empresa_id='+empresa_id);
			},	
			modal: false		

	});
			break;
		case 0:
			$('#dialog').dialog('close');
			break;
	}
	
};

function contac_form(sw,accion,id,empresa_id){
	switch(sw){
		case 1:
			$('#dialog').remove();
	
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="contac_form.php?a='+accion+'&id='+id+'&empresa_id='+empresa_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#dialog').dialog({
			title: 'Contacto',		
			bgiframe: false,
			width: 500,
			height: 300,
			resizable: false,
			close: function (event, ui) {
				$('#contac_list').load('ajax.php?a=contacto_list&empresa_id='+empresa_id);
			},	
			modal: false		

	});
			break;
		case 0:
			$('#dialog').dialog('close');
			break;
	}
	
};

$('#ui-tabs').tabs(); 
//--></script> 