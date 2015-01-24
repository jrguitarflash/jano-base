<!--2. Especificacion de cotizacion servicios -> cs_espeCot-->

<!--  JS GESTIONADOR -->
<script type="text/javascript" src="js/cs_gesti.js?modojs=2" id="modojs" ></script>

<!-- CSS DECORADOR -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- PHP CONTROLADORES -->

<!-- CONTROLADOR INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADOR SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box" >
	<div id="successCab" ></div>
	<div class="heading" >
		<h1>Nueva Cotizacion de Servicio</h1>
		<span class="botone" >
			<a href="Javascript:cs_loadEvent('actuCotServ')">
				<img src="images/grabar.png" width="20px" title="Guardar cotizacion de servicio" >
			</a>
			<a href="Javascript:cs_loadEvent('direView');">
				<img src="images/lista.png" width="20px" title="Cotizaciones creadas">
			</a>
		</span>
	</div>
	<div class="content" >
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">General</a></li>
				<li><a href="#tabs-2">Detalle</a></li>
				<li><a href="#tabs-3">Condiciones</a></li>
			</ul> 
			<div id="tabs-1">
				<div class="cs_pesGene" >
					<label id="lbl" >FS:</label>
					<span class="campo" ><u><?php print $correVal; ?></u></span>
					<input type="hidden" name="cs_cotServId" id="cs_cotServId" value="<?php print $_GET['id']; ?>" >
					<label id="lbl" >Fecha:</label>
					<span class="campo" >	
					<input type="text"  id="cs_fechCot" name="cs_fechCot"  value="<?php print $fecha; ?>" >
					</span>
					<label id="lbl" >Cliente:</label>
					<input type="text" class="campo cs_dinaEmp" id="cs_empAlias" name="cs_empAlias" value="<?php print $cliDes; ?>">
					<input type="hidden" class="campo" id="cs_empId" name="cs_empId"  value="<?php print $cliId; ?>" >
					<img src="images/cs_eraser.png" width="25px" class="campo cs_eraser" title="Limpiar cliente" onclick="cs_loadEvent('cleanEmp');">
					<label id="lbl" >Resp. Comercial</label>
					<select class="campo" name="cs_respComer" id="cs_respComer" >
						<?php foreach($dataRespComer as $data) { ?>
						<option value="<?php print $data['respComerId']; ?>" <?php print $data['prop']; ?> ><?php print $data['respComer']; ?></option>
						<?php } ?>
					</select>
					<label id="lbl" >Moneda</label>
					<select class="campo" name="cs_moneId" id="cs_moneId">
						<?php foreach($dataMone as $data) { ?>
						<option value="<?php print $data['moneda_id']; ?>" <?php print $data['prop']; ?> ><?php print $data['mon_sigla']; ?></option>
						<?php }?>
					</select>
				</div> 
				<div class="cs_pesGene" >
					<label id="lbl" >Descripcion:</label>
					<textarea class="campo" name="cs_desServ" id="cs_desServ" ><?php print $descrip; ?></textarea>
					<label id="lbl" >Prioridad:</label>
					<select class="campo" name="cs_priorCot" id="cs_priorCot" >
						<?php foreach($dataPrior as $data){ ?>
						<option value="<?php print $data['priorId']; ?>" <?php print $data['prop']; ?> ><?php print $data['priorNom']; ?></option>
						<?php }?>
					</select>
					<label id="lbl" >Estado:</label>
					<select class="campo" name="cs_estServ" id="cs_estServ" >
						<?php foreach($dataEst as $data){ ?>
						<option value="<?php print $data['cotEstId']; ?>" <?php print $data['prop']; ?> ><?php print $data['cotEstNom']; ?></option>
						<?php }?>
					</select>
					<label id="lbl" ></label>
					<button class="campo cs_ejeRepCot" onclick="<?php print "Javascript:cs_loadEvent('ejeRepoCot','".$_GET['id']."','')"; ?>" >Ejecutar</button>
				</div>
			</div>
			<div id="tabs-2" >
				<div id="ajaxDetCotServ" >
					<table class="list" >
						<thead>
							<tr>
								<td colspan="7" align="right">
									<img src="images/add.png" width="20px" title="Nuevo detalle" onclick="cs_loadEvent('nuevDet');">
								</td>
							</tr>
							<tr>
								<td align="center" >Item</td>
								<td>Tipo</td>
								<td>Descripcion</td>
								<td>Unidad</td>
								<td>P.Unitario</td>
								<td>Cantidad</td>
								<td>P.Total</td>
								<td align="center" >Accion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="center" >Item</td>
								<td>Tipo</td>
								<td>Descripcion</td>
								<td>Unidad</td>
								<td>P.Unitario</td>
								<td>Cantidad</td>
								<td>P.Total</td>
								<td align="center" >
									<img src="images/b_edit.png" width="20px" title="Editar detalle">
									<img src="images/b_drop.png" width="20px" title="Eliminar detalle">
								</td>
							</tr>
						</tbody>
						<!--
						<tfoot></tfoot>
						-->
					</table>
				</div>
			</div>
			<div id="tabs-3" >
				<label id="lbl" >Requerimientos:</label>
				<textarea class="campo cs_dimenCond" id="cs_requiServ" ><?php print $reqCond; ?></textarea>
				<label id="lbl" >Tiempo de ejecución:</label>
				<textarea class="campo cs_dimenCond" id="cs_tiemEje" ><?php print $tiemEje; ?></textarea>
				<label id="lbl" >Garantia:</label>
				<textarea class="campo cs_dimenCond" id="cs_garanServ" ><?php print $garanCond; ?></textarea>
				<label id="lbl" >Condiciones de pago:</label>
				<textarea class="campo cs_dimenCond" id="cs_condPag" ><?php print $condPag; ?></textarea>
				<label id="lbl" >Tiempo de validez:</label>
				<textarea class="campo cs_dimenCond" id="cs_tiemVali" ><?php print $tiemVali; ?></textarea>
			</div>
		</div>
	</div>
</div>

<!-- POPUP DIALOG 1  -->
<div id="dialog1" title="Detalle de servicio">
	<div class="box" >
		<div class="heading" >
			<h1>Detalle de servicio</h1>
			<span class="botone" >  
				<img src="images/grabar.png" width="20px" title="Guardar detalle" onclick="cs_loadEvent('saveDet','','add')" id="cs_saveCoti" >
			</span>
		</div>
		<div class="content fondPop">
			<label id="lbl2" >Tipo:</label>
			<select class="campo" id="cs_tipServ">
				<?php foreach($dataTipServ as $data) { ?>
				<option value="<?php print $data['cs_tipDetServId'];  ?>" ><?php print $data['cs_desTipDes']; ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" >Descripcion:</label>
			<textarea class="campo" id="cs_detDes" ></textarea>
			<label id="lbl2" >Unidad:</label>
			<input type="text" class="campo" id="cs_detUnid" >
			<label id="lbl2" >Precio Unitario:</label>
			<input type="text" class="campo" id="cs_detPreUni" >
			<label id="lbl2" >Cantidad:</label>
			<input type="text" class="campo" id="cs_detCant" >
		</div>
	</div>
</div>

<!--  POPUP DIALOG 2 -->
<div id="dialog2"  title="Reporte cotizacion servicio" >
	<iframe src="" id="cs_reporCorServ" width="100%" height="500px" ></iframe>
</div>