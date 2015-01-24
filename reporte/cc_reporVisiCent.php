<?php

header("Content-Type: text/html;charset=utf-8");

require('../clases/fpdf/fpdf.php');
require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	include('../clases/mpdf/mpdf.php');
	$mpdf=new mPDF();

	session_start();

	$idCent=$_GET['id'];
	$sql=sql::visi_reporVisiCent($idCent);
	$dataVisiCent=negocio::getData($sql);

	$sql=sql::visi_userxId($_SESSION['SIS'][2]);
	$usuario=$valUser=negocio::getVal($sql,'user');
	$hora=date('H:i:s');
	$fecha=date('d-m-Y');
	$sql=sql::visi_centCostxId($idCent);
	$centro=negocio::getVal($sql,'correCent');

	// Set a simple Footer including the page number
		#$mpdf->setFooter('ELECTROWERKE S.A.|RUC 20386239828|{PAGENO}');
		$footer="<div class='cs_repFoot' >";
		$footer.="<div class='cs_repFootInfo' width='45%' >ELECTROWERKE S.A.</div>";
		$footer.="<div class='cs_repFootInfo' >RUC 20386239828</div>";
		$footer.="<div class='cs_repFootInfo' >Telf. 271-2700</div>";
		$footer.="<div class='cs_repFootInfo' width='45%'>Calle Maria Reiche 159, 4to. Piso Urb. Higuereta - Surco Lima, Peru</div>";
		$footer.="<div class='cs_repFootInfo' >Pag. {PAGENO}</div>";
		$footer.="<div class='cs_repFootInfo' >Fax. 355-2184</div>";
		$footer.="</div>";

	// Set a Header in Format Html
		$header="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable' >
					<thead>
						<tr>
							<td rowspan='2' ><img src='../images/logo_empresa1.png' width='12%' ></td>
							<td colspan='3' align='center'><strong>REPORTE DE VISITAS</strong></td>
						</tr>
						<tr>
							<td align='center' >Codigo: SGC-FOR-030</td>
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


	$stylesheet = file_get_contents('../styles/decorador.css');

	$html.="<br><br>";

	$html.="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable' >
				<thead>
					<tr>
						<td align='center'  colspan='4' ><strong>".''."</strong></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>USUARIO: ".$usuario."</td>
						<td>HORA: ".$hora."</td>
						<td>FECHA: ".$fecha."</td>
						<td>CENTRO DE COSTO: ".$centro."</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan='4' ></td>
					</tr>
				</tfoot>
			</table>";

	$html.="<br>";

	$html.="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable'>
				<thead>
					<tr>
						<td align='center'  colspan='6' ><strong>".''."</strong></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>VENDEDOR</td>
						<td>FECHA INICIAL</td>
						<td>FECHA SALIDA</td>
						<td>MONEDA</td>
						<td>COSTO TOTAL</td>
						<td>REFERENCIA</td>
					</tr>";
	foreach($dataVisiCent as $data)
	{
		$html.="<tr>
					<td>".$data['vend']."</td>
					<td>".$data['fechIni']."</td>
					<td>".$data['fechFin']."</td>
					<td>".$data['moneSigla']."</td>
					<td>".$data['cosTot']."</td>
					<td>".$data['refe']."</td>
				</tr>";
	}

	$html.="</tbody>
				<tfoot>
					<tr>
						<td colspan='6' ></td>
					</tr>
				</tfoot>
			</table>";
	$html.="<br>";

	$mpdf->WriteHTML($stylesheet,1);
	$mpdf->SetHTMLHeader($header);
	$mpdf->WriteHTML($html,2);
	$mpdf->SetHTMLFooter($footer);
	$mpdf->Output();
	#$mpdf->Output("../adjuntos/cotiServ/".$fs.".pdf",'I');
	#$mpdf->Output("../adjuntos/cotiServ/".$fs.".pdf",'F');


?>