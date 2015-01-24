<?php
if($_POST['id']>0){
    empresa::edit('D',$_POST['id']);	
}
?>
<script language="javascript">
function Delete(id){
    if(confirm('Desea eliminar este registro?.')){
       $('#id').val(id); 
       $('#form1').submit();     
    }
}
</script>
<form name="form1" id="form1" action="index.php?menu=empresa_list" method="post">
<input type="hidden" name="id" id="id">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="order" id="order">
<input type="hidden" name="sort" id="sort">
<input type="hidden" name="qry" id="qry">
<input type="hidden" name="criterio" id="criterio">
<input type="hidden" name="flow" value="<?php echo $_SESSION['operador']['flow']?>">
<div class="box">
	<div class="heading">
    	<?=tbl_form_cab('L',2,0)?>		
	  	<div class="buttons">
			Buscar: <input id="filtro" name="filtro" size="45" type="text" />&nbsp;<a href="#" onClick="document.form1.submit();"><img src="images/buscar.png" title="Buscar"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <? echo tbl_opcion(2,'empresa_form','&perfil='.(int)$_GET['perfil'])?>
			<!--<a href="index.php?menu=personas_edit&a=I&perfil=<?=(int)$_GET['perfil']?>&empresa_id=<?=(int)$_GET['empresa_id']?>" class="button"><span style="width:50px;">Insertar</span></a>
			<a class="button" onclick="GetIds();//abrir('pers_perfil.php?ids=','P',300,150);"><span style="width:50px;">Perfil</span></a>-->
		</div>
    </div>
    <div class="content">
	<? echo tbl_criterio(2)?>    
    <?=tbl_lista(2);?>
    <?//=personas_lista();?>
		
	<div class="pagination">
		<div class="links">
		<?php echo paginacion();?>
		</div>
		<div class="results">
		<a href="#" onClick="ordenar('');return false;" title="Ayuda"><img src='images/ayuda.png'></a><img src="images/split_img.png">
	<a href="#" onClick="info('ajax.php?key=info_tabla&id=1');" title="Exportar"><img src="images/pdf.png"></a><img src="images/split_img.png">
	<a title="Exportar" href="exportar.php?filtro=<?=$_SESSION['operador']['filtro'];?>"><img src="images/excel.png"></a>
		</div>
	</div>


	
    </div>
  </div>
<script type="text/javascript"><!--
document.form1.filtro.focus();
//--></script> 
</form>

<div id="dialog" style="display:none;">

</div>