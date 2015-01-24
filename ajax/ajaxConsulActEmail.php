<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::ActEmailResp($_POST['getVal'],$_POST['getVal2']);
$contAfect=negocio::setData($sql);

//echo $_POST['val'];
$sql=sql::getEmailxId($_POST['getVal']);
$valEmail=negocio::getVal($sql,'pers_mail');

	if($valEmail=='') 
	{
		$valEmail='no existe email';
	}

?>

<input type="email" name="emailRespo" id="mail" class="campo correo" value="<?php print $valEmail;?>">