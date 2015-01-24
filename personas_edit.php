<?php
if($_POST['accion']>''){
	persona::edit($_POST['accion'],$_POST['id']);
	echo "<script>window.location.href='index.php?menu=personas'</script>";
}
$reg=persona::edit('E',$_GET['id']);
$perfil=($_GET['perfil']>0)?$_GET['perfil']:$reg['persona_perfil_id'];
?>
<script language="javascript">
function CargarImagen(sw,ruta,id,control,file){
	switch(sw){
		case 1:
			$('#dialog').remove();
	
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="upload_image.php?control='+control+'&ruta='+ruta+'&id='+id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#dialog').dialog({
			title: 'Cargar Imagen',		
			bgiframe: false,
			width: 350,
			height: 150,
			resizable: false,			
			modal: true		

	});
			break;
		case 0:				
			$("#"+control).attr("src",ruta+file); 			
			//$("#"+control).load(function(){
				//$('div.preview').removeClass('loading');
					//$("#"+control).unbind();
				//});
			//$("#"+control).attr("src",ruta+file); 			
			//$.ajax({
					//url: 'ajax.php?a=image&file='+ruta+file,
					//type: 'POST',
					//data: 'file=' + encodeURIComponent(ruta+file),
					//dataType: 'text',
					//success: function(data) {						
						//$('#' + control).attr("src",data);
						
					//}
			//});
			
			$('#dialog').dialog('close');
			break;
	}
	
}
</script>
<div class="box">
	<div class="heading">
    	<h1>Persona</h1>
	  	<div class="buttons">
			<a class="button" onclick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=personas"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<div id="ui-tabs">
	<ul>
	<li><a href="#tab-persona">Persona</a></li>
	<li><a href="#tab-documento">Documentos</a></li>	
	</ul>
<div id="tab-persona">
<form action="index.php?menu=personas_edit" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="hidden" name="empresa_id" value="<?=(int)$_GET['empresa_id']?>">
<table width="100%"  class="form">
  <tr>
    <td width="19%" align="center" valign="top"><table width="100%">
      <tr>
        <td height="112" align="center">
		<?=cargar_imagen(100,100,'images/persona/',(int)$_GET['id'],'img_per','')?>		</td>
      </tr>
      <tr>
        <td align="center">Perfil inicial:<br />           
            <select name="persona_perfil_id">
              <?php echo persona_perfil_ddl($perfil)?>
            </select>
            </td>
      </tr>
      <tr>
        <td align="center">
		Empresa:<br />
		<b><?=get_empresa($_GET['empresa_id'],'emp_nombre')?></b>
		</td>
      </tr>
    </table></td>
    <td width="81%"><table width="100%" class="form">
      <tr>
        <td>DNI:</td>
        <td><input type="text" name="pers_dni" size="11"  value='<?php echo $reg['pers_dni']?>' /></td>
      </tr>
      <tr>
        <td>Nombre:</td>
        <td><input type="text" name="pers_nombres" size="50"  value='<?php echo $reg['pers_nombres']?>' /></td>
      </tr>
      <tr>
        <td>Apellido Paterno:</td>
        <td><input type="text" name="pers_apepat" size="50"  value='<?php echo $reg['pers_apepat']?>' /></td>
      </tr>
      <tr>
        <td>Apellido Materno:</td>
        <td><input type="text" name="pers_apemat" size="50"  value='<?php echo $reg['pers_apemat']?>' /></td>
      </tr>
      <tr>
        <td>Nacionalidad:</td>
        <td><select name="pers_nacionalidad">
          <?php echo pers_nacionalidad_ddl($reg['pers_nacionalidad'])?>
        </select></td>
      </tr>
      <tr>
        <td>Fec. Nac.:</td>
        <td><input type="text" name="pers_fecnac" size="10"  value='<?php echo $reg['pers_fecnac']?>' /></td>
      </tr>
      <tr>
        <td>Sexo:</td>
        <td><select name="pers_sexo" >
          <?php echo pers_sexo_ddl($reg['pers_sexo']);?>
        </select></td>
      </tr>
      <tr>
        <td>Direcci&oacute;n:</td>
        <td><input type="text" name="pers_direccion" size="50"  value='<?php echo $reg['pers_direccion']?>' /></td>
      </tr>
      <tr>
        <td>Ubigeo:</td>
        <td><select name="pers_dir_ubigeo">
          <?php echo pers_dir_ubigeo_ddl($reg['pers_dir_ubigeo']);?>
        </select></td>
      </tr>
      <tr>
        <td>Pa&iacute;s:</td>
        <td><select name="pers_dir_pais">
          <?php echo pers_pais_ddl($reg['pers_dir_pais']);?>
        </select></td>
      </tr>
      <tr>
        <td>Estado:</td>
        <td><select name="pers_estado_id">
          <?php echo pers_estado_ddl($reg['pers_estado_id']);?>
        </select></td>
      </tr>
      <tr>
        <td>Mail:</td>
        <td><input name="pers_mail" type="text" value="<?php echo $reg['pers_mail']?>" size="50" /></td>
      </tr>
      <tr>
        <td>Tel&eacute;fono:</td>
        <td><input type="text" name="pers_telefono" value="<?php echo $reg['pers_telefono']?>" /></td>
      </tr>
      
    </table></td>
  </tr>
</table>
</form>
</div>
<div id="tab-documento">
<?=documentos_lista($_GET['id'],1,"Personas")?>
</div>
</div>
    </div>
  </div>
<script language="javascript">
$('#ui-tabs').tabs(); 
</script>