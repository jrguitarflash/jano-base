<?php
$id=$_GET['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];

if($_POST['accion']>''){
	if($_POST['accion']=='I'){
		$id=persona::edit($_POST['accion'],$_POST['id']);	
		$accion='U';
	}
	$id=($id>0)?$id:$_POST['id'];
	persona::trabajador_edit($accion,$id);
	$msj=1;	
}
$reg=persona::trabajador_lista($id);
?>
<?php if($msj==1){?><div class="success">Datos Grabados</div><? } ?>
<div class="box">
	<div class="heading">
    	<h1>Trabajador</h1>
	  	<div class="buttons">
			<a class="button" onclick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=trab_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<form action="index.php?menu=trab_form" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$accion?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="persona_perfil_id" value="1">
<?
persona_ficha($accion,$id);
?>
<table width="100%"  class="form">	    
  <tr><td colspan="2">Datos de Gestion:</td></tr>
  <tr>
    <td width="19%" >&nbsp;</td>
	    <td width="81%" ><table width="100%" class="form">
          <tr>
            <td>Codigo:</td>
            <td><input name="trab_codigo" type="text" id="trab_codigo"  value='<?php echo $reg[0]['trab_codigo']?>' size="11" /></td>
          </tr>
          <tr>
            <td>Fecha inicio :</td>
            <td><input name="trab_fec_ini" type="text" id="trab_fec_ini"  value='<?php echo $reg[0]['trab_fec_ini']?>' size="50" /></td>
          </tr>
          <tr>
            <td>Estado:</td>
            <td><input name="trab_estado_id" type="text" id="trab_estado_id"  value='<?php echo $reg[0]['trab_estado_id']?>' size="50" /></td>
          </tr>
          
        </table></td>
  </tr>
</table>
</form>
    </div>
  </div>