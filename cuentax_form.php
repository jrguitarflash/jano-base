<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!-- //------JQUERY TABS AÑADIDOS--------------// -->
<link rel="stylesheet" type="text/css" href="libJquery/tabs/jquery-ui.css" />
<script type="text/javascript" src="libJquery/tabs/jquery-ui.js"></script>

<!-- //------JQUERY TABS COMPLETE--------------// -->
<link rel="stylesheet" type="text/css" href="libJquery/autocomplete/jquery-ui.css" />
<!--<script type="text/javascript" src="libJquery/autocomplete/jquery-1.9.1.js"></script>-->
<script type="text/javascript" src="libJquery/autocomplete/jquery-ui.js"></script>

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador2.js"></script>

<style type="text/css">
	.ui-datepicker-trigger 
	{
    float: left;
    margin-top: 15px;
	}
</style>

<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

	<div class="box">
		<div class="heading">
			<h1>
				Formulario - Cuenta por cobrar	
			</h1>
			<span class="botone">
			<a href="Javascript:getAmorCuen();" ><img src="images/grabar.png" alt="grabar" width="20px"></a>
			<a href="Javascript:getGuia(1,199);" ><img src="images/ayuda.png" alt="ayuda" ></a>
			<a href="index.php?menu_id=109&menu=cuenta_xcobrar" ><img src="images/lista.png" alt="lista" ></a>
			<!--<a href="Javascript:valFile();">prueba</a>-->
			</span>
		</div>
		<div class="content">
			<div id="tabs">
				<ul>
				<li><a href="#tabs-2">Cuenta por cobrar</a></li>
				<!--<li><a href="#tabs-3">Amortizaciones</a></li>-->
				<!--<li><a href="#tabs-3">Aenean lacinia</a></li>-->
				</ul>
				<div id="tabs-2">
				<form name="cuentax_form" id="cuentax_form" method="post">
					<input type="hidden" name="accion" value="enviar">
					<label id="lbl">Cliente:</label>
					<div class="ui-widget campo">
						<select  name="cli" class="campo" id="combobox">
							<option></option>
							<?php foreach($clientes as $data){ ?>
							<option value="<?php print $data['empresa_id']; ?>"><?php print $data['emp_nombre']; ?></option>	
							<?php }?>		
						</select>
					</div>
					<label id="lbl">Ruc:</label>
					<div id="ajaxRucCli">
					<input type="text" name="txtRuc" class="campo">
					</div>
					<label id="lbl">Fecha:</label>
					<input type="text" name="txtFechCu" class="campo" id="txtFechCu">
					<label id="lbl">N° de Comprobante:</label>
					<input type="text" name="txtCompro" class="campo">
					<label id="lbl">Tipo Moneda:</label>
					<select class="campo" name="slcMone">
						<?php foreach($moneda as $data){ ?>
						<option value="<?php print $data['moneda_id'] ?>" ><?php print $data['mon_sigla']; ?></option>
						<?php } ?>						
					</select>
					<label id="lbl">Tipo de Documento:</label>
					<select class="campo" name="slcDoc">
						<?php foreach($documentos as $data){ ?>
						<option value="<?php print $data['idTipDoc'] ?>" ><?php print $data['descrip']; ?></option>
						<?php } ?>					
					</select>
					<label id="lbl">Importe:</label>
					<input type="text" class="campo" name="txtImpor">					
					<!--<label id="lbl">Porcentaje:</label>
					<input type="text" class="campo">-->
					<label id="lbl">Descripcion:</label>
					<textarea class="campo acci" name="txaDes"></textarea>
				</form>
				</div>
				<!--<div id="tabs-3"></div>-->
			</div>
		</div>
	</div>

<div id="dialog" title="Cobros de cuenta" class="popupRecla">
	<div id="">
		<label id="lbl">Banco:</label>
		<select id="slcBanco" class="campo" onclick="ajaxGetCuen('noEdit');">
				<?php foreach($bancos as $data) { ?>
				<option value="<?php print $data['banco_id'] ?>" ><?php print $data['banco_nombre']; ?></option>
				<?php } ?>		
		</select>
		<label id="lbl">Cuenta:</label>
		<select id="slcCuenta" class="campo">
				<?php foreach($cuenta as $data) { ?>
				<option value="<?php print $data['cuenta_id'] ?>" ><?php print $data['cuenta_nro']; ?></option>
				<?php } ?>		
		</select>
		<label id="lbl">Fecha:</label>
		<input type="text" name="txtApePat" class="campo" id="txtFech">
		<label id="lbl">Monto:</label>
		<input type="text" name="txtApMat" class="campo" id="txtMon">
		<label id="lbl">Estado:</label>
		<select id="slcEsta" class="campo">
				<?php foreach($estados as $data) { ?>
				<option value="<?php print $data['idCuEstado'] ?>" ><?php print $data['descrip']; ?></option>
				<?php } ?>		
		</select>
		<input type="button" value="Agregar" class="btnAgreAmor" onclick="setDetCuen('agreDet',1);">
		<input type="button" value=" Grabar " class="btnAgreGrab" onclick="grabCuen();">
		<div class="lista tbAmor" id="ajaxDetCuen">
			<table class="list">
				<thead>
				<tr>
					<td>Item</td>
					<td>Banco</td>
					<td>Cuenta</td>
					<td>Fecha</td>
					<td>Monto</td>
					<td>Estado</td>
					<td>Accion</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>Item</td>
					<td>Banco</td>
					<td>Cuenta</td>
					<td>Fecha</td>
					<td>Monto</td>
					<td>Estado</td>
					<td><a href="#" class="eliAmor">Eliminar</a></td>
				</tr>
				</tbody>
			</table>		
		</div>
	</div>
</div>

