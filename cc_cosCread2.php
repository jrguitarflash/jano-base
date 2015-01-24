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
			<a href="Javascript:cc_geneOc('geneOrdComp');" id="linkGen">
				<img src="images/genePer.png" width="25px" title="Generar Ordenes de compras">
			</a>
		</span>
	</div>
	<div class="busCli" >
			<label class="lblPeriVaca" >PC:</label>
			<input type="text" class="campo" id="pcCorre" name="pcCorre">
			<!--
				<a onclick="cc_filCenCost();" class="campo">Buscar</a>
			-->
	</div>
	<div class="content">
		<form id="frmCosCread" name="frmCosCread" >
			<input type="hidden" name="accion" value="" >
			<table class="list" >
				<thead>
					<tr>
						<td align="center">Item</td>
						<td align="center">PC</td>
						<td align="center">FL</td>
						<td align="center">OC/EW Por Generar</td>
						<td align="center">OC/EW Generadas</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($dataCenCost as $data) { 
						$sql=sql::cc_detCenCostNoGen(2,$data['idCent']);
						$dataDetNoGene=negocio::getData($sql);
						$sql=sql::cc_detCenCost(1,$data['idCent']);
						$dataDetGene=negocio::getData($sql);
					?>
					<tr>
						<td align="center"><?php print $data['idCent']; ?></td>
						<td align="center">
							<a href="<?php print "index.php?menu_id=127&menu=cc_asigPro&idCen=".$data['idCent']; ?>" ><?php print $data['correCen']; ?></a>
						</td>
						<td align="center"><?php print $data['correCot']; ?></td>
						<td align="center">
							<div align="center" class="cajOrd">
								<ul type="square" >
									<?php foreach($dataDetNoGene as $data2) { ?>
									<li>
										<a href="#" title="<?php print negocio::getProvexId($data2['cc_provId']).' '.$data2['cc_desOrd']; ?>">
											<?php print negocio::evaTipMone($data2['cc_tipOrden']); ?>
											<input type="checkbox" name="noGeneOrd[]" value="<?php print $data2['cc_detCentCostId']; ?>">
										</a>
									</li>
									<?php } ?>
								</ul>
							</div>
						</td>
						<td align="center">
							<div align="center" class="cajOrd">
								<ul type="square" >
									<?php foreach($dataDetGene as $data3) { ?>
									<li>
										<a href="<?php print 'Javascript:'.negocio::evaTipDocOrd($data3['sufiDoc'],$data3['compId']); ?>" 
											title="<?php print negocio::getProvexId($data3['cc_provId']).' '.$data3['cc_desOrd']; ?>">
											<?php print $data3['cc_ocGeneId']; ?>
										</a>
									</li>
									<?php } ?>
								</ul>
							</div>
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