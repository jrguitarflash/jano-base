<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

switch ($_REQUEST['json']) 
{
	case 'imporProd':
		
		$rowAfect=0;

		for($i=0;$i<count($_POST['arrProd']);$i++)
		{
			$sql=sql::lp_imporProd($_POST['arrProd'][$i]);
			$filAfect=negocio::getVal($sql,'response');

			$rowAfect=$rowAfect+$filAfect;

			desconectar();
			conectar();
		}

		$msj=Array();
		$msj[0]=$rowAfect;

		echo json_encode($msj);

	break;

	case 'eliLineProd':

		$sql=sql::lp_eliLineProd($_GET['idLine']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'iniConfStock':
		# code...
		$sql=sql::lp_iniConfStock($_GET['lineStockId']);
		$dataConfStock=negocio::getData($sql);

		echo json_encode($dataConfStock);

	break;

	case 'actuConfStock':

		$sql=sql::lp_actuConfStock($_GET['stockMin'],$_GET['stockMax'],$_GET['preUni'],$_GET['moneId'],$_GET['lineId']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevProd':

		//$marMod=explode("|",$_GET['marMod']);

		//$sql=sql::lp_lineProd_ingre($_GET['subClasi'],$_GET['cate'],$_GET['tip'],$marMod[0],$marMod[1],$_GET['nomEspa'],$_GET['nomIngle'],$_GET['desProd']);
		$sql=sql::lp_lineProd_ingre($_GET['subClasi'],$_GET['cate'],$_GET['mar'],$_GET['nomEspa'],$_GET['nomIngle'],$_GET['desProd'],$_GET['stockMin'],$_GET['stockMax']);

		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevSub':

		$sql=sql::lp_subClasi_nuev($_GET['subClasi']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevCate':

		$sql=sql::lp_cate_nuev($_GET['subClasi'],$_GET['cate']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevTip':

		$sql=sql::lp_tip_nuev($_GET['cate'],$_GET['tip']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevMarMod':

		$sql=sql::lp_marMod_nuev($_GET['mar'],$_GET['tip'],$_GET['mod'],$_GET['mod']);
		$filAfect1=negocio::getVal($sql,'response');			
		
		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'nuevMar':


		//validar ingreso de marca
		$sql=sql::lp_ingreMar_vali($_GET['mar']);
		$valiIngre=negocio::getVal($sql,'response');


		if($valiIngre>=1)
		{
			$filAfect1=2;
		}
		else
		{
			desconectar();
			conectar();

			$sql=sql::lp_mar_nuev($_GET['mar'],$_GET['mar']);
			$filAfect1=negocio::getVal($sql,'response');

		}

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'prodCread_ini':

		$sql=sql::lp_prodCread_ini($_GET['idLine']);
		$data1=negocio::getData($sql);

		echo json_encode($data1);
	
	break;

	case 'prodCread_actu':

		$sql=sql::lp_prodCread_actu($_GET['idLine'],$_GET['sub'],$_GET['cat'],$_GET['mar'],$_GET['nomEspa'],$_GET['nomIng'],$_GET['des'],$_GET['min'],$_GET['max']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;

	case 'movExis_eva':

		$sql=sql::lp_movExis_eva($_GET['idLine']);
		$filAfect1=negocio::getVal($sql,'response');

		$msj=Array();
		$msj[0]=$filAfect1;

		echo json_encode($msj);

	break;
	
	default:
		# code...
	break;
}

?>