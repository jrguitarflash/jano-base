<?php
include("include/comun.php");
?>
<table width="100%" border="0">
  <tr>
    <td align="right">Cuenta contable : </td>
    <td><input type="text" name="cuenta" id="cuenta" class="required" /></td>
  </tr>
  <tr>
    <td align="right">Año:</td>
    <td><select name="ano" id="ano" class="required"><?=periodo_ddl(0,5,0)?></select></td>
  </tr>
  <tr>
    <td align="right">Mes:</td>
    <td><select name="mes" id="mes" class="required"><?=mes_ddl()?></select></td>
  </tr>
</table>


