<?php


?>
<script language="javascript">

</script>
<form name="form1" id="form1" action="index.php?menu=cobranza_reporte&menu_id=<?=$_REQUEST['menu_id']?>" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="accion" id="accion" />
<div class="box">
	<div class="heading">
    	<h1>Reporte - Cobranzas </h1>
	  	<div class="buttons">
                        <a class="button" href="exportar_xls_cobranza.php?cliente_id=<?=$_REQUEST['cliente_id']?>"><span style="width:50px;">Exportar Excel</span></a>
                        <a class="button" target="_blank" href="export_pdf_cobranza.php?cliente_id=<?=$_REQUEST['cliente_id']?>"><span style="width:50px;">Exportar PDF</span></a>
			<a class="button icon print" onClick="Imprime('lista',800,600);"><span style="width:50px;">Imprimir</span></a>
			<!--<a class="button" href="#"><span style="width:50px;">Exportar</span></a>-->					
		</div>
    </div>
    <div class="content report">
		<table width="100%" class="list">
              <tr class="filter">
                <td>Cliente: <select name="cliente_id" id="cliente_id" onChange="document.form1.submit()"><?=cob_cliente_ddl($_REQUEST['cliente_id'])?></select>&nbsp;&nbsp;Fecha: <input name="fecha" id="fecha" type="text" value="<?=$_REQUEST['fecha']?>"></td>               
              </tr>
            </table>
        <div id="lista">
			
          <?=cobranza_lista_reporte();?>
        </div>
    </div>
</div>
</form>
<script language="javascript">
Calendario2('fecha');
</script>