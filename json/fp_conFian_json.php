<?php


require('../conf.php');
require('../clases/negocio/negocio.class.php');
require('../clases/sql/sql.class.php');


$filAfect2=0;

for($i=0;$i<count($_POST['arrCotiId']);$i++)
{
	$sql=sql::fp_cleanFian($_POST['arrCotiId'][$i]);
	$filAfect1=negocio::setData($sql);

	for($j=0;$j<count($_POST['arrTipFian']);$j++)
	{
		if($_POST['arrTipFian'][$j]==1)
		{
			$sql=sql::fp_nuevFian($_POST['fianAde'],$_POST['arrTipFian'][$j],$_POST['arrCotiId'][$i]);
			$filAfect2=negocio::setData($sql);
		}
		else
		{
			$sql=sql::fp_nuevFian($_POST['fianFiel'],$_POST['arrTipFian'][$j],$_POST['arrCotiId'][$i]);
			$filAfect2=negocio::setData($sql);
		}
	}
}

$data_msj=Array();
$data_msj[0]=$filAfect2;

echo json_encode($data_msj);


?>