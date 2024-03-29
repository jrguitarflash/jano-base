<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador.js"></script>


<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

<div class="box">
	<div class="heading">
		<h1>
			Reclamos - Lista	
		</h1>
	</div>
	<div class="content">
		<div id="lista_199"> 
			<div class="lista">
				<form name="filRecla" method="post">
					<table id="filtros" class="filter">
						<tr>
							<td width="20%"><input type="text" name="des" class="des"></td>
							<td width="5%" align="left"><input type="radio" name="opci" value="cli">cliente</td> 
							<td width="8%"><input type="radio" name="opci" value="respo" >responsable</td>
							<td width="5%"><input type="radio" name="opci" value="tod">todos</td>
							<td align="left" width="5%"><input type="submit" name="bus" value="buscar" class="buscar"></td>
							<td align="left" width="10%">
								<a href="index.php?menu_id=106&menu=reclamo_form">
									<img src="images/add.png" alt="" width="20px" class="iconRecla">Agregar Reclamo
								</a>
							</td>
							<td align="left" width="7%">
								<a href="index.php?menu_id=105&menu=reclamo_lista&filtro=1&filtro2=6&filtro3=2&filtro4=3&filtro5=4">
									<img src="images/stock_status.png" alt="" width="20px" class="iconRecla">Pendientes
								</a>
							</td>
							<!--
							<td align="left" width="7%">
								<a href="index.php?menu_id=105&menu=reclamo_lista&filtro=2">
									<img src="images/view_mail.png" alt="" width="20px" class="iconRecla">Aceptados
								</a>
							</td>
							<td align="left" width="8%">
								<a href="index.php?menu_id=105&menu=reclamo_lista&filtro=3">
									<img src="images/attention.png" alt="" width="20px" class="iconRecla">Rechazados
								</a>
							</td>
							<td align="left" width="9%">
								<a href="index.php?menu_id=105&menu=reclamo_lista&filtro=4">
									<img src="images/module.png" alt="" width="20px" class="iconRecla">Por Confirmar
								</a>
							</td>
							-->
							<td align="left">
								<a href="index.php?menu_id=105&menu=reclamo_lista&filtro=5">
									<img src="images/review.png" alt="" width="20px" class="iconRecla">Solucionados
								</a>
							</td>
						</tr>				
					</table>
				</form>
				<div id="ajaxListRecla">
					<table class="list">
							<thead>
								<tr>
									<td align="center">N° de reclamo</td>
									<td>Tipo reclamo</td>
									<td>Fecha recepcion</td>
									<td>Cliente</td>
									<td>Contacto</td>
									<!--<td>Recepcion</td>-->
									<td>Responsable</td>
									<td>Estado</td>
									<!--<td>Proceso</td>-->
									<td>Detalle</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($dataRecla as $data) { 
									$sql1=sql::getTipReclamoxId($data['idTipReclamo']);
									$sql2=sql::getContacxId($data['idContacReclamo']);
									$sql3=sql::getTrabVendedorxId($data['idRespoReclamo']);
									$sql4=sql::getEstaRecla($data['idEstaReclamo']);
									$sql5=sql::getTrabxId($data['idPersoReclamo']);
									$sql6=sql::getClixContacxCli($data['idEmpReclamo']);
									$linkEdit="index.php?menu_id=102&menu=reclamo_edit&id=".$data['tbrecla_reclamo_id'];
									$linkDet="Javascript:getReclaPopup(".$data['tbrecla_reclamo_id'].",".$data['idEstaReclamo'].")";
									$linkRepor="reporte/reporte_reclamo.php?id=".$data['tbrecla_reclamo_id']."&resp=".negocio::getVal($sql3,'vendedor')."&fech=".$data['fechReclamo'];
								?>	
									<tr>
										<!--<td align="center"><?php #print "RE-".str_pad($data['tbrecla_reclamo_id'],5,'0',STR_PAD_LEFT); ?></td>-->
										<td align="center"><?php print "RE-".(1000+$data['tbrecla_reclamo_id']); ?></td>
										<td><?php print negocio::getVal($sql1,'desTipReclamo'); ?></td>
										<td><?php print $data['fechReclamo']; ?></td>
										<td><?php print negocio::getVal($sql6,'empresa'); ?></td>
										<td><?php print negocio::getVal($sql2,'contacto'); ?></td>
										<!--<td><?php print negocio::getVal($sql5,'vendedor'); ?></td>-->
										<td><?php print negocio::getVal($sql3,'vendedor'); ?></td>
										<td><?php print negocio::getVal($sql4,'desEstaReclamo'); ?></td>
										<!--<td>Proceso</td>-->
										<td>
										<a href="<?php print $linkDet; ?>" >ver</a> |
										<a href="<?php print $linkEdit; ?>" >editar</a> |
										<a href="<?php print $linkRepor; ?>" target="_blank"><img src="images/pdfRepor.png" class="icoRe">Reporte</a>
										</td>
									</tr>
								<?php } ?>
							</tbody>				
					</table>
				</div>							
			</div>
			<div class="pagination"></div>
		</div>			
	</div>
</div>

<div id="ajaxConfirRecla"></div>

<div id="dialog" title="Detalle de Reclamo" class="popupRecla">
	<div id="ajaxDetRecla">
	<p></p>
	</div>
</div>