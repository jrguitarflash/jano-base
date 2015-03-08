<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS -->
<script type="text/javascript" src="js/utils_gesti.js" ></script>
<script type="text/javascript" src="js/kd_gesti.js" ></script>

<!-- Controller down -->
<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- Controller up -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<div class="box" >
	<div class="heading" >
		<h1>Nuevo Movimiento</h1>
		<div class="buttons" >
			<a href="#" id="kd_saveMov" >Guardar</a>|
			<a href="#" id="kd_kardxPrin" >Volver</a>
		</div>
	</div>
	<div class="content" >

		<!-- Datos Generales de Movimiento -->
		<form name="frmGenMov" id="frmGenMov" >
			<span class="kd_datGenMov" >DATOS GENERALES DE MOVIMIENTO</span>
			<input type="hidden" id="viewMenu" value="kd_geneKardx" >
			<label id="lbl2" >N°</label>
			<span class="campo" ><?php print $correMov; ?></span>
			<input type="hidden" value="<?php print $_GET['id'];  ?>" id="kd_kdxId" >
			<!--<a href="#" class="campo" >Generar</a>-->
			<label id="lbl2" >Movimiento:</label>
			<select class="campo" id="kd_tipMov" disabled>
				<?php foreach($dataTipMov as $data) { ?>
				<?php if($data['id']==3) { ?>
					<option value="<?php print $data['id']; ?>" selected><?php print $data['des']; ?></option>
					<?php } else{?>
					<option value="<?php print $data['id']; ?>" ><?php print $data['des']; ?></option>
				<?php }} ?>
			</select>

			<!-- input EW -->
			<label id="lbl2" >EW:</label>
			<input class="campo" id="kd_ewComp" type="text" >
			<input class="campo" id="kd_ewCompId" type="hidden" >

			<label id='lbl2' >Almacen:</label>
			<select class='campo' id="kd_almEmp" ></select>

			<label id="lbl2" >Empresa:</label>
			<input type="text" class="campo kd_campDina"  id="kd_empDes" size="45" value="ELECTROWERKE S.A." disabled>
			<input type="hidden" id="kd_empId" value="309">

			<!-- Transportista -->
			<label id="lbl2" >Empresa Transportista:</label>
			<input type="text" class="campo kd_campDina" id="kd_transDes" size="45">
			<input type="hidden" class="campo" id="kd_transId" >
			<a class="campo" id="kd_nuevTrans" >Nuevo</a>

			<!-- Destino -->
			<label id="lbl2" style="display:none">Destino:</label>
			<textarea class="campo kd_oculCamp" id="kd_desti" ></textarea>


			<label id="lbl2" >Fecha:</label>
			<span class="campo" ><input input="text" id="kd_fechMov" ></span>
			<label id="lbl2" >Documento:</label>

			<!--
			<input type="radio" class="campo" name="kd_doc" id="kd_doc" value="1" >
			<span class="campo" >Boleta</span>
			<input type="radio" class="campo" name="kd_doc" id="kd_doc"  value="2" >
			<span class="campo" >Factura</span>
			-->

			<input type="radio" class="campo" name="kd_doc" id="kd_doc" value="1" style="display:none" >
			<input type="radio" class="campo" name="kd_doc" id="kd_doc" value="2" checked>
			<span class="campo" >Guia Remision Transportista</span>
			<input type="radio" class="campo kd_oculCamp" name="kd_doc" id="kd_doc" value="3" >
			<span class="campo kd_oculCamp" id="kd_lblDua" >Dua</span>

			<label id="lbl2" >N° Documento:</label>
			<input type="text" class="campo" size="3" id="kd_numDoc1" > <span class="campo" >-</span> <input type="text" class="campo" id="kd_numDoc2">
			<label id="lbl2" class="kd_oculCamp" >Moneda:</label>
			<select class="campo kd_oculCamp" id="kd_moneId">
				<?php foreach($dataMone as $data) { ?>
				<option value="<?php print $data['monId']; ?>" ><?php print $data['monSig'];  ?></option>
				<?php } ?>
			</select>

			<!-- observacion -->
			<label id="lbl2" class="" >Observacion:</label>
			<textarea class="campo" id="kd_desMov" ></textarea>

		</form>

		<!-- Datos de Factura -->

		<div style="display:none" >
		<span class="kd_detMov" >DATOS DE FACTURA</span>
		<label id="lbl2" >N° de factura</label>
		<input type="text" class="campo" size="3" id="kd_facIni" > <span class="campo" >-</span> <input type="text" class="campo" id="kd_facFin">
		<label id="lbl2" >Fecha de Emision</label>
		<span class="campo" ><input type="text" id="kd_FacEmis" ></span>
		</div>


		<!-- Detalle de Movimiento -->
		
		<span class="kd_detMov" >DETALLE DE MOVIMIENTO</span>
		
		<fieldset class="kd_filProd1" >
			<legend>Busqueda de productos por filtro:</legend>
			<label id="lbl2" >Sub-Clasificacion:</label>
			<select class="campo" id="kd_subClasi" >
				<option selected ></option>
				<?php foreach($dataSubClasi as $data) { ?>
				<option value="<?php print $data['subClasiId']; ?>" ><?php print $data['subClasi']; ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" >Categoria:</label>
			<select class="campo" id="kd_catProd" >
				<option></option>
			</select>

			<!--
			<label id="lbl2" >Tipo:</label>
			<select class="campo" id="kd_tipProd" >
				<option></option>
			</select>
			-->

			<!--
			<label id="lbl2" >Marca-Modelo:</label>
			<select class="campo" id="kd_marMod" >
				<option></option>
			</select>
			-->

			<label id="lbl2" >Marca:</label>
			<select class="campo" id="kd_mar" >
				<option></option>
			</select>

			<!--
			<label id="lbl2" >Modelo:</label>
			<select class="campo" id="kd_mod" >
				<option></option>
			</select>
			-->

		</fieldset>

		<fieldset class="kd_filProd2" >
			<legend>Busqueda de productos por descripcion</legend>
			<!-- SEARCH -->
			<div class="lp_busProd" >
				<input type="text" placeholder="BUSQUEDA POR SUB-CLASIFICACION,CATEGORIA,MARCA" class="lp_txtBusq" id="lp_txtBusq" >
			</div>
		</fieldset>

		<fieldset class="kd_filProd2" >
		<legend>Nota de pedido</legend>
		<!-- SEARCH -->
		<div class="lp_busProd" >
			<select id="kd_notPed"  >
				<option></option>
				<?php foreach($dataNot as $data) { ?>
				<option value="<?php print $data['notId']; ?>" ><?php print $data['correNot'];  ?></option>
				<?php } ?>
			</select>
			<a id="kd_confirAten" >Confimar atencion</a>
			<a id="kd_showNot" >Ver Nota</a>
		</div>
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
						<td>Stock Solicitado</td>
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

		<label id="kd_lblLineProd" ><strong>Linea de Productos</strong></label>
		<label id="lbl2" class="kd_oculCamp" >Precio unitario:</label>
		<input type="text" class="campo kd_oculCamp"  id="kd_preUni" >
		<label id="lbl2" >Cantidad:</label>
		<input type="number" class="campo" id="kd_cant" >
		<label id="lbl2" ></label>
		<button class="campo" id="kd_agreDet" style="display:none" >Agregar</button>
		<button class="campo" id="kd_agreDet2" >Agregar</button>

		<label id="kd_lblLineProd" ><strong>Detalle de Movimiento</strong></label>
		<table class="list" >
			<thead>
				<tr>
					<td>Item</td>
					<td>COD</td>
					<td>Sub-Clasificacion</td>
					<td>Categoria</td>
					<td>Marca</td>
					<td>Nombre Español</td>
					<td>Nombre Ingles</td>
					<td>Descripcion</td>
					<td>Cantidad</td>
					<td>N° Serie</td>
					<td>Ubicacion</td>
					<td>Observacion</td>
					<td></td>
				</tr>
			</thead>
			<tbody id="kd_detKardx_ajax" >
				<tr>
					<td>Item</td>
					<td>COD</td>
					<td>Sub-Clasificacion</td>
					<td>Categoria</td>
					<td>Marca</td>
					<td>Nombre Español</td>
					<td>Nombre Ingles</td>
					<td>Descripcion</td>
					<td>Cantidad</td>
					<td>N° Serie</td>
					<td></td>
					<td><a href="#">Eliminar</a></td>
				</tr>
			</tbody>
			<!--<tfoot></tfoot>-->
		</table>


	</div>
</div>

	<!-- N° de Serie -->
	<div id="kd_numSeriPopup" title="Numero de Serie" >
		<input type="hidden" id="kd_detMovId" >
		<label id="lbl2" >N° de Serie:</label>
		<input type="text" id="kd_numSeri" class="campo" >
		<label id="lbl2" >Descripcion:</label>
		<textarea class="campo" id="kd_desSeri" ></textarea>
		<!-- <span class="campo" > |&nbsp;<a id="kd_acciNuevSeri" >Nuevo</a></span>-->
		<label id="lbl2" ></label>
		<span class="campo kd_msjConfir" id="msjNuevSeri" >Mensaje de confirmacion</span>
		<label id="lbl2" ></label>
		<button class="campo" id="kd_sbmtNuevSeri">Añadir</button>
		<table class="list" >
			<thead>
				<tr>
					<td>Item</td>
					<td>N° Serie</td>
					<td>Descripcion</td>
					<td></td>
				</tr>
			</thead>
			<tbody id="kd_seriMov_mos" >
				<tr>
					<td>Item</td>
					<td>N° Serie</td>
					<td>Descripcion</td>
					<td align="center" >
						<a href="#">Eliminar</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<!-- [kd_nuevNumSeri] -->
	<div id="kd_nuevNumSeri" title="Nuevo N° de serie" >
		<label id="lbl2" >N° de serie</label>
		<input type="text" >
		<label id="lbl2" >Descripcion</label>
		<textarea></textarea>
		<button id="lbl2" >Añadir</button>
	</div>

	<!-- [kd_seriStock] -->
	<div id="kd_seriStock" title="N° Serie en Stock" >

		<!-- En Stock -->
		<label id="kd_lblSeriStock" >
			<strong>N° de serie en Stock</strong>
		</label>
		<form name="kd_frmStock" class="kd_frmStock">
		<input type="checkbox" name='checkSeriId[]' id='checkSeriId' style="display:none" >
		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td>Item</td>
					<td>N° serie</td>
					<td>Descripcion</td>
				</tr>
			</thead>
			<tbody id="kd_numSeri_mos" >
				<tr>
					<td><input type="checkbox" ></td>
					<td>Item</td>
					<td>N° sserie</td>
					<td>Descripcion</td>
				</tr>
			</tbody>
		</table>
		</form>
		<label id="lbl2" ></label>
		<span class="campo kd_msjConfir" id="msjStock" >Mensaje de confirmacion</span>
		<label id="lbl2" ></label>
		<button class="campo" id="kd_smbtAddMov" >Añadir a movimiento</button>

		<!-- Elegidos de stock -->
		<label id="kd_lblSeriStock" >
			<strong>N° de serie Elegidos</strong>
		</label>
		<form name="kd_frmRegre" class="kd_frmRegre">
		<input type="checkbox" name='checkRegreId[]' id='checkRegreId' style="display:none" >
		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td>Item</td>
					<td>N° sserie</td>
					<td>Descripcion</td>
				</tr>
			</thead>
			<tbody id="kd_seriMov_mos2" >
				<tr>
					<td><input type="checkbox" ></td>
					<td>Item</td>
					<td>N° sserie</td>
					<td>Descripcion</td>
				</tr>
			</tbody>
		</table>
		</form>
		<label id="lbl2" ></label>
		<span class="campo kd_msjConfir" id="msjRegre" >Mensaje de confirmacion</span>
		<label id="lbl2" ></label>
		<button class="campo" id="smbtRegre">Regresar a stock</button>

	</div>

	<!-- Numero de serie dinamico [kd_numSeriDina] -->
	
	<div id="kd_numSeriDina" title="Numero de series" >

		<div id="kd_numSeriDinaIn" ></div>
		<label id='lbl2' ></label><button class='campo' id='kd_sbmtItem' >Confirmar</button>
		<label id="lbl2" ></label>
		<span class="campo kd_msjConfir" id="msjConfSeri" >Mensaje de confirmacion</span>
	
	</div>

	<!-- Numero de serie dinamico [kd_numSeriStock] -->

	<div id="kd_numSeriStock" title="Series en stock" >

		<form name="kd_frmSeriStock" id="kd_frmSeriStock" >
			<table class="list" >
				<input type="checkbox" name="kd_seriStock[]" id="kd_seriStock" style="display:none" >
				<thead>
					<tr>
						<td></td>
						<td>Item</td>
						<td>N° Serie</td>
						<td>Fecha ingreso</td>
					</tr>
				</thead>
				<tbody id="kd_dataSeriStock" >
					<tr>
						<td align="center" ><input type="checkbox" ></td>
						<td>Item</td>
						<td>N° Serie</td>
						<td></td>
					</tr>
				</tbody>
				<!--
				<tfoot></tfoot>
				-->
			</table>
		</form>

		<label id='lbl2' ></label><button class='campo' id='kd_sbmtSali' >Confirmar</button>
		<label id="lbl2" ></label>
		<span class="campo kd_msjConfir" id="msjConfSali" >Mensaje de confirmacion</span>

	</div>

	<!--  Numero de serie movimiento interno [kd_movInter] -->

	<div id="kd_movInter" title="movimiento interno" >

		<label id="lbl2" >Destino:</label>
		<select class="campo" id="kd_destiUbi" >
			<option></option>
		</select>

		<form name="kd_frmSeriStock2" id="kd_frmSeriStock2" >
		<input type="checkbox" name="kd_seriStock[]" id="kd_seriStock" style="display:none" >
		<table class="list kd_tabMovInter" >
			<thead>
				<tr>
					<td></td>
					<td>Item</td>
					<td>N° Serie</td>
				</tr>
			</thead>
			<tbody id="kd_detMovInter" >
				<tr>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		</form>

		<label id='lbl2' >Observacion:</label>
		<textarea class="campo" id="kd_obsItem"  ></textarea>

		<label id="lbl2" ></label>
		<button  class="campo" id="sbmtMovInter" >Confirmar</button>

		<label id="lbl2" ></label>
		<span class="campo kd_msjConfir" >Mensaje de confirmacion</span>

	</div>

	<!-- Transportista del movimiento [kd_transMov] -->

	<div id="kd_transMov" title="Nuevo Transportista" >
		<!--
		<label id="lbl2" >Nombres:</label>
		<input type="text" class="campo" id="kd_transNom" >
		<label id="lbl2" >Apellidos</label>
		<input type="text" class="campo" id="kd_transApe" >
		<label id="lbl2" >DNI</label>
		<input type="text" class="campo"  id="kd_transDni" >
		-->
		<label id="lbl2" >Empresa:</label>
		<input type="text" class="campo" id="kd_empTrans" >
		<label id="lbl2" >Ruc:</label>
		<input type="text" class="campo" id="kd_transRuc" >
		<label id="lbl2" >Direccion:</label>
		<textarea class="campo" id="kd_transDire" ></textarea>
		<label id="lbl2" >Telefono:</label>
		<input type="text" class="campo" id="kd_telTrans" >
		<label id="lbl2" ></label>
		<button class="campo" id="kd_transBnt" >Añadir</button>
	</div>