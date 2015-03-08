<!-- PHP UTILS -->

	<?php require("utils_func.php"); ?>

<!-- JS UTILS -->

	<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS GESTIONADOR -->

	<script type="text/javascript" src="js/gestionador.js" ></script>

<!-- CSS DECORADOR -->

	<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!-- PHP CONTROLADOR SUP -->

	<?php require('clases/controlador/controladorSup.class.php'); ?>

<!-- PHP CONTROLADOR INF -->

	<?php require('clases/controlador/controladorInf.class.php'); ?>

<!-- HTML ID -->

	<input type="hidden" id="vi_id" value="<?php print $_GET['id']; ?>"  >

<!-- HTML VIEW -->

	<input type="hidden" id="vi_view"  value="<?php print $_GET['menu']; ?>" >

<!-- HTML BODY -->

	<div class="box" >

		<div class="heading" >

			<h1>Lista de Visitas</h1>

		</div>

		<div class="content" >

			<label><strong>Responsable:</strong></label>
			<!-- OUTPUT RESPONSABLE -->
				<span id="vi_respVisi" >Ing. <?php print $valTrab; ?></span>
			<!-- [*] -->

			&nbsp;&nbsp;

			<label><strong>Fecha:</strong></label>
			<!-- INPUT FECHA -->
				<input type="text" id="vi_fechVisi" >
			<!-- [*]-->

			<a href="#" id="vi_newVisi" >Nuevo</a>

			<!-- TABLE VISITAS -->
				<table class="list" > 
	    			<thead>
	    				<tr>
	    					<td align="center" >N°</td>
	    					<td>Ing.</td>
	    					<td>Fecha Inicial</td>
	    					<td>Fecha Final</td>
	    					<td align="center" >Accion</td>
	    				</tr>
	    			</thead>
	    			<tbody id="vi_visiEmp_tab" >
	    				<tr>
	    					<td align="center" >N°</td>
	    					<td>Ing.</td>
	    					<td>Fecha Inicial</td>
	    					<td>Fecha Final</td>
	    					<td align="center" >
	    						<a href="#">Editar</a>&nbsp;|
	    						<a href="#">Eliminar</a>
	    					</td>
	    				</tr>	
	    			</tbody>
				</table>
			<!-- [*] -->

		</div>

	</div>