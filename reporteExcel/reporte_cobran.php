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


$opci=$_GET['valTipCob'];
$filCheck=Array();
$filCheck=explode('-',$_GET['valFilCob']);
$fechIni=$_GET['valFechIni'];
$fechFin=$_GET['valFechFin'];
$numDoc=$_GET['valNumDoc'];
$txtRuc=$_GET['valRuc'];
$resulTipCob='';

$sql=sql::getTipCambActSf();
$dataTipCam=negocio::getData($sql);

$cambVenta=$dataTipCam[count($dataTipCam)-1]['TIPOCAMB_VENTA'];

if(isset($opci))
				{
					switch($opci)
					{
						case 'FT':
							if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FT',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FT',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FT',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FT',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FT',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FT',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FT',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else
							{
								$sql=sql::getCobFacSf('FT');
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
								#print $_POST['filCheck'][0];
								#print $_POST['filCheck'][1];
								#print $_POST['filCheck'][2];
							}
						break;

						case 'FN':
							if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FN',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FN',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FN',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FN',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FN',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FN',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FN',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else
							{
							$sql=sql::getCobFacSf('FN');
							$dataVenFac=negocio::getData($sql);
							$resulTipCob="COBRANZAS POR FACTURAR";
							$tipCob="FN";
							}
						break;

						case 'FP':
							if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FP',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FP',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FP',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FP',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FP',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FP',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FP',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else
							{
							$sql=sql::getCobFacSf('FP');
							$dataVenFac=negocio::getData($sql);
							$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
							$tipCob="FP"; 
							}
						break;

						case 'FA':
						if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FA',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FA',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FA',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FA',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FA',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FA',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FA',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else
							{
								$sql=sql::getCobFacSf('FA');
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
						break;

						case'':

								$dataVenFac=Array();
								$tipCob="";
								$resulTipCob="NINGUN FILTRO COBRANZA SELECCIONADO";

						break;

						default:
						break;
					}
				}
		else
			{

					$dataVenFac=Array();
					$tipCob="";
					$resulTipCob="NINGUN FILTRO COBRANZA SELECCIONADO";
			}


/********************************************* CONTAR DATA EXTRAIDA ***************************************************************/

	/*
	$objPHPExcel->setActiveSheetIndex(0)
	        	->setCellValue('A5','cantData:'.(count($dataVenFac)));
	*/


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


$objPHPExcel->getActiveSheet()->mergeCells('A1:L1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:L2');
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCCC');
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
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
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
            ->setCellValue('A3', 'Fecha Ingreso')
            ->setCellValue('B3', 'Fecha Venc.')
            ->setCellValue('C3', 'Dias Plazo')
            ->setCellValue('D3', 'Dias Venc.')
            ->setCellValue('E3', 'N° Doc.')
            ->setCellValue('F3', 'Cliente')
            ->setCellValue('G3', 'Importe S/.')
            ->setCellValue('H3', 'Importe US$.')
            ->setCellValue('I3', 'Adelantado')
            ->setCellValue('J3', 'Retencion')
            ->setCellValue('K3', 'Factura S/.')
            ->setCellValue('L3', 'Factura US$.')
            ->setCellValue('M3', 'Observacion');
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

					  		 
					  		$totImporSol=0;
					  		$totImporDol=0;
					  		$totFacSol=0;
					  		$totFacDol=0;
					  		$i=4;

					  		foreach ($dataVenFac as $data) 
					  		{ 

					  		
					  		 $data['idVen']; 

					  		 $objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('A'.$i,$data['fechPag'])
	        							->setCellValue('B'.$i,$data['fechPagVto'])
					  		  			->setCellValue('C'.$i,intVal(negocio::calDiasVenc($data['fechPag'],$data['fechPagVto'])))
					  		  			->setCellValue('D'.$i,intVal(negocio::calDiasVenc(strftime("%d/%m/%Y",time()),$data['fechPagVto'])))
							 			->setCellValue('E'.$i,$data['numFac'])
					  		  			->setCellValue('F'.$i,$data['clie']);

					  		 $diasPlazo=negocio::calDiasVenc($data['fechPag'],$data['fechPagVto']);
					  		 $diasVenc=negocio::calDiasVenc(strftime("%d/%m/%Y",time()),$data['fechPagVto']);
					  		 evaDias("C",$i,$diasPlazo,$objPHPExcel);
					  		 evaDias("D",$i,$diasVenc,$objPHPExcel);

							 if ($data['mone']=='MN') 
							 { 
							  	$totImporSol=$totImporSol+$data['importSole'];
							  	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('G'.$i,"S/. ".$data['importSole']);
								#"S/. ".$data['importSole'];
							  } 
							  else 
							  {
							  	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('G'.$i,"-----");
							 	#-----
							  } 

							 if($data['mone']=='ME') 
							 { 
							  	$totImporDol=$totImporDol+$data['importDola'];
							  	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('H'.$i,"$. ".$data['importDola']);
							 	#"$. ".$data['importDola']; 
							 } 
							 else 
							 { 
							 	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('H'.$i,"-----");
							  	#-----
							 } 

							 	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('I'.$i,"-----");
								#-----  adelanto

							 if($data['mone']=='MN') 
							 { 
							 	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('J'.$i,"S/. ".$data['igvn']);
							    #"S/. ".$data['igvn']; 
							 } 
							 else 
							 { 
							 	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('J'.$i,"$. ".$data['igve']);
							    #"$. ".$data['igve']; 
							 } 

						     if($data['mone']=='MN') 
						     { 
						    	$facMon=$data['importSole']-$data['igvn'];
						    	$totFacSol=$totFacSol+$facMon;
						    	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('K'.$i,"S/. ".$facMon);
						    	#"S/. ".$facMon; 
						     } 
						     else 
						     { 
						     	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('K'.$i,"----");
						    	#----
						     } 

						     if($data['mone']=='ME') 
						     { 
						    	$facMon=$data['importDola']-$data['igve'];
						    	$totFacDol=$totFacDol+$facMon;
						    	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('L'.$i,"$. ".$facMon);
						    	#"$. ".$facMon;
						     } 
						     else 
						     { 
						     	$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('L'.$i,"----");
						    	#----
						     }


						    $objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('M'.$i,"----");

						     	/**************PROPIEDADES ADICIONALES**************************/
						     	$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setWrapText(true);
						     	$i++;
							 }

							
							#SUB TOTAL FACTURADO

							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A'.$i,"SUBTOTAL FACTURADO")
	        							->setCellValue('G'.$i,"S/. ".number_format($totImporSol,2));
							# "S/. ".number_format($totImporSol,2);

	        				$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'F'.$i);
	        				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':'.'F'.$i)->getFont()->setBold(true);
	        				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':'.'F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':'.'F'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCCC');

	        				$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('H'.$i,"$. ".number_format($totImporDol,2));
						 	# "$. ".number_format($totImporDol,2); 

							 #----
							 #----

	        				$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('K'.$i,"S/. ".number_format($totFacSol,2));
							 #"S/. ".number_format($totFacSol,2);

	        				$objPHPExcel->setActiveSheetIndex(0)
	        							->setCellValue('L'.$i,"$. ".number_format($totFacDol,2));
							# "$. ".number_format($totFacDol,2); 

	        				$i++;
							$totalFinal=number_format(($totFacSol/$cambVenta)+$totFacDol,2);

							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A'.$i,"TOTAL FACTURADO")
	        							->setCellValue('L'.$i,"$. ".$totalFinal);
							 #"$. ".$totalFinal;

	        				$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':'.'K'.$i);
	        				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':'.'K'.$i)->getFont()->setBold(true);
	        				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':'.'K'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':'.'K'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCCC');



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
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
