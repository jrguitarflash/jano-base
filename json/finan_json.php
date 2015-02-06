<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

switch ($_REQUEST['json']) 
{
	case 'finan_obteCentCost':

		$sql=sql::finan_obteCentCost();
		$data=negocio::getData($sql);

		print json_encode($data);

	break;

	default:
	break;
}

?>