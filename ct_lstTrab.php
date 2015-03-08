<!-- CONTROLLER DOWN -->
<?php require("clases/controlador/controladorInf.class.php"); ?>

<!-- CONTROLLER UP -->
<?php require("clases/controlador/controladorSup.class.php"); ?>

<div class="box" >

	<div class="heading" >
		<h1>Cumpleaños</h1>
	</div>
	
	<div class="content">

		<div class="buttons" >
			<a href="cronjob/ct_cronjob.php?cron=alertCump">Evaluar cumpleaños</a>
		</div>

		<table class="list" >
			<thead>
				<tr>
					<td>Item</td>
					<td>Trabajador</td>
					<td>Email</td>
					<td>Cumpleaños</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dataTrab as $data){ ?>
				<tr>
					<td><?php print $ind++; ?></td>
					<td><?php print $data['trabEw']; ?></td>
					<td><?php print $data['trabEmail']; ?></td>
					<td><?php print $data['trabFecAbrev']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

	</div>

</div>