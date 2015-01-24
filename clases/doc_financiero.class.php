<?php
class doc_financiero{
    function lista($tipo=0,$moneda_id=0){
        $prg=array();
        $where=($tipo>0)?" and doc_fin_tipo_id=".$tipo:"";
        $where.=($moneda_id>0)?" and moneda_id=".$moneda_id:"";
        $sql="SELECT *,
        (select emp_nombre from v_cliente where cliente_id=doc_financiero.cliente_id limit 1) AS cliente,
        (select doc_fin_tipo_nombre from doc_financiero_tipo where doc_fin_tipo_id=doc_financiero.doc_fin_tipo_id) AS tipo,
        (select doc_fin_est_nombre from doc_financiero_estado where doc_fin_estado_id=doc_financiero.doc_fin_estado_id) AS estado,
        (select mon_sigla from moneda where moneda_id=doc_financiero.moneda_id)as moneda
        FROM doc_financiero WHERE bestado='1' and weekofyear(doc_fin_fec_emis)=weekofyear(curdate())".$where;        
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function lista_reporte(){
        $where=($_REQUEST['cliente_id']>0)?" and cliente_id=".$_REQUEST['cliente_id']:"";
        $where.=($_REQUEST['doc_fin_tipo_id']>0)?" and doc_fin_tipo_id=".$_REQUEST['doc_fin_tipo_id']:"";
        $sql="SELECT *,
        (select mon_sigla from moneda where moneda_id=doc_financiero.moneda_id)as moneda_imp,
        (select mon_sigla from moneda where moneda_id=doc_financiero.moneda_id_garantia)as moneda_gar,
        (select emp_nombre from v_cliente where cliente_id=doc_financiero.cliente_id limit 1) AS cliente,
        (select doc_fin_tipo_nombre from doc_financiero_tipo where doc_fin_tipo_id=doc_financiero.doc_fin_tipo_id) AS tipo,
        (select doc_fin_est_nombre from doc_financiero_estado where doc_fin_estado_id=doc_financiero.doc_fin_estado_id) AS estado 
        FROM doc_financiero WHERE bestado='1'".$where;        
        $result=mysql_query($sql) or Msg_error($sql);
        
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        
    }
    
    function tipo_cambio(){
        $sql="SELECT *,
              concat(dayname(mon_tc_fecha),' ',day(mon_tc_fecha),' de ',monthname(mon_tc_fecha),' del ',year(mon_tc_fecha))as fecha
              FROM moneda_tc order by mon_tc_fecha desc limit 1";
        $result=mysql_query($sql) or Msg_error($sql);
        $row=mysql_fetch_array($result,1);
        return $row;
    }
    
    function doc_fin_tipo(){
        $sql="SELECT * from doc_financiero_tipo where bestado='1' order by doc_fin_tipo_nombre";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    function doc_fin_resumen($accion='',$tipo=0,$moneda_id=0){
        $where=($tipo>0)?" and doc_fin_tipo_id=".$tipo:"";
        $where.=($moneda_id>0)?" and moneda_id=".$moneda_id:"";
        switch($accion){
            case 'S':                
                $sql="select count(*)as cantidad,doc_fin_tipo_id,(select doc_fin_tipo_nombre from doc_financiero_tipo where doc_fin_tipo_id=doc_financiero.doc_fin_tipo_id)as doc_fin_tipo_nombre,sum(doc_fin_valor)as total 
                      FRom doc_financiero
                      where bestado='1' and weekofyear(doc_fin_fec_venc)=weekofyear(curdate())".$where."
                      group by doc_fin_tipo_id";
                $result=mysql_query($sql) or Msg_error($sql);
                $row=mysql_fetch_array($result,1);
                return $row;
                break;
            case 'L':
                $where=($tipo>0)?" and doc_fin_tipo_id=".$tipo:"";
                $sql="select *
                      FRom doc_financiero
                      where bestado='1'".$where;
                $result=mysql_query($sql) or Msg_error($sql);                 
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
        }
        
        
        
    }
    
    
}
?>
