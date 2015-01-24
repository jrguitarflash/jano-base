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
require('../conf.php');
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


$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
#$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->getColor()->setARGB('C00A1D');
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('EFEFEF');
#$objPHPExcel->getActiveSheet()->getStyle('M1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('EFEFEF');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(false);
#$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(false);
$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H3', 'Fecha: '.date('d/m/Y'));


/*
$objPHPExcel->getActiveSheet()->getStyle('H:I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
*/

/************************************************DATOS GENERALES DE PROYECTO *******************************************************/

$objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A4:H4');

$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('EFEFEF');

$objPHPExcel->getActiveSheet()
    ->getRowDimension('4')
    ->setRowHeight(110);

$sql=sql::scc_datGenSegui($_GET['id']);
$data_datGenSegui=negocio::getData($sql);

desconectar();
conectar();

$geneProye="CS: ".$data_datGenSegui[0]['sc'];
$geneProye.="\n";
$geneProye.="CC: ".$data_datGenSegui[0]['cc'];
$geneProye.="\n";
$geneProye.="CLIENTE: ".$data_datGenSegui[0]['cliente'];
$geneProye.="\n";
$geneProye.="PROYECTO: ".$data_datGenSegui[0]['proyecto'];
$geneProye.="\n";
$geneProye.="MONTO CC: ".$data_datGenSegui[0]['moneda']." ".$data[0]['monto'];
$geneProye.="\n";
$geneProye.="FECHA ENTREGA: ".$data_datGenSegui[0]['fechEntre'];
$geneProye.="\n";

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', $geneProye);


/*************************************** CABECERA DATA A EXTRAER **************************************************************/

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ELECTROWERKE S.A')
            ->setCellValue('A2', 'SEGUIMIENTO DE ORDENES DEL PROYECTO')
            ->setCellValue('A5', 'N° ORDEN')
            ->setCellValue('B5', 'PROVEEDOR')
            ->setCellValue('C5', 'INCOTERM')
            ->setCellValue('D5', 'PLAZO ENTREGA')
            ->setCellValue('E5', 'MONTO')
            ->setCellValue('F5', 'EQUIPO / SERVICIO')
            ->setCellValue('G5', 'ADELANTOS')
            ->setCellValue('H5', 'SEGUIMIENTO');
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

$sql=sql::scc_ordSeguiCent($_GET['id']);
$data_ordSeguiCent=negocio::getData($sql);
$i=6;

foreach($data_ordSeguiCent as $data)
{
	desconectar();
	conectar();

	$sql=sql::scc_datOrdComp($data['ordId']);
	$data_datOrdComp=negocio::getData($sql);

	desconectar();
	conectar();

	$sql=sql::scc_detAdelOrd($_GET['id'],$data['ordId']);
	$data_detAdelOrd=negocio::getData($sql);
	$cadAdel="";

	desconectar();
	conectar();

	$sql=sql::scc_seguiOrdProye($_GET['id'],$data['ordId']);
	$data_seguiOrdProye=negocio::getData($sql);
	$cadSegui="";


	foreach($data_detAdelOrd as $data3)
	{
		$cadAdel.=$data3['tipAdel']." ".$data3['fechAdel']." ".$data3['desAdel']."\n\n";
	}

	foreach($data_seguiOrdProye as $data4)
	{
		$cadSegui.=$data4['tipValid']." ".$data4['fechValid']." ".$data4['estaValid']."\n\n";
	}

	foreach($data_datOrdComp as $data2)
	{
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A'.$i, $data['ordDes'])
		            ->setCellValue('B'.$i, $data2['proveedor'])
		            ->setCellValue('C'.$i, $data2['incoterm'])
		            ->setCellValue('D'.$i, $data2['plazoEntre'])
		            ->setCellValue('E'.$i, $data2['moneda']." ".$data2['monto'])
		            ->setCellValue('F'.$i, $data2['equipServ'])
		            ->setCellValue('G'.$i, $cadAdel)
		            ->setCellValue('H'.$i, $cadSegui);
		            $i++;
	}
}

// Miscellaneous glyphs, UTF-8

/*
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
*/

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Seguimiento de ordenes');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="scc_repSeguiCent.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
