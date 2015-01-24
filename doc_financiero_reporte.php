<?php


?>
<script language="javascript">

</script>
<form name="form1" id="form1" action="index.php?menu=doc_financiero_reporte&menu_id=<?=$_REQUEST['menu_id']?>" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="accion" id="accion" />
<div class="box">
	<div class="heading">
    	<h1>Reporte - Documentos Financieros</h1>
	  	<div class="buttons">
                        <a class="button" href="exportar_xls_doc_fin.php?cliente_id=<?=$_REQUEST['cliente_id']?>&doc_fin_tipo_id=<?=$_REQUEST['doc_fin_tipo_id']?>"><span style="width:50px;">Exportar Excel</span></a>
                        <a class="button" target="_blank" href="export_pdf_doc.php?cliente_id=<?=$_REQUEST['cliente_id']?>&doc_fin_tipo_id=<?=$_REQUEST['doc_fin_tipo_id']?>"><span style="width:50px;">Exportar PDF</span></a>
			<a class="button icon print" onclick="Imprime('lista',800,600);"><span style="width:50px;">Imprimir</span></a>
			<!--<a class="button" href="#"><span style="width:50px;">Exportar</span></a>-->					
		</div>
    </div>
    <div class="content report">
		<table width="100%" class="list">
              <tr class="filter">
                <td>Cliente: <select name="cliente_id" id="cliente_id" onchange="document.form1.submit()"><?=cliente_ddl($_REQUEST['cliente_id'])?></select>&nbsp;&nbsp;Tipo: <select id="doc_fin_tipo_id" name="doc_fin_tipo_id" onchange="document.form1.submit();"><?=doc_fin_tipo_ddl($_REQUEST['doc_fin_tipo_id'])?></select></td>               
              </tr>
            </table>
        <div id="lista">
			
          <?=doc_financiero_lista_reporte();?>
        </div>
    </div>
</div>
</form>