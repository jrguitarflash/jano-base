<!-- JS -->
<script type="text/javascript" src="js/cot_gesti.js" ></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- CONTROLLER DOWN -->

<!-- CONTROLLER UP -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<div class="box" >

	<!-- vista activa -->
	<input type="hidden" id="viewActi" value="<?php print $_GET['menu']; ?>" >

	<div class="heading" >
		<h1>Proyectos</h1>
		<div class="buttons" ></div>
	</div>
	<div class="content" >
		
		<!-- filtros de busqueda -->
		<label id="lbl2" >Responsable:</label>
		<select class="campo"  id="cot_usuResp" >
			<option></option>
			<?php foreach($dataResp as $data){ ?>
				<option value="<?php print $data['trabId']; ?>" ><?php print $data['desPer']; ?></option>
			<?php } ?>
		</select>
		<label class="campo" >Estado:</label>
		<select class="campo" id="cot_estaId" >
			<?php foreach($dataEsta as $data) { ?>
				<option value="<?php print $data['idEsta']; ?>" ><?php print $data['desEsta']; ?></option>
			<?php } ?>
		</select>
		<input type="text" class="campo" id="cot_desProye" >
		<a href="#" class="campo" id="cot_acciNuevProye" >Crear Proyecto</a>
		<a href="#" class="campo" id="cot_acciCreadCoti" >Crear Cotizacion</a>
		
		<!-- lista de proyectos -->
		<form name="cot_frmProye" >
			<input type='radio' name='cot_rdbProye' value="" style="display:none" >
			<table class="list cot_listProye" >
				<thead> <!-- Cabecera de Lista de Proyecto -->
					<tr>
						<td></td>
						<td></td>
						<td>FLS</td>
						<td>Resp.</td>
						<td>Usuario Final</td>
						<td>Proyecto</td>
						<td>Moneda</td>
						<td>Total</td>
						<td>Fecha Adj.</td>
						<td>Probabilidad</td>
						<td></td>
					</tr>
				</thead>
				<tbody id="cot_proyCoti_list" >
					<tr> <!-- Fila de Proyecto -->
						<td align="center" ><a href="#" id="cot_agruFl_1" onclick="cot_agruFl(this.id)" >+</a></td>
						<td><input type="checkbox" ></td>
						<td>Resp.</td>
						<td>Cliente</td>
						<td>Proyecto</td>
						<td>Moneda</td>
						<td>Total</td>
						<td>Fecha Adj.</td>
						<td>Probabilidad</td>
					</tr>
					<tr id="cot_agruFl_1_child" style="display:none"> <!-- Filas de Cotizaciones -->
						<td></td>
						<td colspan="8">
							<table width="100%" cellpadding="0px" cellspacing="0px" border="0px">
								<tr>
									<td>FL</td>
									<td>Resp.</td>
									<td>Cliente</td>
									<td>Proyecto</td>
									<td>Moneda</td>
									<td>Total</td>
									<td>Fecha Adj.</td>
									<td>Probabilidad</td>
								</tr>
								<tr>
									<td>FL</td>
									<td>Resp.</td>
									<td>Cliente</td>
									<td>Proyecto</td>
									<td>Moneda</td>
									<td>Total</td>
									<td>Fecha Adj.</td>
									<td>Probabilidad</td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	
	</div>

</div>

<!-- UI Nuevo Proyecto -->
<div title="Nuevo Proyecto" id="cot_uiNuevProye" >

	<!-- Proyecto -->
	<label id="lbl2" >Proyecto</label>
	<input type="text" class="campo" size="45" id="cot_nomProye" >
	<input type="hidden" id="cot_idProye" >

	<!-- Usuario Final -->
	<label id="lbl2" >Usuario Final</label>
	<input type="text" class="campo" id="cot_desCli" size="45">
	<input type="hidden" id="cot_idCli" >
	<a href="#" class="campo" id="cot_popNuevUsu" >Nuevo</a>

	<!-- Fecha Adjudicacion -->
	<label id="lbl2" >Fecha Adj.</label>
	<span class="campo" >
		<input type="text"  id="cot_fechAdju" >
	</span>

	<!-- accion guadar proyecto -->
	<label id="lbl2" ></label>
	<button class="campo" id="cot_acciSaveProye" disabled="true" >Guardar</button>

	<!-- accion editar proyecto -->
	<button class="campo" id="cot_acciEditProye" disabled="true" >Actualizar</button>

	<!-- mensaje de confirmacion -->
	<label id="lbl2" ></label>
	<span class="campo" id="cot_msjConfirProye" >Mensaje de Confirmacion</span>

</div>


<!-- UI Nuevo Usuario Final -->

<div title="Nuevo Usuario Final" id="cot_uiNuevUsu" >

	<!--  Empresa  -->
	<label id="lbl2" >Empresa:</label>
	<input type="text" class="campo"  id="cot_desEmp" >

	<!-- Ruc -->
	<label id="lbl2" >Ruc:</label>
	<input type="text" class="campo" id="cot_rucEmp" >

	<!-- Email -->
	<label id="lbl2" >Email:</label>
	<input type="text" class="campo" id="cot_mailEmp" >

	<!-- Telefono -->
	<label id="lbl2" >Telefono</label>
	<input type="text" class="campo" id="cot_telEmp" >

	<!-- Direccion -->
	<label id="lbl2" >Direccion</label>
	<textarea class="campo" id="cot_direEmp" ></textarea>

	<!-- accion guardar usuario -->
	<label id="lbl2" ></label>
	<button class="campo" id="cot_acciSaveUsu" >Guardar</button>

	<!-- mensaje de confirmacion -->
	<label id="lbl2" ></label>
	<span class="campo" id="cot_msjConfirUsu" >Mensaje de Confirmacion</span>

</div>