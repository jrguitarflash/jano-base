<?php
if($_POST['email']>''){
    $user=operador::get_usuario($_POST['email']);
    if($user['cont_email']>''){
        $para=array("mail"=>$user['cont_email'],"nombre"=>$user['pers_completo']);
        $de=array("mail"=>"","nombre"=>"Sistema ERP");
        $mensaje="Sus datos de acceso son:<br>Usuario:<b>".$user['trab_usuario']."</b><br>Clave:<b>".$user['trab_clave']."</b>";
        send_mail($de,$para, $asunto='ERP - Datos de acceso', $mensaje,'','','');
        $alert='<div class="success">Sus datos han sido enviados.</div>';
    }else{
        $alert='<div class="warning">La dirección E-mail no se encuentra registrada.</div>';
    }
    
}
?>
<div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="heading">
		<h1><img src="images/user.png" alt="" />¿Olvidó su contraseña?</h1>
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
      
      <?php echo $alert; ?>
      
      
      <form action="" method="post" enctype="multipart/form-data" id="form">
      <p>Introduzca la dirección de correo electrónico asociada a su cuenta. Haga clic en Enviar para recibir sus datos de acceso.</p><br><br>
        <table width="100%">
          <tr>
            <td width="80">E-mail :</td>
            <td align="left"><input name="email" type="text" value="" size="50" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right"><span class="buttons"><a onclick="$('#form').submit();" class="button">Enviar</a>&nbsp;<a href="index.php" class="button">Cancelar</a></span></td>
          </tr>
        </table>         
      </form>
    </div>
  </div>