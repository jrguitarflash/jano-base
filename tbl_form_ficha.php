<?php
include("include/comun.php");
session_start();
$id=0;
$col_id=(int)$_GET['col_id'];
$tabla_id=(int)$_GET['tabla_id'];
$control_id=$_GET['control'];
$control_valor="valor_".$_GET['control'];

$col=tabla_col::edit('S',$col_id);
$objeto=explode('|',$col['fuente_tbl']); // tabla|id|valor|orden
$return_id=$objeto[1];
$return_valor=$objeto[2];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];

//Firebug for Mozilla
require_once('FirePHPCore/FirePHP.class.php'); 
ob_start();

if($_POST['accion']>'')
{
	$id=tabla::tbl_edit_tbl($tabla_id,$_POST['id'],$_POST['accion']);
        
        $reg=tabla::tbl_edit_tbl($tabla_id,$id,'S');
        
        $js="<script language='javascript'>";

        switch($col['col_control'])
        {

            case 'SRC':

            	$return_id=($return_id=='proveedor_id') ? 'empresa_id' : $return_id;
                
                if($dep=tabla_col::edit('E',$col['tabla_col_nombre']))
                {
                    foreach($dep as &$value)
                    {
                        $js.="window.parent.$('#".$value['tabla_col_nombre']."').load('ajax.php?a=select&col_id=".$value['tabla_col_id']."&valor=".$reg[$return_id]."');";
                    }
                }

                $js.="window.parent.$('#".$control_id."').val('".$reg[$return_id]."');";
                $js.="window.parent.$('#".$control_valor."').val('".$reg[$return_valor]."');";
                
            break;
        }

        $js.="window.parent.$('#dialog').dialog('close');";
        $js.="</script>";

       //Vars for Test

       $firephp = FirePHP::getInstance(true);
	   //$var = array('i'=>10, 'j'=>20);
	   $firephp->log($value['tabla_col_id'], 'vars');
                                    
	echo $js;
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
<!--<script type="text/javascript" src="js/jquery.autocomplete.pack.js"></script>-->


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
        <?=tbl_form_cab('F',$tabla_id,$id)?>
        <div class="buttons">
        <? echo tbl_form_opcion($tabla_id)?>
	</div>
    </div>
    <div class="content">
<?=tbl_form($tabla_id,$id,$accion)?>
    </div>
</div>
      
 </body></html>
 
<script language="javascript">
$('#ui-tabs').tabs(); 
function col_form(sw,accion,id,tabla_id){
	//alert(id);
	switch(sw){
		case 1:
			$('#dialogx').remove();	
			$('#contentx').prepend('<div id="dialogx" style="padding: 3px 0px 0px 0px;"><iframe src="tabla_col_form.php?a='+accion+'&id='+id+'&tabla_id='+tabla_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
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
