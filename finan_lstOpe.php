<!-- CSS -->

	<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->

	<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS Notifi -->

	<script type="text/javascript" src="libJquery/notifiJs/notifi-min.js" ></script>

<!-- JS -->

	<script  type="text/javascript" src="js/finan_gesti.js" ></script>

<!-- PHP UTILS -->

<!-- PHP CONTROLADOR DOWN -->
	
	<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- PHP CONTROLADOR UP -->

	<?php require("clases/controlador/controladorSup.class.php"); ?>

<!-- HTML VIEW -->

	<input type="hidden" id="finan_view" value="<?php print $_GET['menu']; ?>" >

<!-- HTML ID -->

	<input type="hidden" id="finan_opeId" value="<?php print $_GET['id']; ?>" >

<!-- HTML NOTIFI -->

	<span class="elem-gd" ></span>

<!-- HTML THEME -->

<div class="box" >

	<div class="heading" >
		
		<h1>Lista de Operaciones Bancarias</h1>
		<div class="buttons" >
			<a href="#" id="finan_opeNuev" >Nuevo</a>
			<a href="#" id="finan_opeApe" >Aperturar</a>
			<a href="#">Exportar</a>
		</div>
	
	</div>

	<div class="content" >

		<form id="finan_opeProye_frm" name="finan_opeProye_frm" >

		<label>Periodo</label>
		<select id="finan_periOpe" >
			<option value="" ></option>
		</select>

		<label>Estado</label>
		<select id="finan_estaOpe" >
			<option></option>
		</select>

		<table class="list" >
			<thead>
				<tr>
					<td><input type='checkbox' name='finan_opeProyeId[]' id='finan_opeProyeId' style="display:none" value="" ></td>
					<td align="center" >Item</td>
					<td>N° Operacion</td>
					<td>CC</td>
					<td>Proyecto</td>
					<td>Cliente</td>
					<td>Fecha de recepcion</td>
					<td align="center" >N° Operaciones</td>
					<td>Estado</td>
					<td align="center" >Accion</td>
				</tr>
			</thead>
			<tbody id="finan_opeProye" >
				<tr>
					<td align="center" >Item</td>
					<td>N° Operacion</td>
					<td>CC</td>
					<td>Proyecto</td>
					<td>Cliente</td>
					<td>Fecha de recepcion</td>
					<td align="center" >N° Operaciones</td>
					<td></td>
					<td align="center" >
						<a href="#">Editar</a> | 
						<a href="#">Eliminar</a>
					</td>
				</tr>
			</tbody>
		</table>

		</form>

	</div>

</div>

<!-- HTML POPUP -->