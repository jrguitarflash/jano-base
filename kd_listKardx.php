<!-- CSS -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css">

<!-- JS -->
<script type="text/javascript" src="js/kd_gesti.js" ></script>

<!-- Controller down -->
<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- Controller up -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<div class="box" >
	<div class="heading" >
		<h1>Kardex</h1>
		<div class="buttons" >
			<a id="kd_nuevKardx" >Nuevo</a>
			<ul id="lp_listExpor" >
				<li>
					<a href="#" >Exportar</a>
					<ul>
						<li><a href="Javascript:kd_geneRepo('pdf');" >pdf</a></li>
						<li><a href="Javascript:kd_geneRepo('excel');" >excel</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="content kd_lisKardx" >

		<!-- TIPOS DE MOVIMIENTOS -->
		<div class="kd_tipMov" >
			<input type="hidden" id="viewMenu" value="kd_listKardx" >
			<label id="lbl2" >Movimientos:</label>
			<select class="campo" id="kd_tipMovHist">
				<option value="1" >Entradas</option>
				<option value="2" >Salidas</option>
				<option value="3" >Interno</option>
			</select>
		</div>

		<!-- LISTA DE MOVIMIENTOS -->
		<table class="list" >
			<thead>
				<tr>
					<td>Codigo</td>
					<td>Movimiento</td>
					<td>Fecha</td>
					<td>N° Doc.</td>	
					<td>Empresa</td>
					<td>Producto</td>
					<td>Ubicacion</td>
					<td>EW</td>
					<td>Observacion</td>			
					<td></td>
				</tr>
			</thead>
			<tbody id="iniHistKardx_ajax" >
				<?php foreach($dataHistKardx as $data) { ?>
				<tr>
					<td><?php print $data['cod']; ?></td>
					<td><?php print $data['tipDocDes']." - ".$data['numDoc']; ?></td>
					<td><?php print $data['fechMov']; ?></td>
					<td><?php print $data['tipMovDes']; ?></td>
					<td><?php print $data['desMov']; ?></td>
					<td><?php print $data['empDes']; ?></td>
					<td><?php print $data['moneDes']; ?></td>
					<td><?php print $data['tot']; ?></td>
					<td align="center" >
						<a href="<?php print "Javascript:kd_direDetKardx(".$data['id'].")"; ?>">Detalle</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			<!--<tfoot></tfoot>-->
		</table>

	</div>
</div>