<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS -->
<script type="text/javascript" src="js/kd_gesti.js" ></script>

<!-- CONTROLLER DOWN -->
<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- CONTROLLER UP -->
<?php require("clases/controlador/controladorSup.class.php"); ?>


<div class="box" >

	<div class="heading" > 
		<h1>GUIA PREVIA</h1>
		<div class="buttons" >
			<input type="hidden" id="viewMenu" value="kd_prevGuia" >
			<input type="hidden" value="<?php print $_GET['id']; ?>" id="kd_geneGuiaId" >
			<a href="#" id="kd_geneGuia" >Generar</a> |
			<a href="#" id="kd_kardxPrin" >Volver</a>
		</div>
	</div>

	<div class="content" >

		<h3 id="kd_guiGen" >Datos Generales</h3>

		<label id="lbl2" >N° Movimiento:</label>
		<span class="campo" ><?php print $numMov; ?></span>
		<label id="lbl2" >Tipo:</label>
		<span class="campo" ><?php print $tipMov; ?></span>
		<label id="lbl2" >Fecha:</label>
		<span class="campo" ><?php print $fechMov; ?></span>
		<label id="lbl2" >N° Doc:</label>
		<span class="campo" ><?php print $numDoc; ?></span>
		<label id="lbl2" >Empresa:</label>
		<span class="campo" ><?php print $emp; ?></span>
		<label id="lbl2" >Ruc:</label>
		<span class="campo" ><?php print $ruc; ?></span>
		<label id="lbl2" >Ubicacion:</label>
		<span class="campo" ><?php print $almcUbi; ?></span>
		<label id="lbl2" >Destino:</label>
		<span class="campo" ><?php print $des; ?></span>
		<label id="lbl2" >Transportista:</label>
		<span class="campo" ><?php print $trans; ?></span>

		<h3 id="kd_guiGen" >Datos de Factura</h3>

		<label id="lbl2" >N° Factura:</label>
		<span class="campo" ><?php print $numFac; ?></span>
		<label id="lbl2" >Fecha de Emision:</label>
		<span class="campo" ><?php print $facEmis; ?></span>


		<h3 id="kd_guiDet" >Detalle de Movimiento</h3>

		<form name="kd_frmDetGuia"  class="kd_frmDetGuia" >
		<input type="checkbox" value="" name="kd_detId" class="kd_oculCamp" >
		<input type='checkbox' value="" id='kd_chkDes' name='kd_chkDes' class="kd_oculCamp" >
		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td align="center" >Item</td>
					<td align="center" >Cantidad</td>
					<td>Unid.</td>
					<td>Descripcion</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dataDetKardx as $data) { ?>	
				<tr>
					<td>
						<input type="checkbox" value="<?php print $data['detKardxId']; ?>" name="kd_detId" >
					</td>
					<td align="center" >
						<?php print str_pad($ind,4,'0',STR_PAD_LEFT); ?>
					</td>
					<td align="center" >
						<?php print $data['kdxCant']; ?>
					</td>
					<td><input type="text" size="4" id="<?php print 'kd_unid_'.$acum; ?>" ></td>
					<td>
						<?php print $data['nomEspa']."<br>".
									"<input type='checkbox' id='kd_chkDes' name='kd_chkDes' ><input type='text' id='kd_desProd_".$acum."' size='45' ><br>".
									"Marca: ".$data['mar']."<br>".
									"#Serie: "."<br>".
									$data['numSeriMov']."<br>".
									"<textarea id='kd_glosa_".$acum."' ></textarea>
									<input type='text' value='".str_pad($ind++,4,'0',STR_PAD_LEFT)."' id='kd_item_".$acum++."' class='kd_oculCamp' >"; ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</form>

	</div>

</div>