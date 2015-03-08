<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS -->
<script type="text/javascript" src="js/kd_gesti.js" ></script>

<!-- Controller down -->

<!-- Controller up -->

<div class="box" >
	<div class="heading" >
		<h1>Nuevo Movimiento</h1>
		<div class="buttons" >
			<!-- <a href="#">Guardar</a> -->
			<a href="#" id="kd_kardxPrin" >Principal</a>
		</div>
	</div>
	<div class="content" >

		<!-- Datos Generales de Movimiento -->
		<span class="kd_datGenMov" >DATOS GENERALES DE MOVIMIENTO</span>
		<label id="lbl2" >N°</label>
		<span class="campo" >--------</span>
		<a href="#" class="campo" id="kd_geneMov" >Generar</a>
		<label id="lbl2" >Movimiento:</label>
		<select class="campo" id="kd_tipMovGene">
			<option value="0" ></option>
			<option value="1" >Entrada</option>
			<option value="2" >Salida</option>
			<option value="3" >Interno</option>
		</select>
		<label id="lbl2" >Empresa:</label>
		<input type="text" class="campo" disabled >
		<label id="lbl2" >Fecha:</label>
		<input input="text" class="campo" disabled >
		<label id="lbl2" >Documento:</label>
		<input type="radio" class="campo" name="kd_doc" disabled >
		<span class="campo" >Boleta</span>
		<input type="radio" class="campo" name="kd_doc" disabled >
		<span class="campo" >Factura</span>
		<input type="radio" class="campo" name="kd_doc" disabled >
		<span class="campo" >Guia de Remision</span>
		<label id="lbl2" >N° Documento:</label>
		<input type="text" class="campo" size="3" disabled > <span class="campo" >-</span> <input type="text" class="campo" disabled >
		<label id="lbl2" >Descripcion:</label>
		<textarea class="campo" disabled ></textarea>
		<label id="lbl2" >Moneda:</label>
		<select class="campo" disabled >
			<option></option>
		</select>

		<!-- Detalle de Movimiento -->
		<span class="kd_detMov" >DETALLE DE MOVIMIENTO</span>
		<label id="lbl2" >Sub-Clasificacion:</label>
		<select class="campo" disabled >
			<option></option>
		</select>
		<label id="lbl2" >Categoria:</label>
		<select class="campo" disabled >
			<option></option>
		</select>
		<label id="lbl2" >Tipo:</label>
		<select class="campo" disabled >
			<option></option>
		</select>
		<label id="lbl2" >Marca-Modelo:</label>
		<select class="campo" disabled >
			<option></option>
		</select>
		<label id="kd_lblLineProd" ><strong>Linea de Productos</strong></label>
		<label id="lbl2" >Precio unitario:</label>
		<input type="text" class="campo" disabled >
		<label id="lbl2" >Cantidad:</label>
		<input type="number" class="campo" disabled >
		<label id="lbl2" ></label>
		<button class="campo" disabled >Agregar</button>

		<!-- LINEA DE PRODUCTOS -->
		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td>Codigo</td>
					<td>Sub-Clasificacion</td>
					<td>Categoria</td>
					<td>Tipo</td>
					<td>Modelo</td>
					<td>Marca</td>
					<td>Nombre Español</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="radio" name="kd_lineProd" disabled ></td>
					<td>COD</td>
					<td>Sub-Clasificacion</td>
					<td>Categoria</td>
					<td>Tipo</td>
					<td>Modelo</td>
					<td>Marca</td>
					<td>Nombre Español</td>
				</tr>
			</tbody>
			<!--<tfoot></tfoot>-->
		</table>

		<label id="kd_lblLineProd" ><strong>Detalle de Movimiento</strong></label>
		<table class="list" >
			<thead>
				<tr>
					<td>Item</td>
					<td>COD</td>
					<td>Sub-Clasificacion</td>
					<td>Categoria</td>
					<td>Tipo</td>
					<td>Modelo</td>
					<td>Marca</td>
					<td>Nombre Español</td>
					<td>Precio Unitario</td>
					<td>Cantidad</td>
					<td>Total</td>
					<td>Moneda</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Item</td>
					<td>COD</td>
					<td>Sub-Clasificacion</td>
					<td>Categoria</td>
					<td>Tipo</td>
					<td>Modelo</td>
					<td>Marca</td>
					<td>Nombre Español</td>
					<td>Precio Unitario</td>
					<td>Cantidad</td>
					<td>Total</td>
					<td>Moneda</td>
					<td><a href="#">Eliminar</a></td>
				</tr>
			</tbody>
			<!--<tfoot></tfoot>-->
		</table>

	</div>
</div> 