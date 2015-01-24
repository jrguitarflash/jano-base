<?php

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

session_start();

$cadVec=negocio::concatVect($_POST['getVectContac']);

#print $cadVec;

//------------------ GESTION DATAGRID ----------------------------//

	if($_POST['idVisi']==0)
	{

		switch($_POST['tareDet']) 
		{
				case 'agreDet':

					if(isset($_SESSION['indice']))
					{
						$_SESSION['indice']++;
						$ind=$_SESSION['indice'];
						$_SESSION['detVisi'][$ind]['indice']=$ind;
						$_SESSION['detVisi'][$ind]['empresa']=$_POST['getValEmp'];
						$_SESSION['detVisi'][$ind]['contacto']=$_POST['getValContac'];
						$_SESSION['detVisi'][$ind]['observacion']=$_POST['getValObs'];
						$_SESSION['detVisi'][$ind]['observacionPen']=$_POST['getValObsPen'];
						$_SESSION['detVisi'][$ind]['contactoConcat']=$cadVec;
						$_SESSION['detVisi'][$ind]['direccion']=$_POST['getValDire'];
						
						//-- add dir origen & fech visi--//
						$_SESSION['detVisi'][$ind]['dirOrig']=$_POST['valDirOrig'];
						$_SESSION['detVisi'][$ind]['fechVisi']=$_POST['valFechVisi'];
						//-- [*] --//
						
						$detVisi=$_SESSION['detVisi'];
					}
					else
					{
						//unset($_SESSION['indice']);
						//unset($_SESSION['detVisi']);
						$_SESSION['indice']=0;
						$ind=$_SESSION['indice'];
						$_SESSION['detVisi'][$ind]['indice']=$ind;
						$_SESSION['detVisi'][$ind]['empresa']=$_POST['getValEmp'];
						$_SESSION['detVisi'][$ind]['contacto']=$_POST['getValContac'];
						$_SESSION['detVisi'][$ind]['observacion']=$_POST['getValObs'];
						$_SESSION['detVisi'][$ind]['observacionPen']=$_POST['getValObsPen'];
						$_SESSION['detVisi'][$ind]['contactoConcat']=$cadVec;
						$_SESSION['detVisi'][$ind]['direccion']=$_POST['getValDire'];
						
						//-- add dir origen & fech visi--//
						$_SESSION['detVisi'][$ind]['dirOrig']=$_POST['valDirOrig'];
						$_SESSION['detVisi'][$ind]['fechVisi']=$_POST['valFechVisi'];
						//-- [*] --//

						$detVisi=$_SESSION['detVisi'];
					}
				
				break;

				case 'borraDet':
						unset($_SESSION['detVisi'][$_POST['getVal']]);
						unset($_SESSION['indice'][$_POST['getVal']]);
						//$_SESSION['indice']=$_SESSION['indice']-1;
						$detVisi=$_SESSION['detVisi'];
				break;
				
				case 'borraTod':
						unset($_SESSION['detVisi']);
						unset($_SESSION['indice']);
						$detVisi=array();
				break;
		}
	}
	else
	{

		$sql=sql::getIdxCli($_POST['getValEmp']);
		$idCli=negocio::getVal($sql,'empresa_id');

		desconectar();
		conectar();

		$sql=sql::vi_detVi_cre($_POST['idVisi'],
								$cadVec,
								$_POST['getValObs'],
								$idCli,
								$_POST['getValObs'],
								$_POST['getValDire'],
								$_POST['valDirOrig'],
								$_POST['valFechVisi'],
								0);
		
		$detAfect=negocio::getVal($sql,'response');
		

		//$sql="abc";
	}

?>

<!-- ---------------- DATAGRID ----------------------- -->

	<?php if($_POST['idVisi']==0) { ?>

		<table class="list">
			<thead>
				<tr>
					<td>Id</td>
					<td>Empresa</td>
					<!--<td>Contacto</td>-->
					<td>Contactos</td>
					<td>Observacion por actividades</td>
					<td>Observacion pendientes</td>
					<td>Fecha Visita</td>
					<td>Direccion Origen</td>
					<td>Direccion Empresa</td>
					<td>Accion</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					 $i=0;
					 foreach($detVisi as $detVisi=>$key)
					 { 
					 $i++;
					 $sql1=sql::getContacxClixId($key['empresa'],$key['contacto']);
					 /* $sqlProd=$sqlCapa->consulDatProd($key['idProd']); */
					$resContacs="";
					$cadVecSep=explode(' ',$key['contactoConcat']);
					  
					for($j=0;$j<count($cadVecSep);$j++) 
					{
					 	$sql2=sql::getContacxId($cadVecSep[$j]);
					 	$resContacs=$resContacs."<br/>".negocio::getVal($sql2,'contacto');
					}
				 ?>
					<tr id="cuerpoTab">
						<td><?php echo str_pad($i,1,'0',STR_PAD_LEFT); ?></td>
						<td><?php echo $key['empresa'];?></td>
					   <!--<td><?php echo negocio::getVal($sql1,'contacto'); ?></td>-->
					   <td><?php echo $resContacs; ?></td>
					   <td><?php echo $key['observacion']; ?></td>
					   <td><?php echo $key['observacionPen']; ?></td>
					   <td><?php echo $key['fechVisi'] ?></td>
					   	<td><?php echo $key['dirOrig'] ?></td>
					   <td><?php echo $key['direccion']; ?></td>
						<td><?php echo "<a href=Javascript:setEliVisit('borraDet',".$key['indice'].")>eliminar</a>"; ?></td>
					</tr>	
				<?php } ?>
			</tbody>
		</table>

	<?php } else { ?>

		<?php print $sql; ?>

	<?php } ?>



