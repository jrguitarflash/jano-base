<!--1. Generacion de cotizacion servicios -> cs_genCot-->

<!--  JS GESTIONADOR -->
<script type="text/javascript" src="js/cs_gesti.js?modojs=1" id="modojs" ></script>

<!-- CSS DECORADOR -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- PHP CONTROLADORES -->

<!-- CONTROLADOR INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADOR SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box" >
	<div class="heading" >
		<h1>Nueva Cotizacion de Servicio</h1>
		<span class="botone" >
			<a href="Javascript:cs_loadEvent('geneCoti');">
				<img src="images/grabar.png" width="20px" title="Generar cotizacion de servicio">
			</a>
			<a href="Javascript:cs_loadEvent('direView');">
				<img src="images/lista.png" width="20px" title="Cotizaciones creadas">
			</a>
		</span>
	</div>
	<div class="content" >
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">General</a></li>
				<li><a href="">Detalle</a></li>
				<li><a href="">Condiciones</a></li>
			</ul> 
			<div id="tabs-1">
				<form id="cs_frmCotiServ" name="cs_frmCotiServ" method="post">
					<input type="hidden" name="accion" >
					<div class="cs_pesGene" >
						<label id="lbl" >Fecha:</label>
						<span class="campo" >	
						<input type="text"  id="cs_fechCot" name="cs_fechCot" >
						</span>
						<label id="lbl" >Cliente:</label>
						<input type="text" class="campo cs_dinaEmp" id="cs_empAlias" name="cs_empAlias" >
						<input type="hidden" class="campo" id="cs_empId" name="cs_empId" >
						<img src="images/cs_eraser.png" width="25px" class="campo cs_eraser" title="Limpiar cliente" onclick="cs_loadEvent('cleanEmp');">
						<label id="lbl" >Resp. Comercial</label>
						<select class="campo" name="cs_respComer">
							<?php foreach($dataRespComer as $data) { ?>
							<option value="<?php print $data['respComerId']; ?>" ><?php print $data['respComer']; ?></option>
							<?php } ?>
						</select>
						<label id="lbl" >Moneda</label>
						<select class="campo" name="cs_moneId" id="cs_moneId" >
							<?php foreach($dataMone as $data) { ?>
							<option value="<?php print $data['moneda_id']; ?>" ><?php print $data['mon_sigla']; ?></option>
							<?php }?>
						</select>
					</div>
					<div class="cs_pesGene" >
						<label id="lbl" >Descripcion:</label>
						<textarea class="campo" name="cs_desServ" ></textarea>
						<label id="lbl" >Prioridad:</label>
						<select class="campo" name="cs_priorCot" >
							<?php foreach($dataPrior as $data){ ?>
							<option value="<?php print $data['priorId']; ?>" ><?php print $data['priorNom']; ?></option>
							<?php }?>
						</select>
						<label id="lbl" >Estado:</label>
						<select class="campo" name="cs_estServ" >
							<?php foreach($dataEst as $data){ ?>
							<option value="<?php print $data['cotEstId']; ?>" ><?php print $data['cotEstNom']; ?></option>
							<?php }?>
						</select>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>