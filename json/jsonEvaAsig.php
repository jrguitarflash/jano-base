<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	
	# actualizar forma de calculo para validacion 

	$sql=sql::vaca_extVacPerxTrab($_GET['trabId'],$_GET['valPer']);
	$dataVac=negocio::getData($sql);

	foreach ($dataVac as $data) 
	{

		$numFinSem=negocio::evaFolCal($_GET['valHab'],$data['vaca_mesGocIni'],$data['vaca_mesGocFin']);

		$sql=sql::vaca_actForCal($_GET['valHab'],$_GET['trabId'],$_GET['valPer'],$data['vaca_vaca_id'],$numFinSem);
		$numFilAfec1=negocio::setData($sql);
	}

	# ---

	$sql=sql::vaca_evaAsigTrab($_GET['trabId'],$_GET['fechEva']);
	$dataEvaAsig=negocio::getData($sql);
	$numFilAfect=count($dataEvaAsig);

	$sql=sql::vaca_evaDiHab($_GET['valPer'],$_GET['trabId']);
	$valDiHab=negocio::getVal($sql,'sumDi');
	
	$valDiHab=negocio::evaSumDiNull($valDiHab);

	# verificar disponibilidad de periodo
	$sql=sql::vaca_getPeriAnxTod();
	$dataPeri=negocio::getData($sql);
	$dataVeri=negocio::evaPeriDispo($_GET['trabId'],$dataPeri,$_GET['valPer']);

	#verificar dias no habiles
	$sql=sql::vaca_testNomMes($_GET['fechIni'],$_GET['fechFin']);
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

	# salidas de array de parametros

	$dataResul=Array();

	$dataResul[0]=$numFilAfect;
	$dataResul[1]=$valDiHab;

	$dataResul[2]=$dataVeri[0];
	$dataResul[3]=$dataVeri[1];

	$dataResul[4]=$difDias;
	$dataResul[5]=$contDiHab;

	echo json_encode($dataResul);

?>

		
