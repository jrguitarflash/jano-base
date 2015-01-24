<?php
	echo "<span style='display:none' >Aqui se creara el modulo de reportes de cobranzas............... \m/ !</span>";
?>

<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!-- //------JQUERY TABS AÑADIDOS--------------// -->
<link rel="stylesheet" type="text/css" href="libJquery/tabs/jquery-ui.css" />
<script type="text/javascript" src="libJquery/tabs/jquery-ui.js"></script>

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador7.js"></script>

<div class="box">
	<div class="heading" >
			<h1>
				Cobranzas - Nuevo:
				<span>COB-00001</span>
			</h1>
			<div class="buttons">
				<a href="index.php?menu_id=117&menu=reporte_xcobrar_lista" ><img src="images/home2.png" width='18px'></a>
			</div>	
	</div>
	<div class="content" >
			<form>
				<div id="tabs">
				<ul>
				<li><a href="#tabs-1">Nueva Cobranza</a></li>
				<li><a href="#tabs-2">Asignacion de Facturas</a></li>
				<li><a href="#tabs-3">Asignacion de Chekes</a></li>
				<li><a href="#tabs-4">Asignacion de Ticket</a></li>
				</ul>
				<div id="tabs-1">
					<!--  DATOS GENERALES DE COBRANZA -->
					<span class="datGene">
						<h3 id="campSec">Datos Generales de Cobranza</h3>
						<div class="campSecButton" >
							<a href="#"><img src="images/grabar.png" title="Guardar cobranza" width="18px"></a>
						</div>
					</span>
					<div class="cobPane1" >
						<label id="lbl">Cobranza:</label>
						<span class="campo correNeg">COB-00001</span>
						<hr class="lineForm" >
						<label id="lbl" >Cliente:</label>
						<div class="campo" ><input ><img src="images/add_reg.png"></div>
						<hr class="lineForm" >
						<label id="lbl" >Tipo Cobranza:</label>
						<select class="campo" >
							<option></option>
							<option>Contra-entrega</option>
							<option>Cheke</option>
							<option>Ticket</option>
							<option>OC</option>
							<option>EW</option>
							<option>Guia de remision</option>
						</select>
						<hr class="lineForm" >
						<label id="lbl" >N° referencia:</label>
						<input class="campo" >
						<hr class="lineForm" >
						<label id="lbl" >Moneda:</label>
						<select class="campo" >
							<option></option>
							<option>S/.</option>
							<option>$.</option>
							<option>&euro;.</option>	
						</select>
					</div>
					<div class="cobPane2" >
						<label id="lbl" >Monto:</label>
						<input class="campo" >
						<hr class="lineForm" >
						<label id="lbl" >Fecha:</label>
						<input class="campo" >
						<hr class="lineForm" >
						<label id="lbl" >Descripcion:</label>
						<textarea class="campo" ></textarea>
					</div>
				</div>
				<div id="tabs-2">
					<!--  ASIGNACION DE FACTURAS -->

					<span class="datGene">
						<h3 id="campSec" >Asignacion de Facturas:</h3>
						<div class="campSecButton" >
							<a href="Javascript:nuevaFactura();"><img src="images/add.png" title="Agregar factura" width="18px" ></a>
							<a href="#"><img src="images/crono.png" title="Dar plazo" width="18px" ></a>
						</div>
					</span>

					<table class="list asigFact" >
						<thead>
							<tr>
								<td></td>
								<td>N° factura</td>
								<td>Descripcion</td>
								<td>Total</td>
								<td align="center">Accion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="center"><input type="checkbox" ></td>
								<td>0001-12345</td>
								<td>Venta de equipos</td>
								<td>20000</td>
								<td align="center">
									<a href="#"><img src="images/detail.png" title="Ver detalle" width="18px"></a>
									<a href="#"><img src="images/b_edit.png" title="Editar factura" width="18px" ></a>
									<a href="#"><img src="images/b_drop.png" title="Eliminar factura" width="18px" ></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="tabs-3">
					<!--  ASIGNACION DE CHEKE -->

					<span class="datGene">
						<h3 id="campSec">Asignacion de Cheke</h3>
						<div class="campSecButton" >
							<a href="#"><img src="images/add.png" title="Agregar cheke" width="18px"></a>
							<a href="#"><img src="images/confor.png" title="Dar conformidad" width="18px"></a>
						</div>
					</span>

					<table class="list asigFact" >
						<thead>
							<tr>
								<td></td>
								<td>N° cheke</td>
								<td>Descripcion</td>
								<td>Total</td>
								<td align="center">Accion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="center"><input type="checkbox" ></td>
								<td>0001-12345</td>
								<td>Venta de equipos</td>
								<td>20000</td>
								<td align="center">
									<a href="#"><img src="images/detail.png" title="ver detalle" width="18px"></a>
									<a href="#"><img src="images/b_edit.png" title="Editar factura" width="18px" ></a>
									<a href="#"><img src="images/b_drop.png" title="Eliminar factura" width="18px" ></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="tabs-4">
					<!--  ASIGNACION DE TICKET -->

					<span class="datGene">
						<h3 id="campSec">Asignacion de Ticket</h3>
						<div class="campSecButton" >
							<a href="#"><img src="images/add.png" title="Agregar ticket" width="18px"></a>
							<a href="#"><img src="images/confor.png" title="Dar conformidad" width="18px"></a>
						</div>
					</span>

					<table class="list asigFact" >
						<thead>
							<tr>
								<td></td>
								<td>N° ticket</td>
								<td>Descripcion</td>
								<td>Total</td>
								<td align="center">Accion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="center"><input type="checkbox" ></td>
								<td>0001-12345</td>
								<td>Venta de equipos</td>
								<td>20000</td>
								<td align="center">
									<a href="#"><img src="images/detail.png" title="ver detalle" width="18px"></a>
									<a href="#"><img src="images/b_edit.png" title="Editar factura" width="18px" ></a>
									<a href="#"><img src="images/b_drop.png" title="Eliminar factura" width="18px" ></a>
								</td>
							</tr>
						</tbody>
					</table>
			</div>
			</div>
			</form>
	</div>
</div>

<!-- FORMULARIO NUEVA FACTURA -->

<div id="dialog1" title="Nueva Factura" class="popupRecla">
	<div id="">
		<span class="datGene">
			<h3 id="campSec">Datos factura</h3>
		</span>
		<label id="lbl">N° factura:</label>
		<input class="campo">
		<label id="lbl">Fecha:</label>
		<input class="campo">
		<span class="datGene">
			<h3 id="campSec">Detalle factura</h3>
		</span>
		<label id="lbl">Descripcion</label>
		<textarea class="campo"></textarea>
		<label id="lbl">Cantidad:</label>
		<input class="campo">
		<label id="lbl">Precio Unit.</label>
		<input class="campo">
		<table class="list asigFact">
			<thead>
				<tr>
					<td>Item</td>
					<td>Descripcion</td>
					<td>Cant.</td>
					<td>P.U</td>
					<td>Monto</td>
					<td>Accion</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Item</td>
					<td>Descripcion</td>
					<td>Cant.</td>
					<td>P.U</td>
					<td>Monto</td>
					<td><a href="#" id="acciDetFac">Eliminar</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>




