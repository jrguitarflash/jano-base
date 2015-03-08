<?php

	header("Content-Type: text/html;charset=utf-8");

	require('../clases/fpdf/fpdf.php');
	require('../conf.php');
	require_once('../clases/sql/sql.class.php');
	require_once('../clases/negocio/negocio.class.php');

	include('../clases/mpdf/mpdf.php');
	$mpdf=new mPDF();

	session_start();

	// EVALUAR TIPO DE REPORTE

	$tip=$_GET['tip'];

	if($tip=='1')
	{
		$titulo="REPORTE INVENTARIO";
	}
	else if($tip=='2')
	{
		$titulo="REPORTE MOVIMIENTO";
	}
	else
	{
		$excep="ERROR";
	}

	$stylesheet = file_get_contents('../styles/decorador.css');


	// Set a simple Footer including the page number

		#$mpdf->setFooter('ELECTROWERKE S.A.|RUC 20386239828|{PAGENO}');
		$footer="<div class='cs_repFoot' >";
		$footer.="<div class='cs_repFootInfo' width='45%' >ELECTROWERKE S.A.</div>";
		$footer.="<div class='cs_repFootInfo' >RUC 20386239828</div>";
		$footer.="<div class='cs_repFootInfo' >Telf. 271-2700</div>";
		$footer.="<div class='cs_repFootInfo' width='45%'>Calle Maria Reiche 159, 4to. Piso Urb. Higuereta - Surco Lima, Peru</div>";
		$footer.="<div class='cs_repFootInfo' >Pag. {PAGENO}</div>";
		$footer.="<div class='cs_repFootInfo' >Fax. 355-2184</div>";
		$footer.="</div>";

	// Set a Header in Format Html
		
		/*$header="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable' >
					<thead>
						<tr>
							<td rowspan='2' ><img src='../images/logo_empresa1.png' width='12%' ></td>
							<td colspan='3' align='center'><strong>".$titulo."</strong></td>
						</tr>
						<tr>
							<td align='center' >Codigo: SGC-FOR</td>
							<td>Version N°: 1</td>
							<td>Pag. {PAGENO}</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan='4' ></td>
						</tr>
					</tbody>
					<tfoot> 
						<tr>
							<td colspan='4' ></td>
						</tr>
					</tfoot>
				</table>";*/
		

		$html="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable' >
					<thead>
						<tr>
							<td rowspan='2' ><img src='../images/logo_empresa1.png' width='12%' ></td>
							<td colspan='3' align='center'><strong>".$titulo."</strong></td>
						</tr>
						<tr>
							<td align='center' >Codigo: SGC-FOR</td>
							<td>Version N°: 1</td>
							<td>Pag. 1</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan='4' ></td>
						</tr>
					</tbody>
					<tfoot> 
						<tr>
							<td colspan='4' ></td>
						</tr>
					</tfoot>
				</table>";

	 // Set HTML Report

		$html.="<br>";

		// EVALUAR CONTENIDO DE REPORTE INVENTARIO

		if($tip=='1')
		{

			// EVALUAR FILTRO DE REPORTE
			switch($_GET['valFil'])
			{
				case '1':
					# code...
					$sql=sql::kd_lineProd_sub($_GET['valId']);
					$data1=negocio::getData($sql);
				break;

				case '2':
					# code...
					$sql=sql::kd_lineProd_cate($_GET['valId']);
					$data1=negocio::getData($sql);
				break;

				case '3':
					# code...
					$sql=sql::kd_lineProd_tip($_GET['valId']);
					$data1=negocio::getData($sql);
				break;

				case '4':
					//$valIdArr=explode("|",$_GET['valId']);
					//$sql=sql::kd_lineProd_marMod($valIdArr[0],$valIdArr[1]);
					$sql=sql::kd_lineProd_mar($_GET['valId']);
					$data1=negocio::getData($sql);
				break;

				case '5':
					//$sql=sql::kd_lineProdOrd_obte();
					$sql=sql::kd_lineProd_mod($_GET['valId']);
					$data1=negocio::getData($sql);
				break;

				case '6':
					$sql=sql::kd_lineProdOrd_obte();
					$data1=negocio::getData($sql);
				break;


				default:
				break;
			}

			// INICIAR ARRAY DE FILTROS

			$tipFilArr=array("","Clasificacion","Categoria","Tipo","Marca","Modelo","Todos");
			
			// OBTENER HORA ACTUAL

			$date = new DateTime();
			$date->modify('-6 hour');

			// MOSTRAR DATOS GENERALES

			$html.="<strong>Usuario:</strong> ".$_SESSION['SIS'][1]."<br>
				    <strong>Fecha:</strong> ".date('d/m/Y')."<br>
				    <strong>Hora:</strong> ".$date->format('h:i:s A')."<br>
				    <strong>Filtro:</strong> ".$tipFilArr[$_GET['valFil']];

			// INICIAR CONTENIDO DE INVENTARIO

			$html.="<br><HR>";

			$html.="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='kd_repTabInv'>
					<thead>
						<tr>
							<td><strong>CODIGO</strong></td>
							<td><strong>PRODUCTO</strong></td>
							<td><strong>N° SERIE</strong></td>
							<td><strong>STOCK</strong></td>
						</tr>
					</thead>
					<tbody>";
					foreach($data1 as $data)
					{
						$html.="<tr>
									<td>".$data['cod']."</td>
									<td>".
									"<strong>Clasifacion:</strong>".$data['sub']."<br>".
									"<strong>Categoria:</strong>".$data['cat']."<br>".
									"<strong>Tipo:</strong>".$data['tip']."<br>".
									"<strong>Descripcion:</strong>".$data['des']." ".$data['mar']." ".$data['model']."<br>&nbsp;
									</td>
									<td>".$data['numSeriStock']."</td>
									<td>".$data['stockActu']."</td>
								</tr>";
					}

			$html.="<tbody>
					<tfoot>
					<tfoot>
				  </table>";

		}

		// EVALUAR CONTENIDO DE REPORTE MOVIMIENTO

		else if($tip=='2')
		{
			// INICIAR ARRAY DE FILTROS

			$tipFilArr=array("","Entrada","Salida","Todos");
			
			// OBTENER HORA ACTUAL

			$date = new DateTime();
			$date->modify('-6 hour');

			// MOSTRAR DATOS GENERALES

			$html.="<strong>Usuario:</strong> ".$_SESSION['SIS'][1]."<br>
				    <strong>Fecha:</strong> ".date('d/m/Y')."<br>
				    <strong>Hora:</strong> ".$date->format('h:i:s A')."<br>
				    <strong>Movimiento:</strong> ".$tipFilArr[$_GET['tipMov']]." <br><br>";


			switch($_GET['tipMov'])
			{
				case '1':

					# code...
					if($_GET['filEmp']==1)
					{
						$sql=sql::kd_todEnt_obte($_GET['fechIni'],$_GET['fechFin'],1,'fil');
						$data1=negocio::getData($sql);
					}
					else if($_GET['filEmp']==0)
					{
						$sql=sql::kd_genEnt_obte($_GET['valEmp'],$_GET['fechIni'],$_GET['fechFin'],1,'fil');
						$data1=negocio::getData($sql);
					}
					else
					{
						$excep="error";
					}

				break;

				case '2':

					# code...
					if($_GET['filEmp']==1)
					{
						$sql=sql::kd_todEnt_obte($_GET['fechIni'],$_GET['fechFin'],2,'fil');
						$data1=negocio::getData($sql);
					}
					else if($_GET['filEmp']==0)
					{
						$sql=sql::kd_genEnt_obte($_GET['valEmp'],$_GET['fechIni'],$_GET['fechFin'],2,'fil');
						$data1=negocio::getData($sql);
					}
					else
					{
						$excep="error";
					}

				break;

				case '3':

					# code...
					if($_GET['filEmp']==1)
					{
						$sql=sql::kd_todEnt_obte($_GET['fechIni'],$_GET['fechFin'],2,'tod');
						$data1=negocio::getData($sql);
					}
					else if($_GET['filEmp']==0)
					{
						$sql=sql::kd_genEnt_obte($_GET['valEmp'],$_GET['fechIni'],$_GET['fechFin'],2,'tod');
						$data1=negocio::getData($sql);
					}
					else
					{
						$excep="error";
					}

				break;

				default:
				break;
			}

			// MOSTRAR CONTENIDO DE REPORTE


			foreach($data1 as $data)
			{

				desconectar();
				conectar();

				$sql=sql::kd_iniMoneMov($data['id']);
				$moneId=negocio::getVal($sql,'response');

				desconectar();
				conectar();

				$html.="<div class='kd_genMov' ><strong>".$data['cod']."</strong> ".$data['empDes']." (".$data['tipMovDes'].")</div><HR><br>";

				$sql=sql::kd_detKardxid($data['id']);
				$data2=negocio::getData($sql);

				$html.="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='kd_repTabInv'>
							<thead>
								<tr>
									<td>CODIGO</td>
									<td>PRODUCTO</td>
									<td>CANTIDAD</td>
									<td>N° SERIE</td>
									<td>MONEDA</td>
									<td>PRECIO UNIT.</td>
									<td>TOTAL</td>
								</tr>
							</thead>
						<tbody>";

				foreach($data2 as $data)
				{
					$html.="<tr>
								<td>".$data['cod']."</td>
								<td>".$data['nomEspa']." ".$data['mar']." ".$data['model']."</td>
								<td>".$data['kdxCant']."</td>
								<td>".$data['numSeriMov']."</td>
								<td>".$moneId."</td>
								<td>".number_format($data['kdxPreUni'],2)."</td>
								<td>".number_format($data['kdxPreUni']*$data['kdxCant'],2)."</td>
							</tr>";
				}

				$html.="</tbody>
						</table>";

				$html.="<br>";
			}
		}
		else
		{
			$excep="ERROR";
		}




	$mpdf->WriteHTML($stylesheet,1);
	$mpdf->SetHTMLHeader($header);
	$mpdf->WriteHTML($html,2);
	$mpdf->SetHTMLFooter($footer);
	$mpdf->Output();
?>