<?php
class programacion{
    function lista(){
        $sql="select*,(select proc_nombre from proceso where proceso_id=p.proceso_is)as proceso 
              from programacion p where bestado='1'";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function edit($accion='',$id=0){
        switch($accion){
            case 'F': // Finalizar tarea
                $sql="update programacion set proc_tarea_estado_id=2 where programacion_id=".$id;
                $result=mysql_query($sql) or Msg_error($sql);
                break;
            case 'A':
                $sql="update programacion set prog_aviso='1' where programacion_id=".$id;
                $result=mysql_query($sql) or Msg_error($sql);                
                break;
            case 'C':
                $sql="select count(*)as C from programacion 
                      where bestado='1' and proc_tarea_estado_id=1 and DATEDIFF(prog_fec_ini,CURDATE())=0 and empresa_id=".$_SESSION['SIS'][5]." and operador_id=".$_SESSION['SIS'][2];
                $result=mysql_query($sql) or Msg_error($sql);
                $row=mysql_fetch_array($result);
                return $row['C'];
                break;
            case 'L':
                $sql="select *,
                      (select proc_nombre from proceso where proceso_id=p.proceso_id)as proceso,
                      (select proc_tarea_estado_nombre from proc_tarea_estado where proc_tarea_estado_id=p.proc_tarea_estado_id)as estado,
                      (select pers_corto from v_trabajador where trabajador_id=p.operador_id)as de_nombre,
                      (select cont_email from v_trabajador where trabajador_id=p.operador_id)as de_mail,
                      (select pers_corto from v_trabajador where trabajador_id=p.operador_id_resp)as para_nombre,
                      (select cont_email from v_trabajador where trabajador_id=p.operador_id_resp)as para_mail
                      from programacion p 
                      where bestado='1' and proc_tarea_estado_id=1 and empresa_id=".$_SESSION['SIS'][5];
                
                      // where bestado='1' and proc_tarea_estado_id=1 and DATEDIFF(prog_fec_ini,CURDATE())=0 and empresa_id=".$_SESSION['SIS'][5]." and operador_id=".$_SESSION['SIS'][2];
                $result=mysql_query($sql) or Msg_error($sql);
                $prg=array();
                $count=mysql_num_rows($result);
                if($count==0) 
                {
                	$prg;
         		 }
         		 else
         		 {
         			while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
         		 }
                return $prg;
                break;
            
        }
    }
}

?>
