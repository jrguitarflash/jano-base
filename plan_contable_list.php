<?php
$tbl_id=$_GET['tbl_id'];
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form action="index.php?menu=plan_contable_list&menu_id=80" name="form1" method="post">
<input type="hidden" name="a">
<input type="hidden" name="id">
<input type="hidden" name="local_id" value="1" />
<div class="box">
<div class="heading">
    	<?=tbl_form_cab('L',$tbl_id,0)?>		
	  	<div class="buttons">
		<?=tbl_filtro($tbl_id)?>
			Buscar: <input id="filtro" name="filtro" size="30" type="text" value="<?//=$_SESSION['operador']['key']?>" />&nbsp;<a href="#" onclick="document.form1.submit();"><img src="images/buscar.png" title="Buscar"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <? echo tbl_opcion($tbl_id,'personas_edit','&perfil='.(int)$_GET['perfil'])?>


</div>
</div>	
    <div class="content">
    
    <?=plan_contable_lista(0);?>  
    </div>
</div>
</form>