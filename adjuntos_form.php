<?php
include("include/comun.php");
//echo $_GET['tabla_id']."<br>".$_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<script type="text/javascript" src="js/ajaxupload.js"></script>
</head>
<body>
<table width="100%">
<tr>
  <td colspan="2"><table width="100%" border="0">
    <tr>
      <td align="right"><a title="Subir archivos" onclick="upload(<?=(int)$_GET['tabla_id']?>,<?=(int)$_GET['id']?>);"><img src="images/subir.png"></a>&nbsp;</td>
      </tr>
    <tr>
      <td width="50%" valign="top"><div id="archivo_lista"><?=archivo_lista((int)$_GET['tabla_id'],(int)$_GET['id'])?></div></td>
      </tr>
  </table></td>
</tr>
</table>

<div id="upload_file" style="padding: 3px 0px 0px 0px;display:none;">
<table width="100%" border="1">
  <tr>
    <td>Formato</td>
    <td><select name="tipo_id" id="tipo_id"><?=arc_tipo_ddl(0)?></select>
    </td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input name="file_nombre" type="text" id="file_nombre" /></td>
  </tr>
  <tr>
    <td>Descripción</td>
    <td><input name="file_descripcion" type="text" id="file_descripcion" size="40" /></td>
  </tr>
  <tr>
    <td>Subir</td>
    <td><div id="file_source" style="border:solid blue 1px;background-color:gray">Seleccionar archivo</div></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="button" id="subir" value="Enviar"></td>   
  </tr>
</table>
</div>
</body>
</html>
<script type="text/javascript"><!--
function select(valor){
        $("#selectable>li").each(function(){            
            $(this).removeClass("ui-selected").addClass("ui-default");
        });
        $(valor).removeClass("ui-default").addClass("ui-selected");
}

function eliminar(id,tabla_id,reg_id){
    if(confirm('Desea eliminar el archivo?.')){	
        $("#archivo_lista").load("ajax.php?a=archivo_lista&accion=D&archivo_id="+id,{            
            tabla_id:tabla_id, 
            tabla_reg_id:reg_id
        });
    }
}


function upload(tabla_id,reg_id){
	$('#upload_file').dialog({
		title: "Archivos",
		bgiframe: false,
                height: 200,
                width: 400,                
                minHeight:"200px",
                resizable: false,
                modal: false	
	});
	var nom=$("#file_nombre").val();
	var des=$("#file_descripcion").val();	
	var sube=new AjaxUpload('#file_source', {
            action: 'ajax.php?a=upload',
            name:'file',
            autoSubmit: false,
            responseType: 'json',
            onChange: function(file, ext) {
                $('#file_source').html(file);
            },
            onSubmit : function(file , ext){
                //Paso de paramentro adicionales (POST)
		this.setData({
                    tabla_id:tabla_id,
                    reg_id:reg_id,
                    tipo:$('#tipo_id option:selected').val(),
                    nombre:$("#file_nombre").val(),
                    descrip:$("#file_descripcion").val()
		});
                $('#file_source').append('<img src="images/loading.gif" id="loading" style="padding-left: 5px;" />');
            },
            onComplete: function(file, json){
                if (json.success) {
                    $('#file_source').html("Seleccione archivo");
                    $('#file_nombre').val("");
                    $('#file_descripcion').val("");
                    $('#upload_file').dialog( "close" );
                    $("#archivo_lista").load("ajax.php?a=archivo_lista",{
                        tabla_id:tabla_id, 
                        tabla_reg_id:reg_id
                    });
		}
		if (json.error) {
                    $('#loading').remove();
                    alert(json.error);
		}
            }
    });
	jQuery('#subir').click(function(){                    
    	sube.submit();
        return false;
    });
		
};

//--></script>