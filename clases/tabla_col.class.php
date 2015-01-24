<?php
class tabla_col{
	function lista($tbl_id=0,$orden=''){
            $orden=($orden>'')?" order by ".$orden:" order by grupo,tabla_col_panel_pos,tabla_col_orden";
		$sql="SELECT *,
                      (select tabla_grupo_nombre from tabla_grupo where tabla_grupo_id=tabla_col.tabla_grupo_id)as grupo
                      from tabla_col WHERE bestado='1' and tabla_id=".(int)$tbl_id." ".$orden;
                $result = mysql_query($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
        function edit_prop($id=0,$campo='',$valor=''){
            $sql="update tabla_col set ".$campo."='".$valor."' WHERE tabla_col_id=".(int)$id;
            $result=mysql_query($sql) or Msg_error($sql);
            //return mysql_fetch_array($result,1);
            //echo $sql;
        }
        
        function col_filtro($tabla_id=0,$tabla_col_id=0,$operador_id=0){
            $sql="SELECT*FROM tabla_col_filtro WHERE tabla_id=".$tabla_id." and tabla_col_id=".$tabla_col_id." and trabajador_id=".$operador_id;
            $result=mysql_query($sql) or Msg_error($sql);
            return mysql_fetch_array($result,1);
        }
        
        function col_depend($id=0,$col_nombre=''){
            $sql="SELECT*FROM tabla_col WHERE tabla_id=".$id." and tbl_col_dependencia='".$col_nombre."'";
            $result=mysql_query($sql) or Msg_error($sql);
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
            return $prg;
        }
	
	function edit($accion,$id){
		switch($accion){
			case 'S':
                            $sql="SELECT*FROM tabla_col WHERE tabla_col_id=".(int)$id;
                            $result=mysql_query($sql) or Msg_error($sql);
                            return mysql_fetch_array($result,1);
                        case 'E':
                            $sql="SELECT*FROM tabla_col WHERE tbl_col_dependencia='".$id."'";
                            $result=mysql_query($sql) or Msg_error($sql);
                            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                            return $prg;
                        case 'F':
                            $sql="SELECT*FROM tabla_col WHERE bestado='1' and tbl_col_ctrl_filtro='1' and tabla_id=".(int)$id;
                            $result=mysql_query($sql) or Msg_error($sql);
                            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                            return $prg;
			break;
			default:
                            $sql="SELECT tec_tabla_col('".$accion."',".(int)$id.",".(int)$_REQUEST['tabla_id'].",
                            ".(int)$_REQUEST['tabla_grupo_id'].",
                            '".$_REQUEST['tabla_col_nombre']."',
                            '".$_REQUEST['tabla_col_rotulo']."',
                            '".$_REQUEST['tabla_col_desc']."',
                            ".(int)$_REQUEST['tabla_col_orden'].",
                            ".(int)$_REQUEST['tabla_col_ancho'].",
                            '".(int)$_REQUEST['tabla_col_obligatorio']."',
                            '".$_REQUEST['tabla_col_panel_pos']."',
                            '".addslashes($_REQUEST['fuente_tbl'])."',
                            '".$_REQUEST['fuente_tbl_id']."',
                            '".$_REQUEST['fuente_tbl_nombre']."',
                            '".$_REQUEST['fuente_tbl_filtro']."',
                            '".$_REQUEST['col_control']."',
                            ".(int)$_REQUEST['lst_ancho'].",
                            '".$_REQUEST['lst_align']."',
                            '".addslashes($_REQUEST['lst_formula'])."',
                            ".(int)$_REQUEST['ctr_max_length'].",
                            ".(int)$_REQUEST['ctr_orden_sp'].",
                            '".$_REQUEST['ctr_visible']."',
                            '".(int)$_REQUEST['tabla_col_virtual']."',
                            ".(int)$_REQUEST['tbl_col_orden_lst'].",
                            '".$_REQUEST['tbl_col_valor_ini']."',
                            '".$_REQUEST['tbl_col_dependencia']."',
                            '".$_REQUEST['tbl_col_param']."',
                            '".$_REQUEST['tbl_col_filtro']."',
                            '".$_REQUEST['tbl_col_ctrl_filtro']."',
                            '".$_REQUEST['tbl_col_css']."',
                            '".$_REQUEST['tbl_col_busqueda']."',
                            '".$_REQUEST['tbl_col_filtro_ini']."',
                            '".$_REQUEST['tbl_col_ficha']."',
                            '".$_REQUEST['tbl_col_lst_css']."',
                            '".$_REQUEST['tbl_col_pie']."',
                            '".$_REQUEST['tbl_col_mayus']."',
                            '".$_REQUEST['tbl_col_lst_editable']."',
                            '".$_REQUEST['tbl_col_calculo']."'
                            )";
                            $result=mysql_query($sql);
                            $row=mysql_fetch_row($result);                            
                            return $row[0];
			break;
		}
		
	}
	
	
       
        
     
	
}
?>