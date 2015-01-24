<?php
	echo "<span style='display:none' >Aqui se creara el modulo de reportes de cobranzas............... \m/ !</span>";
?>

<div class="box">
	<div class="heading" >
			<h1>Cobranzas - Lista</h1>
			<div class="buttons" >
				<a href="index.php?menu_id=117&menu=reporte_xcobrar_nuevo" ><img src="images/add.png" title="Agregar cobranza" width="18px"></a>
			</div>	
	</div>
	<div class="content" >

		<table class="list asigFact" >
			<thead>
				<tr>
					<td></td>
					<td>N° cobranza</td>
					<td>Fecha</td>
					<td>Descripcion</td>
					<td>Cliente</td>
					<td>Monto a cobrar</td>
					<td>Monto cobrado</td>
					<td align="center">Accion</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align="center"><input type="checkbox" ></td>
					<td>COB-00001</td>
					<td>19/02/2014</td>
					<td>Venta de equipos</td>
					<td>Cliente</td>
					<td>20000</td>
					<td>15000</td>
					<td align="center">
						<a href="#"><img src="images/detail.png" title="Ver detalle" width="18px"></a>
						<a href="#"><img src="images/b_edit.png" title="Editar factura" width="18px" ></a>
						<a href="#"><img src="images/b_drop.png" title="Eliminar factura" width="18px" ></a>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>


