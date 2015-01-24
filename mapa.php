<?php
include("include/comun.php");
$reg=local::edit('S',$_GET['id']);
$latitud=$reg['local_latitud'];
$longitud=$reg['local_longitud'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<script src="http://maps.google.com/maps?file=api&v=1&key=ADD_YOUR_KEY_HERE" type="text/javascript"></script>-->
<title>Documento sin t&iacute;tulo</title>
</head>
<body>


<iframe width="100%" height="470" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q=Lima+lince,+Per%C3%BA&amp;aq=&amp;sll=<?=$latitud?>,<?=$longitud?>&amp;sspn=0.093992,0.10849&amp;ie=UTF8&amp;hq=&amp;hnear=Lince,+Provincia+de+Lima,+Per%C3%BA&amp;ll=<?=$latitud?>,<?=$longitud?>&amp;spn=0.375956,0.43396&amp;t=m&amp;z=11&amp;output=embed"></iframe>

<br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Lima+lince,+Per%C3%BA&amp;aq=&amp;sll=-12.106634,-77.038879&amp;sspn=0.093992,0.10849&amp;ie=UTF8&amp;hq=&amp;hnear=Lince,+Provincia+de+Lima,+Per%C3%BA&amp;ll=-12.082969,-77.036297&amp;spn=0.375956,0.43396&amp;t=m&amp;z=11" style="color:#0000FF;text-align:left">Ver mapa más grande</a></small>-->
</body>
</html>
