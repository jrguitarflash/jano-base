<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

//print $_POST['c3'];

$sql=sql::getIdxCli($_POST['ci']);
$idCli=negocio::getVal($sql,'empresa_id');

$sql=sql::insertPersona($_POST['c1'],$_POST['c2'],$_POST['c3'],$_POST['c4'],$_POST['c5']);
$contAfec=negocio::setData($sql);

$idPer=negocio::getInsertId();

$sql=sql::insertContac($idPer,$idCli);
$contAfect=negocio::setData($sql);

//echo $_POST['val'];
$sql=sql::getContacxCli($_POST['val']);
$dataContac=negocio::getData($sql);

?>

<?php foreach($dataContac as $data){ ?>
<option value="<?php print $data['persona_id']; ?>" ><?php print $data['contacto']; ?></option>	
<?php }?>