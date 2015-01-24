<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!-- //------JQUERY TABS COMPLETE--------------// -->
<link rel="stylesheet" type="text/css" href="libJquery/autocomplete/jquery-ui.css" />
<!--<script type="text/javascript" src="libJquery/autocomplete/jquery-1.9.1.js"></script>-->
<script type="text/javascript" src="libJquery/autocomplete/jquery-ui.js"></script>

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador3.js"></script>

<?php require('clases/controlador/controladorInf.class.php'); ?>
<?php require('clases/controlador/controladorSup.class.php'); ?>


	<div class="box">
		<div class="heading">
			<h1>
				Formulario - Reclamo	
			</h1>
			<span class="botone">
			<a href="Javascript:setReclamo();" ><img src="images/grabar.png" alt="grabar" width="20px"></a>
			<a href="javascript:getGuia(1,199);" ><img src="images/ayuda.png" alt="ayuda" ></a>
			<a href="index.php?menu_id=102&menu=reclamo_lista&filtro=1&filtro2=6" ><img src="images/lista.png" alt="lista" ></a>
			<!--<a href="Javascript:valFile();">prueba</a>-->
			</span>
		</div>
		<div class="content">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Formulario Reclamo</a></li>
					<!--<li><a href="#tabs-2">Proin dolor</a></li>-->
					<!--<li><a href="#tabs-3">Aenean lacinia</a></li>-->
					</ul>
				<div id="tabs-1">

				<form name="reclamo_form" id="reclamo_form" method="post" enctype="multipart/form-data">

					<!-- Cadena ids observacion -->

					<input type="hidden" value="<?php print $cadObs; ?>" id="recla_cadObs" >

					<!-- Tipo de observacion -->

					<label id="lbl" >Tipo de observacion:</label>
					<select class="campo" onclick="recla_obsxTip()" id="recla_tipObs" name="recla_tipObs">
						<?php print $tipObs; ?>
					</select>

					<!-- Observacion -->

					<label id="lbl" >Observacion:</label>
					<select class="campo" id="recla_obs" name="recla_obs"></select>

					<!-- Tipo de reclamo -->

						<label class="lblTip" id="lbl">Tipo Reclamo:</label> 
						<select name="tip"  class="campo tipRecla" id="tip" >
							<?php foreach($dataTipRecla as $data){ 
									if($data['idTipReclamo']==$idTip) {
							?>
							<option value="<?php print $data['idTipReclamo']; ?>" selected><?php print $data['desTipReclamo']; ?></option>
							<?php } else {?>
							<option value="<?php print $data['idTipReclamo']; ?>"><?php print $data['desTipReclamo']; ?></option>	
							<?php }}?>	
						</select>

					<!-- Fecha de recepcion-->

						<label class="lblFech" id="lbl">Fecha Recepcion:</label>
						<span class="campo" >
							<input type="text" name="fech"  id="fech" value="<?php print $fecha; ?>">
						</span> 

					<!-- Cliente -->

						<label class="lblCli" id="lbl">Cliente:</label> <!-- Cliente -->
						<input type="hidden" id="nomCli" value="<?php print $nomCli; ?>" >
						<div class="ui-widget campo">
							<select  name="cli" class="campo" id="combobox">
								<option></option>
								<?php foreach($clientes as $data){ ?>
								<option value="<?php print $data['empresa_id']; ?>"><?php print $data['emp_nombre']; ?></option>	
								<?php }?>		
							</select>
						</div>
						<a href="Javascript:getEmpPopup();" class="campo"><img src="images/add_reg.png" align="left">Agregar</a>

					<!-- Contacto -->

						<label class="lblContac" id="lbl">Contacto:</label>
						<!--<select name="contac" multiple="multiple">-->
						<label id="contacElegi" class="campo contacEleg" style="display:none;"><?php print $nomContac; ?></label>
						<div id="ajaxContactos">	
							<select name="contac[]" class="campo contacEleg" id="contac" size="5" onclick="mosContac()">
								<?php foreach($dataContac as $data){ 
									if($data['persona_id']==$idContac){							
								?>							
								<option value="<?php print $data['persona_id']; ?>" selected><?php print $data['contacto']; ?></option>
								<?php } else { ?>
								<option value="<?php print $data['persona_id']; ?>"><?php print $data['contacto']; ?></option>	
								<?php }}?>
							</select>	
						</div>
						<a href="Javascript:getContacPopup();" class="campo"><img src="images/add_reg.png" align="left">Agregar</a>

					<!-- Receptor de reclamo -->

						<label class="lblRecep" id="lbl">Receptor Reclamo:</label>
						<input type="text" name="recep" class="campo" id="recep" value="<?php print $usuario; ?>" disabled>
						<div id="ajaxEmailRecep">
							<input type="email" name="emailRecep" class="campo correoRecep" id="mailRecep" value="<?php print $email; ?>">
						</div>
						<input type="button" value="Actualizar Email" class="actuEmail" onclick="setActEmailRecep();">


					<!-- Responsable -->

						<label class="lblRespo" id="lbl">Responsable:</label>
						<select name="respo" class="campo" id="respo" onclick="getEmail();">
							<option></option>
							<?php foreach($dataTrabVende as $data){ 
								if($data['persona_id']==$idResp) {						
							?>
							<option value="<?php print $data['persona_id']; ?>" selected><?php print $data['vendedor']; ?></option>
							<?php } else { ?>
							<option value="<?php print $data['persona_id']; ?>"><?php print $data['vendedor']; ?></option>	
							<?php }}?>	
						</select>
						<div id="ajaxEmail">
							<input type="text" name="emailRespo" class="campo correo" id="mail" value="<?php print $valEmail; ?>">
						</div>
						<input type="button" value="Actualizar Email" class="actuEmail" onclick="setActEmail();">
						<input type="checkbox" class="campo" name="enviRespo[]" value="1" <?php print $estaProp[0]; ?> >

					<!-- Responsable 2 -->

						<label class="lblRespo" id="lbl">Responsable 2:</label>
						<select class="campo" name="respo2" id="respo2" onclick="getEmail2();" >
							<option></option>
							<?php foreach($dataTrabVende as $data){ 
								if($data['persona_id']==$idResp2) {						
							?>
							<option value="<?php print $data['persona_id']; ?>" selected><?php print $data['vendedor']; ?></option>
							<?php } else { ?>
							<option value="<?php print $data['persona_id']; ?>"><?php print $data['vendedor']; ?></option>	
							<?php }}?>
						</select>
						<div id="ajaxEmail2">
							<input type="text" name="emailRespo2" class="campo correo" id="mail2" value="<?php print $valEmail2; ?>">
						</div>
						<input type="button" value="Actualizar Email" class="actuEmail" onclick="setActEmail2()">
						<input type="checkbox" class="campo" name="enviRespo[]" value="2" <?php print $estaProp[1]; ?> >


					<!-- Descripcion -->

						<label class="lblAcci" id="lbl">Descripcion:</label>
						<textarea name="desRecla" class="campo acci" id="acci"><?php print $desRecla; ?></textarea>
						<label class="lblAcci" id="lbl">Acciones ordenadas:</label>
						<ol type="1" class="campo histo">
							<?php for($i=0;$i<count($desReclaHist);$i++) { 
								if($desReclaHist[$i]!='' and strlen($desReclaHist[$i])>5) {
							?>						
							<li><?php print $desReclaHist[$i]; ?></li>
							<?php }} ?>					
						</ol>
						<textarea name="acci" class="campo acci" id="acci" style="display:none"><?php print $desAcciRecla; ?></textarea>
						<textarea name="acci2" class="lbl acci2" id="acci"></textarea>

					<!-- Acciones realizadas -->

						<label class="lblAcci" id="lbl">Acciones realizadas:</label>
						<ol type="1" class="campo histo">
							<?php for($i=0;$i<count($desAcciReliReclaHist);$i++) { 
								if($desAcciReliReclaHist[$i]!='' and strlen($desAcciReliReclaHist[$i])>5) {
							?>						
							<li><?php print $desAcciReliReclaHist[$i]; ?></li>
							<?php }} ?>					
						</ol>
						<textarea name="acciReli" class="campo acci" id="acci" style="display:none"><?php print str_replace('</br>',"\n", $desAcciReliRecla); ?></textarea>
						<input type="hidden" name="accion" value="enviar">

					<!-- Adjuntos -->

						<label id="lbl" >Adjuntos:</label>
						<span class="campo" >
							<ul>
								<?php print $cadAdju; ?>
							</ul>
						</span>

					<!-- Adjuntar -->

						<!--
						<label id="lbl">Adjuntar:</label>
						<input type="file" class="campo fileAdju" id="adjunt" name="adjunt" onchange="setRutVisi();">
						<input type="hidden" name="rutaImgRecla" value="<?php #print $rutImgRecla[0]; ?>">
						<label id="notiAdju" class="campo" ><?php #print $rutImgRecla[0]; ?></label>
						-->
						
						<!-- <a href="Javascript::clean();" class="campo" id="limp1">limpiar</a> -->
						
						<!-- Requerimientos adjuntos adicionales en el modulo reclamos -->

						<!--
						<input type="file" class="lbl fileAdju" id="adjunt2" name="adjunt2" onchange="setRutVisi2();">
						<input type="hidden" name="rutaImgRecla2" value="<?php #print $rutImgRecla[1]; ?>">
						<label id="notiAdju2" class="campo" ><?php #print $rutImgRecla[1]; ?></label>
						-->					
						
						<!--
						<input type="file" class="lbl fileAdju" id="adjunt3" name="adjunt3" onchange="setRutVisi3();">
						<input type="hidden" name="rutaImgRecla3" value="<?php #print $rutImgRecla[2]; ?>">
						<label id="notiAdju3" class="campo" ><?php #print $rutImgRecla[2]; ?></label>
						-->

					<!-- Adjuntar2 -->

						<label id="lbl" >Adjuntar:</label>
						<input type="file" class="campo" name="adjunt[]" id="adjunt" multiple >
					
					<select id="contac2" style="display:none">
						<option></option>
					</select>

					<!-- Envio de email -->

						<label id="lbl" >Enviar email:</label>
						<input type="checkbox" class="campo" name="recla_checkEmail" id="recla_checkEmail">

				</form>
				</div>
				<!--<div id="tabs-2"></div>-->
				<!--<div id="tabs-3"></div>-->
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

