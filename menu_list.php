<?php
if($_POST['accion']>''){
    if($_POST['perfil_id']>''){
        menu::menu_perfil('I',0,$_POST['perfil_id']);
	menu::perfil_empresa('I',$_POST['perfil_id']);
        menu::perfil_tablero('I',$_POST['perfil_id']);
        echo '<div class="success">Datos Grabados</div>';
    }
	
}
?>
<div class="box">
	<div class="heading">
    	<h1>Permisos</h1>
	  	<div class="buttons">
			<a onclick="document.form1.accion.value='I';document.form1.submit();" class="button"><span>Grabar</span></a>
			<a class="button" href="index.php"><span>Salir</span></a>
		</div>
    </div>
    <div class="content">
	<form action="" method="post" name="form1">
	<input type="hidden" name="accion">
    <table width="100%" class="list">
  <tr>
    <td width="20%"><b>Perfil</b></td>
    <td width="20%"><b>Empresas</b></td>
    <td width="20%"><b>Tablero</b></td>
    <td width="40%"><b>Accesos</b></td>
  </tr>
  <tr>
    <td valign="top"><div style="height:350px;overflow:auto"><select name="perfil_id" size="10" style="width:200px" id="perfil_id" onchange="document.form1.submit();"><? echo perfil_ddl($_POST['perfil_id'])?></select></div></td>
    <td><div style="height:350px;overflow:auto"><?=emp_perfil_ddl($_POST['perfil_id'])?></div></td>
    <td><div style="height:350px;overflow:auto"><?=tablero_perfil_ddl($_POST['perfil_id'])?></div></td>
    <td><div style="height:350px;overflow:auto"><?=menu_perfil_ddl(0,$_POST['perfil_id'],0)?></div></td>
  </tr>
</table>
  </form>
    </div>
</div>