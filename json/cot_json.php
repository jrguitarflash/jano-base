<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

	switch ($_REQUEST['json']) 
	{
		case 'cot_checkVali':
			$sql=sql::cot_checkVali($_GET['valActi'],$_GET['idCoti'],$_GET['tare']);
			$filAfect=negocio::getVal($sql,'response');
			$msj=Array();
			$msj[0]=$filAfect;
			echo json_encode($msj);
		break;

		//New update 07/01/2015 - CLOSE

		case 'cot_itemCot_ord':

			$ordVal=$_POST['ordVal'];
			$filAcum=0;

			for($i=0;$i<count($_POST['arrCheck']);$i++)
			{
				desconectar();
				conectar();

				$sql=sql::cot_itemCot_ord($_POST['arrCheck'][$i],$ordVal);
				$filAfect=negocio::getVal($sql,'response');
				$ordVal++;
				$filAcum=$filAcum+$filAfect;
			}

			$data=Array();
			$data[0]=$filAcum;

			echo json_encode($data);

		break;
		
		default:
			$msj=Array();
			echo json_encode($msj);
		break;
	}

?>