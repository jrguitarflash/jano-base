<!-- JS UTILS -->

	<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS NOTIFI -->

	<script type="text/javascript" src="libJquery/notifiJs/notifi-min.js" ></script>

<!-- JS GESTIONADOR -->

	<script type="text/javascript" src="js/cc_gesti.js?modojs=5" id="modojs" ></script>

<!-- CSS DECORADOR -->

	<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- PHP UTILS -->

	<?php require('utils_func.php'); ?>

<!-- CONTROLLER DOWN -->

	<?php require('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLLER UP -->

	<?php require('clases/controlador/controladorSup.class.php'); ?>

<!-- HTML ID -->

	<input type="hidden" id="cc_id" value="<?php print $_GET['id']; ?>" >

<!-- HTML VIEW -->

	<input type="hidden" id="cc_menu" value="<?php print $_GET['menu']; ?>" >

<!-- HTML NOTIFI -->

	<span class="elem-gd" ></span>

<!-- HTML BODY -->

	<div class="box" >
		<div class="heading" >
			<h1>Asignacion de centros</h1>
		</div>
		<div class="content" >

			<label>Por orden</label>
			<!-- INPUT ORDEN -->
				<input type="checkbox"  id="cc_chkOrd">
			<!-- [*] -->

			<label>CC / (OC,EW,OS) Origen:</label>
			<!-- INPUT ORIGEN -->
				<input type="text" id="cc_asigOrig" >
				<input type="hidden" id="cc_asigOrigId" value="" >
			<!-- [*] -->

			<label>CC Destino:</label>
			<!-- INPUT DESTINO -->
				<input type="text" id="cc_asigDest" >
				<input type="hidden" id="cc_asigDestId" value="" >
			<!-- [*] -->

			<a href="#" id="cc_asigOrd" >Asignar</a>

			<!-- TABLE ORDENES -->
				<form name="cc_ordAsig_frm" id="cc_ordAsig_frm" >
				<table class="list" >
					<thead>
						<tr>
							<td><input type="checkbox" name="cc_ordAsig_chk[]" id="cc_ordAsig_chk" style="display:none" ></td>
							<td>EW/OC/OS</td>
							<td>Fecha</td>
							<td>Proveedor</td>
						</tr>
					</thead>
					<tbody id="cc_ordAsig_tab" >
						<tr>
							<td align="center" >
								<input type="checkbox" >
							</td>
							<td>EW/OC</td>
							<td>Fecha</td>
							<td>Proveedor</td>
						</tr>
					</tbody>
				</table>
				</form>
			<!-- [*] -->

		</div>
	</div>

<!-- HTML POPUP -->