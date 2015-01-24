<?php
class documento{
	function lista($id){
		$sql="SELECT * FROM documento WHERE bestado='1' AND tabla_id>0 AND tabla_id_origen=".($id+0);
		return qry($sql);
	}
	function edit($accion,$id){
		switch($accion){
			case 'E':
				$sql="SELECT * FROM documento WHERE documento_id=".($id+0);
				$result=mysql_query($sql) or Msg_error($sql);
				return mysql_fetch_array($result,1);
			break;
			default:
				$sql="SELECT tec_documento('".$accion."',".($id+0).",".($_POST['tabla_id']+0).",".
				($_POST['tabla_id_origen']+0).",'".date('Ymd')."',".($_POST['docu_tipo_id']+0).",'".$_POST['docu_rotulo']."','".
				$_POST['docu_descripcion']."','".$_POST['docu_ext']."','".$_FILES['archivo']['size']."',NOW(),".
				($_SESSION['operador']['operador_id']+0).")";
			break;
		}
		mysql_unbuffered_query($sql) or Msg_error($sql);
		return ($id>0)?$id:mysql_insert_id();
	}
	
	function docu_tipo_ddl(){
		return qry("SELECT * FROM docu_tipo WHERE bestado='1'");
	}
}
?>