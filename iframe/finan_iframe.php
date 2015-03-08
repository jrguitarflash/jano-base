<html>

<head>

	<script type="text/javascript">


		function finan_notiAdju()
		{
			flag=document.getElementById('finan_resp_iframe').value;
			rut=document.getElementById('finan_rutAdju').value;
			window.top.window.finan_notiAdju(flag,rut);
		}

	</script>

</head>

<body onload="finan_notiAdju()" >

<?php

/*-------------------------*/
	#Peticion iframe
/*-------------------------*/

require("../conf.php");
require("../clases/negocio/negocio.class.php");
require("../clases/sql/sql.class.php");
require("../utils_func.php");

switch ($_REQUEST['finan_iframe_peti']) 
{
	case 'finan_opeProy_adju':

		$ruta=nc_subirImagen($_FILES['finan_adjuFile']['name'],
							$_FILES['finan_adjuFile']['tmp_name'],
							$_FILES['finan_adjuFile']['size'],
							$_FILES['finan_adjuFile']['type'],
							'finan_adju');

		$opeId=$_POST['finan_opeId_adju'];
		$numDoc=$_POST['finan_numDoc'];
		$descrip=$_POST['finan_des'];


		$sql=sql::finan_docOpe_adju($opeId,$numDoc,$descrip,$ruta);
		$adjuAfect=negocio::getVal($sql,'response');

		print "<input type='text' id='finan_resp_iframe' value='".$adjuAfect."' >
			   <input type='text' id='finan_rutAdju' value='".$ruta."' >";

	break;

	default:

		print "<input type='text' id='nc_resp_iframe' value='0' >";

	break;
}

?>

</body>

</html>