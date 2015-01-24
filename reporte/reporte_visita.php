<?php

session_start();

header("Content-Type: text/html;charset=utf-8");

require('../clases/fpdf/mc_table.php');
require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


class PDF extends PDF_MC_Table
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
	$this->Cell(70);
	//titulo del reporte
	$this->SetFont('Arial','',10);
	$this->cell(125,10,ucwords("Vendedor: Ing. ".$_GET['vend']),0,1,'R');
	$this->SetFont('Arial','B',15);
	$this->Cell(120,10,'REPORTE DE VISITAS',0,0,'R');
	//titulo del reporte
	$this->SetFont('Arial','',10);
	$this->cell(75,10,"Fecha Inicial: ".$_GET['txtFechIni'],0,1,'R');
	$this->Cell(120);
	$this->cell(75,10,"Fecha Final: ".$_GET['txtFechFin'],0,1,'R');
	$this->SetFont('Arial','B',15);
	
	//$this->Cell(190,10,'REPORTE DE VISITAS',1,1,'C');
	//quebrar la linea
	$this->Ln(5);
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

//-----------------------------------[*]-----------------------------------//

$sql=sql::getDetVisixId($_GET['id']);
$data=negocio::getData($sql);
$dataVisi=array();
$i=0;

/* CORRELATIVO VISITA */
$sql=sql::visi_getCorre($_GET['id']);
$valCorreVisi=negocio::getVal($sql,'visiCorre');

foreach($data as $data)
{
	$sql1=sql::getClixContacxCli($data['idEmpVisita']);
	$sql2=sql::getContacxId($data['idContacVisita']);
	
	$dataVisi[$i]['id']=$data['idDetVisita'];
	$dataVisi[$i]['idContac']=$data['idContacVisita'];
	$dataVisi[$i]['empresa']=negocio::getVal($sql1,'empresa');
	$dataVisi[$i]['contacto']=negocio::getVal($sql2,'contacto');
	$dataVisi[$i]['observacion']=$data['obsVisita'];
	$dataVisi[$i]['observacionPen']=$data['obsPenVisita'];
	$dataVisi[$i]['direccion']=$data['direVisi'];

	//---------------Add Column dir & fech -------
	$dataVisi[$i]['dirOrig']=$data['dirVisiOrig'];
	$dataVisi[$i]['fechVisi']=$data['fechVisi'];
	$dataVisi[$i]['montVisi']=$data['montVisi'];
	//-----------------------[*]-------------------
	
	$i++;
}

$sql=sql::getVisitasxId($_GET['id']);
$dataVi=negocio::getData($sql);
$dataGasto=array();
$i=0;


foreach($dataVi as $dataVi)
{
	$sql1=sql::getMonedaxId($_GET['id']);
	
	$mone=iconv('UTF-8', 'windows-1252', negocio::getVal($sql1,'mon_sigla'));
	$dataGasto[$i]['tipoMone']=$mone;
	$dataGasto[$i]['pasaVisi']=$dataVi['pasaVisi']; 
	$dataGasto[$i]['hospeVisi']=$dataVi['hospeVisi'];
	$dataGasto[$i]['aliVisi']=$dataVi['alimeVisi'];
	$dataGasto[$i]['transVisi']=$dataVi['transInterVisi'];
	$dataGasto[$i]['total']=floatval($dataVi['pasaVisi'])+floatval($dataVi['hospeVisi'])+floatval($dataVi['alimeVisi'])+floatval($dataVi['transInterVisi']);
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
		#$pdf->Cell(70,10,utf8_decode('N° de Reporte: ')."V".str_pad(1000+$_GET['id'],4,'0',STR_PAD_LEFT),0,0,'L');
	    $pdf->Cell(70,10,utf8_decode('N° de Reporte: ').' '.$valCorreVisi,0,0,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(80,10,'Fecha de reporte: '.$pdf->fecha(),0,1,'L');
		$pdf->SetFont('Arial','B',10);
		#$pdf->Cell(50,10,'Hora: '.$pdf->hora(),0,1,'L');
		#$pdf->Cell(40,10,'Fecha: '.$data2[$i],0,1,'L');
		$pdf->Ln(3);
		$pdf->Line(200,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
		$pdf->Ln(5);

//-------------------------------------HEADER DATOS----------------------------------//

$tamVisi=sizeof($dataVisi);
$resContacs="";

for($i=0;$i<$tamVisi;$i++) 
{
	$cadVecSep=explode(' ',$dataVisi[$i]['idContac']);
	  
	for($j=0;$j<count($cadVecSep);$j++) 
	{
	 	$sql2=sql::getContacxId($cadVecSep[$j]);
	 	if($j==0) 
	 	{
	 		$resContacs=$resContacs."".negocio::getVal($sql2,'contacto');
	 	}
	 	else
	 	{
			$resContacs=$resContacs.", ".negocio::getVal($sql2,'contacto');	 	
	 	}
	}	
	
	$pdf->SetFont('Arial','B',10);
	#$pdf->Cell(20,10,'Codigo:',0,0,'L');
	$pdf->SetFont('Arial','',10);
	#$pdf->Cell(160,10,$dataVisi[$i]['id'],0,1,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,10,'Empresa:',0,0,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(160,10,strtoupper($dataVisi[$i]['empresa']),0,1,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,10,'Contactos:',0,0,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(150,10,strtoupper(utf8_decode($resContacs)),0,'L');
	$resContacs="";
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(52,10,'Observacion por actividades:',0,0,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(130,10,strtoupper($dataVisi[$i]['observacion']),0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(52,10,'Compromiso pendientes:',0,0,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(130,10,strtoupper($dataVisi[$i]['observacionPen']),0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(52,10,'Direccion:',0,0,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(130,10,strtoupper($dataVisi[$i]['direccion']),0,'L');
	
	$pdf->Line(200,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
	$pdf->Ln(5);
}
	
	$pdf->Ln(5);
	
	//------------------------- GASTOS DE VISITAS AÑADIDAS AL REPORTE ------------------------------------//

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(80,10,'GASTOS DE LA VISITA',0,1,'L');
		$pdf->Line(90,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(50,10,'Tipo Moneda: ',0,0,'L');
		$pdf->Cell(30,10,($dataGasto[0]['tipoMone']),0,1,'R');
		$pdf->Cell(50,10,'Pasajes: ',0,0,'L');
		$pdf->Cell(30,10,$dataGasto[0]['pasaVisi'],0,1,'R');
		$pdf->Cell(50,10,'Hospedaje: ',0,0,'L');
		$pdf->Cell(30,10,$dataGasto[0]['hospeVisi'],0,1,'R');
		$pdf->Cell(50,10,'Alimentacion: ',0,0,'L');
		$pdf->Cell(30,10,$dataGasto[0]['aliVisi'],0,1,'R');
		$pdf->Cell(50,10,'Transporte: ',0,0,'L');
		$pdf->Cell(30,10,$dataGasto[0]['transVisi'],0,1,'R');
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(80,10,'Total : '.$dataGasto[0]['tipoMone']." ".$dataGasto[0]['total'],1,1,'R');

		
	//------------------------------------------------------------------------------------------------------//

	$pdf->Ln(5);

	/*---------------------DETALLE PASAJES DE VISITAS------------------------------*/

	/*
		$sql=sql::getDetPasj($_GET['id']);
		$dataDetPasj=negocio::getData($sql);

	*/
		$pdf->Ln(10);

		$totPasj=0;

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(80,10,'DETALLE DE PASAJES',0,1,'L');
		$pdf->Line(170,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());

		#$pdf->Cell(50,10,'Monto',1,0,'L');
		#$pdf->Cell(120,10,'Detalle',1,1,'L');

		$pdf->SetWidths(array(50,60,60,20));
		$pdf->SetAligns(array('C','L','R','L'));
		$pdf->Row(array("Fecha Visita","Direccion Origen","Direccion Destino","Monto"));


	foreach($dataVisi as $data)
	{
		$pdf->SetFont('Arial','',10);

		/*
			$pdf->Cell(20,10,$data['fechVisi'],0,0,'L');
			$pdf->Cell(50,10,$data['dirOrig'],0,0,'L');
			$pdf->Cell(70,10,$data['direccion'],0,0,'L');
			$pdf->Cell(20,10,$data['montVisi'],0,1,'L');
		*/

		/*
			$pdf->Cell(50,10,$data['montVisi'],1,0,'L');
			$pdf->MultiCell(120,5,"Fecha: ".$data['fechVisi']." \n 
									Direccion Origen: ".$data['dirOrig']." \n 
									Direccion Destino: ".$data['direccion']." (".$data['empresa'].") ",1,'L');
			$totPasj=$totPasj+$data['montVisi'];
		*/

		#Extension Table MultiCell FPDF

		$pdf->Row(array($data['fechVisi'],strtoupper($data['dirOrig']),strtoupper($data['direccion']." (".$data['empresa'].")"),number_format($data['montVisi'],2)));
		$totPasj=$totPasj+$data['montVisi'];
	}

	$pdf->Line(200,$pdf->GetY(),$pdf-> GetX(),$pdf-> GetY());
	$pdf->Cell(170,10,'Total',1,0,'R');
	$pdf->Cell(20,10,$dataGasto[0]['tipoMone'].' '.number_format($totPasj,2),1,1,'L');

	$pdf->Ln(5);

	/*------------------------------- [+] ------------------------------------------*/
	
	if($pdf->GetY()>220) {
	$pdf->AddPage();	
	}
	else {
	$vacio='';	
	}	
	
	$pdf->Ln(15);
	$pdf->Cell(95,5,ucwords("Ing. ".$_GET['vend']),0,0,'C');
	$pdf->Cell(95,5,ucwords('Ing. Cesar Venturo'),0,1,'C');
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