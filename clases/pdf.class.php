<?php
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

class MiPDF extends TCPDF {
    public $empresa_id;
    public $header;
    public $footer;
	public function Header(){
            if($this->header==1){
                //Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
		$image_file = K_PATH_IMAGES."logo_empresa".$this->empresa_id.".png";
		
                switch($this->empresa_id){
                    case 1: // Electrowerke
                        //$this->Image($image_file,($this->w-45), 5, 35, '', 'PNG', '', 'R', false, 300, '', false, false, 0, false, false, false);
                        $this->Image($image_file, 15, 5, 35, '', 'PNG', '', 'L', false, 300, '', false, false, 0, false, false, false);                       
                        break;
                    case 2: // Electrotec
                        $empresa=empresa::edit('S',$this->empresa_id);
                        $this->Image($image_file, 15, 5, 35, '', 'PNG', '', 'L', false, 300, '', false, false, 0, false, false, false);
                        $this->SetFont('helvetica', 'N', 9);
                        $this->Cell(0, 5,$empresa['emp_direccion'], 0, false, 'R', 0, '', 0, false, 'T', 'M');
                        $this->Ln();
                        $this->Cell(0, 5,'Telef. : '.$empresa['emp_telef'], 0, false, 'R', 0, '', 0, false, 'T', 'M');
                        $this->Ln();  
                        $this->Cell(0, 5,'Fax  : 355-2184', 0, false, 'R', 0, '', 0, false, 'T', 'M');
                        break;
                }
                /******** Generar Linea horizontal ********/
                $imgy = $this->getImageRBY();
                $this->SetLineStyle(array('width' => 1/ $this->k, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $this->SetY((2.835 / $this->k) + max($imgy, $this->y));//			
                $this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
                /******************************************/
            }
	}
	public function Footer() {
		// Position at 15 mm from bottom
            if($this->footer==1){
                if($this->empresa_id==1){
                    $this->SetY(-20);
                }else{
                    $this->SetY(-10);
                }
                $h=$this->w/3;
                $this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
                $this->Ln(2);                
		//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
		switch($this->empresa_id){
                    case 1: // Electrowerke
                        $empresa=empresa::edit('S',$this->empresa_id);
                        $this->Cell($h, 0,$_SESSION['SIS'][6], 0, false, 'L', 0, '', 0, false, 'T', 'M');               
                        $this->Cell($h, 0,'RUC '.$empresa['emp_ruc'], 0, false, 'C', 0, '', 0, false, 'T', 'M');               
                        $this->Cell(0, 0,'Telef. : '.$empresa['emp_telef'], 0, false, 'R', 0, '', 0, false, 'T', 'M');
                        $this->Ln();                
                        $this->Cell(($h*2), 5,$empresa['emp_direccion'], 0, false, 'L', 0, '', 0, false, 'T', 'M');                
                        $this->Cell(0, 5,'Fax  : 355-2184', 0, false, 'R', 0, '', 0, false, 'T', 'M');
                        $this->Ln();
                        break;
                    case 2: // Electrotec
                        
                        break;
                }                                                
                $this->Cell($this->w, 0, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            }
	}
}
?>