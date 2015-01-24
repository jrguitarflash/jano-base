<!-- CONTROLADORES INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADORES SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<script type="text/javascript" src="js/gestionador9.js"></script>

<div class="box">
	<div class="heading">
		<h1>Facturas Canceladas</h1>
	</div>
	<div class="busCli">
		<form name="frmFilBus">
			<select id="cliFacCan" name="cliFacCan">
				<?php foreach($dataAnexCli as $data) { ?>
				<option value="<?php print $data['anex_codigo']; ?>" <?php print $data['propSelec']; ?> ><?php print $data['anex_descripcion']; ?></option>
				<?php } ?>
			</select>
			<span class="btnBus" onclick="busFacCli();" >BUSCAR</span>
		</form>
	</div>
	<div class="content">

		<table border="1">
			<tr>
				<td>SUBDIARIO</td>
				<td>FECHA</td>
				<td>CLIENTE</td>
				<td>TIPO</td>
				<td>DOCUMENTO</td>
				<td>IGV</td>
				<td>IGVUS</td>
				<td>TASA</td>
				<td>CO_N_MONTO</td>
				<td>CO_N_MONTOUS</td>
				<td>CO_A_GLOSA</td>
				<td>CO_A_MOVIM</td>
				<td>CO_C_MONED</td>
			</tr>
			<?php foreach($dataFacCance as $data) {?>
			<tr>
				<td><?php print $data['CO_C_SUBDI']; ?></td>
				<td><?php print $data['CO_D_FECHA']; ?></td>
				<td><?php print $data['razCli']; ?></td>
				<td><?php print $data['CO_C_TPDOC']; ?></td>
				<td><?php print $data['CO_C_DOCUM']; ?></td>
				<td><?php print $data['CO_N_IGV']; ?></td>
				<td><?php print $data['CO_N_IGVUS']; ?></td>
				<td><?php print $data['CO_N_TASA']; ?></td>
				<td><?php print $data['CO_N_MONTO']; ?></td>
				<td><?php print $data['CO_N_MTOUS']; ?></td>
				<td><?php print $data['CO_A_GLOSA']; ?></td>
				<td><?php print $data['CO_A_MOVIM']; ?></td>
				<td><?php print $data['CO_C_MONED']; ?></td>
			</tr>
			<?php }?>
		</table>

	</div>
</div>