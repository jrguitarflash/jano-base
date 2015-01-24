<?php 

require("../conf.php");
require("../clases/sql/sql.class.php");
require("../clases/negocio/negocio.class.php");

switch($_POST['ajax'])
{
	case 'detAdel':
		$sql=sql::scc_detAdelOrd($_POST['idSegui'],$_POST['idOrd']);
		$data_detAdelOrd=negocio::getData($sql);
	break;

	case 'detSegui':
		$sql=sql::scc_seguiOrdProye($_POST['idSegui'],$_POST['idOrd']);
		$data_seguiOrdProye=negocio::getData($sql);
	break;

	case 'detSegui2':
		$sql=sql::scc_seguiOrdPlaz($_POST['idSegui']);
		$data_seguiOrdPlaz=negocio::getData($sql);
		$i=1;
		$j=0;
		$colorArr=array("#6E7ABB",
						"#002957",
						"#00B8B0",
						"#E1D307",
						"#004023",
						"#84BB4C",
						"#E2CF70",
						"#F0533F",
						"#EC80B3",
						"#893373",
						"#8869AE",
						"#CAAA77",
						"#CAAA77",
						"#A12836",
						"#F47920");
	break;

	default:
	break;
}

?>

<?php if($_POST['ajax']=='detAdel') { ?>

		<table class="list" >
			<thead>
				<tr>
					<td>N°</td>
					<td>Tipo</td>
					<td>Fecha</td>
					<td>Descripcion</td>
					<td align="center" >Accion</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data_detAdelOrd as $data) { ?>
				<tr>
					<td><?php print $data['ordTip'] ?></td>
					<td><?php print $data['tipAdel']; ?></td>
					<td><?php print $data['fechAdel']; ?></td>
					<td><?php print $data['desAdel']; ?></td>
					<td align="center" >
						<a href="<?php print "Javascript:scc_detSegui_json4('".$data['idAdel']."');" ?>" >
							<img src="images/scc_detail.png" width="20px" title="Editar" >
						</a>
						<a href="<?php print "Javascript:scc_detSegui_json3('".$data['idAdel']."');" ?>" >
							<img src="images/delete.png" width="20px" title="Eliminar" >
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			<tfoot></tfoot>
		</table>

<?php } else if($_POST['ajax']=='detSegui') { ?>


		<table class="list" >
			<thead>
				<tr>
					<td colspan="4" align="right">
						<a href="Javascript:scc_detSegui_json7();" id="scc_opciVali" >Validar</a>&nbsp;|
						<a href="Javascript:scc_detSegui_json8();" id="scc_opciVali" >Revertir</a>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>Seguimiento</td>
					<td>Fecha</td>
					<td align="center" >Validacion</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data_seguiOrdProye as $data) { ?>
				<tr>
					<td align="center" ><input type="checkbox" value="<?php print $data['idValid']; ?>" name="idValid[]" id="idValid" ></td>
					<td><?php print $data['tipValid']; ?></td>
					<td><?php print $data['fechValid']; ?></td>
					<td align="center" ><img src="<?php print $data['rutImg']; ?>" title="<?php print $data['estaValid']; ?>" ></td>
				</tr>
				<?php } ?>
			</tbody>
			<tfoot></tfoot>
		</table>

<?php } else if($_POST['ajax']=='detSegui2') { ?>

		<table class="list" >
			<thead>
				<tr>
					<td colspan="22" >SEGUIMIENTO DE ORDENES</td>
				</tr>
				<tr>
					<td colspan="8" ></td>
					<td>A</td>
					<td>B</td>
					<td>C</td>
					<td>D</td>
					<td>E</td>
					<td>F</td>
					<td>G</td>
					<td>H</td>
					<td>I</td>
					<td>J</td>
					<td>K</td>
					<td>L</td>
					<td>M</td>
					<td>N</td>
				</tr>
				<tr>
					<td>Color</td>
					<td>N° de orden</td>
					<td>Fecha partida</td>
					<td>Plazo</td>
					<td>Fecha entrega</td>
					<!--<td>Fecha entrega</td>-->
					<td>Fecha entrega real</td>
					<td>Dias para vencer</td>
					<td>Dias vencidos</td>
					<td>Envio de planos del proveedor</td>
					<td>Aprobacion de planos del cliente</td>
					<td>Adelanto del cliente</td>
					<td>Envio de planos aprobados al proveedor</td>
					<td>Pago de adelanto al proveedor</td>
					<td>Inicio de fabricacion</td>
					<td>Recepcion de protocolos de prueba</td>
					<td>Validacion de protocolos por parte de Electrowerke</td>
					<td>Entrega de equipo</td>
					<td>Arrivo de equipo a puerto de callao</td>
					<td>Nacionalizacion y entrega en nuestros almacenes</td>
					<td>Control de calidad interno</td>
					<td>Entrega final de los equipos en sus almacenes</td>
					<td>Salida almacen EW cliente</td>
				</tr>	
			</thead>
			<tbody>
				<?php foreach($data_seguiOrdPlaz as $data) { ?>
				<tr>
					<td style="<?php print 'background-color:'.$colorArr[$j++]; ?>" ></td>
					<td><?php print $data['ordDes']; ?></td>
					<td><?php print $data['fechParti']; ?></td>
					<td><?php print $data['plazo']; ?></td>
					<!--<td rowspan="2" ><?php #print $data['fechaActual']; ?></td>-->
					<td><?php print $data['fechEntreEsti']; ?></td>
					<td>
						<input type="text" size="9" name="fechReal[]" id="<?php print "fechReal_".$i++; ?>" value="<?php print $data['fechReal']; ?>">
						<input type="hidden" size="8" name="fechReal2[]" id="<?php print "fechReal2"; ?>" value="<?php print $data['ordId']; ?>" >
					</td>
					<td><?php print $data['diasVencer']; ?></td>
					<td><?php print $data['diasVencidos']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s1']); ?>"> <?php print $data['f1']; ?> </td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s2']); ?>"><?php print $data['f2']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s3']); ?>"><?php print $data['f3']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s4']); ?>"><?php print $data['f4']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s5']); ?>"><?php print $data['f5']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s6']); ?>"><?php print $data['f6']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s7']); ?>"><?php print $data['f7']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s8']); ?>"><?php print $data['f8']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s9']); ?>"><?php print $data['f9']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s10']); ?>"><?php print $data['f10']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s11']); ?>"><?php print $data['f11']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s12']); ?>"><?php print $data['f12']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s13']); ?>"><?php print $data['f13']; ?></td>
					<td><img src="<?php print negocio::scc_evaEstaSegui($data['s14']); ?>"><?php print $data['f14']; ?></td>
				</tr>
				<!--
				<tr>
					<td><strong>Proveedor</strong></td>
					<td><?php #print $data['fechProvParti']; ?></td>
					<td><?php #print $data['plazoFabri']; ?></td>
					<td><?php #print $data['fechProvEsti']; ?></td>
					<td>0</td>
					<td><?php #print $data['diasVencerProv']; ?></td>
					<td><?php #print $data['diasVencidosProv']; ?></td>
				</tr>
				-->
				<?php } ?>
			</tbody>
			<tfoot>
				<tr></tr>
			</tfoot>	
		</table>

<?php } else {?>

<?php } ?>