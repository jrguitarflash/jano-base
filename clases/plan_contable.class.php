<?php
class plan_contable{
    function lista($id=0){
        $prg=array();
        $where=($id>'')?" and plan_contable_id_padre=".$id:"";
        $sql="select*from plan_contable where bestado='1'".$where." order by plan_contable_codigo";
        $result=  mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    function edit($accion='',$id=0){
        
    }
}
?>
