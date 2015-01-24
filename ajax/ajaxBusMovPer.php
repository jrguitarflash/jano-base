<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

/* CARGANDO DATA CON FILTRO */

if($_POST['perId']=='Todos' and $_POST['fechSali']!='')
{
	$sql=sql::mp_movPerShowxAreFech($_POST['fechSali'],$_POST['areId']);
	$dataMovPer=negocio::getData($sql);
}
else if($_POST['perId']=='Todos' and $_POST['fechSali']=='')
{
	$sql=sql::mp_movPerShowxAre($_POST['areId']);
	$dataMovPer=negocio::getData($sql);
}
else if($_POST['fechSali']=='')
{
	$sql=sql::mp_movPerShowxTrab($_POST['perId']);
 	$dataMovPer=negocio::getData($sql);
}
else
{
	$sql=sql::mp_movPerShowxTrabFech($_POST['fechSali'],$_POST['perId']);
	$dataMovPer=negocio::getData($sql);
}

$mp_style=negocio::mp_evaExisData($dataMovPer);

?>

<!-- AJAX LOAD DATA -->

<table class="list" >
	<thead>
		<tr>
			<td rowspan="2">item</td>
			<td rowspan="2">Usuario</td>
			<td rowspan="2">Area</td>
			<td rowspan="2">Fecha Salida</td>
			<td rowspan="2">Fecha Retorno</td>
			<td rowspan="2">Hora Salida</td>
			<td rowspan="2">Hora Retorno</td>
			<td rowspan="2">Ubicacion</td>
			<td colspan="3" rowspan="1">Gastos</td>
			<td align="center" rowspan="2">Movimientos</td>
			<td rowspan="2">Estado</td>
			<td rowspan="2">Accion</td>
		</tr>
		<tr>
			<td>S/.</td>
			<td>$</td>
			<td>€</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dataMovPer as $data){ ?>
		<tr>
			<td><?php print $data['item']; ?></td>
			<td><?php print $data['user']; ?></td>
			<td><?php print $data['are']; ?></td>
			<td><?php print $data['fechSali']; ?></td>
			<td><?php print $data['fechRetor']; ?></td>
			<td><?php print $data['hourSali']; ?></td>
			<td><?php print $data['hourRetor']; ?></td>
			<td><span class="<?php print $data['classUbi']; ?>" ><?php print $data['desUbi']; ?></span></td>
			<td><?php print $data['totSol']; ?></td>
			<td><?php print $data['totDol']; ?></td>
			<td><?php print $data['totHeb']; ?></td>
			<td align="center" >
				<a href="<?php print "Javascript:mp_openPopup1('".$data['item']."');"; ?>"><?php print $data['cantMov']; ?></a>
			</td>
			<td align="center" >
				<img src="<?php print $data['imagEst']; ?>" width="30px" title="<?php print $data['desEst']; ?>"  >
			</td>
			<td align="center">
				<img src="images/mp_validate.png" width="25px" title="Validar"  onclick="<?php print "mp_openPopup3('".$data['item']."')"; ?>" >
				<img src="images/mp_return.png" width="25px" title="Confirmar retorno" onclick="<?php print "mp_jsonAprobMov('".$data['item']."','confirm')"; ?>">
				<img src="images/mp_money.png" width="25px" title="Rendir" onclick="<?php print "mp_openPopup4('".$data['item']."')"; ?>" >
			</td>
		</tr>
		<?php }?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="10" align="center" id="<?php print $mp_style; ?>" >
				No se encontraron resultados...!
			</td>
		</tr>
	</tfoot>
</table>

