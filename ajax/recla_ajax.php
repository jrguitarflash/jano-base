<?php 

	require("../conf.php");
	require("../clases/sql/sql.class.php");
	require("../clases/negocio/negocio.class.php");

	switch ($_POST['ajax']) 
	{
		case 'obsxTip':

			# code...
			$sql=sql::recla_obsxTip($_POST['tip']);
			$dataObs=negocio::getData($sql);
			$html="";

			foreach ($dataObs as $data) 
			{
				# code...
				$html.="<option value='".$data['id']."' >".$data['des']."</option>";
			}

			print $html;

		break;
		
		default:
			# code...
		break;
	}

?>