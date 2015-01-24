<?php

//--- INSTANCIA DE OBJETOS SQL Y NEGOCIO ----//

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');


//echo $_POST['val'];
$sql=sql::insertEmp($_POST['EmpVals'][0],$_POST['EmpVals'][1],$_POST['EmpVals'][2],$_POST['EmpVals'][3],$_POST['EmpVals'][4],$_POST['EmpVals'][5]);
$dataContac=negocio::setData($sql);

$idEmp=negocio::getInsertId();

$sql=sql::insertAnfEmp($idEmp);
$dataAnf=negocio::setData($sql);

$sql=sql::getEmpCliente();
$clientes=negocio::getData($sql);

?>


	<option></option>
		<?php foreach($clientes as $data){ ?>
		<option value="<?php print $data['empresa_id']; ?>"><?php print $data['emp_nombre']; ?></option>	
		<?php }?>		
