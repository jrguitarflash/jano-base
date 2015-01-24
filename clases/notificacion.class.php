<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notificacion
 *
 * @author Desarrollo
 */
class notificacion {
    function msj_erp($codigo){
        $sql="SELECT*FROM msj_erp WHERE msj_erp_cod='".$codigo."'";
        $result=mysql_query($sql) or Msg_error($sql);
        return mysql_fetch_array($result,1);
    }
}

?>
