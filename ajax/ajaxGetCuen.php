<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//echo $_POST['val'];
$sql=sql::getCuentaxIdBan($_POST['getVal']);
$cuentas=negocio::getData($sql);

?>

<?php foreach($cuentas as $data){ ?>
<option value="<?php print $data['cuenta_id']; ?>" ><?php print $data['cuenta_nro']; ?></option>	
<?php }?>	