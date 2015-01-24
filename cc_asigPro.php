<!-- STYLE MODULE CENTRO COBRANZA -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS MODULO CENTRO COBRANZA -->
<script type="text/javascript" src="js/cc_gesti.js?modojs=3" id="modojs" ></script>

<!-- CONTROLADORES INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADORES SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box">

	<div class="heading" >
		<h1>Detalle de Proyecto</h1>
		<span class="botone" >
			<!--
			<a href="Javascript:cc_geneOc('ocNac');" id="linkGen">
				<img src="images/geneNac.png" width="25px" title="Generar OC Nacional">
			</a>
			<a href="Javascript:cc_geneOc('ocInt');" id="linkGen">
				<img src="images/geneInt.png" width="25px" title="Generar OC Internacional">
			</a>
			<a href="Javascript:cc_geneOc('ocServ');" id="linkGen">
				<img src="images/geneServ.png" width="25px" title="Generar OS">
			</a>
			-->
			<a href="Javascript:cc_geneOc('asigPro');" id="linkGen">
				<img src="images/save.png" width="25px" title="Guardar centro de costo">
			</a>
			<a href="Javascript:cc_geneOc('closeProy');" id="linkGen">
				<img src="images/cc_closeCent.png" width="25px" title="Cerrar centro de costo">
			</a>
		</span>
	</div>

	<div class="content">
		<form id="frmAsigPro" name="frmAsigPro" method="post" enctype="multipart/form-data" >
			<input type="hidden" name="accion" value="" >
			<input type="hidden" name="idCentCost" id="idCentCost" value="<?php print $_GET['idCen']; ?>" >
			<label id="lbl" >Nro:</label>
			<label class="campo"><?php print $dataCentGrl[0]['pcVal']; ?></label>
			<!--
			<a href="#" class="campo">Generar</a>
			-->
			<label id="lbl">FL Adjudicada:</label>
			<div class="campo">
				<input id="cotiFl" name="cotiFl" onkeyup="cc_jsonGeneComp();" value="<?php print $dataCentGrl[0]['flVal']; ?>" disabled >
				<!--
				<img src="images/impDetCoti.png" width="20px" class="limDina" title="Importar detalle FL" onclick="cc_ajaxDetFl();">
				-->
			</div>

			<!-- LISTA FL MULTIPLE -->
			<label id="lbl" ></label>
			<ul class="campo" type="1">
				<?php print $listFlMuti; ?>
			</ul>

			<label id="lbl" >Cliente:</label>
			<textarea class="campo cliCoti" id="txaCli" disabled ><?php print $dataCentGrl[0]['cliEmp']; ?></textarea>
			<label id="lbl" >Proyecto:</label>
			<textarea class="campo cliCoti" id="txaProye" name="txaProye" disabled><?php print $dataCentGrl[0]['proyNom']; ?></textarea>
			<label id="lbl" >O/C cliente</label>
			<input type="text" class="campo" id="txtOcCli" name="txtOcCli" value="<?php print $dataCentGrl[0]['ocCli']; ?>">
			<label id="lbl">O/C fecha recepcion</label>
			<span class="campo">
				<input type="text" id="ocFechCli" id="ocFechCli" name="ocFechCli" value="<?php print $dataCentGrl[0]['ocCliFech']; ?>">
			</span>
			<label id="lbl">Monto</label>
			<input class="campo" type="text" id="totCoti" name="totCoti" value="<?php print $dataCentGrl[0]['montCoti']; ?>" onkeyup="puntitos();" >
			<label id="lbl">Moneda</label>
			<span class="campo prodCoti">
				<select id="txtMone2" name="txtMone2">
					<?php foreach($dataMone as $data) { ?>
						<option value="<?php print $data['moneda_id']; ?>" <?php print $data['mone_ini']; ?> ><?php print $data['mon_sigla']; ?></option>
					<?php } ?>
				</select>
			</span>
			<label id="lbl">Adjunto</label>
			<ul type="1" class="campo">
				<?php for($i=0;$i<count($arrAdju);$i++) { ?>
				<li>
					<a href="<?php print $arrAdju[$i]; ?>"  target="_blank" >
					<?php print $arrAdju[$i]; ?>
					</a>
				</li>
				<?php }?>
			</ul>
			<label id="lbl"></label>
			<input type="file" name="adjOrdCli[]" id="adjOrdCli" class="campo adjuDina" multiple>
			<label id="lbl" >Estado</label>
			<span class="campo ver">
				<img src="<?php print negocio::evaEstProy($dataCentGrl[0]['estApe']); ?>" width="30px" title="<?php print $dataCentGrl[0]['estApe']; ?>" >
			</span>
			<!--
			 	<label id="lbl" >Proveedor:</label>
				<span class="campo prodCoti">
					<input type="text" class="dinaProv" id="txtProve2" name="txtProve2" onMouseOver="cc_mosComp(this.id)">
					<input type="hidden" id="txtProveId2" name="txtProveId2">
					<img src="images/clean.png" width="20px" class="limDina" onclick="cc_limpCampDina('txtProve2','txtProveId2');" title="Limpiar campo">
				</span>
			-->
			<!--
				<label id="lbl" >Moneda</label>
				<span class="campo prodCoti">
				<select id="txtMone2" name="txtMone2" >
					<?php #foreach($dataMone as $data) { ?>
						<option value="<?php #print $data['moneda_id']; ?>" ><?php #print $data['mon_sigla']; ?></option>
					<?php #} ?>
				</select>
				</span>
			-->

			<!-- *********************************** -->	
			<!-- MODULO FINANCIERO & CENTRO DE COSTO -->
			<!-- *********************************** -->

			<?php print $opeBanca; ?>

			<!-- ********************************** -->

		</form>

		<span id="lbl" >
			<select id="txtTipComp">
				<?php foreach($dataTipComp as $data) { ?>
					<option value="<?php print $data['tipCompId']; ?>" ><?php print $data['tipCompDes']; ?></option>
				<?php } ?>
			</select>
			<a href="Javascript:cc_openNuevoFl('','add2')" >Crear</a>
		</span>

		<!--
		<span class="campo" >
			<a href="<?php #print "reporte/cc_reporVisiCent.php?id=".$_GET['idCen']; ?>" target="_blank" >Reporte Visitas</a>
		</span>
		-->

		<span class="campo" >
			<!--<a href="Javascript:cc_impuVisi();">Amputación de visitas</a>-->
			<div id="dialog3" title="Amputación de visitas a centro de costo" >
				<label id="lbl2" >Responsable EW:</label>
				<input class="campo" type="text"  id="perEw" >
				<a href="Javascript:cc_ajax1();" class="campo" >Buscar</a>
				<a href="Javascript:cc_json1();" class="campo" >Imputar</a>
				<input type="hidden" id="perId" >
				<form name="cc_frmVisi" >
					<div id="cc_ajaxVisi" >
						<table class="list" >
							<thead>
								<tr>
									<td></td>
									<td>N° visita</td>
									<td>Responsable</td>
									<td>Fecha</td>
									<td>Moneda</td>
									<td>Monto</td>
								</tr>
							</thead>
							<tbody>
								<!--
								<tr>
									<td><input type="checkBox" ></td>
									<td>N°</td>
									<td>Personal</td>
									<td>Fecha</td>
									<td>Moneda</td>
									<td>Monto</td>
								</tr>
								-->
							</tbody>
							<!--
							<tfoot>
							</tfoot>
							-->
						</table>
					</div>
				</form>
			</div>
		</span>

		<div id="ajaxDetFl" >
			<table class="list" >
				<thead>
					<tr>
						<td>Item</td>
						<td>Tipo Orden</td>
						<td>Proveedor/Cliente</td>
						<!--<td>Descripcion</td>-->
						<td>Moneda</td>
						<td>Monto</td>
						<td>Incoterm</td>
						<td>Plazo(Dias)</td>
						<td align="center" >OC/EW/OS</td>
						<td align="center" >Accion</td>	
					</tr>
				</thead>
				<tbody>
					<?php foreach($dataDetCentCost as $data){ ?>
					<tr>
						<td><?php print $data['idDet']; ?></td>
						<td><?php print negocio::evaTipMone($data['tipDoc']); ?></td>
						<td><?php print negocio::getProvexId($data['proveId']); ?></td>
						<!--<td><?php #print $data['desOrd']; ?></td>-->
						<td align="center" ><?php print negocio::getMonexId($data['moneId']); ?></td>
						<td align="right"><?php print negocio::evaMontxTip($data['tipDoc'],$data['totOrd'],$data['totOrdServ'],$data['totVisiVen']); ?></td>
						<td align="center"><?php print $data['tipPreci']; ?></td>
						<td align="center" ><?php print $data['plazo']; ?></td>
						<td align="center" >
							<a href="<?php print 'Javascript:'.negocio::evaTipDocOrd($data['sufiOrd'],negocio::cs_evaIdOrd($data['compId'],$data['servId'],$data['visiId'])); ?>" 
								title="<?php print negocio::getProvexId($data['proveId']); ?>" target="_self">
								<?php print $data['correOrd']; ?>
							</a>
						</td>
						<td align="center" >
							<a href="<?php print "Javascript:cc_openEditComp('".$data['idDet']."','edit2');" ?>" >Editar</a> |
							<a href="<?php print "Javascript:cc_evaEstEliProye('".$data['idDet']."','delete2');" ?>">Eliminar</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" align="center">Total(S/.)</td>
						<td align="right" >S/. <?php print number_format($totSol,2); ?></td>
					</tr>
					<tr>
						<td colspan="4" align="center">Total($)</td>
						<td align="right" >$ <?php print number_format($totDol,2); ?></td>
					</tr>
					<tr>
						<td colspan="4" align="center">Total(€)</td>
						<td align="right" >€ <?php print number_format($totHeb,2); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>

	</div>

</div>

<!-- POPUP EDITAR COTIZACION FL -->
<div id="dialog1" title="Detalle de orden">
	<!--
		<label id="lbl2" >Tipo Orden</label>
		<span class="campo prodCoti">
			<select id="txtTipComp">
				<?php foreach($dataTipComp as $data) { ?>
					<option value="<?php print $data['tipCompId']; ?>" ><?php print $data['tipCompDes']; ?></option>
				<?php } ?>
			</select>
		</span>
	-->
	<label id="lbl2" >Moneda</label>
	<span class="campo prodCoti">
		<select id="txtMone">
			<?php foreach($dataMone as $data) { ?>
				<option value="<?php print $data['moneda_id']; ?>" ><?php print $data['mon_sigla']; ?></option>
			<?php } ?>
		</select>
	</span>
	<label id="lbl2" >Proveedor:</label>
	<span class="campo prodCoti">
		<input type="text" class="dinaProv" id="txtProve" onMouseOver="cc_mosComp(this.id)">
		<input type="hidden" id="txtProveId" >
		<img src="images/clean.png" width="20px" class="limDina" onclick="cc_limpCampDina('txtProve','txtProveId');" title="Limpiar campo">
	</span>
	<!--
		<label id="lbl2" >Descripcion:</label>
		<span class="campo prodCoti">
			<textarea id="desProdServ" ></textarea>
		</span>
	-->
	<label id="lbl2" >Plazo:</label>
	<span class="campo prodCoti" >
		<input type="text" id="txtPlazo">
		<label>(Dias)</label>
	</span>
	<label id="lbl2"></label> 
	<input type="button" value="Guardar" class="campo button" id="acciEdit" >
	<input type="button" value="Cancelar" class="campo button" onclick="cc_closeEditFl();" >
</div>

<!--  POPUP DIALOG 2 -->
<div id="dialog2"  title="Reporte de visita" >
	<iframe src="" id="cs_reporCorServ" width="100%" height="500px" ></iframe>
</div>