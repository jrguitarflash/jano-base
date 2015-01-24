<!-- CSS MOVIMIENTO PERSONAL -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS MOVIMIENTO PERSONAL -->
<script type="text/javascript" src="js/mp_gesti.js?modojs=2" id="modojs" ></script>

<!-- CONTROLADOR INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADOR SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box">

	<div class="heading" >
		<h1>Validacion de movimiento</h1>
		<span class="botone" >
		</span>
	</div>
	<div class="busCli" >
		<label class="lblPeriVaca">Area:</label>
		<select id="slcAre" class="campo" onclick="ajaxTrabxAre();">
			<?php foreach($dataAreTrab as $data) {?>
				<option  value="<?php print $data['trab_funcion_id']; ?>">
					<?php print $data['trab_funcion_nombre'];  ?>
				</option>
			<?php }?>
		</select>
		<label class="campo">Trabajador:</label>
		<select id="slcTrab" class="campo" onclick="">
			<?php foreach($dataTrabAdm as $data){ ?>
			<option value="<?php print $data['persona_id']; ?>" ><?php print $data['persona']; ?></option>
			<?php }?>
		</select>
		<label class="campo">Fecha:</label>
		<span class="campo">
			<input type="text" id="mp_fechMov" name="mp_fechMov" >
		</span>
		<button class="campo btnBusMov"  onclick="mp_ajaxBusMovPer();" >Buscar</button>
	</div>
	<div class="content" >
		<div id="ajaxBusMovPer" >
			<table class="list" >
				<thead>
					<tr>
						<td>item</td>
						<td>Usuario</td>
						<td>Area</td>
						<td>Fecha Salida</td>
						<td>Fecha Retorno</td>
						<td>Hora Salida</td>
						<td>Hora Retorno</td>
						<td align="center" >Movimientos</td>
						<td>Estado</td>
						<td>Accion</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($dataMovPer as $data){ ?>
					<tr>
						<td><?php print $data['item']; ?></td>
						<td><?php print $data['user']; ?></td>
						<td><?php print $data['are']; ?></td>
						<td><?php print $data['fechSali']; ?></td>
						<td><?php print $data['fechRetor']; ?></td>
						<td><?php print $data['hourSali']; ?></td>
						<td><?php print $data['hourRetor']; ?></td>
						<td align="center" >
							<a href="<?php print "Javascript:mp_openPopup1('".$data['item']."');"; ?>"><?php print $data['cantMov']; ?></a>
						</td>
						<td align="center" >
							<img src="<?php print $data['imagEst']; ?>" width="30px" title="<?php print $data['desEst']; ?>"  >
						</td>
						<td align="center">
							<img src="images/mp_validate.png" width="30px" title="Validar"  onclick="<?php print "mp_openPopup3('".$data['item']."')"; ?>" >
						</td>
					</tr>
					<?php }?>
				</tbody>
				<!--
				<tfoot>
					<tr>
						<td>item</td>
						<td>Usuario</td>
						<td>Area</td>
						<td>Fecha Salida</td>
						<td>Fecha Retorno</td>
					</tr>
				</tfoot>
				-->
			</table>
		</div>
	</div>

</div>

<!-- POPUP DIALOG 1  -->
<div id="dialog1" title="Detalle de movimientos">
	<div class="box" >
		<div class="heading" >
			<h1>Detalle de movimientos</h1>
			<!--
				<span class="botone" >
					<a href="#" id="mp_valiDetMov">
						<img src="images/mp_validate.png" width="25px" title="Validar movimiento seleccionado" >
					</a>
					<a href="#" id="mp_rechaDetMov">
						<img src="images/mp_offVali.png" width="25px" title="Rechazar movimiento seleccionado" >
					</a>
				</span>
			-->
		</div>
		<div class="content fondPop" >
				<!--<div id="notiLoad" ></div>-->
				<form name="mp_frmDetMovPer" id="mp_frmDetMovPer" method="post" >
					<!-- CHECKBOX POR DEFECTO -->
					<input type="checkbox"  value="" id="idDetMov" name="idDetMov[]" style="display:none">
					<input type="checkbox"  value="" id="idDetMov" name="idDetMov[]" style="display:none">
					<div id="ajaxDetMovPer" >
							<table class="list" >
								<thead>
									<tr>
										<td rowspan="2" ></td>
										<td rowspan="2" >item</td>
										<td rowspan="2" >motivo</td>
										<td rowspan="2" >ubicacion</td>
										<td rowspan="2" >detalle</td>
										<td rowspan="1" colspan="2" >validacion</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center" ><input type="checkbox" id="idDetMov" name="idDetMov[]" ></td>
										<td>item</td>
										<td>motivo</td>
										<td>ubicacion</td>
										<td>detalle</td>
										<td>validacion</td>
									</tr>
									<tr>
										<td colspan="1" >Aceptadas</td>
										<td colspan="1" >Rechazadas</td>
									</tr>
								</tbody>
								<!--
									<tfoot>
										<tr>
											<td>item</td>
										</tr>
									</tfoot>
								-->
							</table>
					</div>
				</form>
		</div>
	</div>
</div>

 
<!-- POPUP DIALOG 2  -->
<div id="dialog2" title="Detalle de validacion" >
	<div id="ajaxValidAdmin" >
		<table class="list" >
			<thead>
				<tr>
					<td>Validacion</td>
					<td>Usuario</td>
					<td>Fecha</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Validacion</td>
					<td>Usuario</td>
					<td>Fecha</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td>Validacion</td>
					<td>Usuario</td>
					<td>Fecha</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<!-- POPUP DIALOG 3 -->
<div id="dialog3"  title="Aprobacion de movimiento" >
	<div id="notiLoad" ></div>
	<div class="box" >
		<div class="heading" >
			<h1>Validacion (Administracion)</h1>
		</div>
		<div class="content fondPop" >
			<label id="lbl2" >Aprobacion Gerente Area:</label>
			<select class="campo" id="mp_gerenAre">
				<?php foreach($dataGereAre as $data){ ?>
				<option value="<?php print $data['perId']; ?>" ><?php print $data['persona']; ?></option>
				<?php }?>
			</select>
			<select class="campo" id="mp_pruebAre">
				<?php foreach($dataPrueb as $data){ ?>
				<option value="<?php print $data['confId']; ?>" ><?php print $data['pruebConf']; ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" >Aprobacion Gerente A&F:</label>
			<select class="campo" id="mp_gerenFinan">
				<?php foreach($dataGereFinan as $data){ ?>
				<option value="<?php print $data['perId']; ?>" ><?php print $data['persona']; ?></option>
				<?php } ?>
			</select>
			<select class="campo" id="mp_pruebFinan" >
				<?php foreach($dataPrueb as $data){ ?>
				<option value="<?php print $data['confId']; ?>" ><?php print $data['pruebConf']; ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" >Aprobacion Gerente General:</label>
			<select class="campo" id="mp_gerenGene" >
				<?php foreach($dataGereGene as $data){ ?>
					<option value="<?php print $data['perId']; ?>" ><?php print $data['persona']; ?></option>
				<?php }?>
			</select>
			<select class="campo" id="mp_pruebGene" >
				<?php foreach($dataPrueb as $data){ ?>
				<option value="<?php print $data['confId']; ?>" ><?php print $data['pruebConf']; ?></option>
				<?php } ?>
			</select>
			<label id="lbl2" ></label>
			<button class="campo validAprob"  id="mp_validAprob" >Aprobar</button>
			<button class="campo validCancel" id="mp_cancelAprob" >Cancelar</button>
			<button class="campo validExit" onclick="mp_closePopup3();" >Salir</button>
		</div>
	</div>
</div>

<!-- POPUP DIALOG 4 -->
<div id="dialog4" title="Rendicion de movimiento" >
	<div class="box" >
		<div class="heading" >
			<h1>Rendicion de movimiento</h1>
			<span class="botone">
				<a onclick="mp_saveRendiMov()" id="mp_gastRendi">
	        		<img width="25px" title="Añadir gasto" src="images/grabar.png" ></img>
	    		</a>
			</span>
		</div>
		<div class="content fondPop" >
			<label id="lbl2" >Descripcion:</label>
			<textarea class="campo" id="mp_desRendi"></textarea>
			<label id="lbl2" >Moneda:</label>
			<select class="campo" id="mp_moneRendi" >
				<?php foreach($dataMone as $data){ ?>
				<option value="<?php print $data['moneda_id']; ?>" ><?php print $data['mon_sigla']; ?></option>
				<?php }?>
			</select>
			<label id="lbl2" >Monto:</label>
			<input type="text" class="campo" id="mp_montRendi" >
			<div id="ajaxSaveRendiMov" class="mp_detGast">
				<table class="list" >
					<thead>
						<tr>
							<td>item</td>
							<td>descripcion</td>
							<td>moneda</td>
							<td>monto</td>
							<td>accion</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>item</td>
							<td>descripcion</td>
							<td>moneda</td>
							<td>monto</td>
							<td align="center" >
								<img src="images/delete.png" width="20px" title="eliminar" class="mp_eliGast" >
							</td>
						</tr>
					</tbody>
					<!--
						<tfoot>
							<tr>
								<td></td>
							</tr>
						</tfoot>
					-->
				</table>
			</div>
		</div>
	</div>
</div>
