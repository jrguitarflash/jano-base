<!-- JS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>
<script type="text/javascript" src="js/np_gesti.js" ></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- CONTROLLER DOWN -->
<?php require 'clases/controlador/controladorInf.class.php'; ?>

<!-- CONTROLLER UP -->
<?php require 'clases/controlador/controladorSup.class.php'; ?>

<div class="box">

	<div class="heading" >

		<input type="hidden" id="np_view" value="np_listNot" >
		<h1 id="np_titView" ></h1>

		<div class="buttons" >
			<a href="#" id="np_nuevNot">Nuevo</a> <!-- Accion -->
		</div>

	</div>

	<div class="content" >

		<!-- filtro de estados de pedido -->
		<label id="lbl2" >Estados:</label>
		<select class="campo"  id="np_estaNot" >
			<?php foreach($dataEst as $data) { ?>
				<option value="<?php print $data['estaId']; ?>" >
					<?php print $data['desNot']; ?>
				</option>
			<?php } ?>
		</select>

		<!-- filtro de tipo de movimiento -->
		<label class="campo" >Tipo:</label>
		<select class="campo" name="np_tipMov" id="np_tipMov" >
			<?php foreach($dataTip as $data) { ?>
			<option value="<?php print $data['tipId']; ?>" ><?php print $data['tipDes']; ?></option>
			<?php } ?>
		</select>


		<table class="list" >
			<thead>
				<tr>
					<td align="center" >Item</td>
					<td align="center">Codigo</td>
					<td>Tipo</td>
					<td>Cliente</td>
					<td>Descripcion</td>
					<td>Referencia</td>
					<td>Observacion</td>
					<td>Fecha Creacion</td>
					<td>Fecha Programada</td>
					<td>Atencion</td>
					<td align="center">Estado</td>
					<td></td>
				</tr>
			</thead>
			<tbody id="np_lisNot" >
				<tr>
					<td align="center" >Item</td>
					<td align="center">Codigo</td>
					<td>Cliente</td>
					<td>Fecha</td>
					<td></td>
					<td></td>
					<td></td>
					<td align="center"></td>
					<td align="center">
						<a href="#">Detalle</a> <!-- Accion -->
						|
						<a href="#">Eliminar</a> <!-- Accion -->
					</td>
				</tr>
			</tbody>
		</table>

	</div>

</div>