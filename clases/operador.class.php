<?php
class operador {
									 	 	 		
	function acceso(){
            $sql = "SELECT * FROM v_trabajador WHERE trab_usuario = '".$_POST['ope_login']."' AND trab_clave ='".$_POST['ope_pass']."' and trab_estado_id=1";
            $result = mysql_query($sql);
            $row=mysql_fetch_array($result);	  	
            return $row;
	}
                        
        function get_perfil($perfil_id=0,$empresa_id=0){
            $sql = "SELECT *,
                    (select emp_logo from empresa  where empresa_id=perfil_empresa.empresa_id)as emp_logo,
                    (select emp_nombre from empresa  where empresa_id=perfil_empresa.empresa_id)as emp_nombre
                    FROM perfil_empresa where perfil_id=".(int)$perfil_id." and empresa_id=".(int)$empresa_id;
            $result = mysql_query($sql);
            $row=mysql_fetch_array($result);
            return $row;
        }
        
        function get_usuario($email=''){
            $sql = "SELECT * FROM v_trabajador where cont_email='".$email."' and bestado='1' and trab_estado_id=1 limit 1";
            $result = mysql_query($sql);
            $row=mysql_fetch_array($result);
            return $row;
        }
        
        function log($accion='',$operador_id=0){
            switch($accion){
                case 'I': // Ingreso
                    $sql="insert into acceso_log(operador_id,acc_log_fecha_ini,acc_log_ip,acc_log_pc)
                          values(".(int)$operador_id.",NOW(),'".$_SERVER['REMOTE_ADDR']."','".gethostbyaddr($_SERVER['REMOTE_ADDR'])."')";
                    $result = mysql_query($sql);
                    break;
                case 'S': // Salida
                    $sql="update acceso_log set 
                          acc_log_fecha_fin=now()
                          where operador_id=".(int)$operador_id."
                          order by acc_log_fecha_ini desc
                          limit 1";
                    $result = mysql_query($sql);
                    break;
            }
            
        }

        function ope_cancel($login='',$clave=''){
		$sql = "SELECT * FROM operador WHERE ope_login = '".$login."' AND ope_pass = MD5('".$clave."')";
		$result = mysql_query($sql) or Msg_error($sql);
		if($row=mysql_fetch_array($result,1)){
                    return $row;
	  	}
		
	}
	
	function salir($id=0){
		$sql=($id==0)?"UPDATE operador SET ope_enlinea='0'":"UPDATE operador SET ope_enlinea='0' WHERE operador_id=".$id;
		mysql_unbuffered_query($sql) or Msg_error($sql);
                if($id>0){
                    $sql="update operador set ope_fec_fin_sesion=NOW() where operador_id=".$id;
                    mysql_unbuffered_query($sql) or Msg_error($sql);
                }
	}
        
        function ope_edit($accion='',$id=''){
		if($id!=''){$where=" WHERE ope_id = '".$id."'";}
		switch ($accion){
		case 'S':
                        $sql="select*from operador".$where;
                        break;
                case 'L':
                        $sql="select*from operador";
                        break;
		case 'I':
			$sql = "INSERT INTO operador (ope_dni,ope_apellido,ope_nombre,
			ope_cargo_id,ope_radio,ope_telef_casa,ope_cel,ope_email,ope_login,ope_pass,
			ope_tipo_id,ope_fecnac,ope_estado_id,ope_codigo,ope_observ,anexo_id,ope_id_creador,ope_fecini,ope_fecfin,ope_mot_cese_id) VALUES (
			'".$_GET['ope_dni']."','".$_GET['ope_apellido']."',
			'".$_GET['ope_nombre']."','".$_GET['ope_cargo_id']."',
			'".$_GET['ope_radio']."','".$_GET['ope_telef_casa']."',
			'".$_GET['ope_cel']."','".$_GET['ope_email']."',
			'".$_GET['ope_login']."',MD5('".$_GET['ope_login']."'),
			'".$_GET['ope_tipo_id']."','".$_GET['ope_fecnac']."',
			'".$_GET['ope_estado_id']."','".$_GET['ope_codigo']."','".$_GET['ope_observ']."',".($_GET['anexo_id']+0).",".($_GET['ope_id_creador']+0).",'".$_GET['ope_fecini']."','".$_GET['ope_fecfin']."',".(int)$_GET['ope_mot_cese_id'].")";
			break;
		case 'U':			
			$sql = "UPDATE operador SET ope_dni='".$_GET['ope_dni']."',
			ope_apellido='".$_GET['ope_apellido']."',ope_nombre='".$_GET['ope_nombre']."',
			ope_cargo_id='".$_GET['ope_cargo_id']."',ope_radio='".$_GET['ope_telef']."',
			ope_telef_casa='".$_GET['ope_telef_casa']."',ope_cel='".$_GET['ope_cel']."',
			ope_email='".$_GET['ope_email']."',ope_login='".$_GET['ope_login']."',
			ope_pass=IF('".$_GET['ope_pass']."',MD5('".$_GET['ope_pass']."'),ope_pass),
			ope_fecini='".$_GET['ope_fecini']."',
			ope_fecfin='".$_GET['ope_fecfin']."',                        
			ope_mot_cese_id=".(int)$_GET['ope_mot_cese_id'].",
			ope_tipo_id='".$_GET['ope_tipo_id']."',ope_fecnac='".$_GET['ope_fecnac']."',
			ope_estado_id='".$_GET['ope_estado_id']."',ope_codigo='".$_GET['ope_codigo']."',
            ope_observ='".$_GET['ope_observ']."',anexo_id=".($_GET['anexo_id']+0)." ".$where;
			break;
		case 'D':
			$sql = "UPDATE operador set bestado='0' ".$where;
			break;		
		}
		$result = @mysql_query($sql) or Msg_error($sql);
		if ($accion=='S'){
			while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
			return $prg;
		}elseif ($accion=='E'){
			return mysql_fetch_array($result,1);
		}elseif($accion=='L'){
                    while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
                    return $prg;
                }
	}
	
	function ope_perfil($empresa_id=0){
            $where=($empresa_id>0)?" and empresa_id=".(int)$empresa_id:"";
            $sql="SELECT * from perfil where bestado='1' ".$where." order by perfil_nombre";
            return qry($sql);
	}
	
	
		
/*****  Fin de la clase  ******/
}
?>