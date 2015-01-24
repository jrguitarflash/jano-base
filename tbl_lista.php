<?
include("conf.php");
include("clases/tabla.class.php");
?>
<html>
<head><title></title></head>
<style type="text/css">
body{background:#4766a6;font-family:Geneva, Arial, Helvetica, sans-serif;}
a:link {text-decoration: none; color:yellow}
a:visited {text-decoration: none;color:yellow;}
a:hover {text-decoration: underline;}
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10pt;
	font-weight: normal;
}
th {
	color: #414A40;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8pt
}
</style>
<body text="#FFFFFF">
<?php
// Listar las tablas que estan en Mantenimiento
$reg=tabla::tbl_lista(1);
?>

<table width="150" align="center" border="0" cellpadding="0" cellspacing="0">
<tr><td align="center" bgcolor="#264989"><b>Lista-Tablas</b></td>
</tr>
<?
if(is_array($reg)){
    for($i=0;$i<sizeof($reg);$i++){
        echo '<tr><td>&nbsp;<a href="tbl_edit_tbl.php?tbl_id='.$reg[$i]['tabla_id'].'" target="edit">'.$reg[$i]['tbl_alias'].'</a></td></tr>';
    }
}
?>
</table>

</body>
</html>
