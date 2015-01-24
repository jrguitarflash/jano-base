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
	#$this->Cell(190,7,'Fecha: '.$fecha,0,1,'R');
	#$this->Cell(190,7,'Hora: '.$hora,0,1,'R');
	$this->Ln(5);
	//colocar logo
	$this->Image('../images/logo1.png',10,10,40);
	//fuente estilo y tamaño
	$this->SetFont('Arial','B',15);
	//mover a la derecha
	$this->Cell(50);
	//titulo del reporte
	$this->SetFont('Arial','',10);
	#$this->cell(125,10,"Vendedor: ".$_GET['vend'],0,1,'R');
	$this->SetFont('Arial','B',15);
	$this->Cell(100,10,'REPORTE DE PROFORMA',1,1,'C');
	//titulo del reporte
	$this->SetFont('Arial','',10);
	#$this->cell(65,10,"Fecha Inicial: ".$_GET['txtFechIni'],1,1,'R');
	$this->Cell(120);
	#$this->cell(75,10,"Fecha Final: ".$_GET['txtFechFin'],0,1,'R');
	$this->SetFont('Arial','B',15);
	
	//$this->Cell(190,10,'REPORTE DE VISITAS',1,1,'C');
	//quebrar la linea
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


#print_r($data);

$pdf = new PDF();
$pdf->AliasNbPages();

//Column headings
#$header = array('Codigo', 'Producto','Marca','Modelo','Precio','Stock actual','Observacion');
#$header = array('Id', 'Empresa','Contacto','Observacion');

//Data loading
#$data = $pdf->LoadData('text/text2.txt');

$pdf->SetFont('Arial','',14);
#$pdf->AddPage();
#$pdf->BasicTable($header,$data);

$pdf->AddPage();

$sql=sql::getDetProf($_GET['id']);
$dataDetProf=negocio::getData($sql);

$sql=sql::getDetGast($_GET['id']);
$dataDetGast=negocio::getData($sql);

//---------------------------------------------------HEADER DATOS---------------------------------------------//

		$pdf->Rect(5, 5, 202, 285);
		$pdf->Line(200,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
		$pdf->Ln(3);
		$pdf->SetDrawColor(0,0,0);
	   $pdf->SetLineWidth(.3);
	   $pdf->SetFont('Arial','B',10);
		#$pdf->Cell(70,10,utf8_decode('N° de Proforma: ')."PROF-".str_pad($dataDetProf[0]['codProf'],5,'0',STR_PAD_LEFT),0,0,'L');
		$pdf->Cell(70,10,utf8_decode('N° de Proforma: ').$dataDetProf[0]['codProf'],0,0,'L');		
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(80,10,'Fecha de reporte: '.$pdf->fecha(),0,1,'L');
		$pdf->SetFont('Arial','B',10);
		#$pdf->Cell(50,10,'Hora: '.$pdf->hora(),0,1,'L');
		#$pdf->Cell(40,10,'Fecha: '.$data2[$i],0,1,'L');
		$pdf->Ln(3);
		$pdf->Line(200,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
		$pdf->Ln(5);

//--------------------------------------------------------------------------------------------------------------------//

//-----------------------------------------ESTRUCTURA DETALLE PROFORMA------------------------------------------------//

/*
function situEje($x,$ej)
{
	$x=$x+$ej;
	return $x;
}

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->MultiCell(110,10,'COSTO DE EQUIPOS',1,'L');
$x=situEje($x,110);
$pdf->SetXY($x,$y);
$pdf->MultiCell(20,10,'CANT.',1,'L');
$x=situEje($x,20);
$pdf->SetXY($x, $y);
$pdf->MultiCell(30,10,'P.UNIT',1,'L');
$x=situEje($x,30);
$pdf->SetXY($x, $y);
$pdf->MultiCell(30,10,'P.TOTAL',1,'L');
*/

$pdf->SetFont('Arial','B',10);

$pdf->Cell(100,10,'Equipos',1,0,'L');
$pdf->Cell(30,10,'Cant.',1,0,'L');
$pdf->Cell(30,10,'P.Unit',1,0,'L');
$pdf->Cell(30,10,'P.Total',1,1,'L');

$pdf->SetFont('Arial','',8);

$i=0;
$preTot=Array();
$preTotFin=0;
$gasTotFin=0;
$moneda;

foreach($dataDetProf as $data)
{
	$pdf->Cell(100,10,utf8_decode($data['nomProd']),1,0,'L');
	$pdf->Cell(30,10,$data['cantProf'],1,0,'C');
	$pdf->Cell(30,10,$data['preUni'],1,0,'R');
	$preTot[$i]=$data['cantProf']*$data['preUni'];
	$pdf->Cell(30,10,$preTot[$i],1,1,'R');
	$preTotFin=$preTotFin+$preTot[$i]; // TOTAL PRECIOS
	$gasTotFin=$gasTotFin+$data['gasAlmacen']; // TOTAL GASTOS
	$moneda=$data['moneda'];
	$i++;
}

$pdf->SetFont('Arial','B',10);

$montFob=0;
$dataFob=Array();
$dataCif=Array();
$dataNac=Array();
$i=0;

foreach($dataDetProf as $data)
{
	$dataFob[$i]=$data['prod_fob_valor']-$preTot[$i];
	$dataCif[$i]=$data['prod_cif_valor']-$data['prod_fob_valor'];
	$dataNac[$i]=$data['prod_nac_valor'];
	$i++;
}

$totFle=0;
$totNac=0;
$i=0;
$totFleNac=0;

for($i=0;$i<count($dataFob);$i++) 
{
	$totFle=$totFle+$dataFob[$i]+$dataCif[$i];
	$totNac=$totNac+$dataNac[$i];
}

$totFleNac=$totFle+$totNac; //TOTAL FLETE Y NACIONALIZACION

$pdf->Cell(100,10,'Flete',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,$totFle,1,1,'R');

$pdf->Cell(100,10,'Nacionalizacion',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,$totNac,1,1,'R');

$pdf->SetFont('Arial','B',10);

$pdf->Cell(100,10,'Otros gastos',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,'',1,1,'L');


$pdf->SetFont('Arial','',10);

$totGasFin=0;

foreach($dataDetGast as $data)
{
		$pdf->Cell(100,10,$data['gasto'],1,0,'L');
		$pdf->Cell(30,10,'',1,0,'L');
		$pdf->Cell(30,10,'',1,0,'L');
		$pdf->Cell(30,10,$data['gastoVal'],1,1,'R');
		$totGasFin=$totGasFin+$data['gastoVal']; //TOTAL GASTOS
}

$pdf->SetFont('Arial','B',10);

$pdf->Cell(100,10,'Costo almacen',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,$gasTotFin,1,1,'R');


$pdf->Ln(5);

$pdf->Cell(190,10,'Total: '.$moneda." ".($preTotFin+$gasTotFin+$totFle+$totNac+$totGasFin),1,0,'R');

//------------------------------------------------------------------------------------------------------------------//

		
//------------------------------------------------------------------------------------------------------------------//
	
	$pdf->Ln(35);
	$ubiY=$pdf-> GetY();
	$pdf->Line(20,$ubiY,65,$ubiY);
	$pdf->Line(80,$ubiY,$pdf->GetX()+120,$ubiY);
	$pdf->Line(150,$ubiY,$pdf->GetX()+180,$ubiY);
	$pdf->Ln(5);
	$pdf->Cell(65,5,'Ejecutivo de Ventas',0,0,'C');
	$pdf->Cell(65,5,'Gerente Comercial',0,0,'C');
	$pdf->Cell(65,5,'Gerente General',0,0,'C');

#$pdf->ImprovedTable($header,$dataVisi);

#$pdf->AddPage();
#$pdf->FancyTable($header,$data);

$pdf->Output();

?>