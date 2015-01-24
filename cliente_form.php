<?php
$id=$_GET['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];
if($_POST['accion']>''){
	if($_POST['accion']=='I'){
		$id=empresa::edit($_POST['accion'],$_POST['id']);	
		$accion='U';
	}
	$id=($id>0)?$id:$_POST['id'];
	empresa::cliente_edit($accion,$id);
	$msj=1;	

}
$reg=empresa::cliente_lista($id);
?>
<?php if($msj==1){?><div class="success">Datos Grabados</div><? } ?>
<div class="box">
	<div class="heading">
    	<h1>Cliente</h1>
	  	<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=cliente_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<form action="index.php?menu=cliente_form" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$accion?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="empresa_perfil_id" value="2">
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
  </div>