<!-- STYLE MODULE CENTRO COBRANZA -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS MODULO CENTRO COBRANZA -->
<script type="text/javascript" src="js/cc_gesti.js?modojs=1" id="modojs" ></script>

<!-- CONTROLADORES INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADORES SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box">

	<div class="heading" >
		<h1>Costo de Proyecto</h1>
		<span class="botone" >
			<a href="Javascript:cc_geneOc('ocNac');" id="linkGen">
				<img src="images/geneNac.png" width="25px" title="Generar OC Nacional">
			</a>
			<a href="Javascript:cc_geneOc('ocInt');" id="linkGen">
				<img src="images/geneInt.png" width="25px" title="Generar OC Internacional">
			</a>
			<a href="Javascript:cc_geneOc('ocServ');" id="linkGen">
				<img src="images/geneServ.png" width="25px" title="Generar OS">
			</a>
		</span>
	</div>

	<div class="content">
		<form id="frmCosPro" name="frmCosPro" method="post" >
			<input type="hidden" name="accion" value="" >
			<!--
			<label id="lbl" >Nro:</label>
			<label class="campo">PC-00001</label>
			<a href="#" class="campo">Generar</a>
			-->
			<label id="lbl">FL Adjudicada:</label>
			<div class="campo">
				<input id="cotiFl" name="cotiFl" onkeyup="cc_jsonGeneFl();">
				<img src="images/impDetCoti.png" width="20px" class="limDina" title="Importar detalle FL" onclick="cc_ajaxDetFl();">
			</div>
			<label id="lbl" >Cliente:</label>
			<textarea class="campo cliCoti" id="txaCli"></textarea>
			<label id="lbl" >Proyecto:</label>
			<textarea class="campo cliCoti" id="txaProye" name="txaProye" ></textarea>
			<label id="lbl" >O/C cliente</label>
			<input type="text" class="campo" id="txtOcCli">
			<label id="lbl">O/C fecha cliente</label>
			<span class="campo">
				<input type="text" id="ocFechCli" id="ocFechCli" name="ocFechCli">
			</span>
		 	<label id="lbl" >Proveedor:</label>
			<span class="campo prodCoti">
				<input type="text" class="dinaProv" id="txtProve2" name="txtProve2" onMouseOver="cc_mosComp(this.id)">
				<input type="hidden" id="txtProveId2" name="txtProveId2">
				<img src="images/clean.png" width="20px" class="limDina" onclick="cc_limpCampDina('txtProve2','txtProveId2');" title="Limpiar campo">
			</span>
			<label id="lbl" >Moneda</label>
			<span class="campo prodCoti">
			<select id="txtMone2" name="txtMone2" >
				<?php foreach($dataMone as $data) { ?>
					<option value="<?php print $data['moneda_id']; ?>" ><?php print $data['mon_sigla']; ?></option>
				<?php } ?>
			</select>
	</span>
		</form>

		<span id="lbl" >
			<a href="Javascript:cc_openNuevoFl('')">Nuevo</a>
		</span>

		<div id="ajaxDetFl" >
			<table class="list" >
				<thead>
					<tr>
						<td>Item</td>
						<td>Clasificacion</td>
						<td>Producto/Servicio</td>
						<td>Descripcion</td>
						<td>Modelo</td>
						<td>Marca</td>
						<td>Moneda</td>
						<td>Cantidad</td>
						<td>Precio Unid.</td>
						<td>Total</td>
						<td>Proveedor</td>
						<td>Plazo</td>
						<td align="center" >Accion</td>
					</tr>
				</thead>
				<!--
				<tbody>
					<tr>
						<td>Item</td>
						<td>Clasificacion</td>
						<td>Producto</td>
						<td>Modelo</td>
						<td>Marca</td>
						<td>Moneda</td>
						<td>Cantidad</td>
						<td>Precio Unid.</td>
						<td>Total</td>
						<td>Proveedor</td>
						<td>Plazo</td>
						<td align="center" >
							<a href="Javascript:cc_openEditFl();" >Editar</a> |
							<a href="#">Eliminar</a>
						</td>
					</tr>
				</tbody>
				-->
			</table>
		</div>

	</div>

</div>

<!-- POPUP EDITAR COTIZACION FL -->
<div id="dialog1" title="Editar detalle de producto">
	<label id="lbl2" >Clasificacion:</label>
	<span class="campo prodCoti">
		<select id="tipClasif" onclick="cc_prodCatalog();" >
			<?php foreach($dataProdServ as $data){  ?>
			<option value="<?php print $data['clasId']; ?>" ><?php print $data['clasNom']; ?></option>
			<?php }?>
		</select>
	</span>
	<label id="lbl2" >Producto/Servicio:</label>
	<span class="campo prodCoti">
		<input type="text" class="dinaProd" id="txtProd" onkeyup="cc_mosCompProd(this.id)">
		<input type="hidden" id="txtProdId" >
		<img src="images/clean.png" width="20px" class="limDina" onclick="cc_limpCampDinaProd('txtProd','txtProdId');" title="Limpiar campo">
	</span>
	<label id="lbl2" >Modelo:</label>
	<span class="campo prodCoti" id="spnMode">abc</span>
	<label id="lbl2" >Marca:</label>
	<span class="campo prodCoti" id="spnMarca">abc</span>
	<label id="lbl2" >Descripcion:</label>
	<span class="campo prodCoti">
		<textarea id="desProdServ" ></textarea>
	</span>
	<label id="lbl2" >Cantidad:</label>
	<span class="campo prodCoti">
		<input type="text" id="txtCant">
	</span>
	<label id="lbl2" >Moneda</label>
	<span class="campo prodCoti">
		<select id="txtMone">
			<?php foreach($dataMone as $data) { ?>
				<option value="<?php print $data['moneda_id']; ?>" ><?php print $data['mon_sigla']; ?></option>
			<?php } ?>
		</select>
	</span>
	<label id="lbl2" >Precio Unid:</label>
	<span class="campo prodCoti">
		<input type="text" id="txtPreUni" >
	</span>
	<label id="lbl2" >Proveedor:</label>
	<span class="campo prodCoti">
		<input type="text" class="dinaProv" id="txtProve" onMouseOver="cc_mosComp(this.id)">
		<input type="hidden" id="txtProveId" >
		<img src="images/clean.png" width="20px" class="limDina" onclick="cc_limpCampDina('txtProve','txtProveId');" title="Limpiar campo">
	</span>
	<label id="lbl2" >Plazo:</label>
	<span class="campo prodCoti" >
		<input type="text" id="txtPlazo">
		<label>(Dias)</label>
	</span>
	<label id="lbl2"></label> 
	<input type="button" value="Guardar" class="campo button" id="acciEdit" >
	<input type="button" value="Cancelar" class="campo button" onclick="cc_closeEditFl();" >
</div>