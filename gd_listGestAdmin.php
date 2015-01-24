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

<div class="box" >

	<div class="heading" >

		<h1>Listado de Gestiones Admin</h1>

		<div class="buttons" >
			<span id="gd_notiGest" >Pendientes Hoy: 12</span>
		</div>

	</div>

	<div class="content" >

		<!-- Instacia de Notificaciones -->
		<div class="elem-gd" ></div>

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
		<a href="#" class="campo" id="gd_lnkCreGestAdm" >Crear Gestion</a>

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

		<label id="gd_fech" >Pagina</label>
		<select class="campo gd_pagApa" id="gd_pagEle" ></select>
		<label id="gd_fech" >de</label>
		<span class="campo" id="gd_totPag">12</span>

	</div>

</div>