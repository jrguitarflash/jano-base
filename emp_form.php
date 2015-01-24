<?php
$id=$_GET['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];
if($_POST['accion']>''){
	$id=tabla::tbl_edit_tbl(2,$_POST['id'],$_POST['accion']);
	$id=($id>0)?$id:$_POST['id'];
	$accion=($id>0 && $_POST['accion']=='I')?'U':$accion;
    $msj=1;	
}
?>
<script language="javascript">
$(document).ready(function(){
	$("#form1").validate();
	$("#btnSave").click(function(){		
		$("#form1").submit();
	});
});

</script>
<?php if($msj==1){echo erp_notificacion('001');} ?>
<div class="box">
    <div class="heading">
        <?=tbl_form_cab('F',2,$id)?>
        <div class="buttons">
        <? echo tbl_form_opcion(2)?>
	</div>
    </div>
    <div class="content">
<?=tbl_form(2,$id,$accion)?>
    </div>
  </div>
<script language="javascript">
$('#ui-tabs').tabs(); 
</script>