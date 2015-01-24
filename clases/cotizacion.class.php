<?php
class cotizacion{
    function lista($empresa_id=0,$operador_id=0){
        $where=" and empresa_id=".(int)$empresa_id." and operador_id=".(int)$operador_id;
        $sql="select*,
              (select emp_nombre from empresa where empresa_id=cotizacion.empresa_id)as emp_nombre,
              (select emp_nombre from empresa where empresa_id=cotizacion.cliente_id)as cliente
              from cotizacion where bestado='1' and cot_estado_id in(1,4) ".$where;
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
    
    
    function cot_prod($cotizacion_id,$producto_id){
        $sql="select tec_cotizacion ('ADD','".$producto_id."','','','".$cotizacion_id."','','','','','','','','','','','','','','','','','','','','','','','','','','') ";
        $result=mysql_query($sql) or Msg_error($sql);     
        //echo $sql;        
    }
    function cot_informe($empresa_id){
      session_start();
        $where=($_REQUEST['cot_estado_id']>0)?" and cot_estado_id=".$_REQUEST['cot_estado_id']:'';
        $where.=($_REQUEST['responsable_id']>0)?" and operador_id=".$_REQUEST['responsable_id']:'';
        $where.=(($_REQUEST['desde']>''&&$_REQUEST['hasta']>''))?" and cot_fec_emis between '".$_REQUEST['desde']."' and '".$_REQUEST['hasta']."'":"";
        $prg=array();
        $sql="select*,
                DATE_FORMAT(cot_fec_emis,'%d/%c/%Y')as fecha_emision,
                (select mon_sigla from moneda where moneda_id=cotizacion.moneda_id)as moneda,
                (select cot_estado_nombre from cot_estado where cot_estado_id=cotizacion.cot_estado_id)as estado,
                (select cont_email from contacto where contacto_id=cotizacion.contacto_id)as correo_contacto,
                (select cont_email from contacto where contacto_id=cotizacion.operador_id)as correo_atiende,
                (select pers_completo from v_trabajador where trabajador_id=cotizacion.operador_id)as responsable,
                (select emp_nombre from empresa where empresa_id=cotizacion.empresa_id)as emp_nombre,
                (select emp_nombre from empresa where empresa_id=cotizacion.cliente_id)as cliente,
                (select proy_nombre from proyecto where proyecto_id=cotizacion.proyecto_id)as proy_nombre,
                (select pers_completo from v_contacto where contacto_id=cotizacion.contacto_id)as contact_nombre                     
                from cotizacion where bestado='1' and empresa_id=".(int)$empresa_id.$where." order by responsable,cot_fec_emis";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    function edit($accion,$id){
        $prg=array();
        switch($accion){
            case "M": // Cambiar margen
                $sql="update cotizacion set 
                      cot_margen='".$_REQUEST['cot_margen']."',
                      cot_margen_fecha=NOW(),
                      cot_margen_aut=".(int)$_REQUEST['trabajador_id']."
                      where cotizacion_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                break;
            case 'E':
                // and operador_id=".(int)$_SESSION['SIS'][2]."
                $sql="select count(*) as c from cotizacion where bestado='1' and empresa_id=".(int)$_SESSION['SIS'][5]." and cot_estado_id=".($id);
                $result=mysql_query($sql);
                $row= mysql_fetch_array($result);
                return $row['c'];
                break;
            case "L":
                $sql="select*,
                     DATE_FORMAT(cot_fec_emis,'%d/%c/%Y')as fecha_emision,
                     (select mon_sigla from moneda where moneda_id=cotizacion.moneda_id)as moneda,
                     (select cot_estado_nombre from cot_estado where cot_estado_id=cotizacion.cot_estado_id)as estado,
                     (select cont_email from contacto where contacto_id=cotizacion.contacto_id)as correo_contacto,
                     (select cont_email from v_trabajador where trabajador_id=cotizacion.operador_id limit 1)as correo_atiende,
                     (select pers_completo from v_trabajador where trabajador_id=cotizacion.operador_id)as responsable,
                     (select emp_nombre from empresa where empresa_id=cotizacion.empresa_id)as emp_nombre,
                     (select emp_nombre from empresa where empresa_id=cotizacion.cliente_id)as cliente,
                     (select proy_nombre from proyecto where proyecto_id=cotizacion.proyecto_id)as proy_nombre,
                     (select pers_completo from v_contacto where contacto_id=cotizacion.contacto_id)as contact_nombre                     
                     from cotizacion where bestado='1' and empresa_id=".(int)$id." and operador_id=".$_SESSION['SIS'][2]." order by cot_fec_emis desc limit 0,10";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
            case "S":
                $sql="select*,
                     DATE_FORMAT(cot_fec_emis,'%d/%c/%Y')as fecha_emision,
                     (select cont_email from contacto where contacto_id=cotizacion.contacto_id)as correo_contacto,
                     (select cont_email from contacto where contacto_id=cotizacion.operador_id)as correo_atiende,
                     (select pers_completo from v_trabajador where trabajador_id=cotizacion.operador_id)as responsable,
                     (select emp_nombre from empresa where empresa_id=cotizacion.empresa_id)as emp_nombre,                     
                     (select emp_nombre from empresa where empresa_id=cotizacion.cliente_id)as cliente,
                     (select emp_direccion from empresa where empresa_id=cotizacion.cliente_id)as cli_direccion,
                     (select emp_telef from empresa where empresa_id=cotizacion.cliente_id)as cli_telef,
                     (select proy_nombre from proyecto where proyecto_id=cotizacion.proyecto_id)as proy_nombre,
                     (select pers_completo from v_contacto where contacto_id=cotizacion.contacto_id)as contact_nombre                     
                     from cotizacion where cotizacion_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                return mysql_fetch_array($result,1);                
                break;
            case "D":
                $sql="select*,
                    (select prod_alias from producto where producto_id=cot_detalle.producto_id)as prod_alias,
                    (select prod_descrip from producto where producto_id=cot_detalle.producto_id)as prod_descrip,
                    (select prod_nombre from producto where producto_id=cot_detalle.producto_id)as prod_nombre,
                    (select prod_tipo_nombre from prod_tipo where prod_tipo_id=(select prod_tipo_id from producto where producto_id=cot_detalle.producto_id))as tipo_nombre,
                    (select mm_nombre from mm where mm_id=(select marca_id from producto where producto_id=cot_detalle.producto_id))as marca_nombre,
                    (select mm_nombre from mm where mm_id=(select modelo_id from producto where producto_id=cot_detalle.producto_id))as modelo_nombre,
                    round(pro_cantidad*pro_precio_venta,2) as total,
                    (select mon_sigla from moneda where moneda_id=cot_detalle.moneda_id)as moneda,
                    (cot_det_orden+0)as orden
                    from cot_detalle where bestado='1' and cotizacion_id=".(int)$id." order by orden";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
        }
    }
    function cot_estado_lista($id=0,$ano=0,$mes=0){
        $where=($ano>0)?" and YEAR(cot_fec_emis)=".$ano:" and YEAR(cot_fec_emis)=YEAR(NOW())";
        $where.=($mes>0)?" and MONTH(cot_fec_emis)=".(int)$mes:" and MONTH(cot_fec_emis)=MONTH(NOW())";        
        $sql="select count(*) as c from cotizacion where bestado='1' and operador_id=".(int)$_SESSION['SIS'][2]." and empresa_id=".(int)$_SESSION['SIS'][5].$where." and cot_estado_id=".($id);
        $result=mysql_query($sql);
        $row= mysql_fetch_array($result);        
        return $row['c'];
    }
    function cot_estado_ddl(){        
        $prg=array();
        $sql="select*from cot_estado where bestado='1' order by cot_estado_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
}
?>
