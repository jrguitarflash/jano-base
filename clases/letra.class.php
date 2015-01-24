<?php
class letra{
    function letra_empresa($tipo=0){
        $prg=array();
        $where=($_REQUEST['cliente_id']>0)?" and l.cliente_id=".$_REQUEST['cliente_id']:"";
        $where=($_REQUEST['proveedor_id']>0)?" and l.proveedor_id=".$_REQUEST['proveedor_id']:"";        
        $tipo=$_REQUEST['tipo'];
        switch($tipo){
            case 1:
                $campos="l.cliente_id,(select emp_nombre from v_cliente where bestado='1' and cliente_id=d.cliente_id limit 1)as cliente";
                $group="l.cliente_id";
                break;
            case 2:
                $campos="l.proveedor_id,(select emp_nombre from v_proveedor where bestado='1' and proveedor_id=l.proveedor_id limit 1)as proveedor";
                $group="l.proveedor_id";
                break;
        }
        $sql="select ".$campos."
              from letra l inner join letra_detalle d
              on l.letra_id=d.letra_id
              where l.bestado='1' and d.bestado='1' and l.letra_tipo_id=".$tipo." ".$where." group by ".$group;
        $result=mysql_query($sql) or Msg_error($sql);
        //echo $sql."<br>";
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    function lista($cliente_id=0,$proveedor_id=0){        
        $where.=($cliente_id>0)?" and l.cliente_id=".$cliente_id:"";
        $where.=($proveedor_id>0)?" and l.proveedor_id=".$proveedor_id:"";
        $where.=($_REQUEST['banco_id']>0)?" and banco_id=".$_REQUEST['banco_id']:"";
        $where.=($_REQUEST['tipo']>0)?" and l.letra_tipo_id=".$_REQUEST['tipo']:"";
        switch ($_REQUEST['fecha_filtro']){
            case 'fecha_ini':
                $where.=($_REQUEST['fecha_valor']>'')?" and d.letra_det_fec_emis='".$_REQUEST['fecha_valor']."'":"";
                break;
            case 'fecha_fin':
                $where.=($_REQUEST['fecha_valor']>'')?" and d.letra_det_fec_venc='".$_REQUEST['fecha_valor']."'":"";
                break;
        }
        
        
        
        $sql="select *,
              (select mon_sigla from moneda where moneda_id=l.moneda_id)as moneda,
              concat(day(letra_det_fec_emis),' ',left(monthname(letra_det_fec_emis),3),' ',right(year(letra_det_fec_emis),2))as letra_det_fec_emis,
              concat(day(letra_det_fec_venc),' ',left(monthname(letra_det_fec_venc),3),' ',right(year(letra_det_fec_venc),2))as letra_det_fec_venc,
              (select emp_nombre from v_cliente where bestado='1' and cliente_id=d.cliente_id limit 1)as cliente,
              (select emp_nombre from v_proveedor where bestado='1' and proveedor_id=l.proveedor_id limit 1)as proveedor,
              (select banco_nombre from banco where bestado='1' and banco_id=d.banco_id limit 1)as banco
              from letra l inner join letra_detalle d
              on l.letra_id=d.letra_id
              where l.bestado='1' and d.bestado='1' ".$where." order by d.letra_det_fec_emis desc";
        $result=mysql_query($sql) or Msg_error($sql);
        //echo $sql."<br>";
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function detalle($letra_detalle_id=0){
        $sql="select*from letra_det_amortizacion where bestado='1' and letra_detalle_id=".(int)$letra_detalle_id." order by letra_det_nro";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function edit($accion='',$id=0){
        switch($accion){
            case 'S':
                $sql = "SELECT letra_det_monto-sum(letra_det_amort_monto_pago)as monto_pagado 
                        FROM letra_det_amortizacion 
                        where bestado='1' and letra_detalle_id=".$id;
                $result=mysql_query($sql) or Msg_error($sql);
                return mysql_fetch_array($result,1);
                break;
            case 'L':
                $sql="select *,
                     (select mon_sigla from moneda where moneda_id=l.moneda_id)as moneda,
                     (select emp_nombre from v_cliente where bestado='1' and cliente_id=l.cliente_id limit 1)as cliente,
                     (select emp_nombre from v_proveedor where bestado='1' and proveedor_id=l.proveedor_id limit 1)as proveedor
                     from letra l 
                     where bestado='1'";
                $result=mysql_query($sql) or Msg_error($sql);
     
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
            case 'D':
                $sql="select *,
                    datediff(d.letra_det_fec_venc,curdate())as dias_venc,
                    (select banco_nombre from banco where banco_id=d.banco_id)as banco,
                    (select mon_sigla from moneda where moneda_id=l.moneda_id)as moneda,
                    (select emp_nombre from v_cliente where bestado='1' and cliente_id=l.cliente_id limit 1)as cliente,
                    (select emp_nombre from v_proveedor where bestado='1' and proveedor_id=l.proveedor_id limit 1)as proveedor
                    from letra l inner join letra_detalle d
                    on l.letra_id=d.letra_id
                    where l.bestado='1' and d.bestado='1' and l.letra_tipo_id=".(int)$id." and weekofyear(d.letra_det_fec_venc)=weekofyear(curdate()) order by d.letra_det_fec_venc limit 10";
                $result=mysql_query($sql) or Msg_error($sql);
     
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
        }
    }


    function banco_ddl(){
        $sql="select*from banco where bestado='1' order by banco_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    function letra_tipo_ddl(){
        $sql="select*from letra_tipo where bestado='1' order by letra_tipo_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function letra_resumen($accion='',$tipo=0,$moneda_id=0){
        $where=($tipo>0)?" and letra_tipo_id=".$tipo:"";
        $where.=($moneda_id>0)?" and l.moneda_id=".$moneda_id:"";
        switch($accion){
            case 'S':
                $sql="select letra_tipo_id,count(*)as cantidad,sum(letra_det_monto)as total
                      from letra_detalle d inner join letra l
                      on d.letra_id=l.letra_id
                      where d.bestado='1' and weekofyear(letra_det_fec_venc)=weekofyear(curdate())".$where."
                      group by letra_tipo_id";
                $result=mysql_query($sql) or Msg_error($sql);
                $row=mysql_fetch_array($result,1);
                return $row;
                break;
            case 'L':
                $sql="select *,
                      (select mon_sigla from moneda where moneda_id=l.moneda_id)as moneda,
                      (select emp_nombre from v_cliente where bestado='1' and cliente_id=d.cliente_id limit 1)as cliente,
                      (select emp_nombre from v_proveedor where bestado='1' and proveedor_id=l.proveedor_id limit 1)as proveedor,
                      (select banco_nombre from banco where bestado='1' and banco_id=d.banco_id limit 1)as banco
                      from letra l inner join letra_detalle d
                      on l.letra_id=d.letra_id
                      where d.bestado='1' and weekofyear(letra_det_fec_venc)=weekofyear(curdate())".$where;
                $result=mysql_query($sql) or Msg_error($sql);     
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
        }        
    }
    
}
?>
