<!-- JS -->
<script type="text/javascript" src="js/kd_gesti.js" ></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- CONTROLLER DOWN -->
<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- CONTROLLER UP -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<div class="box" >
	<div class="heading" >
		<h1>Reporte de Almacen</h1>
	</div>
	<div class="content" >

		<form name="frmRepAlm" id="frmRepAlm" >

			<!-- TIPO DE REPORTE -->
			<label id="lbl2" >Tipo</label>
			<select class="campo" id="kd_tipRep" >
				<option value="seleccionar" >[seleccionar]</option>
				<option value="1" >Inventario</option>
				<option value="2" >Movimientos</option>
			</select>

			<input type="button" class="campo" id="kd_acciGene" value="GENERAR" >

			<!-- INICIAR VISTA ACTUAL -->
			<input type="hidden" id="viewMenu" value="kd_repAlm" >

			<!-- SECCION INVENTARIO -->
			<div id="kd_secciInven" >
				<fieldset class="flsInve" >
					<legend>INVENTARIO</legend>
					
					<!-- FILTROS INVENTARIO -->

					<label id="lbl2" >Filtros:</label>
					<span class="campo" >Sub-Clasificion<input value="1" type="radio" name="kd_fil" checked ></span>
					<span class="campo" >Categoria<input value="2" type="radio" name="kd_fil" ></span>
					<span class="campo" >Tipo<input value="3" type="radio" name="kd_fil" ></span>
					<span class="campo" >Marca<input value="4" type="radio" name="kd_fil" ></span>
					<span class="campo" >Modelo<input value="5" type="radio" name="kd_fil" ></span>
					<label id="lbl2" ></label>
					<span class="campo" >Todos<input value="6" type="radio" name="kd_fil" ></span>
					<label id="lbl2" >Sub-Clasificacion:</label>
					<select class="campo" id="kd_subClasi" >
						<?php print $subClasi; ?>
					</select>

					<!-- NIVELES PRODUCTO -->

					<label id="lbl2" >Categoria</label>
					<select class="campo" id="kd_catProd" ></select>
					<label id="lbl2" >Tipo</label>
					<select class="campo" id="kd_tipProd" ></select>
					<label id="lbl2" >Marca:</label>
					<select class="campo" id="kd_mar" ></select>
					<label id="lbl2" >Modelo:</label>
					<select class="campo" id="kd_mod" ></select>

				</fieldset>
			</div>

			<!-- SECCION MOVIMIENTO -->
			<div id="kd_secciMov" >
				<fieldset class="flsMov" >
					<legend>MOVIMIENTO</legend>
					<label id="lbl2" >Movimiento</label>
					<select class="campo" id="kd_tipMov" >
						<option value="seleccionar" >[seleccionar]</option>
						<option value="3" >todos</option>
						<?php print $tipMov; ?>
					</select>
					<!--
					<label id="lbl2" >Filtro:</label>
					<span class="campo" >Empresa<input  type="radio"  name="kd_filMov" ></span>
					<span class="campo" >Producto<input  type="radio" name="kd_filMov" ></span>
					<label id="lbl2" >Producto:</label>
					<input class="campo" >
					-->
					<label id="lbl2" >Empresa</label>
					<input type="text" class="campo"  id="kd_empDes" >
					<input type="hidden" id="kd_empId" >
					<label class="campo" >Todas</label>
					<input type="checkBox" class="campo" id="kd_checkEmp" name="kd_checkEmp[]" style="display:none" >
					<input type="checkBox" class="campo" id="kd_checkEmp" name="kd_checkEmp[]" value="1" >
					<label id="lbl2" >Fecha Inicial:</label>
					<span class="campo"><input type="text" id="kd_fechIni" ></span>
					<label id="lbl2" >Fecha Final</label>
					<span class="campo"><input type="text" id="kd_fechFin" ></span>
				</fieldset>
			</div>

		</form>

		<!-- REPORTE DE ALMACEN -->
		<iframe id="kd_ifmRepAlm" class="kd_repAlm" ></iframe>

	</div>
</div>

