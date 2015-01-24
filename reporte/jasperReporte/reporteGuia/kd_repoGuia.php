<?php

include_once('../phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
include_once("../phpjasperxml_0.9d/class/PHPJasperXML.inc.php");
include_once ('../phpjasperxml_0.9d/setting.php');

$PHPJasperXML = new PHPJasperXML();
$xml = simplexml_load_file("report2.jrxml");
$PHPJasperXML->debugsql=false;
$parametro=$_GET['p1'];
$PHPJasperXML->arrayParameter=array("p1"=>$parametro);
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->connect($server,$user,$pass,$db);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");


?>