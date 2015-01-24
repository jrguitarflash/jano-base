<?php
//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* Evaluar si el filtro es general */

switch($_POST['acci'])
{
	case 'delete':

		/* ELIMINAR DETALLE DE CENTRO DE COSTO */
		$sql=sql::cc_EliDetCentCost($_POST['idCent']);
		$filAfect=negocio::setData($sql);

		/* ELIMINAR CENTRO DE COSTO */
		$sql=sql::cc_EliCentCost($_POST['idCent']);
		$filAfect2=negocio::setData($sql);

		/* LEER DATA CENTRO DE COSTOS */
		$sql=sql::cc_pcCentCostTod();
		$dataCenCost=negocio::getData($sql);

	break;

	case 'todos':

		/* LEER DATA CENTRO DE COSTOS */
		$sql=sql::cc_pcCentCostTod();
		$dataCenCost=negocio::getData($sql);

	break;

	case 'filtro':

		/* LEER DATA CENTRO DE COSTOS */
		$sql=sql::cc_pcCentCostxFil($_POST['valEstProy']);
		$dataCenCost=negocio::getData($sql);

	break;

	default:
	break;
}


/* EVALUAR CENTROS DE COSTOS APERTURADOS */
for($i=0;$i<count($dataCenCost);$i++)
{
	if($dataCenCost[$i]['idEstApe']==1)
	{
		$dataCenCost[$i]['propEstApe']='checked';
	}
	else
	{
		$dataCenCost[$i]['propEstApe']='';
	}
}

?>

<!-- MOSTRAR DATA AJAX LOAD -->

<form id="frmCosCread" name="frmCosCread" >
	<input type="hidden" name="accion" value="" >
	<table class="list" >
		<thead>
			<tr>
				<!--
					<td align="center" rowspan="2"></td>
				-->
				<td align="center" rowspan="2">Item</td>
				<td align="center" rowspan="2">PC</td>
				<td align="center" rowspan="2">Cliente</td>
				<td align="center" rowspan="2">Estados</td>
				<td align="center" rowspan="2">Moneda</td>
				<td align="center" rowspan="2">Monto OC Cliente</td>
				<td align="center" rowspan="1" colspan="3">Gastos</td>
				<td align="center" rowspan="2" colspan="1">N° ordenes</td>
				<td align="center" rowspan="2" colspan="1">Accion</td>
				<td align="center" rowspan="2" colspan="1">Reporte</td>
			</tr>
			<tr>
				<td align="center" rowspan="1" colspan="1">S/.</td>
				<td align="center" rowspan="1" colspan="1">$</td>
				<td align="center" rowspan="1" colspan="1">€</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($dataCenCost as $data) { 
				$sql=sql::cc_detCenCostNoGen(2,$data['idCent']);
				$dataDetNoGene=negocio::getData($sql);
				$sql=sql::cc_detCenCost(1,$data['idCent']);
				$dataDetGene=negocio::getData($sql);

				/* CONVERSION DE TOTALES A DOLARES Y SOLES */
				$sql=sql::cc_totConverOrd($data['idCent']);
				$dataConverTot=negocio::getData($sql);

				/* INICIAR TOTALES ORDENES DE SERVICIOS */
				$sql=sql::os_totMontxMone($data['idCent']);
				$dataTotServ=negocio::getData($sql);

				/* INICIAR TOTALES VISITAS */
				$sql=sql::visi_totMontxMone($data['idCent']);
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
			<tr>
				<!--
				<td>
					<input type="checkbox"  name="estProye[]" <?php #print $data['propEstApe']; ?> value="<?php #print $data['idCent']; ?>" >
				</td>
				-->
				<td align="center">
					<?php print $data['idCent']; ?>
				</td>
				<td align="center">
					<a href="<?php print "Javascript:cc_direEvaEst('".$data['idCent']."','".$data['idEstApe']."')"; ?>" >
						<?php print $data['correCen']; ?>
					</a>
				</td>
				<td align="left"><?php print negocio::getProvexId($data['idCli']); ?></td>
				<td align="center">
					<img src="<?php print negocio::evaEstProy($data['desEstApe']); ?>" width="30px" title="<?php print $data['desEstApe']; ?>" >
				</td>
				<td align="center"><?php print $data['desMone']; ?></td>
				<td align="right"><?php print number_format($data['montCoti'],2); ?></td>
				<td align="right">S/. <?php print number_format($totSol,2); ?></td>
				<td align="right">$ <?php print number_format($totDol,2); ?></td>
				<td align="right">€ <?php print number_format($totHeb,2); ?></td>
				<td align="center"><?php print $data['cantOrd']; ?></td>
				<td align="center">
					<a href="<?php print "Javascript:cc_ajaxEliCentCost('".$data['idCent']."','delete')"; ?>">Eliminar</a>
				</td>
				<td align="center" title="Generar reporte de compras">
					<a href="#"><img src="images/geneExcel.png" width="30px"></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
		<!--
		<tfoot>
			<tr>
				<td>Item</td>
				<td>PC</td>
				<td>FL</td>
				<td>OC/EW</td>
			</tr>
		</tfoot>
		-->	
	</table>
</form>