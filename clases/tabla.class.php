<?php
$obj_php='tabla.class.php';
class tabla {
/************************************************************/	
	function tbl_lista($n='',$menu=0){
          $where=($menu>0)?" and tbl_menu_id=".$menu:"";
	  if ($n=='1'){
		  $sql = "SELECT *,(select menu_nombre from menu where menu_id=tabla.menu_id)as grupo FROM tabla WHERE bestado='1' AND tbl_mantenimiento='1' ".$where." ORDER BY tbl_alias";
          }else{
            $sql = "SELECT * FROM tabla WHERE bestado='1' ORDER BY tbl_nombre";
          }
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
/************************************************************/
       
	function tabla_edit($accion,$id){
		switch($accion){
                    case 'E':
                        $sql="SELECT * FROM tabla WHERE tabla_id=".($id+0);
                        $result=mysql_query($sql) or Msg_error($sql);
                        return mysql_fetch_array($result,1);
                    break;
                    default:
                        $sql="SELECT * FROM tabla WHERE tabla_id=".($id+0);
                        $result=mysql_query($sql) or Msg_error($sql);
                        return mysql_fetch_array($result,1);
                    break;
		}
	}
        
        function tabla_sql($sql=''){
            if($sql>''){
                $result=mysql_query($sql);
		return mysql_fetch_array($result,1);
            }
        }
        
        
         function tbl_grupo($accion='',$tbl_id=0,$tbl_grupo_id=0){
            switch($accion){
                case 'G':
                    $sql="SELECT * FROM tabla_grupo WHERE bestado='1' and tabla_id=".(int)$tbl_id." order by tabla_grupo_orden";
                    return qry($sql); 
                    break;
                case 'C':
                    $sql="SELECT * FROM tabla_col WHERE bestado='1' and tabla_id=".(int)$tbl_id." and tbl_col_externo='0' and tabla_grupo_id=".(int)$tbl_grupo_id." order by tabla_col_orden";
                    return qry($sql); 
                    break;
            }
                       
            
        }
        
        function tbl_autocomplete($accion,$cond,$id,$objeto){
            $tbl=explode('|',$objeto);
            //tabla|id|valor|orden|condicion
            if(is_array($tbl)){
                switch($accion){
                    case 'L':
                        $orden=($tbl[3]>'')?" order by ".$tbl[3]:" order by valor";
                        $where=($tbl[4]>'')?" and ".tbl_param($tbl[4]):"";
                        $sql="select ".$tbl[1]." as id,".$tbl[2]." as valor from ".$tbl[0]." where bestado='1' and ".$tbl[2]." like '%".$cond."%'".$where.$orden;
                        $result = mysql_query($sql);
                        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                        return $prg;
                        break;
                    case 'S':
                        $sql="select ".$tbl[1]." as id,".$tbl[2]." as valor  from ".$tbl[0]." where bestado='1' and ".$tbl[1]."=".(int)$id." limit 1";
                        $result=mysql_query($sql) or Msg_error($sql);
                        return mysql_fetch_array($result,1);
                        break;
                }
            }
        }
	
	function tabla_col_lista($tbl_id){
		$sql="SELECT * FROM tabla_col WHERE bestado='1' and tabla_id=".($tbl_id+0)." ORDER BY tbl_col_orden_lst";
		return qry($sql);
	}
	function tabla_col_lista_alfa($tbl_id=0,$grupo_id=0){
                $where=($grupo_id>0)?" AND tabla_grupo_id=".(int)$grupo_id:"";
		$sql="SELECT * FROM tabla_col WHERE tbl_col_busqueda='1' and tabla_id=".(int)$tbl_id.$where." ORDER BY tabla_col_orden";
		return qry($sql);
	}
	
	function edit($accion='',$id=''){
		if($id!=''){$where=" WHERE bestado='1' AND tabla_id = '".$id."'";}
		switch ($accion){
                case 'Z':
                    $sql = "CALL sp_tabla_mant()";
                    $result=mysql_query($sql);
                    break;
		case 'S':
                    $sql = "SELECT * FROM tabla ".$where;
                    $result=mysql_query($sql) or Msg_error($sql);
                    return mysql_fetch_array($result,1);
                    break;
		default:                   		
                    $sql="select tec_tabla('".$accion."',".(int)$id.",
                         '".$_REQUEST['tbl_nombre']."',
                         '".$_REQUEST['tbl_desc']."',
                         '".$_REQUEST['tbl_mantenimiento']."',
                         '".$_REQUEST['tbl_lista']."',
                         '".$_REQUEST['tbl_alias']."',
                         '".$_REQUEST['tbl_lista_cpo']."',
                         '".$_REQUEST['tbl_est']."',
                         '".$_REQUEST['reg_nombre']."',
                         '".$_REQUEST['tbl_fuente']."',
                         '".$_REQUEST['tbl_lista_print']."',
                         '".$_REQUEST['tbl_lista_cpo_print']."',
                         '".$_REQUEST['tbl_campo_fecha']."',
                         '".$_REQUEST['tbl_col_nombre']."',
                         '".$_REQUEST['tbl_col_pk']."',
                         '".$_REQUEST['lst_acc_nuevo']."',
                         '".$_REQUEST['lst_acc_asociar']."',
                         '".$_REQUEST['lst_acc_duplicar']."',
                         '".$_REQUEST['lst_acc_unir']."',
                         '".$_REQUEST['lst_acc_select']."',
                         '".$_REQUEST['lst_acc_mail']."',
                         '".$_REQUEST['lst_acc_search']."',
                         '".$_REQUEST['lst_acc_print']."',
                         '".$_REQUEST['reg_accion1']."',
                         '".$_REQUEST['reg_accion2']."',
                         '".$_REQUEST['reg_accion3']."',
                         '".$_REQUEST['reg_accion4']."',
                         '".$_REQUEST['lst_cpo_orden']."',
                         '".$_REQUEST['lst_cpo_form']."',
                         '".$_REQUEST['lst_cpo_list']."',
                         '".$_REQUEST['frm_acc_grabar']."',
                         '".$_REQUEST['frm_acc_eliminar']."',
                         '".$_REQUEST['tbl_sp']."',
                          ".(int)$_REQUEST['tbl_padre_id'].",
                         '".addslashes($_REQUEST['tbl_sql_cond'])."',
                         '".$_REQUEST['lst_cpo_sort']."',
                         '".$_REQUEST['lst_acc_directo']."',
                         '".$_REQUEST['tbl_frm_ancho']."',
                         '".$_REQUEST['tbl_frm_alto']."',
                         '".$_REQUEST['tbl_lista_export']."',
                         '".$_REQUEST['tbl_lst_select']."'
                         )";
                    $result = mysql_query($sql) or Msg_error($sql);
                    $row=mysql_fetch_row($result);
                    return $row[0];
                    break;
		}                                		          
	}

/************************************************************/	
	function tbl_col($tabla=''){
		$sql = "SELECT * FROM tabla_col WHERE tabla_id=".($tabla+0)." AND bestado='1' ORDER BY tabla_col_orden ASC";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}
        
        function tbl_accion($tabla_id,$tipo=0){
		$sql = "SELECT * FROM tabla_accion WHERE tabla_id=".(int)$tabla_id." and tbl_accion_tipo=".(int)$tipo." AND bestado='1' ORDER BY tbl_accion_orden ASC";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
	}

/************************************************************/	
	function tbl_col_rotulo($tabla=''){
            $sql = "SELECT tabla_col_rotulo FROM tabla_col WHERE tabla_id=".$tabla." AND bestado=1 ORDER BY tabla_col_orden ASC";
            $result = mysql_query($sql) or Msg_error($sql);
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
            return $prg;
	}


/************************************************************/
	function tbl_col_valor($tabla=''){
		$sql = "SELECT * FROM tabla_col WHERE tabla_id=$tabla AND bestado='1'";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		 
	  	return $prg;
	}

/************************************************************/
	function tbl_col_valor_grilla($tabla=''){
		$sql = "SELECT tbl_nombre FROM tabla WHERE tbl_id=$tabla";
		$result = mysql_query($sql);
		$row=mysql_fetch_array($result);
		$tabla_nombre=$row[0];
		$sql = "SELECT * FROM tabla_col WHERE tabla_id=$tabla AND bestado='1' ORDER BY tabla_col_orden ASC";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){
			if ($row['tabla_col_orden']==0){
				$tabla_col_id=$row['tabla_col_nombre'];
			}
			$tabla_col_orden=$tabla_col_orden.$row['tabla_col_nombre'].",";
		}
		$tabla_col_orden=$tabla_col_orden."null";
		$tabla_col_nro=$num;
		$sql = "SELECT $tabla_col_orden FROM $tabla_nombre WHERE bestado=1";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result)){
			$rdato="";
			for ($j=0;$j<$tabla_col_nro;$j++){	
			 	$rdato=$rdato."<td align=center><font face='Arial' size=2 color='white'>".$row[$j]."</td>";
			}
		    $prg[]=array('id'=>$row[0],'valor'=>$rdato);													 
	  	}
		return $prg;
	}

/************************************************************/
function tbl_col_param($sql){    
    $search  = array('SIS2', 'SIS5');
    $replace = array($_SESSION['SIS'][2],$_SESSION['SIS'][5]);
    $sql=str_replace($search, $replace, $sql);
    
    $total=substr_count($sql,'[');
    if($total>0){
        $inicio=strpos($sql,'[');
        $fin=strpos($sql,']');
        $if=($fin-$inicio+1);
        $campo=substr($sql, $inicio,$if);
        $param=substr($sql, $inicio+1,$fin-$inicio-1);
        $sql=str_replace($campo,"'".$_REQUEST[$param]."'",$sql);
        //echo $var."<br>";
        //echo $param."<br>";
        return tbl_param($sql);
    }else{                
        return $sql;
    }
    
    
}


function tbl_edit_tbl($tbl=0,$id=0,$accion=''){
		$sql = "SELECT * FROM tabla WHERE tabla_id=".(int)$tbl;
		$result = mysql_query($sql);
		$row=mysql_fetch_array($result);
		$tabla_nombre=$row['tbl_nombre'];
                $tabla_sp=$row['tbl_sp'];
                $tabla_pk=$row['tbl_col_pk'];
		$sql = "SELECT * FROM tabla_col WHERE tabla_id=".(int)$tbl." AND bestado='1' and tabla_col_virtual='0' and tbl_col_externo='0' ORDER BY ctr_orden_sp";
		$result = mysql_query($sql) or Msg_error($sql);
		if( mysql_num_rows($result) > 0 ){
			while($row=mysql_fetch_array($result)){
				if ($row['ctr_orden_sp']==0){
                                    $tabla_col_id=$row['tabla_col_nombre'];
                                }else{
                                    
                                    //$param=array();
                                    switch($row['col_control']){
                                        case 'FRM':
                                            //tabla|id|valor|campos|rotulos
                                            $objeto=explode("|",$row['fuente_tbl']);
                                            $param=explode(",",$objeto[3]);
                                            $valor[]="'".$_REQUEST['frm_'.$objeto[1]]."'";
                                            for($c=0;$c<count($param);$c++){
                                                $valor[]="'".$_REQUEST['frm_'.$param[$c]]."'";
                                            }
                                            break;
                                        case 'MON':
                                            //tabla|id registro|moneda,precio
                                            $objeto=explode("|",$row['fuente_tbl']);
                                            $param=explode(",",$objeto[2]);
                                            $valor[]="'".$_REQUEST[$param[0]]."'"; // moneda_id
                                            $valor[]="'".$_REQUEST[$param[1]]."'"; // precio
                                            $campo[]=$param[0];
                                            $campo[]=$param[1];
                                            $campo_valor[]=$param[0]."='".$_REQUEST[$param[0]]."'";
                                            $campo_valor[]=$param[1]."='".$_REQUEST[$param[1]]."'";
                                            break;
                                        default:
                                            $val=($row['tbl_col_lst_editable']=='1')?$row['tabla_col_nombre'].'_'.$id:$row['tabla_col_nombre'];
                                            if($row['tbl_col_mayus']=='1'){
                                                $valor[]="'".addslashes(strtoupper(trim($_REQUEST[$val])))."'";
                                                $campo_valor[]=$row['tabla_col_nombre']."='".strtoupper(trim($_REQUEST[$row['tabla_col_nombre']]))."'";
                                            }else{
                                                $valor[]="'".addslashes(trim($_REQUEST[$val]))."'";
                                                $campo_valor[]=$row['tabla_col_nombre']."='".trim($_REQUEST[$row['tabla_col_nombre']])."'";
                                            }
                                            $campo[]=$row['tabla_col_nombre'];
                                            
                                            break;
                                    }
                                    
				}
                                if($row['lst_formula']>''){
                                    if($row['col_control']<>'LST' && $row['col_control']<>'UBI' && $row['col_control']<>'SRC' && $row['col_control']<>'FRM' && $row['col_control']<>'CAL'){
                                        $fila[]=tbl_param($row['lst_formula'])." as ".$row['tabla_col_nombre'];
                                    }
                                }
			}
		}
		if(count($campo)>0)$campos=implode($campo,",");
		if(count($valor)>0)$valores=implode($valor,",");
		if(count($campo_valor)>0)$datos=implode($campo_valor,",");
                
                if($fila){
                    $filas=implode($fila,",");
                }
                                   
                //echo $filas;
                if($filas>''){
                    $filas=",".$filas;
                }
                
		$where=" WHERE $tabla_pk =".(int)$id;
		switch ($accion){                   
                    case 'S':
                        //$sql = "SELECT * FROM $tabla_nombre ".$where;
                        $sql = "SELECT distinct *".$filas." FROM $tabla_nombre ".$where;
                        //echo $sql;
                        break;
                    case 'I':
                    case 'C':
                        if($tabla_sp>''){
                            $sql = "select $tabla_sp ('".$accion."','condicion',".(int)$_SESSION['SIS'][2].",".(int)$_SESSION['SIS'][5].",".(int)$id.",".$valores.")";
                        }else{
                            $sql="insert into $tabla_nombre($campos)values($valores)";
                            mysql_query($sql);
                            $sql="select LAST_INSERT_ID()";
                        }
                        break;
                    case 'U':
                        if($tabla_sp>''){ // Si hay un sp asigando
                        	if($_GET['tbl_id']==206) 
                        	{
										#$sql=sql::updateCoti($_POST['cot_fec_adj'],$_POST['imp_tipo_costo_id'],$_POST['moneda_id'],$_POST['cot_estado_id'],$_POST['cot_prioridad_id'],$_POST['cot_descrip'],$_POST['cot_fec_emision'],$_POST['cot_fec_venc'],$_POST['cot_referencia'],$_POST['contacto_id'],$_GET['cli_id'],$_GET['cotizacion_id'],$_POST['cot_cc_id'],$_POST['cot_cond_precios'],$_POST['cot_cond_plazo_ent'],$_POST['cot_cond_forma_pago'],$_POST['cot_cond_lugar_ent'],$_POST['cot_cond_garantia'],$_POST['cot_cond_validez'],$_POST['cot_cond_penalidad'],$_POST['cot_cond_carta_fianza']);
                           }
                       		else
                       		{
                           	$sql = "select $tabla_sp ('".$accion."','condicion',".(int)$_SESSION['SIS'][2].",".(int)$_SESSION['SIS'][5].",".(int)$id.",".$valores.")";
                           }
                        }else{
                            $sql="update ".$tabla_nombre." set ".$datos." ".$where;
                        }
                        break;
                    case 'D':
                        if($tabla_sp>''){ // Si hay un sp asigando
                            $sql = "select $tabla_sp ('".$accion."','condicion',".(int)$_SESSION['SIS'][2].",".(int)$_SESSION['SIS'][5].",".(int)$id.",".$valores.")";
                        }else{
                            $sql="update ".$tabla_nombre." set bestado='0' ".$where;
                        }			
			break;
		}
                //echo $sql;
		$result = mysql_query($sql) or Msg_error($sql);
		if ($accion=='S'){
                    $row=mysql_fetch_array($result,1);
                    return $row;
		}
                if($accion=='P'){ // Parametros
                    return $valores;
                }
                if($accion=='I' || $accion=='C'){
                    $row=mysql_fetch_row($result);
                    return $row[0];
                }
                if($accion=='U' && $tabla_sp>''){
                    $row=mysql_fetch_row($result);
                    return $row[0];
                }
	}

    function tbl_tabla($col_id=''){
        $sql="SELECT tbl_id,tbl_nombre,tbl_desc,tbl_lista,tbl_lista_cpo,tbl_tipo_control,tbl_fuente FROM tabla WHERE tbl_id=".$_GET['tbl_id'];
        $result=mysql_query($sql) or Msg_error($sql);
        $row=mysql_fetch_array($result);
        $lista_col=explode(",",$row['tbl_lista']); //tbl_lista (lista de columnas)
        $nombrecampo=explode(",",$row['tbl_lista_cpo']);
        $tipo_control=explode(",",$row['tbl_tipo_control']);
        if($row['tbl_tipo_fuente']>''){$fuente=explode(",",$row['tbl_tipo_control']);}
        $sql="SELECT ".$row['tbl_lista']." FROM ".$row['tbl_nombre']." WHERE $lista_col[0]=$col_id AND bestado='1'";
        $result=mysql_query($sql) or Msg_error($sql);
        $numcampos=mysql_num_fields($result);
        $num=mysql_num_rows($result);
        $row=mysql_fetch_array($sql);
        for ($i = 1; $i < $numcampos; $i++){
            echo "<tr><td width=200><b>".strtoupper($nombrecampo[$i])."</b></td>";
            if($tipo_control[$i]=="TXT"){
                echo "<td><input type=text size=40 name=txt".$i." value='".$row[$i]."'></td>\n";
            }elseif($tipo_control[$i]=="LST"){
                $sql="SELECT $funte[1] AS Id,$fuente[2] AS nombre FROM $fuente[0]";
                $result=mysql_fetch_array($sql);
                echo "<select name=>";
            }
        }
        mysql_free_result($result);
    }

/************************************************************/
	function cpoNombre_dll($tbl=''){
            $sql = "SELECT * FROM tabla_col WHERE tabla_id=$tbl AND bestado='1' ORDER BY tabla_col_orden ASC";
            $result = mysql_query($sql) or Msg_error($sql);
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
            return $prg;
	}
	
	function cpoValor_dll($tbl,$campo){
            $sql = "SELECT tabla_id,tabla_col_nombre,tabla_col_rotulo,
	    fuente_tbl,fuente_tbl_id,fuente_tbl_nombre,fuente_tbl_filtro FROM tabla_col 
    	WHERE tabla_id=".$tbl." AND tabla_col_nombre='".$campo."' AND bestado='1'";
		$result = mysql_query($sql) or Msg_error($sql);
            if($row=mysql_fetch_array($result)){
                $fuente_tbl=$row['fuente_tbl'];
                if($fuente_tbl==''){return;}
		$fuente_tbl_id=$row['fuente_tbl_id'];
		if($fuente_tbl_id==''){return;}
		$fuente_tbl_nombre=$row['fuente_tbl_nombre'];
		if($fuente_tbl_nombre==''){return;}
		$fuente_tbl_filtro=$row['fuente_tbl_filtro'];
		if($fuente_tbl_filtro>'')$fuente_tbl_filtro=' AND '.$fuente_tbl_filtro;
		mysql_free_result($result);
		$sql="SELECT ".$fuente_tbl_id." AS campo_id,".$fuente_tbl_nombre." AS campo_valor FROM ".$fuente_tbl." WHERE bestado='1' ".$fuente_tbl_filtro." ORDER BY campo_valor";
		$result = mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
            }
	}

	/************************************************************/
	function listatablas_est(){
	    $sql="SELECT tbl_id,tbl_nombre,tbl_alias FROM tabla WHERE tbl_est=1";
	    $result=mysql_query($sql) or Msg_error($sql);
	    while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
	    mysql_free_result($result);
	    return $prg;
	}
	
	function lista_campos($tbl_id){
	    $sql="SELECT tabla_col_id,tabla_col_rotulo FROM tabla_col WHERE tabla_id=".($tbl_id+0)." AND tabla_col_est='1'";
	    $result=mysql_query($sql) or Msg_error($sql);
	    while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
	    return $prg;
	}
	function tbl_col_nombre($tbl_id,$id){
		$sql="SELECT tbl_nombre,tbl_col_nombre FROM tabla WHERE tabla_id=".($tbl_id+0);
		$result=mysql_query($sql) or Msg_error($sql);
		$row=mysql_fetch_array($result,1);
		if($row['tbl_col_nombre']>""){
			$sql="SELECT CONCAT(".$row['tbl_col_nombre'].") AS linea FROM ".$row['tbl_nombre'].
			" WHERE ".$row['tbl_nombre']."_id=".($id+0);
			$result=mysql_query($sql) or Msg_error($sql);
			$row=mysql_fetch_row($result);
			return $row[0];
		}
	}
	function tbl_nombre($tbl_id){
		$sql="SELECT tbl_desc FROM tabla WHERE tabla_id=".($tbl_id+0);
		$result=mysql_query($sql) or Msg_error($sql);
		$row=mysql_fetch_array($result,1);
		return $row['tbl_desc'];
	}
	function reg_nombre($tbl_id,$reg_id){
		$reg=tabla::tabla_edit('E',$tbl_id);
		$sql="SELECT ".$reg['reg_nombre']." FROM ".$reg['tbl_nombre']." WHERE ".
		$reg['tbl_nombre']."_id=".($reg_id+0);
		$result=mysql_query($sql) or Msg_error($sql);
		if($row=mysql_fetch_row($result)){return $row[0];}
	}
	function indicadores_edit($accion,$id){
		switch($accion){
			case 'E':
				$sql="SELECT * FROM indicadores WHERE bestado='1' AND indicadores_id=".($id+0);
				$result=mysql_query($sql) or Msg_error($sql);
				if($row=mysql_fetch_array($result,1)){return $row;}
			break;
			case 'E2':
				$sql="SELECT * FROM ind_fecha WHERE bestado='1' AND ind_fecha_id=".($id+0);
				$result=mysql_query($sql) or Msg_error($sql);
				if($row=mysql_fetch_array($result,1)){return $row;}
			break;
			default:
				$sql="SELECT tec_indicadores('".$accion."',".($id+0).",'".$_GET['nombre']."','".
				$_GET['descripcion']."','".$_GET['uvalor']."',".($_GET['frecuencia_id']+0).",'".
				$_GET['ufecha']."',".($_GET['ind_fecha_id']+0).");";
				$result=mysql_query($sql) or Msg_error($sql);
				if($row=mysql_fetch_row($result)){return $row[0];}
			break;
		}
	}
	function indicadores_lista(){
		$sql="SELECT *,
		(SELECT frec_nombre FROM frecuencia WHERE frecuencia_id=indicadores.frecuencia_id) AS frec_nombre  
		FROM indicadores WHERE bestado='1'";
		return qryPaginada($sql);
	}
	function frecuencia_lista(){
		$sql="SELECT * FROM frecuencia WHERE bestado='1'";
		return qry($sql);
	}
	function ind_fecha_lista($indicador_id){
		$sql="SELECT * FROM ind_fecha WHERE bestado='1' AND indicadores_id=".($indicador_id+0);
		return qry($sql);
	}
}
/*****  Fin de la clase  ******/
?>