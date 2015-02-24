<!-- JS GESTI -->
<script type="text/javascript" src="js/nc_gesti.js" ></script>

<!-- CSS STYLE -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- HTML VIEW -->
<input type="hidden" id="nc_view" value="<?php print $_GET['menu']; ?>" >

<!-- HTML BODY -->

<div class="box" >

	<div class="heading" >
		<h1>Grafico de Observaciones</h1>
	</div>

	<div class="content" >

		<form name="nc_frmGrafic" id="nc_frmGrafic" action="nc_grafIframe.php" method="post" target="nc_grafIframe" >

			<label>Fecha inicial:</label>
			<input id="nc_fechIni" name="nc_fechIni" >
			<label>Fecha Final:</label>
			<input id="nc_fechFin" name="nc_fechFin" >
			<label>Tipo:</label>
			<select id="nc_TipPorce" name="nc_TipPorce" >
				<option value="1" >Observacion</option>
				<option value="2" >Tipo no conformidad</option>
				<option value="3" >Post-Venta</option>
				<option value="4" >Deteccion</option>
				<option value="5" >Proceso afectado</option>
				<option value="6" >Tipo de observacion</option>
				<option value="7" >Estado no conformidad</option>
			</select>
			<input type="submit" value="Generar" >

		</form>

		<iframe src="nc_grafIframe.php" id="nc_grafIframe" name="nc_grafIframe" ></iframe>

	</div>

</div>

<!-- HTML POPUP -->