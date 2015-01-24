<?php

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

session_start();


//------------------GESTION DATAGRID----------------------------//

switch($_POST['tareDet']) 
{
		case 'agreDet':
			if(isset($_SESSION['indice']))
			{
				$_SESSION['indice']++;
				$ind=$_SESSION['indice'];
				$_SESSION['detCuen'][$ind]['indice']=$ind;
				$_SESSION['detCuen'][$ind]['cuenta']=$_POST['getValCuen'];
				$_SESSION['detCuen'][$ind]['fecha']=$_POST['getValFecha'];
				$_SESSION['detCuen'][$ind]['monto']=$_POST['getValMonto'];
				$_SESSION['detCuen'][$ind]['estado']=$_POST['getValEsta'];
				$detCuen=$_SESSION['detCuen'];
			}
			else
			{
				//unset($_SESSION['indice']);
				//unset($_SESSION['detVisi']);
				$_SESSION['indice']=0;
				$ind=$_SESSION['indice'];
				$_SESSION['detCuen'][$ind]['indice']=$ind;
				$_SESSION['detCuen'][$ind]['cuenta']=$_POST['getValCuen'];
				$_SESSION['detCuen'][$ind]['fecha']=$_POST['getValFecha'];
				$_SESSION['detCuen'][$ind]['monto']=$_POST['getValMonto'];
				$_SESSION['detCuen'][$ind]['estado']=$_POST['getValEsta'];
				$detCuen=$_SESSION['detCuen'];
			}
		break;

		case 'borraDet':
				unset($_SESSION['detCuen'][$_POST['getVal']]);
				unset($_SESSION['indice'][$_POST['getVal']]);
				//$_SESSION['indice']=$_SESSION['indice']-1;
				$detCuen=$_SESSION['detCuen'];
		break;
		
		case 'borraTod':
				unset($_SESSION['detCuen']);
				unset($_SESSION['indice']);
				$detCuen=array();
		break;
}
?>

<!-- ----------------DATAGRID----------------------- -->

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
			 foreach($detCuen as $detCuen=>$key)
			 { 
			 $i++;
			 $sql1=sql::getEstCuxId($key['estado']);
			 $sql2=sql::getBancoxId($key['cuenta']);
			 $sql3=sql::getBancoxId($key['cuenta']);
		?>
			<tr id="cuerpoTab">
				<td><?php echo str_pad($i,1,'0',STR_PAD_LEFT); ?></td>
				<td><?php echo negocio::getVal($sql2,'banco_nombre'); ?></td>
			   <td><?php echo negocio::getVal($sql2,'cuenta_nro'); ?></td>
			   <td><?php echo $key['fecha']; ?></td>
			   <td><?php echo $key['monto']; ?></td>
			   <td><?php echo negocio::getVal($sql1,'descrip'); ?></td>
				<td><?php echo "<a href=Javascript:setEliCuen('borraDet',".$key['indice'].")>eliminar</a>"; ?></td>
			</tr>	
		<?php } ?>
	</tbody>
</table>

