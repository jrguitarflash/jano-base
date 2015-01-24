<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//echo $_POST['dataCuxCob']['idCu'];

if($_POST['tare']=='add') 
{
	$sql=sql::insertDetCuen($_POST['dataCuxCob'][0],$_POST['dataCuxCob'][2],$_POST['dataCuxCob'][3],$_POST['dataCuxCob'][1],$_POST['dataCuxCob'][4]);
	$cuenDetAfect=$cuenDetAfect+negocio::setData($sql);
}
else if ($_POST['tare']=='eli')
{
	$sql=sql::eliDetCuxCob($_POST['idDet']);
	$detCuAfec=negocio::setData($sql);
}
else if ($_POST['tare']=='actu')
{
	$sql=sql::updateDetCuen($_POST['dataCuxCob'][0],$_POST['dataCuxCob'][2],$_POST['dataCuxCob'][3],$_POST['dataCuxCob'][1],$_POST['dataCuxCob'][4],$_POST['idDet']);
	$detCuAfec=negocio::setData($sql);
}
else
{
	print "ninguna accion";
}

$sql=sql::getDetCuenxId($_POST['dataCuxCob'][0]);
$detCuen=negocio::getData($sql);

?>

<table class="list">
			<thead>
			<tr>
				<td>Item</td>
				<td>Banco</td>
				<td>Cuenta</td>
				<td>Fecha</td>
				<td>Monto</td>
				<td>Estado</td>
				<td>Accion</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$i=0; 
			foreach($detCuen as $data){
			$i++;
			$sql1=sql::getEstCuxId($data['idCuEstado']);
			$sql2=sql::getBancoxId($data['idCuBanco']);
			$sql3=sql::getBancoxId($data['idCuBanco']);
			$eli="Javascript:ajaxAgreDetCu('eli','".$data['idDetxCobra']."');";
			$edit="Javascript:getEditCuen('".$data['idDetxCobra']."')";
			?>
				<tr>
					<td><?php print $i; ?></td>
					<td><?php print negocio::getVal($sql2,'banco_nombre'); ?></td>
					<td><?php print negocio::getVal($sql2,'cuenta_nro'); ?></td>
					<td><?php print $data['fecha']; ?></td>
					<td><?php print $data['monto']; ?></td>
					<td><?php print negocio::getVal($sql1,'descrip'); ?></td>
					<td>
					<a href="<?php print $eli; ?>" class="eliAmor">Eliminar</a> | 
					<a href="<?php print $edit; ?>" class="eliAmor">Editar</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
</table>	