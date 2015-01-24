<?list($campo,$valor)=split('\|',$_GET['qry'])?>
<script language="javascript">
var chk=new Array();
function comenzar_envio(){
	if(trim(document.getElementById('msjasunto').value)==''){alert('Ingrese asunto');return;}
	if(trim(document.getElementById('msjmensaje').value)==''){alert('Ingrese Mensaje');return;}
	if(chk.length>0){
		document.getElementById('response').innerHTML='Enviando correos....';
		asunto=document.getElementById('msjasunto').value;
		msj=document.getElementById('msjmensaje').value;
		codigos=chk.join(',');
		chk=new Array();
		cargar_pagina('todoajax.php?a=4&ope_id=<?=$_SESSION['BTK'][4]?>&id='+codigos+'&asunto='+asunto+'&mensaje='+msj,'response',comenzar_envio);
	}else{
		alert('Envio de correos Finalizados');
		cargar_pagina('todoajax.php?a=5&usr=<?=$_SESSION['BTK'][4]?>','response');
		quitarcapa();
	}
}
function enviar_correo(){
	controles=document.getElementsByTagName('input');
	chk=[];
	for(x=0;x<controles.length;x++){
		if(controles[x].type=='checkbox' && controles[x].checked){
			chk[chk.length]=controles[x].id;
		}
	}
	if(chk.length==0){alert('Debe seleccionar al menos un contacto');return;}
	ponercapa();
	var cantidad=chk.length;
	document.getElementById('ajaxmessage').innerHTML="<form name='frmajax' method='post' enctype='multipart/form-data' action='ajax_upload.php' target='ajax_upload'><table width='100%'>"+
	"<tr><td width='20%'>Asunto :</td><td width='80%'><input type='text' id='msjasunto' name='msjasunto' style='width:100%'></td></tr>"+
	"<tr><td>Contactos Selecccionados:</td><td>"+cantidad+"</td></tr>"+
	"<tr><td valign='top'>Mensaje :</td><td><textarea id='msjmensaje' style='width:100%' rows='5'></textarea></td></tr>"+
	"<tr><td colspan='2' align='center'><input type='button' value='Enviar Correo' onclick='comenzar_envio()'><input type='button' value='Cancelar' onclick='quitarcapa()'></td></tr>"+
	"<tr><td colspan='2'><div id='response'></div></td></tr>"+
	"<tr><td colspan='2' id='msjadjunto'><input type='file' id='adjunto' name='adjunto' onchange='adjuntar();' style='width:100%'></td></tr>"+
	"<tr><td colspan='2'><iframe name='ajax_upload' style='display:none'></iframe></td></tr>"+
	"</table></form>";
}
function adjuntado(cad){
	nodo=document.getElementById('adjunto');
	nodo.parentNode.removeChild(nodo);
	document.getElementById('msjadjunto').innerHTML=cad;
}
function noadjuntado(){alert('No se pudo adjuntar el arhicvo');}
function adjuntar(){
	if(trim(document.getElementById('adjunto').value)==''){
		alert('Debe seleccionar al menos un archivo');
		return;
	}else{
		document.frmajax.submit();
	}
}
</script>
<form name='form1'>
<input type="hidden" name="pos" value="<?=$_GET['pos']+0;?>">
<input type="hidden" name="qry" value="<?=$_GET['qry']?>">
<input type="hidden" name="where" value="<?=" AND ".$campo." LIKE ".$valor?>">
<input type="hidden" name="sw_contacto" value="<?=$_GET['sw_contacto']?>">
<input type="hidden" name="a">
<input type="hidden" name="id">
<table cellpadding="0" cellspacing="0" width="99%" align="center">
<tr valign="center">
	<td width="97%" height="25" bgcolor="#FFFFFF" >
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" font-family: Arial, Helvetica, sans-serif; font-size: 10px;" height="30">
	<tr bgcolor="#000000" class="tabsline" valign="center">
  	<tr valign="center">
    <td width="97%" height="25" bgcolor="#FFFFFF" >
    <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" font-family: Arial, Helvetica, sans-serif; font-size: 10px;" height="30">
    <tr valign="center">
	<td width="13%" height="25" bgcolor="#89B4BD" >&nbsp;&nbsp;<b class="titulotabla">Compras</b></td>
	
    <td width="79%" bgcolor="#89B4BD"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%" align="right"><select name="filtro" onchange="cargar_pagina('todoajax.php?a=filtro&amp;accion='+this.value+'&desde='+document.form1.desde.value+'&hasta='+document.form1.hasta.value,'control')">
            <?=cp_filtro_ddl($_GET['filtro'])?>
          </select>
          :</td>
        <td width="32%"><div id="control">
            <input name='filtro' type='text' id="filtro" onkeypress="if((event.keyCode || event.wich)==13){cargar_pagina('todoajax.php?a=cp_lista&amp;filtro=1&amp;valor='+this.value,'cp_lista');return false;}" />
        </div></td>
        <td width="52%">De
          <input name="desde" type="text" id="desde" size="12" value="<?=$_GET['desde']?>" />
            <input type="button" name="Submit2" value="..." onclick="popUpCalendar(this, document.getElementById('desde'), 'yyyy-mm-dd');"  />
          Al
          <input name="hasta" type="text" id="hasta" size="12" value="<?=$_GET['hasta']?>" />
          <input type="button" name="Submit2" value="..." onclick="popUpCalendar(this, document.getElementById('hasta'), 'yyyy-mm-dd');"  /></td>
      </tr>
    </table></td>
    <td width="8%" align="right" bgcolor="#89B4BD">
    <?//acciones('28','A,E,H');?>    </td>
  </tr>
  <tr>
    <td height="5" colspan="3" align="center">
	<div id="cp_lista">
    <?cp_lista('1')?>    
	</div>
	</td>
  </tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>