<?php

$mes=($_REQUEST['mes_id']>0)?$_REQUEST['mes_id']:date('m');
?>

<form name="form1" id="form1" action="index.php?menu=compras_reportes&menu_id=<?=$_REQUEST['menu_id']?>" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="accion" id="accion" />
<div class="box">
	<div class="heading">
    	<h1>Informe de Compras</h1>
	  	<div class="buttons">
                        <a class="button" href="exportar_xls_compras.php?mes_id=<?=$mes?>&tipo=<?=$_REQUEST['tipo']?>"><span style="width:50px;">Exportar Excel</span></a>
			<a class="button icon print" onclick="Imprime('lista',800,600);"><span style="width:50px;">Imprimir</span></a>
			<!--<a class="button" href="#"><span style="width:50px;">Exportar</span></a>-->					
		</div>
    </div>
    <div class="content report">
		<table width="100%" class="list">
              <tr class="filter">
                <td>Mes: 
                    <select name="mes_id" id="mes_id" onchange="document.form1.submit();"><?=mes_ddl($mes)?></select> &nbsp;&nbsp;Compras: <select name="tipo" id="tipo" onchange="document.form1.submit();"><?=compras_tipo_ddl($_REQUEST['tipo'])?></select></td>
              </tr>
            </table>
        <div id="lista">
			
          <?=compras_reporte(date("Y"),$mes);?>
        </div>
    </div>
</div>
</form>