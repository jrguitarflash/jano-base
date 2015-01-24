<?php
$reg=tabla::tabla_edit('E',(int)$_GET['tabla_id']);
?>
<div class="box">
	<div class="heading">
    	<h1>Mantenimiento Tablas</h1>
	  	<div class="buttons">			
			<!--<a class="button" href="#"><span>Imprimir</span></a>-->
		</div>
    </div>
    <div class="content">
<form id₧"form1" name="form1" method="post">
<table width="100%" border="0" class="form">
  <tr>
    <td width="150" rowspan="4" valign="top"><?=mantenimiento_lista($_GET['tbl_menu'])?></td>
    <td width="79"></td>
    <td width="492"></td>
  </tr>
  <?
  if($_GET['tabla_id']>0){
  ?>
  <tr>
    <td width="79" valign="top">Nombre:</td>
    <td valign="top"><b><?=$reg['tbl_alias']?></b></td>
  </tr>
  <tr>
    <td valign="top">Descripción:</td>
    <td valign="top"><b><?=$reg['tbl_desc']?></b></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
        <div id="lista_<?=$_GET['tabla_id']?>">
            
	<?
	
		echo tbl_lista($_GET['tabla_id']);	
	
	?>
        </div>
	<div id="tabla_lista"></div></td>
    </tr>
   <?
   }else{
   echo '<tr><td colspan="2" align="center"><font color="red">Seleccione una tabla !!!.</td></tr>';
   }
   ?>
</table></form>
    </div>
  </div>