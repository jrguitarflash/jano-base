<?php
class reportes{
    function edit($accion='',$id=0){
        $where=($id>0)?" and reporte_id=".$id:"";
        switch($accion){
            case 'S':
                $sql="select*from reporte where bestado=1".$where;
                break;
        }
        
    }
    
}
?>
