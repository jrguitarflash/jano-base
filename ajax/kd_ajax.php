<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

switch ($_REQUEST['ajax'])
{
	case 'obteCatexid':
		
		$sql=sql::kd_obteCatexid($_POST['valSub']);
		$dataCate=negocio::getData($sql);
		$html="";

		foreach($dataCate as $data) 
		{
			$html.="<option value=".$data['catId']." >".$data['catDes']."</option>";
		}

		echo $html;

	break;

	case 'obteTipxId':

		# code...
		$sql=sql::kd_obteTipxId($_POST['valCat']);
		$dataTip=negocio::getData($sql);
		$html="";

		foreach($dataTip as $data)
		{
			$html.="<option value=".$data['tipId']." >".$data['tipDes']."</option>";
		}

		echo $html;

	break;

	case 'obteMarModxId':

		$sql=sql::kd_obteMarModxId($_POST['valTip']);
		$dataMarMod=negocio::getData($sql);
		$html="";

		foreach($dataMarMod as $data)
		{
			$html.="<option value=".$data['idPad']."|".$data['idMod']." >".$data['marModel']."</option>";
		}

		echo $html;		

	break;

	case 'prodLine':
		
		# code...
		//$marMod=explode("|",$_POST['marModel']);

		$sql=sql::kd_obteProdxid($_POST['mar'],$_POST['valCat'],$_POST['valSub']);
		$dataProd=negocio::getData($sql);
		$html="";

		foreach($dataProd as $data)
		{

			desconectar();
			conectar();

			$sql=sql::kd_stockAgru_obte($data['id']);
			$dataUbi=negocio::getData($sql);
			$flag=0;
			$cadUbi="";

			for($i=0;$i<count($dataUbi);$i++)
			{
				if($flag==0)
				{
					$cadUbi=$dataUbi[$i]['ubiEmp'];
				}
				else
				{
					$cadUbi=$cadUbi."<br>".$dataUbi[$i]['ubiEmp'];
				}

				$flag++;
			}

			$html.="<tr>
						<td><input type='radio' name='kd_lineId' id='kd_lineId' value='".$data['id']."' ></td>
						<td>".$data['cod']."</td>
						<td>".$data['sub']."</td>
						<td>".$data['cat']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['nomIngle']."</td>
						<td>".$data['des']."</td>
						<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
						<td></td>
						<td>".$cadUbi."</td>
					</tr>";
		}

		echo $html;

	break;

	case 'detKardxid':

		# code...
		$sql=sql::kd_detKardxid($_POST['kdxId']);
		$dataDetKardx=negocio::getData($sql);
		$html="";
		$i=1;

		desconectar();
		conectar();

		$sql=sql::kd_iniMoneMov($_POST['kdxId']);
		$mone=negocio::getVal($sql,'response');

		foreach($dataDetKardx as $data) 
		{
			# code...
			$html.="<tr>
						<td>".$i++."</td>
						<td>".$data['cod']."</td>
						<td>".$data['sub']."</td>
						<td>".$data['cat']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['nomIngle']."</td>
						<td>".$data['des']."</td>
						<td>".$data['kdxCant']."</td>
						<td>".$data['numSeriMov']."</td>
						<td>".$data['almcUbi']."</td>
						<td>".$data['obsItem']."</td>
						<td>
							<a href='Javascript:kd_eliDetMov(".$data['detKardxId'].")'>Eliminar</a>
						</td>
					</tr>";
		}

		echo $html;

	break;

	case 'iniHistKardx':

			$sql=sql::kd_histKardx($_POST['tipMov']);
			$dataHistKardx=negocio::getData($sql);
			$html="";				

			foreach($dataHistKardx as $data) 
			{
				$html.="<tr>
							<td><a href='Javascript:kd_geneRepMov(".$data['id'].")' >".$data['cod']."</a></td>
							<td>".$data['tipMovDes']."</td>
							<td>".$data['fechMov']."</td>
							<td>".$data['tipDocDes']." - ".$data['numDoc']."</td>
							<td>".$data['empDes']."</td>
							<td>".$data['detProd']."</td>
							<td>".$data['almcUbi']."</td>
							<td>".$data['comp_nro']."</td>
							<td>".$data['desMov']."</td>
							<td align='center' >
								<a href='Javascript:kd_direDetKardx(".$data['id'].",".$data['tipMovId'].")'>Detalle</a>|
								<a href='Javascript:kd_movKardx_eli(".$data['id'].")'>Eliminar</a>|
								<a href='Javascript:kd_prevGuia(".$data['id'].")' >Guia</a>
							</td>
						</tr>";
			}

			echo $html;

	break;

	case 'seriMov_mos':
		
		# code...
		$sql=sql::kd_seriMov_mos($_POST['detKdxId']);
		$data1=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach($data1 as $data)
		{
			$html.="<tr>
						<td>".$ind++."</td>
						<td>".$data['numSeri']."</td>
						<td>".$data['desSeri']."</td>
						<td align='center' >
							<a href='Javascript:kd_seriMov_eli(".$data['movSeriId'].")'>Eliminar</a>
						</td>
					</tr>";
		}

		print $html;
	
	break;

	case 'numSeri_mos':
		
		# code...
		$sql=sql::kd_numSeri_mos($_POST['idDetMov']);
		$data1=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach($data1 as $data)
		{
			$html.="<tr>
						<td><input type='checkbox' value='".$data['kd_numSeriId']."' name='checkSeriId[]' id='checkSeriId' ></td>
						<td>".$ind++."</td>
						<td>".$data['kd_numSeri']."</td>
						<td>".$data['kd_desProd']."</td>
					</tr>";
		}

		print $html;

	break;

	case 'seriMov_mos2':
		
		# code...
		$sql=sql::kd_seriMov_mos($_POST['detKdxId']);
		$data1=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach($data1 as $data)
		{
			$html.="<tr>
						<td><input type='checkbox' value='".$data['movSeriId']."' name='checkRegreId[]' id='checkRegreId' ></td>
						<td>".$ind++."</td>
						<td>".$data['numSeri']."</td>
						<td>".$data['desSeri']."</td>
					</tr>";
		}

		print $html;
	
	break;

	case 'marxTip_obte':

		#code
		$sql=sql::kd_marxTip_obte($_POST['tipId']);
		$data1=negocio::getData($sql);
		$html="";

		foreach ($data1 as $data) 
		{
			# code...
			$html.="<option value='".$data['mm_id_padre']."' >".$data['mm_nombre']."</option>";
		}

		print $html;


	break;

	case 'modxTipMar_obte':

		#code
		$sql=sql::kd_modxTipMar_obte($_POST['tipId'],$_POST['marId']);
		$data1=negocio::getData($sql);
		$html="";

		foreach($data1 as $data)
		{
			# code...
			$html.="<option value='".$data['mm_id']."' >".$data['mm_nombre']."</option>";
		}

		print $html;

	break;

	case 'marLine_obte':

		$sql=sql::kd_marLine_obte($_POST['catId']);
		$data1=negocio::getData($sql);
		$html="";

		foreach($data1 as $data)
		{
			#code
			$html.="<option value='".$data['marId']."' >".$data['marDes']."</option>";
		}

		print $html;

	break;

	case 'lineProdxEw_obte':

		#code
		$sql=sql::lp_lineProdxEw_obte($_POST['valEw']);
		$dataLineId=negocio::getData($sql);
		$dataLineProd=array();
		$dataLine=array();
		$html="";

		foreach ($dataLineId as $data2) 
		{
			# code...
			desconectar();
			conectar();

			$sql=sql::lp_listLineProd($_POST['desBus'],$_POST['tare'],$data2['lp_lineProdId']);
			$dataLine=negocio::getData($sql);

			$dataLineProd=$dataLine;

			//iterar resultados

			foreach ($dataLineProd as $data) 
			{
				desconectar();
				conectar();

				$sql=sql::kd_stockAgru_obte($data['id']);
				$dataUbi=negocio::getData($sql);
				$flag=0;
				$cadUbi="";

				for($i=0;$i<count($dataUbi);$i++)
				{
					if($flag==0)
					{
						$cadUbi=$dataUbi[$i]['ubiEmp'];
					}
					else
					{
						$cadUbi=$cadUbi."<br>".$dataUbi[$i]['ubiEmp'];
					}

					$flag++;
				}

				$html.="<tr>
							<td><input type='radio' name='kd_lineId' id='kd_lineId' value='".$data['id']."' ></td>
							<td>".$data['cod']."</td>
							<td>".$data['sub']."</td>
							<td>".$data['cat']."</td>
							<td>".$data['mar']."</td>
							<td>".$data['nomEspa']."</td>
							<td>".$data['nomIngle']."</td>
							<td>".str_replace("\n","<br>",$data['des'])."</td>
							<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
							<td>".$cadUbi."</td>
						</tr>";
			}
		}


		echo $html;

	end;

	case 'busLineProd':

		$sql=sql::lp_listLineProd($_POST['desBus'],$_POST['tare'],1);
		$dataLineProd=negocio::getData($sql);
		$html="";

		foreach ($dataLineProd as $data) 
		{
			desconectar();
			conectar();

			$sql=sql::kd_stockAgru_obte($data['id']);
			$dataUbi=negocio::getData($sql);
			$flag=0;
			$cadUbi="";

			for($i=0;$i<count($dataUbi);$i++)
			{
				if($flag==0)
				{
					$cadUbi=$dataUbi[$i]['ubiEmp'];
				}
				else
				{
					$cadUbi=$cadUbi."<br>".$dataUbi[$i]['ubiEmp'];
				}

				$flag++;
			}

			$html.="<tr>
						<td><input type='radio' name='kd_lineId' id='kd_lineId' value='".$data['id']."' ></td>
						<td>".$data['cod']."</td>
						<td>".$data['sub']."</td>
						<td>".$data['cat']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['nomIngle']."</td>
						<td>".str_replace("\n","<br>",$data['des'])."</td>
						<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
						<td>".$cadUbi."</td>
					</tr>";
		}

		echo $html;

	break;

	case 'serixProd_cap':
		
		# code...
		$sql=sql::kd_serixProd_cap($_POST['prodId'],$_POST['almcId']);
		$data1=negocio::getData($sql);
		$html="";
		$ind=1;

		foreach($data1 as $data)
		{
			$html.="<tr>
						<td align='center' ><input type='checkbox' value='".$data['kd_numSeriId']."' name='kd_seriStock[]' id='kd_seriStock' ></td>
						<td>".$ind++."</td>
						<td>".$data['kd_numSeri']."</td>
						<td>".$data['kd_fechIngre']."</td>
					</tr>";
		}

		print $html;

	break;

	case 'almEmp_cap':

		$sql=sql::kd_almEmp_cap();
		$data1=negocio::getData($sql);
		$html="";

		foreach($data1 as $data)
		{
			#code
			$html.="<option value='".$data['almId']."' >".$data['almDes']."</option>";
		}

		print $html;

	break;

	case 'detNot_cap': //new!

		$sql=sql::kd_detNot_cap($_POST['notId']);
		$dataLine=negocio::getData($sql);
		$html="";

		foreach ($dataLine as $data) 
		{
			desconectar();
			conectar();

			$sql=sql::kd_stockAgru_obte($data['id']);
			$dataUbi=negocio::getData($sql);
			$flag=0;
			$cadUbi="";

			for($i=0;$i<count($dataUbi);$i++)
			{
				if($flag==0)
				{
					$cadUbi=$dataUbi[$i]['ubiEmp'];
				}
				else
				{
					$cadUbi=$cadUbi."<br>".$dataUbi[$i]['ubiEmp'];
				}

				$flag++;
			}

			$html.="<tr>
						<td><input type='radio' name='kd_lineId' id='kd_lineId' value='".$data['id']."' ></td>
						<td>".$data['cod']."</td>
						<td>".$data['sub']."</td>
						<td>".$data['cat']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['nomIngle']."</td>
						<td>".str_replace("\n","<br>",$data['des'])."</td>
						<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
						<td align='center' class='kd_soliProd' >".$data['cantDet']."</td>
						<td>".$cadUbi."</td>
					</tr>";
		}

		echo $html;

	break;

	case 'notPend_cap': //new! --

		$sql=sql::kd_notPend_cap($_POST['tipMov']);
		$dataNot=negocio::getData($sql);
		$html="<option></option>";

		foreach ($dataNot as $data) 
		{
			# code...
			$html.="<option value='".$data['notId']."' >".$data['correNot']."</option>";
		}

		print $html;

	break;

	//New update 30/12/2014

	case 'kd_prodxNum_read':

		$sql=sql::kd_prodxNum_read($_POST['numSeri']);
		$dataProd=negocio::getData($sql);
		$html="";

		foreach ($dataProd as $data) 
		{
			# code...
			$html.="<tr>
						<td>".$data['codigo']."</td>
						<td>".$data['marca']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['descrip']."</td>
						<td>".$data['seri']."</td>
					</tr>";
		}

		print $html;

	break;

	case 'kd_histNum_read':

		$sql=sql::kd_histNum_read($_POST['numSeri']);
		$dataMov=negocio::getData($sql);
		$html="";

		foreach($dataMov as $data)
		{
			$html.="<tr>
						<td>
							<a href='Javascript:kd_direDetKardx(".$data['kardxId'].",".$data['tipId'].")' >".$data['cod']."</a>
						</td>
						<td>".$data['mov']."</td>
						<td>".$data['fechCre']."</td>
						<td>".$data['emp']."</td>
						<td>".$data['ew']."</td>
						<td>".$data['ref']."</td>
						<td>".$data['obs']."</td>
						<td>".$data['num']."</td>
					</tr>";
		}

		print $html;

	break;
	
	default:
		# code...
	break;
}

?>