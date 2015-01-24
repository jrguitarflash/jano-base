
<!-- CSS DECORADOR -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<?php

	$id=$_GET['id'];
	$tbl_id=$_GET['tbl_id'];
	$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];

	if($_POST['accion']>'')
	{
	    $id=tabla::tbl_edit_tbl($tbl_id,$_POST['id'],$_POST['accion']);
	    // Id|Mensaje|jscript
	    $return=explode("|", $id);
	    $id=($return[0]>0)?$return[0]:$_POST['id'];
	    
	    if($accion=='I' || $accion=='C')
	    {        
	        $tabla=tabla::edit('S',$tbl_id);
	        $campo_pk=$tabla['tbl_col_pk'];//.'='.$id;
	        //$_REQUEST[$pk]=$id;        
	        echo '<script>Javascript:window.location.href="index.php?'.Redirect($campo_pk, $id).'";</script>'; 
	    }
	
	    $accion=($id>0 && ($_POST['accion']=='I' || $_POST['accion']=='C'))?'U':$accion;
	       
	    if($return[2]>'')
	    {
	        echo '<script>Javascript:'.$return[2].'</script>';
	    }
	    
	    $msj=($return[1]>'')?$return[1]:'001';
	}
?>

<script language="javascript">

	$(document).ready(function()
	{
		$("#form1").validate();
		$("#btnSave").click(function()
		{
			$("#form1").submit();
		});
	   $("#btnDuplicar").click(function()
	   {
          if(confirm('¿Desea duplicar este registro?.'))
          {
              $("#accion").val('C');
              $("#form1").submit();
          }         
		});
	   setTimeout(function(){ $("#notificacion").fadeOut() }, 3000);	        
	});

</script>


<?php

	if( (isset($_REQUEST['flag'])) and ($_SESSION['SIS'][2]>0) )
	{ 
		#print $_REQUEST['flag']."-".$_SESSION['SIS'][2];
		#print $_POST['valor_cliente_id'];
		$sql=sql::getEmpxRucDes($_POST['valor_cliente_id']);
		$cliEmp=negocio::getVal($sql,'idEmp');
		$sql=sql::updateCoti($_POST['cot_fec_adj'],$_POST['imp_tipo_costo_id'],$_POST['moneda_id'],$_POST['cot_estado_id'],$_POST['cot_prioridad_id'],$_POST['cot_descrip'],$_POST['cot_fec_emis'],$_POST['cot_fec_venc'],$_POST['cot_referencia'],$_POST['contacto_id'],$cliEmp,$_GET['cotizacion_id'],$_POST['cot_cc_id'],$_POST['cot_cond_precios'],$_POST['cot_cond_plazo_ent'],$_POST['cot_cond_forma_pago'],$_POST['cot_cond_lugar_ent'],$_POST['cot_cond_garantia'],$_POST['cot_cond_validez'],$_POST['cot_cond_penalidad'],$_POST['cot_cond_carta_fianza'],$_POST['cot_probabilidad']);
		$contAfec=negocio::setData($sql);
		$sql=sql::updateCotiProye($_GET['cotizacion_id'],$_POST['frm_proy_nombre']);
		$contAfec=negocio::setData($sql);
		#$contAfec=1;
		print msjNotifi($contAfec." "."Datos Actualizados correctamente");
	}
	else
	{
		echo erp_notificacion($msj,$return[3]);
	}
?>

<div class="box">    
    <div class="heading">
        <?=tbl_form_cab('F',$tbl_id,$id)?>
   <div class="buttons">
        <? echo tbl_form_opcion($tbl_id)?>
        <?php if($_GET['menu_id']==41){ 
				$repoProf="reporte/reporte_proforma.php?id=".$_GET['imp_proforma_id'];        
	        ?> 
	        	<a href="<?php print $repoProf; ?>" target="_blank" ><img src="images/proform.png" width="20px"></a>
        <?php } ?>
	</div>
   </div>
   <div class="content">
			<?=tbl_form($tbl_id,$id,$accion)?>
			<?php print $reg['imp_proforma_id']; ?>
   </div>
</div>

<script language="javascript">

	$('#ui-tabs').tabs({
	    selected:  $("#tab").val(),
	    select: function(event, ui){       
	       $("#tab").val(ui.index);
	    }   
	}); 
	
	function col_form(sw,accion,id,tabla_id)
	{
		switch(sw){
			case 1:
				$('#dialog').remove();
				$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="tabla_col_form.php?a='+accion+'&id='+id+'&tabla_id='+tabla_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
				$('#dialog').dialog({
				title: 'Columna',
				bgiframe: false,
				width: 600,
				height: 450,
				resizable: false,
				close: function (event, ui) {
	                            window.location.reload();
				},
				modal: false
		});
				break;
			case 0:
				$('#dialog').dialog('close');
				break;
		}
		
	};
</script>

<!-- POPUP1 PARA IMPORTACION DE FS -->

<div id="ce_dialog1"  title="Importacion de FS" >
	<div class="box" >
		<div class="heading" >
			<h1>Importacion de FS</h1>
		</div>
		<div class="content fondPop" >
			<label id="lbl2" >FS:</label>
			<input class="campo" type="text" id="ce_fsDes" onKeyUp="ce_ajaxDetFs_espe();" onchange="ce_ajaxDetFs_espe();">
			<input class="campo" type="hidden" id="ce_fsId">
			<label id="lbl2" ></label>
			<button class="campo cs_ejeRepCot" onclick="ce_jsonImportFs();" >Confirmar</button>
			<div id="ce_ajaxDetFs" >
				<table class="list" >
					<thead>
						<tr>
							<td>Item</td>
							<td>Descripcion</td>
							<td>Moneda</td>
							<td>Unidad</td>
							<td>Precio Unit.</td>
							<td>Cantidad</td>
							<td>Precio Tot.</td>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- SUB-VIEW [sn_numSeri] -->

	<div id="sn_numSeri" title="Numero de serie" >
		<div id="successPrin" ></div>
		<div class="box fondPop" >
			<div class="heading" >
				<h1>Numero de serie</h1>
			</div>
			<div class="content" >
				<label id="lbl2" >Producto</label>
				<label class="campo" id="sn_desProd" >xxxxx</label>
				<input type="hidden" id="hdnIdDetComp" >
				<input type="hidden" id="hdnFechAct" >
				<input type="hidden" id="hdnCant" >
				<input type="hidden" id="hdnDese" >
				<input type="hidden" id="hdnUsu" value="<?php print $_SESSION['SIS'][2]; ?>" >
				<div id="sn_inputDina" ></div>
				<!--
				<label id="lbl2" >N° Serie:</label>
				<input type="text" class="campo" id="txtNumSeri" >
				-->
				<label id="lbl2" >Fecha almacen:</label>
				<span class="campo" ><input type="text" id="txtFechAlm" ></span>
				<label id="lbl2" ></label>
				<a href="Javascript:sn_addNumSeri()" class="campo" >Guardar</a>

				<div id="sn_ajaxSeriNum" >
					<table class="list">
						<thead>
							<tr>
								<td>Item</td>
								<td>Fecha Ingreso</td>
								<td>Fecha Almacen</td>
								<td>N° serie</td>
								<td>Accion</td>
							</tr>
						</thead>
						<tbody></tbody>
						<!--<tfoot></tfoot>-->
					</table>
				</div>

			</div>
		</div>
	</div>

	<!-- parametro id proyecto -->
	<input type='hidden' id='cot_idProye' value="<?php $idProye=isset($_GET['proyeId']) ? $_GET['proyeId'] : ''; print $idProye;  ?>"  >
	<input type='hidden' id='cot_idCoti' value="<?php $idCoti=isset($_GET['cotizacion_id']) ? $_GET['cotizacion_id'] : ''; print $idCoti;  ?>"  >

<!-- New update 07/01/2015 - CLOSE -->

	<!-- POPUP ORDENAR ITEMS -->
	<div id="cot_ordItems_pop" title="Ordenar Items" >

		<label>Empezar en:</label>
		<input type="text" size="5" id="cot_ordIni">
		<button id="cot_ordItems_btn" >Ordenar</button>
		<button id="cot_reinItems_btn" >Reiniciar</button>

		<!-- instancia check -->
		<!--<input  type="checkbox" name="selected[]" value="" ></input>-->

	</div>