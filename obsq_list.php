<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador5.js"></script>


<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

<div class="box">
	<div class="heading">
		<h1>
			Observacion - Queja
		</h1>
	</div>
	<div class="content">
		<div id="lista_199"> 
			<div class="lista">
				<form name="filRecla" method="post">
					<table id="filtros" class="filter">
						<tr>
							<td width="20%"><input type="text" name="des" class="des"></td>
							<td width="5%" align="left"><input type="radio" name="opci" value="cod">codigo</td> 
							<td width="5%"><input type="radio" name="opci" value="cli" >cliente</td>
							<td width="5%"><input type="radio" name="opci" value="tod">todos</td>
							<td align="left" width="5%"><input type="submit" name="bus" value="buscar" class="buscar"></td>
							<td align="left" width="10%">
								<a href="index.php?menu_id=112&menu=obsq_form">
									<img src="images/add.png" alt="" width="20px" class="iconRecla">Agregar Queja
								</a>
							</td>
							<td></td>
						</tr>				
					</table>
				</form>
				<div id="ajaxListRecla">
					<table class="list">
							<thead>
								<tr>
									<td align="center">Codigo N°</td>
									<td>Fecha</td>
									<td>Descripcion</td>
									<td>Solucion inmediata</td>
									<td>Cliente</td>
									<td>Contacto</td>
									<td>Responsable</td>
									<td>Accion</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($dataObsQueja as $data){ 
								
										$acciBorra="Javascript:borrarObsQue('".$data['idObs']."','".$_POST['des']."','".$_POST['opci']."');";
										$acciEdit="Javascript:editaObsQue('".$data['idObs']."')";								
								?>
								<tr>
									<td align="center"><?php print $data['codNum']; ?></td>
									<td><?php print $data['controFre']; ?></td>
									<td><?php print $data['desSitu']; ?></td>
									<td><?php print $data['soluInme']; ?></td>
									<td><?php print $data['cliEmp']; ?></td>
									<td><?php print $data['contac']; ?></td>
									<td><?php print $data['respo']; ?></td>
									<td><a href="<?php print $acciEdit; ?>">Editar</a> | <a href="<?php print $acciBorra; ?>">Borrar</a></td>
								</tr>
								<?php }?>
							</tbody>				
					</table>
				</div>							
			</div>
			<div class="pagination"></div>
		</div>			
	</div>
</div>