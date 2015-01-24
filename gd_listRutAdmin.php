<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS Notifi -->
<script type="text/javascript" src="libJquery/notifiJs/notifi-min.js" ></script>

<!-- JS -->
<script type="text/javascript" src="js/gd_gesti.js" ></script>

<!-- CONTROLLER DOWN -->
<?php require("clases/controlador/controladorInf.class.php");  ?>

<!-- CONTROLLER UP -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<!-- VIEW -->
<input type="hidden" id="gd_view" value="<?php print $_GET['menu']; ?>"  >

<div class="box" >

	<div class="heading" >

		<h1>Listado de Rutas Admin</h1>

		<div class="buttons" >
			<span id="gd_notiGest" >Asignadas Hoy: 12</span>
		</div>

	</div> 

	<div class="content" >

		<!-- Instacia de Notificaciones -->
		<div class="elem-gd" ></div>

		<label id="gd_fech" >Fecha:</label>
		<span class="campo" ><input type="text"  id="gd_fechRut" ></span>
		<label class="campo" >Estado:</label>
		<select class="campo"  id="gd_estaRut" >
			<option></option>
			<?php foreach($dataEstaRut as $data) { ?>
			<option value="<?php print $data['gd_estaRutId']; ?>" ><?php print $data['gd_desEsta'];  ?></option>
			<?php } ?>
		</select>
		<label class="campo" >Cantidad:</label>
		<span class="campo gd_valMed" id="gd_valMed" >9</span>

		<!--<button class="campo">Asignar Responsable</button>-->
		<button class="campo gd_concreRut" id="gd_acciConcreRut" >Concretar Ruta</button>
		<button class="campo gd_btnDeco" id="gd_creadRut" >Crear Ruta</button>

		<form name="gd_frmRut" id="gd_frmRut" >
		<table class="list" >
			<thead>
				<tr>
					<td><input type="checkbox" name="gd_chkRut[]" id="gd_chkRut" value="0" ></td>
					<td>N°</td>
					<td>Fecha</td>
					<td>Hora</td>
					<td>Descripcion</td>
					<td>Admin</td>
					<td>Responsable</td>
					<td>Estado</td>
					<td align="center" >Accion</td>
				</tr>
			</thead>
			<tbody id="gd_rutGest_ajax" >
				<tr>
					<td align="center" ><input type="checkbox" ></td>
					<td>N°</td>
					<td>Fecha</td>
					<td>Hora</td>
					<td>Descripcion</td>
					<td>Admin</td>
					<td>Responsable</td>
					<td>Estado</td>
					<td align="center" >
						<a href="Javascript:gd_linkEditRut(0)">Editar</a> |
						<a href="#">Eliminar</a> |
						<a href="Javascript:gd_dirMarRut(0)">Marcar</a>
					</td>
				</tr>
			</tbody>
		</table>
		</form>

		<label id="gd_fech" >Pagina</label>
		<select class="campo" id="gd_pagRut" ></select>
		<label id="gd_fech" >de</label>
		<span class="campo" id="gd_totPag" >12</span>

	</div>

</div>