<?php
#ini_set("memory_limit","50M");
#ini_set('max_execution_time',300);
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
#error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../clases/phpExcel/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// instancia conexion
require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/************************************* INICIALIZACION DE DATA A MOSTRAR ****************************************************/




/********************************************* CONTAR DATA EXTRAIDA ***************************************************************/

							 
							 
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PDF Test Document")
							 ->setSubject("PDF Test Document")
							 ->setDescription("Test document for PDF, generated using PHP classes.")
							 ->setKeywords("pdf php")
							 ->setCategory("Test result file");

function evaDias($casi,$i,$val,$objPHPExcel)
{
	if($val>0)
	{
		$objPHPExcel->getActiveSheet()->getStyle($casi.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN);
	}
	else
	{
		$objPHPExcel->getActiveSheet()->getStyle($casi.$i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
	}
}

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


$objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:K2');
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
#$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setARGB('0247A6');
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('EFEFEF');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
#$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


/*
$objPHPExcel->getActiveSheet()->getStyle('H:I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
*/

/*************************************** CABECERA DATA A EXTRAER **************************************************************/

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ELECTROWERKE SAC')
            ->setCellValue('M1', date('d/m/Y'))
            ->setCellValue('A2', 'CUADRO DE COBRANZAS'.' - '.$resulTipCob)
            ->setCellValue('A3', 'Item')
            ->setCellValue('B3', 'N° orden')
            ->setCellValue('C3', 'Tipo de Pedido')
            ->setCellValue('D3', 'Fecha de EW')
            ->setCellValue('E3', 'Proveedor')
            ->setCellValue('F3', 'Cliente')
            ->setCellValue('G3', 'Equipo')
            ->setCellValue('H3', 'Monto de orden de compra')
            ->setCellValue('I3', 'Monto del EW')
            ->setCellValue('J3', 'INCOTER MS')
            ->setCellValue('K3', 'Fecha de entrega al cliente')
            ->setCellValue('L3', 'Fecha de embarque')
            ->setCellValue('M3', 'Fecha de llegada')
            ->setCellValue('N3', 'Comentario')
            ->setCellValue('O3', 'Riesgo')
            ->setCellValue('P3', 'N° FL')
            ->setCellValue('Q3', 'FWDR')
            ->setCellValue('R3', 'Estado')
            ->setCellValue('S3', 'Ing. a cargo');
            //->setCellValue('I1', 1);
            //->setCellValue('I1', '=CONCATENATE(A1," ",H1)');
          
// Add data dinamic

/******************************************* MOSTRAR PARAMETROS **********************************************************/

/*
	$objPHPExcel->setActiveSheetIndex(0)
	        	->setCellValue('A5','tipCob:'.$_GET['valTipCob'])
	        	->setCellValue('B5','filCob:'.$_GET['valFilCob'])
	        	->setCellValue('B6','fechIni:'.$_GET['valFechIni'])
	        	->setCellValue('B7','fechFin:'.$_GET['valFechFin'])
	        	->setCellValue('B8','numDoc:'.$_GET['valNumDoc'])
	        	->setCellValue('B9','ruc:'.$_GET['valRuc']);
*/

/******************************************** DATA LOGICA CONTENIDO *******************************************************/



// Miscellaneous glyphs, UTF-8

/*
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
*/

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Cobranzas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cc_reporComp.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
