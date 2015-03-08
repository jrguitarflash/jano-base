<?php
	
	header("Content-Type: text/html;charset=utf-8");

	require('../clases/fpdf/fpdf.php');
	require('../conf.php');
	require_once('../clases/sql/sql.class.php');
	require_once('../clases/negocio/negocio.class.php');

	include('../clases/mpdf/mpdf.php');
	$mpdf=new mPDF();

	session_start();

	$titulo="REPORTE DE INVENTARIO";

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


	// CABECERA DE REPORTE

		# hora de reporte
		$date = new DateTime();
		$date->modify('-6 hour');

		$html.="<strong>Usuario:</strong> ".$_SESSION['SIS'][1].
				"<br>
			    <strong>Fecha:</strong> ".date('d/m/Y').
			    "<br>
			    <strong>Hora:</strong> ".$date->format('h:i:s A');

	// CUERPO DATA REPORTE

		if($_GET['desBus']!='')
		{
			//capturar data con filtro
			$sql=sql::lp_listLineProd($_GET['desBus'],'filtro');
			$dataLineProd=negocio::getData($sql);
		}
		else
		{
			//capturar data sin filtro
			$sql=sql::lp_listLineProd($_GET['desBus'],'todo');
			$dataLineProd=negocio::getData($sql);
		}

	// DATA ITERADA

		$dataIte="";
		
		foreach ($dataLineProd as $data) 
		{
			# code...
			$dataIte.="<tr>
						<td>".$data['cod']."</td>
						<td>".$data['sub']."</td>
						<td>".$data['cat']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['nomIngle']."</td>
						<td>".str_replace("\n","<br>",$data['des'])."</td>
						<td class='kd_stockProd' align='center' >".$data['stockActu2']."</td>
					  </tr>";
		}



	// CUERPO HTML REPORTE

		$html.="<table>
					<thead>
						<tr class='lp_headRepo' >
							<td>CODIGO</td>
							<td>SUB-CLASIFICACION</td>
							<td>CATEGORIA</td>
							<td>MARCA</td>
							<td>NOMBRE ESPAÑOL</td>
							<td>NOMBRE INGLES</td>
							<td>DESCRIPCION</td>
							<td>STOCK</td>
						</tr>
					</thead>
					<tbody>".$dataIte."</tbody>
				</table>";

		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->SetHTMLHeader($header);
		$mpdf->WriteHTML($html,2);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->Output();

?>