<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS JavaScript -->
<script type="text/javascript" src="js/scc_gesti.js" ></script>

<!-- Controller Down -->
<?php require('clases/controlador/controladorInf.class.php'); ?>

<!-- Controller Up -->
<?php require('clases/controlador/controladorSup.class.php'); ?>

<!-- Load -->
<input type="hidden" id="scc_detSegui" >

<div id="scc_alertAjax" >
		<span  class="scc_alertLbl" >
			<img src="images/scc_venci.png" title="Seguimiento con ordenes vencidas" id="scc_alert">
			Seguimientos con ordenes a vencer esta semana:<span id="avenciSem" ></span>
		</span>
		<span  class="scc_alertLbl" >
			<img src="images/scc_avenci.png" title="Seguimiento con ordenes por vencer" id="scc_alert" >
			Seguimientos con ordenes vencidas:<span id="venciSem" ></span>
		</span>
</div>

<div class="box scc_aliBox" >
	<div id="successPrin" ></div>
	<div class="heading" >
		<h1>Detalle de seguimiento</h1>
		<div class="buttons" >
			<a href="index.php?menu_id=138&menu=scc_creadSegui">
				<img src="images/scc_segui.png" width="25px" title="Volver a seguimientos" >
			</a>
			<a href="Javascript:scc_detSegui_json12();">
				<img src="images/grabar.png" width="25px" title="Guardar" >
			</a>
		</div>
	</div>
	<div class="content" >

		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">General</a></li>
				<li><a href="#tabs-2">Adelantos</a></li>
				<li><a href="#tabs-3" onclick="scc_loadDetSegui();" >Seguimiento</a></li>
			</ul>

			<!-- TAB GENERAL -->

				<div id="tabs-1">
					<div id="scc_lad" >
						<label id="lbl2" ><strong>SC:</strong></label>
						<span class="campo" ><?php print $sc; ?></span>
						<input type="hidden" id="idSegui" value="<?php print $_GET['id']; ?>" >
						<label id="lbl2" ><strong>CC:</strong></label>
						<span class="campo" ><?php print $cc; ?></span>
						<label id="lbl2" ><strong>Cliente:</strong></label>
						<span class="campo" ><?php print $cliente; ?></span>
					</div>
					<div id="scc_lad" >
						<label id="lbl2" ><strong>Proyecto:</strong></label>
						<span class="campo" ><?php print $proyecto; ?></span>
						<label id="lbl2" ><strong>Monto CC:</strong></label>
						<span class="campo" ><?php print $moneda.' '.number_format($monto,2); ?></span>
						<label id="lbl2" ><strong>Fecha de apertura:</strong></label>
						<span class="campo" ><?php print $fechIni; ?></span>
						<label id="lbl2" ><strong>Fecha de entrega:</strong></label>
						<span class="campo" ><?php print $fechEntre; ?></span>
						<label id="lbl2" ><strong>plazo (dias):</strong></label>
						<input class="campo scc_termDay" id="scc_termDay" value="<?php print $termDay; ?>">
						<label id="lbl2" ></label>
						<input type="button" value="Ejecutar" class="campo" onclick="<?php print "scc_geneRepSegui('".$_GET['id']."')"; ?>" >
					</div>
				</div>

			<!-- TAB ADELANTO -->
				
				<div id="tabs-2">
					<fieldset class="scc_adelan" >
						<legend>DATOS DE ORDEN</legend>
						<label id="lbl" ><strong>OC/EW/OS:</strong></label>
						<select class="campo"  id="idOrdAdel" onclick="scc_detSegui_json1();" >
							<?php foreach($data_ordSeguiCent as $data) { ?>
							<option value="<?php print $data['ordId']; ?>" ><?php print $data['ordDes'];  ?></option>
							<?php } ?>
						</select>
						<label id="lbl" ><strong>Proveedor:</strong></label>
						<label class="campo" id="adelProv" ></label>
						<label id="lbl" ><strong>Incoterm:</strong></label>
						<label class="campo" id="adelTerm" ></label>

						<!-- PLAZOS DE ORDENES -->

						<label id="lbl" ><strong>Plazo de entrega:</strong></label>
						<label class="campo" id="adelPlaz" ></label>
						<label id="lbl" ><strong>Plazo interno:</strong></label>
						<input type="text" class="campo" id="scc_plazInter" >
						<a href="Javascript:scc_detSegui_json13(1)" class="campo" >actualizar</a>
						<label id="lbl" ><strong>Plazo internacional:</strong></label>
						<input type="text" class="campo" id="scc_plazExt" >
						<a href="Javascript:scc_detSegui_json13(2)" class="campo" >actualizar</a>

						<!--
						<label id="lbl" ><strong>Plazo de entrega proveedor:</strong></label>
						<input type="text" class="campo" id="plazProv" >
						-->

						<label id="lbl" ><strong>Monto:</strong></label>
						<label class="campo" id="adelMont"></label>
						<label id="lbl" ><strong>Equipo / Servicio:</strong></label>
						<label class="campo" id="adelEquiServ" ></label>
						<label id="lbl" ></label>
						
						<!--
						<button class="campo" onclick="scc_detSegui_json11();" >Actualizar</button>
						-->

					</fieldset>
					<fieldset  class="scc_adelan">
						<legend>ADELANTOS</legend>
						<input type="hidden" id="idAdel" >
						<label id="lbl2" ><strong>Tipo:</strong></label>
						<select class="campo" id="tipAdel">
							<?php foreach($data_tipAdelSegui as $data) { ?>
							<option value="<?php print $data['tipAdelId']; ?>" ><?php print $data['tipAdelId']." - ".$data['tipAdelDes']; ?></option>
							<?php } ?>
						</select>
						<label id="lbl2" ><strong>Fecha:</strong></label>
						<span class="campo" ><input type="text" id="fechAdel"  ></span>
						<label id="lbl2" ><strong>Descripcion:</strong></label>
						<textarea class="campo" width="30" id="desAdel" ></textarea>
						<label id="lbl2" ></label>
						<input class="campo" type="button" value="Añadir" onclick="scc_detSegui_json2();">
						<input class="campo" type="button" value="Actualizar" onclick="scc_detSegui_json5();">
						<div id="scc_detAdelAjax" >
							<table class="list" >
								<thead>
									<tr>
										<td>Tipo</td>
										<td>Fecha</td>
										<td>Descripcion</td>
										<td align="center" >Accion</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Tipo</td>
										<td>Fecha</td>
										<td>Descripcion</td>
										<td align="center" >
											<a href="#" >
												<img src="images/scc_detail.png" width="20px" title="Editar" >
											</a>
											<a href="#" >
												<img src="images/delete.png" width="20px" title="Eliminar" >
											</a>
										</td>
									</tr>
								</tbody>
								<tfoot></tfoot>
							</table>
						</div>
					</fieldset>
				</div>

			<!-- TAB SEGUIMIENTO -->
				<div id="tabs-3" >
					<!--
					<label id="lbl2" >OC/EW/OS</label>
					<select class="campo" id="idOrdSegui" onclick="scc_detSegui_ajax2();">
						<?php #foreach($data_ordSeguiCent as $data) { ?>
							<option value="<?php #print $data['ordId']; ?>" ><?php #print $data['ordDes'];  ?></option>
						<?php #} ?>
					</select>
					<a href="Javascript:scc_detSegui_json6();" class="campo" >Generar seguimiento</a>
					<form name="scc_detSeguiFrm" >
						<div id="scc_detSeguiAjax" >
							<table class="list" >
								<thead>
									<tr>
										<td colspan="4" align="right">
											<a href="Javascript:scc_detSegui_json7();" id="scc_opciVali" >Validar</a>&nbsp;|
											<a href="Javascript:scc_detSegui_json8();" id="scc_opciVali" >Revertir</a>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>Seguimiento</td>
										<td>Fecha</td>
										<td align="center" >Validacion</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center" ><input type="checkbox" ></td>
										<td>Envio de planos del proveedor</td>
										<td>Fecha</td>
										<td align="center" ><img src="images/warning.png"></td>
									</tr>
								</tbody>
								<tfoot></tfoot>
							</table>
						</div>
					</form>
					-->
					<div id="scc_menuPesta" >
						<a href="Javascript:scc_detSegui_json9();">Guardar</a>
						<a href="Javascript:scc_loadDetSegui();">Refrescar</a>
					</div>
					<form name="scc_detSeguiFrm">
					<input type="hidden" size="8" name="fechReal2[]" id="fechReal2" value="0" >
					<div id="scc_detSeguiAjax" >
						<table class="list" >
							<thead>
								<tr>
									<td colspan="18" >SEGUIMIENTO DE ORDENES</td>
								</tr>
								<tr>
									<td>N° de orden</td>
									<td>Fecha partida</td>
									<td>Plazo</td>
									<td>Fecha entrega</td>
									<td>Fecha actual</td>
									<td>Dias para vencer</td>
									<td>Dias vencidos</td>
									<td>Envio de planos del proveedor</td>
									<td>Aprobacion de planos del cliente</td>
									<td>Envio de planos aprobados al proveedor</td>
									<td>Inicio de fabricacion</td>
									<td>Pago de adelanto al proveedor</td>
									<td>Recepcion de protocolos de prueba</td>
									<td>Validacion de protocolos</td>
									<td>Entrega de equipo</td>
									<td>Arrivo de equipo a puerto de callao</td>
									<td>Nacionalizacion y entrega en nuestros almacenes</td>
									<td>Control de calidad interno</td>
									<td>Entrega final de los equipos en sus almacenes</td>
									<td>Salida almacen EW cliente</td>
								</tr>	
							</thead>
							<tbody>
								<?php foreach($data_seguiOrdPlaz as $data) { ?>
								<tr>
									<td><?php print $data['ordDes']; ?></td>
									<td><?php print $data['fechParti']; ?></td>
									<td><?php print $data['plazo']; ?></td>
									<td><?php print $data['fechEntre']; ?></td>
									<td><?php print $data['fechaActual']; ?></td>
									<td><?php print $data['diasVencer']; ?></td>
									<td><?php print $data['diasVencidos']; ?></td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s1']); ?>"></td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s2']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s3']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s4']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s5']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s6']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s7']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s8']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s9']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s10']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s11']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s12']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s13']); ?>"</td>
									<td><img src="<?php print negocio::scc_evaEstaSegui($data['s14']); ?>"</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr></tr>
							</tfoot>	
						</table>
					</div>
					</form>
					<iframe src="" id="scc_timeLine" class="scc_timeLine" ></iframe>
				</div>
		</div>

	</div>
</div>