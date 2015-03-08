<!-- JS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>
<script type="text/javascript" src="js/np_gesti.js" ></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- UTILS-->
<?php require 'utils_func.php'; ?>

<!-- CONTROLLER DOWN -->
<?php require 'clases/controlador/controladorInf.class.php'; ?>

<!-- CONTROLLER UP -->
<?php require 'clases/controlador/controladorSup.class.php'; ?>

<div class="box">

	<div class="heading" >

		<input type="hidden" id="np_view" value="np_nuevNot" >
		<h1 id="np_titView" ></h1>

		<div class="buttons" >
			<a href="#" id="np_acciNuevNot" >Guardar</a> <!-- Accion -->
			|
			<a href="#" id="np_listNot">Volver</a> <!-- Accion -->
		</div>

	</div>

	<div class="content" >

		<form name="frmNotNuev" >
			<h3>Datos Generales</h3>
			<input type="hidden" id="accion" name="accion" value="" >

			<!-- Tipo de movimiento -->
			<label id="lbl2" >Tipo Movimiento:</label>
			<select class="campo" name="np_tipMov" id="np_tipMov" >
				<?php foreach($dataTip as $data) { ?>
				<option value="<?php print $data['tipId']; ?>" ><?php print $data['tipDes']; ?></option>
				<?php } ?>
			</select>

			<label id="lbl2" >Empresa:</label>
			<input type="text" class="campo kd_campDina" id="np_cliDes" size="45" >
			<input type="hidden" class="campo" id="np_cliId" name="np_cliId" >

			<label id="lbl2" style="display:none" >Fecha:</label>
			<span class="campo" style="display:none" ><input type="text" id="np_fech" name="np_fech" ></span>

			<label id="lbl2" >Fecha atencion:</label>
			<span class="campo" ><input type="text" id="np_fechConfir" name="np_fechConfir" ></span>

			<label id="lbl2" >Hora atencion:</label>
			<input type="text" class="campo" name="np_hourConfir" id="np_hourConfir" value="<?php print $hourConfir; ?>">

			<label id="lbl2" >Destinatario:</label>
			<div class="campo np_destiNot" id="np_destiNot">
				<?php foreach($dataDesti as $data){ ?>
					<input type="checkbox" value="<?php print $data['email']; ?>" name="np_emailDesti[]" id="np_emailDesti" >
					<?php print $data['pers']."(".$data['email'].")"; ?>&nbsp;
					<a href="<?php print 'Javascript:np_mailPer_pop('.$data['perId'].')' ?>">editar</a><br>
				<?php } ?>
			</div>

			<label id="lbl2" >Descripcion:</label>
			<textarea class="campo" id="np_des" name="np_des" ></textarea>
			<label id="lbl2" >Referencia:</label>
			<input type="text" class="campo" id="np_ref" name="np_ref" >
			<label id="lbl2" >Observacion:</label>
			<textarea class="campo" id="np_obs" name="np_obs" ></textarea>
		</form>

		<h3 id="lbl2" >Detalle</h3>
		<a href="#" class="campo" id="np_popLine" >Agregar</a> <!-- Accion -->


		<table class="list" >
			<thead>
				<tr>
					<td>Item</td>
					<td>Codigo</td>
					<td>Marca</td>
					<td>Nombre Español</td>
					<td>Descripcion</td>
					<td>Cantidad</td>
					<td></td>
				</tr>
			</thead>
			<tbody  id="np_detNot" >
				<tr>
					<td>Item</td>
					<td>Codigo</td>
					<td>Marca</td>
					<td>Nombre Español</td>
					<td>Descripcion</td>
					<td>Cantidad</td>
					<td align="center" >
						<a href="#">Eliminar</a> <!-- Accion -->
					</td>
				</tr>
			</tbody>
		</table>

	</div>

</div>

<!-- UI [np_lineProd] -->

<div id="np_lineProd" title="Linea de Productos">

		<fieldset class="kd_filProd2" >
			<legend>Busqueda de productos por descripcion</legend>
			<!-- SEARCH -->
			<div class="lp_busProd" >
				<input type="text" placeholder="BUSQUEDA POR SUB-CLASIFICACION,CATEGORIA,MARCA" class="lp_txtBusq" id="lp_txtBusq" >
			</div>
			<label id="lbl2" >Cantidad:</label>
			<input class="campo" type="text" id="np_cantProd" > 
			<label id="lbl2" ></label>
			<button class="campo" id="np_agreLine" >Agregar</button>
		</fieldset>

		<!-- LINEA DE PRODUCTOS -->
		<form name="frmLineProd" id="frmLineProd" >
			<input type="radio" name="kd_lineId" id="kd_lineId" style="display:none" value="-1" >
			<table class="list" >
				<thead>
					<tr>
						<td></td>
						<td>Codigo</td>
						<td>Sub-Clasificacion</td>
						<td>Categoria</td>
						<td>Marca</td>
						<td>Nombre Español</td>
						<td>Nombre Ingles</td>
						<td>Descripcion</td>
						<td>Stock Actual</td>
						<td>Ubicacion</td>
					</tr>
				</thead>
				<tbody id="kd_lineProd_ajax" >
					<!--<tr>
						<td><input type="radio" name="kd_lineProd" ></td>
						<td>COD</td>
						<td>Sub-Clasificacion</td>
						<td>Categoria</td>
						<td>Tipo</td>
						<td>Modelo</td>
						<td>Marca</td>
						<td>Nombre Español</td>
						<td>Stock Actual</td>
					</tr>-->
				</tbody>
				<!--<tfoot></tfoot>-->
			</table>
		</form>

</div>

<!-- UI [np_mailPer_pop] -->
<div id="np_mailPer_pop" title="Editar Email de Trabajador" >
	<input type="hidden" id="np_perId" >
	<label id="lbl2" >Destinatario:</label>
	<span class="campo" id="np_nomPer">xxxxxx</span>
	<label id="lbl2" >Email:</label>
	<input type="email" class="campo" id="np_emailPer" size="35">
	<label id="lbl2" ></label>
	<button class="campo" id="np_acciActuEmail">Actualizar</button>
</div>