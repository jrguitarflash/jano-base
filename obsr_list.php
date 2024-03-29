<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador5.js"></script>


<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

<div class="box">
	<div class="heading">
		<h1>
			Observacion - Reclamos	
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
								<a href="index.php?menu_id=111&menu=obsr_form">
									<img src="images/add.png" alt="" width="20px" class="iconRecla">Agregar Reclamo
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
									<td align="center">Descripcion de situación</td>
									<td>Correción</td>
									<td>Cliente</td>
									<td>Contacto</td>
									<td>Responsable</td>
									<td>Registro</td>
									<td align="center">Documento asociado</td>
									<td>Control de frecuencia</td>
									<td>Accion</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($dataObsRecla as $data){ 
									$acciBorra="Javascript:borrarObsRe('".$data['idObs']."','".$_POST['opci']."','".$_POST['des']."');";
									$acciEdit="Javascript:editaObsRe('".$data['idObs']."');";
									$acciGeneRepo="Javascript:geneObsRecla('".$data['idObs']."');";								
								?>
								<tr>
									<td align="center"><?php print $data['codNum']; ?></td>
									<td align="center"><?php print $data['desSitu']; ?></td>
									<td><?php print $data['correc']; ?></td>
									<td><?php print $data['cliEmp']; ?></td>
									<td><?php print $data['contac']; ?></td>
									<td><?php print $data['respo']; ?></td>
									<td><?php print $data['regis']; ?></td>
									<td align="center"><a href="<?php print $acciGeneRepo; ?>" >Doc - Codigo N°</a></td>
									<td><?php print $data['controFre']; ?></td>
									<td>
										<a href="<?php print $acciEdit; ?>">Editar</a> | 
										<a href="<?php print $acciBorra; ?>">Borrar</a>
									</td>
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