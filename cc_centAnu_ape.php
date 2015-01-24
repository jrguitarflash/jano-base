<!-- JS UTILS -->

	<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS NOTIFI -->

	<script type="text/javascript" src="libJquery/notifiJs/notifi-min.js" ></script>

<!-- JS GESTIONADOR -->

	<script type="text/javascript" src="js/cc_gesti.js?modojs=4" id="modojs" ></script>

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
			<h1>Apertura de Centro Anual</h1>
			<div class="buttons" >
				<a href="#" id="cc_saveApeCent_acci" >Guardar</a>
			</div>
		</div>
		<div class="content" >

			<label id="lbl" >CC:</label>
			<!-- INPUT CC -->
				<input type="text" class="campo" id="cc_nro" >
			<!-- [*] -->
			<!-- INPUT PERIODO -->
				<select class="campo" id="cc_peri" >
					<?php foreach($dataAnu as $data) { ?>
					<option value="<?php print $data['anuId']; ?>" ><?php print $data['anuDes']; ?></option>
					<?php } ?>
				</select>
			<!-- [*] -->

			<label id='lbl' >Empresa</label>
			<!-- OUTPUT EMPRESA -->
				<span class='campo' ><strong><?php print $emp; ?></strong></span>
			<!-- [*] -->
			
			<label id="lbl" >Descripción:</label>
			<!-- INPUT DESCRIPCION -->
				<textarea class="campo" id="cc_des" ></textarea>
			<!-- [*] -->

			<label id="lbl" >Alias:</label>
			<!-- INPUT ALIAS -->
				<input type="text"  class="campo" id="cc_ali" >
			<!-- [*] -->
			<span class="campo" ><strong>Ejemplo:</strong>&nbsp;ALMACEN-2010</span>
			
			<label id="lbl" >Fecha de apertura:</label>
			<!-- INPUT FECHA APERTURA-->
				<span class="campo" >	
					<input type="text" id="cc_fechApe" >
				</span>
			<!-- [*] -->


		</div>
	</div>

<!-- HTML POPUP -->