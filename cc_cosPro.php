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
		<h1>Nuevo Proyecto</h1>
		<span class="botone" >
			<!--
			<a href="Javascript:cc_geneOc('ocNac');" id="linkGen">
				<img src="images/geneNac.png" width="25px" title="Generar OC Nacional">
			</a>
			<a href="Javascript:cc_geneOc('ocInt');" id="linkGen">
				<img src="images/geneInt.png" width="25px" title="Generar OC Internacional">
			</a>
			<a href="Javascript:cc_geneOc('ocServ');" id="linkGen">
				<img src="images/geneServ.png" width="25px" title="Generar OS">
			</a>
			-->
			<a href="Javascript:cc_geneOc('centCost');" id="linkGen">
				<img src="images/save.png" width="25px" title="Guardar centro de costo">
			</a>
		</span>
	</div>

	<div class="content">
		<form id="frmCosPro" name="frmCosPro" method="post" enctype="multipart/form-data">
			<input type="hidden" name="accion" value="" >
			<!--
			<label id="lbl" >Nro:</label>
			<label class="campo">PC-00001</label>
			<a href="#" class="campo">Generar</a>
			-->
			<label id="lbl">FL Adjudicada:</label>
			<div class="campo">
				<input id="cotiFl" name="cotiFl" onkeyup="cc_jsonGeneComp();">
				<!--
				<img src="images/impDetCoti.png" width="20px" class="limDina" title="Importar detalle FL" onclick="cc_ajaxDetFl();">
				-->
			</div>

			<!-- FL MULTIPLE -->
			<span class="campo" ><a href="Javascript:cc_multiFl();" >Añadir</a></span>
			<label id="lbl" ></label>
			<select class="campo" multiple id="cc_flMulti" onclick="cc_deleMultiFl()" name="cc_flMulti[]" >
			</select>
			
			<label id="lbl" >Cliente:</label>
			<textarea class="campo cliCoti" id="txaCli" name="txaCli" disabled></textarea>
			<textarea class="campo cliCoti" id="txaCli2" name="txaCli2" style="display:none"></textarea>
			<label id="lbl" >Proyecto:</label>
			<textarea class="campo cliCoti" id="txaProye" name="txaProye" disabled></textarea>
			<textarea class="campo cliCoti" id="txaProye2" name="txaProye2" style="display:none"></textarea>
			<label id="lbl" >O/C cliente</label>
			<input type="text" class="campo" id="txtOcCli" name="txtOcCli">
			<label id="lbl">O/C fecha recepcion</label>
			<span class="campo">
				<input type="text" id="ocFechCli" id="ocFechCli" name="ocFechCli" value="<?php print $fechOcAct; ?>">
			</span>
			<label id="lbl">Monto</label>
			<input class="campo" type="text" id="totCoti" name="totCoti" onkeyup="puntitos();">
			<label id="lbl">Moneda</label>
			<span class="campo prodCoti">
			<select id="txtMone2" name="txtMone2">
					<?php foreach($dataMone as $data) { ?>
						<option value="<?php print $data['moneda_id']; ?>" ><?php print $data['mon_sigla']; ?></option>
					<?php } ?>
				</select>
			</span>
			<label id="lbl" >Adjuntar:</label>
			<input type="file" name="adjOrdCli[]" id="adjOrdCli" class="campo adjuDina" multiple>

			<!--
			 	<label id="lbl" >Proveedor:</label>
				<span class="campo prodCoti">
					<input type="text" class="dinaProv" id="txtProve2" name="txtProve2" onMouseOver="cc_mosComp(this.id)">
					<input type="hidden" id="txtProveId2" name="txtProveId2">
					<img src="images/clean.png" width="20px" class="limDina" onclick="cc_limpCampDina('txtProve2','txtProveId2');" title="Limpiar campo">
				</span>
			-->
			<!--
				<label id="lbl" >Moneda</label>
				<span class="campo prodCoti">
				<select id="txtMone2" name="txtMone2" >
					<?php #foreach($dataMone as $data) { ?>
						<option value="<?php #print $data['moneda_id']; ?>" ><?php #print $data['mon_sigla']; ?></option>
					<?php #} ?>
				</select>
				</span>
			-->

			<!-- *********************************** -->	
			<!-- MODULO FINANCIERO & CENTRO DE COSTO -->
			<!-- *********************************** -->

			<?php print $opeBanca; ?>

			<!-- ********************************** -->

		</form>

		<span id="lbl" >
			<select id="txtTipComp">
				<?php foreach($dataTipComp as $data) { ?>
					<option value="<?php print $data['tipCompId']; ?>" ><?php print $data['tipCompDes']; ?></option>
				<?php } ?>
			</select>
			<a href="Javascript:cc_openNuevoFl('','add')">Crear</a>
		</span>

		<div id="ajaxDetFl" >
			<table class="list" >
				<thead>
					<tr>
						<td>Item</td>
						<td>Tipo Orden</td>
						<td>Proveedor</td>
						<!--<td>Descripcion</td>-->
						<td>Moneda</td>
						<td>Monto</td>
						<td>Incoterm</td>
						<td>Plazo</td>
						<td>OC/EW/OS</td>
						<!--
							<td align="center" >Accion</td>
						-->
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

<div id="dialog1" title="Detalle de orden">
	<!--
		<label id="lbl2" >Tipo Orden</label>
		<span class="campo prodCoti">
			<select id="txtTipComp">
				<?php #foreach($dataTipComp as $data) { ?>
					<option value="<?php #print $data['tipCompId']; ?>" ><?php #print $data['tipCompDes']; ?></option>
				<?php #} ?>
			</select>
		</span>
	-->
	<label id="lbl2" >Moneda</label>
	<span class="campo prodCoti">
		<select id="txtMone">
			<?php foreach($dataMone as $data) { ?>
				<option value="<?php print $data['moneda_id']; ?>" ><?php print $data['mon_sigla']; ?></option>
			<?php } ?>
		</select>
	</span>
	<label id="lbl2" >Proveedor:</label>
	<span class="campo prodCoti">
		<input type="text" class="dinaProv" id="txtProve" onMouseOver="cc_mosComp(this.id)">
		<input type="hidden" id="txtProveId" >
		<img src="images/clean.png" width="20px" class="limDina" onclick="cc_limpCampDina('txtProve','txtProveId');" title="Limpiar campo">
	</span>
	<!--
		<label id="lbl2" >Descripcion:</label>
		<span class="campo prodCoti">
			<textarea id="desProdServ" ></textarea>
		</span>
	-->
	<label id="lbl2" >Plazo:</label>
	<span class="campo prodCoti" >
		<input type="text" id="txtPlazo">
		<label>(Dias)</label>
	</span>
	<label id="lbl2"></label> 
	<input type="button" value="Guardar" class="campo button" id="acciEdit" >
	<input type="button" value="Cancelar" class="campo button" onclick="cc_closeEditFl();" >
</div>