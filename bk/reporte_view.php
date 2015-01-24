<?php
require_once ('clases/jpgraph/src/jpgraph.php');
require_once ('clases/jpgraph/src/jpgraph_bar.php');
 
$datay=array(12,8,27,3,10,5);
 
// Create the graph. These two calls are always required
$graph = new Graph(400,250);
$graph->SetScale('textlin');
 
// Add a drop shadow
$graph->SetShadow();
 
// Adjust the margin a bit to make more room for titles
$graph->SetMargin(40,30,20,40);
 
// Create a bar pot
$bplot = new BarPlot($datay);
 
// Adjust fill color
$bplot->SetFillColor('orange');
$graph->Add($bplot);
$bplot->value->Show();
$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
 
// Setup the titles
$graph->title->Set('Ventas 2013');
//$graph->xaxis->title->Set('X-title');
//$graph->yaxis->title->Set('Y-title');
 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Display the graph
@unlink("grafico.jpg");
$graph->Stroke("grafico.jpg");
$reg=reporte::edit("S",$_REQUEST['id']);

?>
<script language="javascript">

</script>
<form name="form1" id="form1" action="index.php?menu=reporte_view&menu_id=<?=$_REQUEST['menu_id']?>" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="accion" id="accion" />
<div class="box">
	<div class="heading">
    	<h1>Reporte - </h1>
	  	<div class="buttons">
                        <a class="button" href="exportar_xls_doc_fin.php?cliente_id=<?=$_REQUEST['cliente_id']?>&doc_fin_tipo_id=<?=$_REQUEST['doc_fin_tipo_id']?>"><span style="width:50px;">Exportar Excel</span></a>
                        <a class="button" target="_blank" href="export_pdf_doc.php?cliente_id=<?=$_REQUEST['cliente_id']?>&doc_fin_tipo_id=<?=$_REQUEST['doc_fin_tipo_id']?>"><span style="width:50px;">Exportar PDF</span></a>
			<a class="button icon print" onclick="Imprime('lista',800,600);"><span style="width:50px;">Imprimir</span></a>
			<!--<a class="button" href="#"><span style="width:50px;">Exportar</span></a>-->					
		</div>
    </div>
    <div class="content report">		
       <div id="lista">
           <table width="100%" border="0">
               <tr>
    <td><b><?=$_SESSION['SIS'][6]?></b></td>
  </tr>
  <tr>
    <td align="center"><h2><?=$reg['reporte_nombre']?></h2></td>
  </tr>
  
  <tr>
    <td align="center"><img src="grafico.jpg"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=reporte_view($_REQUEST['id']);?></td>
  </tr>
</table>
          
        </div>
    </div>
</div>
</form>