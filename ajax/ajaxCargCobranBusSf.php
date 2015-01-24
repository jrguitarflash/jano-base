<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$opci=$_POST['valTipCob'];
$filCheck=Array();
$filCheck=explode('-',$_POST['valFilCob']);
$fechIni=$_POST['valFechIni'];
$fechFin=$_POST['valFechFin'];
$numDoc=$_POST['valNumDoc'];
$txtRuc=$_POST['valRuc'];
$resulTipCob='';

$sql=sql::getTipCambActSf();
$dataTipCam=negocio::getData($sql);

$cambVenta=$dataTipCam[count($dataTipCam)-1]['TIPOCAMB_VENTA'];

if(isset($opci))
				{
					switch($opci)
					{
						case 'FT':
							if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FT',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FT',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FT',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FT',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FT',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FT',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FT',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
							}
							else
							{
								$sql=sql::getCobFacSf('FT');
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
								$tipCob="FT";
								#print $_POST['filCheck'][0];
								#print $_POST['filCheck'][1];
								#print $_POST['filCheck'][2];
							}
						break;

						case 'FN':
							if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FN',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FN',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FN',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FN',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FN',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FN',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FN',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
							}
							else
							{
							$sql=sql::getCobFacSf('FN');
							$dataVenFac=negocio::getData($sql);
							$resulTipCob="COBRANZAS POR FACTURAR";
							$tipCob="FN";
							}
						break;

						case 'FP':
							if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FP',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FP',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FP',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FP',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FP',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FP',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FP',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP";
							}
							else
							{
							$sql=sql::getCobFacSf('FP');
							$dataVenFac=negocio::getData($sql);
							$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
							$tipCob="FP"; 
							}
						break;

						case 'FA':
						if($filCheck[0]=='fech' and $filCheck[1]=='doc' and $filCheck[2]=='ruc')
							{
								$sql=sql::getCobFacxFechxDocxRucSf('FA',$fechIni,$fechFin,$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='doc' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxDocxRucSf('FA',$numDoc,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='doc')
							{
								$sql=sql::getCobFacxFechxDocSf('FA',$fechIni,$fechFin,$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='fech' and $filCheck[1]=='ruc')
							{
								$sql=sql::getCobFacxFechxRucSf('FA',$fechIni,$fechFin,$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if ($filCheck[0]=='fech') 
							{
								$sql=sql::getCobFacxFechSf('FA',$fechIni,$fechFin);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='doc')
							{
								$sql=sql::getCobFacxDocSf('FA',$numDoc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else if($filCheck[0]=='ruc')
							{
								$sql=sql::getCobFacxRucSf('FA',$txtRuc);
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
							else
							{
								$sql=sql::getCobFacSf('FA');
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
								$tipCob="FA";
							}
						break;

						case'':

								$dataVenFac=Array();
								$tipCob="";
								$resulTipCob="NINGUN FILTRO COBRANZA SELECCIONADO";

						break;

						default:
						break;
					}
				}
		else
			{

					$dataVenFac=Array();
					$tipCob="";
					$resulTipCob="NINGUN FILTRO COBRANZA SELECCIONADO";
			}

?>


<form name="frmCheckCob" id="frmCheckCob" >
				<table class="list">
					  <thead>
					  	  <tr>
					  	  	<td align="right" colspan="16" >
					  	  		<a href="Javascript:setTipCobran('FP')" id="linkAddCobra" >A Pendientes</a> | 
					  	  		<a href="Javascript:setTipCobran('FT')" id="linkAddCobra" >A Cobrados</a> | 
					  	  		<a href="Javascript:setTipCobran('FA')" id="linkAddCobra" >A Anulados</a> |
					  	  		<a href="Javascript:setTipCobran('FN')" id="linkAddCobra" >A Por Facturar</a>
					  	  	</td>
					  	  </tr>
					  	  <tr>
					  	  	<td colspan="16" class="resulTipCob" ><?php print $resulTipCob; ?></td>
					  	  </tr>
						  <tr align="center">
						  		<td></td>
						  		<td align="center" >Id</td>
							  	<td rowspan="1" align="center" valign="middle">Fecha Ingreso</td>
							  	<td rowspan="1" align="center" valign="middle">Fecha Venc.</td>
							  	<td>Dias Venc.</td>
							  	<td>Dias a vencer</td>
							  	<td rowspan="1" align="center" valign="middle">N° Documento</td>
							  	<td rowspan="1" align="center" valign="middle">Cliente</td>
							  	<td rowspan="1" align="center" valign="middle">Importe S/.</td>
							   <td rowspan="1" align="center" valign="middle">Importe US$.</td>
							   <td rowspan="1" align="center" valign="middle">Adelantado</td>
							   <td rowspan="1" align="center" valign="middle">Retencion</td>
							   <td rowspan="1" align="center" valign="middle">Factura S/.</td>
							   <td rowspan="1" align="center" valign="middle">Factura US$.</td>
							   <td rowspan="1" align="center" valign="middle">Observacion</td>
							   <td colspan="2" >Accion</td>
						  </tr>
					  </thead>
					  <tbody>
					  		<?php 
					  		$totImporSol=0;
					  		$totImporDol=0;
					  		$totFacSol=0;
					  		$totFacDol=0;
					  		foreach ($dataVenFac as $data) { 
					  			$linkEdit="Javascript:getCobaEditPopup('".$data['idVen']."')";
					  			$linkEli="Javascript:setEliCobran('".$data['idVen']."')";
					  		?>
					  		<tr>
					  			<td>
					  				<input type="checkbox" name="checkCob[]" id="checkCob" value="<?php print $data['idVen'] ?>">
					  			</td>
					  			<td align="center" ><?php print $data['idVen']; ?></td>
					  			<td rowspan="1" align="center" valign="middle"><?php print $data['fechPag']; ?></td>
					  			<td align="center" ><?php print $data['fechPagVto']; ?></td>
					  			<td align="center" >
					  				<?php print negocio::evaDiaVenc(negocio::calDiasVenc($data['fechPag'],$data['fechPagVto'])); ?>
					  			</td>
					  			<td>
					  				<?php print negocio::evaDiaVenc(negocio::calDiasVenc(strftime("%d/%m/%Y",time()),$data['fechPagVto'])); ?>
					  			</td>
							  	<td rowspan="1" align="center" valign="middle"><?php print $data['numFac']; ?></td>
							  	<td rowspan="1" align="left" valign="middle"><?php print $data['clie']; ?></td>

							  	<?php if ($data['mone']=='MN') { 
							  		$totImporSol=$totImporSol+$data['importSole'];
							  	?>
							  		<td rowspan="1" align="right" valign="middle"><?php print "S/. ".$data['importSole']; ?></td>
							  	<?php } else { ?>
							  		<td rowspan="1" align="center" valign="middle">-----</td>
							  	<?php } ?>

							  	<?php if($data['mone']=='ME') { 
							  		$totImporDol=$totImporDol+$data['importDola'];
							  	?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "$. ".$data['importDola']; ?></td>
							    <?php } else { ?>
							  		<td rowspan="1" align="center" valign="middle">-----</td>
							  	<?php } ?>

							    <td rowspan="1" align="center" valign="middle">-----</td>

							    <?php if($data['mone']=='MN') { ?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "S/. ".$data['igvn']; ?></td>
							    <?php } else { ?>
									<td rowspan="1" align="right" valign="middle"><?php print "$. ".$data['igve']; ?></td>
							    <?php } ?>

							    <?php if($data['mone']=='MN') { 
							    	$facMon=$data['importSole']-$data['igvn'];
							    	$totFacSol=$totFacSol+$facMon;
							    ?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "S/. ".$facMon; ?></td>
							    <?php } else { ?>
							    	<td rowspan="1" align="center" valign="middle">----</td>
							    <?php } ?>

							    <?php if($data['mone']=='ME') { 
							    	$facMon=$data['importDola']-$data['igve'];
							    	$totFacDol=$totFacDol+$facMon;
							    ?>
							    	<td rowspan="1" align="right" valign="middle"><?php print "$. ".$facMon; ?></td>
							    <?php } else { ?>
							    	<td rowspan="1" align="center" valign="middle">----</td>
							    <?php } ?>

							    <td rowspan="1" align="center" valign="middle">-------</td>
							    <td>
							    	<a href="<?php print $linkEdit; ?>" id="linkAddCobra" >Editar</a>
							    </td>
							    <td>
							    	<a href="<?php print $linkEli; ?>" id="linkAddCobra" >Eliminar</a>
							    </td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="7" align='center' class='totFac'>SUB TOTAL FACTURADO</td>
								<td align="right" ><?php print "S/. ".number_format($totImporSol,2); ?></td>
								<td align="right" ><?php print "$. ".number_format($totImporDol,2); ?></td>
								<td align="center">----</td>
								<td align="center">----</td>
								<td align="right" ><?php print "S/. ".number_format($totFacSol,2); ?></td>
								<td align="right" ><?php print "$. ".number_format($totFacDol,2); ?></td>
							</tr>
							<tr>
								<td colspan="13" align="right">
									<?php
										$totalFinal=number_format(($totFacSol/$cambVenta)+$totFacDol,2); 
										print "$. ".$totalFinal; 
									?>
								</td>
							</tr>	
			        </tbody>
	        </table>
	    </form>

		
