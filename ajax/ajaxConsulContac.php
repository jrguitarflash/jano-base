<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//echo $_POST['val'];
$sql=sql::getContacxCli($_POST['val']);
$dataContac=negocio::getData($sql);

?>

	<option></option>
	<?php foreach($dataContac as $data){ ?>
	<option value="<?php print $data['persona_id']; ?>" onclick="slcContac();"><?php print $data['contacto']; ?></option>	
	<?php }?>	