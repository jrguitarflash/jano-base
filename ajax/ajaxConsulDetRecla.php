<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//
session_start();

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::getDatReclaxId($_POST['getVal'],'desReclamo');
$desRecla=negocio::getVal($sql,'desReclamo');

$sql=sql::getDatReclaxId($_POST['getVal'],'acciReclamo');
$acciRecla=negocio::getVal($sql,'acciReclamo');

$sql=sql::getDatReclaxId($_POST['getVal'],'acciReliReclamo');
$acciReliRecla=negocio::getVal($sql,'acciReliReclamo');

?>

<p>
	<strong class="limDes">Descripcion:</strong>
	<label class="campo titRecla"><?php print $desRecla; ?><label>
</p>

<p>
	<strong id="lbl">Accion ordenadas:</strong>
	<div class="campo minDetRecla">
	<?php
		$acciRecla=negocio::evaAcciDet($acciRecla); 
		print $acciRecla; 
	?>
	</div>
</p>

<p>
	<strong id="lbl" >Accion realizadas:</strong>
	<div class="campo minDetRecla">
	<?php
		$acciReliRecla=negocio::evaAcciDet($acciReliRecla); 
		print $acciReliRecla; 
	?>
	</div>
</p>

<?php 
		if($_POST['getVal2']==4 and $_SESSION['SIS'][2]==46) { 
		$evenConfir="outReclaPopup(".$_POST['getVal'].")";
?>
<input type="button" name="closeRecla" class="btnDetVisi btnCloseRecla" value="cerrar reclamo" onclick="<?php print $evenConfir; ?>">
<?php } ?>