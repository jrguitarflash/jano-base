<?php
class cobranza{
    function lista($cliente_id=0){
        $where=($cliente_id>0)?" and cliente_id=".$cliente_id:"";
        $prg=array();
        $sql="select*,              
              (select emp_nombre from v_cliente where cliente_id=cobranza.cliente_id limit 1)as cliente,             
              (select mon_sigla from moneda where moneda_id=cobranza.moneda_id)as moneda,
              date_format(cob_fecha_ini,'%d %b %y')as cob_fecha_ini,
              (select cp_nro_completo from v_pago_cp where cp_id=cobranza.cp_id)as cp_nro,
              (select sum(cob_det_monto) from cobranza_detalle where bestado='1' and cobranza_id=cobranza.cobranza_id)as cobrado
              from cobranza where bestado='1' ".$where;
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
    
   
    
    
    function cob_cliente_ddl(){
        $prg=array();
        $sql="SELECT cliente_id,
             (SELECT emp_nombre FROM v_cliente WHERE cliente_id = cobranza.cliente_id LIMIT 1) AS emp_nombre
              FROM cobranza
              WHERE bestado =  '1'
              GROUP BY cliente_id";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
    
}
?>
