<?php
include("include/comun.php");
session_start();
$id=(int)$_GET['id'];
//echo $_SESSION['SIS'][5];
$tabla_id=(int)$_GET['tbl_id'];

//echo $id." - ".$tabla_id;
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];
if($_POST['accion']>''){
	$id=tabla::tbl_edit_tbl($tabla_id,$_POST['id'],$_POST['accion']);
	// Id|Mensaje|jscript
        $return=explode("|", $id);
        $id=($return[0]>0)?$return[0]:$_POST['id'];
        
        if($return[2]>''){
            echo '<script>Javascript:'.$return[2].'</script>';
        }elseif($return[1] || $return[3]>''){
            $msj=($return[1]>'')?$return[1]:'001';
            $mensaje=1;
        }else{
            echo "<script>Javascript:window.parent.form_popup(0,'',0,0,'','',0,'');</script>";
        }
        
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles_popup.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<!--<script type="text/javascript" src="js/jquery.autocomplete.pack.js"></script>-->


<script language="javascript">
$(document).ready(function(){
	$("#form1").validate();
	$("#btnSave").click(function(){
			getCampFormat();
            $("#form1").submit();
	});
});
</script>
<?php
if($mensaje==1)
	{
		echo erp_notificacion($msj,$return[3]);
	}
?>
<div class="box">
    <div class="heading">
        <?=tbl_form_cab('F',$tabla_id,$id)?>
        <div class="buttons">
        <? echo tbl_form_opcion($tabla_id)?>
	</div>
    </div>
    <div class="content">
<?= tbl_form($tabla_id,$id,$accion)?>
    </div>
</div>
  
<div id="content"></div>

 </body></html>
 
<script language="javascript">
$('#ui-tabs').tabs(); 
function col_form(sw,accion,id,tabla_id){
	//alert(id);
	switch(sw){
		case 1:
			$('#dialogx').remove();
			$('#content').prepend('<div id="dialogx" style="padding: 3px 0px 0px 0px;"><iframe src="tabla_col_form.php?a='+accion+'&id='+id+'&tabla_id='+tabla_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#dialogx').dialog({
			title: 'Columna',
			bgiframe: false,
			width: 550,
			height: 380,
			resizable: false,
			close: function (event, ui) {
				window.location.reload();
			},
			modal: true

	});
			break;
		case 0:
			$('#dialogx').dialog('close');
			break;
	}
	
};
</script>
