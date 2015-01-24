<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

switch($_REQUEST['json'])
{
	case 'centCost':
		$sql=sql::scc_centCost();
		$data_centCost=negocio::getData($sql);
		echo json_encode($data_centCost);
	break;

	case 'alertSeguiPen':

		$sql=sql::scc_seguiGen();
		$data_seguiGen=negocio::getData($sql);

		$cadCorre="";

		foreach($data_seguiGen as $data)
		{

			desconectar();
			conectar();

			$sql=sql::scc_seguiOrdPlaz($data['item']);
			$data_seguiOrdPlaz=negocio::getData($sql);

			$i=0;
			$flag=0;
			$cont=0;

			foreach($data_seguiOrdPlaz as $data2)
			{
				$flag=$flag+$data2['avenciSem'];

				if($flag>0  and $cont==0)
				{
					$cont++;
					$cadCorre.="<a href=Javascript:scc_creadSegui_dirDet('".$data['item']."') >".$data['sc']."</a>"." ";
				}

				$i++;
			}
		}

		$mensaje=Array();
		$mensaje[0]=$cadCorre;
		echo json_encode($mensaje);

	break;

	case 'alertSeguiVen':

		$sql=sql::scc_seguiGen();
		$data_seguiGen=negocio::getData($sql);

		$cadCorre="";

		foreach($data_seguiGen as $data)
		{

			desconectar();
			conectar();

			$sql=sql::scc_seguiOrdPlaz($data['item']);
			$data_seguiOrdPlaz=negocio::getData($sql);

			$i=0;
			$flag=0;
			$cont=0;

			foreach($data_seguiOrdPlaz as $data2)
			{
				$flag=$flag+$data2['venciSem'];

				if($flag>0 and $cont==0)
				{
					$cont++;
					$cadCorre.="<a href=Javascript:scc_creadSegui_dirDet('".$data['item']."') >".$data['sc']."</a>"." ";
				}

				$i++;
			}
		}

		$mensaje=Array();
		$mensaje[0]=$cadCorre;
		echo json_encode($mensaje);

	break;

	default:
	break;
}

?>