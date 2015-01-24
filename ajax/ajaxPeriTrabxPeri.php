<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

#$sql1=sql::vaca_periTrabxFil($_POST['valTrab'],$_POST['valPeri']);
#$sql2=sql::vaca_periTrabxAre($_POST['valAr'],$_POST['valPeri']);
#$sql=negocio::evaFilPeri($_POST['valTrab'],$_POST['valPeri'],$_POST['valAr'],$sql1,$sql2);

session_start();

$sql=negocio::evaGetPeriTot($_POST['valPeri']);
$dataPeri=negocio::getData($sql);
$anPeriAp=0;

foreach ($dataPeri as $data) 
{

		$sql=sql::vaca_periTrabxTrab($_SESSION['SIS'][2],$data['vaca_perioAn_id']);
		$dataPeriTrab=negocio::getData($sql);

		$sql=sql::vaca_getVacaInixUser($_SESSION['SIS'][2]);
		$valFechIni=negocio::getVal($sql,'fechModi');

		$sql=sql::vaca_getPeriAn($data['vaca_perioAn_id']);
		$valPeri=negocio::getVal($sql,'vaca_desPeri');

		$sql=sql::vaca_getForCalxTrab($_SESSION['SIS'][2],$data['vaca_perioAn_id']);
		$valForCal=negocio::getVal($sql,'forCal');

		$anPeriAp++;

		?>

		<!-- DATA LOAD AJAX -->

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
					<!--<td></td>-->			
				</tr>
			</thead>	
			<tbody>
					<?php
						$totTom=0;
						$totPen=0;
					?>
					<?php foreach($dataPeriTrab as $data2) { ?>
					<?php
						$totTom=($totTom+$data2['diGoc'])-$data2['numFinSem'];
						#$totPen=$totPen+intval(negocio::evaDiPen($data2['diGoc'],$data2['diPen']));
						$forCal=$data2['forCal'];
						$valForCal=($valForCal-$data2['diGoc'])+$data2['numFinSem'];
						$totPen=$valForCal; 
					?>
					<tr>
						<td id="nomMayus"><?php print $data2['trab']; ?></td>	
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
						<!--<td align="center">
							<a href="<?php #print #"Javascript:jsonEliVaca('".$data2['vaca_vaca_id']."')"; ?>" id="eliVaca" >Eliminar</a>
						</td>-->
					</tr>
					<?php } ?>
					<tr class="vacFondTot">
						<td colspan="2" align="center">
							<strong>TOTAL</strong>
						</td>
						<td align="center"><?php print $totTom; ?></td>
						<td align="center"><?php print $totPen; ?></td>
						<!--<td></td>-->
					</tr>
					<tr>
						<td colspan="4" align="center" >
							<?php
								$sql=sql::vaca_getFechPost($valFechIni,$anPeriAp);
								$valFechIni=negocio::getVal($sql,'fechModi');
							?>
							Fecha apertura vacaciones: <?php print $valFechIni; ?> | Forma de calculo: <?php print $forCal; ?> dias 
						</td>
					</tr>
			</tbody>	
		</table>

<?php } ?>
