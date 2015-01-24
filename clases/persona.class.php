<?php
class persona{
	function lista(){
		//$inner=($_REQUEST['lista']>'')?" INNER JOIN ".$_REQUEST['lista']." ON persona.persona_id=".$_REQUEST['lista'].".persona_id":"";
		//$where=($_REQUEST['lista']>'')?" AND ".$_REQUEST['lista'].".bestado='1'":"";                
                if($_REQUEST['filtro']>''){
                    if(is_numeric($_REQUEST['filtro'])){
                        $where=" and pers_dni like '".$_REQUEST['filtro']."%'";
                    }else{
                        $where=" and pers_apepat like '%".$_REQUEST['filtro']."%'";
                    }
                }
		$sql="SELECT *,				
		(SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_nacionalidad) AS pers_nacionalidad,
		(SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_dir_pais) AS pers_dir_pais,
		(SELECT alias FROM pers_sexo WHERE pers_sexo_id=persona.pers_sexo_id) AS pers_sexo
		FROM persona ".$inner." WHERE persona.bestado='1'".$where." order by pers_apepat";
		//return qryPaginada($sql,true);
                $result = mysql_query($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
		return $prg;
	}
	
	function edit($accion,$id){
		switch($accion){
			case 'E':
                            $sql="SELECT*FROM persona WHERE persona_id=".($id+0);
                            $result=mysql_query($sql) or Msg_error($sql);
                            return mysql_fetch_array($result,1);			                       
			break;  
                      
                        case 'M':
                            $sql="update persona set pers_mail_sw=0";
                            $result=mysql_query($sql) or Msg_error($sql);
                            if($id>''){
                                $sql="update persona set pers_mail_sw=1 where persona_id in(".$id.")";
                                $result=mysql_query($sql) or Msg_error($sql);
                            }
                            break;
			default:
				$sql="SELECT tec_persona('".$accion."',".($id+0).",'".$_REQUEST['pers_dni'].
				"','".$_REQUEST['pers_apepat']."','".$_REQUEST['pers_apemat']."','".$_REQUEST['pers_nombres']."','".
				$_REQUEST['pers_nacionalidad']."','".$_REQUEST['pers_fecnac']."','".$_REQUEST['pers_sexo']."','".
				$_REQUEST['pers_direccion']."','".
				$_REQUEST['pers_dir_ubigeo']."','".$_REQUEST['pers_dir_pais']."',".($_REQUEST['pers_estado_id']+0).",".
				($_REQUEST['grado_acad_id']+0).",".($_REQUEST['inst_acad_id']+0).",'".$_REQUEST['pers_mail']."','".
				$_REQUEST['pers_telefono']."',".($_REQUEST['persona_perfil_id']+0).",'".$_REQUEST['persona_id_asoc']."',".(int)$_REQUEST['empresa_id'].")";
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
				return $row[0];
			break;
		}
		
	}
	
	function pers_estado(){
		$sql="SELECT * FROM pers_estado WHERE bestado='1'";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
	
	
	function pers_nacionalidad(){
		$sql="SELECT * FROM ubigeo WHERE ubigeo_tipo='1' AND ubigeo_nac>'' ORDER BY ubigeo_nac";
		return qry($sql);
	}
	
	function pers_pais(){
		$sql="SELECT * FROM ubigeo WHERE ubigeo_tipo='1' ORDER BY ubigeo_nombre";
		return qry($sql);
	}
	
	function pers_dir_ubigeo($accion='',$id=0,$tipo='',$codigo=''){
            switch($accion){
                case 'R':                    
                    $sql="SELECT * FROM ubigeo WHERE ubigeo_tipo='".$tipo."' ubigeo_codigo like '".$codigo."%'";
                    break;
                case 'S':                    
                    $sql="SELECT * FROM ubigeo WHERE ubigeo_id=".(int)$id;
                    break;
                case 'L':
                    $where=($codigo>'')?" and ubigeo_codigo like '".$codigo."%'":"";
                    $sql="SELECT * FROM ubigeo WHERE ubigeo_tipo='".$tipo."' ".$where." ORDER BY ubigeo_nombre";                    
                    break;
            }                 
            return qry($sql);
	}
       
	
	function pers_sexo(){
		$sql="SELECT * FROM pers_sexo WHERE bestado='1'";
		return qry($sql);
	}
	
	function persona_perfil(){
		$sql="SELECT * FROM persona_perfil WHERE bestado='1'";
		return qry($sql);
	}
	
	
	function trabajador_edit($accion,$id){
		$sql="SELECT tec_trabajador('".$accion."',".($id+0).",'".$_REQUEST['trab_codigo']."','".$_REQUEST['trab_fec_ini']."','".$_REQUEST['trab_estado_id']."')";
		mysql_unbuffered_query($sql) or Msg_error($sql);
	}
	function contacto_edit($accion,$id){
            if($accion=='S'){
                $where=" and contacto.contacto_id=".(int)$id;
                //$where=($empresa_id>'')?" and contacto.empresa_id=".(int)$empresa_id:"";
		$sql="SELECT *,
                    (select emp_nombre from empresa where empresa_id=contacto.empresa_id)as emp_nombre,
                    (SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_dir_pais) AS pers_dir_pais,
                    (SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_nacionalidad) AS pers_nacionalidad,
                    (SELECT alias FROM pers_sexo WHERE pers_sexo_id=persona.pers_sexo_id) AS pers_sexo
                    FROM persona INNER JOIN contacto 
                    ON persona.persona_id=contacto.persona_id 
                    WHERE contacto.bestado='1'".$where." order by persona.pers_apepat";;
		
		$result = mysql_query($sql) or Msg_error($sql);
                
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
            }else{
                $sql="SELECT tec_contacto('".$accion."','',0,".(int)$_REQUEST['id'].",'',0,'".$_REQUEST['cont_cargo']."','".$_REQUEST['cont_telef']."','".$_REQUEST['cont_area']."','".$_REQUEST['pers_apepat']."','".$_REQUEST['pers_apemat']."','".$_REQUEST['pers_nombres']."','".$_REQUEST['pers_mail']."',".(int)$_REQUEST['empresa_id'].")";                
		mysql_unbuffered_query($sql) or Msg_error($sql);
            }
		
	}
        
        function cliente_edit($accion,$id){
		$sql="SELECT tec_cliente('".$accion."',".($id+0).",".(int)$_REQUEST['empresa_id'].",".(int)$_REQUEST['cli_estado_id'].")";
		mysql_unbuffered_query($sql) or Msg_error($sql);
	}
        
	function administrativo_edit($accion,$id){
		$sql="SELECT tec_operador('".$accion."',".($id+0).",'".$_REQUEST['ope_usuario']."',".
		($_REQUEST['ope_tipo_id']+0).",".($_REQUEST['ope_cargo_id']+0).",'".$_REQUEST['ope_coment']."')";
		mysql_unbuffered_query($sql) or Msg_error($sql);
	}
	
	function persona_correo_lista(){
                
		$sql="SELECT*FROM persona WHERE pers_mail_sw=1 and bestado=1 order by pers_nombres";
		
		$result = mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
	}
	
        
        function trabajador_lista($id=0){
                $where=($id>'')?" and trabajador.persona_id=".(int)$id:"";
		$sql="SELECT *,
                    (SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_dir_pais) AS pers_dir_pais,
                    (SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_nacionalidad) AS pers_nacionalidad,
                    (SELECT alias FROM pers_sexo WHERE pers_sexo_id=persona.pers_sexo_id) AS pers_sexo
                    FROM persona INNER JOIN trabajador 
                    ON persona.persona_id=trabajador.persona_id 
                    WHERE trabajador.bestado='1'".$where." order by persona.pers_apepat";
		
		$result = mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
	}
        
        function contacto_lista($id='',$empresa_id=0){
                $where=($id>'')?" and contacto.contacto_id=".(int)$id:"";
                $where=($empresa_id>'')?" and contacto.empresa_id=".(int)$empresa_id:"";
		$sql="SELECT *,
                    (select emp_nombre from empresa where empresa_id=contacto.empresa_id)as emp_nombre,
                    (SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_dir_pais) AS pers_dir_pais,
                    (SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id=persona.pers_nacionalidad) AS pers_nacionalidad,
                    (SELECT alias FROM pers_sexo WHERE pers_sexo_id=persona.pers_sexo_id) AS pers_sexo
                    FROM persona INNER JOIN contacto 
                    ON persona.persona_id=contacto.persona_id 
                    WHERE contacto.bestado='1'".$where." order by persona.pers_apepat";;
		
		$result = mysql_query($sql) or Msg_error($sql);
                
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
	}
        
        
	
	
	
		
	
	function ope_tipo_lista(){
		$sql="SELECT * FROM ope_tipo WHERE bestado='1'";
		$result = mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
	}
	function ope_cargo_lista(){
		$sql="SELECT * FROM ope_cargo WHERE bestado='1'";
		$result = mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
	}
	
		
}
?>