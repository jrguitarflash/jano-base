<?php
class tc{		
	function edit($accion='',$id=''){
            switch($accion){
                case 'S':
                    $sql="SELECT*FROM tmp_contactar WHERE tc_id=".(int)$id;
                    $result=mysql_query($sql) or Msg_error($sql);
                    return mysql_fetch_array($result,1);
                break;
                case 'L':
                    $sql="SELECT*FROM tmp_contactar where bestado=1 order by tc_fecha desc";
                    $result=mysql_query($sql) or Msg_error($sql);
                    while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                    return $prg;
                    break;                
                case 'I':
                    $sql="insert into mensajes(msj_fecha,persona_id,msj_para,msj_asunto,msj_cuerpo,msj_adjunto)values(NOW(),'".$persona_id."','".$para."','".$asunto."','".$cuerpo."','".$adjunto."')";
                    $result=mysql_query($sql) or Msg_error($sql);
                    break;
                case 'V': // Leido
                    $sql="update tmp_contactar set tc_estado=1 where tc_id=".(int)$id;
                    $result=mysql_query($sql) or Msg_error($sql);
                    break;
                case 'P': // Suscribir persona
                    $sql="insert into persona(pers_nombres,pers_mail,pers_telefono)select tc_nombre,tc_email,tc_telef from tmp_contactar where tc_id=".(int)$id;
                    $result=mysql_query($sql) or Msg_error($sql);
                case 'D':
                    $sql="update tmp_contactar set bestado=0 where tc_id in(".$id.")";
                    $result=mysql_query($sql) or Msg_error($sql);
                    break;
                case 'E': // Verificar si el email ya esta suscrito
                    $sql="select count(*)as C from persona where pers_mail='".$id."'";
                    $result=mysql_query($sql) or Msg_error($sql);
                    $row=mysql_fetch_array($result);
                    return $row['C'];        
                    break;  
                
            }
		
	}
		       
        
	
}
?>