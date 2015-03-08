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
		
		<h1>Formulario Operaciones Bancarias</h1>
		<div class="buttons" >
			<a href="#" id="finan_saveOpe" >Guardar</a>
			<a href="#" id="finan_closeOpe" >Cerrar</a>
			<a href="#" id="finan_opeVol" >volver</a>
		</div>
	
	</div>

	<div class="content" >

		<div id="tabs" >
				
				<ul>
					<li><a href="#tabs-1">Proyecto</a></li>
					<li><a href="#tabs-2">Operaciones bancarias</a></li>
					<li><a href="#tabs-3">Adjuntos</a></li>
				</ul>

				<div id="tabs-1" >

					<label id="lbl" >N° Operacion:</label>

					<span class="campo" id="finan_numOpe" >----</span>

					<label id="lbl" >Estado</label>

					<span class="campo" id="finan_estaImg" >----</span>

					<label id="lbl" >CC:</label>

					<input type="text" class="campo" id="nc_ccDes" >
					<input type="hidden" value="" id="nc_ccId" >

					<label id="lbl" >Proyecto:</label>

					<span class="campo" id="finan_proye" >----</span>

					<label id="lbl" >Responsable:</label>

					<span class="campo" id="finan_respo" >-----</span>

					<label id="lbl" >Cliente:</label>

					<span class="campo" id="finan_cli" >----</span>

					<label id="lbl" >Moneda</label>

					<span class="campo" id="finan_mone" >----</span>

					<label id="lbl" >Monto</label>

					<span class="campo" id="finan_mont" >----</span>

					<label id="lbl" >Fecha de recepcion</label>

					<span class="campo" id="finan_fech" >----</span>

				</div>
				
				<div id="tabs-2" >

					<form name="frmAsigPro" id="frmAsigPro" >

					<!-- *********************************** -->	
					<!-- MODULO FINANCIERO & CENTRO DE COSTO -->
					<!-- *********************************** -->

					<?php print $opeBanca; ?>

					<!-- ********************************** -->

					</form>

				</div>
				
				<div id="tabs-3" >

					<form id="finan_frmAdju" name="finan_frmAdju" enctype="multipart/form-data" >

						<input name="finan_opeId_adju" type="hidden" value="" />
						<input name="finan_iframe_peti" type="hidden" value="" />

						<label id="lbl" >N° Doc.</label>

						<input type="text" class="campo" name="finan_numDoc" >

						<label id="lbl" >Descripcion</label>

						<textarea class="campo" name="finan_des" ></textarea>

						<label id="lbl" >Adjuntar</label>

						<input type="file" name="finan_adjuFile" class="campo" >

						<label id="lbl" ></label>

						<button class="campo" id="finan_adjuOpe" >Adjuntar</button>

					</form>

					<table class="list" >
						
						<thead>
						
							<tr>
								<td>Item</td>
								<td>N° Doc.</td>
								<td>Descripcion</td>
								<td>Adjunto</td>
								<td>Accion</td>
							</tr>
						
						</thead>

						<tbody id="finan_adjuTab" >

							<tr>
								<td>Item</td>
								<td>N° Doc.</td>
								<td>Descripcion</td>
								<td>Adjunto</td>
								<td>Accion</td>
							</tr>

						</tbody>

					</table>

				</div>

		</div>


	</div>

</div>

<!-- HTML POPUP -->

<!-- HTML IFRAME -->

<iframe src="" name="finan_iframe" id="finan_iframe"  style="display:none" ></iframe>