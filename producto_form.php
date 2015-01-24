<?php
if($_POST['accion']>''){
	producto::edit($_POST['accion'],$_POST['id']);
	echo "<script>window.location.href='index.php?menu=producto_list'</script>";
}
$reg=producto::edit('S',$_GET['id']);

?>
<?php if($msj==1){?><div class="success">Datos Grabados</div><? } ?>

<div class="box">
	<div class="heading">
    	<h1>Producto:</h1>
	  	<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=producto_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<div id="ui-tabs">
	<ul>
	<li><a href="#tab-empresa">General</a></li>
	<li><a href="#tab-documento">Adjuntos</a></li>	
	</ul>
<div id="tab-empresa">
<form action="index.php?menu=producto_form" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<table width="100%" class="form">
  <tr>
    <td>Nombre</td>
    <td><input name="prod_nombre" type="text" id="prod_nombre"  value='<?php echo $reg['prod_nombre']?>' size="40" /></td>
  </tr>
  <tr>
    <td>Precio</td>
    <td><input name="prod_precio" type="text" id="prod_precio"  value='<?php echo $reg['prod_precio']?>' size="10" /></td>
  </tr>
  <tr>
    <td>Stock</td>
    <td><input name="prod_stock" type="text" id="prod_stock" value="<?php echo $reg['prod_stock']?>" size="10" /></td>
  </tr>
</table>
</form>
</div>
<div id="tab-documento">
<table width="100%">

<tr>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td colspan="2"><table width="100%" border="0">
    <tr>
      <td align="right"><a onclick="upload(10,1);">Subir</a>&nbsp;<a onclick="eliminar();">Eliminar</a>&nbsp;</td>
      </tr>
    <tr>
      <td width="50%" valign="top"><div id="archivo_lista"><?=archivo_lista(10,1)?></div></td>
      </tr>
  </table></td>
</tr>
</table>
</div>

</div>
  </div>
</div>
<div id="upload_file" style="display:none">
<table width="100%" border="1">
  <tr>
    <td>Tipo</td>
    <td><select name="tipo_id" id="tipo_id"><?=arc_tipo_ddl(0)?></select>
    </td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input name="file_nombre" type="text" id="file_nombre" /></td>
  </tr>
  <tr>
    <td>Descripcion</td>
    <td><input name="file_descripcion" type="text" id="file_descripcion" /></td>
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
<script type="text/javascript"><!--
function select(valor){
        $("#selectable>li").each(function(){            
            $(this).removeClass("ui-selected").addClass("ui-default");
        });
        $(valor).removeClass("ui-default").addClass("ui-selected");
}

function eliminar(){
    $("#selectable>li").each(function(){            
        if(this.className=="ui-selected"){            
            if(confirm('Desea eliminar el archivo?.')){
                $(this).remove();
            }           
        };
    });
}



function upload(tabla_id,reg_id){    					
	$('#upload_file').dialog({
		title: "Archivos",					
		width: 400,
		height: 200,
		resizable: false,			
		modal: true
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
           			reg_id:reg_id
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

$('#ui-tabs').tabs(); 
//--></script>
