<?php
class mensaje{		
	function edit($accion='',$id=0,$persona_id='',$para='',$asunto='',$cuerpo='',$adjunto=''){
            switch($accion){
                case 'S':
                    $sql="SELECT*FROM mensajes WHERE mensaje_id=".(int)$id;
                    $result=mysql_query($sql) or Msg_error($sql);
                    return mysql_fetch_array($result,1);
                break;
                case 'L':
                    $sql="SELECT*FROM mensajes";
                    $result=mysql_query($sql) or Msg_error($sql);
                    while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                    return $prg;
                    break;                
                case 'I':
                    $sql="insert into mensajes(msj_fecha,persona_id,msj_para,msj_asunto,msj_cuerpo,msj_adjunto)values(NOW(),'".$persona_id."','".$para."','".$asunto."','".$cuerpo."','".$adjunto."')";
                    $result=mysql_query($sql) or Msg_error($sql);
                    break;
                case 'U':
                    $sql="";
                    break;                
            }
		
	}
		       
        
	
}
?>