<?php

/*-------------------------*/
	#Peticion iframe
/*-------------------------*/

require("conf.php");
require("clases/negocio/negocio.class.php");
require("clases/sql/sql.class.php");
require("utils_func.php");

switch ($_REQUEST['nc_iframe_peti']) 
{
	case 'nc_infoNoConfor_adju':

		$ruta=negocio::subirImagen($_FILES['nc_adjuFile']['name'],
							$_FILES['nc_adjuFile']['tmp_name'],
							$_FILES['nc_adjuFile']['size'],
							$_FILES['nc_adjuFile']['type']);

		$descrip=$_POST['nc_adjuDes'];
		$conforId=$_POST['nc_conforId_adju'];

		$sql=sql::nc_infoNoConfor_adju($conforId,$descrip,$ruta);
		$adjuAfect=negocio::getVal($sql,'response');

		print "<input type='text' id='nc_resp_iframe' value='".$adjuAfect."' >";

	break;

	default:

		print "<input type='text' id='nc_resp_iframe' value='0' >";

	break;
}

?>