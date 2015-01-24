<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//
session_start();
//require('conf.php');
require('include/comun.php');
//require_once('clases/sql/sql.class.php');
//require_once('clases/negocio/negocio.class.php');

//echo $_POST['val'];
if(isset($_GET['tip'])) 
{
	switch($_GET['tip']) 
	{
	case 'acep':
		$sql=sql::ActEstaReclaAcep($_GET['id']);
		$numFil=negocio::setData($sql);
		$corre1=base64_decode($_GET['corre1']);
		$corre2=base64_decode($_GET['corre2']);
		$corre3=base64_decode($_GET['corre2']);
		$sr=base64_decode($_GET['sr']);
		$sr2=base64_decode($_GET['sr2']);
		#print ($corre1." ".$corre2." ".$sr);
		$veriEnv=setEmailAcep($_GET['id'],$sr,$sr2,$corre1,$corre2,$corre3,'acep','','');
		$msj="Aceptacion";
	break;
	
	case 'recha':
		$sql=sql::ActEstaReclaRecha($_GET['id']);
		$numFil=negocio::setData($sql);
		$msj="Rechazo";
	break;

	case 'solu':
		$sql=sql::ActEstaReclaSolu($_GET['id']);
		$numFil=negocio::setData($sql);
		$msj="Solicitud de cierre";
	break;
	
	default:
	break;	
	
	}
}
?>

<h1>La confirmacion de <?php print $msj; ?> se ha realizado correctamente</h1>
