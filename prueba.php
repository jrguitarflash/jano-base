<?php
include "include/comun.php";
//function conversor_divisas($divisa_origen, $divisa_destino, $cantidad) {
//    $cantidad = urlencode($cantidad);
//    $divisa_origen = urlencode($divisa_origen);
//    $divisa_destino = urlencode($divisa_destino);
//    $url = "http://www.google.com/ig/calculator?hl=en&q=$cantidad$divisa_origen=?$divisa_destino";
//    $rawdata = file_get_contents($url);
//    $data = explode('"', $rawdata);
//    $data = explode(' ', $data['3']);
//    $var = $data['0'];
//    return round($var,3);
//}

// PEN = Soles
// USD = Dolares
// EUR = Euro
// GBP = Libra esterlina
// MXN = Peso mexicano
//echo conversor_divisas("USD","PEN",2);

//$homepage = file_get_contents('sunat.html');
//$homepage=str_replace('[NOMBRE]','Andy',$homepage);
//echo $homepage;

//echo mail('andy@gmail.com', 'xxx', 'prueba');

//clasifx::lista(0);

$x=OCLSalida(11,1);
echo $x['html'];

?>
