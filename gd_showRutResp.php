<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS -->
<script type="text/javascript" src="js/gd_gesti.js" ></script>

<!-- CONTROLLER DOWN -->

<!-- CONTROLLER UP -->

<!-- VIEW -->
<input type="hidden" id="gd_view" value="<?php print $_GET['menu']; ?>"  >

<div class="box" >

	<div class="heading" >

		<h1>Detalle Ruta Responsable</h1>

		<div class="buttons" >
			<a href="#" id="gd_backRutResp" >Volver Ruta</a>
		</div>

	</div> 

	<div class="content" >

		<fieldset>
			<legend>Datos de Ruta</legend>
			<label id="lbl2" >N° Ruta</label>
			<span class="campo" >---</span>
			<label id="lbl2" >Estado</label>
			<span class="campo" >----</span>
			<label id="lbl2" >Fecha:</label>
			<span class="campo" >------</span>
			<label id="lbl2" >Hora:</label>
			<span class="campo" >------</span>
			<label id="lbl2" >Responsable</label>
			<span class="campo" >-------</span>
		</fieldset>

		<fieldset>
			<legend>Mapa</legend>
			<iframe src="gd_mapResp.php" width="100%" height="920px" ></iframe>
		</fieldset>

	</div>

</div>