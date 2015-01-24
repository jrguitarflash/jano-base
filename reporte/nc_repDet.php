<?php

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
							<td colspan='3' align='center'><strong>Reporte de No Conformidades</strong></td>
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

		//Proyecto

			$sql=sql::nc_noConforxId_obte($_GET['id']);
			$dataConfor=negocio::getData($sql);

			desconectar();
			conectar();

			$sql=sql::nc_datCent_obte($dataConfor[0]['nc_centProyeId']);
			$dataCent=negocio::getData($sql);

			desconectar();
			conectar();

			$sql=sql::nc_detEquipxId_obte($_GET['id']);
			$dataEquip=negocio::getData($sql);
			$iterar="";
			$ind=1;

			foreach($dataEquip as $data)
			{
				$iterar.="<tr>
						<td>".$ind++."</td>
						<td>".$data['prodDes']."</td>
						<td>".$data['provDes']."</td>
					</tr>";
			}

			$proyecto="<h3>Proyecto</h3>";
			$proyecto.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
							<thead >
								<tr bgcolor='silver' >
									<td colspan='2' ><strong>Datos del Proyecto</strong></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width='30%' >N°</td>
									<td width='70%' >".$dataConfor[0]['nc_nro']."</td>
								</tr>
								<tr>
									<td>Proyecto</td>
									<td>".$dataConfor[0]['proyeDes']."</td>
								</tr>
								<tr>
									<td>Cliente</td>
									<td>".$dataCent[0]['nc_cli']."</td>
								</tr>
								<tr>
									<td>Ing. Proyecto</td>
									<td>".$dataCent[0]['ingRespDes']."</td>
								</tr>
							</tbody>
						</table>";
			$proyecto.="<br>";
			$proyecto.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
							<thead>
								<tr bgcolor='silver' >
									<td colspan='3' ><strong>Detalle de Equipos</strong></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Item</td>
									<td>Equipo</td>
									<td>Proveedor</td>
								</tr>
								".$iterar."
							</tbody>
						</table>";

		//No Conformidad

			//evaluar tipo de conformidad
			if($dataConfor[0]['nc_obsId']==1)
			{
				$lblTip="Tipo no conformidad";
			}
			else
			{
				$lblTip="Post venta";
			}

			$noConfor="<h3>No Conformidad</h3>";
			$noConfor.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' ><strong>Datos de No Conformidad</strong></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Observacion</td>
								<td>".$dataConfor[0]['obsDes']."</td>
							</tr>
							<tr>
								<td >".$lblTip."</td>
								<td >".$dataConfor[0]['tipConfor']."</td>
							</tr>
							<tr>
								<td width='30%' >Deteccion</td>
								<td width='70%' >".$dataConfor[0]['detecDes']."</td>
							</tr>
							<tr>
								<td >Proceso Afectado</td>
								<td >".$dataConfor[0]['proceDes']."</td>
							</tr>
							<tr>
								<td >Tipo de Observacion</td>
								<td >".$dataConfor[0]['tipObs']."</td>
							</tr>
							<tr>
								<td >Estado</td>
								<td >".$dataConfor[0]['estaDes']."</td>
							</tr>
							<tr>
								<td >Fecha de Recepcion</td>
								<td >".$dataConfor[0]['nc_fechRecep']."</td>
							</tr>
							<tr>
								<td >Descripcion</td>
								<td >".$dataConfor[0]['nc_des']."</td>
							</tr>
							<tr>
								<td >Respuesta Inmediata</td>
								<td >".$dataConfor[0]['nc_respInme']."</td>
							</tr>
							<tr>
								<td >Fecha de Cierre</td>
								<td >".$dataConfor[0]['nc_fechCie']."</td>
							</tr>
						</tbody>
					</table>";

		//Medidas correctivas

			desconectar();
			conectar();

			$sql=sql::nc_medCorrec_obte($_GET['id']);
			$dataMed=negocio::getData($sql);
			$ind=1;
			$iterar="";

			foreach($dataMed as $data)
			{
				$cadIng="";
				$dataIng=explode("|",$data['nc_ingAsig']);
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


				$iterar.="<tr>
						<td>".$ind++."</td>
						<td>".$data['nc_medCorrecDes']."</td>
						<td>".$data['nc_respMed']."</td>
						<td>".$cadIng."</td>
						<td>".$data['nc_fechCorrec']."</td>
					</tr>";
			}

			$medCorrec="<h3>Medidas</h3>";
			$medCorrec.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
							<thead>
								<tr bgcolor='silver' >
									<td colspan='5' ><strong>Medidas Correctivas</strong></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Item</td>
									<td>Medida Correctiva</td>
									<td>Respuesta</td>
									<td>Ing. Asignados</td>
									<td>Fecha</td>
								</tr>
								".$iterar."
							</tbody>
						</table>";

			$medCorrec.="<br>";

		//Medidas preventivas

			desconectar();
			conectar();

			$sql=sql::nc_medPrev_obte($_GET['id']);
			$dataPrev=negocio::getData($sql);
			$ind=1;
			$iterar="";

			foreach($dataPrev as $data)
			{
				$iterar.="<tr>
							<td>".($ind++)."</td>
							<td>".$data['nc_medPrevDes']."</td>
							<td>".$data['nc_medPrevFech']."</td>
						</tr>";
			}

			$medPrev="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='3' ><strong>Medidas Preventivas</strong></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Item</td>
								<td>Medida Preventiva</td>
								<td>Fecha</td>
							</tr>
							".$iterar."
						</tbody>
					  </table>";

			$medPrev.="";

		//Adjuntos

			desconectar();
			conectar();

			$sql=sql::nc_infoAdju_obte($_GET['id']);
			$dataAdju=negocio::getData($sql);
			$iterar="";
			$ind=1;

			foreach($dataAdju as $data)
			{
				$iterar.="<tr>
						<td>".$ind++."</td>
						<td>".$data['nc_desAdju']."</td>
					</tr>";
			}

			$adju="<h3>Adjuntos</h3>";
			$adju.="<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;' >
						<thead>
							<tr bgcolor='silver' >
								<td colspan='2' >Detalle de Adjuntos</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Item</td>
								<td>Descripcion</td>
							</tr>
							".$iterar."
						</tbody>
					</table>";
			$adju.="<br>";

		//Medida preventiva

			$medPreven="<h3>Medida Preventiva</h3>";
			$medPreven.="<div style='border:1px solid blank;padding:5px' >"
							.$dataConfor[0]['nc_medPrev']."
						</div>";

	// SALIDA DEL REPORTE

		$html="";
		$html.=$proyecto;
		$html.=$noConfor;
		$html.=$medCorrec;
		$html.=$medPrev;
		$html.=$adju;
		$html.=$medPreven;

		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html,2);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->Output();

?>