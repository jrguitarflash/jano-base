<?php
$id=($_GET['id']>'')?$_GET['id']:$_POST['id'];
$accion=($_GET['a']>'')?$_GET['a']:$_POST['accion'];

if($_POST['accion']>''){
	switch ($accion){
		case 'P': // suscribir
			tc::edit($_POST['accion'],$_POST['id']);
			$msj='<div class="success">El contacto ha sido suscrito.</div>';	
		break;
		case 'D': // Eliminnar
			tc::edit('D',$id);
			echo '<script>Javascript:window.location.href="index.php?menu=tc_list";</script>';
		break;
		case 'C': // enviar Correo
			send_mail('',$_POST['email'],$_POST['asunto'],$_POST['mensaje'],'','','');
			$msj='<div class="success">El correo ha sido enviado.</div>';	
		break;
	}	



}
tc::edit('V',$id);
$reg=tc::edit('S',$id);
$suscrito=tc::edit('E',$reg['tc_email']);
if($msj>''){echo $msj;} 
?>
<script language="javascript">
function Enviar(valor){	
    switch(valor){
        case 'D':
            if(confirm("Desea eliminar el registro?.")){
                $("#accion").val(valor);
                $("#form1").submit();
            }
            break;
        default:
            $("#accion").val(valor);
            $("#form1").submit();
            break;
    }
	
}
</script>
<div class="box">
	<div class="heading">
    	<h1>Buzón</h1>
	  	<div class="buttons">
			<?php if($suscrito==0){?><a class="button" onClick="Enviar('P');"><span>Suscribir Contacto</span></a><?}?>
			
			<a class="button" onClick="Enviar('D');"><span>Eliminar</span></a>
			<a class="button" href="index.php?menu=tc_list"><span>Ir a lista</span></a>
		</div>
    </div>
    <div class="content">
<form action="index.php?menu=tc_form" method="post" id="form1" name="form1">
<input type="hidden" id="accion" name="accion" value="<?=$accion?>">
<input type="hidden" id="email" name="email" value="<?=$reg['tc_email']?>">
<input type="hidden" name="id" value="<?=$id?>">
<table width="100%" class="form">
  <tr>
    <td colspan="2"><table width="100%" class="list">
      <tr>
        <td width="20%">Asunto:</td>
        <td width="30%"><b><font color="blue"><?=$reg['tc_asunto']?></font>
        </b></td>
        <td width="20%">Fecha:</td>
        <td width="30%"><b><?=$reg['tc_fecha']?></b></td>
      </tr>
      <tr>
        <td>Nombres y Apellidos: </td>
        <td colspan="3"><b><font color="blue"><?=$reg['tc_nombre']?></font></b></td>
        </tr>
      <tr>
        <td>Email:</td>
        <td><b><font color="blue"><?=$reg['tc_email']?></font>
        </b></td>
        <td>Teléfono:</td>
        <td><b><font color="blue"><?=$reg['tc_telef']?></font></b></td>
      </tr>
      <tr>
        <td>Mensaje:</td>
        <td colspan="3"><b><font color="blue"><?=$reg['tc_mensaje']?></font></b></td>
        </tr>
    </table></td>
    </tr>
  
  <tr class="titulo">
    <td height="25">&nbsp;Respuesta</td><td align="right"><a class="button" onClick="Enviar('C');"><span>Enviar</span></a></td>
    </tr>
  <tr>
    <td width="23%">Asunto:</td>
    <td width="77%"><input name="asunto" type="text" id="asunto" value="<?=$reg['tc_asunto']?>" size="70"></td>
  </tr>
  <tr>
    <td valign="top">Mensaje:</td>
    <td><textarea id="mensaje" name="mensaje" style="height:300px"></textarea></td>
  </tr>
</table>
</form>
    </div>
</div>
<script language="javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        },
		auto_focus: "mensaje"
});
</script>