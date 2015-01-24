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
		<h1>Proyectos Creados</h1>
		<span class="botone" >
			<!--
				<a href="Javascript:cc_geneOc('geneOrdComp');" id="linkGen">
					<img src="images/genePer.png" width="25px" title="Generar Ordenes de compras">
				</a>
			-->
			<!--
				<a href="Javascript:cc_geneOc('actEstCent');" id="linkGen">
					<img src="images/genePer.png" width="25px" title="Actualizar estados de proyecto">
				</a>
			-->
		</span>
	</div>
	<div class="busCli" >
			<!--
				<label class="lblPeriVaca" >PC:</label>
				<input type="text" class="campo" id="pcCorre" name="pcCorre">
			-->
			<!--
				<a onclick="cc_filCenCost();" class="campo">Buscar</a>
			-->
			<label class="lblPeriVaca" >Estado:</label>
			<select class="campo"  id="estCentCost" onclick="cc_ajaxEliCentCost('','filtro')" >
				<?php foreach($dataEstCent as $data) { ?>
				<option value="<?php print $data['idEstApe']; ?>" ><?php print $data['desEstApe']; ?></option>
				<?php }?>
			</select>
	</div>
	<div class="content" id="ajaxEliCentCost">
		<form id="frmCosCread" name="frmCosCread" >
			<input type="hidden" name="accion" value="" >
			<table class="list" >
				<thead>
					<tr>
						<!--
							<td align="center" rowspan="2"></td>
						-->
						<td align="center" rowspan="2">Item</td>
						<td align="center" rowspan="2">PC</td>
						<td align="center" rowspan="2">Cliente</td>
						<td align="center" rowspan="2">Estados</td>
						<td align="center" rowspan="2">Moneda</td>
						<td align="center" rowspan="2">Monto OC Cliente</td>
						<td align="center" rowspan="1" colspan="3">Gastos</td>
						<td align="center" rowspan="2" colspan="1">N° ordenes</td>
						<td align="center" rowspan="2" colspan="1">Accion</td>
						<td align="center" rowspan="2" colspan="1">Reporte</td>
					</tr>
					<tr>
						<td align="center" rowspan="1" colspan="1">S/.</td>
						<td align="center" rowspan="1" colspan="1">$</td>
						<td align="center" rowspan="1" colspan="1">€</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($dataCenCost as $data) { 
						$sql=sql::cc_detCenCostNoGen(2,$data['idCent']);
						$dataDetNoGene=negocio::getData($sql);
						$sql=sql::cc_detCenCost(1,$data['idCent']);
						$dataDetGene=negocio::getData($sql);

						/* CONVERSION DE TOTALES A DOLARES Y SOLES */
				 		$sql=sql::cc_totConverOrd($data['idCent']);
				 		$dataConverTot=negocio::getData($sql);

				 		/*
					 		$totSolesArr=negocio::evaConverTot('soles',$dataConverTot[0]['totSoles']);
					 		$totDolArr=negocio::evaConverTot('dolar',$dataConverTot[0]['totDolares']);
					 		$totHebArr=negocio::evaConverTot('hebros',$dataConverTot[0]['totHebros']);
				 		*/

				 		/*
					 		$totGastProyeDol=$totSolesArr[0]['totDol']+$totDolArr[0]['totDol']+$totHebArr[0]['totDol'];
					 		$totGastProyeSol=$totSolesArr[0]['totSol']+$totDolArr[0]['totSol']+$totHebArr[0]['totSol'];
				 		*/

				 		$totSol=negocio::evaNullTot($dataConverTot[0]['totSoles']);
				 		$totDol=negocio::evaNullTot($dataConverTot[0]['totDolares']);
				 		$totHeb=negocio::evaNullTot($dataConverTot[0]['totHebros']);
					?>
					<tr>
						<!--
							<td>
								<input type="checkbox"  name="estProye[]" <?php print $data['propEstApe']; ?> value="<?php print $data['idCent']; ?>" >
							</td>
						-->
						<td align="center">
							<?php print $data['idCent']; ?>
						</td>
						<td align="center">
							<a href="<?php print "Javascript:cc_direEvaEst('".$data['idCent']."','".$data['idEstApe']."')"; ?>" >
								<?php print $data['correCen']; ?>
							</a>
						</td>
						<td align="left"><?php print negocio::getProvexId($data['idCli']); ?></td>
						<td align="center">
							<img src="<?php print negocio::evaEstProy($data['desEstApe']); ?>" width="30px" title="<?php print $data['desEstApe']; ?>" >
						</td>
						<td align="center"><?php print $data['desMone']; ?></td>
						<td align="right"><?php print number_format($data['montCoti'],2); ?></td>
						<td align="right">S/. <?php print number_format($totSol,2); ?></td>
						<td align="right">$ <?php print number_format($totDol,2); ?></td>
						<td align="right">€ <?php print number_format($totHeb,2); ?></td>
						<td align="center"><?php print $data['cantOrd']; ?></td>
						<td align="center">
							<a href="<?php print "Javascript:cc_ajaxEliCentCost('".$data['idCent']."','delete')"; ?>">Eliminar</a>
						</td>
						<td align="center" title="Generar reporte de compras">
							<a href="Javascript:cc_reporExcelComp();"><img src="images/geneExcel.png" width="30px"></a>
						</td>
					</tr>
					<?php } ?>
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
		</form>
	</div>
</div>