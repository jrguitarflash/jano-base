<?php
include("include/comun.php");
session_start();
operador::log('S',$_SESSION['SIS'][2]);
session_unset();
session_destroy();	
header("location:index.php?menu=login");
?>