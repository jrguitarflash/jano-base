<?php 

require('../conf.php');
require_once('../clases/sql/sql.class.php');
require_once('../clases/negocio/negocio.class.php');

$sql=sql::vaca_trabxAr($_POST['valAre']);
$dataTrabAdm=negocio::getData($sql);

$indTod=count($dataTrabAdm);

$dataTrabAdm[$indTod]['persona']='Todos';
$dataTrabAdm[$indTod]['persona_id']='Todos';

for($i=0;$i<count($dataTrabAdm);$i++)
{
	if($dataTrabAdm[$i]['persona']=='Todos')
	{
		$dataTrabAdm[$i]['propSelec']='selected';
	}
	else
	{
		$dataTrabAdm[$i]['propSelec']='';
	}
}

?>

<!-- DATA LOAD AJAX -->

	<?php foreach($dataTrabAdm as $data){ ?>
	<option value="<?php print $data['persona_id']; ?>" ><?php print $data['persona']; ?></option>
	<?php }?>

