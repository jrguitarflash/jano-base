<!-- PHP UTILS -->

	<?php require("utils_func.php"); ?>

<!-- JS UTILS -->

	<script type="text/javascript" src="js/utils_gesti.js" ></script>

<!-- ESTILOS DECORADOR AÑADIDOS -->

	<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!-- JQUERY TABS AÑADIDOS -->

	<link rel="stylesheet" type="text/css" href="libJquery/tabs/jquery-ui.css" />
	<script type="text/javascript" src="libJquery/tabs/jquery-ui.js"></script>

<!-- JQUERY TABS COMPLETE -->

	<link rel="stylesheet" type="text/css" href="libJquery/autocomplete/jquery-ui.css" />
	<!--<script type="text/javascript" src="libJquery/autocomplete/jquery-1.9.1.js"></script>-->
	<script type="text/javascript" src="libJquery/autocomplete/jquery-ui.js"></script>

<!-- JQUERY CALENDAR -->

	<!--
	<script type="text/javascript" src="libJquery/calendar/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="libJquery//jquery-ui.css" />
	<script type="text/javascript" src="libJquery/calendar/datepicker.validate.js"></script>
	-->

<!-- JS GESTIONADOR AÑADIDOS -->

	<script type="text/javascript" src="js/gestionador.js"></script>

<!-- CSS SCRIPT -->

	<style type="text/css">

		.ui-datepicker-trigger 
		{
		    float: left;
		    margin-top: 15px;
		}

	</style>

<!-- PHP CONTROLADOR SUP -->

	<?php require('clases/controlador/controladorSup.class.php'); ?>

<!-- PHP CONTROLADOR INF -->

	<?php require('clases/controlador/controladorInf.class.php'); ?>

<!-- HTML ID -->

	<input type="hidden" id="vi_id" value="<?php print $_GET['id']; ?>" >

<!-- HTML VIEW -->

	<input type="hidden" id="vi_view" value="<?php print $_GET['menu']; ?>" >

<!-- HTML BODY -->

	<div class="box">
		<div class="heading">
			<h1>
				Visitas - Reporte	
			</h1>
			<span class="botone">
			<!--<a href="javascript:setDetVisitas();" ><img src="images/grabar.png" alt="grabar" width="20px"></a>-->
			<a href="javascript:getGastosPopup();" ><img src="images/grabar.png" alt="grabar" width="20px"></a>
			<a href="javascript:getGuia(1,200);" ><img src="images/ayuda.png" alt="ayuda" ></a>
			<a href="#" id="vi_volList" ><img src="images/lista.png" alt="lista" ></a>
			<!--<a href="reporte/reporte_visita.php" target="_blank">reporte</a>-->
			</span>
		</div>
		<div class="content">
			<div id="lista_199"> 
				<div class="lista">
					<form name="visiRepor" method="post">
						<span class="datGene">
							<h3>Datos Generales de Visita</h3>
						</span>
						<label id="lbl" style="display:none" >Vendedor:</label>
						<select class="campo" name="vend" style="display:none" >
							<?php //foreach($dataTrabVende as $data){ ?>
								<option value="<?php //print $data['persona_id']; ?>"><?php //print $data['vendedor'];?></option>
							<?php //} ?>			
						</select>
						<label id="lbl">Fecha inicial:</label>
						<input id="txtFechIni" type="text" class="datepicker campo" name='txtFechIni' value="<?php print $fechIni; ?>">
						<label id="lbl">Fecha final:</label>
						<input id="txtFechFin" type="text" class="datepicker campo" name='txtFechFin' value="<?php print $fechFin ?>">
						<input type="hidden" name="accion" value="enviar" >
					<span class="datGene">
					<h3>Detalles de Visita</h3>
					</span>
					<label class="lblCli" id="lbl">Empresa:</label>
					<div class="ui-widget campo" id="ajaxEmpNuevo">
						<select  name="cli" class="campo" id="combobox">
							<option></option>
								<?php foreach($clientes as $data){ ?>
								<option value="<?php print $data['empresa_id']; ?>"><?php print $data['emp_nombre']; ?></option>	
								<?php }?>		
						</select>
					</div>
					<a href="Javascript:getEmpPopup();" class="campo"><img src="images/add_reg.png" align="left">Agregar</a>
					<label class="lblContac" id="lbl">Contacto:</label>
					<!--<select name="contac" multiple="multiple">-->
					<label id="contacElegi" class="campo contacEleg" style="display:none">Seleccione un contacto</label>
					<select name="contac2[]" id="contac2" size="5" onclick="dSlcContac();" class="campo contacEleg">
					</select>
					<div id="ajaxContactos">	
						<select class="campo listContac" id="contac" onclick="slcContac();">
							<option></option>
							<option></option>
							<option></option>		
						</select>
					</div>
					<a href="Javascript:getContacPopup();" class="campo"><img src="images/add_reg.png" align="left">Agregar</a>

					<!-- Fecha Visita -->
						<label id="lbl" >Fecha Visita</label>
						<input type="text" id="vi_fechVisi" name="vi_fechVisi" class="campo" >
					<!-- [*] -->

					<!-- Direccion Origen-->
						<label id="lbl" >Direccion Origen:</label>
						<textarea class="campo txaDire" id="vi_dirOrigen" name="vi_dirOrigen" ></textarea>
					<!-- [*] -->
					
					<label id="lbl">Direccion Empresa:</label>				
					<textarea class="campo txaDire" id="txaDire"></textarea>
					<label id="lbl">Observacion por actividades realizadas:</label>
					<textarea id="obsVisi" class="campo obsVisi"></textarea>
					<label id="lbl">Compromiso pendientes:</label>
					<textarea id="obsPen" class="campo obsVisi"></textarea>
					<input type="hidden" name="sltMone" type="text" value="">
					<input type="hidden" name="txtPasa" type="text" value="">
					<input type="hidden" name="txtHospe" type="text" value="">
					<input type="hidden" name="txtAli" type="text" value="">
					<input type="hidden" name="txtTrans" type="text" value="">
					<input type="button" value="añadir" class="btnDetVisi" onclick="setDetVisit('agreDet',1);">
					<input type="button" value="limpiar" class="btnLimVisi" onclick="setDetVisit('borraTod',1);">

					<!-- UI Detalle Pasajes -->
					<input class='campo vi_ocuCamp' type='text' name='detPasMont[]' id='detPasMont_0' placeholder='ingresar monto' >
					<!-- <textarea class='campo vi_ocuCamp' name='detPasDes[]' id='detPasDes_0' placeholder='ingresar detalle' ></textarea> -->
					<div title="Detalle de Pasajes"  id="vi_uiDetPas" >
					</div>
					<!-- [*] -->

					</form>
					<div id="ajaxDetVisi"  class="campo marDetVisi">
						<table class="list">
							<thead>
								<tr>
									<td align="center">Id</td>
									<td>Empresa</td>
									<td>Contacto</td>	
									<td>Observacion por actividades</td>
									<td>Observacion pendientes</td>
									<td>Fecha Visita</td>
									<td>Direccion Origen</td>
									<td>Direccion Empresa</td>
									<td align="center">Accion</td>			
								</tr>
							</thead>
							<tbody id="vi_detVisi_tab" >
							
							</tbody>			
						</table>
					</div>
				</div>	
				<div class="pagination"></div>
			</div>			
		</div>
	</div>

<!-- HTML POPUP -->

	<div id="dialog2" title="Nuevo Contacto" class="popupRecla">
		<div id="">
			<label id="lbl">Nombres:</label>
			<input type="text" name="txtNom" class="campo" id="txtNom">
			<label id="lbl">Apellido Paterno:</label>
			<input type="text" name="txtApePat" class="campo" id="txtApePat">
			<label id="lbl">Apellido Materno:</label>
			<input type="text" name="txtApMat" class="campo" id="txtApMat">
			<label id="lbl">Telefono:</label>
			<input type="text" name="txtTel" class="campo" id="txtTel">
			<label id="lbl">Email:</label>
			<input type="text" name="txtEmail" class="campo" id="txtEmail">
			<input type="button" value="Agregar" class="btnAgre" onclick="outContacPopup();">
		</div>
	</div>

	<div id="dialog3" title="Gastos de Visitas" class="popupRecla">
		<div id="">
			<label id="lbl">Moneda</label>
			<select class="campo" name="sltMone" id="sltMone">
				<?php foreach($dataMoney as $data){ ?>
				<option value="<?php print $data['moneda_id'] ?>" ><?php print $data['mon_sigla']; ?></option>
				<?php } ?>		
			</select>

			<!-- Input Pajase -->

				<label id="lbl">Pasajes:</label>
				<input type="text" name="txtPasa" class="campo" id="txtPasa" value="0.00" disabled>
				<!-- <input type="Number" class="campo vi_cantPas" id="vi_cantPas"> -->
				<label id="lbl" ></label>
				<a href="Javascript:vi_uiDetPas_open();" class="campo" id="vi_detPas" >Detallar</a>
				<a href="Javascript:vi_uiDetPas_show();" class="campo" id="vi_mosPas" >Mostrar</a>

			<!-- (*) -->

			<label id="lbl">Hospedaje:</label>
			<input type="text" name="txtHospe" class="campo" id="txtHospe">
			<label id="lbl">Alimentacion:</label>
			<input type="text" name="txtAli" class="campo" id="txtAli">
			<label id="lbl">Transporte Interno:</label>
			<input type="text" name="txtTrans" class="campo" id="txtTrans">
			<input type="button" value="Agregar" class="btnAgre" onclick="outGastosPopup();">
		</div>
	</div>

	<div id="dialog4" title="Nueva Empresa" class="popupRecla">
		<div id="">
			<label id="lbl">Ruc:</label>
			<input type="text"  class="campo" id="txtRuc">
			<label id="lbl">Nombre:</label>
			<input type="text"  class="campo" id="txtEmp">
			<label id="lbl">Email:</label>
			<input type="text"  class="campo" id="txtEmpMail">
			<label id="lbl">Web:</label>
			<input type="text"  class="campo" id="txtEmpWeb">
			<label id="lbl">Direccion:</label>
			<input type="text"  class="campo" id="txtEmpDire">
			<label id="lbl">Telefono:</label>
			<input type="text"  class="campo" id="txtEmpTel">
			<input type="button" value="Agregar" class="btnAgre" onclick="outEmpPopup();">
		</div>
	</div>

