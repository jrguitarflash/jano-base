<?php

require('../conf.php');
require('../clases/negocio/negocio.class.php');
require('../clases/sql/sql.class.php');

$sql=sql::fp_cotiAct($_POST['valVendId']);
$data_cotiAct=negocio::getData($sql);

?>

<table class="list" >
	<thead>
		<tr>
			<td></td>
			<td>FL</td>
			<td>CLIENTE</td>
			<td>PROYECTO</td>
			<td>MONTO</td>
			<td>FIANZA</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_cotiAct as $data) { ?>
		<tr>
			<td align="center" ><input type="checkbox" value="<?php print $data['cotiId']; ?>" name="cotiId[]" id="cotiId" ></td>
			<td><?php print $data['fl']; ?></td>
			<td><?php print $data['cliente']; ?></td>
			<td><?php print $data['proyecto']; ?></td>
			<td width="10%" ><?php print $data['mone'].' '.number_format($data['monto'],2); ?></td>
			<td width="20%" >
				<?php print $data['fianAde']; ?>
				<br><br>
				<?php print $data['fianFiel']; ?>
				<br><br>
				<?php print $data['fianNo']; ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
	<tfoot>
	</tfoot>
</table>