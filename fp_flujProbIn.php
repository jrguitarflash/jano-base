<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS -->
	<script type="text/javascript" src="js/fp_gesti" ></script>

<!-- Controller UP -->
	<?php require('clases/controlador/controladorInf.class.php'); ?>

<!-- Controller DOWN -->
	<?php require('clases/controlador/controladorSup.class.php'); ?>

<!-- VISTA [fp_flujProbIn] -->

	<div class="box" >
		<div class="heading" >
			<h1>Flujo proyectado de ingresos</h1>
		</div>
		<div class="content" > 
			<label id="lbl2" >Usuarios</label>
			<select class="campo" id="vendId" >
				<?php foreach($data_userVend as $data){ ?>
				<option value="<?php print $data['vendId']; ?>" ><?php print $data['vend']; ?></option>
				<?php }?>
			</select>
			<a href="Javascript:fp_cotiAct_visu();" class="campo" >Visualizar</a>
			<a href="Javascript:fp_repFlujProb_clean();" class="campo">Limpiar</a>
			<iframe src="" id="fp_repFlujProb" ></iframe>
		</div>
	</div>

<!-- SUBVISTA [fp_cotiAct] -->

	<div id="fp_cotiAct" title="Cotizaciones activas">
		<a href="Javascript:fp_cotiAct_gene();" class="campo" >Generar flujo</a>
		<a href="Javascript:fp_cotiAct_conf();" class="campo" >Configurar fianza</a>
		<form name="fp_cotiAct_frm"  >
		<div id="fp_cotiAct_ajax" >
		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td>FL</td>
					<td>CLIENTE</td>
					<td>PROYECTO</td>
					<td>MONTO</td>
					<td>FIANZA</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align="center" ><input type="checkbox" name="cotiId[]" ></td>
					<td>FL</td>
					<td>CLIENTE</td>
					<td>PROYECTO</td>
					<td>MONTO</td>
					<td>FIANZA</td>
				</tr>
			</tbody>
			<tfoot>
			</tfoot>
		</table>
		</div>
		</form>
	</div>

<!-- SUBVISTA [fp_conFian] -->

	<div id="fp_conFian" title="Configuracion de fianza " >
		<form name="fp_conFian_frm" >
		<label id="lbl2" >Adelanto</label>
		<input type="checkbox" class="campo" name="tipFian[]" id="tipFian"  value="1" >
	 	<span class="campo" ><input type="text" size="5" id="fianAde" >%</span>
		<label id="lbl2" >FC</label>
		<input type="checkbox" class="campo" name="tipFian[]" id="tipFian" value="2" >
		<label class="campo" >10%</label>
		<label id="lbl2" ></label>
		<input class="campo"  type="button" onclick="fp_conFian_confir();" value="Confirmar" >
		</form>
	</div>