<?php
class contacto{
    function lista($cliente_id=0){
        $where=($cliente_id>0)?" and cliente_id=".$cliente_id:"";
        $sql="select*from v_contacto where bestado='1'".$where;
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function edit($id){
        
    }
    
}
?>
