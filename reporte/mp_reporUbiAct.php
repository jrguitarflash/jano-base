<?php

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
	$fecha=$date->format('d/m/Y');
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
	#$this->Cell(190,7,'Fecha: '.$fecha,0,1,'R');
	#$this->Cell(190,7,'Hora: '.$hora,0,1,'R');
	$this->Ln(5);
	//colocar logo
	$this->Image('../images/logo1.png',10,10,40);
	//fuente estilo y tamaño
	$this->SetFont('Arial','B',15);
	//mover a la derecha
	$this->Cell(70);
	//titulo del reporte
	$this->SetFont('Arial','',10);
	//$this->cell(125,10,"Vendedor: ".$_GET['vend'],0,1,'R');
	$this->SetFont('Arial','B',15);
	$this->Cell(55,10,'REPORTE DE UBICACION',0,0,'R');
	//titulo del reporte
	$this->SetFont('Arial','',10);
	//$this->cell(75,10,"Fecha Inicial: ".$_GET['txtFechIni'],0,1,'R');
	$this->Cell(120);
	//$this->cell(75,10,"Fecha Final: ".$_GET['txtFechFin'],0,1,'R');
	$this->SetFont('Arial','B',15);
	
	//$this->Cell(190,10,'REPORTE DE VISITAS',1,1,'C');
	//quebrar la linea
	$this->Ln(25);
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


		#print_r($data);

		$pdf = new PDF();
		$pdf->AliasNbPages();
		// Column headings
		#$header = array('Codigo', 'Producto','Marca','Modelo','Precio','Stock actual','Observacion');
		$header = array('Id', 'Empresa','Contacto','Observacion');
		// Data loading
		#$data = $pdf->LoadData('text/text2.txt');
		$pdf->SetFont('Arial','',14);
		#$pdf->AddPage();
		#$pdf->BasicTable($header,$data);
		$pdf->AddPage();

//-------------------------------------HEADER DATOS----------------------------------//

		$pdf->Rect(5, 5, 202, 285);
		$pdf->Line(200,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
		$pdf->Ln(3);
		$pdf->SetDrawColor(0,0,0);
	    $pdf->SetLineWidth(.3);
	    $pdf->SetFont('Arial','B',10);
		#$pdf->Cell(70,10,utf8_decode('N° de Reporte: '));
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(80,10,'Fecha de reporte: '.$pdf->fecha(),0,0,'L');
		$pdf->Cell(80,10,'Hora de reporte: '.$pdf->hora(),0,1,'L');
		$pdf->SetFont('Arial','B',10);
		#$pdf->Cell(50,10,'Hora: '.$pdf->hora(),0,1,'L');
		#$pdf->Cell(40,10,'Fecha: '.$data2[$i],0,1,'L');
		$pdf->Ln(3);
		$pdf->Line(200,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
		$pdf->Ln(5);

//-------------------------------------SUB HEADER----------------------------------//


	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(75,10,"TRABAJADOR",1,0,'L');
	$pdf->Cell(40,10,"AREA",1,0,'L');
	$pdf->Cell(75,10,"UBICACION",1,1,'L');

	$pdf->Ln(5);


//-------------------------------- DATA DE UBICACION ------------------------------------//

	function evaUbi($dataMovPer)
	{
		if(count($dataMovPer)>0)
		{
			$ubi="fuera de empresa";
		}
		else
		{
			$ubi="en empresa";
		}
		return $ubi;
	}

	$sql=sql::mp_ubiTrabAct();
	$dataUbiTrab=negocio::getData($sql);

	$pdf->SetFont('Arial','',10);
	foreach ($dataUbiTrab as $data) 
	{

		$sql=sql::mp_movxPer($data['trabId']);
		$dataMovPer=negocio::getData($sql);

		$data['ubiTrab']= evaUbi($dataMovPer);

		$pdf->Cell(75,10,utf8_decode($data['trabEmp']),1,0,'L');
		$pdf->Cell(40,10,utf8_decode($data['areTrab']),1,0,'L');
		$pdf->Cell(75,10,$data['ubiTrab'],1,1,'L');

		$pdf->Ln(5);

		foreach ($dataMovPer as $data) 
		{

			$sql=sql::mp_detMovShow($data['moviId']);
			$dataDetMovPer=negocio::getData($sql);

			$pdf->cell(85,10,'MOTIVO',1,0,'C');
			$pdf->cell(35,10,'UBICACION',1,0,'C');
			$pdf->cell(70,10,'DETALLE',1,1,'C');

			foreach ($dataDetMovPer as $data) 
			{
				$pdf->Cell(85,10,$data['motiv'],1,0,'C');
				$pdf->Cell(35,10,$data['ubi'],1,0,'C');
				$pdf->MultiCell(70,10,$data['det'],1);
			}

			$pdf->Ln(5);
		}

		$pdf->Ln(5);
	}
	
//------------------------------------------------------------------------------------------------------//
	
	if($pdf->GetY()>220) {
	$pdf->AddPage();	
	}
	else {
	$vacio='';	
	}	
	
	$pdf->Ln(15);
	$ubiY=$pdf-> GetY();
	$pdf->Line(20,$ubiY,85,$ubiY);
	$pdf->Line(185,$ubiY,$pdf->GetX()+100,$ubiY);
	$pdf->Ln(5);
	$pdf->Cell(95,5,'Firma de Ejecutivo:',0,0,'C');
	$pdf->Cell(95,5,'Firma de Gerente:',0,0,'C');

	#$pdf->ImprovedTable($header,$dataVisi);

	#$pdf->AddPage();
	#$pdf->FancyTable($header,$data);

	$pdf->Output();

?>