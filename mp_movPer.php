<!-- CSS MOVIMIENTO PERSONAL -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS MOVIMIENTO PERSONAL -->
<script type="text/javascript" src="js/mp_gesti.js?modojs=1" id="modojs" ></script>

<!-- JS HOUR UI -->
<link rel="stylesheet" type="text/css" href="libJquery/hourUi/jquery.ptTimeSelect.css" />
<script type="text/javascript" src="libJquery/hourUi/jquery.ptTimeSelect.js"></script>

<!-- CONTROLADOR INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADOR SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box" >
	<div class="heading" >
		<h1>Movimiento de Personal</h1>
		<span class="botone" >
			<a href="Javascript:mp_loadEvent('saveMovPer')">
				<img src="images/grabar.png" width="25px" title="Guardar nuevo movimiento" >
			</a>
		</span>
	</div>
	<div class="content" >
		<form id="mp_frmMovPer" name="mp_frmMovPer" method="post" >
			<!-- HIDDEN ACCION -->
			<input type="hidden" name="accion" value="">
			<!-- DATOS GENERALES  -->
			<span class="datGene" >
				<h3>Datos Generales de Movimiento</h3>
			</span>
			<label id="lbl" >Usuario:</label>
			<span class="campo" ><?php print $_SESSION['SIS'][1]; ?></span>
			<label id="lbl" >Area:</label>
			<span class="campo" ><?php print $valAre; ?></span>
			<label id="lbl" >Fecha de Salida:</label>
			<span class="campo">
				<input type="text" id="mp_fechSali" name="mp_fechSali" >
			</span>
			<label class="campo" >Hora Salida:</label>
			<div id="sample21" class="ui-widget-content campo" style="padding: .0em;">
				<input name="mp_hourSali" id="mp_hourSali" value=""/>
			</div>
			<label id="lbl" >Fecha de Retorno:</label>
			<span class="campo" >
				<input type="text" id="mp_fechRetor" name="mp_fechRetor" >
			</span>
			<label class="campo" >Hora Retorno:</label>
			<div id="sample22" class="ui-widget-content campo" style="padding: .0em;">
				<input name="mp_hourRetor" id="mp_hourRetor" value=""/>
			</div>
			<label id="lbl" >Centro de costo:</label>
			<select class="campo" id="mp_centCostId" name="mp_centCostId">
				<?php foreach($dataCentCost as $data) { ?>
				<option value="<?php print $data['centId']; ?>" ><?php print $data['centCost'].' - '.$data['proy_nombre']; ?></option>
				<?php } ?>
			</select>
		</form>
		<!-- DETALLE DE MOVIMIENTO -->
		<span class="datGene" >
			<h3>Detalles de Movimiento</h3>
		</span>
			<label id="lbl" >Motivo:</label>
			<input type="text" class="campo" id="mp_motiv" >
			<label id="lbl" >Destino:</label>
			<input type="text" class="campo" id="mp_ubi" >
			<label id="lbl" >Detalle</label>
			<textarea class="campo" id="mp_det" ></textarea>
			<label id="lbl" ></label>
			<input type="button" value="Agregar" class="campo" onclick="mp_ajaxGridMovPer('1','add')" >
		<!-- DATAGRID DE DETALLE -->
		<div id="ajaxGridMovPer">
			<table class="list">
				<thead>
					<tr>
						<td align="center" >item</td>
						<td>motivo</td>
						<td>ubicacion</td>
						<td>detalle</td>
						<td align="center" >Accion</td>
					</tr>
				</thead>
				<!--
					<tbody>
						<tr>
							<td>item</td>
							<td>motivo</td>
							<td>ubicacion</td>
							<td>detalle</td>
							<td align="center">
								<a href="#">Eliminar</a>
							</td>
						</tr>
					</tbody>
				-->
				<!--
					<tfoot>
						<tr>
							<td>item</td>
							<td>motivo</td>
							<td>ubicacion</td>
							<td>detalle</td>
							<td>Accion</td>
						</tr>
					</tfoot>
				-->
			</table>
		</div>
	</div>
</div>