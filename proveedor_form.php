<?php
$id=$_GET['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];
if($_POST['accion']>''){
	if($_POST['accion']=='I'){
		$id=empresa::edit($_POST['accion'],$_POST['id']);	
		$accion='U';
	}
	$id=($id>0)?$id:$_POST['id'];
	empresa::proveedor_edit($accion,$id);
	$msj=1;	

}
$reg=empresa::proveedor_lista($id);
?>
<?php if($msj==1){?><div class="success">Datos Grabados</div><? } ?>
<div class="box">
	<div class="heading">
    	<h1>Proveedor</h1>
	  	<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=proveedor_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
	<div id="ui-tabs">
	<ul>
	<li><a href="#tab-general">General</a></li>
	<li><a href="#tab-contacto">Contactos</a></li>	
	<li><a href="#tab-local">Locales</a></li>	
	</ul>
<div id="tab-general">
<form action="index.php?menu=cliente_form" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$accion?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="empresa_perfil_id" value="1">
<?
empresa_ficha($accion,$id);
?>
<table width="100%"  class="form">	    
  <tr><td colspan="2">Datos de Gestion:</td></tr>
  <tr>
    <td width="19%" >&nbsp;</td>
	    <td width="81%" ><table width="100%" class="form">
          
          <tr>
            <td>Fecha:</td>
            <td><input name="cli_fec_ini" type="text" id="cli_fec_ini"  value='<?php echo $reg[0]['cli_fec_ini']?>' size="50" /></td>
          </tr>
          <tr>
            <td>Estado:</td>
            <td><input name="cli_estado_id" type="text" id="cli_estado_id"  value='<?php echo $reg[0]['cli_estado_id']?>' size="50" /></td>
          </tr>
          
        </table></td>
  </tr>
</table>
</form>
</div>
<div id="tab-contacto">
</div>
<div id="tab-local">
</div>
</div>
    </div>
  </div>
<script type="text/javascript">
 $().ready(function() {
 $("#usuarios").autocomplete("ajax.php", {		
		minChars: 0,
		highlight: false, /* Si se indica 'false' no resaltar los valores de bsqueda */
		scroll: true, /* Si tendr scroll el campo de bsqueda */
		scrollHeight: 300, /* Altura del scroll en el campo de bsqueda */
		formatItem: function(data, i, n, value) {
			return value; /* Devulve el valor de la funcin usuarios.php */
		},
		formatResult: function(data, value) {			
			return value.split("[")[0]; /* Inserta en el campo de bsqueda el valor pero separa el contenido 'split' */
		}
	});

 }); 
</script>
<script language="javascript">
$('#ui-tabs').tabs(); 
</script>