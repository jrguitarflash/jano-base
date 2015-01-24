<?php
class cuenta{
    function lista(){
        $sql="SELECT*,
             (select banco_nombre from banco where banco_id=cuenta.banco_id)as banco,
             (select mon_sigla from moneda where moneda_id=cuenta.moneda_id)as moneda             
              FROM cuenta where bestado='1' order by banco_id";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    function movimiento($cuenta_id=0){
        $prg=array();
        $sql="SELECT*,
              date_format(cta_mov_fecha,'%d-%m-%Y')as fecha
              FROM cuenta_mov where bestado='1' and cuenta_id=".$cuenta_id;
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function edit(){
        switch($accion){
            case 'I':
                $sql="SELECT*FROM atajos where bestado='1' and operador_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
            case 'F':
                $sql="select tec_atajos('I','','".$_SESSION['SIS'][2]."','','0','".$id."','','');";
                $result=mysql_query($sql);                
                break;                      
        }
    }
}
?>
