<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


//echo $_POST['val'];

	$sql=sql::getTipCambActSf();
	$dataTipCam=negocio::getData($sql);

	$cambCompra=$dataTipCam[count($dataTipCam)-1]['TIPOCAMB_COMPRA'];
	$cambVenta=$dataTipCam[count($dataTipCam)-1]['TIPOCAMB_VENTA'];
	$cambFecha=$dataTipCam[count($dataTipCam)-1]['fechCamb'];

?>

	<label>Compra:&nbsp;<?php print $cambCompra; ?></label>&nbsp;| 
	<label>Venta:&nbsp;<?php print $cambVenta; ?></label>&nbsp;| <input type="hidden" id="cambVenta" value="<?php print $cambVenta; ?>">
	<label>Fecha:&nbsp;<?php print $cambFecha; ?></label>
	<a href="Javascript:getCambNewPopup();" id="linkAddCobra">&nbsp;Actualizar Cambio&nbsp;</a>&nbsp;|
	<a href="Javascript:getCobaNewPopup();" id="linkAddCobra">&nbsp;Agregar Cobranza&nbsp;</a>
		
