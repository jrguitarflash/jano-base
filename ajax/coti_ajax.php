<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");
session_start();

switch ($_REQUEST['ajax'])
{

	case 'proyCoti_list':

		$empId=$_SESSION['SIS'][5];
		$sql=sql::cot_proyCoti_list($empId,$_POST['filtro'],$_POST['valResp'],$_POST['desProye']);
		$dataProyCoti=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach ($dataProyCoti as $data) 
		{

			#detProye
			desconectar();
			conectar();

			$sql=sql::cot_cotixProye_listar($data['proyeId'],$_POST['valEsta']);
			$dataFl=negocio::getData($sql);
			$detHtml="";

			//cantidad de cotizaciones de proyectos
			desconectar();
			conectar();
			$sql=sql::cot_cotiProye_cont($empId,$data['proyeId'],$_POST['valEsta']);
			$cantCoti=negocio::getVal($sql,'response');


			foreach($dataFl as $data2)
			{
				$acciVer="Javascript:Accion('U','500','400','persona_form',0,67,'".$data2['cotId']."','29','cotizacion','cli_id=".$data2['cliente_id']."&cotizacion_id=".$data2['cotId']."&coti=proye');";

				$detHtml.="<tr>
								<td colspan='2' align='center' width='10%' ><a href='Javascript:GenerarCotizacionPDF(".$data2['cotId'].")' >".$data2['cot_nro']."</a></td>
								<td width='25%' >".$data2['desCli']."</td>
								<td width='25%' >".$data2['desProye']."</td>
								<td width='3%'>".$data2['desMone']."</td>
								<td width='7%'>".$data2['totCoti']."</td>
								<td width='7%'>".$data2['fechAdju']."</td>
								<td width='7%'>".$data2['cotProb']."</td>
								<td align='center' ><a href=".$acciVer." >Ver</a></td>
							</tr>";
			}

			# code...
			$html.="<tr>
					<td align='center' ><a href='#' id='cot_agruFl_".$ind."' onclick='cot_agruFl(this.id)' >+</a></td>
					<td><input type='radio' name='cot_rdbProye' value='".$data['proyeId']."' ></td>
					<td align='center' >".$cantCoti."</td>
					<td align='center' >".$data['iniUsu']."</td>
					<td>".$data['proy_desCli']."</td>
					<td>".$data['proy_nombre']."</td>
					<td>-----</td>
					<td>-----</td>
					<td>".$data['proy_fechAdju']."</td>
					<td>-----</td>
					<td><a href='Javascript:cot_ediProy_ini(".$data['proyeId'].")' >Editar</a></td>
				</tr>
				<tr id='cot_agruFl_".$ind."_child' style='display:none'>
					<td></td>
					<td colspan='10' bgcolor='#EFEFEF' >
						<table width='100%' cellpadding='0px' cellspacing='0px' border='0px'>
							".$detHtml."
						</table>
					</td>
				</tr>";

			#indice
			$ind++;
		}

		print $html;

	break;

	default:
	break;

}