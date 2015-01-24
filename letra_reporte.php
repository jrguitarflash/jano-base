<!-- //---- ESTILOS DECORADOR AÑADIDOS-----// -->
<link rel="stylesheet" type="text/css" href="styles/decorador.css" />

<!--//-------JS GESTIONADOR AÑADIDOS-----------------//-->
<script type="text/javascript" src="js/gestionador4.js"></script>

<?php
	if($_REQUEST['tipo']==1){ // Cliente
	$titulo="Letras por cobrar";
	}else{
	$titulo="Letras por pagar";
}
?>

<form name="form1" id="form1" action="index.php?menu=letra_reporte&menu_id=<?=$_REQUEST['menu_id']?>&tipo=<?=$_REQUEST['tipo']?>" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="accion" id="accion" />
<div class="box">
<?php if($_GET['menu_id']!=71) { ?>
	<div class="heading">
    	<h1>Reporte - <?=$titulo?></h1>
	  	<div class="buttons">
                    <a class="button" href="exportar_xls_letras.php?tipo=<?=$_REQUEST['tipo']?>&cliente_id=<?=$_REQUEST['cliente_id']?>&proveedor_id=<?=$_REQUEST['proveedor_id']?>&banco_id=<?=$_REQUEST['banco_id']?>"><span style="width:50px;">Exportar Excel</span></a>
                    <a class="button" target="_blank" href="export_pdf_letras.php?tipo=<?=$_REQUEST['tipo']?>"><span style="width:50px;">Exportar PDF</span></a>
                    <a class="button icon print" onclick="Imprime('lista',800,600);"><span style="width:50px;">Imprimir</span></a>
			<!--<a class="button" href="#"><span style="width:50px;">Exportar</span></a>-->					
		</div>
    </div>
    <div class="content report">
    <table width="100%" class="list">
         <tr class="filter">
            <td>
				<?php if($_REQUEST['tipo']==2){?>
				Proveedor: <select name="proveedor_id" id="proveedor_id" onchange="document.form1.submit()"><?=proveedor_ddl($_REQUEST['proveedor_id'])?></select>
				<?php }else{ ?>
				Cliente: <select name="cliente_id" id="cliente_id" onchange="document.form1.submit()"><?=cliente_ddl($_REQUEST['cliente_id'])?></select>
				<?php } ?>
				&nbsp;&nbsp;
				Banco: <select id="banco_id" name="banco_id" onchange="document.form1.submit()"><?=banco_ddl($_REQUEST['banco_id'])?></select>&nbsp;&nbsp;&nbsp;
            Fecha :
            <select name="fecha_filtro" id="fecha_filtro">
            	<?=letra_fecha_filtro($_REQUEST['fecha_filtro'])?>
            </select> 
            <input size="12" type="text" name="fecha_valor" id="fecha_valor" value="<?=$_REQUEST['fecha_valor']?>">&nbsp;&nbsp;&nbsp;
            </td>               
         </tr>
     </table>
	  <div id="lista">
	    	<?=letra_lista_reporte($_REQUEST['tipo']);?>  
	  </div>
    </div>
<?php } else { ?>

<?php require('clases/controlador/controladorSup.class.php'); ?>
<?php require('clases/controlador/controladorInf.class.php'); ?>

	<div class="heading">
    	<h1>Reporte - Letras por pagar</h1>
	  	<div class="buttons">
	  		<?php $funTare=negocio::tareGenCuenxPag(); ?>
			<a class="button" href="<?php print $funTare; ?>"><span class="expExcel">Exportar Excel</span></a>
		</div>
   </div>
  	<div class="content report">
			<label class="dreamsFin">:)...</label>
			    <table width="100%" class="list">
         <tr class="filter">
            <td>
					<label>Fecha Inicio:</label>
					<input type="text" name="fechIni" id="fechIni"> 
            	<label>Fecha Fin:</label>
            	<input type="text" name="fechFin" id="fechFin">
            	<input type="hidden" name="opci" value="">
            	<a class="button" href="Javascript:clearFechas();"><span class="expExcel">Limpiar</span></a>
            	<a class="button" href="Javascript:getBusCuenxPag('fech');"><span class="expExcel">Buscar</span></a>
            	<a class="button" href="Javascript:getBusCuenxPag('tod');"><span class="expExcel">Todos</span></a>
            </td>               
         </tr>
     </table>
     <div class="lista">
			<table class="list">
				  <thead>
					  <tr align="center">
						  	<td rowspan="1" align="center" valign="middle">ID</td>
						  	<td rowspan="1" align="center" valign="middle">Empresa</td>
						  	<td rowspan="1" align="center" valign="middle">Monto</td>
						  	<td rowspan="1" align="center" valign="middle">Moneda</td>
						   <td rowspan="1" align="center" valign="middle">Fecha emision</td>
						   <td rowspan="1" align="center" valign="middle">Accion</td>
					  </tr>
				  </thead>
				  <tbody>
				  		<?php foreach($dataCuenxPag as $data){ 
							$acciGene="Javascript:geneExcelCuenxPag('".$data['letId']."');";				  		
				  		?>
			  			<tr>
					      <td class="right"><?php print $data['letId']; ?></td>
					      <td class="center"><?php print $data['empre']; ?></td>
					      <td class="right"><?php print $data['mont']; ?></td>
					      <td class="right"><?php print $data['mone']; ?></td>
					      <td class="right"><?php print $data['fechEmi']; ?></td>
					      <td class="center"><a href="<?php print $acciGene; ?>" ><img src="images/geneExcel.png" class="icoRe" alt="excel" >Generar excel</a></td>
			         </tr>
			         <?php } ?>
		        </tbody>
        </table>       
     </div>
	</div>

<?php } ?>      

</div>
</form>
<script>
    Calendario2('fecha_valor');
</script>