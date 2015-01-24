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
			$sql=sql::getObsQuejaxCod($_POST['des']);
			$dataObsQueja=negocio::getData($sql);
		break;
		
		case 'cli':
			$sql=sql::getObsQuejaxCli($_POST['des']);
			$dataObsQueja=negocio::getData($sql);
		break;
		
		case 'tod':
			$sql=sql::getObsQueja($_POST['des']);
			$dataObsQueja=negocio::getData($sql);
		break;
	}
}
else 
{
		$sql=sql::getObsQueja();
		$dataObsQueja=negocio::getData($sql);					
}

?>

<table class="list">
		<thead>
			<tr>
				<td align="center">Codigo N°</td>
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
			?>
			<tr>
				<td align="center"><?php print $data['codNum']; ?></td>
				<td><?php print $data['desSitu']; ?></td>
				<td><?php print $data['soluInme']; ?></td>
				<td><?php print $data['cliEmp']; ?></td>
				<td><?php print $data['contac']; ?></td>
				<td><?php print $data['respo']; ?></td>
				<td><a href="#">Editar</a> | <a href="<?php print $acciBorra; ?>">Borrar</a></td>
			</tr>
			<?php }?>
		</tbody>				
</table>
		
