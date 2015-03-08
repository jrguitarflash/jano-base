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

<!-- HTML THEME -->

	<div class="box" >

		<div class="heading" >

			<h1>Observación - Listado</h1>

		</div>

		<div class="content" >

			<label class="nc_pagConfom" >Fecha:</label>

			<!-- INPUT FECHA RECEPCION -->
				<span class="nc_pagConfom_input" >
					<input type="text"  id="nc_fechRecep" >
				</span>
			<!-- [*] -->

			<label class="nc_pagConfom" >Estado:</label>
			
			<!-- INPUT ESTADO CONFORMIDAD -->
				<select class="nc_pagConfom_input" id="nc_estaConfor" >
					<option value="0" >todos</option>
					<?php foreach($dataEstaConfor as $data){ ?>
					<option value="<?php print $data['nc_estaConforVal']; ?>" ><?php print $data['nc_estaConforDes']; ?></option>
					<?php } ?>
				</select>
			<!-- [*] -->

			<label class="nc_pagConfom" >Observacion:</label>

			<!-- INPUT OBSERVACION -->
				<select class="nc_pagConfom_input" id="nc_obsLst" >
					<option value="0" >todos</option>
					<?php foreach($dataObs as $data) { ?>
					<option value="<?php print $data['nc_obsId']; ?>" ><?php print $data['nc_obsDes']; ?></option>
					<?php } ?>
				</select>
			<!-- [*] -->

			<label class="nc_pagConfom" >Origen:</label>

			<!-- INPUT ORIGEN -->
				<select class="nc_pagConfom_input" id="nc_oriObs" >
					<?php foreach($dataOri as $data){ ?>
						<option value="<?php print $data['oriId']; ?>" ><?php print $data['oriDes']; ?></option>
					<?php } ?>
				</select>
			<!-- [*] -->

			<a href="#" class="nc_pagConfom" id="nc_nuevConfor_lnk" >Nuevo</a>

			<a href="#" class="nc_pagConfom" id="nc_exporConfor_lnk" >Exportar</a>

			<!-- TABLE NO CONFORMIDAD -->
				<table class="list" >
					<thead>
						<tr>
							<td></td>
							<td>N°</td>
							<td>Descripcion</td>
							<td>Fecha</td>
							<td>Estado</td>
							<td>Observacion</td>
							<td>Origen</td>
							<td align="center" >Accion</td>
						</tr>
					</thead>

					<tbody id="nc_noConfor_tab" >
						<tr>
							<td align="center" ><input type="checkbox" ></td>
							<td>---</td>
							<td>---</td>
							<td>---</td>
							<td>---</td>
							<td align="center" >
								<a href="#">Editar</a>&nbsp;|&nbsp;
								<a href="#">Eliminar</a>
							</td>
						</tr>
					</tbody>
				</table>
			<!-- [*] -->

			<label class="nc_pagConfom" >Pagina</label>
			<select class="nc_pagConfom_input"  id="nc_pagEle" ></select>
			<label class="nc_pagConfom" >de</label>
			<span class="nc_pagConfom_input" id="nc_totPag" >---</span>

		</div>
	</div>

<!-- HTML POPUP -->

