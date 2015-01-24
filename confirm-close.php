<?php 
	session_start(); 
	include("include/comun.php");
?>

<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />
<link rel="stylesheet" type="text/css" href="<?=get_style($_SESSION['SIS'][5])?>" />

<?php

	//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//
	
	#require('conf.php');
	#require_once('clases/sql/sql.class.php');
	#require_once('clases/negocio/negocio.class.php');
	
	//echo $_POST['val'];

	if(isset($_POST['accion'])) 
	{
		switch($_GET['tip']) 
		{
	
		case 'soli':

			$acciReli=$_POST['acciReli'];
			$acciReli=negocio::reorAcci($acciReli);
			$sql=sql::ActEstaReclaSolu($_GET['id'],$acciReli);
			$numAfec=negocio::setData($sql);
			$corre1=base64_decode($_GET['corre1']);
			$corre2=base64_decode($_GET['corre2']);
			$corre3=base64_decode($_GET['corre3']);
			$sr=base64_decode($_GET['sr']);
			$sr2=base64_decode($_GET['sr2']);

			#print ($corre1." ".$corre2." ".$sr);

			$valAdju=negocio::subirImagen($_FILES['adjunt']['name'],$_FILES['adjunt']['tmp_name'],$_FILES['adjunt']['size'],$_FILES['adjunt']['type']);
			$veriEnv=setEmailAcep($_GET['id'],$sr,$sr2,$corre1,$corre2,$corre3,'soli',$acciReli,$valAdju);
			print msjNotifi('La confirmacion de solicitud de cierre se ha realizado correctamente');

		break;
		
		case 'recha':

			$sql=sql::ActEstaReclaRecha($_GET['id']);;
			$numAfec=negocio::setData($sql);
			$corre1=base64_decode($_GET['corre1']);
			$corre2=base64_decode($_GET['corre2']);
			$corre3=base64_decode($_GET['corre3']);
			$sr=base64_decode($_GET['sr']);
			$sr2=base64_decode($_GET['sr2']);

			#print ($corre1." ".$corre2." ".$sr);

			$valAdju=negocio::subirImagen($_FILES['adjunt']['name'],$_FILES['adjunt']['tmp_name'],$_FILES['adjunt']['size'],$_FILES['adjunt']['type']);
			$veriEnv=setEmailAcep($_GET['id'],$sr,$sr2,$corre1,$corre2,$corre3,'recha',$_POST['acciReli'],$valAdju);
			print msjNotifi('La confirmacion de solicitud de rechazo se ha realizado correctamente');
		
		break;		
		
		default:
		break;	
		
		}
	}

?>

<form name="soliConfir" id="soliConfir" method="post" enctype="multipart/form-data">
	<label id="lbl">Acciones Realizadas:</label>
	<textarea id="acciReli" name="acciReli" class="campo acciReli"></textarea>
	<?php 
	if($_GET['tip']=='recha') {
			$btnVal="rechazar";
	}
	else{
			$btnVal="solicitar cierre";
	 }
	?>
	<label id="lbl">Adjuntar:</label>
	<input type="file" name="adjunt" class="campo">
	<input type="submit" value="<?php print $btnVal; ?>" class="btnDetVisi moveLug">
	<input type="hidden" name="accion" value="accion">
</form>

