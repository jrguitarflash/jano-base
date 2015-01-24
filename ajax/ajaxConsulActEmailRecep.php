<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//print $_POST['getVal'];

$sql=sql::updateEmailxPer($_POST['getVal'],$_POST['getVal2']);
$contAfect=negocio::setData($sql);

//echo $_POST['val'];
$sql=sql::getEmailxNom($_POST['getVal']);
$valEmail=negocio::getVal($sql,'pers_mail');
$msj=negocio::veriEmailxNom($valEmail);

?>

<input type="email" name="emailRecep" class="campo correoRecep" id="mailRecep" value="<?php print $msj;?>">