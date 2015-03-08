<?php

require("../conf.php");
require_once('../clases/mail/class.phpmailer.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');
require ("../utils_func.php");

switch ($_GET['cron']) 
{

	case 'alertCump':

		$sql=sql::ct_trabEw_obte();
		$dataTrab=negocio::getData($sql);
		$arrDesti=Array();

		foreach($dataTrab as $data)
		{
			$cumpDay=$data['cumpDay'];
			$cumpMes=$data['cumpMes'];;

			$dayActu=date('d');
			$mesActu=date('m');

			if($cumpDay==$dayActu and $cumpMes==$mesActu)
			{
				$arrDesti[0]=$data['trabEmail'];
				//$arrDesti[1]='cesar.nicho@electrowerke.com.pe';
				//$arrDesti[2]='jj.ayllon@electrowerke.com.pe';
				$msjTit="Feliz Cumpleaños";
				$msjSub="Feliz Cumpleaños";
				$msjAlt="Feliz Cumpleaños";

				$msjBod="Hola ".$data['trabEw'];
				$msjBod.="<br>";
				$msjBod.="Es nuestro deseo que tu vida se llene de muchos éxitos y satisfacciones, 
						que al lado de tu familia puedas disfrutar de un maravilloso y feliz cumpleaños. 
						Muchos abrazos y saludos de parte de todos";
				$msjBod.="<br><br>";
				$msjBod.="Atte. Electrowerke";

				print np_enviEmail($msjTit,$msjSub,$msjAlt,$msjBod,$arrDesti);
			}
		}

	break;

	default:
	break;

}

?>