<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Columnas</title>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
</head>

<body>
<?php
include("include/comun.php");
$id=(int)$_GET['id'];

$reg=tabla::tabla_col_lista($id);
if(is_array($reg)){
    echo "<table border='1' class='list' width='95%'>
          <thead><tr><td align='center'><b>Nombre Campo<b></td><td align='center'><b>Descripción</b></td></tr></thead>";
    foreach ($reg as $value) {
        if($value['tbl_col_orden_lst']>0){
            echo "<tr><td>".$value['tabla_col_rotulo']."</td><td>".$value['tabla_col_desc']."&nbsp;</td></tr>";
        }
        
    }
    echo "</table>";
}

?>
</body>
</html>