<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS -->
<script type="text/javascript" src="js/kd_gesti.js" ></script>

<!-- PHP UTILS -->

<!-- PHP CONTROLADOR DOWN-->

<!-- PHP CONTROLADOR UP -->

<!-- HTML ID -->
<input type="hidden" id="kd_id" value="0"  >

<!-- HTML MENU -->
<input type="hidden" id="viewMenu" value="<?php print $_GET['menu']; ?>" >

<!-- HTML BODY -->

<div class="box" >

	<div class="heading" >
		<h1>Filtro de series</h1>
	</div>
	<div class="content" >

		<label>N° Serie:</label>
		<!-- INPUT SERIE -->
			<input type="text" id="kd_numSeri" value="" >
			<input type="hidden" id="kd_numSeriId" value="" > 
		<!-- [*] -->

		<h3>Producto</h3>

		<!-- TABLE PRODUCTO -->
			<table class="list" >
				<thead>
					<tr>
						<td>Codigo</td>
						<td>Marca</td>
						<td>Nombre</td>
						<td>Descripcion</td>
						<td>Serie</td>
					</tr>
				</thead>
				<tbody id="kd_prodSeri_tab" >
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		<!-- [*] -->

		<h3>Historial de Serie</h3>

		<!-- TABLE HISTORIAL -->
			<table class="list" >
				<thead>
					<tr>
						<td>Codigo</td>
						<td>Movimiento</td>
						<td>Fecha</td>
						<td>Empresa</td>
						<td>EW</td>
						<td>Referencia</td>
						<td>Observacion</td>
						<td>Numero Serie</td>
					</tr>
				</thead>
				<tbody id="kd_histSeri_tab" >
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		<!-- [*] -->

	</div>

</div>

<!-- HTML POPUP -->