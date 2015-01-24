<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");
session_start();

switch ($_REQUEST['json']) 
{

	case 'vi_geneForm':

		if($_GET['idVisi']==0)
		{
		
			//Generando Form dinamico de pasajes
			if(is_array($_SESSION['detVisi'])) 
			{			
				$detVisi=$_SESSION['detVisi'];
			}
		}
		else
		{

			//Generando Form Dinamico
			$sql=sql::vi_visixId_ini($_GET['idVisi']);
			$dataVisi=negocio::getData($sql);

			//instanciando array
			$detVisi=Array();

			//iterando array
			$ind=0;
			foreach($dataVisi as $data)
			{
				$detVisi[$ind]['dirOrig']=$data['vi_dirOri'];
				$detVisi[$ind]['empresa']=$data['empresa'];
				$detVisi[$ind]['direccion']=$data['vi_dirEmp'];
				$ind++;
			}
		}

		echo json_encode($detVisi);

	break;

	case 'vi_detVisi_borra':

		$sql=sql::vi_detVisi_borra($_GET['idDet']);
		$detAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$detAfect;

		echo json_encode($data);

	break;

	case 'vi_visiResp_borra':

		$sql=sql::vi_visiResp_borra($_GET['visiId']);
		$visiAfect=negocio::getVal($sql,'response');

		$data=Array();
		$data[0]=$visiAfect;

		echo json_encode($data);

	break;

	default:
	break;

}