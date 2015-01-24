<?php

header("Content-Type: text/html;charset=utf-8");

require('../clases/fpdf/fpdf.php');
require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* TEST DE HORA Y FECHA */

	//print date('Y-m-d:H-m-s');
	#echo date("Y-m-d H:i:s",time()-3600);

/* TEST DE REPORTE LIBRERIA MPDF */

	include('../clases/mpdf/mpdf.php');
	$mpdf=new mPDF();

	/*
		$mpdf->WriteHTML('<p>Hallo World</p>');
		$mpdf->Output();
		exit;
	*/

	/*
		$html = '<bookmark content="Start of the Document" /><div>Section 1 text</div>';
		$mpdf=new mPDF();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	*/

	/*
		// Set a simple Footer including the page number
		$mpdf->setFooter('{PAGENO}');
		$mpdf->WriteHTML('Section 1');
		$mpdf->WriteHTML('<pagebreak suppress="on" />');
		// You could also do this using
		// $mpdf->AddPage('','','','','on');
		$mpdf->WriteHTML('Section 2 - No Footer');
		$mpdf->WriteHTML('<pagebreak resetpagenum="1" pagenumstyle="a" suppress="off" />');
		$mpdf->WriteHTML('Section 3 - Starting with page a');
		$mpdf->Output();
	*/

	/*
		// Define the Header/Footer before writing anything so they appear on the first page
		$mpdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold;">My document</div>');
		$mpdf->SetHTMLFooter('
		<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
		<td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
		<td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
		<td width="33%" style="text-align: right; ">My document</td>
		</tr></table>
		');
		$mpdf->WriteHTML('Hallo World');
		$mpdf->Output();
	*/

		$sql=sql::mp_movPerShow();
		$data=negocio::getData($sql);

		$stylesheet = file_get_contents('../styles/decorador.css');
		$html="<table border='1' >
				<tr>
					<td>user</td>
					<td>area</td>
				</tr>";
				foreach($data as $data)
				{
		$html.="<tr>
					<td>".$data['user']."</td>
					<td>".$data['are']."</td>
				</tr>";
				}
		$html.="</table>";
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html,2);
		$mpdf->Output();

?>