<?php
class tabla_grupo{
	function lista($tbl_id=0){		
		$sql="SELECT * from tabla_grupo WHERE bestado='1' and tabla_id=".(int)$tbl_id." order by tabla_grupo_orden";
                $result = mysql_query($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
	
	function edit($accion,$id){
		switch($accion){
			case 'S':
                            $sql="SELECT*FROM tabla_grupo WHERE tabla_grupo_id=".(int)$id;
                            $result=mysql_query($sql) or Msg_error($sql);
                            return mysql_fetch_array($result,1);
			break;
			default:
				$sql="SELECT tec_tabla_grupo('".$accion."',".(int)$id.",".(int)$_REQUEST['tabla_id'].",'".$_REQUEST['tabla_grupo_nombre']."',".(int)$_REQUEST['tabla_grupo_orden'].")";
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
				return $row[0];
			break;
		}
		
	}
		                    	
}
?>