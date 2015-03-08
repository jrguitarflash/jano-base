<?php

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

switch ($_REQUEST['ajax']) 
{
	case 'detNot':

		# code...
		session_start();

		if($_POST['ope']=='addDet')
		{
			if(isset($_SESSION['puntNot']))
			{
				$_SESSION['puntNot']++;
				$ind=$_SESSION['puntNot'];
				$_SESSION['detNot'][$ind]['ind']=$ind;
				$_SESSION['detNot'][$ind]['idLine']=$_POST['idLine'];
				$_SESSION['detNot'][$ind]['cant']=$_POST['cant'];
				$_SESSION['puntNot']++;
				$detNot=$_SESSION['detNot'];	
			}
			else
			{
				$_SESSION['puntNot']=0;
				$ind=$_SESSION['puntNot'];
				$_SESSION['detNot'][$ind]['ind']=$ind;
				$_SESSION['detNot'][$ind]['idLine']=$_POST['idLine'];
				$_SESSION['detNot'][$ind]['cant']=$_POST['cant'];
				$detNot=$_SESSION['detNot'];
			}
		}
		else if($_POST['ope']=='delDet')
		{
				$ind=$_POST['ind'];
				unset($_SESSION['detNot'][$ind]);
				unset($_SESSION['puntNot'][$ind]);
				$detNot=$_SESSION['detNot'];
		}
		else
		{
			$excep="Ninguna operacion requerida";
		}

		$html="";
		$ind=1;

		foreach($detNot as $data)
		{
			$acciEli="<a href=Javascript:np_agreItemLine(".$data['ind'].",'delDet') >Eliminar</a>";

			$sql=sql::np_prodxLine_obte($data['idLine']);
			$dataProd=negocio::getData($sql);

			desconectar();
			conectar();


			$html.="<tr>
						<td>".$ind++."</td>
						<td>".$dataProd[0]['cod']."</td>
						<td>".$dataProd[0]['mar']."</td>
						<td>".$dataProd[0]['nomEspa']."</td>
						<td>".$dataProd[0]['des']."</td>
						<td>".$data['cant']."</td>
						<td align='center' >
							".$acciEli."
						</td>
					</tr>";
		}

		print $html;

	break;

	case 'notPed_lis':

		$sql=sql::np_notPed_lis($_POST['valEsta'],$_POST['valTip']);
		$dataNot=negocio::getData($sql);
		$html="";
		$item=1;

		foreach ($dataNot as $data) 
		{
			#accion
			$det="<a href=Javascript:np_detDir('".$data['id']."') >Detalle</a>";
			$eli="<a href=Javascript:np_notPed_eli('".$data['id']."') >Eliminar</a>";
			$rep="<a href=Javascript:np_genRepNot('".$data['id']."') >".$data['cod']."</a>";

			# code...
			$html.="<tr>
					<td align='center' >".$item++."</td>
					<td align='center'>".$rep."</td>
					<td>".$data['tipDes']."</td>
					<td>".$data['cli']."</td>
					<td>".$data['des']."</td>
					<td>".$data['ref']."</td>
					<td>".$data['obs']."</td>
					<td>".$data['fech']."</td>
					<td>
						Fecha:".$data['fechConfir']."<br>
						Hora:".$data['hourConfir']."
					</td>
					<td>
						Usuario:".$data['desUsu']."<br>
						Fecha:".$data['fechAten']."
					</td>
					<td align='center'><img src='".$data['esta']."' ></td>
					<td align='center'>
						".$det."
						|
						".$eli."
					</td>
				</tr>";
		}

		print $html;

	break;

	case 'detNot_cap':

		$sql=sql::np_detNot_cap($_POST['valNotId']);
		$dataDet=negocio::getData($sql);
		$html="";
		$item=1;

		foreach($dataDet as $data)
		{
			#accion
			$eli="<a href=Javascript:np_detNot_eli('".$data['idDetNot']."') >Eliminar</a>";


			$html.="<tr>
						<td>".$item++."</td>
						<td>".$data['cod']."</td>
						<td>".$data['mar']."</td>
						<td>".$data['nomEspa']."</td>
						<td>".$data['des']."</td>
						<td>".$data['cantDet']."</td>
						<td align='center' >
							".$eli."
						</td>
					</tr>";
		}

		print $html;


	break;

	case 'trabOpe_cap':

		$sql=sql::np_trabOpe_cap();
		$dataDesti=negocio::getData($sql);
		$html='';

		foreach($dataDesti as $data)
		{
			$html.="<input type='checkbox' value='".$data['email']."' name='np_emailDesti[]' id='np_emailDesti' >
					".$data['pers']."(".$data['email'].")&nbsp;
					<a href=Javascript:np_mailPer_pop('".$data['perId']."') >editar</a><br>";
		}

		print $html;

	break;
	
	default:

		# code...
	
	break;
}

?>