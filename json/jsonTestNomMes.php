<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

	
	$sql=sql::vaca_testNomMes($_GET['fechIni'],$_GET['fechFin']);
	$dataDifFech=negocio::getData($sql);

	$fechIni=$dataDifFech[0]['fechIni'];
	$fechFin=$dataDifFech[0]['fechFin'];
	$difDias=$dataDifFech[0]['difDias'];

	$contDiHab=0;

	for($i=0;$i<=intVal($difDias);$i++)
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

	$dataResul=Array();
	$dataResul[0]=$difDias;
	$dataResul[1]=$contDiHab;
	echo json_encode($dataResul);

?>

		
