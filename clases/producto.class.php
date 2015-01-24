<?php
class producto{
    function lista(){
        $sql="SELECT * from producto WHERE bestado='1' order by prod_nombre";        
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
        return $prg;
    }
    
    function prod_clasificacion(){
        $sql="SELECT * from prod_clasificacion WHERE bestado='1' ";        
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function prod_subclasif($clasificacion_id){
        $where=" and prod_clasificacion_id=".(int)$clasificacion_id;
        $sql="SELECT * from prod_subclasif WHERE bestado='1' ".$where;
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
        return $prg;
    }
    
    function prod_categoria($subclasif_id){
        $where=" and prod_subclasif_id=".(int)$subclasif_id;
        $sql="SELECT * from prod_categoria WHERE bestado='1' ".$where;
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
        return $prg;
    }
    
    function prod_clasifpropiedad($categoria_id=0){
        $where=" and prod_categoria_id=".(int)$categoria_id;
        $sql="SELECT * from prod_clasifpropiedad WHERE bestado='1' ".$where;        
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
        return $prg;
    }
    
    function moneda_tc(){
        $sql="SELECT * from moneda_tc WHERE bestado='1' order by mon_tc_fecha desc limit 1";        
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result,1);
        return $row;
    }
    
    function prod_propiedad($producto_id){
        $i=0;
        $data=array();
        $where=" and producto_id=".(int)$producto_id;
        $sql="SELECT *,
            (select prod_clasif_propiedad_orden from prod_clasifpropiedad where prod_clasifpropiedad_id=prod_propiedad.prod_clasifpropiedad_id)as prod_clasif_propiedad_orden, 
            (select prod_clasif_propiedad_umed from prod_clasifpropiedad where prod_clasifpropiedad_id=prod_propiedad.prod_clasifpropiedad_id)as prod_clasif_propiedad_umed,              
            (select prod_clasif_propiedad_nombre from prod_clasifpropiedad where prod_clasifpropiedad_id=prod_propiedad.prod_clasifpropiedad_id)as prod_clasif_propiedad_nombre,
            (select prod_clasif_propiedad_alias from prod_clasifpropiedad where prod_clasifpropiedad_id=prod_propiedad.prod_clasifpropiedad_id)as prod_clasif_propiedad_alias
            from prod_propiedad WHERE bestado='1' ".$where." order by prod_clasif_propiedad_orden";        
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){
            $data[]=$row;
            $i++;
        }
        mysql_free_result($result);
        //unset($data);
        $query = new stdClass();	
	$query->rows = $data;
	$query->num_rows = $i;       
        return $query;
    }
    
    
	
    function edit($accion,$id){
        switch($accion){
            case 'C':
                $sql="update producto set                    
                    prod_precio_venta='".$_REQUEST['prod_precio_venta']."',
                    prod_fec_cal='".$_REQUEST['prod_fec_cal']."',
                    cal_cif_unit_porcent=".(int)$_REQUEST['cif_unit_porc'].",
                    cal_moneda_id=".(int)$_REQUEST['moneda_id'].",
                    cal_margen=".$_REQUEST['cal_margen'].",
                    cal_transporte=".$_REQUEST['transporte'].",
                    cal_trans_descrip='".$_REQUEST['trans_descrip']."'
                    where producto_id=".(int)$id;
                $result=mysql_query($sql);
                //echo $sql;
            case 'S':
                $sql="SELECT*,
                    (select emp_nombre from v_proveedor where proveedor_id=(select proveedor_id from mm where mm_id=producto.marca_id ) limit 1)as proveedor
                     FROM producto WHERE producto_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                return mysql_fetch_array($result,1);
                break;
            case 'I':
                $sql="insert into producto(prod_nombre,prod_precio,prod_stock)values('".$_REQUEST['prod_nombre']."',".(int)$_REQUEST['prod_precio'].",".(int)$_REQUEST['prod_stock'].")";
                $result=mysql_query($sql);
                //$row=mysql_fetch_row($result);
                //return $row[0];
                break;
            case 'U':
                $sql="update producto set
                    prod_nombre='".$_REQUEST['prod_nombre']."',
                    prod_precio=".(int)$_REQUEST['prod_precio'].",
                    prod_stock=".(int)$_REQUEST['prod_stock']."
                    where producto_id=".(int)$id;
                $result=mysql_query($sql);
                break;
            case 'D':
                $sql="update producto set bestado='0' where producto_id=".(int)$id;
                $result=mysql_query($sql);
                break;           
        }

    }
}
?>