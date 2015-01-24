<!-- Reporte de movimiento......! -->

<!-- CSS MOVIMIENTO PERSONAL  -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS MOVIMIENTO PERSONAL -->
<script type="text/javascript" src="js/mp_gesti.js?modojs=3" id="modojs" ></script>

<!-- CONTROLADOR INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADOR SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div>

	<div class="box" >

		<div class="heading" >
			<h1>Reporte de movimiento</h1>
		</div>
		<div class="busCli" >
			<form id="mp_frmRepor" name="mp_frmRepor" method="post" target="mp_reporMovPer" action="reporte/mp_reporMovPer.php" >
				<label class="lblPeriVaca">Mes:</label>
				<select class="campo" name="mp_mesMov">
					<?php foreach($dataMesMov as $data){ ?>
						<option value="<?php print $data['mesId']; ?>" ><?php print $data['mesDes']; ?></option>
					<?php }?>
				</select>
				<label class="campo" >Año</label>
				<select class="campo" name="mp_anMov">
					<?php foreach($dataAnMov as $data){ ?>
						<option value="<?php print $data['anVal']; ?>" ><?php print $data['anVal']; ?></option>
					<?php }?>
				</select>
				<button class="campo btnBusMov"  onclick="mp_geneRepor();" >Generar</button>
			</form>
		</div>
		<div class="content mp_posiRepo" >
			<iframe id="mp_reporMovPer" name="mp_reporMovPer" width="800px" height="500px" ></iframe>
		</div>

	</div>

</div>