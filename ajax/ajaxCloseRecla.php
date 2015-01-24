<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//
session_start();

require_once('../clases/mail/class.phpmailer.php');
require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

function setEmailAcep($idConfir,$sr,$emailRecep,$emailResp,$tare,$asun)
{
	$mail = new PHPMailer();

	#$body             = file_get_contents('contents.html');
	if($tare=='acep') {
		$body  = "<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />";
		$body .= ("<p>El reclamo N° RE-".str_pad($idConfir,5,'0',STR_PAD_LEFT)." asignado al  Sr. ".$sr." fue aceptado "); 
		$body .=	('para la pronta solucion</p>');
		$confir="Aceptacion";
	}
	else if($tare=='recha') {
		$body  = "<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />";
		$body .= ("<p>El reclamo N° RE-".str_pad($idConfir,5,'0',STR_PAD_LEFT)." asignado al  Sr. ".$sr." fue rechazado "); 
		$body .=	('para la pronta solucion</p>');
		$body .= ("<br/><br/>");
		$body .= ("<strong>Motivo:</strong>");
		$body .= ("<br/>");
		$body .= ("<p>".$asun."</p>");
		$confir="Rechazo";
	}
	else if($tare=='soli') {
		$body  = "<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />";
		$body .= ("<p>El reclamo N° RE-".str_pad($idConfir,5,'0',STR_PAD_LEFT)." asignado al  Sr. ".$sr." fue solicitada a cierre "); 
		$body .=	('para la pronta solucion</p>');
		$body .= ("<br/><br/>");
		$body .= ("<strong>Acciones:</strong>");
		$body .= ("<br/>");
		$body .= ("<p>".$asun."</p>");
		$confir="Solicitud de cierre";
	}
	else if($tare=='confir') {
		$body  = "<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />";
		$body .= ("<p>El reclamo N° RE-".str_pad($idConfir,5,'0',STR_PAD_LEFT)." asignado al  Sr. ".$sr." fue solucionado "); 
		$body .=	('y cerrado por el supervisor de ventas</p>');
		$body .= ("<br/><br/>");
		$confir="Cierre del reclamo";
	}
	else {
		$exception="ninguna tarea envida";	
	}

	$body  = eregi_replace("[\]",'',$body);
	
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	#$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
	   		                                   // 1 = errors and messages
	                                           // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "electrowerkeserver@gmail.com";  // GMAIL username
	$mail->Password   = "electro123";            // GMAIL password
	
	$mail->SetFrom('electrowerkeserver@gmail.com', 'Modulo Reclamo');
	
	$mail->AddReplyTo("electrowerkeserver@gmail.com","Modulo Reclamo");
	
	$mail->Subject    = "Email de ".$confir." del reclamo";
	
	$mail->AltBody    = "Usted acaba de confirmar el reclamo"; // optional, comment out and test
	
	$mail->MsgHTML($body);
	
	$mail->IsHTML(true);
   $mail->CharSet = 'UTF-8';	
	
	$address1 = $emailRecep;
	$address2 = $emailResp;
	$mail->AddAddress($address1, $sr);
	$mail->AddAddress($address2, $sr);
	
	//$mail->AddAttachment($fileAdju);      # attachment
	//$mail->AddAttachment("images/calendar-green.gif"); # attachment
	
	if(!$mail->Send()) {
	  #echo "Mailer Error: " . $mail->ErrorInfo;
	  $msj=6;
	} else {
	  #echo "Message sent!";
	  $msj=1;
	}
	return $msj;
}

$sql=sql::getReclaxId($_POST['getVal']);
$data=negocio::getData($sql);

$sql1=sql::getTrabVendedorxId($data[0]['idRespoReclamo']);
$sr=negocio::getVal($sql1,'vendedor');
$emailPer=Array();
$emailPer=explode(' ',$data[0]['correPor']);

setEmailAcep($data[0]['tbrecla_reclamo_id'],$sr,$emailPer[0],$emailPer[1],'confir','');

$sql=sql::ActCerrarRecla($_POST['getVal']);
$numFil=negocio::setData($sql);

$sql=sql::getReclaTod($_SESSION['SIS'][2]);
$dataRecla=negocio::getData($sql);

?>

<table class="list">
		<thead>
			<tr>
				<td align="center">N° de reclamo</td>
				<td>Tipo reclamo</td>
				<td>Fecha recepcion</td>
				<td>Cliente</td>
				<td>Contacto</td>
				<!--<td>Recepcion</td>-->
				<td>Responsable</td>
				<td>Estado</td>
				<!--<td>Proceso</td>-->
				<td>Detalle</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($dataRecla as $data) { 
					$sql1=sql::getTipReclamoxId($data['idTipReclamo']);
					$sql2=sql::getContacxId($data['idContacReclamo']);
					$sql3=sql::getTrabVendedorxId($data['idRespoReclamo']);
					$sql4=sql::getEstaRecla($data['idEstaReclamo']);
					$sql5=sql::getTrabxId($data['idPersoReclamo']);
					$sql6=sql::getClixContacxCli($data['idEmpReclamo']);
					$linkEdit="index.php?menu_id=102&menu=reclamo_edit&id=".$data['tbrecla_reclamo_id'];
					$linkDet="Javascript:getReclaPopup(".$data['tbrecla_reclamo_id'].",".$data['idEstaReclamo'].")";
					$linkRepor="reporte/reporte_reclamo.php?id=".$data['tbrecla_reclamo_id']."&resp=".negocio::getVal($sql3,'vendedor')."&fech=".$data['fechReclamo'];
				?>	
					<tr>
						<td align="center"><?php print "RE-".str_pad($data['tbrecla_reclamo_id'],5,'0',STR_PAD_LEFT); ?></td>
						<td><?php print negocio::getVal($sql1,'desTipReclamo'); ?></td>
						<td><?php print $data['fechReclamo']; ?></td>
						<td><?php print negocio::getVal($sql6,'empresa'); ?></td>
						<td><?php print negocio::getVal($sql2,'contacto'); ?></td>
						<!--<td><?php print negocio::getVal($sql5,'vendedor'); ?></td>-->
						<td><?php print negocio::getVal($sql3,'vendedor'); ?></td>
						<td><?php print negocio::getVal($sql4,'desEstaReclamo'); ?></td>
						<!--<td>Proceso</td>-->
						<td>
						<a href="<?php print $linkDet; ?>" >ver</a> |
						<a href="<?php print $linkEdit; ?>" >editar</a> |
						<a href="<?php print $linkRepor; ?>" target="_blank"><img src="images/pdfRepor.png" class="icoRe">Reporte</a>
						</td>
					</tr>
				<?php } ?>
		</tbody>				
</table>



