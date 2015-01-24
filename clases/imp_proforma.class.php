<?php
class imp_proforma{
    function lista(){
        $sql="select*from imp_proforma where bestado='1'";
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
                    DATE_FORMAT(imp_prof_fecha,'%d/%c/%Y')as fecha,
                    (select cont_email from v_contacto where contacto_id=ipd.prov_contacto_id)as correo_contacto,
                    (select cont_email from v_trabajador where trabajador_id=ipd.operador_id_atiende limit 1)as correo_atiende,
                    (select proy_nombre from proyecto where proyecto_id=ipd.proyecto_id)as proyecto,
                    (select pers_completo from v_trabajador where trabajador_id=ipd.operador_id_atiende)as atiende,
                    (select emp_nombre from v_proveedor where proveedor_id=ipd.proveedor_id limit 1)as proveedor,
                    (select ubigeo_pais_id from v_proveedor where proveedor_id=ipd.proveedor_id limit 1)as pais_id,
                    (select emp_nombre from v_cliente where cliente_id=ipd.cliente_id limit 1)as cliente,
                    (select pers_completo from v_contacto where contacto_id=ipd.prov_contacto_id limit 1)as prov_contacto,
                    (select pers_completo from v_contacto where contacto_id=ipd.cli_contacto_id limit 1)as cli_contacto
                    from imp_proforma as ipd where imp_proforma_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                return mysql_fetch_array($result,1);
                break;
            
            case 'C':
                                  
                $sql="update imp_proforma_detalle set
                      prod_ew='".$_REQUEST['prod_ew']."',
                      prod_cantidad='".$_REQUEST['prod_cantidad']."',
                      prod_ew_valor='".$_REQUEST['valor_ew']."',
                      prod_fob='".$_REQUEST['prod_fob']."',
                      prod_fob_valor='".$_REQUEST['valor_fob']."',
                      prod_cif='".$_REQUEST['prod_fc']."',
                      prod_cif_valor='".$_REQUEST['valor_cif']."',
                      prod_nac='".$_REQUEST['prod_nac']."',
                      prod_nac_valor='".$_REQUEST['valor_nac']."',
                      prod_flete_valor='".$_REQUEST['prod_flete_valor']."',
                      prod_otros1_valor='".$_REQUEST['prod_otros1_valor']."',
                      prod_otros2_valor='".$_REQUEST['prod_otros2_valor']."',
                      prod_precio_fab_unit='".($_REQUEST['prod_almacen_valor']/$_REQUEST['prod_cantidad'])."',
                      prod_almacen_valor='".$_REQUEST['prod_almacen_valor']."',
                      prod_adv='".$_REQUEST['prod_adv']."',
                      prod_adv_valor='".$_REQUEST['valor_adv']."',
                      prod_flete='".$_REQUEST['prod_ef']."',
                      prod_flete_valor='".$_REQUEST['flete']."',
                      imp_tipo_costo_id='".$_REQUEST['tipo_costo_id']."',
                      moneda_id=".(int)$_REQUEST['moneda_id_fin'].",
                      moneda_id_ini=".(int)$_REQUEST['moneda_id_ini'].",
                      precio_ini='".$_REQUEST['cantidad_ini']."',
                      precio_fin='".$_REQUEST['cantidad_fin']."'
                      where imp_prof_det_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                $sql="select tec_imp_proforma_detalle('IMP','','','','".(int)$id."','','','".$_REQUEST['prod_cantidad']."','".$_REQUEST['prod_precio_venta']."','','','".(int)$_REQUEST['moneda_id_fin']."','')";
                $result=mysql_query($sql) or Msg_error($sql);
                
                $sql="update producto set
                      cal_moneda_id=".(int)$_REQUEST['moneda_id_ini'].",
                      prod_precio_venta=".$_REQUEST['cantidad_ini'].",
                      imp_tipo_costo_id=".(int)$_REQUEST['tipo_costo_id']."
                      where producto_id=".(int)$_REQUEST['producto_id'];
                $result=mysql_query($sql) or Msg_error($sql);
                
                //echo $sql;
                                
                break;
            case 'D':
                $sql="select*,
                    (select prod_nombre from producto where producto_id=imp_proforma_detalle.producto_id)as producto_nombre,
                    (select prod_alias from producto where producto_id=imp_proforma_detalle.producto_id)as producto_alias
                    from imp_proforma_detalle where imp_proforma_id=".(int)$id." and bestado='1'";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;                
                break;
        }        
    }
    
    function imp_tipo_costo_ddl(){
        $sql="select*from imp_tipo_costo where bestado='1'";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function advalorem_ddl(){
        $sql="select*from advalorem where bestado='1'";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function imp_gasto($accion='',$id=0){
        switch($accion){
            case 'S':
                $sql="select * from imp_prof_gasto where imp_prof_gasto_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                return mysql_fetch_array($result,1);
                break;
            case 'L':
                $sql="select*,
                      (select mon_sigla from moneda where moneda_id=(select moneda_id from imp_proforma_detalle where imp_prof_det_id=imp_prof_gasto.imp_prof_det_id))as moneda
                      from imp_prof_gasto where imp_prof_det_id=".(int)$id." and bestado='1'";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
            case 'I':
                $sql="insert into imp_prof_gasto(imp_prof_det_id,imp_prof_gasto_nombre,imp_prof_gasto_valor)
                      values('".$_REQUEST['imp_prof_det_id']."','".$_REQUEST['imp_prof_gasto_nombre']."','".$_REQUEST['imp_prof_gasto_valor']."')";
                $result=mysql_query($sql) or Msg_error($sql);
                break;
            case 'U':
                $sql="update imp_prof_gasto set
                      imp_prof_gasto_nombre='".$_REQUEST['imp_prof_gasto_nombre']."',
                      imp_prof_gasto_valor='".$_REQUEST['imp_prof_gasto_valor']."'
                      where imp_prof_gasto_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                break;
            case 'D':
                $sql="update imp_prof_gasto set
                      bestado='0'
                      where imp_prof_gasto_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                break;
            case 'C':
                $sql="select ifnull(sum(imp_prof_gasto_valor),0)as total from imp_prof_gasto
                      where bestado='1' and imp_prof_det_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                $row=mysql_fetch_array($result,1);
                return $row['total'];
                break;
        }
    }
    
}
?>