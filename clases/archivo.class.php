<?php
class archivo{
    function lista($tabla_id=0,$tabla_reg_id=0,$tipo=0){
        $where=($tabla_id>0)?" and tabla_id=".$tabla_id:"";
        $where.=($tabla_reg_id>0)?" and tabla_reg_id=".$tabla_reg_id:"";
        $where.=($tipo>0)?" and arc_tipo_id=".$tipo:"";
        $sql="SELECT * from archivo WHERE bestado='1' ".$where." order by arc_nombre";        
        $result = mysql_query($sql);
        //echo $sql;
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
        return $prg;
    }
	
    function edit($accion,$id){
        switch($accion){
            case 'S':
                $sql="SELECT*FROM archivo WHERE archivo_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                return mysql_fetch_array($result,1);
                break;
            case 'I':
                $sql="insert into archivo(arc_nombre,arc_descripcion,arc_fecha,arc_tipo_id,arc_medida,arc_extension,tabla_id,tabla_reg_id)
                    values('".$_REQUEST['arc_nombre']."','".$_REQUEST['arc_descripcion']."',NOW(),".(int)$_REQUEST['arc_tipo_id'].",".(int)$_REQUEST['arc_medida'].",'".$_REQUEST['arc_extension']."',".(int)$_REQUEST['tabla_id'].",".(int)$_REQUEST['tabla_reg_id'].")";
                $result=mysql_query($sql);
                $sql="select LAST_INSERT_ID()";
                $result=mysql_query($sql);
                $row=mysql_fetch_row($result);
                return $row[0];
                break;
            case 'U':
                $sql="update archivo set
                    arc_nombre='".$_REQUEST['arc_nombre']."',
                    arc_descripcion='".$_REQUEST['arc_descripcion']."'
                    where archivo_id=".(int)$id;
                $result=mysql_query($sql);
                break;
            case 'D':
                $sql="update archivo set bestado='0' where archivo_id=".(int)$id;
                $result=mysql_query($sql);
                break;           
        }

    }
    
    function arc_tipo_ddl(){
        $sql="SELECT * from archivo_tipo WHERE bestado='1' order by arc_tipo_nombre";        
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    
}
?>