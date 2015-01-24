<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$afectCont=0;

for($i=0;$i<count($_POST['checkArrCob']);$i++)
{
	$sql=sql::updateTipCobran($_POST['checkArrCob'][$i],$_POST['idTip']);
	$afectNum=negocio::setData($sql);
	$afectCont=$afectCont+$afectNum;
}

if($afectCont>0)
{
	$result=1;
}
else
{
	$result=0;
}

echo "<input type='hidden' id='resulCheck' value='".$afectCont."' >"

?>

		
