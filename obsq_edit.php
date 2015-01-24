<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador5.js"></script>


<?php require('clases/controlador/controladorInf.class.php'); ?>
<?php require('clases/controlador/controladorSup.class.php'); ?>


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
			Queja - Nuevo	
		</h1>
		<span class="botone">
			<a href="Javascript:saveFormatRecla();" ><img src="images/grabar.png" alt="grabar" width="20px"></a>
			<a href="#" ><img src="images/ayuda.png" alt="ayuda" ></a>
			<a href="#" ><img src="images/lista.png" alt="lista" ></a>
		</span>
	</div>
	<div class="content">
		<div id="lista_199">
			<form name="frmRecla" method="post" >
			<input name="accion" value="" type="hidden">
			<input type="hidden" id="filCliDupli" value="<?php print $cli; ?>">
			<label id="lbl">Fecha:</label>
			<input class="campo" id="txtFechRe" type="text" name="txtFechContro" value="<?php print $fechQue; ?>">		
			<label id="lbl">Cliente:</label>
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
			<select id="contac2" style="display:none">
				<option></option>
			</select>
			<label id="contacElegi" class="campo contacEleg" style="display:none">Seleccione un contacto</label>
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
			<label id="lbl">Responsable:</label>
			<select class="slcResp" name="slcResp"> 
				<option></option>
				<?php foreach($dataTrabVende as $data){ 
					if($data['persona_id']==$idRespo) {
				?>						
				<option value="<?php print $data['persona_id']; ?>" selected ><?php print $data['vendedor']; ?></option>
				<?php } else {?>
				<option value="<?php print $data['persona_id']; ?>" ><?php print $data['vendedor']; ?></option>
				<?php }}?>					
			</select>
			<label id="lbl">Descripcion:</label>
			<textarea class="campo queCome" name="txaDesObs" ><?php print $desObserv; ?></textarea>
			<label id="lbl">Solucion inmediata:</label>
			<textarea class="campo queCome" name="txaSoluInme"><?php print $soluInme; ?></textarea>
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