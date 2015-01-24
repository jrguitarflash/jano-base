<?php
$id=$_GET['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];
if($_POST['accion']>''){
	if($_POST['accion']=='I'){
		$id=tabla::edit($_POST['accion'],$_POST['id']);	
		$accion='U';
	}
	$id=($id>0)?$id:$_POST['id'];
	tabla::edit($accion,$id);
	$msj=1;	

}
$reg=tabla::edit('S',$id);
?>
<?php if($msj==1){echo erp_notificacion('001');} ?>
<div class="box">
	<div class="heading">
    	<h1>Tabla</h1>
	  	<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=tabla_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
	<div id="ui-tabs">
	<ul>
	<li><a href="#tab-general">General</a></li>
	<li><a href="#tab-grupo">Grupos</a></li>
	<li><a href="#tab-columna">Columnas</a></li>
	<li><a href="#tab-accion">Acciones</a></li>
	</ul>
	<div id="tab-general">
<form action="index.php?menu=tabla_form" method="post" name="form1">
<input type="hidden" name="accion" value="<?=$accion?>">
<input type="hidden" name="id" value="<?=$id?>">
<table width="100%" class="form">
  <tr>
    <td colspan="2"><b>Datos de Gesti&oacute;n</b></td>
    </tr>
  <tr>
    <td>Nombre:</td>
    <td><input name="tbl_nombre" type="text" id="tbl_nombre" size="50" value="<?=$reg['tbl_nombre']?>" />
        <input name="empresa_id" type="hidden" id="empresa_id" value="<?=$reg['empresa_id']?>" /></td>
  </tr>
  <tr>
    <td>Alias:</td>
    <td><input name="tbl_alias" type="text" id="tbl_alias" value="<?php echo $reg['tbl_alias']?>" size="30" /></td>
  </tr>
  <tr>
    <td valign="top">Descripci&oacute;n:</td>
    <td><textarea name="tbl_desc" cols="50" rows="3" id="tbl_desc"><?php echo $reg['tbl_desc']?></textarea></td>
  </tr>
  <tr>
    <td >Condicion SQL: </td>
    <td><textarea name="tbl_sql_cond" cols="50" rows="3" id="tbl_sql_cond"><?php echo $reg['tbl_sql_cond']?></textarea></td>
  </tr>
  <tr>
    <td >Nombre SP: </td>
    <td><input name="tbl_sp" type="text" id="tbl_sp" value="<?php echo $reg['tbl_sp']?>" size="50" /></td>
  </tr>
  <tr>
    <td >Campo PK </td>
    <td><table width="100%" border="0">
        <tr>
          <td width="20%"><input name="tbl_col_pk" type="text" id="tbl_col_pk" value="<?php echo $reg['tbl_col_pk']?>" size="35" /></td>
          <td width="20%" align="right">Campo Orden </td>
          <td><input name="lst_cpo_orden" type="text" id="lst_cpo_orden" value="<?php echo $reg['lst_cpo_orden']?>" size="35" />
            <input name="lst_cpo_sort" type="text" id="lst_cpo_sort" size="5" value="<?php echo $reg['lst_cpo_sort']?>" /></td>
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td >Form. Edicion </td>
    <td><table width="100%" border="0">
        <tr>
          <td width="20%"><input name="lst_cpo_form" type="text" id="lst_cpo_form" value="<?php echo $reg['lst_cpo_form']?>" size="35" /></td>
          <td width="20%" align="right">Form. Lista </td>
          <td><input name="lst_cpo_list" type="text" id="lst_cpo_list" value="<?php echo $reg['lst_cpo_list']?>" size="35" /></td>
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td >Tabla padre </td>
    <td><input name="tbl_padre_id" type="text" id="tbl_padre_id" value="<?php echo $reg['tbl_padre_id']?>" /></td>
  </tr>
  <tr>
    <td >Tamaño</td>
    <td><input name="tbl_frm_ancho" type="text" id="tbl_frm_ancho" value="<?php echo $reg['tbl_frm_ancho']?>" size="10" />
x
  <input name="tbl_frm_alto" type="text" id="tbl_frm_alto" value="<?php echo $reg['tbl_frm_alto']?>" size="10" /></td>
  </tr>
  <tr>
    <td >Mantenimiento:</td>
    <td><input name="tbl_mantenimiento" type="checkbox" id="tbl_mantenimiento" value="1" <?=($reg['tbl_mantenimiento']=='1')?' checked ':'';?> ></td>
  </tr>
  
  <tr>
    <td >Opciones de Lista </td>
    <td><table border="0">
        <tr>
          <td><input name="frm_acc_grabar" type="checkbox" id="frm_acc_grabar" value="1" <?=($reg['frm_acc_grabar']=='1')?' checked ':'';?> />
Grabar</td>
          <td><input name="frm_acc_eliminar" type="checkbox" id="frm_acc_eliminar" value="1" <?=($reg['frm_acc_eliminar']=='1')?' checked ':'';?> />
Eliminar</td>
          <td><input name="lst_acc_nuevo" type="checkbox" id="lst_acc_nuevo" value="1" <?=($reg['lst_acc_nuevo']=='1')?' checked ':'';?> />
Nuevo</td>
          <td><input name="lst_acc_asociar" type="checkbox" id="lst_acc_asociar" value="1" <?=($reg['lst_acc_asociar']=='1')?' checked ':'';?> />
Asociar</td>
          <td><input name="lst_acc_duplicar" type="checkbox" id="lst_acc_duplicar" value="1" <?=($reg['lst_acc_duplicar']=='1')?' checked ':'';?> />
Duplicar</td>
          <td><input name="tbl_lista_export" type="checkbox" id="tbl_lista_export" value="1" <?=($reg['tbl_lista_export']=='1')?' checked ':'';?> />
            Exportar</td>
        </tr>
        <tr>
          <td><input name="lst_acc_mail" type="checkbox" id="lst_acc_mail" value="1" <?=($reg['lst_acc_mail']=='1')?' checked ':'';?> />
Email</td>
          <td><input name="lst_acc_search" type="checkbox" id="lst_acc_search" value="1" <?=($reg['lst_acc_search']=='1')?' checked ':'';?> />
Buscar</td>
          <td><input name="lst_acc_print" type="checkbox" id="lst_acc_print" value="1" <?=($reg['lst_acc_print']=='1')?' checked ':'';?> />
Imprimir</td>
          <td><input name="lst_acc_unir" type="checkbox" id="lst_acc_unir" value="1" <?=($reg['lst_acc_unir']=='1')?' checked ':'';?> />
Unir</td>
          <td><input name="lst_acc_directo" type="checkbox" id="lst_acc_directo" value="1" <?=($reg['lst_acc_directo']=='1')?' checked ':'';?> />
            Acc. directo </td>
          <td><input name="tbl_lst_select" type="checkbox" id="tbl_lst_select" value="1" <?=($reg['tbl_lst_select']=='1')?' checked ':'';?> />
            Seleccion</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td >Opciones de Formulario</td>
    <td><table border="0">
      <tr>
        <td><input name="reg_accion1" type="checkbox" id="reg_accion1" value="1" <?=($reg['reg_accion1']=='1')?' checked ':'';?> />
          Editar</td>
        <td><input name="reg_accion2" type="checkbox" id="reg_accion2" value="1" <?=($reg['reg_accion2']=='1')?' checked ':'';?> />
          Eliminar</td>
      </tr>
    </table></td>
  </tr>
  </table>
  </form>
  </div>
  <div id="tab-grupo">
  <table width="100%">
  
  <tr>
    <td ><b>Grupo</b></td>
	<td align="right"><a onClick="grupo_form(1,'I',0,<?=(int)$id?>)"><img src='images/add.png' title='Nuevo'></a></td>
    </tr>
  <tr>
    <td colspan="2">
	<div id="grupo_lista">
	<?=tbl_grupo_lista($id)?>
	</div>	</td>
    </tr>
 </table>
 </div>
 <div id="tab-columna">
 <table width="100%">
  <tr>
    <td><b>Columnas</b></td>
	<td align="center">Orden :
      <select onchange="Ordenar(<?=(int)$id?>,this.value)" id="orden" name="orden">
        <?=tbl_col_prop_ddl($_REQUEST['orden'])?>
      </select>      </td>
	<td align="right"><a onClick="col_form(1,'I',0,<?=(int)$id?>,'tabla_col_form2.php')"><img src='images/category.png' width="16" height="16" title='Editar Columnas'></a>&nbsp;<a onClick="col_form(1,'I',0,<?=(int)$id?>,'tabla_col_form.php')"><img src='images/add.png' title='Nuevo'></a></td>
    </tr>
  
  <tr>
    <td colspan="3">
	<div id="col_lista">
	<?=tbl_col_lista($id)?>
	</div>	</td>
    </tr>
</table>
    </div>
 <div id="tab-accion">
 <table width="100%">
  <tr>
    <td><b>Accion</b></td>
	<td align="right"><a onClick="accion_form(1,'I',0,<?=(int)$id?>,'tabla_accion_form.php')"><img src='images/add.png' title='Nuevo'></a></td>
    </tr>
  <tr>
    <td colspan="2">
	<div id="accion_lista">
	<?=tbl_accion_lista($id)?>
	</div>	</td>
    </tr>
</table>
    </div>            
            
	</div>
    </div>
</div>
<script language="javascript">
function DeleteCol(tabla_id,col_id){
    if(confirm("Desea eliminar este campo?.")){        
        $('#col_lista').load('ajax.php?a=tbl_col_lista&tabla_id='+tabla_id+'&accion=D&col_id='+col_id);
    }
    
}

function Ordenar(tabla_id,orden){
	$('#col_lista').load('ajax.php?a=tbl_col_lista&tabla_id='+tabla_id+'&accion=D&orden='+orden);       
}


function DeleteAccion(tabla_id,accion_id){
    if(confirm("Desea eliminar esta acción?.")){        
        $('#accion_lista').load('ajax.php?a=tbl_accion_lista&tabla_id='+tabla_id+'&accion=D&tbl_accion_id='+accion_id+'&orden='+$('#orden').val());
    }
    
}

function DeleteGrupo(tabla_id,grupo_id){
    if(confirm("Desea eliminar este grupo?.")){        
        $('#grupo_lista').load('ajax.php?a=tbl_grupo_lista&tabla_id='+tabla_id+'&accion=D&tbl_grupo_id='+grupo_id);
    }
    
}

function col_form(sw,accion,id,tabla_id,form){
	switch(sw){
		case 1:
			$('#dialog').remove();
	
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="'+form+'?a='+accion+'&id='+id+'&tabla_id='+tabla_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#dialog').dialog({
			title: 'Columna',		
			bgiframe: false,
			width: 600,
			height: 400,                        
			resizable: false,
			close: function (event, ui) {
				$('#col_lista').load('ajax.php?a=tbl_col_lista&tabla_id='+tabla_id+'&orden='+$('#orden').val());
			},	
			modal: true

	});
			break;
		case 0:
			$('#dialog').dialog('close');
			break;
	}
	
};

function grupo_form(sw,accion,id,tabla_id){
	switch(sw){
		case 1:
			$('#xdialog').remove();
	
			$('#content').prepend('<div id="xdialog" style="padding: 3px 0px 0px 0px;"><iframe src="tabla_grupo_form.php?a='+accion+'&id='+id+'&tabla_id='+tabla_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#xdialog').dialog({
			title: 'Grupo',		
			bgiframe: false,
			width: 400,
			height: 150,
			resizable: false,
			close: function (event, ui) {
				$('#grupo_lista').load('ajax.php?a=tbl_grupo_lista&tabla_id='+tabla_id);
			},	
			modal: false		

	});
			break;
		case 0:
			$('#xdialog').dialog('close');
			break;
	}	
};

function accion_form(sw,accion,id,tabla_id){
	switch(sw){
		case 1:
			$('#adialog').remove();
	
			$('#content').prepend('<div id="adialog" style="padding: 3px 0px 0px 0px;"><iframe src="tabla_accion_form.php?a='+accion+'&id='+id+'&tabla_id='+tabla_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#adialog').dialog({
			title: 'Acción',		
			bgiframe: false,
			width:500,
			height: 350,
			resizable: false,
			close: function (event, ui) {
				$('#accion_lista').load('ajax.php?a=tbl_accion_lista&tabla_id='+tabla_id);
			},	
			modal: false		

	});
			break;
		case 0:
			$('#adialog').dialog('close');
			break;
	}	
};




$('#ui-tabs').tabs(); 



</script>
