<?php
$id=$_GET['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];
if($_POST['accion']>''){
	if($_POST['accion']=='I'){
		$id=persona::edit($_POST['accion'],$_POST['id']);	
		$accion='U';
	}
	$id=($id>0)?$id:$_POST['id'];
	persona::contacto_edit($accion,$id);
	$msj=1;	

}
$reg=persona::contacto_lista($id);
?>
<?php if($msj==1){?><div class="success">Datos Grabados</div><? } ?>
<div class="box">
	<div class="heading">
    	<h1>Contacto</h1>
	  	<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=contac_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<form action="index.php?menu=contac_form" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$accion?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="persona_perfil_id" value="2">
<?
persona_ficha($accion,$id);
?>
<table width="100%"  class="form">	    
  <tr><td colspan="2">Datos de Gestion:</td></tr>
  <tr>
    <td width="19%" >&nbsp;</td>
	    <td width="81%" ><table width="100%" class="form">
          
          <tr>
            <td>Empresa:</td>
            <td><input name="emp_nombre" type="text" id="emp_nombre" size="50" value="<?=$reg[0]['emp_nombre']?>" />
              <input name="empresa_id" type="hidden" id="empresa_id" value="<?=$reg[0]['empresa_id']?>" /></td>
          </tr>
          <tr>
            <td>Cargo:</td>
            <td><input name="cont_cargo" type="text" id="cont_cargo" value="<?php echo $reg[0]['cont_cargo']?>" size="30" /></td>
          </tr>
          <tr>
            <td>Tel&eacute;fono:</td>
            <td><input name="cont_telef" type="text" id="cont_telef" value="<?php echo $reg[0]['cont_telef']?>" /></td>
          </tr>
          <tr>
            <td>Fecha inicio :</td>
            <td><input name="cont_fec_ini" type="text" id="cont_fec_ini"  value='<?php echo $reg[0]['cont_fec_ini']?>' size="20" /></td>
          </tr>
          <tr>
            <td>Estado:</td>
            <td><input name="cont_estado_id" type="text" id="cont_estado_id"  value='<?php echo $reg[0]['cont_estado_id']?>' size="50" /></td>
          </tr>
          
        </table></td>
  </tr>
</table>
</form>
    </div>
</div>
<script language="javascript">
$(document).ready(function() {	
    $("#emp_nombre").autocomplete("ajax.php?a=search_emp", {        
        minChars: 1,
        highlight: false, 
        scroll: true, 
        scrollHeight: 300,
        formatItem: function(data, i, n, value) { 
            return value.split("#")[1]; 
        },
        formatResult: function(data, value) {
            return value.split("#")[1]; 
        }
		}).result(function(event,value) {
			$('#empresa_id').val(value[0].split('#')[0]);			
	  		
	});
});
</script>
