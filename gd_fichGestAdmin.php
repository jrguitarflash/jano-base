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
<input type="hidden" id="gd_idGestOcul" value="<?php print $_GET['id']; ?>" >

<div class="box" >

	<div class="heading" >

		<h1>Ficha de Gestiones Admin</h1>
		<div class="buttons" >
			<a href="#" id="gd_acciSaveGest" >Guardar Gestion</a>
			&nbsp;|&nbsp;
			<a href="#" id="gd_lnkVolGestAdm" >Volver Gestion</a>
		</div>

	</div>

	<div class="content" >

		<!-- Instacia de Notificaciones -->
		<div class="elem-gd" ></div>

		<!-- Ficha de Gestiones documentarias -->
		<label id="lbl2" >N° Gestion</label>
		<span class="campo" id="gd_numGest" >-----</span>

		<label id="lbl2" >Usuario:</label>
		<span class="campo" id="gd_usuDes" >----</span>

		<label id="lbl2" >Estado:</label>
		<select class="campo" id="gd_estaGest" >
			<option></option>
			<?php foreach($dataEstaGest as $data){ ?>
			<option value="<?php print $data['gd_estaGest']; ?>" ><?php print $data['gd_desEsta']; ?></option>
			<?php } ?>
		</select>
		
		<label id="lbl2" >Documentos:</label>
		<textarea class="campo"  id="gd_doc" ></textarea>

		<label id="lbl2" >Gestion:</label>
		<textarea class="campo" id="gd_gest" ></textarea>

		<label id="lbl2" >Fecha:</label>
		<span class="campo" ><input type="text"  id="gd_fechGest" ></span>

		<label id="lbl2" >Hora</label>
		<select class="campo" id="gd_hour" >
			<option></option>
			<?php foreach($dataHora as $data) { ?>
				<option value="<?php print $data['hourId']; ?>" ><?php print $data['hourDes']; ?></option>
			<?php } ?>
		</select>

		<label id="lbl2" >Lugar</label>
		<textarea class="campo" id="gd_lug" ></textarea>

	</div>

</div>