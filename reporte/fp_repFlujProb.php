<?php

session_start();

header("Content-Type: text/html;charset=utf-8");

require('../clases/fpdf/fpdf.php');
require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


class PDF extends FPDF
{
	
	//pie del reporte
	function footer()
	{
		//posicion a 1,5 cm del inferior
		$this->SetY(-15);
		//fuente arial italic 8
		$this->SetFont('Arial','I',8);
		//numero de pagina
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

	function hora()
	{
		$date = new DateTime();
		$date->modify('-5 hour');
		$fecha=$date->format('Y-m-d');
		$hora=$date->format('H');
		if($hora>12) 
		{
		$date->modify('-12 hour');
		}
		$hora=$date->format('H:i:s');
		return $hora;

	}

	function fecha()
	{
		$date = new DateTime();
		$date->modify('-5 hour');
		$fecha=$date->format('Y-m-d');
		$hora=$date->format('H');
		if($hora>12) 
		{
		$date->modify('-12 hour');
		}
		$hora=$date->format('H:i:s');
		return $fecha;
	}
	
	//cabecera de pagina
	function header()
	{
		#$fecha=strftime( "%Y/%m/%d", time());
		#$hora=strftime( "%H:%M:%S", time());
		$date = new DateTime();
		$date->modify('-5 hour');
		$fecha=$date->format('Y-m-d');
		$hora=$date->format('H');
		if($hora>12) 
		{
			$date->modify('-12 hour');
		}
		$hora=$date->format('H:i:s');
		$this->SetFont('Arial','',10);
		$this->Ln(5);
		$this->Image('../images/logo1.png',10,10,40);
		$this->SetFont('Arial','B',15);
		$this->Cell(50);
		$this->Cell(170,10,'FLUJO PROYECTADO DE VENTAS SEGUN COTIZACIONES ACTIVAS',0,1,'C');
		$this->Cell(120);
		$this->Ln(15);
	}

	// Load data
	function LoadData($file)
	{
	    // Read file lines
	    $lines = file($file);
	    $data = array();
	    foreach($lines as $line)
	        $data[] = explode(';',trim($line));
	    return $data;
	}

	// Simple table
	function BasicTable($header, $data)
	{
	    // Header
	    foreach($header as $col)
	        $this->Cell(80,7,$col,1);
	    $this->Ln();
	    // Data
	    foreach($data as $row)
	    {
	        foreach($row as $col)
	            $this->Cell(80,6,$col,1);
	        $this->Ln();
	    }
	}

	// Better table
	function ImprovedTable($header, $data)
	{
	    // Column widths
	    #$w = array(40, 35, 40, 45);
		#$w = array(20,35,30,30,20,30,25);
		$w = array(10,80,50,55);
		$this->SetFont('Arial','',8);
	    // Header
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,mb_strtoupper($header[$i]),1,0,'C');
	       #	$this->MultiCell($w[$i],7,mb_strtoupper($header[$i]),1);
	    $this->Ln();
	    // Data
	    foreach($data as $row)
	    {
	    	
	    	$this->Cell($w[0],6,$row['id'],'LR',0,'L');
	    	$this->Cell($w[1],6,$row['empresa'],'LR',0,'L');
	    	$this->Cell($w[2],6,$row['contacto'],'LR',0,'L');
	    	$this->Cell($w[3],6,$row['observacion'],'LR',0,'L');
	    	
			#$this->Cell($w[0],6,$row['idProducto'],'LR',0,'C');
			#$this->Cell($w[1],6,utf8_decode(ucfirst($row['nomProd']." ".($this->evaCaracter($row['marca']))." ".($this->evaCaracter($row['modelo'])))),'LR',0,'L');
	     	#$this->Cell($w[2],6,ucfirst($row['marca']),'LR',0,'L');
			#$this->Cell($w[3],6,ucfirst($row['modelo']),'LR',0,'L');
			#$this->Cell($w[2],6,($row['precioUnitario']),'LR',0,'R');
			#$this->Cell($w[5],6,number_format($row['stockMinimo']),'LR',0,'R');
			#$this->Cell($w[3],6,number_format($row['stockActual']),'LR',0,'C');
			#$this->Cell($w[4],6,$row['obs'],'LR',0,'C');
			
			
			/*
				$x = $this->GetX();
				$y = $this->GetY();
				
				$this->MultiCell($w[0],16,$row['idProducto'],'LR');
				$this->SetXY($x+$w[0], $y);
				$x=$x+$w[0];
				$this->MultiCell($w[1],5,utf8_decode(ucfirst($row['nomProd'])),'LR');
				$this->SetXY($x+$w[1], $y);
				$x=$x+$w[1];
		        $this->MultiCell($w[2],16,ucfirst($row['marca']),'LR');
		        $this->SetXY($x+$w[2], $y);
		        $x=$x+$w[2];
				$this->MultiCell($w[3],16,ucfirst($row['modelo']),'LR');
				$this->SetXY($x+$w[3], $y);
		        $x=$x+$w[3];
				$this->MultiCell($w[4],16,($row['precioUnitario']),'LR');
				$this->SetXY($x+$w[4], $y);
		        $x=$x+$w[4];
				#$this->Cell($w[5],6,number_format($row['stockMinimo']),'LR',0,'R');
				$this->MultiCell($w[5],16,number_format($row['stockActual']),'LR');
				$this->SetXY($x+$w[5], $y);
		        $x=$x+$w[5];
				$this->MultiCell($w[6],16,$row['obs'],'LR');
			*/
			
			
	     #$this->Cell($w[0],6,$row[0],'LR');
	     #$this->Cell($w[1],6,$row[1],'LR');
	     #$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
	     #$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
	     
	     $this->Ln();
	     #$this->Line(200,$this->GetY(),$this-> GetX(),$this-> GetY());
	        
	    }
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	}

	// Colored table
	function FancyTable($header, $data)
	{
	    // Colors, line width and bold font
	    $this->SetFillColor(255,0,0);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(128,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    // Header
	    #$w = array(40, 35, 40, 45);
		$w = array(40,40,40);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $this->Ln();
	    // Color and font restoration
	    $this->SetFillColor(224,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    // Data
	    $fill = false;
	    foreach($data as $row)
	    {
			$this->Cell($w[0],6,$row['idProducto'],'LR',0,'L',$fill);
	      $this->Cell($w[1],6,$row['desMarca'],'LR',0,'L',$fill);
			$this->Cell($w[2],6,$row['desModel'],'LR',0,'L',$fill);
		
	     #$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
	     #$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
	     #$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
	     #$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
	     $this->Ln();
	     $fill = !$fill;
	    }
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	}

	//funcion evaluar - _
	function evaCaracter($caract)
	{

		if($caract=='_' || $caract=='-' ) 
		{
			$caractf=" ";
		}
		else
		{
			$caractf=ucfirst($caract);
		}
		return $caractf;
	}

}


	//------------------------------------INICIO DE ESTRUCTURA DE REPORTE--------------------------------------------------------//


	$pdf = new PDF();
	$pdf->AliasNbPages();
	
	$pdf->SetFont('Arial','',14);
	
	
	$pdf->AddPage('Landscape','A4');
		

	//---------------------------------------------------HEADER DATOS---------------------------------------------//
	$tamArr=Array();
	$tamArr=explode(",",$_GET['arrCotiId']);

	$pdf->Line(280,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
	$pdf->Ln(3);
	$pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(110,7,'Vendedor: '.$_GET['vend'],0,0,'L');
	$pdf->Cell(110,7,utf8_decode('N° de Cotizaciones: ').count($tamArr),0,0,'L');		
    $pdf->Cell(80,7,'Fecha de reporte: '.date('d/m/Y'),0,1,'L');
	$pdf->Ln(3);
	$pdf->Line(280,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
	$pdf->Ln(5);
	
	/*
		$pdf->Cell(80,7,'Titulo: Reporte de Pre-Calculo',0,1,'L');
		$pdf->Cell(270,7,'Cliente: '.$dataProf[0]['clien'],0,1,'L');
		$pdf->Cell(20,7,'Proyecto:',0,0,'L');
		$pdf->MultiCell(250,7,utf8_decode($dataProf[0]['titProye']),0,'L');
		$pdf->Ln(3);
		$pdf->Line(280,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
		$pdf->Ln(5);
	*/	

	//---------------------------------------- ESTRUCTURA DETALLE PROFORMA -----------------------------------------------//


	$cad=$_GET['arrCotiId'];

	//$pdf->Cell(85,10,$cad,1,1,'C');

	$sql=sql::fp_flujProb($cad);
	$data_flujProb=negocio::getData($sql);

	$dataRepor=Array();
	
	$pdf->SetFont('Arial','B',10);
	
	$pdf->Cell(115,10,'CLIENTE',1,0,'C');
	$pdf->Cell(35,10,'MONTO',1,0,'C');
	$pdf->Cell(15,10,'PROB.',1,0,'C');
	$pdf->Cell(25,10,'FECHA PROB.',1,0,'C');
	$pdf->Cell(80,10,'FIANZA',1,1,'C');

	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(196, 201, 162);
	$fill=true;

	foreach($data_flujProb as $data)
	{

	$pdf->SetFont('Arial','',9);
	$pdf->MultiCell(270,7,utf8_decode($data['proyecto']),0,'L',$fill);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(115,20,utf8_decode($data['cliente']),1,0,'C');
	$pdf->Cell(35,20,$data['mone'].' '.number_format($data['monto'],2),1,0,'C');
	$pdf->Cell(15,20,$data['prob'],1,0,'C');
	$pdf->Cell(25,20,$data['probFech'],1,0,'C');
	$pdf->MultiCell(80,7,negocio::fp_evaFianVal($data['fianAde'],$data['monto'],$data['fianAdePor'],$data['mone'])."\n".negocio::fp_evaFianVal($data['fianFiel'],$data['monto'],$data['fianFielPor'],$data['mone'])."\n"." ",1,'C');

	}

	//------------------------------------------------ DATOS DE CIERRE ------------------------------------------------------------//

	/*
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(32,7,'Plazo de entrega: ',0,0,'L');
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(230,7,utf8_decode($dataDetProf[0]['plazEnt']),0,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(32,7,'Forma de pago: ',0,0,'L');
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(230,7,utf8_decode($dataDetProf[0]['formPag']),0,'L');
	*/

	//-----------------------------------------------------------------------------------------------------------------------------//

	$pdf->SetFont('Arial','',10);

	if($pdf->GetY()>=165) 
	{
		$pdf->AddPage('Landscape','A4');	
	}
	$pdf->Ln(15);
	$ubiY=$pdf-> GetY();
	$pdf->Line(30,$ubiY,95,$ubiY);
	$pdf->Line(120,$ubiY,$pdf->GetX()+160,$ubiY);
	$pdf->Line(200,$ubiY,$pdf->GetX()+250,$ubiY);
	$pdf->Ln(5);
	$pdf->Cell(90,5,'Ejecutivo de Ventas',0,0,'C');
	$pdf->Cell(90,5,'Gerente Comercial',0,0,'C');
	$pdf->Cell(90,5,'Gerente General',0,0,'C');

	$pdf->Output();

?>