<!-- Vacaciones gestionador -->
<script type="text/javascript" src="js/vaca_gesti.js"></script>

<!-- Estilos de vista asignacion de vacaciones -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- //------JQUERY TABS AÑADIDOS--------------// -->
<link rel="stylesheet" type="text/css" href="libJquery/tabs/jquery-ui.css" />
<script type="text/javascript" src="libJquery/tabs/jquery-ui.js"></script>

<!-- CONTROLADORES INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADORES SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>


<div class="box">
	<div class="heading">
		<h1>Asignacion de Vacaciones</h1>
		<span class="botone">
			<a href="Javascript:jsAsigVaca();">
				<img width="20px" alt="grabar" src="images/grabar.png" title="Guardar asignacion de vacaciones"></img>
			</a>
			<a href="Javascript:jsForCalVaca();">
				<img width="20px" alt="grabar" src="images/total.png" title="Guardar forma de calculo"></img>
			</a>
			<a href="Javascript:jsonTestNomMes();">test</a>
		</span>
	</div>
	<div class="content">
		<div id="tabs">
			<ul>
			<li><a href="#tabs-1">Asignacion de vacaciones</a></li>
			<!--<li><a href="#tabs-2">Proin dolor</a></li>-->
			<!--<li><a href="#tabs-3">Aenean lacinia</a></li>-->
			</ul>
			<div id="tabs-1">
				<form name="frmVacaAsig" id="frmVacaAsig" method="post">
					<label id="lbl">Area:</label>
					<select class="campo" onclick="ajaxTrabxAreIni();" id="slcAre" name="slcAre">
						<?php foreach($dataAreTrab as $data) {?>
							<option  
								value="<?php print $data['trab_funcion_id']; ?>"
								<?php print $data['propSelec']; ?> >
								<?php print $data['trab_funcion_nombre'];  ?>
							</option>
						<?php }?>
					</select>
					<label id="lbl">Trabajador</label>
					<select class="campo" id="slcTrab" name="slcTrab">
						<?php foreach($dataTrabAdm as $data){ ?>
						<option value="<?php print $data['persona_id']; ?>" ><?php print $data['persona']; ?></option>
						<?php }?>
					</select>
					<label id="lbl">Periodo:</label>
					<select class="campo" id="slcPeri" name="slcPeri" onclick="jsonForCalAsig();">
						<?php foreach($dataPeriAn as $data) { ?>
						<option value="<?php print $data['vaca_perioAn_id']; ?>" ><?php print $data['vaca_desPeri']; ?></option>
						<?php } ?>
					</select>
					<label id="lbl">Forma de calculo:</label>
					<input type="radio" class="campo" name="diHabil" value="22" checked ><span class="campo">22 Dias</span>
					<input type="radio" class="campo" name="diHabil" value="30"><span class="campo">30 Dias</span>
					<label id="lbl">Fecha inicial asignación:</label>
					<span class="campo">
						<input type="text" id="txtFechGozIni" name="txtFechGozIni" >
					</span>
					<label id="lbl">Fecha termino asignación:</label>
					<span class="campo">
						<input type="text" id="txtFechGozFin" name="txtFechGozFin" >
					</span>
					<input type="hidden" value="" name="accion">
					<input type="hidden" value="" id="txtDiNoHab"  >
				</form>
			</div> 
		</div>
</div>