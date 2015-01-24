<!-- 3. Listado de cotizaciones de servicios -> cs_lisCot -->

<!--  JS GESTIONADOR -->
<script type="text/javascript" src="js/cs_gesti.js?modojs=3" id="modojs" ></script>

<!-- CSS DECORADOR -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- PHP CONTROLADORES -->

<!-- CONTROLADOR INFERIOR-->
<?php require_once('clases/controlador/controladorInf.class.php'); ?>

<!-- CONTROLADOR SUPERIOR-->
<?php require_once('clases/controlador/controladorSup.class.php'); ?>

<div class="box" >
	<div class="heading" >
		<h1>Cotizaciones de Servicios</h1>
	</div>
	<div class="content" >
		<table class="list" >
			<thead>
				<tr>
					<td colspan="11" align="right">
						<img width="20px" title="Crear cotizacion de servicios" src="images/add.png" onclick="cs_loadEvent('nuevCoti');"></img>
					</td>
				</tr>
				<tr>
					<td align="center" >FS</td>
					<td>Fecha</td>
					<td>Cliente</td>
					<td>Resp. Comercial</td>
					<td>Resp. Tecnico</td>
					<td>Descripcion</td>
					<td>Prioridad</td>
					<td>Estado</td>
					<td>Moneda</td>
					<td>Total</td>
					<td align="center" >Accion</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dataCotServ as $data){ ?>
				<tr>
					<td align="center" ><a href="<?php print "Javascript:cs_loadEvent('ejeRepoCot','".$data['item']."','')"; ?>" ><?php print $data['fs']; ?></a></td>
					<td><?php print $data['fech']; ?></td>
					<td><?php print $data['empre']; ?></td>
					<td><?php print $data['respo']; ?></td>
					<td><?php print $data['respoTecni']; ?></td>
					<td><?php print $data['des']; ?></td>
					<td><?php print $data['priori']; ?></td>
					<td><?php print $data['esta']; ?></td>
					<td><?php print $data['moneDes']; ?></td>
					<td><?php print $data['tot']; ?></td>
					<td align="center" >
						<img src="images/b_edit.png" width="20px" 
							title="Editar cotizacion" 
							onclick="<?php print "Javascript:cs_loadEvent('visuDetCot','".$data['item']."','')"; ?>">
					</td>
				</tr>
				<?php }?>
			</tbody>
			<!--
			<tfoot></tfoot>
			-->
		</table>
	</div>
</div>

<!--  POPUP DIALOG 2 -->
<div id="dialog2"  title="Reporte cotizacion servicio" >
	<iframe src="" id="cs_reporCorServ" width="100%" height="500px" ></iframe>
</div>