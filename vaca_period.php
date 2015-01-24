<!-- Vacaciones gestionador -->
<script type="text/javascript" src="js/vaca_gesti.js?modo=1" id="modojs"></script>

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
		<h1>Periodo de Vacaciones</h1>
	</div>
	<div class="busCli">
		<form id="frmVacaPeriod" name="frmVacaPeriod" >
		<label class="lblPeriVaca">Area:</label>
		<select class="campo" onclick="ajaxTrabxAre();" id="slcAre">
			<?php foreach($dataAreTrab as $data) {?>
				<option  
					value="<?php print $data['trab_funcion_id']; ?>"
					<?php print $data['propSelec']; ?> >
					<?php print $data['trab_funcion_nombre'];  ?>
				</option>
			<?php }?>
		</select>
		<span class="campo"></span>
		<label class="campo">Trabajador:</label>
		<select class="campo" id="slcTrab" onclick="ajaxPeriTrab();">
			<?php foreach($dataTrabAdm as $data){ ?>
			<option value="<?php print $data['persona_id']; ?>" <?php print $data['propSelec']; ?> ><?php print $data['persona']; ?></option>
			<?php }?>
		</select>
		<span class="campo"></span>
		<label class="campo">Periodo:</label>
		<select class="campo" id="slcPeri" onclick="ajaxPeriTrab();">
			<?php foreach($dataPeriAn as $data){ ?>
			<option value="<?php print $data['vaca_perioAn_id']; ?>" <?php print $data['propSelec']; ?> ><?php print $data['vaca_desPeri']; ?></option>
			<?php }?>
		</select>
		<!--
		<span class="campo"></span>
		<label class="campo">Dias habiles:</label>
		<input type="radio" class="campo" name="diHabil" id="diHabil" value="22" checked ><span class="campo">22 Dias</span>
		<input type="radio" class="campo" name="diHabil" id="diHabil" value="30"><span class="campo">30 Dias</span>
		-->
		</form>
	</div>
	<div class="content">
			<div id="tabs">
				<ul>
				<li><a href="#tabs-1">Periodo de vacaciones</a></li>
				<!--<li><a href="#tabs-2">Proin dolor</a></li>-->
				<!--<li><a href="#tabs-3">Aenean lacinia</a></li>-->
				</ul>
				<div id="tabs-1">
					<!--
						<table class="list" >
							<thead>
								<tr>
									<td colspan="4">Periodo 2012-2013</td>	
								</tr>
								<tr>
									<td>Nombre y Apellido</td>	
									<td>Mes de Goce</td>
									<td>Dias gozados</td>
									<td>Dias pendientes</td>			
								</tr>
							</thead>	
						<tbody>
								<tr>
									<td>jose fernandez</td>	
									<td>Enero 2014</td>
									<td align="center"><a href="Javascript:showDetDiGoz();" id="diGo">5</a></td>
									<td align="center" id="diPen">4</td>	
								</tr>
						</tbody>
						</table>
					-->
						<table class="list" >
							<thead>
								<tr>
									<td colspan="5">Periodo <?php print $valPeri; ?></td>	
								</tr>
								<tr>
									<td>Nombre y Apellido</td>	
									<td align="center">Mes Tomado</td>
									<td align="center">Dias Tomados</td>
									<td align="center">Dias Pendientes</td>
									<td></td>		
								</tr>
							</thead>	
							<tbody>
									<?php foreach($dataTrabAsig as $data1) { ?>
									<?php
										$totTom=0;
										$totPen=0;
										$sql=sql::vaca_PeriTrab($data1['vaca_trabId']);
										$dataPeriTrab=negocio::getData($sql);
										$sql=sql::vaca_getVacaIni($data1['vaca_trabId']);
										$valFechIni=negocio::getVal($sql,'fechModi');
										$sql=sql::vaca_getForCal($data1['vaca_trabId'],'1');
										$valForCal=negocio::getVal($sql,'forCal');
									?>
									<?php foreach($dataPeriTrab as $data2) { ?>
									<?php
										$totTom=($totTom+$data2['diGoc'])-$data2['numFinSem'];
										#$totPen=$totPen+intval(negocio::evaDiPen($data2['diGoc'],$data2['diPen']));
										$forCal=$data2['forCal'];
										$valForCal=$valForCal-($data2['diGoc']-$data2['numFinSem']);
										$totPen=$valForCal; 
									?>
									<tr>
										<td id="nomMayus" ><?php print $data2['trab']; ?></td>	
										<td>
											<?php print negocio::fechLet($data2['vaca_mesGocIni'],'mes').' '.negocio::fechLet($data2['vaca_mesGocIni'],'anio'); ?>
										</td>
										<td align="center">
											<a href="<?php print "Javascript:showDetDiGoz('".$data2['vaca_vaca_id']."')"; ?>" id="diGo">
												<?php print ($data2['diGoc']-$data2['numFinSem']); ?>
											</a>
										</td>
										<td align="center" id="diPen">
											<?php #print negocio::evaDiPen($data2['diGoc'],$data2['diPen']); ?>
											<?php print $totPen; ?>
										</td>
										<td align="center">
											<a href="<?php print "Javascript:jsonEliVaca('".$data2['vaca_vaca_id']."')"; ?>" id="eliVaca" >Eliminar</a>
										</td>
									</tr>
									<?php } ?>
									<tr class="vacFondTot">
										<td colspan="2" align="center">
											<strong>TOTAL</strong>
										</td>
										<td align="center"><?php print $totTom; ?></td>
										<td align="center"><?php print $totPen; ?></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="5" align="center">
											<?php
												$sql=sql::vaca_getFechPost($valFechIni,1);
												$valFechIni=negocio::getVal($sql,'fechModi');
											?>
											Fecha apertura vacaciones: <?php print $valFechIni; ?> | Forma de calculo: <?php print $forCal; ?> dias
										</td>
									</tr>
									<?php } ?>
							</tbody>
						</table>
				</div>
			</div>
	</div>
</div>

<!--
<a href="Javascript:crearCookie();">Crear</a>
<a href="Javascript:llamarCookie();">Llamar</a>
<a href="Javascript:borrarCookie();">Borrar</a>
-->

<!--
<input type="hidden" value="" id="areaParam">
<input type="hidden" value="" id="trabParam">
<input type="hidden" value="" id="periParam">
-->

<!-- POPUP DETALLE DIAS GOZADOS -->
<div id="dialog1" title="Detalle de dias gozados">
	<label id="lbl"><span id="fechInGoc">Fecha inicio Goce:27/02/2014</span></label>
	<label id="lbl"><span id="fechFinGoc">Fecha termino Goce:27/02/2014</span></label>
</div>