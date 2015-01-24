<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* RECIBIR TAREA Y EJECUTAR */

	$tare=$_POST['tare'];
	switch($tare)
	{
		case 'valid':

			/* RECIBIR ID DE MOVIMIENTO Y ARRAY DE APROBACIONES*/
			$idMov=$_POST['idMov'];
			$arrAprob=Array();
			$arrAprob=$_POST['arrValid'];

			/* APROBAR MOVIMIENTO */
			$sql=sql::mp_validAprobMov($idMov,1,$arrAprob,0);
			$filAfect1=negocio::setData($sql);

			for($i=0;$i<count($arrAprob);$i++)
			{
				$ind=$i;
				if($ind==0 or $ind==3 or $ind==6 )
				{
					$sql=sql::mp_validAprobMov($idMov,2,$arrAprob,$ind);
					$filAfect2=negocio::setData($sql);
				}
			}

			$sql=sql::mp_validAprobMov($idMov,3,$arrAprob,0);
			$filAfect3=negocio::setData($sql);

			$noti=$filAfect2." Aprobacion de movimiento correctamente....!";
			$msj=negocio::msjNotifi($noti);


		break;

		case 'cancel':

			/* RECIBIR ID DE MOVIMIENTO Y ARRAY DE APROBACIONES*/
			$idMov=$_POST['idMov'];
			$arrAprob=Array();
			$arrAprob=$_POST['arrValid'];

			$sql=sql::mp_cancelAprobMov($idMov,1);
			$filAfect1=negocio::setData($sql);

			$sql=sql::mp_cancelAprobMov($idMov,2);
			$filAfect2=negocio::setData($sql);

			$noti=$filAfect2." Movimiento cancelado correctamente....!";
			$msj=negocio::msjNotifi($noti);

		break;

		case 'confirm':

			/* CONFIRMAR RETORNO DE PERSONAL */
			$idMov=$_POST['idMov'];
			$sql=sql::mp_confirRetor($idMov);
			$filAfect=negocio::setData($sql);

		break;

		default:
		break;
	}

	$arrMsj=Array();
	$arrMsj[0]=$msj;
	echo json_encode($arrMsj);

?>