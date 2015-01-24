<?php
class compras{
    function lista(){
        $sql="select*from compras where bestado='1'";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
    
    function lista_reporte($ano=0,$mes=0){
        $where=" where bestado='1' and empresa_id=".$_SESSION['SIS'][5];
        $where.=($mes>0)?" and MONTH(comp_fecha_ini)=".$mes:"";
        $where.=($ano>0)?" and YEAR(comp_fecha_ini)=".$ano:"";
        $where.=($_REQUEST['tipo']>0)?" and compra_tipo_id=".$_REQUEST['tipo']:'';
        $sql="select proveedor_id,
              (select sum(prod_precio_venta) from compras_detalle where bestado='1' and compras_id=c.compras_id)as total,
              (select emp_nombre from v_proveedor where proveedor_id=c.proveedor_id limit 1)as proveedor
              from compras c
              ".$where."
              group by proveedor_id";
        //echo $sql;
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
    
    function detalle($id){
        $sql="select*,
            (select prod_nombre from v_producto1 where producto_id=imp_proforma_detalle.producto_id)as producto
            from imp_proforma_detalle where bestado='1' and imp_prof_det_id=".(int)$id;
        $result=mysql_query($sql) or Msg_error($sql);
        return mysql_fetch_array($result,1);
    }
    
    function edit($accion='',$id=0){
        switch($accion){
            case 'S':
                $sql="select*,
                    (select proy_nombre from proyecto where proyecto_id=ipd.proyecto_id)as proyecto,
                    DATE_FORMAT(comp_fecha_ini,'%d/%c/%Y')as fecha,
                    (select emp_nombre from empresa where empresa_id=ipd.empresa_id_delivery limit 1)as delivery,
                    (select emp_direccion from empresa where empresa_id=ipd.empresa_id_delivery limit 1)as del_direccion,
                    (select emp_telef from empresa where empresa_id=ipd.empresa_id_delivery limit 1)as del_telef,
                    (select emp_nombre from empresa where empresa_id=ipd.empresa_id_invoice limit 1)as invoice,                    
                    (select emp_direccion from empresa where empresa_id=ipd.empresa_id_invoice limit 1)as inv_direccion,
                    (select emp_telef from empresa where empresa_id=ipd.empresa_id_invoice limit 1)as inv_telef,
                    (select emp_fax from empresa where empresa_id=ipd.empresa_id_invoice limit 1)as inv_fax,                    
                    (select emp_nombre from empresa where empresa_id=ipd.empresa_id limit 1)as empresa,
                    (select emp_direccion from empresa where empresa_id=ipd.empresa_id limit 1)as emp_direccion,
                    (select emp_telef from empresa where empresa_id=ipd.empresa_id limit 1)as emp_telef,
                    (select cont_email from v_contacto where contacto_id=ipd.prov_contacto_id)as correo_contacto,
                    (select cont_email from v_trabajador where trabajador_id=ipd.operador_id limit 1)as correo_atiende,
                    (select pers_completo from v_trabajador where trabajador_id=ipd.operador_id)as atiende,
                    (select ubigeo_pais_id from v_proveedor where proveedor_id=ipd.proveedor_id limit 1)as pais_id,
                    (select emp_nombre from v_proveedor where proveedor_id=ipd.proveedor_id limit 1)as proveedor,
                    (select emp_direccion from v_proveedor where proveedor_id=ipd.proveedor_id limit 1)as prov_direccion,
                    (select emp_telef from v_proveedor where proveedor_id=ipd.proveedor_id limit 1)as prov_telef,
                    (select emp_fax from v_proveedor where proveedor_id=ipd.proveedor_id limit 1)as prov_fax,
                    (select emp_nombre from v_cliente where cliente_id=ipd.proveedor_id limit 1)as cliente,
                    (select concat(pers_corto,' (',cont_email,')') from v_contacto where contacto_id=ipd.contacto_id_resp limit 1)as responsable,
                    (select concat(pers_corto,' (',cont_email,')') from v_contacto where contacto_id=ipd.contacto_id_resp2 limit 1)as responsable2,
                    (select concat(pers_completo,' (',cont_email,')') from v_contacto where contacto_id=ipd.prov_contacto_id limit 1)as prov_contacto,
                    (select pers_completo from v_contacto where contacto_id=ipd.prov_contacto_id limit 1)as cli_contacto,
                    (select mon_sigla from moneda where moneda_id=ipd.moneda_id)as moneda,
                    (select trab_firma from v_trabajador where trabajador_id=ipd.operador_id_firma)as firma,
                    pc_id as pcId
                    from compras as ipd where compras_id=".(int)$id;
                $result=mysql_query($sql);
                return mysql_fetch_array($result);
                break;
            case 'D':
                $sql="select*,
                    (select mon_sigla from moneda where moneda_id=compras_detalle.moneda_id)as moneda,
                    (select prod_nombre from producto where producto_id=compras_detalle.producto_id)as producto_nombre,
                    (select prod_alias from producto where producto_id=compras_detalle.producto_id)as producto_alias
                    from compras_detalle where comp_det_adjudicado='1' and compras_id=".(int)$id." and bestado='1'";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
        }        
    }
    
    function compras_tipo_ddl(){
         $sql="select*from compras_tipo where bestado='1'";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
    }
    
}
?>