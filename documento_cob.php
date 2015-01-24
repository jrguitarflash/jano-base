<!-- ESTILOS DEL FORMULARIO  -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- CONTROLADORES INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADORES SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box">
	<div class="heading">
		<h1>Documento a Cobrar</h1>
	</div>
	<div class="content">
		<form name="frmDocCob">
			<label id="lbl">Tipo Documento:</label>
			<select class="campo">
				<?php foreach($dataTipDoc as $data){ ?>
					<option value="<?php print $data['tipdoc_codigo']; ?>"><?php print $data['tipdoc_descripcion']; ?></option>
				<?php }?>
			</select>
		</form>
	</div>
</div>