<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//echo $_POST['val'];
$sql=sql::getRucCli($_POST['valCli']);
$valRuc=negocio::getVal($sql,'emp_ruc');
$valRuc=negocio:: veriEmailxNom($valRuc);

?>

<input type="text" name="txtRuc" class="campo" value="<?php print $valRuc; ?>">