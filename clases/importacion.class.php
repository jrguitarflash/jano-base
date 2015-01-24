<?php
class importacion{
    function proforma_lista(){
        $sql="select * from imp_proforma where bestado='1'";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        break;
    }
    
    function edit($imp_proforma_id,$producto_id){
        $sql="insert into imp_proforma_detalle(imp_proforma_id,producto_id,prod_nombre,prod_cantidad,prod_precio_fab_unit,moneda_id,prod_comentario)
              select ".(int)$imp_proforma_id.",producto_id,prod_nombre,0,prod_precio_venta,cal_moneda_id,prod_descrip from producto 
              where producto_id=".(int)$producto_id;
        $result=mysql_query($sql) or Msg_error($sql);
    }
}
?>
