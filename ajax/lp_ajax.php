<?php

require("../conf.php");
require("../clases/negocio/negocio.class.php");
require("../clases/sql/sql.class.php"); 

switch ($_REQUEST['ajax']) 
{
	case 'cateProd':

		$sql=sql::lp_obteCatexid($_POST['idSubClasi']);
		$dataCatProd=negocio::getData($sql);
		$html="";

		foreach($dataCatProd as $data) 
		{
			$html.="<option value='".$data['catId']."' >".$data['catDes']."</option>";
		}

		echo $html;

	break;

	case 'tipProd':
		$sql=sql::lp_obteTipxId($_POST['idCate']);
		$dataTipProd=negocio::getData($sql);
		$html="";

		foreach ($dataTipProd as $data) 
		{
			$html.="<option value='".$data['tipId']."' >".$data['tipDes']."</option>";
		}

		echo $html;

	break;

	case 'marMod':
		$sql=sql::lp_obteMarModxId($_POST['idTip']);
		$dataMarMod=negocio::getData($sql);
		$html="";

		foreach($dataMarMod as $data) 
		{
			$html.="<option value='".$data['idPad']."|".$data['idMod']."' >".$data['marModel']."</option>";
		}

		echo $html;

	break;

	case 'listProd':
		$arrMarMod=explode("|",$_POST['idMarMod']);
		$sql=sql::lp_obteProdxid($arrMarMod[0],$arrMarMod[1],$_POST['idTip'],$_POST['idCate'],$_POST['idSub']);
		$dataProd=negocio::getData($sql);
		$html="";

		foreach ($dataProd as $data) 
		{
			
			$html.="<tr>
						<td><input type='checkbox' value='".$data['prodId']."' name='chkProdId[]' id='chkProdId' ></td>
						<td>".$data['prodId']."</td>
						<td>".$data['prodNom']."</td>
						<td>".$data['prodAli']."</td>
						<td>".$data['ubiDes']."</td>
						<td>".$data['prodDes']."</td>
					</tr>";
		}

		echo $html;

	break;

	case 'lineProd':

		$sql=sql::lp_listLineProd('','todo',1);
		$dataLineProd=negocio::getData($sql);
		$html="";

		foreach ($dataLineProd as $data) 
		{

			$acci="Javascript:lp_nuevProd_edit('".$data['id']."','edit')";

			desconectar();
			conectar();

			//obtener todos los numeros de serie
			$flag2=0;
			$numSeri="";
			$sql=sql::kd_seriTot_cap($data['id']);
			$dataSeriTot=negocio::getData($sql);

			desconectar();
			conectar();

			for($i=0;$i<count($dataSeriTot);$i++)
			{
				if($flag2==0)
				{
					$numSeri=$dataSeriTot[$i]['kd_numSeri'];
				}
				else
				{
					$numSeri=$numSeri."<br>".$dataSeriTot[$i]['kd_numSeri'];
				}
				$flag2++;
			}

			desconectar();
			conectar();

			//stock agrupado por almacenes

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

			/*$html.="<tr>
						<td><input type='checkbox' name='lp_lineProdId[]' value='".$data['id']."' id='lp_lineProdId' ></td>
						<td>".$data['cod']."</td>
						<td>".$data['sub']."</td>
						<td>".$data['cat']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['nomIngle']."</td>
						<td>".str_replace("\n","<br>",$data['des'])."</td>
						<td>".$data['stockMin']."</td>
						<td>".$data['stockMax']."</td>
						<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
						<td>
							<a href='Javascript:lp_eliLineProd(".$data['id'].")' >Eliminar</a>
							<a href=".$acci." >Editar</a>
						</td>
					</tr>";*/

			$html.="<tr>
						<td><input type='checkbox' name='lp_lineProdId[]' value='".$data['id']."' id='lp_lineProdId' ></td>
						<td>".$data['cod']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".str_replace("\n","<br>",$data['des'])."</td>
						<td>".$data['stockMin']."</td>
						<td>".$data['stockMax']."</td>
						<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
						<td>".$cadUbi."</td>
						<td>".$numSeri."</td>
						<td>
							<a href='Javascript:lp_eliLineProd(".$data['id'].")' >Eliminar</a>
							<a href=".$acci." >Editar</a>
						</td>
					</tr>";
		}

		echo $html;

	break;

	case 'busLineProd':

		$sql=sql::lp_listLineProd($_POST['desBus'],$_POST['tare'],1);
		$dataLineProd=negocio::getData($sql);
		$html="";

		foreach ($dataLineProd as $data) 
		{
			$acci="Javascript:lp_nuevProd_edit('".$data['id']."','edit')";

			desconectar();
			conectar();

			$sql=sql::kd_stockAgru_obte($data['id']);
			$dataUbi=negocio::getData($sql);
			$flag=0;
			$cadUbi="";
			$stock=0;
			$flag2=0;
			$numSeri="";

			//Obtener numeros de serie

			desconectar();
			conectar();

			if($_POST['almcTip']==6)
			{
				$sql=sql::kd_seriTot_cap($data['id']);
				$dataSeriTot=negocio::getData($sql);

				desconectar();
				conectar();

				for($i=0;$i<count($dataSeriTot);$i++)
				{
					if($flag2==0)
					{
						$numSeri=$dataSeriTot[$i]['kd_numSeri'];
					}
					else
					{
						$numSeri=$numSeri."<br>".$dataSeriTot[$i]['kd_numSeri'];
					}
					$flag2++;
				}
			}
			else
			{
				$sql=sql::kd_serixProd_cap($data['id'],$_POST['almcTip']);
				$dataSeri=negocio::getData($sql);

				desconectar();
				conectar();

				for($i=0;$i<count($dataSeri);$i++)
				{
					if($flag2==0)
					{
						$numSeri=$dataSeri[$i]['kd_numSeri'];
					}
					else
					{
						$numSeri=$numSeri."<br>".$dataSeri[$i]['kd_numSeri'];
					}
					$flag2++;
				}
			}

			//evaluar filtros de almacenes

			if($_POST['almcTip']==1) //Barbones
			{
				$cadUbi=$dataUbi[0]['ubiEmp'];
				$stock=$dataUbi[0]['stockAlmc'];
			}
			else if($_POST['almcTip']==2) //Telleria
			{
				$cadUbi=$dataUbi[1]['ubiEmp'];
				$stock=$dataUbi[1]['stockAlmc'];
			}
			else if($_POST['almcTip']==3) //RMA 
			{
				$cadUbi=$dataUbi[2]['ubiEmp'];
				$stock=$dataUbi[2]['stockAlmc'];
			}
			else if($_POST['almcTip']==4) //OF. Central
			{
				$cadUbi=$dataUbi[3]['ubiEmp'];
				$stock=$dataUbi[3]['stockAlmc'];
			}
			else if($_POST['almcTip']==5) //Reservas
			{
				$cadUbi=$dataUbi[4]['ubiEmp'];
				$stock=$dataUbi[4]['stockAlmc'];
			}
			else
			{
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

				$stock=$data['stockActu2'];
			}

			/*
			$html.="<tr>
						<td><input type='checkbox' name='lp_lineProdId[]' value='".$data['id']."' id='lp_lineProdId' ></td>
						<td>".$data['cod']."</td>
						<td>".$data['sub']."</td>
						<td>".$data['cat']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['nomIngle']."</td>
						<td>".str_replace("\n","<br>",$data['des'])."</td>
						<td>".$data['stockMin']."</td>
						<td>".$data['stockMax']."</td>
						<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
						<td>
							<a href='Javascript:lp_eliLineProd(".$data['id'].")' >Eliminar</a>
							<a href=".$acci." >Editar</a>
						</td>
					</tr>";
			*/

			if($_POST['dispo']==1 and $stock>-1)
			{
				$html.="<tr>
							<td><input type='checkbox' name='lp_lineProdId[]' value='".$data['id']."' id='lp_lineProdId' ></td>
							<td>".$data['cod']."</td>
							<td>".$data['mar']."</td>
							<td>".$data['nomEspa']."</td>
							<td>".str_replace("\n","<br>",$data['des'])."</td>
							<td>".$data['stockMin']."</td>
							<td>".$data['stockMax']."</td>
							<td class='kd_stockProd' align='center' >".$stock."</td>
							<td>".$cadUbi."</td>
							<td>".$numSeri."</td>
							<td>
								<a href='Javascript:lp_eliLineProd(".$data['id'].")' >Eliminar</a>
								<a href=".$acci." >Editar</a>
							</td>
						</tr>";
			}
			else if($_POST['dispo']==2 and $stock>0)
			{
				$html.="<tr>
							<td><input type='checkbox' name='lp_lineProdId[]' value='".$data['id']."' id='lp_lineProdId' ></td>
							<td>".$data['cod']."</td>
							<td>".$data['mar']."</td>
							<td>".$data['nomEspa']."</td>
							<td>".str_replace("\n","<br>",$data['des'])."</td>
							<td>".$data['stockMin']."</td>
							<td>".$data['stockMax']."</td>
							<td class='kd_stockProd' align='center' >".$stock."</td>
							<td>".$cadUbi."</td>
							<td>".$numSeri."</td>
							<td>
								<a href='Javascript:lp_eliLineProd(".$data['id'].")' >Eliminar</a>
								<a href=".$acci." >Editar</a>
							</td>
						</tr>";
			}
			else if($_POST['dispo']==3 and $stock==0)
			{
				$html.="<tr>
							<td><input type='checkbox' name='lp_lineProdId[]' value='".$data['id']."' id='lp_lineProdId' ></td>
							<td>".$data['cod']."</td>
							<td>".$data['mar']."</td>
							<td>".$data['nomEspa']."</td>
							<td>".str_replace("\n","<br>",$data['des'])."</td>
							<td>".$data['stockMin']."</td>
							<td>".$data['stockMax']."</td>
							<td class='kd_stockProd' align='center' >".$stock."</td>
							<td>".$cadUbi."</td>
							<td>".$numSeri."</td>
							<td>
								<a href='Javascript:lp_eliLineProd(".$data['id'].")' >Eliminar</a>
								<a href=".$acci." >Editar</a>
							</td>
						</tr>";
			}
			else
			{
				$html=$html;
			}

		}

		echo $html;
		
	break;

	case 'obteSubClasi':

		$sql=sql::lp_obteSubClasi();
		$dataSubClasi=negocio::getData($sql);
		$html="";

		foreach($dataSubClasi as $data)
		{
			$html.="<option value='".$data['subClasiId']."' >".$data['subClasi']."</option>";
		}

		echo $html;

	break;

	case 'marProd':

		$sql=sql::lp_marProd_mos();
		$dataMarProd=negocio::getData($sql);
		$html="";

		foreach($dataMarProd as $data)
		{
			$html.="<option value='".$data['mm_id']."' >".$data['mm_nombre']."</option>";
		}

		echo $html;

	break;

	case 'marxCat_obte':

	$sql=sql::lp_marxCat_obte();
	$data1=negocio::getData($sql);
	$html="";

	foreach ($data1 as $data) 
	{
		# code...
		$html.="<option value='".$data['mm_id']."' >".$data['mm_nombre']."</option>";
	}

	print $html;


	break;
	
	default:
		# code...
	break;
}

?>