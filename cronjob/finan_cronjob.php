<?php

#require ("../include/comun.php");
# ini_set('display_errors', 1);


require("../conf.php");
require_once('../clases/mail/class.phpmailer.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');
require ("../utils_func.php");

//estilos imprimibles print(impresion),media(pantalla),all(todos)
$css="<style type='text/css'> 
			@media all 
			{ 
				#tit
				{
					float:left;
					margin-right:10px;
				}

				#tabHead
				{
					color:white;
					background-color:#D84A38;
				}

				#tabBody
				{
					background-color:silver;
				}

				#tab
				{
					clear:left;
				}
			} 
		</style>";

switch ($_GET['cron']) 
{
	case 'alertFian':
		
		# code...
		$sql=sql::finan_cartVenc_alert();
		$dataAlertFian=negocio::getData($sql);

		if(count($dataAlertFian)>0)
		{
			$msjTit="Alerta de Cartas Fianzas";
			$msjSub="Alerta";
			$msjAlt="Alerta";
			$msjBod="";
			$arrDesti=array("jrguitarflash@gmail.com");

			//iteracion de alerta
			$msjBod.="<img src='../images/finan_img/alertFian.png'  width='4%' >";
			$msjBod.="<h3 style='float:left;margin-right:10px;' >Alerta de Carta Fianzas</h3>";
			$msjBod.="<p>Alertas de cartas fianzas vencidas y/o por vencer</p>";
			$bodyIte="";
			foreach ($dataAlertFian as $data) 
			{
				# code...
				$bodyIte.="<tr>
							<td>".$data['correCent']."</td>
							<td>".$data['docDes']."</td>
							<td>".$data['tipDocDes']."</td>
							<td>".$data['finan_correOpe']."</td>
							<td>".$data['finan_versiReno']."</td>
							<td>".$data['alertDoc']."</td>
							<td>".$data['alertEntre']."</td>
						</tr>";
			}

			$msjBod.="<table border='0' style='clear:left;' >
						<thead style='color:white;background-color:#D84A38;' >
							<tr>
								<td>CC</td>
								<td>Doc.</td>
								<td>Tipo Doc.</td>
								<td>N° Doc</td>
								<td>Renovacion</td>
								<td>Alerta Venc. Doc.</td>
								<td>Alerta Entrega Cliente</td>
							</tr>
						</thead>
						<tbody style='background-color:silver;' >
							".$bodyIte."
						</tbody>
					</table>";

			$msjBod.="<label>".count($dataAlertFian)." incidencias de alertas</label>";



			print np_enviEmail($msjTit,$msjSub,$msjAlt,$msjBod,$arrDesti);
		}
	
	break;

	case 'prevAlert':

		# code...
		$sql=sql::finan_cartVenc_alert();
		$dataAlertFian=negocio::getData($sql);

		//iteracion de alertas
		$msjBod.="<img src='../images/finan_img/alertFian.png'  width='4%' >";
		$msjBod.="<h3 id='tit' >Alerta de Carta Fianzas</h3>";
		$msjBod.="<p>Alertas de cartas fianzas vencidas y/o por vencer</p>";
		$msjBod=$msjBod.$css;
		$bodyIte="";
		foreach ($dataAlertFian as $data) 
		{
			# code...
			$bodyIte.="<tr>
						<td>".$data['correCent']."</td>
						<td>".$data['docDes']."</td>
						<td>".$data['tipDocDes']."</td>
						<td>".utf8_decode($data['finan_correOpe'])."</td>
						<td>".$data['finan_versiReno']."</td>
						<td>".$data['alertDoc']."</td>
						<td>".$data['alertEntre']."</td>
					</tr>";
		}

		$msjBod.="<table border='0' id='tab' >
					<thead id='tabHead' >
						<tr>
							<td>CC</td>
							<td>Doc.</td>
							<td>Tipo Doc.</td>
							<td>N&deg; Doc</td>
							<td>Renovacion</td>
							<td>Alerta Venc. Doc.</td>
							<td>Alerta Entrega Cliente</td>
						</tr>
					</thead>
					<tbody id='tabBody' >
						".$bodyIte."
					</tbody>
				</table>";

		$msjBod.="<label>".count($dataAlertFian)." incidencias de alertas</label>";


		print $msjBod;

	break;
	
	default:
		# code...
	break;


}

?>