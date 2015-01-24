<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* Iniciar Id Fs */
$idFs=$_POST['idFs'];

/* Iniciar Data */
$sql=sql::ce_getFsDetxId($idFs);
$dataFsDet=negocio::getData($sql);

/* Iniciar indice item */
$i=1;

?>

<!-- Ajax Load  -->

<table class="list" >
	<thead>
		<tr>
			<td>Item</td>
			<td>Descripcion</td>
			<td>Moneda</td>
			<td>Unidad</td>
			<td>Precio Unit.</td>
			<td>Cantidad</td>
			<td>Precio Tot.</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dataFsDet as $data) { ?>
		<tr>
			<!--<td><?php #print $data['itemDet']; ?></td>-->
			<td><?php print $i++; ?></td>
			<td><?php print $data['des']; ?></td>
			<td><?php print $data['mone']; ?></td>
			<td><?php print $data['unid']; ?></td>
			<td><?php print $data['preUnit']; ?></td>
			<td><?php print $data['cant']; ?></td>
			<td><?php print $data['tot']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table> 