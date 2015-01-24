<?php
class local{
	function lista($empresa_id=0){		
            $where=($empresa_id>0)?" and empresa_id=".(int)$empresa_id:"";
            $sql="SELECT * from local WHERE bestado='1' ".$where." order by local_siglas";		
            $result = mysql_query($sql);
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
            return $prg;
	}
	
	function edit($accion,$id){
            switch($accion){
                case 'S':
                    $sql="SELECT*FROM local WHERE local_id=".(int)$id;
                    $result=mysql_query($sql) or Msg_error($sql);
                    return mysql_fetch_array($result,1);
                break;
                default:
                    $sql="SELECT tec_local('".$accion."',".(int)$id.",".(int)$_REQUEST['empresa_id'].",'".$_REQUEST['local_siglas']."','".$_REQUEST['local_direccion']."','".$_REQUEST['ubigeo_id']."','".$_REQUEST['local_telef']."','".$_REQUEST['local_respons']."','".$_REQUEST['local_coment']."')";                                
                    $result=mysql_query($sql);
                    $row=mysql_fetch_row($result);
                    return $row[0];
                break;
            }
		
	}
		       
        
	
}
?>
