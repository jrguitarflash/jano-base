<!-- CSS VACACIONES  -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS VACACIONES -->
<script type="text/javascript" src="js/vaca_gesti.js" ></script>

<!-- CONTROLADORES INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADORES SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box">
	<div class="heading">
		<h1>Apertura de periodos</h1>
		<span class="botone">
			<a href="Javascript:jsGenePer();">
				<img src="images/genePer.png" width="20px" title="Generar nuevo periodo" >
			</a>
			<a href="Javascript:jsActPer();">
				<img src="images/actPer.png" width="20px" title="Activar periodos" >
			</a>
		</span>
	</div>
	<div class="content"> 
		<form name="frmPerAn" id="frmPerAn" >
			<input type="hidden" name="accion" value="" >
			<table class="list" >
				<thead>
					<tr>
						<td align="center"><!--<input type="checkbox">--></td>
						<td align="center">Item</td>
						<td align="center">Periodo</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($dataPerAn as $data){ ?>
					<tr>
						<td align="center" ><input  value="<?php print $data['vaca_perioAn_id']; ?>" type="checkbox" <?php print $data['prop'] ?>  name="chkEstPer[]" ></td>
						<td align="center"><?php print $data['vaca_perioAn_id']; ?></td>
						<td align="center"><?php print $data['vaca_desPeri']; ?></td>
					</tr>
					<?php }?>
				</tbody>	
			</table>
		</form>
	</div>
</div>