<?php
$obj_php='cliente.class.php';
class cliente{
//******************************************************************************
    function cliente_lista($qry='',$limit=''){
        $limit=($limit>'')?" LIMIT ".$limit:"";
	//$qry=($qry>'')?orderBy($qry):' ORDER BY cli_nombre';
        $where=($_GET['filtro'])?" and ".$_GET['filtro']." like '%".$_GET['valor']."%'":"";
        $sql = "SELECT *,
        (SELECT local_id FROM local WHERE local.cliente_id=cliente.cliente_id limit 1) AS local_id,
        
        (SELECT con_nombre+' '+con_apellido FROM operador,contacto WHERE contacto.contacto_id=operador.contacto_id AND operador_id=cliente.operador_id) AS ejecutivo,
        (SELECT COUNT(*) FROM cliente WHERE bestado='1' ".$where.$qry.") AS total
        FROM cliente
        WHERE bestado='1' ".$where.$qry.$limit;
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		paginaresto(count($prg),$prg[0]['ctotal']);
        mysql_free_result($result);
		return $prg;
    }
    function proveedor_lista($qry=''){
		$qry=($qry>'')?orderBy($qry):' ORDER BY cli_nombre';
        $sql = "SELECT *,ctotal,
        (SELECT ubigeo_nombre FROM ubigeo WHERE ubigeo_id = cliente.ubigeo_id_fac) AS ubigeo_nombre,
        (SELECT con_nombre+' '+con_apellido FROM operador,contacto WHERE contacto.contacto_id=operador.contacto_id AND cliente.operador_id) AS ejecutivo
        FROM cliente,(SELECT COUNT(*) AS ctotal FROM cliente WHERE bestado='1' AND cli_proveedor='1' ".$qry.") AS c
        WHERE bestado='1' AND cli_proveedor='1' ".$qry.limit(10);
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		paginaresto(count($prg),$prg[0]['ctotal']);
        mysql_free_result($result);
		return $prg;
    }
	
	
    function cliente_edit($id='',$accion=''){
    	$where=($id>'')?" WHERE bestado='1' AND cliente_id =$id":" WHERE bestado='1' AND cliente_id=0";
	switch($accion){
            case 'C':
                $sql = "SELECT COUNT(*) AS C FROM cliente";
                break;
            case 'S':
            case 'E':
                $sql = "SELECT *,
                        concat(cli_ruc,' - ',cli_nombre)as cli_rz,
                        
			(SELECT ce_nombre FROM cliestado WHERE cliestado_id=cliente.cliestado_id) AS ce_nombre,
			(SELECT ope_login FROM operador WHERE operador_id=cliente.operador_id) AS ejecutivo
			FROM cliente".$where;
                break;

            case 'I':
		$sql="CALL palwp_cliente('".$accion."',0,'".$_GET['cli_ruc']."','".$_GET['cli_nombre']."','".$_GET['cli_pass']."','".$_GET['cliestado_id']."','".$_GET['cliente_tipo_id']."','".$_GET['cli_email']."','".$_GET['cli_web']."','".$_GET['cli_formapago_id']."','".$_GET['cli_fecpago']."','".$_GET['operador_id']."','".$_GET['cli_coment']."','".$_GET['cli_proveedor']."','".$_GET['cli_codigo']."','".$_GET['ope_id_gestion']."','".$_GET['cli_recurrente']."','".$_GET['cli_direccion']."',".(int)$_GET['cli_ubigeo_id'].",'".$_GET['cli_telef']."')";
                mysql_query($sql) or Msg_error($sql);
                $sql="select LAST_INSERT_ID()";
                break;
            case 'U':
                $sql="CALL palwp_cliente('".$accion."',$id,'".$_GET['cli_ruc']."','".$_GET['cli_nombre']."','".$_GET['cli_pass']."','".$_GET['cliestado_id']."','".$_GET['cliente_tipo_id']."','".$_GET['cli_email']."','".$_GET['cli_web']."','".$_GET['cli_formapago_id']."','".$_GET['cli_fecpago']."','".$_GET['operador_id']."','".$_GET['cli_coment']."','".$_GET['cli_proveedor']."','".$_GET['cli_codigo']."','".$_GET['ope_id_gestion']."','".$_GET['cli_recurrente']."','".$_GET['cli_direccion']."',".(int)$_GET['cli_ubigeo_id'].",'".$_GET['cli_telef']."')";
                break;
            case 'D':
                $sql="CALL palwp_cliente('".$accion."',$id,'','','',0,0,'','',0,'',0,'','','',0,0,'',0,'')";
                break;
	}
        
	if($sql>''){
            $result=mysql_query($sql) or Msg_error($sql);
			if ($accion=='C'){
				$row=mysql_fetch_array($result);
				return $row['C'];
			}elseif ($accion=='S'){
				while($row=mysql_fetch_array($result)){$prg[]=$row;}
				return $prg;
			}elseif($accion=='E'){
				return mysql_fetch_array($result,1);
			}elseif($accion=='I'){
				$row=mysql_fetch_array($result);
				return $row[0];
			}
        }
    }
    function cliente_contacto_lista($accion='',$id='',$local_id=0,$qry='',$limit=''){
        //Limite de consulta
        $limit=($limit>'')?" LIMIT ".$limit:"";
        $where=($local_id>0)?" and local_id=".$local_id:"";
        $where.=($id>'')?' AND cliente_id='.$id:'';
	//$where.=($qry>'')?orderBy($qry):' ORDER BY con_nombre';
        switch($_GET['filtro']){
            case "con_nombre":
                $where.=($_GET['valor']>'')?" and concat(con_nombre,' ',con_apellido) like '%".$_GET['valor']."%'":"";
                break;
            case "con_telef":
                $where.=($_GET['valor']>'')?" and ".$_GET['filtro']." like '%".$_GET['valor']."%'":"";
                break;
        }
        
        switch ($accion){
            case "C":
                $sql="SELECT COUNT(*) AS C FROM contacto WHERE cliente_id=$id+0 and bestado='1'";
                break;
            case "S":
                $sql="SELECT *,
                (SELECT con_estado_sigla FROM con_estado WHERE con_estado_id=contacto.con_estado_id) AS estado,
                (SELECT cli_nombre FROM cliente WHERE cliente_id=contacto.cliente_id) AS cli_nombre,
                (select count(*)as total from contacto where bestado=1 ".$where.")as total
                FROM contacto WHERE bestado='1' ".$where.$limit;
                break;
        }        
        $result=mysql_query($sql) or Msg_error($sql);
        if($accion=="S"){
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
            return $prg;
        }
        if($accion=="C"){
            $row=mysql_fetch_array($result);
            return $row['C'];
        }
    }


     function cliente_pedidos_lista($id='',$estado='',$importe=false){
        if($estado>''){$and=" AND proestado_id=$estado ";}
        if($importe==true){$and .= " AND pro_importe>0 ";}
        $where=($id>'')?" WHERE pro_nroreq=$id AND bestado='1' $and":" WHERE bestado='1' $and ORDER BY pro_fecini";
        $sql = "SELECT *,
        REPLACE(equ_fecha_fin,'0000-00-00 00:00:00','') AS equ_fecha_fin,
        (SELECT equ_nombre FROM equipo WHERE equipo_id=produccion.equipo_id)AS equ_nombre,
        (SELECT mat_nombre FROM material WHERE material_id=produccion.material_id)AS mat_nombre,
        (SELECT for_nombre FROM formato WHERE formato_id=produccion.formato_id) AS for_nombre,
        (SELECT mon_sigla FROM moneda WHERE moneda_id=produccion.moneda_id) AS mon_sigla ,
        (SELECT mon_nombre FROM moneda WHERE moneda_id=produccion.moneda_id) AS mon_nombre
        FROM produccion ".$where;
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        mysql_free_result($result);
		return $prg;
    }
    function formapago_ddl(){
        $sql="SELECT formapago_id AS id,tp_nombre AS nombre,tp_sigla AS sigla,
        tp_coment AS coment FROM formapago WHERE bestado='1' ORDER BY tp_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
    function cliente_req_lista($cliente_id='',$pro_nroreq='',$estado='',$ejecutivo=''){
    	$where=($cliente_id>'')?" AND cliente_id=".$cliente_id:'';
    	if($pro_nroreq>''){$where=" AND pro_nroreq=".$pro_nroreq;}
        if($estado>''){$where.=" AND proestado_id IN(".$estado.")";}
        if($ejecutivo>'0'){$where.=" AND ope_id_ejec = ".$ejecutivo;}
        $sql="SELECT SQL_CALC_FOUND_ROWS pro_nroreq,cliente_id,LEFT(MAX(pro_fecini),10) AS pro_fecini,
        contacto_id,ope_id_ejec,COUNT(pro_nroreq) AS totalreq,MAX(mon_sigla) AS mon_sigla,
        SUM(pro_importe) AS importe,proestado_id,REPLACE(LEFT(MAX(pro_fecest),10),'0000-00-00','') AS pro_fecest
        FROM produccion AS p INNER JOIN moneda AS m ON p.moneda_id=m.moneda_id
        WHERE p.bEstado='1' ".$where."
        GROUP BY pro_nroreq,contacto_id,cliente_id,ope_id_ejec,proestado_id".limit(10);
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        paginaresto(count($prg));
        return $prg;
    }
    function cliestado_ddl(){
        $sql="SELECT cliestado_id AS id,ce_nombre AS nombre,ce_descrip FROM cliestado WHERE bestado='1' ORDER BY ce_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }

    function cliente_tipo_ddl($id=0){
        $sql="SELECT * FROM cliente_tipo WHERE bestado='1' ORDER BY cliente_tipo_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }

    function cliente_local_ddl($id=0){
        $sql="SELECT*from local where cliente_id=".(int)$id;
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function cliente_ddl($empresa_id=0){
        $where=($empresa_id>0)?" and empresa_id=".(int)$empresa_id:"";
        $sql="SELECT*from v_cliente where bestado='1'".$where." order by emp_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
	
//*****************************[fin clase]********************************
}
?>