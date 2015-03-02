<?php

/*----------------------------------------*/
	#Peticiones Ajax
/*----------------------------------------*/

require("../conf.php");
require("../clases/negocio/negocio.class.php");
require("../clases/sql/sql.class.php");
require("../utils_func.php");

switch ($_REQUEST['ajax']) 
{
	case 'finan_opeProye_obte':

		$sql=sql::finan_opeProye_obte($_POST['periOpe'],$_POST['estaOpe']);
		$dataOpe=negocio::getData($sql);
		$html=""; //data render
		$ind=1; //data indice

		foreach($dataOpe as $data)
		{

			$html.="<tr>
						<td align='center' >
							<input type='checkbox' name='finan_opeProyeId[]' id='finan_opeProyeId' value='".$data['finan_opeProyeId']."' >
						</td>
						<td align='center' >".$ind++."</td>
						<td>".$data['finan_opeProyeCorre']."</td>
						<td>".$data['cc_des']."</td>
						<td>".$data['proye_nom']."</td>
						<td>".$data['cli_des']."</td>
						<td>".$data['ocFechCli']."</td>
						<td align='center' class='finan_cantOpe' >".$data['cant_ope']."</td>
						<td><img src=".$data['estaImg']."></td>
						<td align='center' >
							<a href='Javascript:finan_dirEdit(".$data['finan_opeProyeId'].")'>Editar</a> | 
							<a href='Javascript:finan_opeProye_eli(".$data['finan_opeProyeId'].")'>Eliminar</a>
						</td>
					</tr>";
		}

		print $html;

	break;

	case 'finan_adjuOpeXId_obte':

		$sql=sql::finan_adjuOpeXId_obte($_POST['opeId']);
		$dataAdju=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach($dataAdju as $data)
		{
			$html.="<tr>
					<td>".$ind++."</td>
					<td>".$data['numDocAdju']."</td>
					<td>".$data['adjuDes']."</td>
					<td>
						<a href='".$data['adjuDoc']."' target='_blank' >".$data['adjuDoc']."</a>
					</td>
					<td>
						<a href='Javascript:finan_adjuOpe_eli(".$data['adjuOpeId'].")' >eliminar</a>
					</td>
				</tr>";
		}

		print $html;

	break;

	case 'finan_periOpe_obte':

		$sql=sql::finan_periOpe_obte();
		$dataPeri=negocio::getData($sql);
		$html="";

		foreach($dataPeri as $data)
		{
			$html.="<option value='".$data['periOpe']."' >".$data['periOpe']."</option>";
		}

		print $html;

	break;

	case 'finan_estaOpe_obte':

		$sql=sql::finan_estaOpe_obte();
		$dataEstaOpe=negocio::getData($sql);
		$html="";

		foreach($dataEstaOpe as $data)
		{
			$html.="<option value='".$data['estaId']."' >".$data['estaDes']."</option>";
		}

		print $html;

	break;

	/******************************************/
		// MODULO FINANZAS & CENTRO DE COSTOS
	/******************************************/

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
					$propColor="bgcolor=#30AD23";
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
				$propColor="bgcolor=#30AD23";
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

	default:
	break;
}