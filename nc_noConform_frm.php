<!-- CSS -->
	
	<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS UTILS -->

	<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- JS Notifi -->

	<script type="text/javascript" src="libJquery/notifiJs/notifi-min.js" ></script>

<!-- JS -->

	<script  type="text/javascript" src="js/nc_gesti.js" ></script>

<!-- PHP UTILS -->

<!-- PHP CONTROLADOR DOWN -->
	
	<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- PHP CONTROLADOR UP -->

	<?php require("clases/controlador/controladorSup.class.php"); ?>

<!-- HTML VIEW -->

	<input type="hidden" id="nc_view" value="<?php print $_GET['menu']; ?>" >

<!-- HTML ID -->

	<input type="hidden" id="nc_id" value="<?php print $_GET['id']; ?>" >

<!-- HTML NOTIFI -->

	<span class="elem-gd" ></span>

<!-- HTML THEME  -->

	<div class="box" >

		<div class="heading" >
			<h1>Observación - Formulario</h1>

			<div class="buttons" >
				<a href="#" id="nc_saveConfor_acci" >Guardar</a> |
				<a href="#" id="nc_volList_lnk" >Volver</a>
			</div>

		</div>

		<div class="content" >

			<div id="tabs" >
				
				<ul>
					<li><a href="#tabs-1">Proyecto</a></li>
					<li><a href="#tabs-2">Observacion</a></li>
					<li><a href="#tabs-3">Medidas</a></li>
					<li><a href="#tabs-4" >Tratamientos</a></li>
					<li><a href="#tabs-5">Adjuntos</a></li>
					<li><a href="#tabs-6">Resultados</a></li>
				</ul>

				<div id="tabs-1" >

					<span class="nc_level" >Proyecto</span>

					<label class="nc_lbl" >N°</label>
					<!-- OUTPUT CORRELATIVO  -->
						<span class="nc_input" id="nc_nroConfor" >----</span>
					<!-- [*] -->

					<label class="nc_lbl" >CC</label>

					<!-- INPUT CENTRO DE COSTO -->
						<input type="text" class="nc_input" id="nc_ccDes" size="70" >
						<input type="hidden" id="nc_ccId" >
					<!-- [*] -->

					<label class="nc_lbl" >Proyecto</label>

					<!-- OUTPUT PROYECTO-->
						<textarea class="nc_input" id="nc_proye" disabled></textarea>
					<!-- [*] -->	


					<!--
						<label class="nc_lbl" >Proveedor</label>
					-->
					<!-- OUTPUT PROVEEDOR -->
						<!--<textarea class="nc_input" id="nc_prove" disabled ></textarea>-->
					<!-- [*] -->

					<label class="nc_lbl" >Cliente</label>

					<!-- OUTPUT CLIENTE -->
						<textarea class="nc_input"  id="nc_cli" disabled></textarea>
					<!-- [*] -->

					<label class="nc_lbl" >Ing. proyecto</label>

					<!-- OUTPUT ING. PROYECTO -->
						<input type="text" class="nc_input" id="nc_ingAsig" disabled size="35" >
					<!-- [*]-->

					<span class="nc_level" >Detalle equipos</span>

					<a href="#" class="nc_lbl" id="nc_nuevEquip_pop" >Buscar</a>

					<!-- TABLE DETALLE EQUIPOS -->
						<table class="list" >
							<thead>
								<tr>
									<td>Item</td>
									<td>Equipo</td>
									<td>Proveedor</td>
									<td align="center" >Accion</td>
								</tr>
							</thead>
							<tbody id="nc_detEquip_tab"  >
								<tr>
									<td>---</td>
									<td>---</td>
									<td>---</td>
									<td align="center" >
										<a href="#">eliminar</a>
									</td>
								</tr>
							</tbody>
						</table>
					<!-- [*] -->

				</div>

				<div id="tabs-2" >


						<!-- Tipo de no conformidad  -->
						
						<label class="nc_lbl" 1>Tipo</label>

						<select class="nc_input" id="nc_tipxForm" >
							<option value="1" >no conformidad</option>
							<option value="2" >producto no conforme</option>
						</select>

						<!-- [*] -->

					<div id="nc_tipConfor_d" >

						<!-- Form Tipo no Conformidad -->

						<span class="nc_level" >Observacion</span>

						<label class="nc_lbl" >Observacion</label>

						<!-- INPUT OBSERVACION -->
							<select class="nc_input" id="nc_obsPrin" >
								<?php foreach($dataObs as $data) { ?>
								<option value="<?php print $data['nc_obsId']; ?>" ><?php print $data['nc_obsDes']; ?></option>
								<?php } ?>
							</select>
						<!-- [*] -->

						<!--New update 14/01/2015  - CLOSE -->

						<label class="nc_lbl" >Origen</label>

						<!-- INPUT ORIGEN -->
							<select class='nc_input' id="nc_oriObs" >
								<?php foreach($dataOri as $data){ ?>
									<option value="<?php print $data['oriId']; ?>" ><?php print $data['oriDes']; ?></option>
								<?php } ?>
							</select>
						<!-- [*] -->

						<label class="nc_lbl" id="nc_tipObs_lbl" >Tipo no conformidad</label>

						<!-- INPUT TIPO CONFORMIDAD -->
							<select class="nc_input" id="nc_tipConfor" >
								<?php foreach($dataTipConf as $data) { ?>
									<option value="<?php print $data['nc_tipConfVal']; ?>" ><?php print $data['nc_tipConfDes']; ?></option>
								<?php } ?>
							</select>
						<!-- [*] -->	

						<label class="nc_lbl" >Deteccion</label>

						<!-- INPUT DETECCION -->
							<select class="nc_input" id="nc_detecDes" >
								<?php foreach($dataDetec as $data) { ?>
									<option value="<?php print $data['nc_detecVal']; ?>" ><?php print $data['nc_detecDes']; ?></option>
								<?php } ?>
							</select>
						<!-- [*] -->

						<label class="nc_lbl">Proceso</label>

						<!-- INPUT PROCESO -->
							<select class="nc_input" id="nc_proce" >
								<?php foreach($dataProc as $data) { ?>
									<option value="<?php print $data['nc_proceVal']; ?>" ><?php print $data['nc_proceDes']; ?></option>
								<?php } ?>
							</select>
						<!-- [*] -->

						<label class="nc_lbl">Tipo de observacion</label>

						<!-- INPUT OBSERVACION -->
							<select class="nc_input" id="nc_obs" >
								<?php foreach($dataTipObs as $data) { ?>
								<option value="<?php print $data['nc_obsVal']; ?>" ><?php print $data['nc_obsDes']; ?></option>
								<?php } ?>
							</select>
						<!-- [*] -->	

						<label class="nc_lbl" >Estado</label>

						<!-- INPUT ESTADO CONFORMIDAD -->
							<select class="nc_input" id="nc_estaConfor" >
								<?php foreach($dataEstaConfor as $data) { ?>
									<option value="<?php print $data['nc_estaConforVal']; ?>" ><?php print $data['nc_estaConforDes']; ?></option>
								<?php } ?>
							</select>
						<!-- [*] -->

						<label class="nc_lbl" >Fecha de recepcion</label>
						
						<!-- INPUT FECHA RECEPCION -->
							<span class="nc_input" >
								<input type="text"  id="nc_fechRecep" >
							</span>
						<!-- [*] -->

						<label class="nc_lbl" >Descripcion</label>

						<!-- INPUT DESCRIPCION -->
						<textarea class="nc_input" id="nc_desConfor" ></textarea>
						<!-- [*] -->

						<label class="nc_lbl" >Respuesta inmediata</label>

						<!-- INPUT RESPUESTA INMEDIATA  -->
						<textarea class="nc_input" id="nc_respInme" ></textarea>
						<!-- [*] -->

						<label class="nc_lbl" >Fecha cierre</label>

						<!-- INPUT FECHA CIERRE -->
							<span class="nc_input" >
								<input type="text" id="nc_fechCie" >
							</span>
						<!-- [*] -->

					</div>

					<div id="nc_tipProdNc_d" >

						<!-- Form Tipo Producto no conforme -->

						<span class="nc_level" >Producto no conforme</span>

						<a href="#" id="nc_nuevProdNc" class="nc_lbl" >Nuevo</a>

						<table class='list' >
							<thead>
								<tr>
									<td>Item</td>
									<td>Serie</td>
									<td>Producto</td>
									<td>Cantidad</td>
									<td>Fecha</td>
									<td>Cliente</td>
									<td>Proveedor</td>
									<td>Descripcion</td>
									<td>Correcion</td>
									<td>Accion</td>
								</tr>
							</thead>
							<tbody id="nc_prodNoConfor_tab" >
							</tbody>
						</table>

					</div>

				</div>

				<div id="tabs-3" >

					<span class="nc_level" >Medida Correctiva</span>

					<a href="#" id="nc_nuevMed_pop" class="nc_lbl" >Nuevo</a>

					<!-- TABLE MEDIDAS CORRECTIVAS -->
						<table class="list" >
							<thead>
								<tr>
									<td>item</td>
									<td>Medida Correctiva</td>
									<td>Respuesta</td>
									<td>Ing. asignados</td>
									<td>fecha</td>
									<td align="center" >Accion</td>
								</tr>
							</thead>
							<tbody id="nc_medCorrec_tab" >
								<tr>
									<td>item</td>
									<td>medida</td>
									<td>resultado</td>
									<td>Ing. asignados</td>
									<td>fecha</td>
									<td align="center" >
										<a href="#" >Editar</a> | <a href="#" >Eliminar</a>
									</td>
								</tr>
							</tbody>
						</table>
					<!-- [*] -->

					<span class="nc_level" >Medida Preventiva</span>

					<a href="#" id="nc_nuevPrev" class="nc_lbl" >Nuevo</a>

					<!-- TABLE MEDIDAS PREVENTIVAS -->
						<table class="list" >
							<thead>
								<tr>
									<td>item</td>
									<td>Medida Preventiva</td>
									<td>Fecha</td>
									<td align='center' >Accion</td>
								</tr>
							</thead>
							<tbody id="nc_medPrev_tab" >
								<tr>
									<td>item</td>
									<td>Medida Preventiva</td>
									<td>Fecha</td>
									<td align='center' >
										<a href="#">editar</a>&nbsp;|
										<a href="#">elminar</a>
									</td>
								</tr>
							</tbody>
						</table>
					<!-- [*] -->

				</div>

				<!-- new 26/02/2015 - PROD -->

				<div id="tabs-4" >

					<!-- NIVEL DE FORMULARIO -->
					<span class='nc_level' >Tratamiento no conformidad</span>
					<!-- [*] -->

					<!-- LINK NUEVO TRATAMIENTO  [#nc_nuevTrat] --> 
						<a href="#" id="nc_nuevTrat" >Nuevo</a>
					<!-- [*] -->

					<!-- TABLE TRATAMIENTO NO CONFORMIDADES [#nc_tratNoConfor_tab] -->
						<table class="list" >
							<thead>
								<tr>
									<td>Item</td>
									<td>Tipo</td>
									<td>Comentario</td>
									<td>Autorizacion</td>
									<td align='center' >Accion</td>
								</tr>
							</thead>
							<tbody id="nc_tratNoConfor_tab" >
								<tr>
									<td>Item</td>
									<td>Tipo</td>
									<td>Comentario</td>
									<td>Autorizacion</td>
									<td align='center' >
										<a href="#">Editar</a>
										<a href="#">Eliminar</a>
									</td>
								</tr>
							</tbody>
						</table>
					<!-- [*] -->

				</div>

				<div id="tabs-5" >
					<span class="nc_level" >Adjuntos</span>

					<form name="nc_adju_frm" id="nc_adju_frm"  enctype="multipart/form-data" >

						<label class="nc_lbl" >Adjunto</label>

						<!-- INPUT FILE ADJUNTO  -->
							<input type="file" class="nc_input" id="nc_adjuFile" name="nc_adjuFile" >
						<!-- [*] -->

						<label class="nc_lbl" >Descripcion</label>

						<!-- INPUT DESCRIPCION ADJUNTO -->
							<textarea class="nc_input"  id="nc_adjuDes" name="nc_adjuDes" ></textarea>
						<!-- [*] -->

						<input type="hidden" name="nc_iframe_peti"  value="" >
						<input type="hidden" name="nc_conforId_adju"  value="" >

					</form>

					<label class="nc_lbl" ></label>

					<button class="nc_input" id="nc_agreAdju_acci" >Añadir</button>

					<!-- TABLE ADJUNTOS -->
						<table class="list" >
							<thead>
								<tr>
									<td>Item</td>
									<td>Adjunto</td>
									<td>Descripcion</td>
									<td align="center" >Accion</td>
								</tr>
							</thead>
							<tbody id="nc_adjuFile_tab" >
								<tr>
									<td>---</td>
									<td>---</td>
									<td>---</td>
									<td align="center" >
										<a href="#">eliminar</a>
									</td>
								</tr>
							</tbody>
						</table>
					<!-- [*] -->

				</div>

				<div id="tabs-6" >

					<label class="nc_lbl" >Resultados</label>

					<!-- INPUT MEDIDA PREVENTIVA -->
						<textarea class="nc_input nc_medPrev" id="nc_medPrev" ></textarea>
					<!-- [*] -->
				
				</div>

			</div>

		</div>
	</div>

<!-- HTML POPUP -->

	<div id="nc_medCorre_pop" title="Medida correctiva" >


		<span class="nc_level" >Medida correctiva</span>
		<input type="text" value="" id="nc_medId" class="nc_oculCamp" >

		<label class="nc_lbl" >N°</label>
		<!-- OUTPUT N° MEDIDA -->
		<span class="nc_input" id="nc_medCorre">----</span>
		<!-- [*] -->
		<label class="nc_lbl" >Medida correctiva</label>
		<!-- INPUT MEDIDA CORRECTIVA -->
			<textarea class="nc_input" id="nc_correcDes" ></textarea>
		<!-- [*] -->
		<label class="nc_lbl" >Respuesta</label>
		<!-- INPUT RESPUESTA -->
			<textarea class="nc_input" id="nc_correcResp" ></textarea>
		<!-- [*] -->
		<label class="nc_lbl" >Fecha</label>

		<!-- INPUT FECHA CORRECTIVA -->
			<span  class="nc_input" >
				<input type="text" id="nc_fechCorrec" >
			</span>
		<!-- [*] -->

		<label class="nc_lbl" >Ing. asignado</label>

		<!-- INPUT INGENIERO ASIGNADO -->
			<select class="nc_input" multiple size="10"  id="nc_ingAsigMul" >
				<?php foreach($dataIngAsig as $data) { ?>
				<option value="<?php print $data['nc_trabId']; ?>" ><?php print $data['nc_ingAsig']; ?></option>
				<?php } ?>
			</select>
		<!-- [*] -->


		<label class="nc_lbl" ></label>
		<a href="#" class="nc_input" id="nc_saveMed_acci" >Guardar</a>	
	</div>

	<div id="nc_equiProye_pop" title="Equipos de proyecto" >

		<span class="nc_level" >Equipos de proyecto</span>

		<label class="nc_lbl" >OC/EW</label>
		
		<!-- INPUT OC/EW   -->
			<select class="nc_input" id="nc_nroComp" >
				<option value="" ></option>
			</select>
		<!-- [*] -->

		<a href="#" class="nc_lbl" id="nc_detEquip_add"  >Añadir</a>

		<!-- TABLE DETALLE ORDENES -->
			<form name="nc_detEquip_frm" id="nc_detEquip_frm" >
			<table class="list" >
				<thead>
					<tr>
						<td align="center" ><input type="checkbox" class="nc_oculCamp" name="nc_detEquip[]" id="nc_detEquip" value="0" ></td>
						<td>Item</td>
						<td>Equipo</td>
						<td>Proveedor</td>
					</tr>
				</thead>
				<tbody id="nc_detOrd" >
					<tr>
						<td align="center" ><input type="checkbox" name="nc_detEquip[]" id="nc_detEquip" ></td>
						<td>---</td>
						<td>---</td>
						<td>---</td>
					</tr>
				</tbody>
			</table>
			</form>
		<!-- [*] -->
	</div>

	<!-- New update 08/01/2015 - CLOSE -->

	<div id="nc_medPrev_pop" title="Medida preventiva" >

		<span class="nc_level" >Medida preventiva</span>
		<input type="text" value="" id="nc_prevId" class="nc_oculCamp" >

		<label class="nc_lbl" >N°</label>
		<!-- OUTPUT N° MEDIDA -->
		<span class="nc_input" id="nc_ordPrev">----</span>
		<!-- [*] -->

		<label class="nc_lbl" >Medida preventiva</label>
		<!-- INPUT MEDIDA CORRECTIVA -->
			<textarea class="nc_input" id="nc_prevDes" ></textarea>
		<!-- [*] -->

		<label class="nc_lbl" >Fecha</label>

		<!-- INPUT FECHA CORRECTIVA -->
			<span  class="nc_input" >
				<input type="text" id="nc_fechPrev" >
			</span>
		<!-- [*] -->

		<label class="nc_lbl" ></label>
		<a href="#" class="nc_input" id="nc_savePrev_acci" >Guardar</a>	
	</div>

	<!-- New update 26/02/2015 - PROD -->

	<div id="nc_tratNoConfor_pop" title="Tratamiento no conformidad" >

		<!-- NIVEL DE FORMULARIO -->
		<span class='nc_level' >Tratamiento no conformidad</span>
		<!-- [*] -->

		<!-- OUTPUT N° [#nc_tratItem,#nc_tratId] -->
		<label class="nc_lbl" >N°:</label>
		<span id="nc_tratItem" class='nc_input' >---</span>
		<input type="hidden" id="nc_tratId" value="" >
		<!-- [*] -->

		<!-- INPUT TIPO DE TRATAMIENTO [#nc_tipTrat] -->
		<label class="nc_lbl" >Tipo de tratamiento:</label>
		<select class='nc_input' id="nc_tipTrat" >
			<?php foreach($dataTrat as $data) { ?>
			<option value='<?php print $data['tipTrat']; ?>' ><?php print $data['tipDes']; ?></option>
			<?php } ?>
		</select>
		<!-- [*] -->

		<!-- INPUT OPINION/COMENTARIO [#nc_opiTrat] -->
		<label class="nc_lbl" >Opinion/Comentario:</label>
		<textarea class='nc_input' id="nc_opiTrat" ></textarea>
		<!-- [*] -->

		<!-- INPUT AUTORIZACION [#nc_autoTrat] -->
		<label class="nc_lbl" >Autorizacion:</label>
		<select class='nc_input' id="nc_autoTrat"  size="7" multiple >
			<?php foreach($dataAut as $data) { ?>
			<option value='<?php print $data['nc_trabId']; ?>' ><?php print $data['nc_ingAsig']; ?></option>
			<?php } ?>
		</select>
		<!-- [*] -->

		<!-- BUTTON GUARDAR  [#nc_guarTrat] -->
		<label class="nc_lbl" ></label>
		<a href="#" class='nc_input' id="nc_guarTrat" >Guardar</a>
		<!-- [*] -->

	</div>

	<!-- New update 10/03/2015 - PROD -->

	<div id="nc_prodNoConfor_pop" title="producto no conforme" >

		<form name="nc_proNoConfor_form" id="nc_proNoConfor_form" >

		<label class="nc_lbl" >N°</label>
		<span class="nc_input" id="nc_itemProdNc" >-----</span>
		<input type="hidden" id="nc_prodNcId" >

		<label class="nc_lbl" >Serie</label>
		<input class="nc_input" id="nc_seriDes" type="text" >
		<input class="nc_input" id="nc_seriId"  type="hidden" >

		<label class="nc_lbl" >Producto</label>
		<input class="nc_input" id="nc_prodDes" type="text" >
		<input class="nc_input" id="nc_prodId" type="hidden" >

		<label class="nc_lbl" >Cantidad</label>
		<input class="nc_input" id="nc_prodCant" >

		<label class="nc_lbl" >Fecha</label>
		<span class="nc_input" ><input id="nc_fechProd" type="text" ></span>

		<label class="nc_lbl" >Cliente</label>
		<input class="nc_input" id="nc_cliDes" type="text" >
		<input class="nc_input" id="nc_cliId" type="hidden" >

		<label class="nc_lbl" >Proveedor</label>
		<input class="nc_input" id="nc_provDes" type="text" >
		<input class="nc_input" id="nc_provId" type="hidden" >

		<label class="nc_lbl" >Descripcion</label>
		<textarea class="nc_input" id="nc_desProdNc" ></textarea>

		<label class="nc_lbl" >Correccion</label>
		<textarea class="nc_input" id="nc_ProdCorrec" ></textarea>

		<label class="nc_lbl" >Tratamiento de producto</label>
		<ul class="nc_input" id="nc_tipTratProd_list" >
			<!--
			<li><input type="radio" id="nc_tratProd" name="nc_tratProd[]" value="1" >Devolucion</li>
			<li><input type="radio" id="nc_tratProd" name="nc_tratProd[]" value="2" >Permiso de desviacion</li>
			<li><input type="radio" id="nc_tratProd" name="nc_tratProd[]" value="3" >Reproceso</li>
			<li><input type="radio" id="nc_tratProd" name="nc_tratProd[]" value="4" >Otros</li>
			-->
		</ul>

		<label class="nc_lbl" >Otros</label>
		<textarea class="nc_input" id="nc_tratOtro" ></textarea>

		<label class="nc_lbl" >Ejecutar acciones correctivas</label>
		<input type="radio" id="nc_ejeAcci" name="nc_ejeAcci[]" style="display:none" value="0" >
		<ul class="nc_input" id="nc_acciEje_list" >
			<!--
			<li><input type="radio" id="nc_ejeAcci" name="nc_ejeAcci[]" >Si</li>
			<li><input type="radio" id="nc_ejeAcci" name="nc_ejeAcci[]" >No</li>
			-->
		</ul>

		<label class="nc_lbl" >Registrado por</label>
		<span class="nc_input" id="nc_regisPor" >-----</span>

		<label class="nc_lbl" >Autorizado por</label>
		<select class="nc_input" id="nc_autoPor" >
			<option></option>
		</select>

		<label class="nc_lbl" ></label>
		<input class="nc_input" id="nc_prodNc_agre" type="button" value="Guardar" >

		</form>

	</div>

<!-- HTML IFRAME -->

	<iframe src="" name="nc_iframe" id="nc_iframe" ></iframe>