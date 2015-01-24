<!-- ESTILOS CSS  -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- SCRIPT JS -->
<script type="text/javascript" src="js/cc_gesti.js?modojs=2" id="modojs" ></script>

<!-- CONTROLADOR INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADOR SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box">
	<div class="heading" >
		<h1>Costos Creados</h1>
	</div>
	<div class="busCli" >
		<form id="frmCosCread" name="frmCosCread" >
			<label class="lblPeriVaca" >FL:</label>
			<input type="text" class="campo" id="cotiFl" name="cotiFl">
			<a onclick="cc_filCenCost();" class="campo">Buscar</a>
		</form>
	</div>
	<div class="content">
		<table class="list" >
			<thead>
				<tr>
					<td align="center">Item</td>
					<td align="center">PC</td>
					<td align="center">FL</td>
					<td align="center">OC/EW</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dataCostCread as $data){ ?>
				<tr>
					<td align="center"><?php print $data['item']; ?></td>
					<td align="center"><?php print $data['pc']; ?></td>
					<td align="center"><a href="<?php print "Javascript:GenerarCotizacionPDF('".$data['flId']."')"; ?>" ><?php print $data['fl']; ?></a></td>
					<td align="center"><a href="<?php print "Javascript:".$data['popDetOc']; ?>" ><?php print $data['oc_ew']; ?></a></td>
				</tr>
				<?php }?>
			</tbody>
			<!--
			<tfoot>
				<tr>
					<td>Item</td>
					<td>PC</td>
					<td>FL</td>
					<td>OC/EW</td>
				</tr>
			</tfoot>
			-->	
		</table>
	</div>
</div>