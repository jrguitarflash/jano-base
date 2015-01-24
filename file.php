<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script language="javascript" type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxupload.js"></script>
<script>
$(document).ready(function(){
 
	var thumb = $('img#thumb');	
 
	new AjaxUpload('imageUpload', {
		action: $('form#newHotnessForm').attr('action'),
		name: 'image',
		onSubmit: function(file, extension) {
			//$('div.preview').addClass('loading');
			alert(extension);
			alert(file);
		},
		onComplete: function(file, response) {
			if (response.success) {
				thumb.load(function(){
				//$('div.preview').removeClass('loading');
					thumb.unbind();
				});
				thumb.attr('src', response);				
				alert(response.success);
			}
			
			if (response.error) {
				alert(response.error);
			}
			
		}
	});
});				
</script>

</head>

<body>
<div class="seven columns">
				<div class="preview">
					<img id="thumb" width="100px" height="100px" src="/images/icons/128px/zurb.png" />
				</div>
 
				<span class="wrap hotness">
					<form id="newHotnessForm" action="/images/persona">
						<label>Upload a Picture of Yourself</label>
						<input type="file" id="imageUpload" size="20" />
						<button type="submit" class="button">Save</button>
					</form>
				</span>
</div
>
<table width="100%" border="1">
  <tr>
    <td rowspan="3">asdasd</td>
    <td colspan="3">asdasd</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
