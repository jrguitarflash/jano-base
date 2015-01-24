<?php


?>

<form name="form1" id="form1" action="index.php?menu=cotizacion_reporte&menu_id=<?=$_REQUEST['menu_id']?>" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="accion" id="accion" />
<div class="box">
	<div class="heading">
    	<h1>Informe de Proyectos</h1>
	  	<div class="buttons">
                        <a class="button" href="exportar_cotizacion_xls.php?cot_estado_id=<?=$_REQUEST['cot_estado_id']?>"><span style="width:50px;">Exportar Excel</span></a>
			<a class="button icon print" onclick="Imprime('lista',800,600);"><span style="width:50px;">Imprimir</span></a>
			<!--<a class="button" href="#"><span style="width:50px;">Exportar</span></a>-->					
		</div>
    </div>
    <div class="content report">
		<table width="100%" class="list">
              <tr class="filter">
                <td>Estado: 
                  <select id="cot_estado_id" name="cot_estado_id" onchange="document.form1.submit();"><?=cot_estado_ddl($_REQUEST['cot_estado_id'])?></select> 
                  Responsable: 
                  <select name="responsable_id" id="responsable_id" onchange="document.form1.submit();"><?=trabajador_ddl($_REQUEST['responsable_id'])?></select> 
                  Fecha:
                  <input name="desde" type="text" id="desde" size="12" value="<?=$_REQUEST['desde']?>" />
                  a 
                  <input name="hasta" type="text" id="hasta" size="12" value="<?=$_REQUEST['hasta']?>" /></td>
              </tr>
            </table>
        <div id="lista">
			
          <?=cotizacion_informe();?>
        </div>
    </div>
</div>
</form>
<script language="javascript">
Calendario2('desde');
Calendario2('hasta');
</script>