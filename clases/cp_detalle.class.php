<?php
class cp_comp_det{
//******************************************************************************
    function lista($cp_id=0){
    	$and=($cp_id>0)?" and cp_id=".$cp_id:" and cp_id=0";
        $sql = "SELECT *,
                (select prod_nombre from producto where producto_id=cp_detalle.producto_id)as producto
                FROM cp_detalle WHERE bestado='1' ".$and;
	$result = mysql_query($sql) or Msg_error($sql);
	while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        mysql_free_result($result);
	return $prg;
    }

    function edit($id=0,$accion=''){
    	$where=" WHERE bestado='1' AND cp_detalle_id =".$id;
        switch ($accion){
            case 'C':
                $sql = "SELECT COUNT(*) AS C FROM cp_comp_detalle";
                break;
            case 'S':
                $sql = "SELECT * FROM cp_comp_detalle ".$where;
                break;
            case 'I':
                $sql = "insert into cp_detalle(cp_id,producto_id,pro_nombre,pro_cantidad,pro_garantia_fin,pro_nroserie,pro_precio_venta,moneda_id,unidad_id,pro_descripcion,pro_subtotal)
                        values(".($_REQUEST['cp_id']+0).",".($_REQUEST['prodcuto_id']+0).",'".$_REQUEST['pro_nombre']."',".(int)$_REQUEST['pro_cantidad'].",'".$_REQUEST['pro_garantia_fin']."','".$_REQUEST['pro_nroserie']."',
                            ".($_REQUEST['pro_precio_venta']+0).",".($_REQUEST['moneda_id']+0).",".($_REQUEST['unidad_id']+0).",'".$_REQUEST['pro_descripcion']."',".($_REQUEST['pro_subtotal']+0).")";
                break;
            case 'U':
                $sql = "update cp_comp_detalle set
                        producto_id=".($_REQUEST['producto_id']+0).",
                        pro_nombre='".$_REQUEST['pro_nombre']."',
                        pro_cantidad=".$_REQUEST['pro_cantidad'].",
                        pro_garantia_fin='".$_REQUEST['pro_garantia_fin']."',
                        pro_nroserie='".$_REQUEST['pro_nroserie']."',
                        moneda_id=".($_REQUEST['moneda_id']+0).",
                        pro_precio_compra=".($_REQUEST['pro_precio_compra']+0).",
                        pro_descripcion='".$_REQUEST['pro_descripcion']."',
                        pro_subtotal=".($_REQUEST['pro_subtotal']+0).",
                        unidad_id=".($_REQUEST['unidad_id']+0).$where;
                break;
            case 'D':
                $sql = "update cp_detalle set bestado='0' ".$where;
                break;
	}                
		if ($sql>''){                    
                        $result = mysql_query($sql) or Msg_error($sql);
			if($accion=='S'){
				while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
				return $prg;
			}
			if($accion=='C'){
				$row=mysql_fetch_array($result);
				return $row['C'];
			}
        }
    }


//*****************************[fin clase]********************************
}
?>