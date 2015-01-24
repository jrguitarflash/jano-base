<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

// Iniciar identificador de cotizacion servicios
$idCotServ=$_POST['idCotServ'];

// Obtener data detalle cotizacion
$sql=sql::cs_detCotServ($idCotServ);
$dataDetCotServ=negocio::getData($sql);

?>

<!-- Ajax load data -->

<table class="list" >
	<thead>
		<tr>
			<td colspan="8" align="right">
				<img src="images/add.png" width="20px" title="Nuevo detalle" onclick="cs_loadEvent('nuevDet');">
			</td>
		</tr>
		<tr>
			<td align="center" >Item</td>
			<td>Tipo</td>
			<td>Descripcion</td>
			<td>Unidad</td>
			<td>P.Unitario</td>
			<td>Cantidad</td>
			<td>P.Total</td>
			<td align="center" >Accion</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dataDetCotServ as $data) { ?>
		<tr>
			<td align="center" ><?php print $data['detCotiServId']; ?></td>
			<td><?php print $data['desTipDet']; ?></td>
			<td><?php print $data['desDetCoti']; ?></td>
			<td><?php print $data['unidDetCoti']; ?></td>
			<td><?php print $data['preUniDet']; ?></td>
			<td><?php print $data['cantDetCoti']; ?></td>
			<td><?php print $data['totDetCoti']; ?></td>
			<td align="center" >
				<img src="images/b_edit.png" 
					width="20px" 
					title="Editar detalle"
					onclick="<?php print "cs_loadEvent('nuevDet','".$data['detCotiServId']."','edit')"; ?>">
				<img src="images/b_drop.png" 
					width="20px" 
					title="Eliminar detalle" 
					onclick="<?php print "Javascript:cs_loadEvent('saveDet','".$data['detCotiServId']."','delete')"; ?>" >
			</td>
		</tr>
		<?php }?>
	</tbody>
	<!--
	<tfoot></tfoot>
	-->
</table>