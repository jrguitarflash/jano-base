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
        //alert($(this).val());
    });    
    $('input:text').each(function(){
        Data[$(this).attr('id')] = $(this).val();
        //alert($(this).val());
    });    
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=lst_busqueda_producto&tabla_id='+tabla_id,
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
      <table width="100%" >
        <tr>
          <td align="center"><strong>Catálogo de Producto </strong></td>
        </tr>
        <tr>
          <td><select name="cond1" id="cond1"><?=tbl_filtro_ope(1);?></select>            <select name="campo1" id="campo1">
            <?=tbl_col_ddl($id);?>
          </select>          <select name="ope1" id="ope1">
          <?=tbl_filtro_ope(2);?>
          </select>          <input name="valor1" type="text" id="valor1" size="40" /></td>
        </tr>
        <tr>
          <td><select class="cond" name="cond2" id="cond2">
            <?=tbl_filtro_ope(1);?>
          </select>          <select name="campo2" id="campo2">
            <?=tbl_col_ddl($id);?>
          </select>          <select name="ope2" id="ope2">
            <?=tbl_filtro_ope(2);?>
          </select>          <input name="valor2" type="text" id="valor2" size="40" /></td>
        </tr>
        <tr>
          <td><select name="cond3" id="cond3">
            <?=tbl_filtro_ope(1);?>
          </select>          <select name="campo3" id="campo3">
            <?=tbl_col_ddl($id);?>
          </select>          <select name="ope3" id="ope3">
            <?=tbl_filtro_ope(2);?>
          </select>          <input name="valor3" type="text" id="valor3" size="40" /></td>
        </tr>
        <tr>
          <td><select name="cond4" id="cond4">
            <?=tbl_filtro_ope(1);?>
          </select>          <select name="campo4" id="campo4">
            <?=tbl_col_ddl($id);?>
          </select>          <select name="ope4" id="ope4">
            <?=tbl_filtro_ope(2);?>
          </select>          <input name="valor4" type="text" id="valor4" size="40" /></td>
        </tr>
        <tr>
          <td><select name="cond5" id="cond5">
            <?=tbl_filtro_ope(1);?>
          </select>            <select name="campo5" id="campo5">
            <?=tbl_col_ddl($id);?>
            </select>          <select name="ope5" id="ope5">
            <?=tbl_filtro_ope(2);?>
              </select>            <input name="valor5" type="text" id="valor5" size="40" /></td>
        </tr>
        <tr>
          <td bgcolor="gray"><b>Propiedades:</b></td>
        </tr>
        <tr>
          <td align="center" bgcolor="gray">Clasificación
            <select style="min-width:110px" name="prod_clasificacion_id" id="prod_clasificacion_id">
            <?=prod_clasif_ddl()?>
            </select> 
            SubClasif.           
            <select style="min-width:110px" name="prod_subclasif_id" id="prod_subclasif_id">
            </select> 
            Cat. 
            <select style="min-width:110px" name="prod_categoria_id" id="prod_categoria_id">
            </select>            </td>
        </tr>
        <tr>
          <td><select name="cond6" id="cond6">
            <?=tbl_filtro_ope(1);?>
          </select>            <select style="min-width:180px;max-width:180px" name="campo6" id="campo6">
            </select>          <select name="ope6" id="ope6">
            <?=tbl_filtro_ope(2);?>
              </select>            <input name="valor6" type="text" id="valor6" size="40" /></td>
        </tr>
        <tr>
          <td><select name="cond7" id="cond7">
            <?=tbl_filtro_ope(1);?>
          </select>
            <select style="min-width:180px;max-width:180px" name="campo7" id="campo7">
                                    </select>
            <select name="ope7" id="ope7">
            <?=tbl_filtro_ope(2);?>
              </select>            <input name="valor7" type="text" id="valor7" size="40" /></td>
        </tr>
        <tr>
          <td><select name="cond8" id="cond8">
            <?=tbl_filtro_ope(1);?>
          </select>            <select style="min-width:180px;max-width:180px" name="campo8" id="campo8">
            </select>
          <select name="ope8" id="ope8">
            <?=tbl_filtro_ope(2);?>
                              </select>
          <input name="valor8" type="text" id="valor8" size="40" /></td>
        </tr>
      </table>
    </form>
</body>
</html>
<script language="javascript">
$("#prod_clasificacion_id").change(function () {	
 	$("#prod_subclasif_id").load("ajax.php?a=prod_subclasif&id="+ $(this).val());
});
$("#prod_subclasif_id").change(function () {	
 	$("#prod_categoria_id").load("ajax.php?a=prod_categoria&id="+ $(this).val());
});
$("#prod_categoria_id").change(function () {	
 	$("#campo6").load("ajax.php?a=prod_propiedad&id="+ $(this).val());
 	$("#campo7").load("ajax.php?a=prod_propiedad&id="+ $(this).val());
 	$("#campo8").load("ajax.php?a=prod_propiedad&id="+ $(this).val());
});
</script> 