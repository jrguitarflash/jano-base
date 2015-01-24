<?php
include("include/comun.php");
if($_GET['accion']=='G'){
	//tabla_col::edit($_GET['accion'],$_GET['id']);
	tbl_col_propiedad_edit($_GET['tabla_id'],$_GET['propiedad']);
	echo "<script>Javascript:window.parent.col_form(0,'',0,0);</script>";
	
}

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
<script type="text/javascript" src="js/jquery.validate.js"></script>


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
$(document).ready(function(){
	$("#form1").validate();
	//$("#btnSave").click(function(){		
		//$("#form1").submit();
//	});
});
</script>
</head>

<body>
<form name="form1" id="form1" method="get">
<input type="hidden" name="accion" value="<?=$_GET['a']?>">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="hidden" name="tabla_id" value="<?=$_GET['tabla_id']?>">


<table width="100%" border="0">  
  <tr>
    <td align="center">Propiedad:
      <select onchange="document.form1.submit();" name="propiedad"><?=tbl_col_prop_ddl($_GET['propiedad'])?></select></td>
    <td colspan="3" align="right"><input type="submit" name="Submit" value="    Grabar    " onclick="document.form1.accion.value='G'" /></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><?=tbl_col_prop_lista($_GET['tabla_id'],$_GET['propiedad'])?></td>
    </tr>
  </table>
<p align="right">&nbsp;</p>
</form>
</body>
</html>