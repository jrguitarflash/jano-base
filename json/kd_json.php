<?php 

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

switch ($_REQUEST['json']) 
{
	case 'geneMovKardx':
	
		$sql=sql::kd_geneMovKardx($_GET['tipMov'],
								  $_GET['ewCompId'],
								  $_GET['almcId'],
								  $_GET['empId'],
								  $_GET['kd_transId'],
								  $_GET['fechMov'],
								  $_GET['tipDoc'],
								  $_GET['numDoc'],
								  $_GET['desMov'],
								  $_GET['kd_desti'],
								  $_GET['kd_numFac'],
								  $_GET['kd_FacEmis']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;
		echo json_encode($msj);

	break;

	case 'emp_obte':

		$sql=sql::kd_emp_obte($_GET['filBus']);
		$dataEmp=negocio::getData($sql);

		echo json_encode($dataEmp);

	break;

	case 'detKard3_agre':

		/*
		$sql=sql::kd_actuStockLine($_GET['prodId'],$_GET['tipMov'],$_GET['kdxCant']);
		$filAfect2=negocio::getVal($sql,'response');
		*/

		$filAfect2=1;

		desconectar();
		conectar();

		// Evaluar esta de stock
		if($_GET['tipMov']==3)
		{
			$estaStock=1;
		}
		else
		{
			$estaStock=2;
		}

		# code...
		if($filAfect2==1)
		{
			$sql=sql::kd_detKard_agre($_GET['kdxId'],$_GET['prodId'],$_GET['preUni'],$_GET['kdxCant'],$_GET['almcId'],$_GET['obsItem']);
			$filAfect1=negocio::getVal($sql,'response');
			$msj=Array();
			$msj[0]=$filAfect1;

			$arrSeri=explode("|",$_GET['cadArr']);
			$filAfect2=0;
			$filAfect3=0;

			for($i=0;$i<count($arrSeri);$i++)
			{
				desconectar();
				conectar();

				$sql=sql::kd_movSeri_add($filAfect1,$arrSeri[$i],$_GET['almcId'],$estaStock);
				$filAfect3=$filAfect3+negocio::getVal($sql,'response');
			}

		}
		else
		{
			$msj=Array();
			$msj[0]=$filAfect2;	
		}

		$msj=Array();
		$msj[0]=$sql;	

		echo json_encode($msj);
	
	break;

	case 'detKard2_vali':

		// Validar numeros de serie existentes

		$arrVali=explode("|",$_GET['cadArr']);
		$arrNoti=array();
		$flagVali=0;
		$indVali=1;
		$ind=0;;

		for($i=0;$i<count($arrVali);$i++)
		{

			$sql=sql::kd_numExis_vali($arrVali[$i],$_GET['prodId']);
			$flagVali=negocio::getVal($sql,'response');

			if($flagVali>0)
			{
				$arrNoti[$ind]['ind']=$indVali;
				$arrNoti[$ind]['numSeri']=$arrVali[$i];
				$ind++;
			}

			$indVali++;

			desconectar();
			conectar();
		}

		// -- o --

		echo json_encode($arrNoti);

	break;

	case 'detKard2_agre':

		/*
			$sql=sql::kd_actuStockLine($_GET['prodId'],$_GET['tipMov'],$_GET['kdxCant']);
			$filAfect2=negocio::getVal($sql,'response');
		*/

		$filAfect2=1;

		desconectar();
		conectar();

		# code...
		if($filAfect2==1)
		{
			$sql=sql::kd_detKard_agre($_GET['kdxId'],$_GET['prodId'],$_GET['preUni'],$_GET['kdxCant'],$_GET['almcId'],$_GET['obsItem']);
			$filAfect1=negocio::getVal($sql,'response');
			$msj=Array();
			$msj[0]=$filAfect1;

			$arrSeri=explode("|",$_GET['cadArr']);
			$filAfect2=0;
			$filAfect3=0;

			for($i=0;$i<count($arrSeri);$i++)
			{
				desconectar();
				conectar();

				$sql=sql::kd_numSeri_ingre($filAfect1,'',$arrSeri[$i],$_GET['almcId']);
				$filAfect2=$filAfect2+negocio::getVal($sql,'response');

			}

		}
		else
		{
			$msj=Array();
			$msj[0]=$filAfect2;	
		}

		echo json_encode($msj);
	
	break;

	case 'detKard_agre':

		$sql=sql::kd_actuStockLine($_GET['prodId'],$_GET['tipMov'],$_GET['kdxCant']);
		$filAfect2=negocio::getVal($sql,'response');

		desconectar();
		conectar();

		# code...
		if($filAfect2==1)
		{
			$sql=sql::kd_detKard_agre($_GET['kdxId'],$_GET['prodId'],$_GET['preUni'],$_GET['kdxCant']);
			$filAfect1=negocio::getVal($sql,'response');
			$msj=Array();
			$msj[0]=$filAfect1;
		}
		else
		{
			$msj=Array();
			$msj[0]=$filAfect2;	
		}

		echo json_encode($msj);
	
	break;

	case 'geneMov_upd':

		# code...
		$sql=sql::kd_geneMov_upd($_GET['kdxId'],
								$_GET['tipMov'],
								$_GET['empId'],
								$_GET['fechMov'],
								$_GET['tipDoc'],
								$_GET['numDoc'],
								$_GET['desMov'],
								$_GET['moneMov'],
								$_GET['almcId'],
								$_GET['kd_desti'],
								$_GET['kd_transId'],
								$_GET['kd_numFac'],
								$_GET['kd_FacEmis'],
								$_GET['ewCompId']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'eliDetMov':

		$sql=sql::kd_reverStock($_GET['tipMov'],$_GET['idKdxDet']);
		$filAfect2=negocio::getVal($sql,'response');

		desconectar();
		conectar();

		if($filAfect2>0)
		{
			# code
			$sql=sql::kd_serixDet_cap($_GET['idKdxDet']);
			$data1=negocio::getData($sql);

			desconectar();
			conectar();

			$sql=sql::kd_eliDetMov($_GET['idKdxDet']);
			$filAfect1=negocio::getVal($sql,'response');

			if($_GET['tipMov']==1)
			{

				foreach($data1 as $data)
				{
					desconectar();
					conectar();

					$sql=sql::kd_serixId_eli($data['seriId']);
					$filAfect3=negocio::getVal($sql,'response');
				}

			}
			else if($_GET['tipMov']==2)
			{
				foreach($data1 as $data)
				{
					desconectar();
					conectar();

					$sql=sql::kd_seriStock_actu($data['seriId'],$_GET['tipMov'],$_GET['idKdxDet']);
					$filAfect3=negocio::getVal($sql,'response');
				}
			}
			else if($_GET['tipMov']==3)
			{
				foreach($data1 as $data)
				{
					desconectar();
					conectar();

					$sql=sql::kd_seriStock_actu($data['seriId'],$_GET['tipMov'],$_GET['idKdxDet']);
					$filAfect3=negocio::getVal($sql,'response');
				}
			}
			else
			{
				$excep="ningun tipo en el flujo";
			}

			$msj=Array();
			$msj[0]=$filAfect1;
		}
		else
		{
			$msj=Array();
			$msj[0]=$filAfect2;
		}

		echo json_encode($msj);

	break;

	case 'iniGenKardx':

		$sql=sql::kd_iniGenKardx($_GET['kardxId']);
		$dataGenKardx=negocio::getData($sql);

		echo json_encode($dataGenKardx);

	break;

	case 'numSeri_ingre':

		$sql=sql::kd_numSeri_ingre($_GET['detKadxId'],$_GET['desProd'],$_GET['numSeri']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'seriMov_eli':

		$sql=sql::kd_seriMov_eli($_GET['detMovId']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'movSeri_aña':
		
		# code...
		$filAfect1=0;

		for($i=0;$i<count($_POST['idNumSeri']);$i++)
		{
			$sql=sql::kd_movSeri_add($_POST['detKardxId'],$_POST['idNumSeri'][$i]);
			$filAfect1=$filAfect1+negocio::getVal($sql,'response');

			desconectar();
			conectar();
		}
		

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'seriStock_regre':

		# code...
		$filAfect1=0;

		for ($i=0;$i<count($_POST['detMovId']);$i++) 
		{ 
			$sql=sql::kd_seriStock_regre($_POST['detMovId'][$i]);
			$filAfect1=$filAfect1+negocio::getVal($sql,'response');

			desconectar();
			conectar();
		}
		

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);
	
	break;

	case 'movKardx_eli':

		$sql=sql::kd_movKardx_eli($_GET['kardxId']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'glosaMov_actu':

		$filAfect=0;

		for($i=0;$i<count($_POST['detArr']);$i++)
		{
			$sql=sql::kd_glosaMov_actu($_POST['detArr'][$i],$_POST['glosaArr'][$i],$_POST['itemArr'][$i],$_POST['uniArr'][$i],$_POST['chkArr'][$i],$_POST['prodArr'][$i]);
			$filAfect1+=negocio::getVal($sql,'response');
		}

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevTrans_crear':

		#code
		$sql=sql::kd_nuevTrans_crear($_GET['transNom'],$_GET['transApe'],$_GET['transDni'],$_GET['transRuc'],$_GET['transDomi']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'trans_cap':

		#code
		$sql=sql::kd_trans_cap();
		$data1=negocio::getData($sql);

		echo json_encode($data1);

	break;

	case 'empTrans_crear':

		#code
		$sql=sql::kd_empTrans_crear($_GET['empNom'],$_GET['ruc'],$_GET['dire'],$_GET['tel']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'empTrans_obte':

		#code
		$sql=sql::kd_empTrans_obte();
		$data1=negocio::getData($sql);

		echo json_encode($data1);

	break;

	case 'ewComp_cap':

		#code
		$sql=sql::kd_ewComp_cap();
		$data1=negocio::getData($sql);

		echo json_encode($data1);

	break;

	case 'ingMov_vali':

		#code
		$sql=sql::kd_ingMov_vali($_GET['kardxId']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'atenNot_confir':

		#code
		session_start();
		$sql=sql::kd_atenNot_confir($_GET['notId'],$_SESSION['SIS'][2]);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	//New update 30/12/2014

	case 'kd_numSeri_read':

		$sql=sql::kd_numSeri_read();
		$dataSeri=negocio::getData($sql);

		echo json_encode($dataSeri);

	break;

	default:
		# code...
	break;
}

?>