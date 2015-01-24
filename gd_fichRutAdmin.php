<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS Notifi -->
<script type="text/javascript" src="libJquery/notifiJs/notifi-min.js" ></script>

<!-- JS -->
<script type="text/javascript" src="js/gd_gesti.js" ></script>

<!-- UTILS PHP -->
<?php require("utils_func.php"); ?>

<!-- CONTROLLER DOWN -->
<?php require("clases/controlador/controladorInf.class.php");  ?>

<!-- CONTROLLER UP -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<!-- VIEW -->
<input type="hidden" id="gd_view" value="<?php print $_GET['menu']; ?>"  >

<!-- ID -->
<input type="hidden" id="gd_idRutOcul" value="<?php print $_GET['id']; ?>" >

<div class="box" >

	<div class="heading" >

		<h1>Detalle Ruta Admin</h1>

		<div class="buttons" >
			<a href="#" id="gd_acciSaveRut" >Guardar Ruta</a> |
			<a href="#" id="gd_backRutAdm" >Volver Ruta</a>
		</div>
		
	</div> 

	<div class="content" >

		<!-- Instacia de Notificaciones -->
		<div class="elem-gd" ></div>

		<fieldset>
			<legend>Datos de Ruta</legend>
			<label id="lbl2" >N° Ruta</label>
			<span class="campo" id="gd_correRut" >---</span>
			<label id="lbl2" >Estado</label>
			<select class="campo"  id="gd_estaRut" >
				<option></option>
				<?php foreach($dataEstaRut as $data) { ?>
				<option value="<?php print $data['gd_estaRutId']; ?>" ><?php print $data['gd_desEsta'];  ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" >Fecha:</label>
			<span class="campo" ><input type="text"  id="gd_fechRut" ></span>
			<label id="lbl2" >Hora:</label>
			<select class="campo" id="gd_hourRut" >
				<option></option>
				<?php foreach($dataHora as $data) { ?>
					<option value="<?php print $data['hourId']; ?>" ><?php print $data['hourDes']; ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" >Responsable</label>
			<select class="campo"  id="gd_respRut" >
				<option></option>
				<?php foreach($dataResp as $data) { ?>
				<option value="<?php print $data['trabId']; ?>" ><?php print $data['perDes']; ?></option>	
				<?php } ?>
			</select>
		</fieldset>

		<fieldset>
			<legend>Detalle Ruta</legend>
			<span id="lbl2" >
				<img src="images/gd_images/gd_lupa.png" width="25px" id="gd_uiGestDoc">
			</span>
			<table class="list" >
				<thead>
					<tr>
						<td>Item</td>
						<td>Usuario</td>
						<td>Documentos</td>
						<td>Gestion</td>
						<td>Lugar</td>
						<td>Fecha</td>
						<td>Estado</td>
						<td align="center" >Accion</td>
					</tr>
				<thead>
				<tbody id="gd_detRut_ajax" >
					<tr>
						<td>Item</td>
						<td>Usuario</td>
						<td>Documentos</td>
						<td>Gestion</td>
						<td>Lugar</td>
						<td>Fecha</td>
						<td>Estado</td>
						<td align="center" >
							<a href="#">Eliminar</a>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>

	</div>

</div>

<!-- Popup Lista de Gestiones [gd_listGest_pop] -->

<div title="Ficha de Gestiones" id="gd_listGest_pop" >

		<label id="gd_fech" >Fecha:</label>
		<span class="campo" ><input type="text"  id="gd_fechGest" ></span>
		<label class="campo" >Estado:</label>
		<select class="campo" id="gd_estaGest" >
			<option value="0" ></option>
			<?php foreach($dataEstaGest as $data){ ?>
			<option value="<?php print $data['gd_estaGest']; ?>" ><?php print $data['gd_desEsta']; ?></option>
			<?php } ?>
		</select>
		<label class="campo" >Cantidad:</label>
		<span class="campo gd_valMed" id="gd_valMed" >9</span>

		<!--<button class="campo" >Crear Ruta</button>-->
		<!--<a href="#" class="campo" id="gd_lnkCreGestAdm" >Crear Gestion</a>-->

		<button class="campo" id="gd_acciAgreDet" >Añadir</button>

		<form name="gd_frmGest" id="gd_frmGest" >

		<table class="list" >
			<thead>
				<tr>
					<td><input type="checkbox" name="gd_chkGest[]" id="gd_chkGest" class="gd_oculCamp" value="0" ></td>
					<td align="center" >Item</td>
					<td>Documentos</td>
					<td>Gestion</td>
					<td>Fecha</td>
					<td>Hora</td>
					<td>Lugar</td>
					<td>Estado</td>
					<td>Usuario</td>
					<td>Prioridad</td>
					<td align="center" >Accion</td>
				</tr>
			</thead>
			<tbody id="gd_gestDoc_ajax" >
				<tr>
					<td align="center" ><input type="checkbox" ></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td align="center" >
						<a href="#">Editar</a>
						<a href="#">Eliminar</a>
					</td>
				</tr>
			</tbody>
		</table>

		</form>

		<label id="gd_fech" >Pagina</label>
		<select class="campo gd_pagApa" id="gd_pagEle" ></select>
		<label id="gd_fech" >de</label>
		<span class="campo" id="gd_totPag">12</span>

</div>

