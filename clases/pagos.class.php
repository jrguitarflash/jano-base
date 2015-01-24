<?php
class pagos{
    function lista($proveedor_id=0){
        $where=($proveedor_id>0)?" and proveedor_id=".$proveedor_id:"";
        $prg=array();
        $sql="select*,              
              (select emp_nombre from v_proveedor where proveedor_id=pagos.proveedor_id limit 1)as proveedor,
              (select mon_sigla from moneda where moneda_id=pagos.moneda_id)as moneda,
              date_format(pago_fecha,'%d %b %y')as pago_fecha,
              (select cp_nro_completo from v_pago_cp where cp_id=pagos.cp_id)as cp_nro,
              (select sum(pago_det_monto) from pago_detalle where bestado='1' and pago_id=pagos.pago_id)as pagado
              from pagos where bestado='1' ".$where;
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
    
    function pago_proveedor_ddl(){
        $prg=array();
        $sql="SELECT proveedor_id,
             (SELECT emp_nombre FROM v_proveedor WHERE proveedor_id = pagos.proveedor_id LIMIT 1) AS emp_nombre
              FROM pagos
              WHERE bestado =  '1'
              GROUP BY proveedor_id";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
}
?>
