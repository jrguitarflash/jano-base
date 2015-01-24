<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

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
$idMovPer=$_POST['idMovPer'];
$tamAct=count($_SESSION['arrMovPer']);

/* EVALUAMOS ACCIONES A REALIZAR */

switch ($acciGrid) 
{
	case 'edit':
		# edito...! :)
		foreach ($_SESSION['arrMovPer'] as $data) 
		{
			if($data['idDet']==$idDet)
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['motiv']=$_POST['motiv'];
				$dataDetFl[$i]['ubi']=$_POST['ubi'];
				$dataDetFl[$i]['det']=$_POST['det'];

			}
			else
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['motiv']=$data['motiv'];
				$dataDetFl[$i]['ubi']=$data['ubi'];
				$dataDetFl[$i]['det']=$data['det'];
			}

			$i++;
		}
			$edit='edit';
			$delete='delete';
	break;
	
	case 'add':
		# agrego...! :)

		/* LLENADO DE ARRAY POR DEFECTO */

		if(isset($_SESSION['arrMovPer']) and count($_SESSION['arrMovPer'])>0 )
		{
			foreach ($_SESSION['arrMovPer'] as $data) 
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['motiv']=$data['motiv'];
				$dataDetFl[$i]['ubi']=$data['ubi'];
				$dataDetFl[$i]['det']=$data['det'];


				if($i==($tamAct-1))
				{
					$dataDetFl[$tamAct]['idDet']=$data['idDet']+1;
					$dataDetFl[$tamAct]['motiv']=$_POST['motiv'];
					$dataDetFl[$tamAct]['ubi']=$_POST['ubi'];
					$dataDetFl[$tamAct]['det']=$_POST['det'];
				}

				$i++;
			}
		}
		else
		{
				$dataDetFl[0]['idDet']=0;
				$dataDetFl[0]['motiv']=$_POST['motiv'];
				$dataDetFl[$tamAct]['ubi']=$_POST['ubi'];
				$dataDetFl[$tamAct]['det']=$_POST['det'];
		}

			$edit='edit';
			$delete='delete';

	break;

	case 'delete':
		# borro...! :)
		foreach ($_SESSION['arrMovPer'] as $data) 
		{
			if($data['idDet']==$idDet)
			{
				$i=$i;
			}
			else
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['motiv']=$data['motiv'];
				$dataDetFl[$i]['ubi']=$data['ubi'];
				$dataDetFl[$i]['det']=$data['det'];
				$i++;
			}
		}

			$edit='edit';
			$delete='delete';

	break;

	default:
		# nada...! :(
	break;
}

/* ELIMINAMOS SESION INICIAL Y GENERAMOS EL NUEVO ARRAY SESION */

unset($_SESSION['arrMovPer']);
$_SESSION['arrMovPer']=$dataDetFl;

?>

<!-- AJAX LOAD DATA -->

<table class="list">
	<thead>
		<tr>
			<td align="center" >item</td>
			<td>motivo</td>
			<td>ubicacion</td>
			<td>detalle</td>
			<td align="center" >Accion</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($_SESSION['arrMovPer'] as $data){ ?>
		<tr>
			<td><?php print $data['idDet']; ?></td>
			<td><?php print $data['motiv']; ?></td>
			<td><?php print $data['ubi']; ?></td>
			<td><?php print $data['det']; ?></td>
			<td align="center" >
				<a href="<?php print "Javascript:mp_ajaxGridMovPer('".$data['idDet']."','delete')"; ?>">Eliminar</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
	<!--
		<tfoot>
			<tr>
				<td>item</td>
				<td>motivo</td>
				<td>ubicacion</td>
				<td>detalle</td>
				<td>Accion</td>
			</tr>
		</tfoot>
	-->
</table>