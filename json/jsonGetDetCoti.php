<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	/* INICIAR EL ID DE DETALLE Y ARRAY DE CAPTURA  */
	$idDet=$_GET['idDet'];
	$detFl=Array();

	/* INICIAR DATA SESSION */
	session_start();

	/* RECORRER DATA SESSION */

	foreach ($_SESSION['arrCotiFl'] as $data) 
	{
		if($data['cotDetId']==$idDet)
		{
			$detFl[0]['cotDetId']=$data['cotDetId'];
			$detFl[0]['prodClasiId']=$data['prod_clasificacion_id'];
			$detFl[0]['producto_id']=$data['producto_id'];
			$detFl[0]['prodNom']=negocio::getProdxId($data['producto_id']);
			$detFl[0]['moneda_id']=$data['moneda_id'];
			$detFl[0]['moneNom']=negocio::getMonexId($data['moneda_id']);
			$detFl[0]['cant']=$data['cant'];
			$detFl[0]['preUni']=$data['preUni'];
			$detFl[0]['subTot']=$data['subTot'];
			$detFl[0]['proveedorId']=$data['proveedorId'];
			$detFl[0]['proveNom']=negocio::getProvexId($data['proveedorId']);
			$detFl[0]['plazo']=$data['plazo'];
			$detFl[0]['pro_descripcion']=$data['pro_descripcion'];
		}
	}

	echo json_encode($detFl);

?>

		
