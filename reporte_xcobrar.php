<?php

	#echo "Aqui se creara el modulo de reportes de cobranzas...............!";

?>

<!-- //------JQUERY TABS COMPLETE--------------// -->
<link rel="stylesheet" type="text/css" href="libJquery/autocomplete/jquery-ui.css" />
<!--<script type="text/javascript" src="libJquery/autocomplete/jquery-1.9.1.js"></script>-->
<script type="text/javascript" src="libJquery/autocomplete/jquery-ui.js"></script>

<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador6.js"></script>

<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

<style type="text/css">

	#filCli
	{
		width:210px;
	}

</style>

<div class="box">

	<div class="heading">
    	<h1>Reporte - Cobranzas</h1>
	  	<div class="buttons">
	  		<?php
	  			$tipCob=$_POST['opci'];
	  			$filCob=negocio::concatVectCob($_POST['filCheck']);
	  			$fechIni=$_POST['fechIni'];
	  			$fechFin=$_POST['fechFin'];
	  			$numDoc=$_POST['numDoc'];
	  			$valRuc=$_POST['txtRuc'];
	  			$linkRepor="Javascript:geneReporExcel('".$tipCob."',
	  												  '".$filCob."',
	  												  '".$fechIni."',
	  												  '".$fechFin."',
	  												  '".$numDoc."',
	  												  '".$valRuc."');";
	  		?>
			<a class="button" href="<?php print $linkRepor; ?>"><span class="expExcel">Exportar Excel</span></a>
		</div>
   </div>
  	<div class="content report">
	<label class="dreamsFin">:)...</label>
	<form name="frmCobran" >
		<table width="100%" class="list">
	         <tr class="filter">
	            <td width="30%">
					<label id="lbl" >Fecha Inicio:</label>
					<div class="campo"><input type="text" name="fechIni" id="fechIni"></div>
	            	<label id="lbl">Fecha Fin:</label>
	            	<div class="campo"><input type="text" name="fechFin" id="fechFin"></div>
	            	<label id="lbl" >Cobranza:</label>
	            	<select name="opci" class="campo" id="opci" >
	            		<?php 
	            			$prop1="";
	            			$prop2="";
	            			$prop3="";
	            			$prop4="";

	            			if ($tipCob=='FP') 
	            			{
						 		$prop1="selected";
						 	} 
						 	else if($tipCob=='FT') 
						 	{ 
						 		$prop2="selected";
	            			}
	            			else if($tipCob=='FA') 
						 	{ 
						 		$prop3="selected";
	            			}
	            			else if($tipCob=='FN') 
						 	{ 
						 		$prop4="selected";
	            			}
	            			else 
	            			{ 
	            				$prop5="selected";
	            			} 
	            		?>
						<option <?php print $prop5; ?> ></option>
	            		<option value="FP" <?php print $prop1; ?> >Factura Pendientes</option>
	            		<option value="FT" <?php print $prop2; ?> >Factura Cobradas</option>
	            		<option value="FA" <?php print $prop3; ?> >Factura Anulada</option>
	            		<option value="FN" <?php print $prop4; ?> >Por Facturar</option>
	            	</select>
	            	<label id="lbl" >N° de documento:</label>
	            	<input type="text" name="numDoc" class="campo">
	            	<label id="lbl">Ruc:</label>
	            	<input type="text" name="txtRuc" class="campo" >

	            	<!--
	            	<label>Subdiario:</label>
	            	<select>
	            		<?php foreach ($dataSubDi as $data) { ?>
	            			<option value='<?php print $data['subdiar_codigo']; ?>' ><?php print $data['subdiar_descripcion']; ?></option>
	            		<?php } ?>
	            	</select>
	            	-->

	            	<label id="lbl"></label>
	            	<div class="campo" >
	            		<input type="checkbox" value="fech" name="filCheck[]">Fecha
	            		<input type="checkbox" value="doc" name="filCheck[]">Doc
	            		<input type="checkbox" value="ruc" name="filCheck[]">Ruc
	            	</div>
	            	<label id="lbl"></label>
	            	<a class="button campo" href="#"><span class="expExcel">Limpiar</span></a>
	            	<a class="button campo" href="Javascript:busCobran();"><span class="expExcel">Buscar</span></a>
	            	
	            	<!--<a class="button" href="#"><span class="expExcel">Todos</span></a>-->
	            
	            </td>
	            <td align="center" width="70%" rowspan="2"  id="ajaxTipCamb" >
	            	<label>Compra:&nbsp;<?php print $cambCompra; ?></label>&nbsp;| 
	            	<label>Venta:&nbsp;<?php print $cambVenta; ?></label>&nbsp;| <input type="hidden" id="cambVenta" value="<?php print $cambVenta; ?>">
	            	<label>Fecha:&nbsp;<?php print $cambFecha; ?></label>
	            	<a href="Javascript:getCambNewPopup();" id="linkAddCobra">&nbsp;Actualizar Cambio&nbsp;</a>&nbsp;|
	            	<a href="Javascript:getCobaNewPopup();" id="linkAddCobra">&nbsp;Agregar Cobranza&nbsp;</a>
	            </td>
        	</tr>	
	     </table>
 	</form>
     <div class="lista">
     		<div id="ajaxCobranSf" >
     			<form name="frmCheckCob" id="frmCheckCob" >
				<table class="list">
					  <thead>
					  	  <tr>
					  	  	<td align="right" colspan="16" >
					  	  		<a href="Javascript:setTipCobran('FP')" id="linkAddCobra" >A Pendientes</a> | 
					  	  		<a href="Javascript:setTipCobran('FT')" id="linkAddCobra" >A Cobrados</a> | 
					  	  		<a href="Javascript:setTipCobran('FA')" id="linkAddCobra" >A Anulados</a> |
					  	  		<a href="Javascript:setTipCobran('FN')" id="linkAddCobra" >A Por Facturar</a>
					  	  	</td>
					  	  </tr>
					  	  <tr>
					  	  	<td colspan="16" class="resulTipCob" ><?php print $resulTipCob; ?></td>
					  	  </tr>
						  <tr align="center">
						  		<td></td>
						  		<td align="center" >Id</td>
							  	<td rowspan="1" align="center" valign="middle">Fecha Ingreso</td>
							  	<td rowspan="1" align="center" valign="middle">Fecha Venc.</td>
							  	<td>Dias Plazo</td>
							  	<td>Dias a vencer</td>
							  	<td rowspan="1" align="center" valign="middle">N° Documento</td>
							  	<td rowspan="1" align="center" valign="middle">Cliente</td>
							  	<td rowspan="1" align="center" valign="middle">Importe S/.</td>
							   <td rowspan="1" align="center" valign="middle">Importe US$.</td>
							   <td rowspan="1" align="center" valign="middle">Adelantado</td>
							   <td rowspan="1" align="center" valign="middle">Retencion</td>
							   <td rowspan="1" align="center" valign="middle">Factura S/.</td>
							   <td rowspan="1" align="center" valign="middle">Factura US$.</td>
							   <td rowspan="1" align="center" valign="middle">Observacion</td>
							   <td colspan="2" >Accion</td>
						  </tr>
					  </thead>
					  <tbody>
					  		<?php 
					  		$totImporSol=0;
					  		$totImporDol=0;
					  		$totFacSol=0;
					  		$totFacDol=0;
					  		foreach ($dataVenFac as $data) { 
					  			$linkEdit="Javascript:getCobaEditPopup('".$data['idVen']."')";
					  			$linkEli="Javascript:setEliCobran('".$data['idVen']."')";
					  		?>
					  		<tr>
					  			<td>
					  				<input type="checkbox" name="checkCob[]" id="checkCob" value="<?php print $data['idVen']; ?>">
					  			</td>
					  			<td align="center" ><?php print $data['idVen']; ?></td>
					  			<td rowspan="1" align="center" valign="middle"><?php print $data['fechPag']; ?></td>
					  			<td align="center" ><?php print $data['fechPagVto']; ?></td>
					  			<td align="center" >
					  				<?php print negocio::evaDiaVenc(negocio::calDiasVenc($data['fechPag'],$data['fechPagVto'])); ?>
					  			</td>
					  			<td>
					  				<?php print negocio::evaDiaVenc(negocio::calDiasVenc(strftime("%d/%m/%Y",time()),$data['fechPagVto'])); ?>
					  			</td>
							  	<td rowspan="1" align="center" valign="middle"><?php print $data['numFac']; ?></td>
							  	<td rowspan="1" align="left" valign="middle"><?php print $data['clie']; ?></td>

							  	<?php if ($data['mone']=='MN') { 
							  		$totImporSol=$totImporSol+$data['importSole'];
							  	?>
							  		<td rowspan="1" align="right" valign="middle"><?php print "S/. ".$data['importSole']; ?></td>
							  	<?php } else { ?>
							  		<td rowspan="1" align="center" valign="middle">-----</td>
							  	<?php } ?>

							  	<?php if($data['mone']=='ME') { 
							  		$totImporDol=$totImporDol+$data['importDola'];
							  	?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "$. ".$data['importDola']; ?></td>
							    <?php } else { ?>
							  		<td rowspan="1" align="center" valign="middle">-----</td>
							  	<?php } ?>

							    <td rowspan="1" align="center" valign="middle">-----</td>

							    <?php if($data['mone']=='MN') { ?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "S/. ".$data['igvn']; ?></td>
							    <?php } else { ?>
									<td rowspan="1" align="right" valign="middle"><?php print "$. ".$data['igve']; ?></td>
							    <?php } ?>

							    <?php if($data['mone']=='MN') { 
							    	$facMon=$data['importSole']-$data['igvn'];
							    	$totFacSol=$totFacSol+$facMon;
							    ?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "S/. ".$facMon; ?></td>
							    <?php } else { ?>
							    	<td rowspan="1" align="center" valign="middle">----</td>
							    <?php } ?>

							    <?php if($data['mone']=='ME') { 
							    	$facMon=$data['importDola']-$data['igve'];
							    	$totFacDol=$totFacDol+$facMon;
							    ?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "$. ".$facMon; ?></td>
							    <?php } else { ?>
							    	<td rowspan="1" align="center" valign="middle">----</td>
							    <?php } ?>

							    <td rowspan="1" align="center" valign="middle">-------</td>
							    <td>
							    	<a href="<?php print $linkEdit; ?>" id="linkAddCobra" >Editar</a>
							    </td>
							    <td>
							    	<a href="<?php print $linkEli; ?>" id="linkAddCobra" >Eliminar</a>
							    </td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="8" align='center' class='totFac'>SUB TOTAL FACTURADO</td>
								<td align="right" ><?php print "S/. ".number_format($totImporSol,2); ?></td>
								<td align="right" ><?php print "$. ".number_format($totImporDol,2); ?></td>
								<td align="center">----</td>
								<td align="center">----</td>
								<td align="right" ><?php print "S/. ".number_format($totFacSol,2); ?></td>
								<td align="right" ><?php print "$. ".number_format($totFacDol,2); ?></td>
							</tr>
							<tr>
								<td colspan="13" align="right">
									<?php
										$totalFinal=number_format(($totFacSol/$cambVenta)+$totFacDol,2); 
										print "$. ".$totalFinal; 
									?>
								</td>
							</tr>	
			        </tbody>
	        </table>
	    </form>
        </div>      
     </div>
	</div>

</div>
 

<div id="dialog" title="Nueva Cobranza" class="popupRecla">
	<div id="cobranNu" ></div>
	<div id="">
		<label id="lbl">Cobranza:</label>
		<select class="campo" id="tipCobran">
    		<option></option>
    		<option value="FP" >Factura Pendientes</option>
    		<option value="FT" >Factura Cobradas</option>
    		<option value="FA" >Factura Anuladas</option>
    		<option value="FN" >Por Facturar</option>
        </select>
        <!--<label id="lbl" >Estado</label>
        <select class="campo" id="estAnul">
        	<option value="0" >Activo</option>
        	<option value="1" >Anulado</option>
        </select>-->
		<label id="lbl">Fecha Ingreso:</label><div class="campo"><input type="text" id="fechPagCob"></div>
		<label id="lbl">Fecha Vencimiento:</label><div class="campo"><input type="text" id="fechPagVenc"></div>
		<label id="lbl">N° de Documento:</label>
		<div class="campo">
			<input type="text" class="facPart1" id="facPart1" maxLength="4">-
			<input type="text" class="facPart2" id="facPart2" maxLength="6">
		</div>
		<label id="lbl">Cliente:</label>
		<div id="ajaxEmpNuevo" class="ui-widget campo">
			<select class="campo dataCli" id="combobox">
				<?php foreach ($dataCli as $data) {?>
			  		<option value="<?php print $data['anex_ruc']; ?>" ><?php print $data['anex_descripcion']; ?></option>
			  	<?php } ?>
	        </select>
	        <img src="images/clean.png" width="25px" onclick="cleanEmp();" class="iconCamp">
	        <img src="images/add_reg.png" width="25px" onclick="getEmpPopup();" class="iconCamp">
        </div>
		<label id="lbl">Movimiento:</label><textarea class="campo"  id="movim" ></textarea>
		<label id="lbl">Moneda:</label>
		<select class="campo" id="mone">
			<option></option>
			<?php foreach ($dataMone as $data) {?>
		  		<option value="<?php print $data['tipomon_codigo']; ?>" ><?php print $data['tipomon_simbolo']; ?></option>
		  	<?php }?>
        </select>
		<label id="lbl">Importe:</label><input type="text" class="campo" id="impor">
		<label id="lbl">Retencion:</label><div class="campo" ><input type="text" id="reten" >&nbsp;%</div>
		<label id="lbl" ></label>
		<input type="button"  class="campo button" value="Guardar"  id="saveCobran" onclick="outCobaNewPopup2();">
		<input type="button"  class="campo button" value="Cancelar" onclick="outCobaNewPopup();">
	</div>
</div>

<div id="dialog2" title="Actualizar Tipo de Cambio" class="popupRecla">
	<div id="">
		<div id="cambNu" ></div>
		<label id="lbl">Compra:</label><input type="text" class="campo"  id="cambComp" value="<?php print $cambCompra; ?>" title="Formato de ejemplo #.##">
		<label id="lbl">Venta:</label><input type="text" class="campo" id="cambVent" value="<?php print $cambVenta; ?>">
		<label id="lbl" ></label>
		<input type="button"  class="campo button" value="Actualizar" onclick="outCambNewPopup2();">
		<input type="button"  class="campo button" value="Cancelar" onclick="outCambNewPopup();">
		<iframe src="" width="480px"  id="cambAct" ></iframe>
		<input type="hidden" id="fechActual" value="<?php  print strftime("%Y-%m-%d", time()); ?>" >
	</div>
</div>


<div id="dialog3" title="Nueva Empresa" class="popupRecla">
	<div id="">
		<label id="lbl">Ruc:</label>
		<input type="text"  class="campo" id="txtRuc" maxLength="11">
		<label id="lbl">Nombre:</label>
		<input type="text"  class="campo" id="txtEmp">
		<label id="lbl">Direccion:</label>
		<input type="text"  class="campo" id="txtEmpDire">
		<label id="lbl">Telefono:</label>
		<input type="text"  class="campo" id="txtEmpTel">
		<label id="lbl" ></label>
		<input type="button" value="Añadir" class="campo button" onclick="outEmpPopup2();">
		<input type="button" value="Cancelar" class="campo button" onclick="outEmpPopup();">
	</div>
</div>

<span id="resulAjax" ></span>
<span id="paramBus" >
	<input id="pTipCob"  type="hidden" value="<?php print $tipCob; ?>" >
	<input id="pFilCob"  type="hidden" value="<?php print $filCob; ?>" >
	<input id="pFechIni" type="hidden" value="<?php print $fechIni; ?>" >
	<input id="pFechFin" type="hidden" value="<?php print $fechFin; ?>" >
	<input id="pNumDoc"  type="hidden" value="<?php print $numDoc; ?>" >
	<input id="pValRuc"  type="hidden" value="<?php print $valRuc; ?>" >
</span>

