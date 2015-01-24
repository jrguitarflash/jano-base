<?php
class empresa{
	function lista(){
		
		$sql="SELECT * from empresa WHERE bestado='1' order by emp_nombre";
		//return qryPaginada($sql,true);
                $result = mysql_query($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
		return $prg;
	}
	
	function edit($accion,$id){
		switch($accion){
			case 'S':
                            $sql="SELECT*FROM empresa WHERE empresa_id=".(int)$id;
                            $result=mysql_query($sql) or Msg_error($sql);
                            return mysql_fetch_array($result,1);
			break;
			default:
				$sql="SELECT tec_empresa('".$accion."',".(int)$id.",
                                '".$_REQUEST['emp_ruc']."',
                                '".$_REQUEST['emp_nombre']."',
                                '".$_REQUEST['emp_email']."',
                                '".$_REQUEST['emp_web']."',
                                '".$_REQUEST['cli_coment']."',  
                                '".$_REQUEST['emp_fecalta']."',  
                                '".$_REQUEST['emp_fecult']."',
                                ".(int)$_REQUEST['emp_estado_id'].",
                                ".(int)$_REQUEST['ope_id_insert'].", 
                                ".(int)$_REQUEST['ope_id_update'].", 
                                ".(int)$_REQUEST['empresa_tipo_id'].", 
                                '".$_REQUEST['emp_direccion']."', 
                                '".$_REQUEST['ubigeo_id']."',
                                '".$_REQUEST['emp_telef']."',
                                ".(int)$_REQUEST['empresa_perfil_id'].",
                                '".$_REQUEST['empresa_id_asoc']."')";                                
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
				return $row[0];
			break;
		}
		
	}
	
	
        function emp_tipo(){
		$sql="SELECT * FROM empresa_tipo WHERE bestado='1'";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
        
        function mi_empresa(){
		$sql="SELECT * FROM empresa WHERE bestado='1' and mi_empresa=1";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
        
	function proveedor_edit($accion,$id){
		$sql="SELECT tec_proveedor('".$accion."',".($id+0).",'".$_REQUEST['prov_fec_ini']."',".(int)$_REQUEST['prov_estado_id'].")";
		mysql_unbuffered_query($sql) or Msg_error($sql);
	}
	function cliente_edit($accion,$id){
		$sql="SELECT tec_cliente('".$accion."',".($id+0).",'".$_REQUEST['cli_fec_ini']."',".(int)$_REQUEST['cli_estado_id'].")";
		mysql_unbuffered_query($sql) or Msg_error($sql);
	}
        
        function cliente_lista($id=0){
                $where=($id>'')?" and cliente.empresa_id=".(int)$id:"";
		$sql="SELECT * FROM empresa INNER JOIN cliente 
                    ON empresa.empresa_id=cliente.empresa_id 
                    WHERE cliente.bestado='1'".$where." order by empresa.emp_nombre";;
		
		$result = mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
	}
        
        function proveedor_lista($id=0){
                $where=($id>'')?" and proveedor.empresa_id=".(int)$id:"";
		$sql="SELECT * FROM empresa INNER JOIN proveedor 
                    ON empresa.empresa_id=proveedor.empresa_id 
                    WHERE proveedor.bestado='1'".$where." order by empresa.emp_nombre";;
		
		$result = mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
	}
                        
        function empresa_perfil(){
		$sql="SELECT * FROM empresa_perfil WHERE bestado='1'";
		return qry($sql);
	}
        
        function trabajador_lista($empresa_id=0){
            $where=($empresa_id>0)?" and empresa_id=".(int)$empresa_id:"";
            $sql="select*from v_trabajador where bestado='1' and cont_comercial='1'".$where;
            $result = mysql_query($sql) or Msg_error($sql);
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
            return $prg;
        }
        
        function proveedor_ddl($empresa_id){
            $where=($empresa_id>0)?" and empresa_id=".(int)$empresa_id:"";
            $sql="select*from v_proveedor where bestado='1'".$where;
            $result = mysql_query($sql) or Msg_error($sql);
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
            return $prg;
        }
        
	
}
?>