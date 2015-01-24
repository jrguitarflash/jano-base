<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2013 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2013 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.9, 2013-06-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../Classes/PHPExcel.php';


/*  INSTANCIA DEL RENDERIZADO PDF  */

//	Change these values to select the Rendering library that you wish to use
//		and its directory location on your server
$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
$rendererLibrary = 'tcPDF5.9';
//$rendererLibrary = 'mPDF5.4';
//$rendererLibrary = 'domPDF0.6.0beta3';
//$rendererLibraryPath = dirname(__FILE__).'../libraries/PDF/' . $rendererLibrary;
$rendererLibraryPath = '../libraries/PDF/' . $rendererLibrary;


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
/*
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
*/
							 
							 
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PDF Test Document")
							 ->setSubject("PDF Test Document")
							 ->setDescription("Test document for PDF, generated using PHP classes.")
							 ->setKeywords("pdf php")
							 ->setCategory("Test result file");


//$styleArray = new PHPExcel_Style();

$styleArray = array(
    'font' => array(
        'bold' => true
    ),
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('argb' => 'black'),
		),
	),

);



$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:O2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:A4');
$objPHPExcel->getActiveSheet()->mergeCells('B3:B4');
$objPHPExcel->getActiveSheet()->mergeCells('C3:C4');
$objPHPExcel->getActiveSheet()->mergeCells('D3:D4');
$objPHPExcel->getActiveSheet()->mergeCells('E3:E4');
$objPHPExcel->getActiveSheet()->mergeCells('F3:F4');
$objPHPExcel->getActiveSheet()->mergeCells('G3:G4');
$objPHPExcel->getActiveSheet()->mergeCells('H3:H4');
$objPHPExcel->getActiveSheet()->mergeCells('I3:I4');
$objPHPExcel->getActiveSheet()->mergeCells('J3:J4');
$objPHPExcel->getActiveSheet()->mergeCells('K3:L3');
$objPHPExcel->getActiveSheet()->mergeCells('M3:N3');
$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCCC');
$objPHPExcel->getActiveSheet()->getStyle('O1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('BBBCCC');
$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('K3:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('M3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);



/*
$objPHPExcel->getActiveSheet()->getStyle('H:I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
*/

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ELECTROWERKE SAC')
            ->setCellValue('O1', date('y-m-d'))
            ->setCellValue('A2', 'LETRAS POR PAGAR')
            ->setCellValue('A3', 'Fecha emision')
            ->setCellValue('B3', 'Letra')
            ->setCellValue('C3', 'Factura')
            ->setCellValue('D3', 'N° de orden')
            ->setCellValue('E3', 'Importe inicial')
            ->setCellValue('F3', 'Pago')
            ->setCellValue('G3', 'Saldo')
            ->setCellValue('H3', 'Fecha Pago')
            ->setCellValue('I3', 'Fecha Venc')
            ->setCellValue('J3', 'Banco')
            ->setCellValue('K3', 'Dias')
            ->setCellValue('K4', 'Atraso')
            ->setCellValue('L4', 'Por vencer')
            ->setCellValue('M3', 'Importe')
            ->setCellValue('M4', 'Atraso')
            ->setCellValue('N4', 'Por vencer');
            //->setCellValue('I1', 1);
            //->setCellValue('I1', '=CONCATENATE(A1," ",H1)');
          
//$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);

/*
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('O1')->applyFromArray($styleArray);
*/


//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);


/*
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
*/

/*
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
*/

//$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setWrapText(true);

//$objPHPExcel->getActiveSheet()->getStyle('I1')->getNumberFormat()->setFormatCode('#,##0.00');


/*
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(24); 
*/


//$objPHPExcel->getActiveSheet()->mergeCells('H1:I1');


//------------------------------------------DATA AFTER HEADER ---------------------------------------------------------------

$conexion=new mysqli('localhost','root','electro','tec-erp-3');

$sql="select let.letra_monto as mont,mone.mon_sigla as mone,let.letra_id as letId,emp.emp_nombre as empre,DATE_FORMAT(let.letra_fec_ini,'%d-%m-%y') as fechEmi, 
		DATE_FORMAT(let.letra_fec_ini,'%y') as fechEmiYear from letra as let 
		inner join empresa as emp on emp.empresa_id=let.proveedor_id
		inner join moneda as mone on mone.moneda_id=let.moneda_id
		where let.letra_tipo_id=2 and (let.letra_id=32 or let.letra_id=33)";
$data=$conexion->query($sql);
$indLet=6;
$rowProv=5;
$rowFech=6;
		


while($x=$data->fetch_array()) 
{	
	$pagoTot=0;
	$saldoTot=0;
	
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$rowProv,$x['empre'])
            	->setCellValue('A'.$rowFech,$x['fechEmi']);
	
	$sql="select letDet.letra_detalle_id as letDetId,letDet.letra_det_monto as mont,letDet.letra_det_fec_emis as fecEmis,
			DATE_FORMAT(letDet.letra_det_fec_venc,'%d/%m/%y') as fecVenc from letra_detalle as letDet where letDet.letra_id='".$x['letId']."'";
	$dataDet=$conexion->query($sql);
	
	while($y=$dataDet->fetch_array()) 
	{
		
		$objPHPExcel->setActiveSheetIndex(0)
            		->setCellValue('B'.$indLet,$y['letDetId']."-".$x['fechEmiYear'])
            		->setCellValue('E'.$indLet,$y['mont'])
            		->setCellValue('I'.$indLet,$y['fecVenc'])
            		->getStyle('E'.$indLet)->getNumberFormat()->setFormatCode('#,##0.00');
            		
            		
		$saldo=$y['mont'];        		
      $rowProv++;
      $rowFech++;
      $indLet++;
      
      $sql="select letDetAmort.letra_det_amort_revision as detIdRevi,letDetAmort.letra_detalle_id as letIdDet,
      		DATE_FORMAT(letDetAmort.letra_det_amort_fec_pago,'%d/%m/%y') as fechPago,
      		letDetAmort.letra_det_amort_monto_pago as amortPago from letra_det_amortizacion as letDetAmort,letra_detalle as letDet where 
      		letDet.letra_detalle_id=letDetAmort.letra_detalle_id and letDetAmort.letra_detalle_id='".$y['letDetId']."'";
      		
		$dataDetAmort=$conexion->query($sql);
		
			 
			while($z=$dataDetAmort->fetch_array()) 
			{
						$saldo=$saldo-$z['amortPago'];
						$pagoTot=$pagoTot+$z['amortPago'];
						$saldoTot=$saldoTot+$saldo;
	      			$objPHPExcel->setActiveSheetIndex(0)
	            					->setCellValue('B'.$indLet,$y['letDetId']."-".$x['fechEmiYear']."-".$z['detIdRevi'])
	            					->setCellValue('F'.$indLet,$z['amortPago'])
	            					->setCellValue('G'.$indLet,$saldo)
	            					->setCellValue('H'.$indLet,$z['fechPago'])
	            					->getStyle('F'.$indLet)->getNumberFormat()->setFormatCode('#,##0.00');
	            	
						$objPHPExcel->setActiveSheetIndex(0)->getStyle('G'.$indLet)->getNumberFormat()->setFormatCode('#,##0.00');            	
	            	
	            	$coord="A".$indLet.":"."N".$indLet;
	            	$objPHPExcel->getActiveSheet()->getStyle($coord)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCCC');
	            					
	            	$rowProv++;
				      $rowFech++;
				      $indLet++;
			}
		
	}

	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('E'.$indLet,$x['mone']." ".$x['mont'])
            	->setCellValue('F'.$indLet,$pagoTot)
            	->setCellValue('G'.$indLet,$x['mont']-$pagoTot)
            	->getStyle('F'.$indLet)->getNumberFormat()->setFormatCode('#,##0.00');
            	
    $objPHPExcel->setActiveSheetIndex(0)
            	->getStyle('G'.$indLet)->getNumberFormat()->setFormatCode('#,##0.00');

  	$rowProv++;
	$rowFech++;
   $indLet++; 		
            	
  	$rowProv++;
	$rowFech++;
   $indLet++; 
}

//---------------------------------------------------------------------------------------------------------------------------


// Miscellaneous glyphs, UTF-8

/*
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
*/

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Code for use in pdf format

if (!PHPExcel_Settings::setPdfRenderer(
		$rendererName,
		$rendererLibraryPath
	)) {
	die(
		'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
		'<br />' .
		'at the top of this script as appropriate for your directory structure'
	);
}


// Redirect output to a client’s web browser (Excel2007)

/*
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
*/

// Redirect output to a client’s web browser (PDF)

header('Content-Type: application/pdf');
#header('Content-Disposition: attachment;filename="01simple.pdf"');
header('filename="01simple.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');

exit;
