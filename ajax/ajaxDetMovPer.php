<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::mp_detMovShow($_POST['idMov']);
$dataDetMov=negocio::getData($sql);

?>

<!-- LOAD AJAX DATA -->

	<table class="list" >
		<thead>
			<tr>
				<!--<td rowspan="2" ></td>-->
				<td rowspan="2" >item</td>
				<td rowspan="2" >motivo</td>
				<td rowspan="2" >ubicacion</td>
				<td rowspan="2" >detalle</td>
				<!--
					<td rowspan="1" colspan="2" align="center" >validacion</td>
				-->
			</tr>
			<!--
				<tr>
					<td colspan="1" >Aceptadas</td>
					<td colspan="1" >Rechazadas</td>
				</tr>
			-->
		</thead>
		<tbody>
			<?php foreach($dataDetMov as $data){ ?>
			<tr>
				<!--
					<td align="center" >
						<input type="checkbox"  value="<?php #print $data['item']; ?>" id="idDetMov" name="idDetMov[]" >
					</td>
				-->
				<td align="center" ><?php print $data['item']; ?></td>
				<td><?php print $data['motiv']; ?></td>
				<td><?php print $data['ubi']; ?></td>
				<td><?php print $data['det']; ?></td>
				<!--
					<td align="center" >
						<a href="<?php #print "Javascript:mp_openPopup2('".$data['item']."','1')"; ?>" >
							<?php #print $data['cantVali']; ?>
						</a>
					</td>
					<td align="center" >
						<a href="<?php #print "Javascript:mp_openPopup2('".$data['item']."','2')"; ?>" >
							<?php #print $data['rechaVali']; ?>
						</a>
					</td>
				-->
			</tr>
			<?php } ?>
		</tbody>
		<!--
			<tfoot>
				<tr>
					<td>item</td>
				</tr>
			</tfoot>
		-->
	</table>

	