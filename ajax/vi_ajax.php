<?php

/*--------------------------------------*/
	# PETICION AJAX
/*--------------------------------------*/

require("../conf.php");
require("../clases/negocio/negocio.class.php");
require("../clases/sql/sql.class.php");
require("../utils_func.php");

//iniciar sesion
session_start();

switch ($_REQUEST['ajax']) 
{

	case 'vi_visixVend_obte':

		$idVende=$_SESSION['SIS'][10];
		$sql=sql::vi_visixVend_obte($idVende,$_POST['fechVisi']);
		$dataVisi=negocio::getData($sql);
		$html="";

		foreach($dataVisi as $data)
		{
			$html.="<tr>
					<td align='center' >".$data['vi_corre']."</td>
					<td>".$data['vi_resp']."</td>
					<td>".$data['vi_fechIni']."</td>
					<td>".$data['vi_fechFin']."</td>
					<td align='center' >
						<a href='Javascript:vi_editVisi_lnk(".$data['vi_visiId'].")'>Editar</a>&nbsp;|
						<a href='Javascript:vi_visiResp_borra(".$data['vi_visiId'].")'>Eliminar</a>
					</td>
				</tr>";
		}

		print $html;

	break;

	case 'vi_visixId_ini':

		$sql=sql::vi_visixId_ini($_POST['idVisi']);
		$dataDet=negocio::getData($sql);
		$html="";
		$ind=1;


		foreach($dataDet as $data)
		{
			//reconectar
			desconectar();
			conectar();

			//array contacto
			$arrContac=explode(" ",$data['contacto']);
			$cadContac="";

			//iterar contactos
			for($i=0;$i<count($arrContac);$i++)
			{
				$sql=sql::vi_contactxId_obte($arrContac[$i]);
				$valContac=negocio::getVal($sql,'response');

				if($i==0)
				{
					$cadContac=$cadContac.$valContac;
				}
				else
				{
					$cadContac=$cadContac."<br>".$valContac;
				}
			}

			$html.="<tr>
					<td align='center'>".$ind++."</td>
					<td>".$data['empresa']."</td>
					<td>".$cadContac."</td>	
					<td>".$data['obsActi']."</td>
					<td>".$data['obsPen']."</td>
					<td>".$data['vi_fechVi']."</td>
					<td>".$data['vi_dirOri']."</td>
					<td>".$data['vi_dirEmp']."</td>
					<td align='center'>
						<a href='Javascript:vi_detVisi_borra(".$data['idDet'].")' >Eliminar</a>
					</td>			
				</tr>";
		}

		print $html;

	break;

	default:
	break;


}

?>