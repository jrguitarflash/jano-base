<?php
include("include/comun.php");
$id=$_GET['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];
if($_POST['accion']>''){
	$id=tabla::tbl_edit_tbl($_GET['tbl_id'],$_POST['id'],$_POST['accion']);
	$id=($id>0)?$id:$_POST['id'];
	$accion=($id>0 && $_POST['accion']=='I')?'U':$accion;
    $msj=1;	
}
?>
<html>
<head><title></title></head>

<script language="javascript">
$(document).ready(function(){
	$("#form1").validate();
	$("#btnSave").click(function(){		
		$("#form1").submit();
	});
});

</script>
<?php if($msj==1){?><div class="success">Datos Grabados</div><? } ?>
<div class="box">
    <div class="heading">
        <?=tbl_form_cab('F',$_GET['tbl_id'],$id)?>
        <div class="buttons">
        <? echo tbl_form_opcion($_GET['tbl_id'])?>
	</div>
    </div>
    <div class="content">
<?=tbl_form($_GET['tbl_id'],$id,$accion)?>
    </div>
  </div>
<script language="javascript">
$('#ui-tabs').tabs(); 
</script>
</body>
</html>