<?php
	
	header("Content-Type: text/html;charset=utf-8");

	require('../clases/fpdf/fpdf.php');
	require('../conf.php');
	require_once('../clases/sql/sql.class.php');
	require_once('../clases/negocio/negocio.class.php');

	include('../clases/mpdf/mpdf.php');
	$mpdf=new mPDF('',array(150,300), 0, '', 15, 15, 5, 16, 9, 9, 'L');

	session_start();

	$titulo="MOVIMIENTO";

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

		$sql=sql::kd_iniGenKardx($_GET['kardxId']);
		$dataGenKardx=negocio::getData($sql);

		desconectar();
		conectar();

		foreach($dataGenKardx as $data)
		{
			$numMov=$data['kardxNro'];
			$tipMov=$data['tipMovDes'];
			$fechMov=$data['fechMov'];
			$numDoc=$data['tipDocDes']."-".$data['numDoc'];
			$emp=$data['empDes'];
			$ruc=$data['empRuc'];
		}


	// CABECERA DE REPORTE

		# hora de reporte
		$date = new DateTime();
		$date->modify('-6 hour');

		/*
		$html.="<strong>Usuario:</strong> ".$_SESSION['SIS'][1].
				"<br>
			    <strong>Fecha:</strong> ".date('d/m/Y').
			    "<br>
			    <strong>Hora:</strong> ".$date->format('h:i:s A');
		*/

		$html.="<table width='100%'  border='0' cellpadding='5px' >
					<thead>
						<tr>
							<td width='10%' >N° MOV:</td>
							<td align='left' >".$numMov."</td>
							<td >TIPO:</td>
							<td>".$tipMov."</td>
							<td width='10%'>FECHA:</td>
							<td align='left' >".$fechMov."</td>
						</tr>
						<tr>
							<td width='10%'>N° DOC:</td>
							<td align='left' >".$numDoc."</td>
							<td width='10%'>EMPRESA:</td>
							<td align='left' >".$emp."</td>
							<td>RUC:</td>
							<td align='left' >".$ruc."</td>
						</tr>
					</thead>
				</table>";

	// CUERPO DATA REPORTE

	$sql=sql::kd_detKardxid($_GET['kardxId']);
	$dataDetKardx=negocio::getData($sql);


	// DATA ITERADA

	$detMov="";

	foreach($dataDetKardx as $data)
	{
		$detMov.="<tr>
					<td>".$data['cod']."</td>
					<td>".$data['nomEspa']." - ".$data['mar']."</td>
					<td>".$data['kdxCant']."</td>
				</tr>";
	}


	// CUERPO HTML REPORTE

		$html.="<table width='100%' cellpadding='5px' >
					<thead>
						<tr class='lp_headRepo' >
							<td>CODIGO</td>
							<td>DESCRIPCION</td>
							<td>CANT</td>
						</tr>
					</thead>
					<tbody>
					".$detMov."
					</tbody>
				</table>";


		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html,2);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->Output();

?>