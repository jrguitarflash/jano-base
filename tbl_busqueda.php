<?php
include("include/comun.php");
$id=(int)$_GET['tbl_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Columnas</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style type="text/css">
html {
	margin: 0 2px 0 2px;
	padding: 0;
}
body {
	margin: 0 2px 0 2px;
	padding: 0;	
	background: #CCCCCC;
}
table{	
        font-family:Arial, Helvetica, sans-serif;
        font-size:11px;
}
.error {
	float: none; color: red; vertical-align: middle; 	
}
</style>
<script language="javascript">
function Busqueda(tabla_id){
    var Data = {};
    $('select').each(function(){
        //alert($(this).attr('id')+'='+$(this).attr('value'));
        Data[$(this).attr('id')] = $(this).attr("value");        
    });    
    $('input:text').each(function(){
        Data[$(this).attr('id')] = $(this).val();
    });    
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=lst_busqueda&tabla_id='+tabla_id,
        data:Data,
        dataType: 'json',
        success: function(data) {
            if(data.mensaje){
               //alert(data.mensaje);
               window.parent.BusquedaAvanzada(data.mensaje);
            }            
        }
    });
}
</script> 
</head>

<body>
    <form name="form1" id="form1" method="get">      
    <?=tbl_busqueda_avanzada($id)?>
    </form>
</body>
</html>
<script language="javascript">
$('#ui-tabs').tabs(); 
</script> 