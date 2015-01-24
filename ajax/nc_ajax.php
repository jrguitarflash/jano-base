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

	case 'nc_ordexCent_obte':

		$sql=sql::nc_ordexCent_obte($_POST['centId']);
		$dataOrd=negocio::getData($sql);
		$html="";

		foreach($dataOrd as $data)
		{
			$html.="<option value='".$data['nc_CompId']."' >".$data['nc_nroComp']."</option>";
		}

		print $html;
	break;

	case 'nc_detxOrd_obte':

		$sql=sql::nc_detxOrd_obte($_POST['ordId']);
		$dataDet=negocio::getData($sql);
		$html="";
		$item=1;

		foreach($dataDet as $data)
		{
			$html.="<tr>
						<td align='center' ><input type='checkbox' name='nc_detEquip[]' id='nc_detEquip' value='".$data['nc_detId']."' ></td>
						<td>".$item++."</td>
						<td>".$data['nc_prodDes']."</td>
						<td>".$data['nc_provDes']."</td>
					</tr>";
		}

		print $html;
	break;

	//New update 14/01/2015 - OPEN

	case 'nc_noConfor_obte':

		$sql=sql::nc_noConfor_obte($_POST['fechRecep'],$_POST['estaConfor'],$_POST['limIni'],$_POST['limFin'],$_POST['obsId'],$_POST['oriObs']);
		$dataConfor=negocio::getData($sql);
		$html="";

		foreach($dataConfor as $data)
		{
			$html.="<tr>
						<td align='center' ><input type='checkbox' value='".$data['nc_noConforId']."'></td>
						<td><a href='Javascript:nc_repDet_gene(".$data['nc_noConforId'].")' class='nc_rep_lnk' >".$data['nc_nro']."</a></td>
						<td>".$data['nc_des']."</td>
						<td>".$data['nc_fechRecep']."</td>
						<td>".$data['nc_estaConfor']."</td>
						<td>".$data['nc_obsDes']."</td>
						<td>".$data['nc_oriDes']."</td>
						<td align='center' >
							<a href='Javascript:nc_editConfor_link(".$data['nc_noConforId'].")'>Editar</a>&nbsp;|&nbsp;
							<a href='Javascript:nc_noConfor_borrar(".$data['nc_noConforId'].")'>Eliminar</a>
						</td>
					</tr>";
		}

		print $html;	
	break;

	case 'nc_infoAdju_obte':

		$sql=sql::nc_infoAdju_obte($_POST['conforId']);
		$dataAdju=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach($dataAdju as $data)
		{
			$html.="<tr>
					<td>".$ind++."</td>
					<td><a href='".$data['nc_fileAdju']."' target='_blank' >".$data['nc_fileAdju']."</a></td>
					<td>".$data['nc_desAdju']."</td>
					<td align='center' >
						<a href='Javascript:nc_infoAdju_borra(".$data['nc_adjuInfoId'].")'>eliminar</a>
					</td>
				</tr>";
		}

		print $html;
	break;

	case 'nc_detEquipxId_obte':

		$sql=sql::nc_detEquipxId_obte($_POST['conforId']);
		$dataEquip=negocio::getData($sql);
		$html="";
		$ind=1;
		
		foreach($dataEquip as $data)
		{
			$html.="<tr>
					<td>".$ind++."</td>
					<td>".$data['prodDes']."</td>
					<td>".$data['provDes']."</td>
					<td align='center' >
						<a href='Javascript:nc_detEquip_borra(".$data['equipId'].")'>eliminar</a>
					</td>
				</tr>";
		}

		print $html;
	break;

	case 'nc_medCorrec_obte':

		$sql=sql::nc_medCorrec_obte($_POST['conforId']);
		$dataMed=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach($dataMed as $data)
		{
			$cadIng="";
			$dataIng=explode("|",$data['nc_ingAsig']);
			$indIng=0;

			//concatenar ingenieros asignados
				for($i=0;$i<count($dataIng);$i++)
				{
					desconectar();
					conectar();

					if($indIng==0)
					{
						$sql=sql::nc_perxId_obte($dataIng[$i]);
						$valIng=negocio::getVal($sql,'response');
						$cadIng=$valIng;
					}
					else
					{
						$sql=sql::nc_perxId_obte($dataIng[$i]);
						$valIng=negocio::getVal($sql,'response');
						$cadIng=$cadIng."<br>".$valIng;
					}
					$indIng++;
				}


			$html.="<tr>
					<td>".$ind."</td>
					<td>".$data['nc_medCorrecDes']."</td>
					<td>".$data['nc_respMed']."</td>
					<td>".$cadIng."</td>
					<td>".$data['nc_fechCorrec']."</td>
					<td align='center' >
						<a href='Javascript:nc_medxId_ini(".$data['nc_medCorrecId'].",".($ind++).")' >Editar</a> | 
						<a href='Javascript:nc_medCorrec_borra(".$data['nc_medCorrecId'].")' >Eliminar</a>
					</td>
				</tr>";
		}

		print $html;
	break;

	//New update 23/12/2014 - CLOSE

	case 'nc_tipConfxId_obte':

		$sql=sql::nc_tipConfxId_obte($_POST['idObs']);
		$dataTipObs=negocio::getData($sql);
		$html="";

		foreach($dataTipObs as $data)
		{
			$html.="<option value='".$data['nc_tipNoConforId']."' >".$data['nc_des']."</option>";
		}

		print $html;
	break;

	//New update 12/01/2015 - CLOSE

	case 'nc_medPrev_obte':

		$sql=sql::nc_medPrev_obte($_POST['conforId']);
		$dataPrev=negocio::getData($sql);
		$ind=1;
		$html="";

		foreach ($dataPrev as $data) 
		{
			# code...
			$html.="<tr>
						<td>".($ind)."</td>
						<td>".$data['nc_medPrevDes']."</td>
						<td>".$data['nc_medPrevFech']."</td>
						<td align='center' >
							<a href='Javascript:nc_medPrevxId_obte(".$data['nc_medPrevId'].",".($ind++).")'>editar</a>&nbsp;|
							<a href='Javascript:nc_medPrevxId_borra(".$data['nc_medPrevId'].")'>eliminar</a>
						</td>
					</tr>";
		}

		print $html;

	break; 

	default:
	break;
}

?>