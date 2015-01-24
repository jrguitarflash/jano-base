<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

</head>

<body>
<input type="text" id="cliente_nombre" />
<input type="text" id="cliente_id" />
<script language="javascript">
$(document).ready(function() {	
   $("#cliente_nombre").autocomplete({
                source: "ajax.php?a=auto_jq",
                minLength: 2,
                select: function(event, ui) {
                    $('#cliente_id').val(ui.item.id);
					alert(ui.item.value2);
                    //$('#abbrev').val(ui.item.abbrev);
                }
  	});

});
</script>
</body>
</html>
 
