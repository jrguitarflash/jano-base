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
$idCentCost=$_POST['idCentCost'];
$tamAct=count($_SESSION['arrCotiFl']);

/* EVALUAMOS ACCIONES A REALIZAR */

switch ($acciGrid) 
{
	case 'edit':
		# edito...! :)
		foreach ($_SESSION['arrCotiFl'] as $data) 
		{
			if($data['idDet']==$idDet)
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['tipDoc']=$_POST['tipDoc'];
				$dataDetFl[$i]['moneId']=$_POST['moneId'];
				$dataDetFl[$i]['proveId']=$_POST['proveId'];
				$dataDetFl[$i]['plazo']=$_POST['plazo'];
				$dataDetFl[$i]['desOrd']=$_POST['desOrd'];
			}
			else
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['tipDoc']=$data['tipDoc'];
				$dataDetFl[$i]['moneId']=$data['moneId'];
				$dataDetFl[$i]['proveId']=$data['proveId'];
				$dataDetFl[$i]['plazo']=$data['plazo'];
				$dataDetFl[$i]['desOrd']=$data['desOrd'];
			}

			$i++;
		}
			$edit='edit';
			$delete='delete';
	break;
	
	case 'add':
		# agrego...! :)

		/* LLENADO DE ARRAY POR DEFECTO */

		if(isset($_SESSION['arrCotiFl']) and count($_SESSION['arrCotiFl'])>0 )
		{
			foreach ($_SESSION['arrCotiFl'] as $data) 
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['tipDoc']=$data['tipDoc'];
				$dataDetFl[$i]['moneId']=$data['moneId'];
				$dataDetFl[$i]['proveId']=$data['proveId'];
				$dataDetFl[$i]['plazo']=$data['plazo'];
				$dataDetFl[$i]['desOrd']=$data['desOrd'];

				if($i==($tamAct-1))
				{
					$dataDetFl[$tamAct]['idDet']=$data['idDet']+1;
					$dataDetFl[$tamAct]['tipDoc']=$_POST['tipDoc'];
					$dataDetFl[$tamAct]['moneId']=$_POST['moneId'];
					$dataDetFl[$tamAct]['proveId']=$_POST['proveId'];
					$dataDetFl[$tamAct]['plazo']=$_POST['plazo'];
					$dataDetFl[$tamAct]['desOrd']=$_POST['desOrd'];
				}

				$i++;
			}
		}
		else
		{
				$dataDetFl[0]['idDet']=0;
				$dataDetFl[0]['tipDoc']=$_POST['tipDoc'];
				$dataDetFl[0]['moneId']=$_POST['moneId'];
				$dataDetFl[0]['proveId']=$_POST['proveId'];
				$dataDetFl[0]['plazo']=$_POST['plazo'];
				$dataDetFl[0]['desOrd']=$_POST['desOrd'];
		}

			$edit='edit';
			$delete='delete';

	break;

	case 'delete':
		# borro...! :)
		foreach ($_SESSION['arrCotiFl'] as $data) 
		{
			if($data['idDet']==$idDet)
			{
				$i=$i;
			}
			else
			{
				$dataDetFl[$i]['idDet']=$data['idDet'];
				$dataDetFl[$i]['tipDoc']=$data['tipDoc'];
				$dataDetFl[$i]['moneId']=$data['moneId'];
				$dataDetFl[$i]['proveId']=$data['proveId'];
				$dataDetFl[$i]['plazo']=$data['plazo'];
				$dataDetFl[$i]['desOrd']=$data['desOrd'];
				$i++;
			}
		}

			$edit='edit';
			$delete='delete';

	break;

	case 'add2':

		$sql=sql::cc_geneDetCentCost(
								$idCentCost,
								2,
								$_POST['tipDoc'],
								$_POST['proveId'],
								$_POST['moneId'],
								$_POST['plazo'],
								$_POST['desOrd']
								);
		$filAfect=negocio::setData($sql);

		/* GENERAR OC/EW/OS DE CENTRO DE COSTO */

		$idFilAfect3=negocio::getInsertId();
		$sql=sql::cc_getDetCentCostxId($idFilAfect3);
		$dataDetCent=negocio::getData($sql);

		if($dataDetCent[0]['tipDoc']==1 or $dataDetCent[0]['tipDoc']==2)
		{

			/* GENERAMOS COMPRA SIN CORRELATIVO */
			$sql=sql::cc_geneComp(
									$dataDetCent[0]['provId'],
									$dataDetCent[0]['proyeId'],
									$_SESSION['SIS'][2],
									$dataDetCent[0]['moneId'],
									$dataDetCent[0]['pcId'],
									$dataDetCent[0]['ocFechCli'],
									$dataDetCent[0]['tipDoc']
								);
			$filAfect4=negocio::setData($sql);
			$idFilAfect4=negocio::getInsertId();

		}
		else
		{
			/* GENERAMOS ORDEN SERVICIO SIN CORRELATIVO SI TIPO ES 3 */
			$sql=sql::os_geneOrdServ(
										$_SESSION['SIS'][2],
										$dataDetCent[0]['pcId'],
										2
									);
			$filAfect4=negocio::setData($sql);
			$idFilAfect4=negocio::getInsertId();

			# Flujo para obtener fs y enviarla al os
								
				/* obtener fs a partir de fl */
				#$sql=sql::os_getFsxFl($_POST['cotiFl']);
				#$valFsId=negocio::getVal($sql,'fsId');

				/* obtener datos generales de fs */
				#$sql=sql::os_getDatGenFs($valFsId);
				#$dataGenFs=negocio::getData($sql);

				/* obtener detalle de fs */
				#$sql=sql::os_getDetFs($_POST['cotiFl']);
				#$dataDetFs=negocio::getData($sql);

				/* obtener condiciones de fs */
				#$sql=sql::os_getCondFs($valFsId);
				#$dataCondFs=negocio::getData($sql);

				/* enviar datos generales de fs a os */
				#foreach($dataGenFs as $data)
				#{
					/*$sql=sql::os_actuGenFs($data['fech'],
											$data['cli'],
											$data['respComer'],
											$data['mone'],
											$data['des'],
											$data['priori'],
											$data['esta'],
											$idFilAfect4);
					$filAfect5=negocio::setData($sql);*/

					$sql=sql::os_actuGenFsBlan('',
											   $idFilAfect4);
					$filAfect5=negocio::setData($sql);

					/* actualizar datos generales de os en cc  */
					#$sql=sql::os_actuOrdCread($data['cli'],$data['mone'],$idFilAfect3);
					#$filAfect11=negocio::setData($sql);
				#}

				/* enviar detalle de fs a os */

					/*foreach($dataDetFs as $data)
					{
						$sql=sql::os_setDetFs($data['pro_descripcion'],
											$data['cs_tipDetServId'],
											$data['cs_unid'],
											$data['pro_cantidad'],
											$data['pro_precio_venta'],
											$data['pro_subtotal'],
											$idFilAfect4);
						$filAfect6=negocio::setData($sql);
					}*/


				/* enviar condiciones de fs a os */

					/*if(count($dataCondFs)>0)
					{
						foreach($dataCondFs as $data)
						{
							$sql=sql::os_setCondiFs($data['requi'],
												$data['tiemEje'],
												$data['garan'],
												$data['condi'],
												$data['tiemVali'],
												$idFilAfect4);
							$filAfect7=negocio::setData($sql);
						}
					}
					else
					{*/
						$sql=sql::os_setCondiFs('',
												'',
												'',
												'',
												'',
												$idFilAfect4);
						$filAfect7=negocio::setData($sql);
					#}

		}

		/* GENERAMOS CORRELATIVO */
		#$idFilAfect4=negocio::getInsertId();
		$valPrefi=negocio::evaPrefiTip($dataDetCent[0]['tipDoc']);
		$sql=sql::cc_prefiDoc($valPrefi);
		$prefiDoc=negocio::getVal($sql,'docu_tipo_prefijo');
		$idCorreComp=$prefiDoc.'-'.str_pad($idFilAfect4,4,'0',STR_PAD_LEFT).'-1';

		if($dataDetCent[0]['tipDoc']==1 or $dataDetCent[0]['tipDoc']==2)
		{
			/* GENERAR CORRELATIVO DE ORDEN */
			$sql=sql::cc_geneCorreComp($idFilAfect4,$idCorreComp,$_POST['cliDes']);
			$filAfect8=negocio::setData($sql);
		}
		else
		{
			/* GENERAMOS CORRELATIVO DE ORDEN */
			$sql=sql::os_geneCorreOrdServ($idFilAfect4,$idCorreComp);
			$filAfect9=negocio::setData($sql);
		}

		/* ACTUALIZAR ESTADO DE ORDENES */
		$sql=sql::cc_actEstOrde($idFilAfect3,$idCorreComp);
		$filAfect10=negocio::setData($sql);

		/* OBTENER DATA DE DETALLE ACTUALIZADO */
		$sql=sql::cc_getDetProyexId($idCentCost);
		$dataDetFl=negocio::getData($sql);

		$edit='edit2';
		$delete='delete2';

	break;

	case 'edit2':

		$sql=sql::cc_updateDetProye($idDet,$_POST['tipDoc'],$_POST['proveId'],$_POST['moneId'],$_POST['plazo'],$_POST['desOrd']);
		$filAfect=negocio::setData($sql);
		$idFilAfect=negocio::getInsertId();

		/* ACTUALIZAR COMPRA GENERADA DE CENTRO DE COSTO  */
		$sql=sql::cc_getCorreOrdxId($idDet);
		$valDetCent=negocio::getVal($sql,'cc_ocGeneId');
		$sql=sql::cc_updateCompGene($valDetCent,$_POST['tipDoc'],$_POST['proveId'],$_POST['moneId']);
		$filAfect2=negocio::setData($sql);

		/* ACTUALIZAR MONEDA DE COMPRA GENERADA */
		$sql=sql::cc_updateMoneDetComp($valDetCent,$_POST['moneId']);
		$filAfect3=negocio::setData($sql);

		$sql=sql::cc_getDetProyexId($idCentCost);
		$dataDetFl=negocio::getData($sql);

		$edit='edit2';
		$delete='delete2';

	break;

	case 'delete2':

		$sql=sql::cc_deleteDetProyexId($idDet);
		$filAfect=negocio::setData($sql);

		$sql=sql::cc_getDetProyexId($idCentCost);
		$dataDetFl=negocio::getData($sql);

		$edit='edit2';
		$delete='delete2';

	break;

	case 'load2':

		/* OBTENER DATA DE DETALLE ACTUALIZADO */
		$sql=sql::cc_getDetProyexId($idCentCost);
		$dataDetFl=negocio::getData($sql);

		$edit='edit2';
		$delete='delete2';

	break;

	default:
		# nada...! :(
	break;
}

/* ELIMINAMOS SESION INICIAL Y GENERAMOS EL NUEVO ARRAY SESION */

unset($_SESSION['arrCotiFl']);
$_SESSION['arrCotiFl']=$dataDetFl;

/* CALCULAMOS LA CONVERSION DE TOTALES A DOLARES */

$sql=sql::cc_totConverOrd($idCentCost);
$dataConverTot=negocio::getData($sql);

/* INICIAR TOTALES ORDENES DE SERVICIOS */
$sql=sql::os_totMontxMone($idCentCost);
$dataTotServ=negocio::getData($sql);

/* INICIAR TOTALES VISITAS */
$sql=sql::visi_totMontxMone($idCentCost);
$dataTotVisi=negocio::getData($sql);

/*
$totSolesArr=negocio::evaConverTot('soles',$dataConverTot[0]['totSoles']);
$totDolArr=negocio::evaConverTot('dolar',$dataConverTot[0]['totDolares']);
$totHebArr=negocio::evaConverTot('hebros',$dataConverTot[0]['totHebros']);
*/

/*
$totGastProyeDol=$totSolesArr[0]['totDol']+$totDolArr[0]['totDol']+$totHebArr[0]['totDol'];
$totGastProyeSol=$totSolesArr[0]['totSol']+$totDolArr[0]['totSol']+$totHebArr[0]['totSol'];
*/

/* TOTALES DE ORDENES */
$totSolOrd=negocio::evaNullTot($dataConverTot[0]['totSoles']);
$totDolOrd=negocio::evaNullTot($dataConverTot[0]['totDolares']);
$totHebOrd=negocio::evaNullTot($dataConverTot[0]['totHebros']);

/* TOTALES DE SERVICIOS */
$totSolServ=negocio::evaNullTot($dataTotServ[0]['montSolServ']);
$totDolServ=negocio::evaNullTot($dataTotServ[0]['montDolServ']);
$totHebServ=negocio::evaNullTot($dataTotServ[0]['montHebServ']);

/* TOTALES DE VISITAS */
$totSolVisi=negocio::evaNullTot($dataTotVisi[0]['totSolVisi']);
$totDolVisi=negocio::evaNullTot($dataTotVisi[0]['totDolVisi']);
$totHebVisi=negocio::evaNullTot($dataTotVisi[0]['totHebVisi']);

/* TOTALES DEFINIDOS EN CENTRO DE COSTOS */
$totSol=$totSolOrd+$totSolServ+$totSolVisi;
$totDol=$totDolOrd+$totDolServ+$totDolVisi;
$totHeb=$totHebOrd+$totHebServ+$totHebVisi;	

?>

<!-- DATA LOAD AJAX -->

<table class="list" >
	<thead>
		<tr>
			<td>Item</td>
			<td>Tipo Orden</td>
			<td>Proveedor</td>
			<td>Moneda</td>
			<td>Monto</td>
			<td>Incoterm</td>
			<!--<td>Descripcion</td>-->
			<td>Plazo(Dias)</td>
			<td align="center" >OC/EW/OS</td>
			<td align="center" >Accion</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($_SESSION['arrCotiFl'] as $data) { ?>
		<tr>
			<td><?php print $data['idDet']; ?></td>
			<td><?php print negocio::evaTipMone($data['tipDoc']); ?></td>
			<td><?php print negocio::getProvexId($data['proveId']); ?></td>
			<td align="center" ><?php print negocio::getMonexId($data['moneId']); ?></td>
			<td align="right" ><?php print negocio::evaMontxTip($data['tipDoc'],$data['totOrd'],$data['totOrdServ'],$data['totVisiVen']); ?></td>
			<!--<td><?php #print $data['desOrd']; ?></td>-->
			<td align="center"><?php print $data['tipPreci']; ?></td>
			<td align="center" ><?php print $data['plazo']; ?></td>
			<td align="center" >
				<a href="<?php print 'Javascript:'.negocio::evaTipDocOrd($data['sufiOrd'],negocio::cs_evaIdOrd($data['compId'],$data['servId'],$data['visiId'])); ?>" 
					title="<?php print negocio::getProvexId($data['proveId']); ?>" target="_self">
					<?php print $data['correOrd']; ?>
				</a>
			</td>
			<td align="center" >
				<a href="<?php print "Javascript:cc_openEditComp('".$data['idDet']."','".$edit."');" ?>" >Editar</a> |
				<a href="<?php print "Javascript:cc_evaEstEliProye('".$data['idDet']."','".$delete."');" ?>">Eliminar</a>
			</td>
		</tr>
		<?php } ?>
		<?php  print negocio:: evaCotiFl($idCentCost); ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" align="center">Total(S/.)</td>
			<td align="right" >S/. <?php print number_format($totSol,2); ?></td>
		</tr>
		<tr>
			<td colspan="4" align="center">Total($)</td>
			<td align="right" >$ <?php print number_format($totDol,2); ?></td>
		</tr>
		<tr>
			<td colspan="4" align="center">Total(€)</td>
			<td align="right" >€ <?php print number_format($totHeb,2); ?></td>
		</tr>
	</tfoot>
</table>




