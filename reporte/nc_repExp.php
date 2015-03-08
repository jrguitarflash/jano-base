<?php

	// INSTANCIAS REQUERIDAS

		// print "reporte id:". $_GET['id'];

		header("Content-Type: text/html;charset=utf-8");

		require('../clases/fpdf/fpdf.php');
		require('../conf.php');
		require_once('../clases/sql/sql.class.php');
		require_once('../clases/negocio/negocio.class.php');

		include('../clases/mpdf/mpdf.php');
		$mpdf=new mPDF('utf-8', array(420,297));

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
							<td colspan='3' align='center'><strong>REPORTE DE OBSERVACIONES</strong></td>
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

		/* observaciones */

			$sql=sql::nc_noConfor_obte($_GET['fech'],$_GET['estaId'],0,1200,$_GET['obsId'],$_GET['origId']);
			$dataConfor=negocio::getData($sql);
			$iterar="";

			foreach($dataConfor as $data)
			{
				//No Conformidades

					desconectar();
					conectar();

					$sql=sql::nc_noConforxId_obte($data['nc_noConforId']);
					$dataConfor=negocio::getData($sql);

				//Medidas Correctivas

					desconectar();
					conectar();

					$sql=sql::nc_medCorrec_obte($data['nc_noConforId']);
					$dataMed=negocio::getData($sql);
					$iterar2="";

					foreach($dataMed as $data2)
					{
						$cadIng="";
						$dataIng=explode("|",$data2['nc_ingAsig']);
						$indIng=0;

						//concatenar ingenieros asignados
							for($i=0;$i<count($dataIng);$i++)
							{
								desconectar();
								conectar();

								if($indIng==0)
								{
									$sql=sql::nc_perxId_obte($dataIng[$i]);
									$valIng=negocio::getVal($sql,'response');
									$cadIng=$valIng;
								}
								else
								{
									$sql=sql::nc_perxId_obte($dataIng[$i]);
									$valIng=negocio::getVal($sql,'response');
									$cadIng=$cadIng."<br>".$valIng;
								}
								$indIng++;
							}


						$iterar2.="<tr>
									<td>".$data2['nc_medCorrecDes']."</td>
									<td>".$cadIng."</td>
									<td>".$data2['nc_fechCorrec']."</td>
								</tr>";
					}

					$medCorrec="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
								<tbody>
									".$iterar2."
								</tbody>
							</table>";

				//Medidas Preventivas

					desconectar();
					conectar();

					$sql=sql::nc_medPrev_obte($data['nc_noConforId']);
					$dataPrev=negocio::getData($sql);
					$iterar3="";

					foreach($dataPrev as $data3)
					{
						$iterar3.="<tr>
									<td>".$data3['nc_medPrevDes']."</td>
									<td>".$data3['nc_medPrevFech']."</td>
								  </tr>";
					}

					$medPrev="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
								<tbody>
									".$iterar3."
								</tbody>
							</table>";

				//Adjuntos

					desconectar();
					conectar();

					$sql=sql::nc_infoAdju_obte($data['nc_noConforId']);
					$dataAdju=negocio::getData($sql);
					$iterar4="";

					foreach($dataAdju as $data4)
					{
						$iterar4.="<tr>
									<td>".$data4['nc_desAdju']."</td>
								</tr>";
					}

					$adju="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
								<tbody>
									".$iterar4."
								</tbody>
							</table>";

				//Iteracion resultante

					$iterar.="<tr>
								<td>".$data['nc_nro']."</td>
								<td>".$dataConfor[0]['proyeDes']."</td>
								<td>".$data['nc_des']."</td>
								<td>".$dataConfor[0]['nc_respInme']."</td>
								<td>".$data['nc_fechRecep']."</td>
								<td>".$data['nc_estaConfor']."</td>
								<td>".$dataConfor[0]['obsDes']."</td>
								<td>".$data['nc_oriDes']."</td>
								<td>".$medCorrec."</td>
								<td>".$medPrev."</td>
								<td>".$adju."</td>
								<td>".$dataConfor[0]['nc_medPrev']."</td>
							</tr>";
			}

			$observ.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
								<thead>
									<tr bgcolor='silver' >
										<td colspan='12' ><strong>Observaciones</strong></td>
									</tr>
									<tr>
										<td><strong>N°</strong></td>
										<td><strong>Proyecto</strong></td>
										<td><strong>Descripcion</strong></td>
										<td><strong>Resp. Inmediata</strong></td>
										<td><strong>Fecha</strong></td>
										<td><strong>Estado</strong></td>
										<td><strong>Observacion</strong></td>
										<td><strong>Origen</strong></td>
										<td><strong>Med. Correctivas</strong></td>
										<td><strong>Med. Preventivas</strong></td>
										<td><strong>Adjuntos</strong></td>
										<td><strong>Resultados</strong></td>
									</tr>
								</thead>
								<tbody>
									".$iterar."
								</tbody>
							</table>";

	// SALIDA DEL REPORTE

		$html="";
		$html.=$observ;

		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html,2);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->Output();

?>