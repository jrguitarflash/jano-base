<?php

class negocio
{
	public $sql;

	public function getData($sql)
	{
		#$conex=mysql_connect('localhost','root','');
		#mysql_select_db('planilla',$conex) or die('error'.mysql_error());
		$data=array();
		$result=mysql_query($sql);
		$cont=mysql_num_rows($result);
		while($x=mysql_fetch_array($result))
		{
			$data[]=$x;
		}
		return $data;
	}

	public function getVal($sql,$val)
	{
		$valor;
		$result=mysql_query($sql);
		$cont=mysql_num_rows($result);
		if($cont==0) {
			$valor='';
		}else {
			while($x=mysql_fetch_array($result)) {
				$valor=$x[$val];			
			}
		}
			
		return $valor;
	} 
	
	public function setData($sql)
	{
		$result=mysql_query($sql);
		$cont=mysql_affected_rows();	
		return $cont;
	}

	/*
		public function setData2($sql)
		{
			$result=mysql_query($sql);	
			return $result;
		}
	*/

	public function getInsertId()
	{
		$idInsert=mysql_insert_id();
		return $idInsert;
	}

	public function subirImagen($ficheroName,$ficheroTmp,$ficheroSize,$ficheroType)
	{
		  if(is_uploaded_file($ficheroTmp)) 
		  { 
		  				// verifica haya sido cargado el archivo 
				if(move_uploaded_file($ficheroTmp,  "adjuntos/".$ficheroName)) 
				{ 
						// se coloca en su lugar final 
						//echo "<b>Upload exitoso!. Datos:</b><br>"; 
						//echo "Nombre: <i><a href=\"".$ficheroName."\">".$ficheroName."</a></i><br>"; 
						$ruta= "adjuntos/".$ficheroName;
						//echo "Tipo MIME: <i>".$ficheroType."</i><br>"; 
						//echo "Peso: <i>".$ficheroSize." bytes</i><br>"; 
						//echo "<br><hr><br>"; 
				}
		  }
		  else
		  {
				$ruta=null;
		  }
		  return $ruta;
	}

	public function veriEmailxNom($nomPer)
	{
		if($nomPer=='') 
		{
			$val="no existe email";		
		}
		else
		{
			$val=$nomPer;		
		}	
		return $val;
	}

	public function veriEnvio($paraEnvio)
	{
		if($paraEnvio==1) 
		{
			$msj="mensaje enviado";
		}
		else
		{
			$msj="mensaje no enviado";
		}
		return $msj;
	}

	public function veriRutImg($rutImg)
	{
		if(is_null($rutImg)) 
		{
			$msj="Ningun archivo adjuntado actualmente";
		}
		else
		{
			$msj=$rutImg;
		}
		return $msj;
	}

	public function veriSubiImg($valAdju,$valFijo)
	{
		if(is_null($valAdju)) 
		{
			$valRut=$valFijo;
		}
		else 
		{
			$valRut=$valAdju;
		}
		return $valRut;
	}

	public function getFechActual()
	{
		$date = new DateTime();
		$date->modify('-5 hour');
		$fecha=$date->format('Y-m-d');
		return $fecha;	
	}

	public function concatVect($vecData)
	{
		$cade="";
		for ($i=0;$i<count($vecData);$i++)    
		{     
			if($cade=="") 
			{
				$cade=$cade.$vecData[$i];
			}
			else 
			{
				$cade=$cade." ".$vecData[$i];
			}    
		}
		return $cade; 			
	}


	public function calcuPorCuxCob($impor,$sumCan)
	{
			$porcen=($sumCan*100)/$impor;
			
			return $porcen;
	}

	public function mosEstaCuxCob($porcen)
	{
		if($porcen<100) 
		{
			$esta="<label class='roj'>pendiente</label>";			
		}
		else 
		{
			$esta="<label class='ver'>cancelado</label>";
		}
		return $esta;
	}

	public function valFinSumCuxCob($sumCu)
	{
			if($sumCu==null) 
			{
				$sumCu=number_format(0,2);
			}
			else
			{
				$sumCu=$sumCu;			
			}
			return $sumCu;
	}

	public function tareGenCuenxPag()
	{
		if(isset($_POST['opci'])) 
		{
			$tare=$_POST['opci'];
			$param1=$_POST['fechIni'];
			$param2=$_POST['fechFin'];			
		}
		else 
		{
			$tare='tod';
			$param1='';
			$param2='';		
		}
		$funTare="Javascript:geneExcelGroupxPag('".$tare."','".$param1."','".$param2."')";
		return $funTare;
	}
	
	public function reorAcci($acci) 
	{
		$acciArr=Array();
		$acciArr=explode("\n",$acci);
		$cad="";
		for($i=0;$i<count($acciArr);$i++) 
		{
			if($i==count($acciArr)-1) 
			{
				$cad=$cad."\n".date("g:i:s-a-d/m/Y")." ".$acciArr[$i];
			}
			else 
			{
				$cad=$cad."\n".$acciArr[$i];
			}
		}
		return $cad;
	}

	public function reorAcci2($acci,$acci2) 
	{
		if($acci2!='') 
		{
			$acci=$acci."\n\n".$acci2;		
		}
		$acciArr=Array();
		$acciArr=explode("\n",$acci);
		$cad="";
		for($i=0;$i<count($acciArr);$i++) 
		{
			if($i==count($acciArr)-1 and $acci2!='') 
			{
				$cad=$cad."\n".date("g:i:s-a-d/m/Y")." ".$acciArr[$i];
			}
			else 
			{
				$cad=$cad."\n".$acciArr[$i];
			}
		}
		return $cad;
	}

	public function evaAcciDet($acci) 
	{
		$acciArr=Array();
		$acciArr=explode("\n",$acci);
		$cad="";
		for($i=0;$i<count($acciArr);$i++) 
		{
			if($i==count($acciArr)-1) 
			{
				$cad=$cad."<br/>"."<label style='color:red'>".$acciArr[$i]."</label>";
			}
			else 
			{
				$cad=$cad."<br/>"."<label style='color:silver'>".$acciArr[$i]."</label>";
			}
		}
		return $cad;
	}

	/* REGLAS DE NEGOCIO DE MODULO COBRANZAS */

	public function calDiasVenc($fech1,$fech2)
	{
		if( ($fech1!='' or $fech1!=null) and ($fech2!='' or $fech2!=null) )
		{
			$fech1Arr=Array();
			$fech2Arr=Array();

			$fech1Arr=explode("/",$fech1);
			$fech2Arr=explode("/",$fech2);

			$timestamp1 = mktime(0,0,0,$fech1Arr[1],$fech1Arr[0],$fech1Arr[2]);
			$timestamp2 = mktime(0,0,0,$fech2Arr[1],$fech2Arr[0],$fech2Arr[2]);

			$segundos_diferencia = $timestamp2 - $timestamp1; 

			$dias_diferencia = ((($segundos_diferencia/60)/60)/24); 

		}
		else
		{
			$dias_diferencia="---";
		}
		return $dias_diferencia;

	}

	public function evaDiaVenc($dia)
	{
		if($dia<=0) 
		{
			$msjDia="<label class='roj'>".$dia."</label>";			
		}
		else 
		{
			$msjDia="<label class='ver'>".$dia."</label>";
		}
		return $msjDia;
	}

	public function concatVectCob($vecData)
	{
		$cade="";
		for ($i=0;$i<count($vecData);$i++)    
		{     
			if($cade=="") 
			{
				$cade=$cade.$vecData[$i];
			}
			else 
			{
				$cade=$cade."-".$vecData[$i];
			}    
		}
		return $cade; 			
	}

	/*  REGLAS DE NEGOCIO DEL MODULO VACACIONES */

	public function fechLet($date, $opcion) 
	{
        $dia = explode("-", $date, 3);
        $year = $dia[0];
        $month = (string)(int)$dia[1];
        $day = (string)(int)$dia[2];
       
        $dias = array("domingo","lunes","martes","mi&eacute;rcoles" ,"jueves","viernes","s&aacute;bado");
        $tomadia = $dias[intval((date("w",mktime(0,0,0,$month,$day,$year))))];
     
        $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
       
        switch ($opcion) 
        {
	        case "diasemana":
	        $sali= $tomadia;
	        break;
	        case "diames":
	        $sali= $day;
	        break;
	        case "mes":
	        $sali= $meses[$month];
	        break;
	        case "anio":
	        $sali= $year;
	        break;
	        default:
	        $sali= "Nada";
        }
        return $sali;
    }

    public function evaFilPeri($valTrab,$valPeri,$valAre,$sql1,$sql2)
    {

    	if($valTrab!='Todos')
    	{
    		$sql=$sql1;
    	}
    	else
    	{
    		$sql=$sql2;
    	}
    	return $sql;
    }

    public function evaFilPeriPru($valTrab,$valPeri,$valAre)
    {

    	if($valTrab!='Todos')
    	{
    		$sql=sql::vaca_periTrabxFil($valTrab,$valPeri);
    	}
    	else
    	{
    		$sql=sql::vaca_periTrabxAre($valAre,$valPeri);
    	}
    	return $sql;
    }

    public function evaBusPeri($areTrab,$anPeri,$valTrab)
    {
    	if($valTrab=='Todos')
    	{
    		$sql=sql::vaca_getTrabAsig($areTrab,$anPeri);
    	}
    	else
    	{
    		$sql=sql::vaca_getTrabAsigEsp($valTrab,$anPeri);
    	}
    	return $sql;
    }

    public function evaDiPen($diTom,$diPen)
    {
    	if($diPen>$diTom)
    	{
    		$diPen=$diTom;
    	}
    	else
    	{
    		$diPen=$diPen;
    	}
    	return $diPen;
    }

    public function evaSumDiNull($sumDi)
    {
    	if(is_null($sumDi))
    	{
    		$sumDi=0;	
    	}
    	else
    	{
    		$sumDi=$sumDi;	
    	}
    	return $sumDi;
    }

    public function evaExisVacaAsig($filAfec,$valContVaca)
    {
    	if($filAfec>0 or $valContVaca>0 )
    	{
    		$noti='1'.' '.'Forma de calculo Asignado correctamente';
    	}
    	else
    	{
    		$noti='No cuenta con dias asignados para forma de calculo';
    	}
    	return $noti;
    }

    public function evaGetPeriTot($perId)
    {
    	if($perId=='Todos')
    	{
    		$sql=sql::vaca_getPeriAnxTod();
    	}
    	else
    	{
    		$sql=sql::vaca_getPeriAn($perId);
    	}
    	return $sql;
    }

    public function evaPeriDispo($trabId,$dataPeri,$valPer)
    {
    	$arrPeri=Array();
    	$arrPeri=$dataPeri;
    	$arrVeri=Array();
    	$valPerId=0;
    	for($i=0;$i<count($arrPeri);$i++)
    	{
    		$sql=sql::vaca_evaIteraPeri($trabId,$arrPeri[$i]['vaca_perioAn_id']);
    		$valPeri=negocio::getVal($sql,'sumDi');
    		if($valPeri=='1')
    		{
    			$arrVeri[0]=$arrPeri[$i]['vaca_perioAn_id'];
    			$arrVeri[1]=1;
    			$i=count($arrPeri); 
    		}
    		else if($valPeri=='2')
    		{
    			$arrVeri[0]=$arrPeri[$i]['vaca_perioAn_id'];
    			$arrVeri[1]=2;
    			if($valPer==$arrVeri[0])
    			{
    				$i=count($arrPeri);
    			}
    		}
    		else
    		{
    			$arrVeri[0]=$arrPeri[$i]['vaca_perioAn_id'];
    			$arrVeri[1]=0;
    		}
    	}
    	return $arrVeri;
    }

    public function msjNotifi($notifi)
	{
		$msjNotifi="<div class='success' id='success'>
				<label class='msjControInf'>"
				.$notifi.
				"</label>
				</div>";
		return $msjNotifi;
	}

	public function evaFinSema($fechIni,$fechFin)
	{
		$sql=sql::vaca_testNomMes($fechIni,$fechFin);
		$dataDifFech=negocio::getData($sql);

		$fechIni=$dataDifFech[0]['fechIni'];
		$fechFin=$dataDifFech[0]['fechFin'];
		$difDias=$dataDifFech[0]['difDias'];

		$contDiHab=0;

		for($i=0;$i<intVal($difDias);$i++)
		{
			$sql=sql::vaca_testIncreFech($fechIni,$i);
			$valFechNom=negocio::getVal($sql,'nomDia');
			if($valFechNom=="sábado" or $valFechNom=="domingo")
			{
				$contDiHab++;			
			}
			else
			{
				$contDiHab=$contDiHab;	
			}	
		}

		return $contDiHab;
	}

	public function evaFolCal($numForCal,$fechIni,$fechFin)
	{
		if($numForCal==22)
		{
			$numFinSem=negocio::evaFinSema($fechIni,$fechFin);
		}
		else
		{
			$numFinSem=0;
		}
		return $numFinSem;
	}

	/* REGLAS DE NEGOCIO DEL MODULO CENTRO DE COSTOS */

	public function evaCotiFl($arrCotiFl)
	{
		if(count($arrCotiFl)>0)
		{
			$result="";
		}
		else
		{
			$result="<tr><td colspan='13' align='center' >No existe detalle</td></tr>";
		}
		return $result;
	}

	public function evaClasiProd($tipClasi)
	{
		if($tipClasi=='1')
		{
			$sql=sql::cc_prodCatalog();
			$dataResul=negocio::getData($sql);
		}
		else
		{
			$sql=sql::cc_servCatalog();
			$dataResul=negocio::getData($sql);
		}
		return $dataResul;
	}

	public function getProdxId($prodId)
	{
		$sql=sql::cc_prodxId($prodId);
		$valProd=negocio::getVal($sql,'prod_nombre');
		return $valProd;
	}

	public function getClasifProd($clasifId)
	{
		$sql=sql::cc_clasiProdxId($clasifId);
		$valClasif=negocio::getVal($sql,'prod_clasif_nombre');
		return $valClasif;
	}

	public function getProvexId($proveId)
	{
		$sql=sql::cc_provexId($proveId);
		$valProve=negocio::getVal($sql,'emp_nombre');
		return $valProve;
	}

	public function getMonexId($moneId)
	{
		$sql=sql::cc_monexId($moneId);
		$valMone=negocio::getVal($sql,'mon_sigla');
		return $valMone;
	}

	public function evaModelMar($valModMar)
	{
		if(is_null($valModMar) or $valModMar=='' )
		{
			$valModMar='---';
		}
		else
		{
			$valModMar=$valModMar;
		}
		return $valModMar; 
	}

	public function getMarMod($prodId,$tipDat)
	{
		$sql=sql::cc_marcaModelxId($prodId);
		$valMarMod=negocio::getVal($sql,$tipDat);
		return $valMarMod;
	}

	public function evaTipMone($idTip)
	{
		if($idTip==1)
		{
			$moneDes="OC";
		}
		elseif ($idTip==3) 
		{
			$moneDes="OS";
		}
		elseif ($idTip==2)
		{
			$moneDes="EW";
		}
		elseif ($idTip=4)
		{
			$moneDes="VI";
		}
		else
		{
			$moneDes="";
		}
		return $moneDes;	
	}

	public function evaPrefiTip($tipOrd)
	{
		if($tipOrd==1)
		{
			$valPrefi=5;
		}
		else if($tipOrd==3)
		{
			$valPrefi=9;
		}
		else
		{
			$valPrefi=3;	
		}
		return $valPrefi;
	}

	public function evaTipDocOrd($tipDoc,$idComp)
	{
		if($tipDoc=='OC')
		{
			$funJs="Accion('U','500','400','persona_form','0','138','".$idComp."','59','compras','compras_id=".$idComp."')";
		}
		elseif ($tipDoc=='OS')
		{
			$funJs="cs_visuDetCot('".$idComp."')";
		}
		elseif($tipDoc=='EW')
		{
			$funJs="Accion('U','500','400','persona_form','0','90','".$idComp."','59','compras','compras_id=".$idComp."')";
		}
		elseif($tipDoc=='VI')
		{
			$sql=sql::visi_getParamRepor($idComp);
			$dataParam=negocio::getData($sql);
			$funJs="visi_geneRep('".$idComp."','".$dataParam[0]['fechIniVisi']."','".$dataParam[0]['fechFinVisi']."','".$dataParam[0]['vend']."')";	
		}
		else
		{
			$funJs='';
		}
		return $funJs;
	}

	public function evaConverTot($conver,$monTot)
	{
		$tot=Array();

		if(is_null($monTot))
		{
			$tot[0]['totDol']=0;
			$tot[0]['totSol']=0;
		}
		else
		{

			if($conver=='soles')
			{
				//CONVERSION SOLES A DOLARES [1 PEN = 0.355556 USD]
				$tot[0]['totDol']=$monTot*0.355556;

				//CONVERSION SOLES A SOLES
				$tot[0]['totSol']=$monTot;
			}
			else if($conver=='dolar')
			{
				//CONVERSION DOLAR A DOLAR
				$tot[0]['totDol']=$monTot;

				//CONVERSION DOLAR A SOLES [1 USD = 2.81250 PEN]
				$tot[0]['totSol']=$monTot*2.81250;
			}
			else if($conver=='hebros')
			{
				//CONVERSION HEBROS A DOLARES [1 EUR = 1.37586 USD]
				$tot[0]['totDol']=$monTot*1.37586;

				// CONVERSION HEBROS A SOLES [1 EUR = 3.86971 PEN]
				$tot[0]['totSol']=$montTot*3.86971;
			}
			else
			{
				$tot[0]['totDol']=0;
				$tot[0]['totSol']=0;
			}

		}
		return $tot;
	}

	public function evaNullTot($valTot)
	{
		if(is_null($valTot))
		{
			$tot=0;
		}
		else
		{
			$tot=$valTot;
		}
		return $tot;
	}

	public function evaEstProy($estProy)
	{
		if($estProy=='abierto')
		{
			$imgEst="images/cc_openProy.png";
		}
		else
		{
			$imgEst="images/cc_closeProy.png";
		}
		return $imgEst;
	}

	// New 07/05/2014

	public function evaMontxTip($tip,$montComp,$montServ,$montVisi)
	{
		if($tip==1 or $tip==2)
		{
			$mont=$montComp;
		}
		else if($tip==3)
		{
			$mont=$montServ;
		}
		else if($tip==4)
		{
			$mont=$montVisi;
		}
		else
		{
			$mont;	
		}
		return $mont;
	}

	/* MODULO DE MOVIMIENTO DE PERSONAL */

	public function mp_evaExisData($data)
	{
		$resulAvis='';
		if(count($data)>0)
		{
			$resulAvis="mp_ocul";
		}
		else
		{
			$resulAvis="";
		}
		return $resulAvis;
	}

	/* MODULO DE COTIZACION DE SERVICIO */

	public function cs_evaIniComb($data,$valId,$nomId)
	{
		for($i=0;$i<count($data);$i++)
		{
			if($data[$i][$nomId]==$valId)
			{
				$data[$i]['prop']="selected";
			}
			else
			{
				$data[$i]['prop']="";
			}
		}
		return $data;
	}

	/* MODULO DE ORDENES DE COMPRAS  */

	public function cs_evaIdOrd($idComp,$idServ,$idVisi)
	{
		if(is_null($idComp) and is_null($idVisi))
		{
			$idSele=$idServ;
		}
		elseif(is_null($idServ) and is_null($idVisi))
		{
			$idSele=$idComp;
		}
		else
		{
			$idSele=$idVisi;
		}
		return $idSele;
	}

	/* FLUJO PROBABLE NEGOCIO [fp_negocio] */

	public function fp_evaFianVal($fianDes,$fianMon,$fianPor,$mone)
	{
		if(is_null($fianDes))
		{
			$val=null;
		}
		else
		{
			$val=$fianDes." ".$mone." ".number_format((($fianPor/100)*$fianMon),2);
		}
		return $val;
	}

	/* SEGUIMIENTO CENTRO [scc_negocio] */

	public function scc_evaEstaSegui($esta)
	{
		if($esta==1)
		{
			$img="images/success.png";
		}
		else
		{
			$img="images/warning.png";
		}
		return $img;
	}

}

?>