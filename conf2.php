<?php
$servidor = "localhost";
$usuario = "root";
$password = "electro";
$base_de_datos = "tec-erp-3";  // tec-erp-1 electrowerke
$base_de_datos2= "start-soft1";

// ***** Conexion a Base de Datos *****

$cn = mysql_connect ($servidor,$usuario,$password) or die('Imposible conectarse con MySQL,');
mysql_select_db($base_de_datos2,$cn) or die('Imposible conectarse con la Base de Datos');

mysql_query("SET NAMES 'utf8'", $cn);
mysql_query("SET lc_time_names = 'es_PE'", $cn);
mysql_query("SET CHARACTER SET utf8", $cn);
mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $cn);
mysql_query("SET SQL_MODE = ''", $cn);

//session_start();
?>