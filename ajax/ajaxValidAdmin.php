<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::mp_validAdm($_POST['detId'],$_POST['aprobId']);
$dataDetValid=negocio::getData($sql);

?>

<!-- LOAD AJAX DATA -->

<table class="list" >
	<thead>
		<tr>
			<td>Validacion</td>
			<td>Usuario</td>
			<td>Fecha</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dataDetValid as $data){ ?>
		<tr>
			<td><?php print $data['desAprob']; ?></td>
			<td><?php print $data['userAdm']; ?></td>
			<td><?php print $data['fechVali']; ?></td>
		</tr>
		<?php }?>
	</tbody>
	<!--
	<tfoot>
		<tr>
			<td>Validacion</td>
			<td>Usuario</td>
			<td>Fecha</td>
		</tr>
	</tfoot>
	-->
</table>