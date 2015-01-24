<?php
include("include/comun.php");

if($_REQUEST['accion']=='I'){
    
    imp_proforma::edit('C',$_REQUEST['id']);
	
}

$reg=imp_proforma::detalle($_REQUEST['id']);

$gasto_total=imp_proforma::imp_gasto('C',$_REQUEST['id']);

$moneda_id=($_REQUEST['moneda_id_fin']>0)?$_REQUEST['moneda_id_fin']:$reg['moneda_id'];
$moneda_id_ini=($_REQUEST['moneda_id_ini']>0)?$_REQUEST['moneda_id_ini']:$reg['moneda_id_ini'];

if($moneda_id>0){
	$moneda_tc=producto::moneda_tc();
	switch($moneda_id){
		case 2: // Soles
                    $valor_moneda=$moneda_tc['m_us'];
                    break;
		case 3: // Dolares
                    $valor_moneda=$moneda_tc['m_e'];
                    break;
		default: // Euros
                    $valor_moneda=2.7;
                    break;
	}
}

$ew=$reg['prod_ew_valor']/$reg['prod_cantidad'];
$fob=$reg['prod_fob_valor']/$reg['prod_cantidad'];
$cif=$reg['prod_cif_valor']/$reg['prod_cantidad'];
$nac=$reg['prod_nac_valor']/$reg['prod_cantidad'];
$adv=$reg['prod_adv_valor']/$reg['prod_cantidad'];

$flete=$reg['prod_flete_valor'];
$ef=$reg['prod_flete'];

$fc=$cif-$fob;

$adv_valor=($reg['prod_adv']>0)?$reg['prod_adv']:0;

$flete_total=$fc*$reg['prod_cantidad'];

$prod_almacen_valor_soles=conversor_divisas($reg['moneda_id_ini'], 1, $reg['prod_almacen_valor'],'V');




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Columnas</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
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

}
.error {
	float: none; color: red; vertical-align: middle; 	
}

input[type='text']{
    background-color:#FFFFCC;
}
input:disabled{
	background-color:white;
	border: 1px solid #000000;
}

.intro{
    color:blue;    
}

.locked{
    
}

</style>
<script language="javascript">
$(document).ready(function(){	
	$("#btnSave").click(function(){		
                if($("#prod_adv").val()==''){
                    alert('Seleccione AD Valorem');
                }else{
                    $('input:text').each(function(){
			$(this).removeAttr('disabled');
                    }); 
                    document.form1.accion.value='I';
                    document.form1.submit();
                }
	});
	$('#moneda_id_ini').change(function(){             
            convert();
        });
        $('#moneda_id_fin').change(function(){             
            convert();
        });
        $('#cantidad_ini').keyup(function() {
            convert();
        });
        function convert(){
            var cant_ini=$('#cantidad_ini').val();
            if(cant_ini>0){
                $.ajax({
                    type:"POST",
                    url: 'ajax.php?a=convert_mon',
                    data:"moneda_id_ini="+$("#moneda_id_ini").val()+"&moneda_id_fin="+$("#moneda_id_fin").val()+"&cantidad_ini="+cant_ini,
                    dataType: 'json',
                    success: function(json) {
                        if(json.moneda_valor){
                            $('#cantidad_fin').val(json.moneda_valor);
                            $('#moneda_cambio').html(json.moneda_cambio);
                            $('#moneda_soles').html(json.moneda_soles);
                            Limpiar();
                            activar($('#tipo_costo_id').val());
                        }

                    }
                });
                
            }
            //Limpiar();
            
        }
        $('#prod_adv').change(function(){
            var cant=$('#prod_cantidad').val();
            var tcif=$('#valor_cif').val();
            var tadv=$('#valor_adv').val();
            var fadv=$(this).val();
            var cadv=$('#adv').val();
            tadv=parseFloat(tcif*fadv).toFixed(2);
            $('#valor_adv').val(tadv);
            cadv=parseFloat(tadv/cant).toFixed(2)
            $('#adv').val(cadv);
            
            CalculoAlmacen();
            CambioSoles($('#prod_almacen_valor').val());
            
        });
        
        function Limpiar(){
            $('#prod_ef').val(0);
            $('#prod_fob').val(0);
            $('#prod_cif').val(0);
            $('#prod_nac').val(0);
            $('#prod_adv').val(0);
            $('#prod_fc').val(0);
            // Costo Unitario 
            $('#ew').val(0);
            $('#fob').val(0);
            $('#cif').val(0);
            $('#nac').val(0);
            $('#adv').val(0);
            $('#flete').val(0);
            $('#fc').val(0);
            // Costo Total
            $('#valor_ew').val(0);
            $('#valor_flete').val(0);
            $('#valor_fob').val(0);
            $('#valor_cif').val(0);
            $('#valor_nac').val(0);
            $('#valor_adv').val(0);
            $('#prod_almacen_valor').val(0);
            $('#prod_almacen_valor_soles').val(0);
        }
        
        function activar(valor){
            //Limpiar();
            $('.list input:text').each(function(){
                $(this).attr('disabled','disabled');
            });
            switch(valor){
                case '1':
                        $('#prod_ew').removeAttr('disabled');
                        $('#prod_ef').removeAttr('disabled');
                        //$('#ew').removeAttr('disabled');
                        $('#ew').attr('class','intro');
                        $('#flete').removeAttr('disabled');
                        $('#prod_fc').removeAttr('disabled');
                        $('#fc').removeAttr('disabled');
                        
                        $('#ew').val($('#cantidad_fin').val());
                        break; // EW
                case '2':
                        $('#prod_ef').removeAttr('disabled');
                        $('#ew').removeAttr('disabled');
                        $('#flete').removeAttr('disabled');
                        //$('#fob').removeAttr('disabled');
                        $('#fob').attr('class','intro');
                        $('#prod_fc').removeAttr('disabled');
                        $('#fob').val($('#cantidad_fin').val());
                        break; // FOB
                case '3':
                        //$('#cif').removeAttr('disabled');
                        $('#cif').attr('class','intro');
                        //$('#prod_fc').removeAttr('disabled');
                        $('#cif').val($('#cantidad_fin').val());
                        break; // CIF
                case '4':
                    $('#fob').removeAttr('disabled');
                    $('#cif').removeAttr('disabled');
                    break;
                case '5':
                    Limpiar();
                    break;
                
            }
            Calcular('');
        }
        
        function CambioSoles(monto){
            $.ajax({
                type:"POST",
                url: 'ajax.php?a=convert_mon',
                data:"moneda_id_ini="+$("#moneda_id_fin").val()+"&moneda_id_fin=1&cantidad_ini="+monto,
                dataType: 'json',
                success: function(json) {
                    if(json.moneda_valor){
                                                    //alert(json.moneda_valor);
                        $('#prod_almacen_valor_soles').val(json.moneda_valor);
                    }
                }
            });
        }
        
	function Calcular(input){
            var cant=$('#prod_cantidad').val();
            var tc=$('#valor_tc').val();
            var tipo=$('#tipo_costo_id').val();
            // Fator
            var fef=parseFloat($('#prod_ef').val());
            var ffob=parseFloat($('#prod_fob').val());
            var fcif=parseFloat($('#prod_cif').val());
            var fnac=parseFloat($('#prod_nac').val());
            var fadv=parseFloat($('#prod_adv').val());
            var ffc=parseFloat($('#prod_fc').val());
            // Costo Unitario 
            var cew=parseFloat($('#ew').val());
            var cfob=parseFloat($('#fob').val());
            var ccif=parseFloat($('#cif').val());
            var cnac=parseFloat($('#nac').val());
            var cadv=parseFloat($('#adv').val());
            var cflete=parseFloat($('#flete').val());
            var cfc=parseFloat($('#fc').val());
            // Costo Total
            var tew=parseFloat($('#valor_ew').val());
            var tfob=parseFloat($('#valor_fob').val());
            var tcif=parseFloat($('#valor_cif').val());
            var tnac=parseFloat($('#valor_nac').val());
            var tadv=parseFloat($('#valor_adv').val());
            try{
                switch(tipo){
                    case '1': // ex
                         switch(input){
                            case 'prod_fc':
                                cfc=cfob*(ffc/100);
                                $('#fc').val(cfc.toFixed(2));
                                break;
                            case 'fc':
                                ffc=(cfc/cfob)*100;
                                $('#prod_fc').val(ffc.toFixed(2));
                                break;                
                            case 'prod_ef':
                                cflete=cew*(fef/100);
                                $('#flete').val(cflete.toFixed(2));
                                break;
                            case 'flete':                                                                
                                fef=(cflete/cew)*100;
                                $('#prod_ef').val(fef.toFixed(2));                   
                                break;
                        }
                        
                        cfob=(cflete+cew);                                           
                        ccif=cfob*((ffc/100)+1);
                                                
                        break;
                    case '2': // fob
                        
                        cfc=cfob*(ffc/100);
                        cew=cfob-cflete;
                        $('#ew').val(cew.toFixed(2));
                        $('#fc').val(cfc.toFixed(2));
                        ccif=cfob*((ffc/100)+1);
                        $('#cif').val(ccif);
                        break;
                    case '3': // cif
                        //cfob=ccif/((ffc/100)+1);
                        //cfc=ccif-cfob;
                        $('#fc').val(cfc.toFixed(2));
                        cew=cfob;
                        $('#ew').val(cew.toFixed(2));
                        break;
                    case '4':
                    case '5':
                        cew=0;
                        break;
                }
            var ddp=0;
            if(tipo=='5'){
                ddp=parseFloat(cant*$('#cantidad_fin').val());
            }else{
            tew=(cew*cant).toFixed(2);
            $('#valor_ew').val(tew);
            
            
            $('#fob').val(cfob.toFixed(2));
            $('#cif').val(ccif.toFixed(2));
            
            $('#valor_flete').val((cfc*cant).toFixed(2));
            
            tfob=(cfob*cant).toFixed(2);
            $('#valor_fob').val(tfob);
            
            tcif=(ccif*cant).toFixed(2);
            $('#valor_cif').val(tcif);
            
            var nac=parseFloat(3.002+(43.311/(tcif/1000)));
            nac=(nac<3.35)?3.35:nac;
            $('#prod_nac').val(nac.toFixed(1));
            
            tnac=parseFloat(tcif*(nac/100)).toFixed(2);
            $('#valor_nac').val(tnac);
            
            cnac=parseFloat(tnac/cant).toFixed(2)
            $('#nac').val(cnac);

            if(fadv>""){
                tadv=parseFloat(tcif*fadv).toFixed(2);
                $('#valor_adv').val(tadv);          
            
                cadv=parseFloat(tadv/cant).toFixed(2)
                $('#adv').val(cadv);            
            }
            }

                var gasto_total=parseFloat($('#gasto_total').val());

                var total=0;
                total=parseFloat(gasto_total)+parseFloat(tnac)+parseFloat(tcif)+parseFloat(tadv)+parseFloat(ddp);
                //alert(total);
                $('#prod_almacen_valor').val(total.toFixed(2));
                
                CambioSoles(total);
                
            }catch(err){
                alert(err.message);
            }
                                
	}
               
	
	$('#tipo_costo_id').change(function(){
            //alert($(this).val());
            $('input:text').each(function(){
                $(this).removeAttr('class');
            });
            Limpiar();
            activar($(this).val());
       		
	});
        $('input:text').each(function(){
            if($(this).val()=='')$(this).val(0);
        });
        
        $('input:text').keyup(function() {
            if(isNaN($(this).val()))$(this).val(0);
            if($(this).val()!='')Calcular($(this).attr('id'));
        });
                
        activar($('#tipo_costo_id').val());
			
});


</script>
</head>
<body>
<form name="form1" id="form1" method="post" autocomplete="off">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="producto_id" value="<?=$reg['producto_id']?>">
<input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
<input type="hidden" name="tabla_id" value="<?=$_REQUEST['tabla_id']?>">
<div id="ui-tabs">
	<ul>
	<li><a href="#tab-general">Cálculo</a></li>	
	<li><a href="#tab-gastos">Gastos</a></li>	
	</ul>
<div id="tab-general">
<table width="100%" border="0" class="form">
  
  
<!--
  <tr>
    <td align="right">Tipo cambio </td>
    <td colspan="3"><input name="valor_tc" type="text" class="moneda" id="valor_tc" value="<?=$valor_moneda?>" size="15" /></td>
  </tr>
-->

  <tr>
    <td align="right">Moneda origen</td>
    <td colspan="3"><select name="moneda_id_ini" id="moneda_id_ini">
      <?=moneda_ddl($moneda_id_ini)?>
    </select>
    <input name="cantidad_ini" type="text" id="cantidad_ini" value="<?=$reg['precio_ini']?>" />&nbsp;(<span id="moneda_cambio"><?=conversor_divisas($moneda_id,$moneda_id_ini,0,$tipo='C')?></span>)</td>
  </tr>
  <tr>
    <td align="right">Moneda final </td>
    <td colspan="3"><select name="moneda_id_fin" id="moneda_id_fin">
      <?=moneda_ddl($moneda_id)?>
        </select>
      <input name="cantidad_fin" type="text" id="cantidad_fin" value="<?=$reg['precio_fin']?>" /></td>
  </tr>
  <tr>
    <td align="right">Tipo Costo </td>
    <td colspan="3"><select name="tipo_costo_id" id="tipo_costo_id">
      <?=tipo_costo_ddl($reg['imp_tipo_costo_id'])?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">Cantidad</td>
    <td colspan="3"><input name="prod_cantidad" type="text" id="prod_cantidad" style="text-align:center" value="<?=$reg['prod_cantidad']?>" size="15" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top"><table class="list" width="95%" border="0">
	<thead>
      <tr>
        <td>&nbsp;</td>
        <td align="center">Factor</td>
        <td align="center">Costo Unitario </td>
        <td align="center">Costo Total </td>
      </tr>
	 </thead>
      <tr>
        <td align="right">EX-WORK  </td>
        <td align="center">&nbsp;</td>
        <td align="center"><input name="ew" type="text" class="moneda" id="ew" value="<?=$ew?>" size="15" /></td>
        <td align="center"><input name="valor_ew" type="text"  class="moneda" id="valor_ew" value="<?=$reg['prod_ew_valor']?>" size="15" /></td>
      </tr>
      <tr>
        <td align="right">(Flete) EF % </td>
        <td align="center"><input name="prod_ef" type="text" id="prod_ef" style="text-align:center" value="<?=$ef?>" size="15" /></td>
        <td align="center"><input name="flete" type="text" class="moneda" id="flete" value="<?=$flete?>" size="15" /></td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">FOB</td>
        <td align="center">&nbsp;</td>
        <td align="center"><input name="fob" type="text" class="moneda" id="fob" value="<?=$fob?>" size="15" /></td>
        <td align="center"><input name="valor_fob" type="text"  class="moneda" id="valor_fob" value="<?=$reg['prod_fob_valor']?>" size="15" /></td>
      </tr>
      <tr>
        <td align="right">(Flete) FC%</td>
        <td align="center"><input name="prod_fc" type="text" id="prod_fc" style="text-align:center" title="%" value="<?=$reg['prod_cif']?>" size="15" /></td>
        <td align="center"><input  name="fc" type="text" id="fc" style="text-align:center" value="<?=$fc?>" size="15" /></td>
        <td align="center"><input name="valor_flete" type="text" id="valor_flete" value="<?=$flete_total?>" size="15" /></td>
      </tr>
      <tr>
        <td align="right">CIF</td>
        <td align="center">&nbsp;</td>
        <td align="center"><input name="cif" type="text" class="moneda" id="cif" value="<?=$cif?>" size="15" /></td>
        <td align="center"><input  name="valor_cif" type="text" class="moneda" id="valor_cif" value="<?=$reg['prod_cif_valor']?>" size="15" /></td>
      </tr>
      <tr>
        <td align="right">NAC</td>
        <td align="center"><input  name="prod_nac" type="text" id="prod_nac" style="text-align:center" value="<?=$reg['prod_nac']?>" size="15" /></td>
        <td align="center"><input  name="nac" type="text" class="moneda" id="nac" value="<?=$nac?>" size="15" /></td>
        <td align="center"><input  name="valor_nac" type="text" class="moneda" id="valor_nac" value="<?=$reg['prod_nac_valor']?>" size="15" /></td>
      </tr>
      <tr>
        <td align="right">AD Valorem </td>
        <td align="center"><select class="required" name="prod_adv" id="prod_adv"><?=imp_adv_ddl($adv_valor)?></select>        </td>
        <td align="center"><input name="adv" type="text"  class="moneda" id="adv" value="<?=$adv?>" size="15" /></td>
        <td align="center"><input  name="valor_adv" type="text" class="moneda" id="valor_adv" value="<?=$reg['prod_adv_valor']?>" size="15" /></td>
      </tr>
      <tr>
        <td align="right">Gasto Adicional</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center"><input   name="gasto_total" type="text" class="moneda" id="gasto_total" value="<?=$gasto_total?>" size="15" /></td>
      </tr>
      
      <tr>
        <td align="right">Costo Almacén</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center"><input  name="prod_almacen_valor" type="text" class="moneda" id="prod_almacen_valor" value="<?=$reg['prod_almacen_valor']?>" size="15" /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="center"><div id="moneda_soles"><?=conversor_divisas($moneda_id,1,0,$tipo='C')?></div></td>
        <td align="right">S/.</td>
        <td align="center"><input name="prod_almacen_valor_soles" type="text" class="moneda" id="prod_almacen_valor_soles" value="<?=$prod_almacen_valor_soles?>" size="15" /></td>
      </tr>
      
      
    </table>      </td>
    </tr>
  
  <tr>    
    <td colspan="4" align="right" bgcolor="#CCCCCC">
	<div class="buttons">
	<button type="button" class="button" name="btnSave" id="btnSave" >Grabar</button>
	<!--<button type="button" class="button" onclick="alert('ok');Limpiar();">Limpiar</button>-->
	</div>	</td>
  </tr>
  </table>
  
  </div>
  <div id="tab-gastos">  	  	
    <table width="100%" border="0">
      <tr>
        <td>&nbsp;</td>
        <td align="right"><a onclick="imp_prof_gasto('I',0,'<?=$_REQUEST['id']?>')"><img title="Agregar" src="images/add.png"></a></td>
      </tr>
      <tr>
        <td colspan="2"><div id="gasto_lista"><?=imp_gasto_lista($_REQUEST['id']);?></div></td>
        </tr>
    </table>
  </div>

</div>
<p align="right">&nbsp;</p>
<div id="contenido"></div>
</form>
</body>
</html>
<script language="javascript">
$('#ui-tabs').tabs(); 
function imp_prof_gasto(accion,id,imp_prof_det_id){    
    switch(accion){
        case 'I':
        case 'U':
            $('#dialogx').remove();
            $('#contenido').prepend('<div id="dialogx"></div>');
            $('#dialogx').load('ajax.php?a=imp_prof_gasto&accion=FRM&id='+id).dialog({
                title: 'Gastos',
                bgiframe: true,
                width: 350,
                height: 160,
                resizable: false,
                modal: true,
                buttons:{
                    "Aceptar": function(){
                        $.ajax({
                            type:"POST",
                            url: 'ajax.php?a=imp_prof_gasto&accion='+accion+'&id='+id,
                            data:"imp_prof_det_id="+imp_prof_det_id+'&imp_prof_gasto_nombre='+$('#nombre').val()+'&imp_prof_gasto_valor='+$('#valor').val(),
                            dataType: 'json',
                            success: function(json){
                                if(json.total){                                    
                                    // Ir a la ficha de Cotizacion
                                    $('#gasto_total').val(json.total);
                                    $('#gasto_lista').load('ajax.php?a=imp_prof_gasto&accion=L&imp_prof_det_id='+imp_prof_det_id);
                                    CalculoAlmacen();
                                    $('#dialogx').dialog('close');

                                }
                            }
                        });
                    },
                    "Cancelar": function(){
                        $(this).dialog('close');
                    }
                }
            });
            break;
        case 'D':
            if(confirm('Desea eliminar el registro?')){
                $.ajax({
                    type:"POST",
                    url: 'ajax.php?a=imp_prof_gasto&accion=D&id='+id,
                    data:"imp_prof_det_id="+imp_prof_det_id,
                    dataType: 'json',
                    success: function(json){
                        if(json.total){
                            //alert(json.total);
                            $('#gasto_total').val(json.total);
                            $('#gasto_lista').load('ajax.php?a=imp_prof_gasto&accion=L&imp_prof_det_id='+imp_prof_det_id);
                            CalculoAlmacen();
                            $('#dialogx').dialog('close');
                        }
                    }
                });
            }
            break;
    }
}
function CalculoAlmacen(){
            var tcif=parseFloat($('#valor_cif').val());
            var tnac=parseFloat($('#valor_nac').val());
            var tadv=parseFloat($('#valor_adv').val());
            var gasto=parseFloat($('#gasto_total').val());                        
            var ddp=parseFloat($('#cantidad_fin').val()*$('#prod_cantidad').val());
            var total=0;
            if($('#tipo_costo_id').val()=='5'){
                total=(ddp+gasto);
            }else{
                total=(tcif+tnac+tadv+gasto);
            }
            $('#prod_almacen_valor').val(total.toFixed(2));
            
        }
</script> 
