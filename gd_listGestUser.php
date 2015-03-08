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

		<h1>Listado de Gestiones User</h1>

	</div>

	<div class="content" >

		<label id="gd_fech" >Fecha:</label>
		<span class="campo" ><input type="text" id="gd_fechGest" ></span>
		<label class="campo" >Estado:</label>
		<select class="campo" >
			<option></option>
			<?php foreach($dataEstaGest as $data){ ?>
			<option value="<?php print $data['gd_estaRutId']; ?>" ><?php print $data['gd_desEsta']; ?></option>
			<?php } ?>
		</select>
		<label class="campo" >Cantidad:</label>
		<span class="campo gd_valMed" >9</span>

		<!--<button class="campo" >Crear Ruta</button>-->
		<a href="#" class="campo" id="gd_lnkCreGestUser" >Crear Gestion</a>

		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td align="center" >Item</td>
					<td>Documentos</td>
					<td>Gestion</td>
					<td>Fecha</td>
					<td>Hora</td>
					<td>Lugar</td>
					<td>Estado</td>
					<td>Usuario</td>
					<td align="center" >Accion</td>
				</tr>
			</thead>
			<tbody>
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
					<td align="center" >
						<a href="#">Editar</a>
						<a href="#">Eliminar</a>
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