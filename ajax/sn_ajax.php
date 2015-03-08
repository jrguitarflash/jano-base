<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

switch ($_POST['ajax']) 
{
	case 'sn_numSerixId_obte':
		$sql=sql::sn_numSerixId_obte($_POST['idDetComp']);
		$data1=negocio::getData($sql);
		$ind=1;
	break;
	
	default:
	# code...
	break;
}

?>

<table class="list">
	<thead>
		<tr>
			<td>Item</td>
			<td>Fecha Ingreso</td>
			<td>Fecha Almacen</td>
			<td>N° serie</td>
			<!--<td>Accion</td>-->
		</tr>
	</thead>
	<tbody>
		<?php foreach($data1 as $data) { ?>
		<tr>
			<td><?php print $ind++; ?></td>
			<td><?php print $data['fechIng']; ?></td>
			<td><?php print $data['fechAlm']; ?></td>
			<td><?php print $data['numSeri']; ?></td>
			<!--<td><a href="<?php #print "Javascript:sn_eliNumSeri('".$data['numSeriId']."')"; ?>">Eliminar</a></td>-->
		</tr>
		<?php } ?>
	</tbody>
	<!--<tfoot></tfoot>-->
</table>