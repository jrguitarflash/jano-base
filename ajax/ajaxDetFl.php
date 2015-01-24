<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::cc_geneFl($_POST['valFl']);
$valFl=negocio::getVal($sql,'cotizacion_id');

$sql=sql::cc_detFl($valFl);
$dataDetFl=negocio::getData($sql);

session_start();

$_SESSION['arrCotiFl']=$dataDetFl;

$arrCotiFl=Array();

$arrCotiFl=$_SESSION['arrCotiFl'];

?>

<!-- DATA LOAD AJAX -->


<table class="list" >
	<thead>
		<tr>
			<td>Item</td>
			<td>Clasificacion</td>
			<td>Producto/Servicio</td>
			<td>Descripcion</td>
			<td>Modelo</td>
			<td>Marca</td>
			<td>Moneda</td>
			<td>Cantidad</td>
			<td>Precio Unid.</td>
			<td>Total</td>
			<td>Proveedor</td>
			<td>Plazo</td>
			<td align="center" >Accion</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($_SESSION['arrCotiFl'] as $data) { ?>
		<tr>
			<td><?php print $data['cotDetId']; ?></td>
			<td><?php print negocio::getClasifProd($data['prod_clasificacion_id']); ?></td>
			<td><?php print negocio::getProdxId($data['producto_id']); ?></td>
			<td><?php print $data['pro_descripcion']; ?></td>
			<td><?php print negocio::getMarMod($data['producto_id'],'modelo'); ?></td>
			<td><?php print negocio::getMarMod($data['producto_id'],'marca'); ?></td>
			<td><?php print negocio::getMonexId($data['moneda_id']); ?></td>
			<td><?php print $data['cant']; ?></td>
			<td><?php print $data['preUni']; ?></td>
			<td><?php print $data['subTot']; ?></td>
			<td><?php print negocio::getProvexId($data['proveedorId']); ?></td>
			<td><?php print $data['plazo']; ?></td>
			<td align="center" >
				<a href="<?php print "Javascript:cc_openEditFl('".$data['cotDetId']."');" ?>" >Editar</a> |
				<a href="<?php print "Javascript:cc_ajaxGestDetFl('".$data['cotDetId']."','delete');" ?>">Eliminar</a>
			</td>
		</tr>
		<?php } ?>
		<?php  print negocio:: evaCotiFl($arrCotiFl); ?>
	</tbody>
</table>



