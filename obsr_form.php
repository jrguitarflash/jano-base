<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!-- //------JQUERY TABS COMPLETE--------------// -->
<link rel="stylesheet" type="text/css" href="libJquery/autocomplete/jquery-ui.css" />
<!--<script type="text/javascript" src="libJquery/autocomplete/jquery-1.9.1.js"></script>-->
<script type="text/javascript" src="libJquery/autocomplete/jquery-ui.js"></script>

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador5.js"></script>


<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

<style type="text/css">
	.ui-datepicker-trigger 
	{
    float: left;
    margin-top: 15px;
	}
</style>

<div class="box">
	<div class="heading">
		<h1>
			Reclamo - Nuevo	
		</h1>
		<span class="botone">
			<a href="Javascript:saveFormatRecla();" ><img src="images/grabar.png" alt="grabar" width="20px"></a>
			<a href="#" ><img src="images/ayuda.png" alt="ayuda" ></a>
			<a href="#" ><img src="images/lista.png" alt="lista" ></a>
		</span>
	</div>
	<div class="content">
		<div id="lista_199"> 
					<form name="frmRecla" method="post" action="">
					<input type="hidden" value="" name="accion" >
					<div class="cabe cabeIz">electrowerke</div>
					<div class="cabe cabeDe">
						<table class="tabCorre">
							<tr>
								<td colspan="3" class='titPrinCorre' align="center">Control de acciones correctivas y preventivas</td>							
							</tr>
							<tr>
								<td>
								Codigo N°:
								<select name="slcNumFormat">
									<?php foreach($dataNumFormat as $data) { ?>
									<option value="<?php print $data['idCodFormat']; ?>" ><?php print $data['correCodFormat']; ?></option>
									<?php } ?>								
								</select>								
								</td>
								<td>Version N°:
								<select name="slcVerFormat">
									<?php foreach($dataVerFormat as $data) { ?>
									<option value="<?php print $data['idCodVersi']; ?>" ><?php print $data['desVersi']; ?></option>
									<?php } ?>								
								</select>								
								</td>
								<td>Pagina:
								<select name="slcPagFormat">
									<?php foreach($dataPagFormat as $data) { 
										for($i=1;$i<=$data['numPag'];$i++) {									
									?>
									<option value="<?php print $data['idCodPag']; ?>" ><?php print $i; ?></option>
									<?php }} ?>								
								</select>								
								</td>							
							</tr>	
						</table>					
					</div>
					<h3 class="titCorre">Control de acciones correctivas y preventivas</h3>
					<label class="lblNumInf">Informe N°:</label>	
					<input class="txtNumRe" type="text" name="numInfor">
					<label class="lblFechRe">Fecha:</label>
					<input class="txtFechRe" id="txtFechRe" type="text" name="txtFechContro">
					<fieldset class="acciCorre">
						<legend>Datos contacto</legend>
					<select id="contac2" style="display:none">
						<option></option>
					</select>
					<label class="lblCli" id="lbl">Cliente:</label>
					<div class="ui-widget campo">
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
					<div id="ajaxContactos">	
						<select name="contac[]" class="campo contacEleg" id="contac" size="5">
							<option></option>
							<option></option>
							<option></option>		
						</select>
					</div>
					<a href="Javascript:getContacPopup();" class="campo"><img src="images/add_reg.png" align="left">Agregar</a>
				</fieldset>		
				<fieldset class="acciCorre">
					<legend>Acciones correctivas</legend>
					<label class="titPun">1. Descripcion de la observacion</label>
					<textarea class="txaAcciCorre" name="txaDesObs"></textarea>
					<label class="titPun">2. Acciones correctivas / preventivas que deben efectuarse</label>
					<textarea class="txaAcciCorre" name="txaEviCorre"></textarea>
					<label class="titPun">
					3. Responsable a cargo de la ejecucion de las acciones correctivas o preventivas:
					</label>
					<select class="slcResp" name="slcResp"> 
						<option></option>
						<?php foreach($dataTrabVende as $data){ ?>
						<option value="<?php print $data['persona_id']; ?>"><?php print $data['vendedor']; ?></option>	
						<?php }?>					
					</select>
					<label class="titPun">
					4. Fecha limite para completar la accion correctiva / preventiva:
					</label>
					<input class="slcResp" id="txtFechLi" type="text" name="txtFechLi">
				</fieldset>
				<fieldset class="acciCorre">
					<legend>Verificacion</legend>
					<label class="titPun">
						4. Verificacion de Implementacion por el Representante de la Gerencia
						<input type="text" id="txtFechVeri" name="txtFechVeriImp" class="txtFechVeri" >
					</label>
					<ol type="a" class="veriImp" >
						<li>
							Implementacion satisfactoria
							<?php foreach($dataConfor as $data){ ?>
							<input class="yesDatis" type="radio" name="rdImpSati" value="<?php print $data['idConfor']; ?>" checked>
							<?php print $data['valConfor']; ?>
							<?php } ?>
						</li>
						<li>
							Fecha acordada para verificacion de efectividad
							<input class="txtFechAcor" id="txtFechAcor" type="text" name="txtFechAcor">
						</li>					
					</ol>
					<label class="titPun">
						5. Verificacion de efectividad por el representante de la gerencia
						<input type="text" id="txtFechEfec" name="txtFechVeriEfec" class="txtFechEfec titPunVeriEfe" >
					</label>
					<ol type="a" class="veriImp" >
						<li>
							Efectividad satisfactoria
							<?php foreach($dataConfor as $data){ ?>
							<input class="yesDatis" type="radio" name="rdEfecSati" value="<?php print $data['idConfor']; ?>" checked="">
							<?php print $data['valConfor']; ?>
							<?php } ?>
							<input type="text" id="txtFecEfecSatis" name="txtFecEfecSatis" class="txtFecEfecSatis" >
						</li>				
					</ol>
				</fieldset>
				<fieldset class="acciCorre">
					<legend>Evidencia objetiva</legend>
					<label class="titPun">6. Evidencia objetiva de la efectividad de la accion correctiva / preventiva</label>
					<textarea class="txaAcciCorre" name="txaEviObje"></textarea>
				</fieldset>
				<fieldset class="acciCorre">
					<legend>Cierre y seguimiento</legend>
					<div class="panCieNoCon">
						<label class="titPun">
							7. Se cierra la no conformidad
							<input type="text" id="txtFechNoConf" name="txtFechNoConf" class="txtFechNoConf" >
						</label>					
					</div>
					<div class="panCieNoCon">
						<label class="titPun">
							8. Seguimiento en Auditoria Interna: (Follow-up)
							<input type="text" id="txtFechSegAud" name="txtFechSegAud" class="txtFechNoConf" >
						</label>			
						<ol type="a" class="acEfec" >
						<li>
							AC efectiva
							<?php foreach($dataConfor as $data){ ?>
							<input class="yesDatis" type="radio" name="rdAc" value="<?php print $data['idConfor']; ?>" checked>
							<?php print $data['valConfor']; ?>
							<?php } ?>
						</li>
						</ol>	
					</div>
				</fieldset>	
				</form>	
		</div>			
	</div>
</div>

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