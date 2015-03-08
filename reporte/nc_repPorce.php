<?php

/*
	print "fechIni: ".$_GET['nc_fechIni']."<br>
			fechFin: ".$_GET['nc_fechFin'];
*/

	// INSTANCIAS REQUERIDAS

		// print "reporte id:". $_GET['id'];

		header("Content-Type: text/html;charset=utf-8");

		require('../clases/fpdf/fpdf.php');
		require('../conf.php');
		require_once('../clases/sql/sql.class.php');
		require_once('../clases/negocio/negocio.class.php');

		include('../clases/mpdf/mpdf.php');
		$mpdf=new mPDF();

		ini_set('display_errors', 1);
		ini_set('memory_limit',-1);

		session_start();

	// ESTILOS CSS

		$stylesheet = file_get_contents('../styles/decorador.css');

	// DATOS DEL REPORTE

		$date = new DateTime();
		$date->modify('-6 hour');
		$hora=$date->format('h:i:s A');

		$datRep="<table width='100%' >
					<tr>
						<td width='75%' >
						</td>
						<td align='left' >
							<strong>Usuario:</strong>
							".$_SESSION['SIS'][1]."
							<br>
						    <strong>Fecha:</strong>
						    ".date('d/m/Y')."
						    <br>
						    <strong>Hora:</strong>
						    ".$date->format('h:i:s A')."
						    <br>
						    <strong>Del</strong>
						    ".$_GET['nc_fechIni']."
						    <br>
						    <strong>Al</strong>
						    ".$_GET['nc_fechFin']."
						</td>
					</tr>
				</table>";

	// FOOTER DEL REPORTE

		# $mpdf->setFooter('ELECTROWERKE S.A.|RUC 20386239828|{PAGENO}');
		$footer="<div class='cs_repFoot' >";
		$footer.="<div class='cs_repFootInfo' width='45%' >ELECTROWERKE S.A.</div>";
		$footer.="<div class='cs_repFootInfo' >RUC 20386239828</div>";
		$footer.="<div class='cs_repFootInfo' >Telf. 271-2700</div>";
		$footer.="<div class='cs_repFootInfo' width='45%'>Calle Maria Reiche 159, 4to. Piso Urb. Higuereta - Surco Lima, Peru</div>";
		$footer.="<div class='cs_repFootInfo' >Pag. {PAGENO}</div>";
		$footer.="<div class='cs_repFootInfo' >Fax. 355-2184</div>";
		$footer.="</div>";

	// HEADER + DATOS DE REPORTE

		$header=$datRep;
		$header.="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable' >
					<thead>
						<tr>
							<td rowspan='2' ><img src='../images/logo_empresa1.png' width='12%' ></td>
							<td colspan='3' align='center'><strong>Porcentajes de No Conformidades</strong></td>
						</tr>
						<tr>
							<td align='center' >Codigo: SGC-FOR</td>
							<td>Version N°: 1</td>
							<td>Pag. {PAGENO}</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan='4' ></td>
						</tr>
					</tbody>
					<tfoot> 
						<tr>
							<td colspan='4' ></td>
						</tr>
					</tfoot>
				</table>";

	// HTML DEL REPORTE

		//Observacion

			desconectar();
			conectar();
			$sql=sql::nc_obs_obte();
			$dataObs=negocio::getData($sql);
			$iterar="";

			foreach($dataObs as $data)
			{

				//nc_obsId
				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(6,$data['nc_obsId'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceConfor=negocio::getVal($sql,'response');

				$iterar.="<tr>
							<td>".$data['nc_obsDes']."</td>
							<td>".$porceConfor."</td>
						</tr>";
			}

			$obs="<h3>Observacion</h3>";
			$obs.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Detalle Observacion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>Porcentaje</td>
							</tr>
							".$iterar."
						</tbody>
					</table>";

		//Tipo No Conformidad

			desconectar();
			conectar();
			$sql=sql::nc_tipConfxId_obte(1);
			$dataTipConf=negocio::getData($sql);
			$iterar="";

			foreach($dataTipConf as $data) 
			{
				//nc_tipConfVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(4,$data['nc_tipNoConforId'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceConfor=negocio::getVal($sql,'response');

				$iterar.="<tr>
							<td>".$data['nc_des']."</td>
							<td>".$porceConfor."</td>
						</tr>";
			}

			$tipConfor="<h3>Tipo No Conformidad</h3>";
			$tipConfor.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Detalle Tipo No Conformidad</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>Porcentaje ( % ) </td>
							</tr>
							".$iterar."
						</tbody>
					</table>";

		//Post venta

			desconectar();
			conectar();
			$sql=sql::nc_tipConfxId_obte(2);
			$dataTipConf=negocio::getData($sql);
			$iterar="";

			foreach($dataTipConf as $data) 
			{
				//nc_tipConfVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(4,$data['nc_tipNoConforId'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceConfor=negocio::getVal($sql,'response');

				$iterar.="<tr>
							<td>".$data['nc_des']."</td>
							<td>".$porceConfor."</td>
						</tr>";
			}

			$postVent="<h3>Post venta</h3>";
			$postVent.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Post venta</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>Porcentaje ( % ) </td>
							</tr>
							".$iterar."
						</tbody>
					</table>";

		//Deteccion

			$sql=sql::nc_detec_obte();
			$dataDetec=negocio::getData($sql);
			$iterar="";

			foreach($dataDetec as $data) 
			{
				//nc_detecVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(1,$data['nc_detecVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceDetec=negocio::getVal($sql,'response');

				$iterar.="<tr>
							<td>".$data['nc_detecDes']."</td>
							<td>".$porceDetec."</td>
						  </tr>";
			}

			$detec="<h3>Deteccion</h3>";
			$detec.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Detalle de Deteccion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>Porcentaje ( % ) </td>
							</tr>
							".$iterar."
						</tbody>
					</table>";

		//Proceso Afectado

			desconectar();
			conectar();
			$sql=sql::nc_procAfect_obte();
			$dataProc=negocio::getData($sql);
			$iterar="";

			foreach($dataProc as $data)
			{
				//nc_proceVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(2,$data['nc_proceVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceProce=negocio::getVal($sql,'response');

				$iterar.="<tr>
							<td>".$data['nc_proceDes']."</td>
							<td>".$porceProce."</td>
						  </tr>";
			}

			$proceAfect="<h3>Proceso afectado</h3>";
			$proceAfect.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Detalle Proceso afectado</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>Porcentaje ( % ) </td>
							</tr>
							".$iterar."
						</tbody>
					</table>";

		//Tipo de Observacion

			desconectar();
			conectar();
			$sql=sql::nc_tipObs_obte();
			$dataObs=negocio::getData($sql);
			$iterar="";

			foreach($dataObs as $data) 
			{

				//nc_obsVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(3,$data['nc_obsVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceObs=negocio::getVal($sql,'response');

				$iterar.="<tr>
							<td>".$data['nc_obsDes']."</td>
							<td>".$porceObs."</td>
						 </tr>";
			}


			$tipObs="<h3>Tipo de observacion</h3>";
			$tipObs.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Detalle Tipo de observacion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>Porcentaje ( % ) </td>
							</tr>
						</tbody>
						".$iterar."
					</table>";

		//Estado

			desconectar();
			conectar();
			$sql=sql::nc_estaConfor_obte();
			$dataEstaConfor=negocio::getData($sql);
			$iterar="";

			foreach($dataEstaConfor as $data)
			{
				//nc_estaConforVal

				desconectar();
				conectar();
				$sql=sql::nc_porcexTip_obte(5,$data['nc_estaConforVal'],$_GET['nc_fechIni'],$_GET['nc_fechFin']);
				$porceEsta=negocio::getVal($sql,'response');

				$iterar.="<tr>
							<td>".$data['nc_estaConforDes']."</td>
							<td>".$porceEsta."</td>
						  </tr>";
			}

			$estaConfor="<h3>Estado No Conformidad</h3>";
			$estaConfor.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Detalle Estado No Conformidad</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>Porcentaje ( % ) </td>
							</tr>
							".$iterar."
						</tbody>
					</table>";

	// SALIDA DEL REPORTE

		$html="";
		$html.=$obs;
		$html.=$tipConfor;
		$html.=$postVent;
		$html.=$detec;
		$html.=$proceAfect;
		$html.=$tipObs;
		$html.=$estaConfor;

		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html,2);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->Output();
?>