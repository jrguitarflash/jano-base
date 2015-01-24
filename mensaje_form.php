<?php
if($_POST['mail']=='SEND'){
    //echo stripslashes($_POST['mensaje']);
	//$mail=send_mail_persona($_POST['asunto'],$_POST['mensaje'],$_POST['file']);
}
?>
<script language="javascript">
function EnviarMail(){
    var items = new Array();
	$("#mail").val("SEND");        
        $('#adjuntos>li').each(function(index) {            
            items.push($(this).text());
        });        
        $("#file").val(items);
	$("#form1").submit();
}
function quitar(obj){
	if(confirm('Desea quitar este elemento?.')){
		$(obj).remove();
	}
}
function addAdjunto(valor){
    $("ol").append('<li onclick="quitar(this)">'+valor+'</li>');
    open_file(0);
}
</script>
<style>	        
	#adjuntos { list-style-type: none; margin: 0; padding: 0; }
    #adjuntos li { margin: 2px; padding: 2px; float: left; font-size: 1em; text-align: center;border:gray solid 1px;cursor:pointer;}
</style>
<?php if($mail>''){echo $mail;} ?>
<div class="box">
	<div class="heading">
    	<h1>Correo Masivo </h1>
	  	<div class="buttons">
			<a class="button" onclick="EnviarMail()"><span>Enviar</span></a>
			<a class="button" onClick="open_file(1)"><span>Adjuntar</span></a>
			<a class="button" href="index.php?menu=mensaje_list"><span>Lista</span></a>
		</div>
    </div>
    <div class="content">
	<form action="" method="post" name="form1" id="form1">
	<input type="hidden" id="mail" name="mail">
        <input type="hidden" id="file" name="file">
	<table width="100%"  border="0">
      <tr>
        <td align="center" valign="top" width="35%"><?//=persona_correo_lista();?></td>
        <td align="center" valign="top"><table width="100%" class="form">
          <tr>
            <td width="35%">Asunto:</td>
            <td width="65%"><input name="asunto" type="text" id="asunto" size="67" /></td>
          </tr>
          <tr>
            <td colspan="2">Mensaje:</td>
            </tr>
          <tr>
            <td colspan="2"><textarea id="mensaje" name="mensaje" style="height:300px"></textarea></td>
            </tr>
          
          <tr>
            <td>Adjuntos:</td>
            <td><ol id="adjuntos"></ol></td>
          </tr>
        </table></td>
      </tr>
    </table>
	</form>
    </div>
</div>
<script language="javascript">
function open_file(sw){
	switch(sw){
		case 1:
			$('#dialog').remove();
	
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="file_manager.php" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
			$('#dialog').dialog({
			title: 'Adjuntos',		
			bgiframe: false,
			width: 600,
			height: 350,
			resizable: false,
			close: function (event, ui) {
				//$('#col_lista').load('ajax.php?a=tbl_col_lista&tabla_id='+tabla_id);
				//alert('Cerrando')
			},	
			modal: false		

	});
			break;
		case 0:
			$('#dialog').dialog('close');
			break;
	}
	
};



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
        }
});
$("#asunto").focus();
</script>