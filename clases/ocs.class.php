<?php
class ocs{
//******************************************************************************
    function ocs_lista($accion='',$tipo=0,$limit=''){
        //Limite de consulta
        $limit=($limit>'')?" LIMIT ".$limit:"";
        // Venta/Compra
    	//$where=($tipo>0)?" and ocs_accion_id=".$tipo:"";
        //Fecha Emision
        $where.=($_GET['desde']>'')?" and ocs_fec_emis between '".$_GET['desde']."' and '".$_GET['hasta']."' ":"";
        //Tipo CP
        $where.=($_GET['ocs_tipo_id']>0)?" and ocs_tipo_id=".$_GET['ocs_tipo_id']:"";
        //Mes CP
        $where.=(($_GET['mes_id']>0)?" and MONTH(ocs_fec_emis)=".$_GET['mes_id']:"");
        //Por Cliente
        $where.=((int)$_GET['cliente_id']>0)?" and cliente_id=".(int)$_GET['cliente_id']:"";
        //Filtro Ajax
        switch($_GET['filtro']){
            case '1':
                $where.=" and ocs_nro like'".$_GET['valor']."%'".$fecha;
                break;
            case '2':
                $where.=" and ocs_tipo_id=".($_GET['valor']+0).$fecha;
                break;
            case '3':
                $where.=" and centro_costo_id=".($_GET['valor']+0).$fecha;
                break;
            case '4':
                $where.=" and cliente_id=".$_GET['valor'].$fecha;
                break;

        }


        switch($accion){
            case 'L':
                $sql = 'select*,
                (select cli_nombre from cliente where cliente_id=ocs.cliente_id)as cli_nombre,
                (select ocs_estado_nombre from ocs_estado where ocs_estado_id=ocs.ocs_estado_id)as ocs_estado_nombre,
                (select ocs_tipo_nombre from ocs_tipo where ocs_tipo_id=ocs.ocs_tipo_id)as ocs_tipo_nombre,
                (select mon_sigla from moneda where moneda_id=ocs.moneda_id)as mon_nombre,
                (select count(*)as total from ocs where bestado=1 '.$where.')as total
                from ocs where bestado=1 '.$where.' order by ocs_fec_emis desc'.$limit;
                break;
             case 'C': // Lista Cobranzas
                $sql = 'select*,
                (select cli_nombre from cliente where cliente_id=cp.cliente_id)as cli_nombre,
                (select ocs_estado_nombre from ocs_estado where ocs_estado_id=cp.ocs_estado_id)as ocs_estado_nombre,
                (select ocs_tipo_nombre from ocs_tipo where ocs_tipo_id=cp.ocs_tipo_id)as ocs_tipo_nombre,
                (select mon_sigla from moneda where moneda_id=cp.moneda_id)as mon_nombre,
                (select count(*)as total from cp where bestado=1 and ocs_estado_id=1 and ocs_monto_saldo>0 '.$where.')as total
                from ocs where bestado=1 and ocs_estado_id=1 and ocs_monto_saldo>0 '.$where.' order by ocs_fec_emis desc'.$limit;
                break;
            case 'T': // Total Registros
                $sql="SELECT count(*) as T from ocs where bestado=1 ".$where;
                break;
        }
        //echo $sql;
        $result = mysql_query($sql) or Msg_error($sql);
        if($accion=='L'||$accion=='C'){
            while($row=mysql_fetch_array($result,1)){
                $reg[]=$row;
            }
        }elseif($accion=='T'){
            $row=mysql_fetch_array($result,1);
            $reg=$row['T'];
        }
        return $reg;
    }

    function ocs_edit($id='',$accion=''){
    	$where=($id>'')?" WHERE bestado='1' AND ocs_id =$id":" WHERE bestado='1'";
        $estado=$_GET['ocs_estado_id'];
        switch ($accion){
            case 'C':
                $sql = "SELECT COUNT(*) AS C FROM ocs";
                break;
            case 'S':
                $sql = "SELECT *,
                (select cli_nombre from cliente where cliente_id=ocs.cliente_id)as cli_nombre,
                (select ocs_estado_nombre from ocs_estado where ocs_estado_id=ocs.ocs_estado_id)as ocs_estado_nombre,
                (select ocs_tipo_nombre from ocs_tipo where ocs_tipo_id=ocs.ocs_tipo_id)as ocs_tipo_nombre
                    FROM ocs".$where;
                break;
           case 'M':
                $sql = "select ifnull(max(ocs_id),0)+1 as C from ocs where bestado=1";
		break;
            case 'I':
                $sql = "insert into ocs(cliente_id,ocs_tipo_id,ocs_nro,ocs_fec_emis,ocs_fec_entrega,moneda_id,ocs_monto_tot,ocs_descrip,ocs_estado_id,ocs_adjunto,ocs_monto_sub,ocs_monto_igv,local_id,ubigeo_id_entrega,ubigeo_direcc_entrega,produccion_id)
                        values(".($_GET['cliente_id']+0).",".($_GET['ocs_tipo_id']).",'".$_GET['ocs_nro']."','".$_GET['ocs_fec_emis']."','".$_GET['ocs_fec_entrega']."',
                            ".($_GET['moneda_id']+0).",".($_GET['ocs_monto_tot']+0).",'".$_GET['ocs_descrip']."',".($estado+0).",'".$_GET['ocs_adjunto']."',".(int)$_GET['ocs_monto_sub'].",".(int)$_GET['ocs_monto_igv'].",".(int)$_GET['local_id'].",".(int)$_GET['ubigeo_id_entrega'].",'".$_GET['ubigeo_direcc_entrega']."',".(int)$_GET['produccion_id'].")";
                mysql_query($sql) or Msg_error($sql);
                $sql="select LAST_INSERT_ID()";
                break;
            case 'U':
                $sql = "update ocs set
                        cliente_id=".($_GET['cliente_id']+0).",
                        ocs_tipo_id=".($_GET['ocs_tipo_id']+0).",
                        local_id=".($_GET['local_id']+0).",
                        ocs_nro='".$_GET['ocs_nro']."',
                        ocs_fec_emis='".$_GET['ocs_fec_emis']."',
                        ocs_fec_entrega='".$_GET['ocs_fec_entrega']."',
                        ubigeo_id_entrega=".($_GET['ubigeo_id_entrega']+0).",
                        ubigeo_direcc_entrega='".$_GET['ubigeo_direcc_entrega']."',
                        moneda_id=".($_GET['moneda_id']+0).",
                        ocs_monto_tot=".($_GET['ocs_monto_tot']+0).",                        
                        ocs_monto_sub=".($_GET['ocs_monto_sub']+0).",
                        ocs_monto_igv=".($_GET['ocs_monto_igv']+0).",
                        ocs_descrip='".$_GET['ocs_descrip']."',
                        produccion_id='".$_GET['produccion_id']."',    
                        ocs_adjunto='".$_GET['ocs_adjunto']."',                                                                                        
                        ocs_estado_id=".($estado+0).$where;
                break;
            case 'D':
                $sql = "update ocs set bestado='0' ".$where;
                break;
		}
		if ($sql>''){
            $result = mysql_query($sql) or Msg_error($sql);
			if($accion=='S'){
				while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
				return $prg;
			}
			if($accion=='C' || $accion=='M'){
				$row=mysql_fetch_array($result);
				return $row['C'];
			}
                        if($accion=='I'){
				$row=mysql_fetch_array($result);
				return $row[0];
			}
        }
    }

    function ocs_adjunto($id=0,$name=''){
        $sql="update ocs set ocs_adjunto='".$name."' where ocs_id=".(int)$id;
        $result = mysql_query($sql) or Msg_error($sql);
    }

    function ocs_copy($id=0,$accion='',$condicion=''){
		$where=" WHERE ocs_id = ".(int)$id;
		switch ($accion){

		case 'I': // Duplicar
			$sql = "insert into cp(ocs_nro,ocs_accion_id,cliente_id,ocs_tipo_id,ocs_fec_emis,ocs_fec_venc,moneda_id,ocs_monto_tot,ocs_descrip,ocs_estado_id,ocs_adjunto,ocs_fec_cancel,ocs_medio_id,ocs_medio_valor,centro_costo_id)
                                select '".(string)$condicion."',ocs_accion_id,cliente_id,ocs_tipo_id,ocs_fec_emis,ocs_fec_venc,moneda_id,ocs_monto_tot,ocs_descrip,ocs_estado_id,ocs_adjunto,ocs_fec_cancel,ocs_medio_id,ocs_medio_valor,centro_costo_id
                                from ocs ".$where;

                        break;
                case 'D': // Detalle
			$sql = "insert into ocs_detalle(ocs_id,producto_id,pro_nombre,pro_cantidad,pro_garantia_fin,pro_nroserie,pro_precio_venta,pro_precio_compra,moneda_id,unidad_id,pro_descripcion,pro_subtotal,bestado)
                                select ".(int)$condicion.",producto_id,pro_nombre,pro_cantidad,pro_garantia_fin,pro_nroserie,pro_precio_venta,pro_precio_compra,moneda_id,unidad_id,pro_descripcion,pro_subtotal,bestado
                                from ocs_detalle".$where;
			break;
		}
		if($sql>''){
			$result = mysql_query($sql) or Msg_error($sql);
		}

    }

              

    function ocs_estado_ddl($id=''){
    	$where=($id>'')?" WHERE bestado='1' AND ocs_estado_id=$id":" WHERE bestado='1'";
        $sql = "SELECT * FROM ocs_estado ".$where;
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
    }

    function ocs_tipo_ddl($id=''){
    	$where=($id>'')?" WHERE bestado='1' AND ocs_tipo_id=$id":" WHERE bestado='1'";
        $sql = "SELECT * FROM ocs_tipo ".$where;
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
    }
    
    function ocs_ddl(){
    	//$where=($id>'')?" WHERE bestado='1' AND ocs_tipo_id=$id":" WHERE bestado='1'";
        $sql = "SELECT * FROM ocs where bestado=1";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
    }


//*****************************[fin clase]**************************************
}
?>