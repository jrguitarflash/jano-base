<?php
class oc{
    function lista(){
        $sql="select*from oc where bestado='1'";
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
                    DATE_FORMAT(oc_fec_emis,'%d/%c/%Y')as fecha,
                    (select emp_nombre from empresa where empresa_id=ipd.empresa_id limit 1)as empresa,                   
                    (select cont_email from v_contacto where contacto_id=ipd.operador_id)as correo_atiende,
                    (select pers_completo from v_trabajador where trabajador_id=ipd.operador_id)as atiende,                    
                    (select emp_nombre from empresa where empresa_id=ipd.cliente_id limit 1)as cliente
                    from oc as ipd where oc_det_adjudicado='1' and bestado='1' and oc_id=".(int)$id;
                $result=mysql_query($sql);
                return mysql_fetch_array($result);
                break;
            case 'D':
                $sql="select*,
                    (select prod_nombre from producto where producto_id=oc_detalle.producto_id)as producto
                    from oc_detalle where oc_id=".(int)$id." and bestado='1'";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
        }        
    }
    
}
?>