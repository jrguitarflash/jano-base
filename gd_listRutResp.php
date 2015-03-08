<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>

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

		<h1>Listado de Rutas Responsable</h1>

		<div class="buttons" >
			<span id="gd_notiGest" >Asignadas Hoy: 12</span>
		</div>

	</div>

	<div class="content" >

		<label id="gd_fech" >Fecha:</label>
		<span class="campo" ><input type="text"  id="gd_fechRut" ></span>
		<label class="campo" >Estado:</label>
		<select class="campo" >
			<option></option>
			<?php foreach($dataEstaRut as $data) { ?>
			<option value="<?php print $data['gd_estaRutId']; ?>" ><?php print $data['gd_desEsta'];  ?></option>
			<?php } ?>
		</select>
		<label class="campo" >Cantidad:</label>
		<span class="campo gd_valMed" >9</span>

		<!--
		<button class="campo" >Crear Ruta</button>
		-->

		<!--<button class="campo gd_btnDeco" id="gd_lnkShowRut" >Ver Ruta</button>-->


		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td align="center" >Item</td>
					<td>N°</td>
					<td>Fecha</td>
					<td>Descripcion</td>
					<td>Admin</td>
					<td>Responsable</td>
					<td>Estado</td>
					<td align="center" >Accion</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align="center" ><input type="checkbox" ></td>
					<td></td>
					<td>N°</td>
					<td>Fecha</td>
					<td>Descripcion</td>
					<td>Admin</td>
					<td>Responsable</td>
					<td>Estado</td>
					<td align="center" >
						<a href="Javascript:gd_lnkShowRut(0)">Ver Ruta</a>
					</td>
				</tr>
			</tbody>
		</table>

		<label id="gd_fech" >Pagina</label>
		<select class="campo" ></select>
		<label id="gd_fech" >de</label>
		<span class="campo" >12</span>

	</div>

</div>