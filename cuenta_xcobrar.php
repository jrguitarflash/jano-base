<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador.js"></script>


<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

<div class="box">
	<div class="heading">
		<h1>
			Cuentas por cobrar - Lista	
		</h1>
	</div>
	<div class="content">
		<div id="lista_199"> 
			<div class="lista">
				<form name="filCuxCob" method="post">
					<table id="filtros" class="filter">
						<tr>
							<td width="20%"><input type="text" name="des" class="des"></td>
							<td width="5%" align="left"><input type="radio" name="opci" value="ruc">ruc</td> 
							<td width="5%"><input type="radio" name="opci" value="cli" >cliente</td>
							<td width="5%"><input type="radio" name="opci" value="tod">todos</td>
							<td align="left" width="5%"><input type="submit" name="bus" value="buscar" class="buscar"></td>
							<td align="left" width="10%">
								<a href="index.php?menu_id=109&menu=cuentax_form">
									<img src="images/add.png" alt="" width="20px" class="iconRecla">Agregar Cuenta
								</a>
							</td>
							<td></td>
						</tr>				
					</table>
				</form>
				<table class="list">
						<thead>
							<tr>
								<td align="center">N° Cuenta</td>
								<td>Ruc</td>
								<td>Cliente</td>
								<td>N° comprobante</td>
								<td>Tipo Doc.</td>
								<td>Tipo Moneda</td>
								<td>Importe</td>
								<td>Porcentaje</td>
								<td>Fecha</td>
								<td>Descripcion</td>
								<td>Estado</td>
								<td>Accion</td>
							</tr>
						</thead>
						<tbody>
								<?php foreach($cuenxCobra as $data) { 
									$sql1=sql::getClixContacxCli($data['idEmpCli']);
									$sql2=sql::getDocCuxId($data['idTipDoc']);
									$sql3=sql::getMonxId($data['idTipMone']);	
									$sql4=sql::getSumCuCance($data['idCuxCobra']);
									$sumCu=negocio::valFinSumCuxCob(negocio::getVal($sql4,'sumCance'));
									$porCu=negocio::calcuPorCuxCob($data['impor'],$sumCu);
									$esta=negocio::mosEstaCuxCob($porCu);
									$accEdit="index.php?menu_id=109&menu=cuentax_edit&idCu=".$data['idCuxCobra'];						
								?>
								<tr>
									<td align="center"><?php print $data['idCuxCobra']; ?> </td>
									<td><?php print negocio::getVal($sql1,'ruc'); ?></td>
									<td><?php print negocio::getVal($sql1,'empresa'); ?></td>
									<td><?php print $data['numCompro']; ?></td>
									<td><?php print negocio::getVal($sql2,'descrip'); ?></td>
									<td><?php print negocio::getVal($sql3,'mon_sigla'); ?></td>
									<td><?php print $data['impor']; ?></td>
									<td><?php print number_format($porCu,2)." %"; ?></td>
									<td><?php print $data['fecha'] ?></td>
									<td><?php print $data['descrip'] ?></td>
									<td><?php print $esta; ?></td>
									<td><a href="<?php print $accEdit; ?>">Editar</a></td>
								</tr>
								<?php } ?>
						</tbody>				
				</table>							
			</div>
			<div class="pagination"></div>
		</div>			
	</div>
</div>
