<!-- JS -->
<script type="text/javascript" src="js/lp_gesti.js" ></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- CONTROLLER DOWN -->
<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- CONTROLLER UP -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<div class="box" >

	<!-- INPUT TEST -->
	 <!--
	 <a href="Javascript:test();"  >test</a>
	 <input type="text" title="test" id="test">
	 -->

	<!-- iniciar perfil de usuario -->
	<input type="hidden" value="<?php print $_SESSION['SIS'][3]; ?>" id="lp_permUsu" >

	<!-- HEAD -->
	<div class="heading" >
		<h1>Linea de Productos</h1>	
		<div class="buttons" >		
			<!--
				|
				<a href="#" id="lp_acciPopImpor">Importar Productos</a>
				|
				<a href="#" id="lp_acciPopConf" >Configurar</a>
			-->
			<a href="#" id="lp_acciNuevProd" >Nuevo Producto</a>
			<ul id="lp_listExpor" >
				<li>
					<a href="#" >Exportar</a>
					<ul>
						<li><a href="Javascript:lp_geneRepo('pdf');" >pdf</a></li>
						<li><a href="Javascript:lp_geneRepo('excel');" >excel</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>

	<!-- SEARCH -->
	<div class="lp_busProd" >
		<input type="text" placeholder="BUSQUEDA POR SUB-CLASIFICACION,CATEGORIA,MARCA" class="lp_txtBusq" id="lp_txtBusq" >

		<!-- DISPONIBILIDAD STOCK -->
		<select class="lp_busProd"  id="kd_dispoStock" >
			<option value="1" >Todos</option>
			<option value="2" >Con Stock</option>
			<option value="3" >Sin Stock</option>
		</select>

		<!-- TIPOS DE ALMACENES -->
		<select class="lp_busProd"  id="kd_almcTip" >
			<option value="6">Todos</option>
			<option value="1" >Barbones</option>
			<option value="2" >Telleria</option>
			<option value="3" >RMA</option>
			<option value="4" >OF. Central</option>
			<option value="5" >Reservas</option>
		</select>

	</div>


	<!-- CANT PROD -->
	<div class="lp_cantProd" id="cantProd" >
		<strong>Cantidad Actual:</strong>
	</div>

	<!-- CONTENT -->
	<div class="content fondPop" >
		<form name="lp_frmLineProd" >
			<input type="checkbox" name="lp_lineProdId[]" id="lp_lineProdId" style="display:none" >
			<table class="list"  id="lp_tabLineProd"  >
				<thead>
					<tr>
						<td rowspan="2" ></td>
						<td rowspan="2" >CODIGO</td>
						<!--
						<td rowspan="2" >SUB-CLASIFICACION</td>
						<td rowspan="2" >CATEGORIA</td>
						-->
						<td rowspan="2" >MARCA</td>
						<td rowspan="2" >NOMBRE ESPAÑOL</td>
						<!--
						<td rowspan="2" >NOMBRE INGLES</td>
						-->
						<td rowspan="2" >DESCRIPCION</td>
						<td rowspan="1"  colspan="3" align="center" >Stock</td>
						<td rowspan="2" >UBICACION</td>
						<td rowspan="2" >N° SERIE</td>
						<td rowspan="2" ></td>
					</tr>
					<tr>
						<td>Minimo</td>
						<td>Maximo</td>
						<td>Actual</td>
					</tr>
				</thead>
				<tbody id="lineProd" >
					<tr>
						<td></td>
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
				<!--
				<tfoot></tfoot>
				-->
			</table>
		</form>
	</div>
</div>

<!-- Sub-Vista [lp_imporProd] -->

<div id="lp_imporProd" title="Importar linea de producto" >
	<div class="box" >
		<!-- Head -->

			<div class="heading" >
				<h1>Importar productos</h1>
			</div>

		<!-- Content -->

			<div class="content fondPop" >

				<!-- Form -->

						<!-- SUB-CLASIFICACION -->

							<label id="lbl" >Sub - Clasificacion:</label>
							<select class="campo" id="subClasi" >
								<?php foreach($dataSubClasi as $data) { ?>
								<option value="<?php print $data['subClasiId']; ?>" ><?php print $data['subClasi']; ?></option>
								<?php } ?>
							</select>

						<!-- CATEGORIA -->

							<label id="lbl" >Categoria:</label>
							<select class="campo" id="cateProd">
								<option></option>
							</select>

						
							<label id="lbl" >Tipo:</label>
							<select class="campo" id="tipProd" >
								<option></option>
							</select>
							<label id="lbl" >Marca - Modelo:</label>
							<select class="campo" id="marMod" >
								<option></option>
							</select>
						

				<!-- Menu -->

					<div class="lp_menu" >
						<a href="#" id="lp_acciImpor" >Importar</a>
					</div>

				<!-- Table -->

					<form name="frmNivProd" >
					<input type="checkbox" name="chkProdId[]" id="chkProdId" style="display:none" >
					<div class="lp_tab" >
					<table class="list" >
						<thead>
							<tr>
								<td></td>
								<td>ID</td>
								<td>NOMBRE ESPAÑOL</td>
								<td>NOMBRE INGLES</td>
								<td>ORIGEN</td>
								<td>DESCRIPCION</td>
							</tr>
						</thead>
						<tbody id="listProd" >
							<tr>
								<td><input type="checkbox" ></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
						<!--<tfoot></tfoot>-->
					</table>
					</div>
					</form>

			</div>
	</div>
</div>

<!-- Sub-Vista [lp_confStock]  -->

<div id="lp_confStock"  title="Configurar Stock" >

	<!-- FORM -->
	<div class="box" >
		<div class="heading" >
			<h1>Configurar Stock</h1>
		</div>
		<div class="lp_fondConte" >
			<input type="hidden" id="lp_lineStockId" >
			<label id="lbl2" ><strong>Nombre:</strong></label>
			<label class="campo lp_nomEspa" id="lp_nom" >xxxxx xxxxx</label>
			<label id="lbl2" ><strong>Sub - Clasificacion:</strong></label>
			<label class="campo" id="lp_sub">xxxxx</label>
			<label id="lbl2" ><strong>Categoria:</strong></label>
			<label class="campo" id="lp_cate" >xxxxx</label>
			<label id="lbl2" ><strong>Tipo:</strong></label>
			<label class="campo" id="lp_tip" >xxxxx</label>
			<label id="lbl2"  ><strong>Marca:</strong></label>
			<label class="campo" id="lp_mar" >xxxxx</label>
			<label id="lbl2" ><strong>Modelo:</strong></label>
			<label class="campo" id="lp_model" >xxxxx</label>
			<label id="lbl2" ><strong>Stock Minimo:</strong></label>
			<input type="number" class="campo" id="lp_stockMin" >
			<label id="lbl2" ><strong>Stock Maximo:</strong></label>
			<input type="number" class="campo" id="lp_stockMax" >
			<label id="lbl2" ><strong>Stock Actual:</strong></label>
			<label class="campo" id="lp_stockActu" ></label>
			<label id="lbl2" ><strong>Precio Unitario :</strong></label>
			<input type="text" class="campo" id="lp_preUni" >
			<label id="lbl2" ><strong>Moneda:</strong></label>
			<select class="campo" id="lp_moneId" >
				<?php foreach($dataMone as $data ) { ?>
				<option value="<?php print $data['monId']; ?>" ><?php print $data['monSig'];  ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" ></label>
			<button class="campo" id="lp_saveConf" >Guardar</button>
		</div>
	</div>

</div>

<!-- Nuevo Producto en Linea [lp_nuevProd] -->

<div id="lp_nuevProd" title="Nuevo Producto" >

	<!-- Form -->

		<!-- PARAMETROS DE EDICION -->
		<input type="hidden" value="" id="lp_idParam" >
		<input type="hidden" value="" id="lp_tareParam" > 

		<!-- SUB-CLASIFICACION -->

		<label id="lbl" >Sub - Clasificacion:</label>
		<select class="campo" id="subClasi2" >
			<?php foreach($dataSubClasi as $data) { ?>
			<option value="<?php print $data['subClasiId']; ?>" ><?php print $data['subClasi']; ?></option>
			<?php } ?>
		</select>
		<span class="campo" >|<a id="lp_acciNuevSub" >Nuevo</a></span>

		<!-- CATEGORIA -->

		<label id="lbl" >Categoria:</label>
		<select class="campo" id="cateProd2">
			<option></option>
		</select>
		<span class="campo" >|<a id="lp_acciNuevCate" >Nuevo</a></span>

		<!-- MARCA -->

		<!--
		<label id="lbl" >Marca:</label>
		<select class="campo" id="lp_marFil" ></select>
		<span class="campo" >|<a href="#" id="" >Nuevo</a></span>
		-->

		<label id="lbl" >Marca:</label>
		<select class="campo" id="lp_marProd3" ></select>
		<span class="campo" ><a id="lp_acciNuevMar" >|Nuevo</a></span>

		<!--
			<label id="lbl" >Tipo:</label>
			<select class="campo" id="tipProd2" >
				<option></option>
			</select>
			<span class="campo" >|<a href="#" id="lp_acciNuevTip" >Nuevo</a></span>
			
			<label id="lbl" >Marca - Modelo:</label>
			<select class="campo" id="marMod2" >
				<option></option>
			</select>
			<span class="campo" >|<a href="#" id="lp_acciNuevMarMod" >Nuevo</a></span>
		-->
		
		<label id="lbl" >Nombre en español:</label>
		<input class="campo" type="text" id="kd_nomEspa" >

		<label id="lbl" style="display:none" >Nombre en ingles:</label>
		<input class="campo" type="text" id="kd_nomIngle" style="display:none" >
		
		<label id="lbl" >Descripcion:</label>
		<textarea class="campo" id="kd_desProd" ></textarea>
		<label id="lbl" >Stock Minimo:</label>
		<input type="number" class="campo" id="lp_stockMin2" >
		<label id="lbl" >Stock Maximo:</label>
		<input type="number" class="campo" id="lp_stockMax2" >
		<label id="lbl" ></label>
		<span class="campo kd_msjConfir" id="msjNuevProd" >Mensaje de confirmacion</span>
		<label id="lbl" ></label>
		<button class="campo" id="kd_acciNuevProd" >Guardar</button>
		<button class="campo" id="lp_acciEdit" >Editar</button>

</div>

<!-- [lp_nuevSub] -->
<div id="lp_nuevSub" title="Nueva Sub-Clasificacion">
	<label id="lbl2" >Sub-Clasificacion:</label>
	<input type="text" class="campo" id="kd_subClasi" >
	<label id="lbl2" ></label>
	<span class="campo kd_msjConfir" id="msjNuevSub" >Mensaje de confirmacion</span>
	<label id="lbl2" ></label>
	<button class="campo" id="kd_acciNuevSub" >Añadir</button>
</div>

<!-- [lp_nuevCate] -->
<div id="lp_nuevCate" title="Nueva Categoria" >
	<label id="lbl2" >Sub-Clasificacion:</label>
	<select class="campo" id="lp_subClasi3" ></select>
	<label id="lbl2" >Categoria:</label>
	<input type="text" class="campo" id="lp_cate3" >
	<label id="lbl2" ></label>
	<span class="campo kd_msjConfir" id="msjNuevCate" >Mensaje de confirmacion</span>
	<label id="lbl2" ></label>
	<button class="campo" id="lp_sbmtNuevCate" >Añadir</button>
</div>

<!-- [lp_nuevTip] -->
<div id="lp_nuevTip"  title="Nuevo Tipo" >
	<label id="lbl2">Categoria:</label>
	<select class="campo" id="lp_cate3Comb" ></select>
	<label id="lbl2">Tipo:</label>
	<input type="text" class="campo" id="lp_tip3" >
	<label id="lbl2" ></label>
	<span class="campo kd_msjConfir" id="msjNuevTip" >Mensaje de confirmacion</span>
	<label id="lbl2" ></label>
	<button class="campo" id="lp_sbmtNuevTip" >Añadir</button>
</div>

<!-- [lp_nuevMarMod] -->
<!--
<div id="lp_nuevMarMod" title="Nueva Marca - Modelo">
	<label id="lbl2" >Tipo:</label>
	<select class="campo" id="lp_tip3Combo"></select>
	<label id="lbl2" >Marca:</label>
	<select class="campo" id="lp_marProd3" ></select>
	<span class="campo" ><a href="#" id="lp_acciNuevMar" >|Nuevo</a></span>
	<label id="lbl2" >Modelo:</label>
	<input type="text" class="campo" id="lp_modCamp" >
	<label id="lbl2" ></label>
	<span class="campo kd_msjConfir" id="msjNuevMarMod" >Mensaje de confirmacion</span>
	<label id="lbl2" ></label>
	<button class="campo" id="sbmtNuevMarMod" >Añadir</button>
</div>
-->

<!-- [lp_nuevMar] -->
<div id="lp_nuevMar" title="Nueva Marca" >
	<label id="lbl2" >Marca</label>
	<input type="text" class="campo" id="lp_marCamp" >
	<label id="lbl2" ></label>
	<span class="campo kd_msjConfir" id="msjMar" >Mensaje de confirmacion</span>
	<label id="lbl2" ></label>
	<button class="campo" id="sbmtNuevMar" >Añadir</button>
</div>