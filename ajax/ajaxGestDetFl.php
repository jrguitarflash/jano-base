<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


session_start(); 

/* CREAMOS EL ARRAY Y INDICE */
$dataDetFl=Array();
$i=0;

/* INICIAMOS LA ACCION, tamaño actual Y EL ID */

$acciGrid=$_POST['acciGrid'];
$idDet=$_POST['idDet'];
$tamAct=count($_SESSION['arrCotiFl']);

/* EVALUAMOS ACCIONES A REALIZAR */

switch ($acciGrid) 
{
	case 'edit':
		# edito...! :)
		foreach ($_SESSION['arrCotiFl'] as $data) 
		{
			if($data['cotDetId']==$idDet)
			{
				$dataDetFl[$i]['cotDetId']=$data['cotDetId'];
				$dataDetFl[$i]['prod_clasificacion_id']=$_POST['clasiId'];
				$dataDetFl[$i]['producto_id']=$_POST['idProd'];
				$dataDetFl[$i]['moneda_id']=$_POST['moneId'];
				$dataDetFl[$i]['cant']=$_POST['cant'];
				$dataDetFl[$i]['preUni']=$_POST['preUni'];
				$dataDetFl[$i]['subTot']=$_POST['cant']*$_POST['preUni'];
				$dataDetFl[$i]['proveedorId']=$_POST['proveId'];
				$dataDetFl[$i]['plazo']=$_POST['plazo'];
				$dataDetFl[$i]['pro_descripcion']=$_POST['desProdServ'];
			}
			else
			{
				$dataDetFl[$i]['cotDetId']=$data['cotDetId'];
				$dataDetFl[$i]['prod_clasificacion_id']=$data['prod_clasificacion_id'];
				$dataDetFl[$i]['producto_id']=$data['producto_id'];
				$dataDetFl[$i]['moneda_id']=$data['moneda_id'];
				$dataDetFl[$i]['cant']=$data['cant'];
				$dataDetFl[$i]['preUni']=$data['preUni'];
				$dataDetFl[$i]['subTot']=$data['subTot'];
				$dataDetFl[$i]['proveedorId']=$data['proveedorId'];
				$dataDetFl[$i]['plazo']=$data['plazo'];
				$dataDetFl[$i]['pro_descripcion']=$data['pro_descripcion'];
			}
			$i++;
		}
	break;
	
	case 'add':
		# agrego...! :)

		/* LLENADO DE ARRAY POR DEFECTO */

		foreach ($_SESSION['arrCotiFl'] as $data) 
		{
			$dataDetFl[$i]['cotDetId']=$data['cotDetId'];
			$dataDetFl[$i]['prod_clasificacion_id']=$data['prod_clasificacion_id'];
			$dataDetFl[$i]['producto_id']=$data['producto_id'];
			$dataDetFl[$i]['moneda_id']=$data['moneda_id'];
			$dataDetFl[$i]['cant']=$data['cant'];
			$dataDetFl[$i]['preUni']=$data['preUni'];
			$dataDetFl[$i]['subTot']=$data['subTot'];
			$dataDetFl[$i]['proveedorId']=$data['proveedorId'];
			$dataDetFl[$i]['plazo']=$data['plazo'];
			$dataDetFl[$i]['pro_descripcion']=$data['pro_descripcion'];

			if($i==($tamAct-1))
			{
				$dataDetFl[$tamAct]['cotDetId']=$data['cotDetId']+1;
				$dataDetFl[$tamAct]['prod_clasificacion_id']=$_POST['clasiId'];
				$dataDetFl[$tamAct]['producto_id']=$_POST['idProd'];
				$dataDetFl[$tamAct]['moneda_id']=$_POST['moneId'];
				$dataDetFl[$tamAct]['cant']=$_POST['cant'];
				$dataDetFl[$tamAct]['preUni']=$_POST['preUni'];
				$dataDetFl[$tamAct]['subTot']=$_POST['cant']*$_POST['preUni'];
				$dataDetFl[$tamAct]['proveedorId']=$_POST['proveId'];
				$dataDetFl[$tamAct]['plazo']=$_POST['plazo'];
				$dataDetFl[$tamAct]['pro_descripcion']=$_POST['desProdServ'];
			}

			$i++;
		}

	break;

	case 'delete':
		# borro...! :)
		foreach ($_SESSION['arrCotiFl'] as $data) 
		{
			if($data['cotDetId']==$idDet)
			{
				$i=$i;
			}
			else
			{
				$dataDetFl[$i]['cotDetId']=$data['cotDetId'];
				$dataDetFl[$i]['prod_clasificacion_id']=$data['prod_clasificacion_id'];
				$dataDetFl[$i]['producto_id']=$data['producto_id'];
				$dataDetFl[$i]['moneda_id']=$data['moneda_id'];
				$dataDetFl[$i]['cant']=$data['cant'];
				$dataDetFl[$i]['preUni']=$data['preUni'];
				$dataDetFl[$i]['subTot']=$data['subTot'];
				$dataDetFl[$i]['proveedorId']=$data['proveedorId'];
				$dataDetFl[$i]['plazo']=$data['plazo'];
				$dataDetFl[$i]['pro_descripcion']=$data['pro_descripcion'];
				$i++;
			}
		}
	break;

	default:
		# nada...! :(
	break;
}

/* ELIMINAMOS SESION INICIAL Y GENERAMOS EL NUEVO ARRAY SESION */

unset($_SESSION['arrCotiFl']);
$_SESSION['arrCotiFl']=$dataDetFl;


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
		<?php  print negocio:: evaCotiFl($_SESSION['arrCotiFl']); ?>
	</tbody>
</table>




