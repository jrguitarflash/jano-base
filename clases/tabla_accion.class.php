<?php
class tabla_accion{
	function lista($tbl_id=0){		
		$sql="SELECT * from tabla_accion WHERE bestado='1' and tabla_id=".(int)$tbl_id." order by tbl_accion_orden";		
                $result = mysql_query($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
		return $prg;
	}
	
	function edit($accion,$id){
		switch($accion){
			case 'S':
                            $sql="SELECT*FROM tabla_accion WHERE tabla_accion_id=".(int)$id;
                            $result=mysql_query($sql) or Msg_error($sql);
                            return mysql_fetch_array($result,1);
			break;
			default:
				$sql="SELECT tec_tabla_accion('".$accion."',".(int)$id.",".(int)$_REQUEST['tabla_id'].",'".$_REQUEST['tbl_accion_nombre']."','".$_REQUEST['tbl_accion_url']."','".$_REQUEST['tbl_accion_func']."','".$_REQUEST['tbl_accion_icono']."','".$_REQUEST['tbl_accion_descripcion']."','".(int)$_REQUEST['tbl_accion_orden']."','".(int)$_REQUEST['tbl_accion_tipo']."')";
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
                                //echo $sql;
				return $row[0];
			break;
		}
		
	}		                    
}
?>