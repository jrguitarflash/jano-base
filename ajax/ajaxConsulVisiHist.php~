<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//echo $_POST['val'];

//print_r($_POST['filVisi']);


session_start();
$_SESSION['filVisi']=$_POST['filVisi'];
$_SESSION['filVal']=$_POST['filVal'];

switch($_POST['filVisi']) 
{
	case 'fech':
		$sql=sql::getVisitasxFech($_POST['filVal'][0]);
		$dataVisi=negocio::getData($sql);
	break;
	
	case 'cli':
		$sql=sql::getVisitasxCli($_POST['filVal'][0]);
		$dataVisi=negocio::getData($sql);
	break;
	
	case 'ven':
		$sql=sql::getVisitasxVen($_POST['filVal'][0]);
		$dataVisi=negocio::getData($sql);
	break;
	
	case 'fech-cli':
		$sql=sql::getVisitasxFechxCli($_POST['filVal'][0],$_POST['filVal'][1]);
		$dataVisi=negocio::getData($sql);
	break;
	
	case 'fech-ven':
		$sql=sql::getVisitasxFechxVen($_POST['filVal'][0],$_POST['filVal'][1]);
		$dataVisi=negocio::getData($sql);
	break;
	
	case 'fech-cli-ven':
		$sql=sql::getVisitasxFechxClixVen($_POST['filVal'][0],$_POST['filVal'][1],$_POST['filVal'][2]);
		$dataVisi=negocio::getData($sql);
	break;
	
	default:
	break;
}

?>

<ul class="listHist">
	<?php foreach($dataVisi as $data){
		$sql=sql::getTrabVendedorxId($data['idVendeVisita']); 
		$idVisi=$data['tbvisi_visita_id'];	
		$fechIni=$data['fechIniVisi'];
		$fechFin=$data['fechFinVisi'];
		$vend=negocio::getVal($sql,'vendedor');
		$linkScript="Javascript:getReporVisi(".$idVisi.",'".$fechIni."','".$fechFin."','".$vend."');";
		$linkEli="Javascript:ajaxEliVisi('".$data['tbvisi_visita_id']."')";									
	?>
		<li>
			<a href="<?php print $linkScript; ?>" class="linkHistVisi"><?php print $data['fechIniVisi']." | ".$data['fechFinVisi']; ?></a>
			<?php if($_SESSION['SIS'][2]==46) { ?>			
				<a href="<?php print $linkEli ?>" ><img src="images/delete.png" >Eliminar</a>
			<?php } ?>
		</li>
	<?php } msjEncon($dataVisi);?>				
</ul>


<?php 
function msjEncon($dataVisi)
{
	if(count($dataVisi)==0) 
	{
		print "<label>No resultados encontrados...</label>";
	}
} 
?>