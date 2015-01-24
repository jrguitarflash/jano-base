<?php
if(isset($_GET['accion'])){
	$cp_id=cp_compras::cp_edit($_GET['id'],$_GET['accion']);
	if($cp_id>0){ // Actualizar Correlativo
		local::local_comp_edit(0,'K');
	}	
	$_GET['a']=($_GET['accion']=='I')?"U":$_GET['accion'];
	/*if($_GET['reload']==''){echo "<script>menu(3,'comprobante_lista','');</script>";}*/
}
$cp_id=($cp_id>0)?$cp_id:$_GET['id'];
$reg = cp_compras::cp_edit($cp_id,'S');
//$var=accion($_GET['a'],'Comprobante');
//$cliente=cliente::cliente_edit($reg[0]['cliente_id'],'E');
$tipo_id=($_GET['cp_tipo_id']>0)?$_GET['cp_tipo_id']:$reg[0]['cp_tipo_id'];
$tipo=cp_compras::cp_tipo_ddl($tipo_id);
$igv=(variable('igv')>'')?variable('igv'):'18';
//$cp_nro=comp_nro($cp_id,$reg[0]['cp_nro']);
?>
<div class="box">
	<div class="heading">
    	<h1>Comprobante de Pago</h1>
	  	<div class="buttons">
			<a class="button icon save" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button icon print" href="#"><span>Imprimir</span></a>
			<a class="button icon back" href="index.php?menu_id=32&menu=personas&tbl_id=148"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
		<form action="index.php?menu=comprobante_edit&menu_id=32" method="post" name="form1">
		<input type="hidden" name="accion" id="accion" value="<?=$accion?>">
		<input type="hidden" name="id" id="id" value="<?=$cp_id?>">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  
  <tr>
    <td align="center"><font size="+2">
      <?=variable('Dominio');?>
    </font><br />
RUC:
<?=variable('ruc');?>
<br />
Direcci&oacute;n:
<?=variable('Direccion');?></td>
    <td colspan="2" align="center">
	<fieldset>
	<font size="+1">
      <?=strtoupper($tipo[0]['cp_tipo_nombre'])?>
    </font><br />
    <input name="cp_nro" type="hidden" id="cp_nro" value="<?=$cp_nro?>" />
Nro.
<?=$cp_nro?>
<br />
Emisi&oacute;n
<input name="cp_fec_emis" type="text" id="cp_fec_emis" value="<?=($reg[0]['cp_fec_emis']=='')?date('Y-m-d'):substr($reg[0]['cp_fec_emis'],0,10)?>" size="12" />
</fieldset>
</td>
  </tr>
  <tr>
    <td width="58%" align="center">&nbsp;</td>
    <td width="32%" colspan="2" align="center">
	</td>
  </tr>
  <tr>
    <td colspan="3" ><fieldset>
      <table width="100%" border="0" cellspacing="2" cellpadding="0">
        
        <tr>
          <td >Cliente:</td>
          <td><input name="cliente_nombre" type="text" id="cliente_nombre" size="58" value="<?=$reg[0]['cliente_id']?>" />
                <input name="cliente_id" type="hidden" id="cliente_id" value="<?=$reg[0]['cliente_id']?>"/></td>
          <td rowspan="3" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">Moneda:&nbsp;</td>
                <td><select name="moneda_id" id="moneda_id">
                  <?=moneda_ddl($reg[0]['moneda_id'])?>
                  </select></td>
              </tr>
            <tr>
              <td align="right">SubTotal:&nbsp;</td>
                <td><input name="cp_monto_sub" type="text" id="cp_monto_sub" value="<?=$reg[0]['cp_monto_sub']?>" size="10" onkeyup="calcular(this);" style="text-align:right" /></td>
              </tr>
            <tr>
              <td align="right"><input name="cp_monto_igv" type="hidden" id="cp_monto_igv" value="<?=$reg[0]['cp_monto_igv']?>" />
                IGV(
                <?=$igv?>
                %):&nbsp;</td>
                <td><div style="text-align:right;width:70px" id="p_igv">
                  <?=$reg[0]['cp_monto_igv']?>
                  </div></td>
              </tr>
            <tr>
              <td align="right"><input name="cp_monto_tot" type="hidden" id="cp_monto_tot" value="<?=$reg[0]['cp_monto_tot']?>" />
                Total:&nbsp;</td>
                <td><div style="text-align:right;width:70px;color:red" id="p_total"><b>
                  <?=$reg[0]['cp_monto_tot']?>
                  </b></div></td>
              </tr>
            <tr>
              <td colspan="2" align="right"><hr></td>
              </tr>
            <tr>
              <td align="right">Vencimiento:&nbsp;</td>
              <td><input name="cp_fec_venc" type="text" id="cp_fec_venc" value="<?=($reg[0]['cp_fec_venc']=='')?date('Y-m-d'):substr($reg[0]['cp_fec_venc'],0,10)?>" size="12" /></td>
            </tr>
            <tr>
              <td align="right">Forma pago: </td>
                <td><select name="select">
                </select>                </td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td>RUC:</td>
          <td valign="top"><input name="cliente_ruc" type="text" id="cliente_ruc" /></td>
        </tr>
        <tr>
          <td valign="top">Descripci&oacute;n:</td>
          <td valign="top"><textarea name="cp_descrip" cols="60" rows="4" id="cp_descrip"><?//=comp_det_cadena($_GET['id'],$reg[0]['cp_descrip'])?>
</textarea></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
    
  <tr>
    <td colspan="3" align="center"  height="5"></td>
  </tr>
 
  <!----------------Detalle--------------------->
  <tr>
    <td colspan="3" bgcolor="gray" >Detalle</td>
  </tr>
  <tr>
    <td colspan="3" align="center" >
    <table class="list">
      <thead>
      <tr>        
        <td align="center">Id</td>
        <td >Producto / Servicio</td>
        <td>Precio</td>
        <td >Cantidad</td>
        <td >Subtotal</td>
        <td >&nbsp;</td>		
      </tr>
	  </thead>
      <tr>
        
        <td width='5%'>&nbsp;</td>
        <td width='50%' class='celda'><input size='80' name='prod_nombre' id='prod_nombre' type='text' >
              <input type='hidden' id='producto_id' name='producto_id'></td>
        <td width='10%' class='celda'><input name='prod_precio_venta' type='text' id="prod_precio_venta" style='text-align:right' size='6' /></td>
        <td width='10%' class='celda'><input name='prod_cantidad' type='text' id="prod_cantidad" style='text-align:center' size='6' /></td>
        <td width='15%' class='celda'><input name="prod_subtotal" type="text" id="prod_subtotal" size="10" /></td>
        <td align="center" ><button type="button" class="button icon add" onclick="Detalle(0,'I')">Agregar</button></td>
      </tr>
      
      
    </table>
	<div id="detalle"><?=cp_det_lista($cp_id)?></div>
	</td>
  </tr>
  <!----------------Fin Detalle---------------------> 
 
</table>
		</form>
    </div>
</div>
 <script language="javascript">
$(document).ready(function() {	
    $("#prod_nombre").autocomplete({
        source: "ajax.php?a=search_prod",
        minLength: 2,
        select: function(event, ui){
            $("#producto_id").val(ui.item.id);
            $("#prod_precio_venta").val(ui.item.precio);
            $("#prod_cantidad").val(1);
            $("#prod_subtotal").val(ui.item.precio*1)
            
            return false;
        },
        focus: function(event,ui){
            $("#prod_nombre").val(ui.item.value);
            $("#prod_precio_venta").val(ui.item.precio);                        
            return false;
        }
    });
    $("#cliente_nombre").autocomplete({
        source: "ajax.php?a=search_cli",
        minLength: 2,
        select: function(event, ui){
            $("#cliente_id").val(ui.item.id);
            $("#cliente_ruc").val(ui.item.ruc);
            return false;
        },
        focus: function(event,ui){
            $("#cliente_nombre").val(ui.item.value);           
            return false;
        }
    });
   
    Calendario('cp_fec_emis');
    Calendario('cp_fec_venc');
});
 function Detalle(id,accion){        
        switch(accion){
            case 'I':
                $.ajax({
                    type:"POST",
                    url: 'ajax.php?a=cp_detalle&accion=I',
                    data:"cp_id="+$('#id').val()+'&producto_id='+$('#producto_id').val()+'&pro_nombre='+$('#prod_nombre').val()+'&pro_precio_venta='+$('#prod_precio_venta').val()+'&pro_cantidad='+$('#prod_cantidad').val(),                    
                    success: function(datos){                                                   
                        $('#detalle').html(datos);
                    }
                });
                
                break;
            case 'D':
                if(confirm('Desea elimianar este regisro?.')){                    
                    $('#detalle').load("ajax.php?a=cp_detalle&accion=D&cp_id="+$('#id').val()+"&id="+id);
                }
                
                break;
        }
        
    }
</script>