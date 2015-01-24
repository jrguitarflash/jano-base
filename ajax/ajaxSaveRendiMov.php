<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* INICIAR PARAMETROS */

$desGas=$_POST['desGas'];
$montGas=$_POST['montGas'];
$moneGas=$_POST['moneGas'];
$idMov=$_POST['idMov'];
$idDet=$_POST['idDet'];

switch($_POST['tare'])
{
	case 'add':
		$sql=sql::mp_addDetGast($desGas,$moneGas,$montGas,$idMov);
		$filAfet=negocio::setData($sql);
	break;

	case 'delete':
		$sql=sql::mp_deleDetGast($idDet);
		$filAfect=negocio::setData($sql);
	break;

	case 'load':
	break;

	default:
	break;
}

/* INICIAR DETALLE DE GASTOS */

$sql=sql::mp_detGastxId($idMov);
$dataDetGast=negocio::getData($sql);

?>

<!-- AJAX LOAD DATA -->

<table class="list" >
	<thead>
		<tr>
			<td>item</td>
			<td>descripcion</td>
			<td>moneda</td>
			<td>monto</td>
			<td>accion</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dataDetGast as $data) { ?>
		<tr>
			<td><?php print $data['item']; ?></td>
			<td><?php print $data['desGast']; ?></td>
			<td><?php print $data['monSig']; ?></td>
			<td><?php print $data['montGast']; ?></td>
			<td align="center" >
				<img src="images/delete.png" width="20px" title="eliminar" class="mp_eliGast" onclick="<?php print "mp_ajaxSaveRendiMov('".$idMov."','delete','".$data['item']."')"; ?>">
			</td>
		</tr>
		<?php } ?>
	</tbody>
	<!--
		<tfoot>
			<tr>
				<td></td>
			</tr>
		</tfoot>
	-->
</table>