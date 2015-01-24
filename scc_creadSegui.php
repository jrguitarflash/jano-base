<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS JavaScript -->
<script type="text/javascript" src="js/scc_gesti.js" ></script>

<!-- Controller Down -->
<?php require('clases/controlador/controladorInf.class.php'); ?>

<!-- Controller Up -->
<?php require('clases/controlador/controladorSup.class.php'); ?>

<!-- Load -->
<input type="hidden" id="scc_creadSegui" >

<div id="scc_alertAjax" >
		<span  class="scc_alertLbl" >
			<img src="images/scc_venci.png" title="Seguimiento con ordenes vencidas" id="scc_alert">
			Seguimientos con ordenes a vencer esta semana:<span id="avenciSem" ></span>
		</span>
		<span  class="scc_alertLbl" >
			<img src="images/scc_avenci.png" title="Seguimiento con ordenes por vencer" id="scc_alert" >
			Seguimientos con ordenes vencidas:<span id="venciSem" ></span>
		</span>
</div>

<div class="box scc_aliBox" >
	<div class="heading" >
		<h1>Seguimiento de Centro</h1>
		<div class="buttons" >
			<a href="Javascript:scc_creadSegui_geneSegui();">
				<img src="images/scc_gene.png" width="25px" title="Generar seguimiento centro" >
			</a>
		</div>
	</div>
	<div class="content" >
			<label id="lbl2" >CC:</label>
			<form name="scc_creadSegui_frm" >
				<input type="hidden" name="accion" >
				<input type="hidden" name="accionId" >
			</form>
			<input class="campo" type="text"  id="centVal" >
			<input class="campo" type="hidden" id="centId"  name="centId" >
		<div id="scc_seguiCent" >
			<table class="list" >
				<thead>
					<tr>
						<td align="center" >Item</td>
						<td align="center" >SC</td>
						<td align="center" >CC</td>
						<td align="center" >Proyecto</td>
						<td align="center" >Detalle</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data_seguiGen as $data) { ?>
					<tr>
						<td align="center" ><?php print $data['item']; ?></td>
						<td align="center" ><?php print $data['sc']; ?></td>
						<td align="center" ><?php print $data['cc']; ?></td>
						<td><?php print $data['proyecto']; ?></td>
						<td align="center" >
							<a href="<?php print "Javascript:scc_creadSegui_dirDet('".$data['item']."')"; ?>" >
								<img src="images/scc_detail.png" width="20px" title="Detalle seguimiento" >
							</a>
							<a href="<?php print "Javascript:scc_creadSegui_eliSegui('".$data['item']."')"; ?>" >
								<img src="images/delete.png" width="20px" title="Eliminar" >
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>
	</div>
</div>
