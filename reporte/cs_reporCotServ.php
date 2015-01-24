<?php

header("Content-Type: text/html;charset=utf-8");

require('../clases/fpdf/fpdf.php');
require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


	include('../clases/mpdf/mpdf.php');
	$mpdf=new mPDF();

	$sql=sql::cs_CotServxId($_GET['id']);
	$dataCotServ=negocio::getData($sql);

	foreach($dataCotServ as $data)
	{
		$fs=$data['fs'];
		$empresa=$data['empre'];
		$fecha=$data['fech'];
		$responsable=$data['respo'];
		$tecnico=$data['respoTecni'];
		$descripcion=$data['des'];
		$prioridad=$data['priori'];
		$estado=$data['esta'];
		$moneda=$data['moneDes'];
		$sigla=$data['moneSig'];
		$total=$data['tot'];
		$totServ=$data['totServ'];
		$totMat=$data['totMat'];
	}

	$sql=sql::cs_detCotServxTip($_GET['id'],1);
	$dataDetCotServ=negocio::getData($sql);

	$sql=sql::cs_detCotServxTip($_GET['id'],2);
	$dataDetCotMat=negocio::getData($sql);

	$sql=sql::cs_condServCoti($_GET['id']);
	$dataCond=negocio::getData($sql);

	foreach($dataCond as $data)
	{
		$reqCond=$data['reqCond'];
		$tiemEje=$data['tiemEje'];
		$garanCond=$data['garanCond'];
		$condPag=$data['condPag'];
		$tiemVali=$data['tiemVali'];
	}

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
		$header="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable' >
					<thead>
						<tr>
							<td rowspan='2' ><img src='../images/logo_empresa1.png' width='12%' ></td>
							<td colspan='3' align='center'><strong>COTIZACION DE SERVICIOS</strong></td>
						</tr>
						<tr>
							<td align='center' >Codigo: SGC-FOR-030</td>
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
				</table>";


	$stylesheet = file_get_contents('../styles/decorador.css');
	$html="<br><br>";
	$html.="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable'>
				<thead>
					<tr>
						<td align='center'  colspan='4' ><strong>".$fs."</strong></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>CLIENTE:</td>
						<td>".$empresa."</td>
						<td>FECHA:</td>
						<td>".$fecha."</td>
					</tr>
					<tr>
						<td>CONTACTO:</td>
						<td>".$tecnico."</td>
						<td>DESCRIPCION:</td>
						<td>".$descripcion."</td>
					</tr>
					<tr>
						<td>RESPONSABLE COMERCIAL:</td>
						<td>".$responsable."</td>
						<td>PRIORIDAD:</td>
						<td>".$prioridad."</td>
					</tr>
					<tr>
						<td>MONEDA:</td>
						<td>".$moneda."</td>
						<td>ESTADO:</td>
						<td>".$estado."</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan='4' ></td>
					</tr>
				</tfoot>
			</table>";
	$html.="<br>";
	$html.="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable'>
				<thead>
					<tr>
						<td align='left' colspan='5'><strong>DETALLE DE LA COTIZACION</strong></td>
					</tr>
					<tr>
						<td>DESCRIPCION</td>
						<td>UNIDAD</td>
						<td>P. UNIDAD</td>
						<td>CANTIDAD</td>
						<td>P. TOTAL</td>
					</tr>
				</thead>
				<tbody>";
				foreach($dataDetCotServ as $data)
				{
	$html.=			"<tr>
						<td>".$data['desDetCoti']."</td>
						<td>".$data['unidDetCoti']."</td>
						<td align='right' >".$data['preUniDet']."</td>
						<td align='center' >".$data['cantDetCoti']."</td>
						<td align='right' >".$data['totDetCoti']."</td>
					</tr>";
				}
	$html.=		"</tbody>
				<tfoot>
					<tr>
						<td colspan='5' align='right'>".$sigla.' '.$totServ."</td>
					</tr>
				</tfoot>
			</table>";
	$html.="<br>";
	$html.="<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable'>
				<thead>
					<tr>
						<td align='left' colspan='5'><strong>DETALLE DE MATERIALES</strong></td>
					</tr>
					<tr>
						<td>DESCRIPCION</td>
						<td>UNIDAD</td>
						<td>P. UNIDAD</td>
						<td>CANTIDAD</td>
						<td>P. TOTAL</td>
					</tr>
				</thead>
				<tbody>";
				foreach($dataDetCotMat as $data)
				{
	$html.=			"<tr>
						<td>".$data['desDetCoti']."</td>
						<td>".$data['unidDetCoti']."</td>
						<td align='right' >".$data['preUniDet']."</td>
						<td align='center' >".$data['cantDetCoti']."</td>
						<td align='right' >".$data['totDetCoti']."</td>
					</tr>";
				}
	$html.=		"</tbody>
				<tfoot>
					<tr>
						<td colspan='5' align='right'>".$sigla.' '.$totMat."</td>
					</tr>
				</tfoot>
			</table>";
	$html.="<br>";
	$html.="<div class='cs_repCondi' align='right' >TOTAL: ".$sigla." ".$total."</div>";
	$html.="<br>";
	$html.="<div class='cs_repCondi' >
				<table border='1' width='100%' cellpadding='0' cellpadding='0' class='cs_repTable'>
					<thead>
						<tr>
							<td align='left' colspan='2'><strong>CONDICIONES</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>REQUERIMIENTOS:</td>
							<td>".$reqCond."</td>
						</tr>
						<tr>
							<td>TIEMPO DE EJECUCION:</td>
							<td>".$tiemEje."</td>
						</tr>
						<tr>
							<td>GARANTIA:</td>
							<td>".$garanCond."</td>
						</tr>
						<tr>
							<td>CONDICIONES DE PAGO:</td>
							<td>".$condPag."</td>
						</tr>
						<tr>
							<td width='30%' >TIEMPO DE VALIDEZ:</td>
							<td>".$tiemVali."</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan='2' ></td>
						</tr>
					</tfoot>
				</table>
			</div>";
	$html.="<div class='cs_repAutoOcul'>&nbsp;</div>";
	$html.="<div class='cs_repAuto' >
				<table border='0' width='100%' cellpadding='0' cellpadding='0'>
					<thead>
						<tr>
							<td align='center' colspan='1' ><strong>AUTORIZADO POR:</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td height='120px' ></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan='1' ></td>
						</tr>
					</tfoot>
				</table>
			</div>";

	$mpdf->WriteHTML($stylesheet,1);
	$mpdf->SetHTMLHeader($header);
	$mpdf->WriteHTML($html,2);
	$mpdf->SetHTMLFooter($footer);
	$mpdf->Output("../adjuntos/cotiServ/".$fs.".pdf",'I');
	$mpdf->Output("../adjuntos/cotiServ/".$fs.".pdf",'F');


?>