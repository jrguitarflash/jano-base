<?php

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');
session_start();

switch ($_REQUEST['ajax']) 
{

	/**************************************/
	// MODULO FINANZAS & CENTRO DE COSTOS
	/**************************************/

	case 'openBanTem_cre':

		$filAfect=0;

		for($i=0;$i<count($_POST['tipDocId']);$i++)
		{
			$sql=sql::finan_openBanTem_cre($_POST['tipDocId'][$i],$_POST['centTemp'],$_POST['tipCent']);
			$filAfect+=negocio::getVal($sql,'response');
		}

		// obtener data de operacion bancaria temporal

		$sql=sql::finan_opeBanTem_obte($_POST['centTemp'],$_POST['tipCent']);
		$dataOpeBan=negocio::getData($sql);
		$opeBan_html="";
		$ind=1;

		//obtener moneda para operacion
		desconectar();
		conectar();
		$sql=sql::finan_moneOpe_obte();
		$dataOpeMone=negocio::getData($sql);

		foreach($dataOpeBan as $data)
		{
			//iteracion de tipos de monedas
			 $opeMone_html="<option></option>";
			foreach($dataOpeMone as $data2)
			{
				if($data['mone']==$data2['moneId'])
				{
					$opeMone_html.="<option value='".$data2['moneId']."' selected >".$data2['monSigla']."</option>";	
				}
				else
				{
					$opeMone_html.="<option value='".$data2['moneId']."' >".$data2['monSigla']."</option>";
				}

			}

			//propiedad estados fechas
				$propVenci="";
				$propEntre="";

				if($data['estaVenci']==1)
				{
					$propVenci="checked";
				}

				if($data['estaEntre']==1)
				{
					$propEntre="checked";
				}

			//evaluar estado de operacion
				$estaOpeVal=$data['estaVenci']+$data['estaEntre'];
				$estaOpeDes="<span style='color:red' >pendiente</span>";
				if($estaOpeVal==2)
				{
					$estaOpeDes="<span style='color:green' >finalizado</span>";
				}

			//evaluar disponibilidad de operacion bancaria
				desconectar();
				conectar();

				$propDispo="";
				$propColor="";
				$sql=sql::finan_renoMax_cap($data['opeBancaId'],$_POST['tipCent']);
				$renoMax=negocio::getVal($sql,'response');
				if($renoMax==0)
				{
					$renoMax=null;
				}

				if($renoMax==$data['versiReno'])
				{
					$propDispo="enabled";
					$propColor="bgcolor=#EFEFEF";
				}
				else
				{
					$propDispo="disabled";
					$data['opeBancaId']=0;
				}

			//cuerpo del marcado

			$opeBan_html.="<tr ".$propColor." >
						<td>
							<input type='checkbox' value='".$data['opeBancaId']."' id='finan_chkOpe' name='finan_chkOpe[]' ".$propDispo." >
						</td>
						<td>".$ind++."</td>
						<td><input type='text' value='".$data['correOpe']."' id='finan_num_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' size='6' ></td>
						<td>".$data['versiReno']."</td>
						<td>".$data['docDes']."</td>
						<td>".$data['tipDocDes']."</td>
						<td>
							<select id='finan_mone_".$data['opeBancaId']."' onclick='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >".$opeMone_html."</select>
						</td>
						<td>
							<input type='text' value='".$data['monto']."' id='finan_mont_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' value='".$data['fechIni']."' id='finan_fechIni_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' value='".$data['fechVenDoc']."' id='finan_fechDoc_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
							<input type='checkbox' id='finan_estaVenci_".$data['opeBancaId']."' ".$propVenci." onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' value='".$data['fechVenCli']."' id='finan_fechCli_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
							<input type='checkbox' id='finan_estaEntre_".$data['opeBancaId']."' ".$propEntre." onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' size='5' value='".$data['tasAnu']."' id='finan_tasAnu_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." />%
						</td>
						<td>
							<input type='text' id='finan_comisInte_".$data['opeBancaId']."' value='".$data['comisInte']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>".$estaOpeDes."</td>
						<td>
							<a href='Javascript:finan_opeBanTem_eli(".$data['opeBancaId'].")' >eliminar</a>
						</td>
					      </tr>";
		}

		// Calcular totales de comision
		desconectar();
		conectar();
		$sql=sql::finan_totComi_calcu($_POST['centTemp'],$_POST['tipCent']);
		$dataTotComis=negocio::getData($sql);

		$opeBan_html.="<tr>
							<td colspan='10' align='right' >Total(S/.)</td>
							<td>".$dataTotComis[0]['totSoles']."</td>
						</tr>
						<tr>
							<td colspan='10' align='right' >Total($)</td>
							<td>".$dataTotComis[0]['totDolares']."</td>
						</tr>
						<tr>
							<td colspan='10' align='right' >Total(€)</td>
							<td>".$dataTotComis[0]['totHebros']."</td>
						</tr>";

		print $opeBan_html;
	break;

	case 'opeBanTem_obte':

		// obtener data de operacion bancaria temporal

		$sql=sql::finan_opeBanTem_obte($_POST['centTemp'],$_POST['tipCent']);
		$dataOpeBan=negocio::getData($sql);
		$opeBan_html="";
		$ind=1;

		//obtener moneda para operacion
		desconectar();
		conectar();
		$sql=sql::finan_moneOpe_obte();
		$dataOpeMone=negocio::getData($sql);

		foreach($dataOpeBan as $data)
		{
			//iteracion de tipos de monedas
			 $opeMone_html="<option></option>";
			foreach($dataOpeMone as $data2)
			{
				if($data['mone']==$data2['moneId'])
				{
					$opeMone_html.="<option value='".$data2['moneId']."' selected >".$data2['monSigla']."</option>";	
				}
				else
				{
					$opeMone_html.="<option value='".$data2['moneId']."' >".$data2['monSigla']."</option>";
				}				
			}

			//propiedad estados fechas
				$propVenci="";
				$propEntre="";

				if($data['estaVenci']==1)
				{
					$propVenci="checked";
				}

				if($data['estaEntre']==1)
				{
					$propEntre="checked";
				}

			//evaluar estado de operacion
			$estaOpeVal=$data['estaVenci']+$data['estaEntre'];
			$estaOpeDes="<span style='color:red' >pendiente</span>";
			if($estaOpeVal==2)
			{
				$estaOpeDes="<span style='color:green'>finalizado</span>";
			}

			//evaluar disponibilidad de operacion bancaria
			desconectar();
			conectar();

			$propDispo="";
			$propColor="";
			$sql=sql::finan_renoMax_cap($data['opeBancaId'],$_POST['tipCent']);
			$renoMax=negocio::getVal($sql,'response');
			if($renoMax==0)
			{
				$renoMax=null;
			}

			if($renoMax==$data['versiReno'])
			{
				$propDispo="enabled";
				$propColor="bgcolor=#EFEFEF";
			}
			else
			{
				$propDispo="disabled";
				$data['opeBancaId']=0;
			}

			//cuerpo del marcado

			$opeBan_html.="<tr ".$propColor." >
						<td>
							<input type='checkbox' value='".$data['opeBancaId']."' id='finan_chkOpe' name='finan_chkOpe[]' ".$propDispo." >
						</td>
						<td>".$ind++."</td>
						<td><input type='text' value='".$data['correOpe']."' id='finan_num_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' size='6' ></td>
						<td>".$data['versiReno']."</td>
						<td>".$data['docDes']."</td>
						<td>".$data['tipDocDes']."</td>
						<td>
							<select id='finan_mone_".$data['opeBancaId']."' onclick='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >".$opeMone_html."</select>
						</td>
						<td>
							<input type='text' value='".$data['monto']."' id='finan_mont_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' value='".$data['fechIni']."' id='finan_fechIni_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' value='".$data['fechVenDoc']."' id='finan_fechDoc_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
							<input type='checkbox' id='finan_estaVenci_".$data['opeBancaId']."' ".$propVenci." onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' value='".$data['fechVenCli']."' id='finan_fechCli_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
							<input type='checkbox' id='finan_estaEntre_".$data['opeBancaId']."' ".$propEntre." onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>
							<input type='text' size='5' value='".$data['tasAnu']."' id='finan_tasAnu_".$data['opeBancaId']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." />%
						</td>
						<td>
							<input type='text' id='finan_comisInte_".$data['opeBancaId']."' value='".$data['comisInte']."' onchange='finan_opeBanTem_actu(".$data['opeBancaId'].")' ".$propDispo." >
						</td>
						<td>".$estaOpeDes."</td>
						<td>
							<a href='Javascript:finan_opeBanTem_eli(".$data['opeBancaId'].")' >eliminar</a>
						</td>
						  </tr>";
		}

		// Calcular totales de comision
		desconectar();
		conectar();
		$sql=sql::finan_totComi_calcu($_POST['centTemp'],$_POST['tipCent']);
		$dataTotComis=negocio::getData($sql);

		$opeBan_html.="<tr>
							<td colspan='10' align='right' >Total(S/.)</td>
							<td>".$dataTotComis[0]['totSoles']."</td>
						</tr>
						<tr>
							<td colspan='10' align='right' >Total($)</td>
							<td>".$dataTotComis[0]['totDolares']."</td>
						</tr>
						<tr>
							<td colspan='10' align='right' >Total(€)</td>
							<td>".$dataTotComis[0]['totHebros']."</td>
						</tr>";

		print $opeBan_html;
	break;

	// -----------------------o----------------------------

	/*****************************************************/
		# CENTRO DE COSTOS
	/****************************************************/
	
	case 'filVisi':
		$sql=sql::cc_visiFil_obtener($_POST['perId']);
		$data_visiFil_obtener=negocio::getData($sql);
	break;

	//New update 05/01/2015 - CLOSE
	//           06/01/2015

	case 'cc_ordxOrd_obte':

		$empId=$_SESSION['SIS'][5];
		$sql=sql::cc_ordxOrd_obte($empId,$_POST['ordId']);
		$dataOrd=negocio::getData($sql);
		$html="";

		foreach($dataOrd as $data)
		{
			$html.="<tr>
						<td align='center' >
							<input type='checkbox' value='".$data['compId']."' name='cc_ordAsig_chk[]' id='cc_ordAsig_chk' >
						</td>
						<td>".$data['compNro']."</td>
						<td>".$data['fechIni']."</td>
						<td>".$data['provDes']."</td>
					</tr>";
		}

		print $html;

	break;

	case 'cc_ordxCent_obte':

		$empId=$_SESSION['SIS'][5];
		$sql=sql::cc_ordxCent_obte($empId,$_POST['centId']);
		$dataOrd=negocio::getData($sql);
		$html="";

		foreach($dataOrd as $data)
		{
			$html.="<tr>
						<td align='center' >
							<input type='checkbox' value='".$data['compId']."' name='cc_ordAsig_chk[]' id='cc_ordAsig_chk' >
						</td>
						<td>".$data['compNro']."</td>
						<td>".$data['fechIni']."</td>
						<td>".$data['provDes']."</td>
					</tr>";
		}

		print $html;

	break;
	
	default:

		$excep="Peticion ajax no enviada";

	break;

	//-----------------------o--------------------------------
}

?>

<!-- HTML AJAX OUTPUT -->

	<?php if($_REQUEST['ajax']=='filVisi') { ?>

		<table class="list" >
			<thead>
				<tr>
					<td></td>
					<td>N° visita</td>
					<td>Responsable</td>
					<td>Fecha</td>
					<td>Moneda</td>
					<td>Monto</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data_visiFil_obtener as $data) { ?>
				<tr>
					<td><input type="checkBox"  value="<?php print $data['idVisi']."|".$_POST['idCent']."|".$data['moneId']."|".$data['visiCorre']; ?>" name="idVisi[]" id="idVisi" ></td>
					<td><?php print $data['visiCorre']; ?></td>
					<td><?php print $data['perEw']; ?></td>
					<td><?php print $data['fech']; ?></td>
					<td><?php print $data['moneSigla']; ?></td>
					<td><?php print $data['mont']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
			<!--
			<tfoot>
			</tfoot>
			-->
		</table>

	<?php } else { ?>

		<!-- $excep="Peticion ajax no enviada"; -->

	<?php } ?>