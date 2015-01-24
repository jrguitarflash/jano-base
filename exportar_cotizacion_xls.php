<?php
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="informe.xls"');
header("Content-Transfer-Encoding: binary");
ob_clean();
flush();
session_start();

include("include/comun.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php echo cotizacion_informe();?>
</body>
</html>