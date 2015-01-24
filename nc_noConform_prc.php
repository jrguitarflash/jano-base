<!-- CSS -->
	
	<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->

	<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS Notifi -->

	<script type="text/javascript" src="libJquery/notifiJs/notifi-min.js" ></script>

<!-- JS -->

	<script  type="text/javascript" src="js/nc_gesti.js" ></script>

<!-- PHP UTILS -->

<!-- PHP CONTROLADOR DOWN -->
	
	<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- PHP CONTROLADOR UP -->

	<?php require("clases/controlador/controladorSup.class.php"); ?>

<!-- HTML VIEW -->

	<input type="hidden" id="nc_view" value="<?php print $_GET['menu']; ?>" >

<!-- HTML ID -->

	<input type="hidden" id="nc_id" value="<?php print $_GET['id']; ?>" >

<!-- HTML NOTIFI -->

	<span class="elem-gd" ></span>

<!-- HTML THEME  -->

<div class="box" >

		<div class="heading" >

			<h1>No Conformidad - Porcentaje</h1>

		</div>

		<div class="content" >

			<form name="nc_prcConfor_frm" id="nc_prcConfor_frm" >

			<label class="nc_pagConfom" >Fecha Inicial:</label>
			<!-- INPUT FECHA INICIAL -->
				<input type="text" class="nc_pagConfom_input" id="nc_fechIni" name="nc_fechIni" >
			<!-- [*] -->

			<label class="nc_pagConfom" >Fecha Final:</label>
			<!-- INPUT FECHA FINAL -->
				<input type="text" class="nc_pagConfom_input" id="nc_fechFin" name="nc_fechFin"  >
			<!-- [*] -->

			<!-- OUTPUT IFRAME PORCENTAJE -->
				<iframe src="" id="nc_prcConfor_iframe" name="nc_prcConfor_iframe" ></iframe>
			<!-- [*] -->

			</form>

		</div>

</div>

<!-- HTML POPUP -->

<!-- HTML IFRAME -->