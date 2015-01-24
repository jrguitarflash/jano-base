<!-- ESTILOS PARA EL MODULO DE PAGOS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- GESTIONADOR PARA EL MODULO DE PAGOS -->
<script type="text/javascript" src="js/gestionador8.js"></script>

<div class="box">
	<div class="heading">
		<h1>Reporte - Pagos</h1>
		<div class="buttons">
			<a class="button" href="#">
				<span class="expExcel">
					Exportar Excel
				</span>
			</a>
		</div>
	</div>
	<div class="content">
		<div class="secPagFilt">
			<div id="secPagFiltIn">
				<label id="lbl">Tipo de Pagos:</label>
				<select class="campo">
					<option></option>
					<option>Proveedores Exterior</option>
					<option>Proveedores Locales</option>
					<option>Seguros</option>
					<option>Prestamos Bancarios</option>
				</select>
				<label id="lbl">Fecha inicial:</label>
				<input class="campo">
				<label id="lbl">Fecha final:</label>
				<input class="campo">
			</div>
			<div id="secPagFiltIn">
				<label id="lbl">N° factura:</label>
				<input class="campo">
				<label id="lbl">Ruc:</label>
				<input class="campo">
				<label id="lbl"></label>
				<div class="campo">
					<input type="checkbox">Fecha
					<input type="checkbox">Factura
					<input type="checkbox">Ruc
				</div>
				<label id="lbl"></label>
				<input class="button campo" type="button" value="limpiar">
				<input class="button campo" type="button" value="buscar">
			</div>
			<div class="secPagFiltIn">
				<span class="secPagFiltInCamb">
					<table border="1" class="tbPagCamb">
						<tr>
							<td rowspan="2" class="fondDol">US$</td>
							<td>Compra</td>
							<td>Venta</td>
							<td rowspan="2">Fecha: 20/02/2014</td>
						</tr>
						<tr>
							<td>2.30</td>
							<td>2.30</td>
						</tr>
						<tr>
							<td rowspan="2" class="fondEur">EURO</td>
							<td>Compra</td>
							<td>Venta</td>
							<td rowspan="2">Fecha: 20/02/2014</td>
						</tr>
						<tr>
							<td>2.35</td>
							<td>2.35</td>
						</tr>
						<tr>
							<td colspan="4" align="center"><input type="button" class="button" value="Actualizar" onclick="getCambNewPopup();"></td>
						</tr>
					</table>
				</span>
			</div>
		</div>
		<div class="secPagOpci">
			<span id="secPagOpciMen">
				<a href="Javascript:getPagNewPopup();">Nuevo Pago</a>&nbsp;|
				<a href="">Anular Pagos</a>&nbsp;|
				<a href="">Efectuar Pagos</a>
			</span>
		</div>
		<div class="secPagConte">
			<table class="tabPag">
				<thead>
					<tr>
						<td></td>
						<td>FECHA</td>
						<td>N° FACTURA</td>
						<td>CLIENTE</td>
						<td>IMPORTE EN EUROS</td>
						<td>IMPORTE US$</td>
						<td>ACCION</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="center"><input type="checkbox"></td>
						<td>FECHA</td>
						<td>N° FACTURA</td>
						<td>CLIENTE</td>
						<td>IMPORTE EN EUROS</td>
						<td>IMPORTE US$</td>
						<td align="center">
							<a href="">Editar</a>
							<a href="">Eliminar</a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">SUBTOTAL</td>
						<td colspan="1" class="pagTotMon">TOTAL EUROS</td>
						<td colspan="1" class="pagTotMon">TOTAL US$</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>


<div id="dialog2" title="Actualizar Tipo de Cambio" class="popupRecla">
	<div id="">
		<div id="cambNu" ></div>
		<label id="lbl">Moneda</label>
		<select class="campo">
			<option>US$</option>
			<option>&euro;</option>
		</select>
		<label id="lbl">Compra:</label><input type="text" class="campo"  id="cambComp" value="" title="Formato de ejemplo #.##">
		<label id="lbl">Venta:</label><input type="text" class="campo" id="cambVent" value="">
		<label id="lbl" ></label>
		<input type="button"  class="campo button" value="Actualizar" onclick="">
		<input type="button"  class="campo button" value="Cancelar" onclick="outCambNewPopup();">
		<iframe src="" width="480px"  id="cambAct" ></iframe>
		<input type="hidden" id="fechActual" value="" >
	</div>
</div>


<div id="dialog3" title="Nueva Pago" class="popupRecla">
	<div id="cobranNu" ></div>
	<div id="">
		<label id="lbl">Pago:</label>
		<select class="campo" id="tipCobran">
			<option></option>
			<option>Proveedores Exterior</option>
			<option>Proveedores Locales</option>
			<option>Seguros</option>
			<option>Prestamos Bancarios</option>
        </select>
        <!--<label id="lbl" >Estado</label>
        <select class="campo" id="estAnul">
        	<option value="0" >Activo</option>
        	<option value="1" >Anulado</option>
        </select>-->
		<label id="lbl">Fecha Ingreso:</label><div class="campo"><input type="text" id="fechPagCob"></div>
		<label id="lbl">Fecha Vencimiento:</label><div class="campo"><input type="text" id="fechPagVenc"></div>
		<label id="lbl">N° de Documento:</label>
		<div class="campo">
			<input type="text" class="facPart1" id="facPart1" maxLength="4">-
			<input type="text" class="facPart2" id="facPart2" maxLength="6">
		</div>
		<label id="lbl">Empresa:</label>
		<div id="ajaxEmpNuevo" class="ui-widget campo">
			<select class="campo dataCli" id="combobox">
	        </select>
	        <img src="images/clean.png" width="25px" onclick="cleanEmp();" class="iconCamp">
	        <img src="images/add_reg.png" width="25px" onclick="getEmpPopup();" class="iconCamp">
        </div>
		<label id="lbl">Movimiento:</label><textarea class="campo"  id="movim" ></textarea>
		<label id="lbl">Moneda:</label>
		<select class="campo" id="mone">
			<option></option>
        </select>
		<label id="lbl">Importe:</label><input type="text" class="campo" id="impor">
		<label id="lbl">Retencion:</label><div class="campo" ><input type="text" id="reten" >&nbsp;%</div>
		<label id="lbl" ></label>
		<input type="button"  class="campo button" value="Guardar"  id="saveCobran" onclick="">
		<input type="button"  class="campo button" value="Cancelar" onclick="outPagNewPopup();">
	</div>
</div>