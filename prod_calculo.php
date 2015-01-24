<?php
include("include/comun.php");

if($_REQUEST['accion']=='I'){
    producto::edit('C',$_REQUEST['id']);
	
	variables::var_edit('nac_porcentaje',$_REQUEST['nac_porcentaje']);
	variables::var_edit('adv_porcentaje',$_REQUEST['adv_porcentaje']);	
}


$reg=producto::edit('S',$_REQUEST['id']);

$moneda_id=($_REQUEST['moneda_id']>0)?$_REQUEST['moneda_id']:2;

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
                    $valor_moneda=1;
                    break;
	}
}


$fecha=($reg['prod_fec_cal']=='0000-00-00')?date("Y-m-d"):$reg['prod_fec_cal'];

$cif_porcentaje=($reg['cal_cif_unit_porcent']>0)?$reg['cal_cif_unit_porcent']:variable('CIF_porcentaje');




$soles=1;

//$valor_moneda=$moneda_tc['m_us']; //($_POST['tipo_cambio']>0)?$_POST['tipo_cambio']:2.7;
$fob=$reg['prod_precio'];
$cantidad=($_POST['cantidad']>0)?$_POST['cantidad']:1; //$reg['prod_stock'];
$cif_porc=($cif_porcentaje/100); // porcentaje
$cif_unitario=round(($fob*(1+$cif_porc)),2);
$flete=round(($cif_unitario-$fob),2);
$cif=round(($cif_unitario*$cantidad),2);

$nac_porc=(variable('nac_porcentaje')/100); // porcentaje
$nacionalizacion=round(($cif*$nac_porc),2);
$transporte=$reg['cal_transporte']; //($_POST['transporte']>0)?$_POST['transporte']:0;
$otros1=($_POST['otros1']>0)?$_POST['otros1']:0;
$otros2=($_POST['otros2']>0)?$_POST['otros2']:0;
$ad_v_porc=(variable('adv_porcentaje')/100); // porcentaje
$ad_valorem=round(($cif*$ad_v_porc),2);
//$costo_total=round(($cif+$nacionalizacion+$ad_valorem+$flete+$transporte+$otros1+$otros2),2);
$costo_total=round(($cif+$nacionalizacion+$ad_valorem+$transporte+$otros1+$otros2),2);

$cal_margen=($reg['cal_margen']>0)?$reg['cal_margen']:variable('margen_utilidad');;

$margen=($cal_margen/100); // porcentaje
$precio_total=round(($costo_total*(1-$margen)),2);
$margen_ew=round(($precio_total*$margen),2);
$comision_venta=round(($margen_ew*0.06),2);

$valor_venta_unit=round(($precio_total/$cantidad),2);
$igv_valor=(19/100); // porcentaje
$igv=round(($valor_venta_unit*$igv_valor),2);
$valor_venta=round(($valor_venta_unit+$igv),2);

$valor_venta_unit_soles=round(($valor_venta_unit*$valor_moneda),2);
$igv_soles=round(($igv*$valor_moneda),2);
$valor_venta_soles=round(($valor_venta*$valor_moneda),2);

if($fob==0){
	$msg='<font color ="red">El precio FOB es cero, no se reliazá el cálculo';
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Calculo</title>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles_popup.css" />

<script languaje="javascript">
    function Enviar(accion){
        document.form1.accion.value=accion;
        document.form1.submit();
    }
</script>
        
</head>
<body>
<form id="form1" name="form1" action="" method="post">
<input type="hidden" id="id" name="id" value="<?=$_REQUEST['id']?>" />
<input type="hidden" id="accion" name="accion" />
<input type="hidden" id="fecha" name="prod_fec_cal" value="<?=$fecha?>" />
<input type="hidden" id="prod_precio_venta" name="prod_precio_venta" value="<?=$valor_venta?>" />

<table  width="99%" align="center">
  
  <tr bgcolor="#FFFFFF">
    <td colspan="2"><?=$msg?></td>
    <td align="center" ><input type="submit" name="Submit2" value="Grabar" onClick="Calcular('I')">
      <input type="button" name="Submit3" value="Cerrar" onClick="Cerrar();"></td>
  </tr>
  <tr>
    <td><b><?=$reg['prod_alias']?></b></td>
    <td><b><?=$reg['prod_nombre']?></b></td>
    <td >Fecha:<b><?=$fecha?></b></td>
  </tr>
  <tr>
    <td  colspan="3" bgcolor="gray"> DATOS DE INGRESO </td>
  </tr>
  <tr>
    <td width="40%" >Tipo Cambio a  Nuevos Soles</td>
    <td  align="right"><select onChange="document.form1.submit();//convert(this.value);" id="moneda_id" name="moneda_id">
      <?=moneda_ddl($moneda_id)?>
    </select>
    <input   name="tipo_cambio" type="text" class="precio" id="tipo_cambio" value="<?=$valor_moneda?>" size="10"></td>
    <td>el <?=$moneda_tc['mon_tc_fecha']?></td>
  </tr>
  
  <tr>
    <td>Proveedor:</td>
    <td align="right"><?=$reg['proveedor']?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Cantidad</td>
    <td align="right"><input name="cantidad" type="text" class="precio" id="cantidad" value="<?=$cantidad?>" size="10"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Precio FOB unitario </td>
    <td align="right"><?=$fob?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Precio CIF unitario </td>
    <td align="right"><?=$cif_unitario?></td>
    <td align="right"><input name="cif_unit_porc" type="text" class="precio" id="cif_unit_porc" value="<?=$cif_porcentaje?>" size="3">
    %</td>
  </tr>
  
  <tr bgcolor="gray">
    <td colspan="3" >COSTO DE IMPORTACION </td>
  </tr>
  <!--<tr>
    <td> FOB </td>
    <td align="right"><?=$fob?></td>
    <td>&nbsp;</td>
  </tr>-->
  <tr>
    <td> Flete marítimo y seguro </td>
    <td align="right"><?=$flete?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> CIF </td>
    <td align="right"><?=$cif?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Nacionalización </td>
    <td align="right"><?=$nacionalizacion?></td>
    <td align="right"><input name="nac_porcentaje" type="text" id="nac_porcentaje" style="text-align:right" value="<?=variable('nac_porcentaje')?>" size="5">
      %</td>
  </tr>
  <tr>
    <td> Ad-valorem </td>
    <td align="right"><?=$ad_valorem?></td>
    <td align="right"><input name="adv_porcentaje" type="text" id="adv_porcentaje" style="text-align:right" value="<?=variable('adv_porcentaje')?>" size="5">      
      %</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="GRAY">COSTOS VARIABLES (Hasta puesta en almacén de la empresa) </td>
    </tr>
  <tr>
    <td> Transporte local</td>
    <td align="right"><input name="transporte" type="text" class="precio" id="transporte" value="<?=$transporte?>"></td>
    <td><input name="trans_descrip" type="text" id="trans_descrip" value="<?=$reg['cal_trans_descrip']?>"></td>
  </tr>
  <tr>
    <td> Otros 1</td>
    <td align="right"><input name="otros1" type="text" class="precio" id="otros1" value="<?=$otros1?>"></td>
    <td><input name="otros1_descrip" type="text" id="otros1_descrip"></td>
  </tr>
  <tr>
    <td > Otros 2</td>
    <td align="right"><input name="otros2" type="text" class="precio" id="otros2" value="<?=$otros2?>"></td>
    <td><input name="otros2_descrip" type="text" id="otros2_descrip"></td>
  </tr>
  <tr>
    <td> COSTO TOTAL </td>
    <td align="right"><?=$costo_total?></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr bgcolor="gray">
    <td> PRECIO VENTA </td>
	<td align="center"><input type="button" name="Submit" value="Calcular" onClick="Calcular('I')" ></td>
	<td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td> MARGEN (%)</td>
    <td align="right"><input style="text-align:right" name="cal_margen" type="text" id="cal_margen" value="<?=$cal_margen?>"></td>
    <td><input type="button" name="Submit4" value="Cambiar"></td>
  </tr>
  <tr>
    <td> MARGEN EW </td>
    <td align="right"><?=$margen_ew?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td> COMISION VENTA  6% </td>
    <td align="right"><?=$comision_venta?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> PRECIO TOTAL </td>
    <td align="right"><?=$precio_total?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td> VALOR DE VENTA UNITARIO </td>
    <td align="right" class="moneda"><?=$valor_venta_unit?></td>
    <td align="right"><span id="valor_venta_unit"><?=$valor_venta_unit_soles?></span></td>
  </tr>
  <tr>
    <td> IGV </td>
    <td align="right" class="moneda"><?=$igv?></td>
    <td align="right"><span id="igv"><?=$igv_soles?></span></td>
  </tr>
  <tr >
    <td > PRECIO DE VENTA</td>
    <td align="right" class="moneda"><?=$valor_venta?></td>
    <td align="right"><span id="valor_venta"><?=$valor_venta_soles?></span></td>
  </tr>
   <tr >
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function Cerrar(){
	window.parent.$('#prod_precio_venta').val($('#prod_precio_venta').val());
	window.parent.$('#dialog').dialog('close');
}
function Calcular(accion){
	$('#accion').val('I');
	$('#form1').submit();
}
function convert(moneda){
		switch(moneda){
			case "1": // soles				
				$('.moneda').html('S/.');
				break;
			case "2": // dolares
				$('.moneda').html('USD');
				break;
		}
}

</script>