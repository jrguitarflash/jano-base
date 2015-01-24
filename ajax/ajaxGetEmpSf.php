<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf2.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


//echo $_POST['val'];

$sql2=sql::insertEmpSf($_POST['EmpVals'][0],$_POST['EmpVals'][0],$_POST['EmpVals'][1],$_POST['EmpVals'][2],$_POST['EmpVals'][3]);
$empAfec=negocio::setData($sql2);

$sql=sql::getCliSf();
$dataCli=negocio::getData($sql);

?>


<option></option>
<?php foreach($dataCli as $data){ ?>
<option value="<?php  print $data['anex_ruc']; ?>" ><?php print $data['anex_descripcion']; ?></option>	
<?php }?>
		
