<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::deleteObsReclaxId($_POST['idObs']);
$rowObsAfec=negocio::setData($sql);

if($_POST['opci']!='') 
{
	switch($_POST['opci']) 
	{
		case 'cod':
			$sql=sql::getObsReclaxCod($_POST['des']);
			$dataObsRecla=negocio::getData($sql);
		break;
		
		case 'cli':
			$sql=sql::getObsReclaxCli($_POST['des']);
			$dataObsRecla=negocio::getData($sql);
		break;
		
		case 'tod':
			$sql=sql::getObsRecla($_POST['des']);
			$dataObsRecla=negocio::getData($sql);
		break;
	}
}
else 
{
		$sql=sql::getObsRecla();
		$dataObsRecla=negocio::getData($sql);					
}

?>

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
				$acciBorra="Javascript:borrarObsRe('".$data['idObs']."','".$_POST['opci']."','".$_POST['des']."')";
				$acciEdit="Javascript:editaObsRe('".$data['idObs']."');"								
			?>
			<tr>
				<td align="center"><?php print $data['codNum']; ?></td>
				<td align="center"><?php print $data['desSitu']; ?></td>
				<td><?php print $data['correc']; ?></td>
				<td><?php print $data['cliEmp']; ?></td>
				<td><?php print $data['contac']; ?></td>
				<td><?php print $data['respo']; ?></td>
				<td><?php print $data['regis']; ?></td>
				<td align="center"><a href="#" >Doc - Codigo N°</a></td>
				<td><?php print $data['controFre']; ?></td>
				<td>
					<a href="<?php print $acciEdit; ?>">Editar</a> | 
					<a href="<?php print $acciBorra; ?>">Borrar</a>
				</td>
			</tr>
			<?php }?>
		</tbody>				
</table>
		
