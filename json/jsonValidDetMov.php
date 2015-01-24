<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* INICIAR SESION */
	
	session_start();

/* RECORRER LOS MOVIMIENTOS SELECCIONADOS  */

	$filAfect1=0;
	for($i=0;$i<count($_POST['arrDetMov']);$i++)
	{

		/* FECHA Y HORA ACTUAL */
		$fechValid=date("Y-m-d H:i:s",time()-3600);

		/* TIPO DE APROBACION */
		$tipAprov=$_POST['idAprob'];

		/* VALIDAR LOS MOVIMIENTO */
		$sql=sql::mp_validDetMov($fechValid,$_POST['arrDetMov'][$i],$tipAprov,$_SESSION['SIS'][2]);
		$filAfect1=$filAfect1+negocio::setData($sql);
	}

	$dataResul=Array();
	/*
	$data2[0]=$_POST['arrDetMov'][0];
	$data2[1]=$_POST['arrDetMov'][1];
	$data2[2]=count($_POST['arrDetMov']);
	*/

	$noti1=$filAfect1." Movimientos validados correctamente...!";

	$dataResul[0]=$filAfect1;
	$dataResul[1]=negocio::msjNotifi($noti1);
	echo json_encode($dataResul);

?>