<?php
	
	header("Content-Type: text/html;charset=utf-8");

	require('../clases/fpdf/fpdf.php');
	require('../conf.php');
	require_once('../clases/sql/sql.class.php');
	require_once('../clases/negocio/negocio.class.php');

	include('../clases/mpdf/mpdf.php');
	//$mpdf=new mPDF('',array(150,300), 0, '', 15, 15, 5, 16, 9, 9, 'L');
	$mpdf=new mPDF('',array(210,297), 0, '', 15, 15, 5, 16, 9, 9, 'L');

	session_start();

	$titulo="NOTA DE PEDIDO";

	$stylesheet = file_get_contents('../styles/decorador.css');


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
							<td colspan='3' align='center'><strong>".$titulo."</strong></td>
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
					<tfoot></tfoot>
				</table>";
		

	 // Set HTML Report

		$html="";

	// CABECERA DATA REPORTE

		$sql=sql::np_genNot_cap($_GET['id']);
		$dataNot=negocio::getData($sql);

		//iniciar data general de nota
		$cod=$dataNot[0]['cod'];
		$cliId=$dataNot[0]['cliId'];
		$cli=$dataNot[0]['cli'];
		$fech=$dataNot[0]['fech'];
		$des=$dataNot[0]['des'];
		$ref=$dataNot[0]['ref'];
		$obs=$dataNot[0]['obs'];
		$estaDes=$dataNot[0]['estaDes'];
		$usuDes=$dataNot[0]['usuDes'];
		$desTip=$dataNot[0]['desTip'];
		$fechConfir=$dataNot[0]['fechConfir'];
		$hourConfir=$dataNot[0]['hourConfir'];


	// CABECERA DE REPORTE

		# hora de reporte
		$date = new DateTime();
		$date->modify('-6 hour');


		$html.="<table width='100%'  border='0' cellpadding='5px' >
					<thead>
						<tr>
							<td width='10%' >N° NOT:</td>
							<td align='left' >".$cod."</td>
							<td >EMPRESA:</td>
							<td>".$cli."</td>
							<td width='10%'>FECHA:</td>
							<td align='left' >".$fech."</td>
						</tr>
						<tr>
							<td width='10%'>DESCRIPCION:</td>
							<td align='left' >".$des."</td>
							<td width='10%'>REFERENCIA:</td>
							<td align='left' >".$ref."</td>
							<td>OBSERVACION:</td>
							<td align='left' >".$obs."</td>
						</tr>
						<tr>
							<td width='10%'>RESPONSABLE:</td>
							<td align='left' >".$usuDes."</td>
							<td width='10%'>ESTADO:</td>
							<td align='left' >".$estaDes."</td>
							<td>TIPO:</td>
							<td align='left' >".$desTip."</td>
						</tr>
						<tr>
							<td width='10%'>FECHA ATENCION:</td>
							<td align='left' >".$fechConfir."</td>
							<td width='10%'>HORA ATENCION:</td>
							<td align='left' >".$hourConfir."</td>
							<td></td>
							<td align='left' ></td>
						</tr>
					</thead>
				</table>";

	// CUERPO DATA REPORTE

	   desconectar();
	   conectar();

	   	$sql=sql::np_detNot_cap($_GET['id']);
		$dataDet=negocio::getData($sql);
		$detNot="";
		$item=1;


	// DATA ITERADA

		foreach($dataDet as $data)
		{

			$detNot.="<tr>
						<td>".$data['cod']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['des']."</td>
						<td>".$data['cantDet']."</td>
					</tr>";
		}



	// CUERPO HTML REPORTE

		$html.="<table width='100%' cellpadding='5px' >
					<thead>
						<tr class='lp_headRepo' >
							<td>CODIGO</td>
							<td>MARCA</td>
							<td>NOMBRE</td>
							<td>DESCRIPCION</td>
							<td>CANTIDAD</td>
						</tr>
					</thead>
					<tbody>
						".$detNot."
					</tbody>
				</table>";


		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html,2);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->Output();

?>