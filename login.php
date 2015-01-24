<div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="heading">
      <h1><img src="images/lockscreen.png" alt="" /> Acceso</h1>
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
      
      <?php if ($_GET['err']) { ?>
      <div class="warning"><?php echo 'Acceso Denegado'; ?></div>
      <?php } ?>
      <form action="acceso.php" method="post" enctype="multipart/form-data" id="form">
        <table style="width: 100%;">
          <tr>
            <td style="text-align: center;" rowspan="4"><img src="images/login.png" /></td>
          </tr>
          <tr>
            <td>
              Empresa<br /> 
              <select name="empresa_id"><?php echo mi_empresa_ddl();?></select><br/><br />
              Usuario<br />
              <input name="ope_login" type="text" id="ope_login" style="margin-top: 4px;" value="" />
              <br />
              <br />
              Contraseña<br />
              <input name="ope_pass" type="password" id="ope_pass" style="margin-top: 4px;" value="" />
              <br />
              <a href="index.php?menu=recovery">Olvido Contraseña</a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align: right;"><a onclick="$('#form').submit();" class="button"><span>Login</span></a></td>
          </tr>
        </table>       
      </form>
    </div>
  </div>
<script type="text/javascript"><!--
$('#ope_login').focus();
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 