<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

# INICIAR SESION Y BORRAR DATA
session_start();
unset($_SESSION['arrCotiFl']);


?>

<!-- DATA LOAD AJAX -->


<table class="list" >
				<thead>
					<tr>
						<td>Item</td>
						<td>Tipo Orden</td>
						<td>Proveedor</td>
						<td>Moneda</td>
						<td>Monto</td>
						<td>Plazo</td>
						<td>OC/EW/OS</td>
						<td align="center" >Accion</td>
					</tr>
				</thead>
				<!--
				<tbody>
					<tr>
						<td>Item</td>
						<td>Clasificacion</td>
						<td>Producto</td>
						<td>Modelo</td>
						<td>Marca</td>
						<td>Moneda</td>
						<td>Cantidad</td>
						<td>Precio Unid.</td>
						<td>Total</td>
						<td>Proveedor</td>
						<td>Plazo</td>
						<td align="center" >
							<a href="Javascript:cc_openEditFl();" >Editar</a> |
							<a href="#">Eliminar</a>
						</td>
					</tr>
				</tbody>
				-->
</table>



