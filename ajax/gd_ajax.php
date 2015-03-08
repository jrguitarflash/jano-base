<?php

require("../conf.php");
require("../clases/negocio/negocio.class.php");
require("../clases/sql/sql.class.php");
require("../utils_func.php");

switch ($_REQUEST['ajax']) 
{

	case 'gd_gestDocxLim':

		$pagGest=$_POST['pagGest'];
		$pag=5;
		$limIni=($pagGest*$pag)-$pag;
		$limFin=$pag;
		$estaId=$_POST['estaId'];
		$fechGest=$_POST['fechGest'];

		$sql=sql::gd_gestDocxLim($limIni,$limFin,$estaId,$fechGest);
		$dataGestPag=negocio::getData($sql);
		$html="";

		$dataPriori=gd_dataPriori();

		foreach($dataGestPag as $data)
		{
			$html.="<tr>
					<td align='center' ><input type='checkbox' name='gd_chkGest[]' id='gd_chkGest' value='".$data['gd_gestDocId']."' ></td>
					<td>".$data['gd_gestDocId']."</td>
					<td>".$data['gd_doc']."</td>
					<td>".$data['gd_gest']."</td>
					<td>".$data['gd_fech']."</td>
					<td>".gd_getHourSimple($data['gd_hora'])."</td>
					<td>".$data['gd_lugar']."</td>
					<td>".$data['desEsta']."</td>
					<td>".$data['usuDes']."</td>
					<td>".gd_evaPriori($data['prioDay'],$dataPriori)."</td>
					<td align='center' >
						<a href='Javascript:gd_ediGest_link(".$data['gd_gestDocId'].")'>Editar</a>
						<a href='Javascript:gd_gestDoc_eli(".$data['gd_gestDocId'].")'>Eliminar</a>
					</td>
				</tr>";
		}

		print $html;

	break;

	case 'gd_rutxLim_cap':

		$pagGest=$_POST['pagGest'];
		$pag=5;
		$limIni=($pagGest*$pag)-$pag;
		$limFin=$pag;
		$estaId=$_POST['estaId'];
		$fechRut=$_POST['fechRut'];

		$sql=sql::gd_rutxLim_cap($limIni,$limFin,$estaId,$fechRut);
		$dataRut=negocio::getData($sql);
		$html="";

		foreach($dataRut as $data)
		{
			$html.="<tr>
						<td align='center' ><input type='checkbox' name='gd_chkRut[]' id='gd_chkRut' value='".$data['gd_rutaId']."' ></td>
						<td>".$data['gd_correRut']."</td>
						<td>".$data['gd_fechRut']."</td>
						<td>".gd_getHourSimple($data['gd_hourRut'])."</td>
						<td>".$data['desRut']."</td>
						<td>".$data['rutAdm']."</td>
						<td>".$data['rutResp']."</td>
						<td>".$data['estaRut']."</td>
						<td align='center' >
							<a href='Javascript:gd_linkEditRut(".$data['gd_rutaId'].")'>Editar</a> |
							<a href='Javascript:gd_rutGest_eli(".$data['gd_rutaId'].")'>Eliminar</a> |
							<a href='Javascript:gd_dirMarRut(".$data['gd_rutaId'].")'>Marcar</a>
						</td>
					</tr>";
		}

		print $html;

	break;

	case 'gd_detRutxId_cap':

		$sql=sql::gd_detRutxId_cap($_POST['rutId']);
		$dataDetRut=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach ($dataDetRut as $data) 
		{
			$html.="<tr>
						<td>".$ind++."</td>
						<td>".$data['usuDes']."</td>
						<td>".$data['doc']."</td>
						<td>".$data['ges']."</td>
						<td>".$data['lug']."</td>
						<td>".$data['fech']."</td>
						<td>".$data['desEsta']."</td>
						<td align='center' >
							<a href='Javascript:gd_detRutxId_eli(".$data['gd_detRutaId'].")'>Eliminar</a>
						</td>
					</tr>";
		}

		print $html;

	break;

	default:

		# code...

	break;
}