<?php
include("conf.php");
include("include/system.php");
include("clases/operador.class.php");
include("clases/menu.php");
include("clases/persona.class.php");
include("clases/empresa.class.php");
include("clases/local.class.php");
include("clases/tabla.class.php");
include("clases/tabla_col.class.php");
include("clases/tabla_grupo.class.php");
include("clases/tabla_accion.class.php");
include("clases/documento.class.php");
include("clases/variables.class.php");
include("system/database/mysql.php");
include("clases/producto.php");
include("clases/mensaje.class.php");
include("clases/tmp_contactar.class.php");
include("clases/canal.class.php");
include("clases/producto.class.php");
include("clases/archivo.class.php");
require("clases/cp_compras.class.php");
require("clases/cp.class.php");
require("clases/cp_detalle.class.php");
require("clases/ocs.class.php");
require("clases/cliente.class.php");
require("clases/notificacion.class.php");
require("clases/cotizacion.class.php");
require("clases/contacto.class.php");
require("clases/importacion.class.php");
require("clases/imp_proforma.class.php");
require("clases/compras.class.php");
require("clases/oc.class.php");
require("clases/atajos.class.php");
//require_once("clases/dompdf/dompdf_config.inc.php");
//require_once('clases/tcpdf/config/lang/eng.php');
//require_once('clases/tcpdf/tcpdf.php');
require_once('clases/pdf.class.php');
require_once('clases/clasifx.class.php');
require_once('clases/tablero.class.php');
require_once('clases/doc_financiero.class.php');
require_once('clases/letra.class.php');
require_once('clases/evento.class.php');
require_once('clases/recurso.class.php');
require_once('clases/plan_contable.class.php');
require_once('clases/pagos.class.php');
require_once('clases/cobranza.class.php');
require_once('clases/contrato.class.php');
require_once('clases/reportes.class.php');
//--clases agregadas
require_once('clases/modulo_alerta.class.php');
require_once('clases/estadisticas.class.php');

/****************** Manejador de Errores ******************/
function error_handler($errno, $errstr, $errfile, $errline){
	$error='';
	if(!(error_reporting() & $errno)){
        // Este codigo de error no esta incluido en error_reporting
            return;
        }
	switch($errno){ 
            case E_NOTICE:
            case E_USER_NOTICE:
                $error = 'Notice';
		break;
            case E_WARNING:
            case E_USER_WARNING:
                $error = 'Warning';
		break;
            case E_ERROR:
            case E_USER_ERROR:
                $error = 'Fatal Error';
		break;
            default:
                $error = 'Unknown';
		break;
	}		
	if($error>''){
            echo $error;
        }

	return true;
}
//set_error_handler('error_handler');
/******************** Tablas (Listas Genericas) **************/
function tbl_opcion($id=0,$form='',$parm=''){
	$reg=tabla::tabla_edit('E',$id);
        $search_form=$reg['lst_cpo_buscar'];
        
        $param=array();
            if($col=tabla::tabla_col_lista($id)){
                foreach($col as &$r){
                    if($r['tbl_col_param']=='1' || $r['tbl_col_filtro']=='1'){
                        $var=explode(":",$r['tbl_col_valor_ini']);
                        switch($var[0]){
                            case 'REQUEST':
                                if($var[1]>'' || $var[1]>0){
                                    $valor=$var[1];
                                }
                                break;
                            default:
                                $valor=$r['tabla_col_nombre'];
                                break;
                        }
                        $param[]=$r['tabla_col_nombre']."=".(int)$_REQUEST[$r['tabla_col_nombre']];
                    }
                }
            }
        
        
        if(is_array($param)){
            $array=implode("&",$param);
        }
//echo $array;
        if($reg['lst_acc_mail']=='1'){$cad[]="<a href='#' onclick=\"SendMail();\"><img src='images/mail.png' title='Enviar mail'></a>";}
        if($reg['lst_acc_grabar']=='1'){$cad[]="<a onclick=\"GrabarLista(".$id.",'".$array."');\"><img src='images/grabar2.png' width='16' height='16' title='Grabar cambios (antes de salir)'></a>";}
        if($reg['lst_acc_add_cot']=='1'){$cad[]="<a onclick=\"AddCot();\"><img src='images/add_cot.png' title='Enviar a ...'></a>";}
        if($reg['lst_acc_search']=='1'){$cad[]="<a href='#' onclick=\"Search(".$id.",'".$search_form."')\"><img src='images/filtro.png' title='Busqueda avanzada'></a>";}
        if($reg['lst_acc_print']=='1'){$cad[]="<a href='#' onclick=\"Imprime('lista_".$id."',500,350);\"><img src='images/b_print.png' title='Imprimir'></a>";}
	if($reg['lst_acc_nuevo']=='1'){$cad[]="<a onclick=\"Accion('I','".$reg['tbl_frm_ancho']."','".$reg['tbl_frm_alto']."','".$reg['lst_cpo_form']."',".(int)$reg['tbl_padre_id'].",".(int)$id.",0,'".(int)$_REQUEST['menu_id']."','".$reg['tbl_nombre']."','".$array."');\"><img src='images/add.png' title='Nuevo'></a>";}
	if($reg['lst_acc_asociar']=='1'){$cad[]="<a href='index.php?menu=".$form."&i=".($id+0)."&r=".($r+0)."'><img src='images/asoc.png' title='Asociar'></a>";}
	if($reg['lst_acc_duplicar']=='1'){$cad[]="<a href='".$form."?i=".($id+0)."&r=".($r+0)."'><img src='images/duplicar.png' title='Duplicar'></a>";}
	if($reg['lst_acc_unir']=='1'){$cad[]="<a href='".$form."?i=".($id+0)."&r=".($r+0)."'><span>Unir</span></a>";}
        if($reg['lst_acc_selec']=='1'){$cad[]="<a href='".$form."?i=".($id+0)."&r=".($r+0)."'><span>Seleccionar</span></a>";}
        if($reg['lst_acc_catalogo']=='1'){$cad[]="<a href='index.php?menu=personas&tbl_id=55'><img width='16' height='16' src='images/catalogo.png' title='Ir al Catalogo'></a>";}
        if($reg['lst_acc_directo']=='1'){$cad[]="<a onclick=\"CrearAccesoDirecto('I',".(int)$_REQUEST['menu_id'].");\"><img width='16' height='16' src='images/acceso.png' title='Crear acceso directo'></a>";}
        
        if($acciones=tabla::tbl_accion($id,3)){ // General
            foreach ($acciones as $accion){
                $url=($accion['tbl_accion_url']>'')?" href='".$accion['tbl_accion_url']."?tbl_id=".$id."' target='_blank' ":"";
                $contenido=($accion['tbl_accion_icono']>'')?"<img height='16' width='16' src='".$accion['tbl_accion_icono']."'>":$accion['tbl_accion_nombre'];
                $funcion=($accion['tbl_accion_func']>'')?" onclick=\"".$accion['tbl_accion_func']."(".(int)$id.");\" ":"";
                $cad[]="<a title='".$accion['tbl_accion_nombre']."' ".$url." ".$funcion.">".$contenido."</a>";
            }
        }
        
        
        if(count($cad)>0){
            return implode("<img src='images/split_img.png'>",$cad);
        }else{
            return '';
        }
	
}
function tbl_accion($a='',$tbl_id=0,$form='',$id=0,$param=''){
    $reg=tabla::tabla_edit('E',$tbl_id);
    
//    $param=array();
//        
//        if($col=tabla::tabla_col_lista($tbl_id)){
//            foreach($col as &$r){
//                if($r['tbl_col_param']=='1'){
//                    $param[]=$r['tabla_col_nombre']."=".(int)$_REQUEST[$r['tabla_col_nombre']];
//                }
//            }
//        }
//        
//
        
    if(is_array($param)){
        $array=implode("&",$param);
    }
   
            
    
    if($acciones=tabla::tbl_accion($tbl_id,1)){ // Lista
        foreach($acciones as $accion){
            $url=($accion['tbl_accion_url']>'')?" href='".$accion['tbl_accion_url']."?tbl_id=".$tbl_id."' target='_blank' ":"";
            $contenido=($accion['tbl_accion_icono']>'')?"<img height='16' width='16' src='".$accion['tbl_accion_icono']."'>":$accion['tbl_accion_nombre'];
            $funcion=($accion['tbl_accion_func']>'')?" onclick=\"".$accion['tbl_accion_func']."(".(int)$tbl_id.",".(int)$id.");\" ":"";
            $cad.="<td class='cAccion' align='center' width='5'><a title='".$accion['tbl_accion_nombre']."' ".$url." ".$funcion.">".$contenido."</a></td>";
            $n+=1;
        }
    }
    // href='index.php?menu=".$form."&id=".($id+0)."&a=D' 
    if($reg['reg_accion1']=='1'){$cad.="<td class='cAccion' align='center' width='5'><a onclick=\"Accion('U','".$reg['tbl_frm_ancho']."','".$reg['tbl_frm_alto']."','".$form."',".(int)$reg['tbl_padre_id'].",".(int)$tbl_id.",".(int)$id.",'".(int)$_REQUEST['menu_id']."','".$reg['tbl_nombre']."','".$array."');\"><img src='images/b_edit.png' title='Editar registro'></a></td>";$n+=1;}
    if($reg['reg_accion2']=='1'){$cad.="<td class='cAccion' align='center' width='5'><a onclick=\"Accion('D','".$reg['tbl_frm_ancho']."','".$reg['tbl_frm_alto']."','".$form."',".(int)$reg['tbl_padre_id'].",".(int)$tbl_id.",".(int)$id.",'".(int)$_REQUEST['menu_id']."','".$reg['tbl_nombre']."','".$array."');\"><img src='images/b_drop.png' title='Eliminar registro'></a></td>";$n+=1;}
    if($reg['reg_accion3']=='1'){$cad.="<td class='cAccion' align='center' width='5'><a href='".$form."?i=".($id+0)."&r=".($r+0)."'><img src='images/open.png' title='accion3'></a></td>";$n+=1;}
    if($reg['reg_accion4']=='1'){$cad.="<td class='cAccion' align='center' width='5'><a href='".$form."?i=".($id+0)."&r=".($r+0)."'><img src='images/view.png' title='accion4'></a></td>";$n+=1;}
    if($reg['reg_acc_mapa']=='1'){$cad.="<td class='cAccion' align='center' width='5'><a onclick='OpenMapa(1,".(int)$id.");'><img src='images/mapa.png' title='Mostrar mapa'></a></td>";$n+=1;}
    
    //echo $xx;
    //if($reg['reg_acc_fb']=='1'){$cad.="<td class='cAccion' align='center' width='5'><a href='http://www.facebook.com' target='_blank'><img src='images/facebook.png' title='Facebook'></a></td>";$n+=1;}
    //if($reg['reg_acc_tw']=='1'){$cad.="<td class='cAccion' align='center' width='5'><a href='http://www.twitter.com' target='_blank'><img src='images/twiter.png' title='Twiter'></a></td>";$n+=1;}
    switch($a){
        case 'C': // Controles
            return $cad;
            break;
        case 'N': // Numero de Col. que ocupara
            return $n;
            break;
    }
}
function tbl_alias($id){
    $reg=tabla::tabla_edit('E',$id);
    return $reg['tbl_alias'];
}

function tbl_criterio($id){
        if($_REQUEST['filtro']>''){
            $cad=' palabra "'.$_REQUEST['filtro'].'" &nbsp; &nbsp; ';
        }elseif($_REQUEST['criterio']>''){
            $cad=$_REQUEST['criterio'];
        }else{
            $cad='';
        }
	if($_REQUEST['filtro']>''){$cad=' palabra "'.$_REQUEST['filtro'].'" &nbsp; &nbsp; ';}
	return ($cad>"")?"<div class='info'>Filtro : ".$cad." &nbsp; &nbsp; <a href='#' title='Limpiar' onclick='document.form1.submit();'><img src='images/delete.png' width='18px'></a></div>":"";
}
function tbl_filtros($id){
    $tabla=tabla::edit('S',$id);
    if(!$tabla['tbl_padre_id']>0){
    if($campos=tabla::tabla_col_lista($id)){
        $str='<table id="filtros" class="filter"><tr>';
        foreach($campos as $c){
            if($c['tbl_col_ctrl_filtro']=='1'){
                $x++;
                $valor_filtro=tabla_col::col_filtro($id,$c['tabla_col_id'],$_SESSION['SIS'][2]);
                $valor_inicial='';//str_replace('SIS2',$_SESSION['SIS'][2],$c['tbl_col_filtro_ini']);
                $c['tbl_col_ficha']=0;
//                $valor=$_REQUEST[$c['tabla_col_nombre']];
//                if(!isset($valor)){                                    
//                    $valor=str_replace('SIS2',$_SESSION['SIS'][2],$c['tbl_col_filtro_ini']);
//                }                
                $valor=($valor_filtro['tabla_col_valor']>'')?$valor_filtro['tabla_col_valor']:$valor_inicial;
                
                $str.='<td class="center">'.$c['tabla_col_rotulo'].' '.tbl_form_control($c,$valor,'').'</td>';
            }            
        }
        $str.='<td align="right"><input class="button" type="button" value="Filtrar" onclick="FiltrarLista('.$id.')"></td>';
        $str.='</tr></table>';
    }    
    return (($x>0)?$str:'');
    }
}

function tbl_rotulos($id=0){
    $accion=tbl_accion('N',$id,'',0,'');
    $t=tabla::tabla_edit('E',$id); 
    
    $colspan=($accion>0)?"<td class='cAccion' colspan='".$accion."'>&nbsp;</td>":"";
    
	if($reg=tabla::tabla_col_lista($id)){
            $cad="<tr>";
            $cad.="<td class='cAccion' align='center'><input type=\"checkbox\" onclick=\"$('input[name*=\'selected\']').attr('checked', this.checked);\" /></td>";
		foreach($reg as &$r){
                    $c++;
                    if($r['tbl_col_orden_lst']>0){
                        if($r['col_control']<>'GRP' && $r['col_control']<>'HR0'){
                            $width=($r['lst_ancho']>0)?" width='".$r['lst_ancho']."%' ":"";
                            $align=" align='center' ";
                            $cad.="<td ".$width.$align." >";
                            if($_SESSION['operador']['order']==$r['tabla_col_nombre']){
                                $css_orden="class='".strtolower($_SESSION['operador']['flow'])."'";
                            }else{
                                $css_orden="";
                            }
                            if($r['tbl_col_orden_lst']>0){
                                //$css_orden=($t['lst_cpo_orden']==$r['tabla_col_nombre'])?" class='asc' ":"";
                                $cad.="<a ".$css_orden." href='#' name='".$r['tabla_col_nombre']."' onclick='orden(this.name);return false;'>".$r['tabla_col_rotulo']."</a>";
                            }else{
                                $cad.=$r['tabla_col_rotulo'];
                            }
                            $cad.="</td>";
                        }
                    }
                    if($r['tbl_col_ctrl_filtro']=='1'){
                        switch($r['col_control']){
                            case 'LST':
                            $objeto=explode("|",$r['fuente_tbl']);
                            $where=($objeto[3]>'')?" and ".$objeto[3]:"";
                            $sql=tbl_param("select $objeto[1] as id,$objeto[2] as valor  from $objeto[0] where bestado='1'".$where." order by valor");
                            //echo $sql;                                                
                            $result=mysql_query($sql);
                            $select=$r['tabla_col_rotulo'].':<select onchange="document.form1.submit();" name="'.$r['tabla_col_nombre'].'" id="'.$r['tabla_col_nombre'].'" ><option value="0"></option>';
                            while($row=mysql_fetch_array($result)){
                                $sel=($_REQUEST[$r['tabla_col_nombre']]==$row['id'])?' selected':'';
                                $select.='<option '.$sel.' value="'.$row['id'].'">'.$row['valor'].'</option>';
                            }
                            $select.='</select>';
                            break;
                        }
                    }
		}
            if($t['tbl_padre_id']>0){
                
                
                if($t['tbl_menu_id']>0){
                    
                    
                    
//                    $tabla=tabla::tabla_edit('E',$t['tbl_padre_id']);
//                    $sql="select ".$tabla['tbl_col_pk']." as id,".$tabla['lst_cpo_orden']." as valor  from ".$tabla['tbl_nombre']." where bestado='1'";
//                    $result=mysql_query($sql);                
//                    $select='<select name="" ><option value="0"></option>';
//                    while($row=mysql_fetch_array($result)){
//                        $select.='<option value="'.$row['id'].'">'.$row['valor'].'</option>';
//                    }
//                    $select.='</select>';
                    
                }
                $filtro=$select;
                
               
                
                
                $opcion="<tr><td align='right' height='25' colspan='".($c+$accion+1)."'>".$filtro." ".tbl_opcion($id)."</td></tr>";
            }
            $cad.=$colspan."</tr>";
	}
	return $opcion.$cad;
}

function tbl_lista($id=0){
    $contenido=tbl_contenido($id);
    $str= "<div class='lista'>";
    $str.= tbl_filtros($id);
    $str.="<table class='list'>";
    $str.="<thead>".tbl_rotulos($id)."</thead>";
    $str.= "<tbody>".$contenido['lista']."</tbody>";
    $str.="</table></div>";
    $str.=$contenido['paginacion'];                    
    $str.=tbl_pie($id);
    return $str;
}

function tbl_pie($tabla_id=0){
    $t=tabla::tabla_edit('E',$tabla_id);
    $str='';
    if(is_array($t)){
        if($t['tbl_pie']>''){
            $query=$t['tbl_pie'];
            $result=mysql_query($query);
            if($result){
                $row= mysql_fetch_array($result);
                if($row['html']){
                    $str='<div class="list_pie">'.$row['html'].'</div>';
                }                                  	
            }
        }
    }
    return $str;
}

function tbl_param($sql){
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

function tbl_calculo($sql){
    $total=substr_count($sql,'[');
    if($total>0){
        $inicio=strpos($sql,'[');
        $fin=strpos($sql,']');
        $if=($fin-$inicio+1);
        $campo=substr($sql, $inicio,$if);
        $param=substr($sql, $inicio+1,$fin-$inicio-1);
        if(!is_numeric($param)){
            $sql=str_replace($campo,"parseFloat($('#".$_REQUEST[$param]."').val())",$sql);
        }
        //echo $var."<br>";
        //echo $param."<br>";
        return tbl_param($sql);
    }else{                
        return $sql;
    }        
}

function tbl_reporte(){
    
}

function tbl_contenido($id){
    $where='';
	if($reg=tabla::tabla_col_lista($id)){
		foreach($reg as &$r){
                    if($r['tbl_col_orden_lst']>0 || $r['tbl_col_param']=='1'){
                        $cols++;
                        if($r['col_control']<>'GRP' && $r['col_control']<>'HR0' && $r['col_control']<>'TBL' && $r['col_control']<>'BTN'){
                            $campos[]=($r['lst_formula']>'')?$r['lst_formula'].' AS '.$r['tabla_col_nombre']:$r['tabla_col_nombre'];
                            $cpos[]=($r['lst_formula']>'')?$r['lst_formula']:$r['tabla_col_nombre'];
                        }
                                               
                        
                    }
                    if($r['tbl_col_ctrl_filtro']){
                        
                        switch($r['col_control']){
                            case 'MES':
                                $campo_condicion="month(".$r['tabla_col_nombre'].")";
                                $filtro=$_REQUEST['mes_'.$r['tabla_col_nombre']];
                                break;
                            case 'AXO':
                                $campo_condicion="year(".$r['tabla_col_nombre'].")";
                                $filtro=$_REQUEST['axo_'.$r['tabla_col_nombre']];
                                break;
                            default:
                                $campo_condicion=$r['tabla_col_nombre'];
                                $filtro=$_REQUEST[$r['tabla_col_nombre']];
                                break;
                            
                        }
                        if(isset($filtro)){
                            if($filtro>0 || $filtro>''){
                                $where.=" and ".$campo_condicion."='".$filtro."' ";
                            }
                        }else{
                            $valor_filtro=tabla_col::col_filtro($id,$r['tabla_col_id'],$_SESSION['SIS'][2]);
                            //$valor_filtro_ini=str_replace('SIS2',$_SESSION['SIS'][2],$r['tbl_col_filtro_ini']);
                            //$value=($valor_filtro['tabla_col_valor']>'')?$valor_filtro['tabla_col_valor']:$valor_filtro_ini;
                            $value=$valor_filtro['tabla_col_valor'];
                            if($value>''){
                                $where.=" and ".$campo_condicion."='".$value."' ";
                            }
                            
                        }
                        
                    }
                    if($r['tbl_col_filtro']){
                        if($_REQUEST[$r['tabla_col_nombre']]>0 || $_REQUEST[$r['tabla_col_nombre']]>''){
                            $where.=" and ".$r['tabla_col_nombre']."='".$_REQUEST[$r['tabla_col_nombre']]."' ";
                        }
                    }
		}
	}        
        $where.=$_REQUEST['qry'];
        if($_REQUEST['filtro']>''){
            $where=" AND (".implode($cpos," LIKE '%".$_REQUEST['filtro']."%' OR ")."";
            $where.=" LIKE '%".$_REQUEST['filtro']."%') ";
            $_SESSION['operador']['key']=$_REQUEST['filtro'];
        }
	$t=tabla::tabla_edit('E',$id);
	$cpo_orden=($_REQUEST['order']>'')?$_REQUEST['order']:$t['lst_cpo_orden'];
        $sort=($t['lst_cpo_sort']>'')?$t['lst_cpo_sort']:'ASC';
	$flow=($_SESSION['operador']['flow']=='ASC')?'DESC':'ASC';
	if($_SESSION['operador']['order']==$_REQUEST['order']){
            $order=" ORDER BY ".$cpo_orden." ".$flow;
	}else{
            $order=" ORDER BY ".$cpo_orden." ".$sort;
	}
	$_SESSION['operador']['order']=$cpo_orden;
	$_SESSION['operador']['flow']=$flow;
        
        switch($t['tbl_filtro_control']){
            case 'MES':
            case 'FEC':
            case 'AXO':
                $valor=$_REQUEST[$t['tbl_filtro_campo']];
                if($valor>''){
                    $where.=" and ".str_replace('[valor]',$valor,$t['tbl_filtro_formula']);
                }
                break;
        }
        //SIS5=empresa_id
        //$condicion=str_replace("SIS2",$_SESSION['SIS'][2],$t['tbl_sql_cond']);
        //$condicion=str_replace("SIS5",$_SESSION['SIS'][5],$condicion);
        
        
        $condicion=tbl_param($t['tbl_sql_cond']);
        
        $where.=($condicion>'')?$condicion:"";
        
        $_SESSION['operador']['filtro']=$where;
        $limite=tbl_paginacion(2,$id,$_GET['page'], 0, 150);
        //echo $limite;
        
	$sql="SELECT SQL_CALC_FOUND_ROWS *,".implode($campos,',')." FROM ".$t['tbl_nombre']." WHERE bestado='1' ".$where.$order.$limite;
        $result=mysql_query($sql);
        
        //echo $sql."<br>";
	//echo variable("paginacion");
	//$_SESSION['operador']['ctotal']="1000";
        //$param=array();
	if($result){
            //$rows=  mysql_fetch_array($result);
            //********** Para paginacion **************/
            $sql_total="SELECT FOUND_ROWS() as total";
            $result_total = mysql_query($sql_total);
            $row_total = mysql_fetch_assoc($result_total);
            $num_rows = $row_total["total"];
            $num=  mysql_num_rows($result);
		//setpos($sql);
		while($row=mysql_fetch_array($result,1)){
                    $param=array();
                    $cad_pie='';
                    $fila_contenido='';
                    $css='';
                    
                    foreach($reg as &$r){
                        $estilo=explode('|',$r['tbl_col_lst_css']);
                        if($estilo[1]>''){
                            if($row[$r['tabla_col_nombre']]==$estilo[1]){
                                $css=" class='".$estilo[0]."'";
                            }
                        }
                        if($r['tbl_col_param']=='1'){ // parametro de entrada
                            $var=explode(":",$r['tbl_col_valor_ini']);
                            switch($var[0]){
                                case 'REQUEST':
                                    if($var[1]>'' || $var[1]>0){
                                        $valor=$_REQUEST[$var[1]];
                                        //echo $valor;
                                    }
                                    break;
                                default:
                                    $valor=$row[$r['tabla_col_nombre']];
                                    break;
                            }
                            $param[]=$r['tabla_col_nombre']."=".$valor;
                        }
                        if($r['tbl_col_filtro']=='1'){
                            $param[]=$r['tabla_col_nombre']."=".$_REQUEST[$r['tabla_col_nombre']];
                        }
                        if($r['tbl_col_orden_lst']>0){
                            
                            //if($r['col_control']<>'GRP' && $r['col_control']<>'HR0' && $r['col_control']<>'TBL'){
                                $align= Array('L'=>'left','R'=>'right','C'=>'center');
                                $fila_valor=str_replace('0000-00-00','',$row[$r['tabla_col_nombre']]);
                                if($r['tbl_col_css']=='moneda'){
                                    $fila_valor=number_format($fila_valor,2,'.',',');
                                }
                                $fila_contenido.="<td align='".$align[$r['lst_align']]."'>".tbl_campo($row[$t['tbl_col_pk']],$r,$fila_valor)."</td>";
                           //}
                            
                            if($r['tbl_col_pie']>''){
                                $pie++;
                                $col_pie=explode(":",$r['tbl_col_pie']);
                                switch($col_pie[0]){
                                    case 'SQL':
                                        break;
                                    case 'TEXTO':
                                        $output[$r['tabla_col_nombre']]=$col_pie[1];
                                        break;
                                    case 'SUMA':
                                        $output[$r['tabla_col_nombre']]+=$row[$r['tabla_col_nombre']];
                                        break;
                                    case 'COUNT':
                                        $output[$r['tabla_col_nombre']]++;
                                        break;
                                    default:
                                        $output[$r['tabla_col_nombre']]='';
                                        break;
                                }
                                if($r['tbl_col_css']=='moneda'){
                                    $cad_pie.='<td align="'.$align[$r['lst_align']].'">'.number_format($output[$r['tabla_col_nombre']],2,'.',',').'</td>';
                                }else{
                                    $cad_pie.='<td align="'.$align[$r['lst_align']].'">'.$output[$r['tabla_col_nombre']].'</td>';
                                }
                                
                            }else{
                                $cad_pie.='<td></td>';
                            }
                                                        
                            
                        }
                                                                                                                                                                                                                                               
                    }
                    $cad.="<tr ".$css."><td class='cAccion' width='10' align='center'><input type='checkbox' name='selected[]' value='".$row[$t['tbl_col_pk']]."'/></td>";
                    $cad.=$fila_contenido;
                    $cad.=tbl_accion('C',$id,$t['lst_cpo_form'],$row[$t['tbl_col_pk']],$param);
                    $cad.="</tr>";
		}
	}
        
        if($pie>0){
            $cad.='<tr><td colspan="'.(tbl_accion('N',$id,'','','')+$cols+1).'">&nbsp;</td></tr>';
            $cad.='<tr class="lstPie"><td></td>'.$cad_pie.'<td colspan="'.tbl_accion('N',$id,'','','').'"></td></tr>';
        }
        
        $paginacion=tbl_paginacion(1,$id,(int)$_GET['page'],$num_rows,150,$num);
        
        $contenido=array("lista"=>$cad,"paginacion"=>$paginacion);
        
	return $contenido;
}

function tbl_paginacion($formato,$tbl_id,$page,$num_rows,$rows_per_page,$total_rows=0){
    $page=($page>0)?$page:1;
    $next=$page+1;
    $prev=$page-1;
    $first=1;
    $last=ceil($num_rows / $rows_per_page);
    
    if($next>$last)$next=$last;
    if($prev<$first)$prev=$first;
    
    $offset = ($page-1) * $rows_per_page;
    $o=$offset+($total_rows-1);
    
    $tabla=tabla::edit('S',$tbl_id);
    if($tabla['tbl_lista_export']=='1'){
        $exportar='<img src="images/split_img.png">
                   <a target="_blank" href="exportar_pdf.php?tbl_id='.$tbl_id.'" title="Exportar"><img src="images/pdf.png"></a>
                   <img src="images/split_img.png">
                   <a title="Exportar" href="exportar.php?tbl_id='.$tbl_id.'"><img src="images/excel.png"></a>';
    }
    switch($formato){
        case 1: // Muestra enlaces de paginacion
            $link[]='<a href="index.php?menu=personas&tbl_id='.$tbl_id.'&page='.$first.'"><img src="images/go-first.png"></a>';
            $link[]='<a href="index.php?menu=personas&tbl_id='.$tbl_id.'&page='.$prev.'"><img src="images/go-previous.png"></a>';
            $link[]='<b>'.$offset.' - '.$o.' de '.$num_rows.'</b>';
            $link[]='<a href="index.php?menu=personas&tbl_id='.$tbl_id.'&page='.$next.'"><img src="images/go-next.png"></a>';
            $link[]='<a href="index.php?menu=personas&tbl_id='.$tbl_id.'&page='.$last.'"><img src="images/go-last.png"></a>';
            if($num_rows>$rows_per_page){
                $links=implode("&nbsp;&nbsp;",$link);
            }else{
                $links='<b>'.$offset.' - '.$o.' de '.$num_rows.'</b>';
            }
            
            if($total_rows>0){
            $str='<div class="pagination">
                        <div class="links">
                        '.$links.'
                        </div>
                        <div class="results">
                            <a href="#" onclick="getAyuda(1,'.$tbl_id.')"  title="Ayuda"><img src="images/ayuda.png"></a>                            
                            '.$exportar.'
                        </div>
                  </div>';
            }
            break;
        case 2: // Muestra el limit (SQL)
            $str=" limit ".$offset.",".$rows_per_page;
            break;
    }
    return $str;
}

function tbl_campo($id=0,$objeto=array(),$valor=''){
    switch($objeto['col_control']){
        case 'IMG':
            if(file_exists($valor)){
                return '<img class="imagen" src="'.$valor.'" width="30" height="35" />';
            }else{
                return '<img class="imagen" src="images/no_image2.jpg" width="30" height="30" />';
            }
            break;
        case 'SOC':
            return '<a target="_blank" href="http://www.'.$valor.'.com"><img src="images/'.$valor.'.png"></a>';
            break;
        default:
            if($objeto['tbl_col_lst_editable']==1){
                $objeto['tabla_col_nombre']=$objeto['tabla_col_nombre']."_".$id;
                return tbl_form_control($objeto,$valor,'');
            }else{
                return $valor;
            }
            break;
    }
}

function tbl_filtro($tabla_id=0){
    $tbl=tabla::tabla_edit('E',$tabla_id);
    $tipo=$tbl['tbl_filtro_control'];
    $control=$tbl['tbl_filtro_campo'];
    switch($tipo){
        case 'MES':
            $str='Mes: <select name="'.$control.'" onchange="document.form1.submit();">';
            $str.=mes_ddl($_POST[$control]);
            $str.='</select>';
            break;
        case 'AXO':
            $str='Año: <select name="'.$control.'" onchange="document.form1.submit();">';
            $str.=periodo_ddl($_REQUEST[$control],5,5);
            $str.='</select>';
            break;
        case 'FEC':
            $str='Fecha: <input type="text" size="12" value="'.$_POST[$control].'" id="'.$control.'" name="'.$control.'"><script>Javascript:Calendario2(\''.$control.'\');</script>';
            break;        
    }
    return $str." &nbsp;&nbsp;&nbsp;&nbsp;";
}

function tbl_busqueda($id){
	$oper="<option value='AND'>Y</option><option value='OR'>O</option><option value='AND NOT'>No</option>";
	$cond="<option value='%_%'>Contiene</option><option value='_%'>Comienza</option><option value='%_'>Termina</option><option value='='>=</option><option value='!='>!=</option><option value='<'><</option><option value='>'>></option>";
	if($reg=tabla::tabla_col_lista_alfa($id)){
		$subcad="<option value=''></option>";
		foreach($reg as &$r){
                    if($r['tbl_col_orden_lst']>0){
                        if(strpos("IMG-PAS-HDN-HR-GRP",$r['col_control'])===false){
                            $value=($r['lst_formula']>"")?$r['lst_formula']:$r['tabla_col_nombre'];
                            $subcad.="<option value='".$value."'>".$r['tabla_col_rotulo']."</option>";
                        }
                    }
		}
	}
	$cad="";
	$cad.="<table width='100%' align='right'>";
	$cad.="<tr><td width='10%'></td><td align='left'><select id='cpo1' name='cpo1'>".$subcad."</select> &nbsp; <select id='cond1' name='cond1'>".$cond."</select> &nbsp; <input type='text' id='val1' name='val1'></td></tr>";
	$cad.="<tr><td><select id='oper2' name='oper2'>".$oper."</select></td><td align='left'><select id='cpo2' name='cpo2'>".$subcad."</select> &nbsp; <select id='cond2' name='cond2'>".$cond."</select> &nbsp; <input type='text' id='val2' name='val2'></td></tr>";
	$cad.="<tr><td><select id='oper3' name='oper3'>".$oper."</select></td><td align='left'><select id='cpo3' name='cpo3'>".$subcad."</select> &nbsp; <select id='cond3' name='cond3'>".$cond."</select> &nbsp; <input type='text' id='val3' name='val3'></td></tr>";
	return $cad."</table>";
}

function tbl_col_ddl($tbl_id){
    if($reg=tabla::tabla_col_lista_alfa($tbl_id)){
        $cad="<option value=''></option>";
	foreach($reg as &$r){
            $value=($r['lst_formula']>"")?$r['lst_formula']:$r['tabla_col_nombre'];
            $cad.="<option value='".$value."'>".$r['tabla_col_rotulo']."</option>";
	}
        return $cad;
    }
}

function tbl_filtro_ope($tipo=''){
    switch($tipo){
        case 1:
            $array=array("AND"=>"Y","OR"=>"O","AND NOT"=>"No");
            break;
        case 2:
            $array=array("%_%"=>"Contiene","_%"=>"Comienza","%_"=>"Termina","="=>"=","!="=>"!=","<"=>"<",">"=>">");
            break;
    }
    foreach ($array as $key => $value) {
        $str.='<option value="'.$key.'">'.$value.'</option>';
    }
    return $str;
             
}

function tbl_busqueda_avanzada($id){
    $cad='<table width="100%" align="right">';
	if($reg=tabla::tabla_col_lista_alfa($id)){
		foreach($reg as &$r){
                            $value=($r['lst_formula']>"")?$r['lst_formula']:$r['tabla_col_nombre'];
                            $cad.='<tr>
                                    <td><select name="cond_'.$r['tabla_col_nombre'].'" id="cond_'.$r['tabla_col_nombre'].'">'.tbl_filtro_ope(1).'</select></td>
                                    <td>'.$r['tabla_col_rotulo'].'</td>
                                    <td><select name="ope_'.$r['tabla_col_nombre'].'" id="ope_'.$r['tabla_col_nombre'].'">'.tbl_filtro_ope(2).'</select></td>
                                    <td>';
                            if((strpos("CAL-LST",$r['col_control']))){
                                $cad.=tbl_form_control($r['col_control'],$r['tabla_col_nombre'],'',0,0,$r['fuente_tbl'],0,$r['tbl_col_dependencia'],'','','');                                
                            }else{
                                $cad.='<input type="text" name="'.$r['tabla_col_nombre'].'" id="'.$r['tabla_col_nombre'].'">';
                            }
                                
                            
                                    '</td>
                                   </tr>';                                            
		}
	}	
	return $cad."</table>";
}

//************************ Tabla Form ******************************/
function tbl_form_opcion($tbl_id=0){
	$reg=tabla::tabla_edit('E',$tbl_id);
        $id=$_REQUEST['id'];
	if($reg['frm_acc_grabar']=='1'){$cad[]="<a id='btnSave'><img src='images/grabar.png' width='20' height='20' title='Grabar'></a>";}
        if($reg['frm_acc_duplicar']=='1'){$cad[]="<a id='btnDuplicar'><img src='images/duplicar.png' title='Duplicar'></a>";}
	if($reg['frm_acc_eliminar']=='1'){$cad[]="<a href='#'><img src='images/eliminar.png' title='Eliminar'></a>";}
        if($acciones=tabla::tbl_accion($tbl_id,2)){ // Form
            foreach ($acciones as $accion){
                $url=($accion['tbl_accion_url']>'')?" href='".$accion['tbl_accion_url']."?tbl_id=".$tbl_id."' target='_blank' ":"";
                $contenido=($accion['tbl_accion_icono']>'')?"<img height='16' width='16' src='".$accion['tbl_accion_icono']."'>":$accion['tbl_accion_nombre'];
                $funcion=($accion['tbl_accion_func']>'')?" onclick=\"".$accion['tbl_accion_func']."(".(int)$tbl_id.",".(int)$id.");\" ":"";
                $cad[]="<a title='".$accion['tbl_accion_nombre']."' ".$url." ".$funcion.">".$contenido."</a>";
            }
        }
        $cad[]="<a href='#' onclick=\"getGuia(1,".$tbl_id.")\"><img src='images/ayuda.png' title='Ayuda'></a>";
        if($_SESSION['SIS'][7]==0){
        if($reg['lst_cpo_list']>''){$cad[]="<a href='index.php?menu_id=".(int)$_REQUEST['menu_id']."&menu=".$reg['lst_cpo_list']."&tbl_id=".$tbl_id."'><img src='images/lista.png' title='Ir a lista'></a>";}
        }
        //echo $_SESSION['SIS'][7];
	return implode("<img src='images/split_img.png'>",$cad);
}

function tbl_form_cab($accion='',$tbl_id=0,$reg_id=0){
    $reg=tabla::tabla_edit('E',$tbl_id);
    switch($accion){
        case 'F': // Formulario
            if($reg['reg_nombre']>''){
                $sql="select ".$reg['reg_nombre']." as valor from ".$reg['tbl_nombre']." where ".$reg['tbl_col_pk']."=".$reg_id;
                $data=tabla::tabla_sql($sql);
                $valor=$data['valor'];
            }
            echo "<h1>".$reg['tbl_alias'].": <span>".$valor."</span></h1>";
            break;
        case 'L': // Lista
            echo "<h1>".$reg['tbl_alias']." - Lista</h1>";
            break;
    }
}

function Strim($cadena){
    $cadena = str_replace(' ', '', $cadena);
    return $cadena;
}

function tbl_form($tbl_id=0,$reg_id=0,$accion=''){
    $_SESSION['SIS'][7]=($reg_id==-1)?1:0;
    $reg_id=($reg_id==-1)?$_SESSION['SIS'][5]:$reg_id;        
    $reg=tabla::tbl_grupo('G',$tbl_id,0);
    //$form=tabla::tabla_edit('E',$id);
    $data=tabla::tbl_edit_tbl($tbl_id,$reg_id,'S');
    //echo $_REQUEST['tab'];
    if($reg){
        $cad='<!-- Tabs --><form id="form1" action="" method="post" name="form1">
              <input type="hidden" id="tab" name="tab" value="'.(int)$_REQUEST['tab'].'">
              <input type="hidden" id="accion" name="accion" value="'.$accion.'">
              <input type="hidden" id="id" name="id" value="'.$reg_id.'">              
              <div id="ui-tabs"><ul>';
        foreach($reg as &$cabecera){
            $nombre_grupo=$cabecera['tabla_grupo_nombre'];
            if($_SESSION['SIS'][7]==1){ // Mi empresa
                if($cabecera['tabla_grupo_nombre']=='Contactos'){
                    $nombre_grupo='Trabajadores';
                }
            }
            
            $cad.='<li><a onclick="Enfocar(\''.Strim($cabecera['tabla_grupo_nombre']).'\');" href="#tab-'.Strim($cabecera['tabla_grupo_nombre']).'">'.$nombre_grupo.'</a></li>';
	}
        $cad.='</ul>';
        foreach($reg as &$grupo){
            $cad.='<div id="tab-'.Strim($grupo['tabla_grupo_nombre']).'">';
            $cad.='';
            if($reg_col=tabla::tbl_grupo('C',$tbl_id,$grupo['tabla_grupo_id'])){
                //$cad.='<table width="100%" class="form">';
                $lado_l='';
                $lado_r='';
                foreach($reg_col as &$col){
                    
                    if($col['tabla_col_orden']>0){
                    
                    $param=explode(":",$col['tbl_col_valor_ini']);
                    if($data[$col['tabla_col_nombre']]>'' || $data[$col['tabla_col_nombre']]>0){
                        //if($data[$col['tabla_col_nombre']]>0){
                        $valor=$data[$col['tabla_col_nombre']];
                    }else{
                        switch($param[0]){
                            case 'REQUEST':
                                if($param[1]>'' || $param[1]>0){
                                    $valor=$_REQUEST[$param[1]];
                                }else{
                                    $valor=$_REQUEST[$col['tabla_col_nombre']];
                                }
                                break;
                            case 'SIS5': // Session (empresa_id)
                                $valor=$_SESSION['SIS'][5];
                                break;
                            case 'SIS2': // Session (empresa_id)
                                $valor=$_SESSION['SIS'][2];
                                break;
                            case 'FUNC':
                                if($data[$col['tabla_col_nombre']]>0){                           
                                    $valor=$data[$col['tabla_col_nombre']];
                                }else{
                                    $query=str_replace('[id]',$_REQUEST[$param[2]],$param[1]);                               
                                    $rs=mysql_query($query);
                                    $rsu= mysql_fetch_array($rs);
                                    $valor=$rsu[$param[3]];
                                }
                                break;
                            case 'TCC': // Tipo Cambio Compra
                                $tc=variables::var_tc();
                                $valor=$tc['mon_tc_compra_us'];
                                break;
                            case 'TCV': // Tipo Cambio Venta
                                $tc=variables::var_tc();
                                $valor=$tc['mon_tc_venta_us'];
                                break;
                            case 'VAR': // Varible
                                $valor=variable($param[1]);
                                break;
                            default:                           
                                $valor=$col['tbl_col_valor_ini'];                            
                                break;
                        }
                    }
                    //$valor=($data[$col['tabla_col_nombre']]>'' || $data[$col['tabla_col_nombre']]>0)?$data[$col['tabla_col_nombre']]:$col['tbl_col_valor_ini'];
                    if($col['tabla_col_panel_pos']=='R'){
                        $lado_r.=tbl_form_fila($col,$valor,$data[$col['tbl_col_dependencia']]);
                    }else{
                        $lado_l.=tbl_form_fila($col,$valor,$data[$col['tbl_col_dependencia']]);
                    }
                    }
                }
                $cad.=tbl_form_panel($lado_l,$lado_r);                
            }            
            $cad.='</div>';
	}
        $cad.='</div></form><!-- Fin Tabs -->';
    }
    echo $cad;
}

function tbl_form_panel($l='',$r=''){
    $panel='<table width="100%">
          <tr>
            <td  valign="top">
            <table width="100%" align="center" class="form">'.$l.'</table>
            </td>
            <td>&nbsp;</td>
            <td valign="top">
            <table width="100%" align="center" class="form">'.$r.'</table>
            </td>
          </tr>
          </table>';
    return $panel;
}

function tbl_control_edit($perfil=0,$rotulo='',$tbl_id=0,$tbl_col_id=0){
    switch($perfil){
        case 1:
            $str='<a class="link_texto" onclick="col_form(1,\'U\','.$tbl_col_id.','.$tbl_id.');">'.$rotulo.'</a>';
            break;
        default:
            $str=$rotulo;
            break;
    }
    return $str;
}



function tbl_form_fila($campo=array(),$valor='',$depen_valor=''){
    $required=($campo['tabla_col_obligatorio']==1)?'<font color="red"> * </font>':'';
    switch($campo['col_control']){
        case 'TXA': 
            $cad='<tr>';
            $cad.='<td valign="top">'.tbl_control_edit($_SESSION['SIS'][3],$campo['tabla_col_rotulo'],$campo['tabla_id'],$campo['tabla_col_id']).'</td><td width="5" valign="top">:</td><td width="5">'.$required.'</td><td>'.tbl_form_control($campo,$valor,$depen_valor).'</td>';
            $cad.='</tr>';
            break;
        case 'HR0':
            $cad.='<tr><td colspan="4"><hr></td></tr>';
            break;
        case 'GRP':
            $cad.='<tr><td colspan="4" height="16" bgcolor="#CCCCCC">&nbsp;<b>'.$campo['tabla_col_rotulo'].'</b></td></tr>';
            break;
        case 'IMG':
            $cad='<tr><td rowspan="3" align="center">'.tbl_form_control($campo,$valor,$depen_valor).'</td><td colspan="3">'.$campo['tabla_col_rotulo'].'</td></tr>
                  <tr><td colspan="3">&nbsp;</td></tr>
                  <tr><td colspan="3">&nbsp;</td></tr>';
            break;
        case 'IFR':
            $cad='<tr><td colspan="4">'.tbl_form_control($campo,$valor,$depen_valor).'</td></tr>';
            break;
        case 'PK':
        case 'HDN':
            $cad=tbl_form_control($campo,$valor,$depen_valor);
            break;
        case 'TBL':
            $cad.='<tr><td colspan="4"><div id="lista_'.$valor.'">'.tbl_lista($valor).'</div></td></tr>';
            break;
        case 'CAR':
        case 'PER':
        case 'EMP':
        case 'FRM':
            //$cad='<tr><td colspan="4">'.tbl_form_control($campo,$valor,$depen_valor).'</td></tr>';
            $cad=''.tbl_form_control($campo,$valor,$depen_valor).'';
            break;
        case 'SOC':
            $cad='';
            break;
        case 'IGV':
            $igv=variable('IGV');
            $rotulo=($igv>0)?$campo['tabla_col_rotulo'].' ('.$igv.'%)':$campo['tabla_col_rotulo'];
            $cad='<tr>';
            $cad.='<td>'.tbl_control_edit($_SESSION['SIS'][3],$rotulo,$campo['tabla_id'],$campo['tabla_col_id']).'</td><td width="5">:</td><td width="5">'.$required.'</td><td>'.tbl_form_control($campo,$valor,$depen_valor).'</td>';
            $cad.='</tr>';
            break;
        default:
            $cad='<tr>';
            $cad.='<td>'.tbl_control_edit($_SESSION['SIS'][3],$campo['tabla_col_rotulo'],$campo['tabla_id'],$campo['tabla_col_id']).'</td><td width="5">:</td><td width="5">'.$required.'</td><td>'.tbl_form_control($campo,$valor,$depen_valor).'</td>';
            $cad.='</tr>';
            break;
    }
    return $cad;
}

function tbl_form_control($campo=array(),$valor='',$depen_valor=''){
    $obligatorio=($campo['tabla_col_obligatorio']==1)?' class="required" ':'';
    $rows=($campo['ctr_max_length']>'')?' rows="'.$campo['ctr_max_length'].'"':' rows="10"';
    $estilo=($campo['tbl_col_css']>'')?' class="'.$campo['tbl_col_css'].'" ':'';
    $max=($campo['ctr_max_length']>0)?' maxlength="'.$campo['ctr_max_length'].'"':'';        
    switch($campo['col_control']){
        case 'TXT':
            $ctrl='<input '.$estilo.$max.$obligatorio.' size="'.$campo['tabla_col_ancho'].'" type="text" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            break;
        case 'IGV':
            $igv=variable('IGV');
            $ctrl='<input type="hidden" id="get_igv" name="get_igv" value="'.($igv/100).'">
                   <input '.$estilo.$max.$obligatorio.' size="'.$campo['tabla_col_ancho'].'" type="text" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            break;
        case 'SN':
            $ctrl='<select id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'">';
            $ctrl.=sn_ddl($valor);
            $ctrl.='</select>';
            break;
        case 'RUC':
            $ctrl='<input '.$estilo.$max.$obligatorio.' size="'.$campo['tabla_col_ancho'].'" type="text" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            $ctrl.='<a onclick="window.open(\'http://www.sunat.gob.pe/cl-ti-itmrconsruc/jcrS00Alias\',\'RUC\',\'width=650,height=450\')"><img title="Consultar RUC" src="images/catalogo.png" height="18"><a/>';
            break;
        case 'MGN': // Margen
            //echo $depen_valor;
            $ctrl='<b><span id="mgn_'.$campo['tabla_col_nombre'].'">'.$valor.'</span></b>&nbsp;<input '.$estilo.$max.$obligatorio.' size="'.$campo['tabla_col_ancho'].'" type="hidden" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">&nbsp<input type="button" value="Cambiar" onclick="CambiarMargen('.(int)$depen_valor.',\''.$campo['tabla_col_nombre'].'\');">';
            break;
        case 'NRO':
            if($valor>''){
                $array=explode("-",$valor);
            }
            $ctrl='<input size="3" type="text" id="pre_'.$campo['tabla_col_nombre'].'" name="pre_'.$campo['tabla_col_nombre'].'" value="'.$array[0].'"> - <input size="10" type="text" id="nro_'.$campo['tabla_col_nombre'].'" name="nro_'.$campo['tabla_col_nombre'].'" value="'.$array[1].'"><input id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" type="hidden" value="'.$valor.'">
                   <script type="text/javascript">
                    $(document).ready(function(){
                        $("#pre_'.$campo['tabla_col_nombre'].'").keypress(function () {
                            if(($(this).val().length+1)==3){
                                $("#nro_'.$campo['tabla_col_nombre'].'").focus();
                            }
                        });
                        $("#nro_'.$campo['tabla_col_nombre'].'").keyup(function () {
                            var valor=$("#pre_'.$campo['tabla_col_nombre'].'").val()+"-"+$("#nro_'.$campo['tabla_col_nombre'].'").val();
                            $("#'.$campo['tabla_col_nombre'].'").val(valor);
                        });
                    });
                    </script>';
            break;
        case 'ETQ':
            if($campo['tbl_col_css']=='moneda'){
                $valor=  number_format($valor,2,'.',',');
            }
            $ctrl="<b>".$valor."</b>";//'[ '.$campo['tabla_col_nombre'].' ]';
            break;
        case 'HTM':
            $ctrl='<textarea '.$rows.' cols="'.$campo['tabla_col_ancho'].'" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'">'.$valor.'</textarea>';
            $ctrl.='<script language="javascript">
                     tinymce.init({
                        selector: "textarea",    
                        language : "es",
                        width:'.$campo['tabla_col_ancho'].',
                        height:'.$campo['ctr_max_length'].',
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                      ]
                     });
                     </script>';
            break;
        case 'TXA':              
            $ctrl='<textarea '.$rows.' cols="'.$campo['tabla_col_ancho'].'" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'">'.$valor.'</textarea>';
            break;
        case 'EMA':
            $ctrl='<input '.$obligatorio.' size="'.$campo['tabla_col_ancho'].'" type="email" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            break;
        case 'NUM':
            $ctrl='<input '.$obligatorio.' type="number" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            break;
        case 'CHK':
            $checked=($valor==1)?' checked ':'';
            $ctrl='<input type="checkbox" '.$checked.' value="1" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'">';
            break;
        case 'MON':
            //tabla|id|campo1,campo2|moneda_default
            $objeto=explode("|",$campo['fuente_tbl']);
            $campos=explode(",",$objeto[2]);            
           
            $sql="select ".$objeto[2]." from ".$objeto[0]." where bestado='1' and ".$campo['tbl_col_dependencia']."=".(int)$depen_valor;
            $result=mysql_query($sql);
            //echo $sql;
            $row=mysql_fetch_array($result);
            $moneda_id=($objeto[3]>0)?$objeto[3]:$row[$campos[0]];
            if($objeto[4]==1){
                $precio=round($row[$campos[1]]);
            }else{
                $precio=$row[$campos[1]];
            }
            
            
            $ctrl='<select id="'.$campos[0].'" name="'.$campos[0].'">'.moneda_ddl($moneda_id).'</select> 
                   <input class="moneda" size="10" type="text" id="'.$campos[1].'" name="'.$campos[1].'" value="'.$precio.'">';
            
            break;
        case 'LST':
            //tabla|id |valor|condicion|campo condicion|orden
            $objeto=explode("|",$campo['fuente_tbl']);
            if($campo['tbl_col_ficha']>0){
                $tabla=tabla::edit('S',$campo['tbl_col_ficha']);
                $add="<a onclick=\"form_ficha('I','".$campo['col_control']."',".(int)$campo['tabla_col_id'].",".(int)$campo['tbl_col_ficha'].",'".$campo['tabla_col_nombre']."','".$campo['tbl_col_dependencia']."','".$tabla['tbl_frm_ancho']."','".$tabla['tbl_frm_alto']."');\"><img title='Nuevo' src='images/add_reg.png'><a/>";
            }
            $ctrl='<select id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" '.$obligatorio.' style="min-width:100px;">';
            $where="";
            if($campo['fuente_tbl']>''){
                if(is_array($objeto)){
                    // 0=tabla , 
                    // 1=id a mostrar , 
                    // 2= nombre o valor a mostrar , 
                    // 3=condicion ,
                    // 4=campo para aplicar condicion
                    // 5=orden
                                                            
                    if($campo['tbl_col_dependencia']>''){
                        $depen_valor=($_REQUEST[$campo['tbl_col_dependencia']]>'')?$_REQUEST[$campo['tbl_col_dependencia']]:$depen_valor;
                        $where.=" and ".$campo['tbl_col_dependencia']."=".(int)$depen_valor;
                    }
                    if($objeto[4]>''){
                        $where=" and ".$objeto[4]."=".(int)$depen_valor;
                    }
                    if($objeto[3]>'' && $objeto[3]<>'null'){ // condicion
                        //$objeto[3]=  str_replace('SIS5', $_SESSION['SIS'][5],$objeto[3]); // empresa_id
                        $objeto[3]=tbl_param($objeto[3]);
                        $where.=" and ".$objeto[3];
                    }
                    $orden=($objeto[5]>'')?" order by ".$objeto[5]:" order by valor";
                    
                    
                    $sql="select ".$objeto[1]." as id,".$objeto[2]." as valor  from ".$objeto[0]." where bestado='1'".$where.$orden;
                    //echo $sql."<br>";
                    $ctrl.='<option value=""></option>';
                    $result=mysql_query($sql);
                    while($row=  mysql_fetch_array($result)){
                        $sel=($row['id']==$valor)?' selected ':'';
                        $ctrl.='<option value="'.$row['id'].'" '.$sel.'>'.$row['valor'].'</option>';
                    }
                }
            }
            $ctrl.='</select>&nbsp;'.$add;
            
            //if($reg=tabla_col::edit('E',$campo['tabla_col_nombre'])){
            if($reg=tabla_col::col_depend($campo['tabla_id'],$campo['tabla_col_nombre'])){
            $ctrl.='<script language="javascript" type="text/javascript">
                    $(document).ready(function(){
                        $("#'.$campo['tabla_col_nombre'].'").change(function(event){
                            var valor=$(this).val();';
            foreach ($reg as &$value){
            
                $ctrl.='$("#'.$value['tabla_col_nombre'].'").attr("disabled","disabled");';
                switch($value['col_control']){
                    case 'LST':
                        $ctrl.='$("#'.$value['tabla_col_nombre'].'").html("<option value=0>Cargando...</option>");
                                $("#'.$value['tabla_col_nombre'].'").load("ajax.php?a=select&col_id='.$value['tabla_col_id'].'&valor="+valor,function(){
                                    $(this).removeAttr("disabled");
                                });';
                        break;
                    case 'TXT':
                        $ctrl.='$.ajax({
                                    type:"POST",
                                    url:"ajax.php?a=select&col_id='.$value['tabla_col_id'].'&valor="+valor,
                                    cache:false,
                                    success: function(html){
                                        $("#'.$value['tabla_col_nombre'].'").val(html);
                                        $("#'.$value['tabla_col_nombre'].'").removeAttr("disabled");
                                    }
                                });';    
                        break;
                    default:
                        $ctrl.='$("#'.$value['tabla_col_nombre'].'").load("ajax.php?a=select&col_id='.$value['tabla_col_id'].'&valor="+valor,function(){
                                    $(this).removeAttr("disabled");
                                });';
                        break;
                }
                
            }
                 $ctrl.='});
                    });
                    </script>';
            //break;   
            }
                      
            break;         
        case 'LSA':
            $objeto=explode("|",$campo['fuente_tbl']);            
            $ctrl='<select id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" style="width:325px" multiple="multiple" size="4">';
            $where="";
            if($campo['fuente_tbl']>''){
                if(is_array($objeto)){
                    // 0=tabla , 
                    // 1=id a mostrar , 
                    // 2= nombre o valor a mostrar , 
                    // 3=condicion ,
                    // 4=campo para aplicar condicion              
                                                            
                    if($campo['tbl_col_dependencia']>''){
                        $where.=" and ".$campo['tbl_col_dependencia']."=".(int)$depen_valor;
                    }
                    
                    if($objeto[4]>''){
                        $where=" and ".$objeto[4]."=".(int)$depen_valor;
                    }
                    
                    if($objeto[3]>'' && $objeto[3]<>'null'){ // condicion
                        $where.=" and ".$objeto[3];
                    }                    
                    $sql="select ".$objeto[1]." as id,".$objeto[2]." as valor  from ".$objeto[0]." where bestado='1'".$where." order by valor";
                    //echo $sql."<br>";
                    //$ctrl.='<option value=""></option>';
                    $result=mysql_query($sql);
                    while($row=  mysql_fetch_array($result)){
                        $sel=($row['id']==$valor)?' selected ':'';
                        $ctrl.='<option value="'.$row['id'].'" '.$sel.'>'.$row['valor'].'</option>';
                    }                                                

                }
            }
            $ctrl.='</select>';
            $ctrl.='<script>
                        $("#'.$campo['tabla_col_nombre'].'").change(function () {
                            var str = "";
                            col=new Array;
                            $("#'.$campo['tabla_col_nombre'].' option:selected").each(function () {
                                str += $(this).text() + " ";
                                col.push($(this).val());
                            });
                            //alert(col.join(","));
                        })                        
                    </script>';
            break;
        case 'CAL':
            $valor=($valor=='NOW' || $valor=='0000-00-00')?date('Y-m-d'):substr($valor,0,10);
            $ctrl='<input type="text" size="'.$campo['tabla_col_ancho'].'" name="'.$campo['tabla_col_nombre'].'" id="'.$campo['tabla_col_nombre'].'" value="'.$valor.'"><script>Javascript:Calendario(\''.$campo['tabla_col_nombre'].'\');</script>';
            break;
        case 'MES':
            $ctrl='<select id="mes_'.$campo['tabla_col_nombre'].'" name="mes_'.$campo['tabla_col_nombre'].'" >';
            $ctrl.=mes_ddl($valor);
            $ctrl.='</select>';
            break;
        case 'AXO':
            $ctrl='<select id="axo_'.$campo['tabla_col_nombre'].'" name="axo_'.$campo['tabla_col_nombre'].'" >';
            $ctrl.=periodo_ddl($valor,5,0);
            $ctrl.='</select>';
            break;
        case 'HOR':
            $ctrl='<select id="m_'.$campo['tabla_col_nombre'].'">'.time_ddl(0,'M').'</select> : <select id="s_'.$campo['tabla_col_nombre'].'">'.time_ddl(0,'S').'</select>';
            break;
        case 'IMG':
            $ctrl=cargar_imagen(100,100,'images/',0,$campo['tabla_col_nombre'],$valor);
            break;
        case 'IFR':
            $alto=($campo['ctr_max_length']>50)?$campo['ctr_max_length']:500;
            $ctrl='<iframe width="100%" height="'.$alto.'" id="'.$campo['tabla_col_nombre'].'" src="'.$campo['fuente_tbl'].'?tabla_id='.(int)$campo['tbl_col_dependencia'].'&id='.$valor.'"></iframe>';
            break;
        case'BTN':
            $param=($depen_valor>'')?$depen_valor:$valor;
            $function=($campo['fuente_tbl']>'')?$campo['fuente_tbl']."(".$param.");":$param;
            $ctrl='<input type="button" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="Ejecutar" onclick="'.$function.'" />';
            break;
        case 'PK':
        case 'HDN':
            $ctrl='<input type="hidden" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            break;
        case 'ADJ':
            //$campo['fuente_tbl']=ruta
            $file=($valor>'')?$valor:"Seleccionar archivo";
            $operador_id=$_SESSION['SIS'][2]; // Trabajador_id
            $ctrl='<div id="file_'.$campo['tabla_col_nombre'].'" style="float:left;border:solid blue 1px;background-color:gray;width:80%">'.$file.'</div><a target="_blank" href="'.$valor.'"><div style="float:left"><img src="images/icono_ojo.png" widht="18" height="18" title="Ver documento adjunto"></div></a>
                   <input type="hidden" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">
                   <script>Javascript:SubirArchivo(\''.$campo['fuente_tbl'].'\','.$operador_id.',\''.$campo['tabla_col_nombre'].'\')</script>';
            break;
        case 'PER':            
        case 'FRM':
             //tabla|id|valor|campo1,campo2|rotulo1,rotulo2|ancho1,ancho2
            $objeto=explode("|",$campo['fuente_tbl']);
            if(is_array($objeto)){
                $sql="select $objeto[3] from $objeto[0] where $objeto[1]=".(int)$valor;
                //echo $sql;
                $result=mysql_query($sql);
                //$fields=mysql_num_fields($result);
                $campos=explode(",",$objeto[3]);
                $cab=explode(",",$objeto[4]);
                $size=explode(",",$objeto[5]);
                $row=mysql_fetch_array($result);
                //$ctrl='<table width="100%" class="form">';
                $ctrl.='<tr bgcolor="#CCCCCC"><td height="16" colspan="4"><b>'.$campo['tabla_col_rotulo'].'</b></td></tr>';
                $ctrl.='<input type="hidden" name="frm_'.$objeto[1].'" id="frm_'.$objeto[1].'" value="'.(int)$valor.'">';
                for($c=0;$c<count($campos);$c++){
                    $ancho=($size[$c]>0)?$size[$c]:35;
                    $ctrl.='<tr><td>'.$cab[$c].'</td><td>:</td><td></td><td><input type="text" size="'.$ancho.'" name="frm_'.$campos[$c].'" id="frm_'.$campos[$c].'" value="'.$row[$campos[$c]].'"></td></tr>';
                }
                //$ctrl.='</table>';
                $ctrl.='<script language="javascript">
                        $(document).ready(function(){
                            $("#frm_'.$campos[0].'").autocomplete({
                                source: "ajax.php?a=search_form&fuente='.$campo['fuente_tbl'].'",
                                minLength: 2,
                                select: function(event,ui){
                                    $("#frm_'.$objeto[1].'").val(ui.item.id);';
                        for($c=0;$c<count($campos);$c++){
                            $ctrl.='$("#frm_'.$campos[$c].'").val(ui.item.'.$campos[$c].');'."\n";
                        }
                            $ctrl.='return false;
                                },
                                focus: function(event, ui) {
                                    $("#frm_'.$campos[0].'").val(ui.item.'.$campos[0].');
                                    return false;
                                },
                                open: function(event, ui) {
                                    $(this).autocomplete("widget").css({
                                        "width":$(this).width()
                                    });
                                }
                                });

                        });
                        </script>';
                
            }
            break;
        case 'EMP':
            $reg=empresa::edit('S',$valor);
            $ctrl='<table width="100%" class="list">
                    <tr>
                        <td>RUC</td>
                        <td><input name="emp_ruc" type="text" size="35" id="emp_ruc" value="'.$reg['emp_ruc'].'" />
                        <input name="empresa_id" type="hidden" id="empresa_id" value="'.$reg['empresa_id'].'" /><input type="button" value="ok" onclick="alert(document.getElementById(\'empresa_id\').value);">                        
                        </td>
                    </tr>
                    <tr>
                        <td>Razon Social</td>
                        <td><input name="emp_nombre" type="text" id="emp_nombre" size="35" value="'.$reg['emp_nombre'].'" /></td>
                    </tr>
                    <tr>
                        <td>Dirección</td>
                        <td><input name="emp_direccion" type="text" id="emp_direccion" size="35" value="'.$reg['emp_direccion'].'" /></td>
                    </tr>
                    </table>
                    <script language="javascript">
                        $(document).ready(function(){	
                            $("#emp_ruc").autocomplete({
                                source: "ajax.php?a=search_emp",
                                minLength: 2,
                                select: function(event, ui) {
                                    $("#empresa_id").val(ui.item.id);
                                    $("#emp_ruc").val(ui.item.ruc);
                                    $("#emp_nombre").val(ui.item.nombre);
                                    $("#emp_direccion").val(ui.item.direccion);                                   
                                    return false;
                                },
                                focus: function(event, ui) {
                                    $("#emp_ruc").val(ui.item.ruc);
                                    return false;
                                },
                                open: function(event, ui) {
                                    $(this).autocomplete("widget").css({
                                        "width":$(this).width()
                                    });
                                }
                                });

                        });                        
                        </script>';
            break;
        case 'CAR':
            $objeto=explode("|",$campo['fuente_tbl']);
            //$objeto=tabla|campos
            
            if($campo['tbl_col_dependencia']>''){
                if($tabla=tabla::tabla_edit("E",$campo['tbl_col_dependencia'])){
                    if($tabla['lst_cpo_form']>''){
                        $enlace="index.php?menu=".$tabla['lst_cpo_form']."&tbl_id=".$campo['tbl_col_dependencia']."&id=".$valor."&a=U";
                    }else{
                        $enlace="#";
                    }                    
                }                
            }
            
            $ctrl='<table width="100%" border="1" class="form">';
            $ctrl.='<tr  bgcolor="silver"><td>'.$campo['tabla_col_rotulo'].'</td><td align="right" width="5px"><a href="'.$enlace.'"><img title="Editar" src="images/b_edit.png"></a></td></tr>';
            if($campo['fuente_tbl']>''){
                if(is_array($objeto)){
                    // 0=tabla , 1=campos,      
                    $where=" and ".$campo['tabla_col_nombre']."=".(int)$valor;
                    
                    $sql="select ".$objeto[1]." from ".$objeto[0]." where bestado='1'".$where;
                    //$sql="select * from ".$campo['fuente_tbl'].$where;
                    $result=mysql_query($sql);
                    //$fields= mysql_num_fields($result);
                    //echo $sql;
                    while($row=mysql_fetch_array($result)){
//                        for($c=0;$c<$fields;$c++){
//                            $campo=  mysql_field_name($result, $c);
//                            $ctrl.='<tr><td>'.$campo.'</td><td>'.$row[$campo].'</td></tr>';
//                        }
                        $ctrl.='<tr><td colspan="2">'.$row['html'].'</td></tr>';
                                                
                    }                                                
                }
            }
            $ctrl.='</table>';
            break;
         case 'SRC':
            //tabla|id|valor|orden|condicion
            $result=tabla::tbl_autocomplete('S','',$valor,$campo['fuente_tbl']);
            if(is_array($result)){
                $id=$result['id'];
                $valor=$result['valor'];
            }
            
            if($campo['tbl_col_ficha']>0){
                $tabla=tabla::edit('S',$campo['tbl_col_ficha']);
                $add="<a onclick=\"form_ficha('I','".$campo['col_control']."',".(int)$campo['tabla_col_id'].",".(int)$campo['tbl_col_ficha'].",'".$campo['tabla_col_nombre']."','".$campo['tbl_col_dependencia']."','".$tabla['tbl_frm_ancho']."','".$tabla['tbl_frm_alto']."');\"><img title='Nuevo' src='images/add_reg.png'><a/>";
            }
            
            //$add=($campo['tbl_col_dependencia']>'')?'<a onclick="form_ficha(\'I\','.(int)$campo['tabla_col_id'].','.(int)$campo['tbl_col_dependencia'].',\''.$campo['tabla_col_nombre'].'\');"><img title="Nuevo" src="images/add_reg.png"><a/>':'';
            
            $ctrl='<input '.$obligatorio.' size="'.$campo['tabla_col_ancho'].'" type="text" id="valor_'.$campo['tabla_col_nombre'].'" name="valor_'.$campo['tabla_col_nombre'].'" value="'.$valor.'">
                   <input type="hidden" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$id.'">
                   '.$add.'
                   <script language="javascript">
                    $(document).ready(function(){	
                            $("#valor_'.$campo['tabla_col_nombre'].'").autocomplete({
                                source: "ajax.php?a=auto&fuente='.$campo['fuente_tbl'].'",
                                minLength: 2,
                                select: function(event, ui) {
                                    var valor=ui.item.id;';            
            if($reg=tabla_col::edit('E',$campo['tabla_col_nombre'])){
                foreach($reg as &$value){
                    $ctrl.='$("#'.$value['tabla_col_nombre'].'").load("ajax.php?a=select&col_id='.$value['tabla_col_id'].'&valor="+valor);';
                } 
            }                                    
                            $ctrl.='$("#'.$campo['tabla_col_nombre'].'").val(valor);
                                    return false;
                                },
                                focus: function(event, ui) {
                                    $("#valor_'.$campo['tabla_col_nombre'].'").val(ui.item.value);                               
                                    return false;
                                },
                                open: function(event, ui) {
                                    $(this).autocomplete("widget").css({
                                        "width":$(this).width()
                                    });
                                }
                                });

                        });                      
                    </script>';
            break;
        case 'PWD':
            $ctrl='<input type="password" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            break;
        case 'SOC':
            $ctrl='';
            break;
        case 'UBI':
                $ubi=persona::pers_dir_ubigeo('S',$valor,'','');
                switch($ubi[0]['ubigeo_tipo']){
                    case 2:                        
                        $departamento=pers_dir_ubigeo_ddl('2',$valor);
                        $provincia=pers_dir_ubigeo_ddl('3',0,$ubi[0]['ubigeo_codigo']);
                        break;
                    case 3:
                        $dep=persona::pers_dir_ubigeo('L',0,2,substr($ubi[0]['ubigeo_codigo'],0,2));                        
                        $departamento=pers_dir_ubigeo_ddl('2',$dep[0]['ubigeo_id']);
                        $provincia=pers_dir_ubigeo_ddl('3',$valor,$dep[0]['ubigeo_codigo']);
                        $distrito=pers_dir_ubigeo_ddl('4',0,$ubi[0]['ubigeo_codigo']);                                                                       
                        break;
                    case 4:                                                
                        
                        $pro=persona::pers_dir_ubigeo('L',0,3,substr($ubi[0]['ubigeo_codigo'],0,4));
                        $dep=persona::pers_dir_ubigeo('L',0,2,substr($pro[0]['ubigeo_codigo'],0,2));
                        
                        $departamento=pers_dir_ubigeo_ddl('2',$dep[0]['ubigeo_id']);
                        $provincia=pers_dir_ubigeo_ddl('3',$pro[0]['ubigeo_id'],$dep[0]['ubigeo_codigo']);
                        $distrito=pers_dir_ubigeo_ddl('4',$valor,$pro[0]['ubigeo_codigo']);                                                
                        break;
                    default:
                        $departamento=pers_dir_ubigeo_ddl('2','');
                        $provincia='';
                        $distrito='';
                        break;
                }
            
            $ctrl='<select style="width:200px;" id="dep_'.$campo['tabla_col_nombre'].'" name="dep_'.$campo['tabla_col_nombre'].'">'.$departamento.'</select><br>
                   <select style="width:200px;" id="pro_'.$campo['tabla_col_nombre'].'" name="pro_'.$campo['tabla_col_nombre'].'">'.$provincia.'</select><br>
                   <select style="width:200px;" id="dis_'.$campo['tabla_col_nombre'].'" name="dis_'.$campo['tabla_col_nombre'].'">'.$distrito.'</select>
                   <input type="hidden" id="'.$campo['tabla_col_nombre'].'" name="'.$campo['tabla_col_nombre'].'" value="'.$valor.'">';
            $ctrl.='<script language="javascript" type="text/javascript">
                    $(document).ready(function(){			       
                        $("#dep_'.$campo['tabla_col_nombre'].'").change(function(event){
                            var dep=$("#dep_'.$campo['tabla_col_nombre'].'").find(":selected").val();
                            $("#'.$campo['tabla_col_nombre'].'").val(dep);
                            $("#pro_'.$campo['tabla_col_nombre'].'").load("ajax.php?a=ubigeo&tipo=3&codigo="+dep);
                        });
                        $("#pro_'.$campo['tabla_col_nombre'].'").change(function(event){
                            var pro= $("#pro_'.$campo['tabla_col_nombre'].'").find(":selected").val();                            
                            $("#'.$campo['tabla_col_nombre'].'").val(pro);
                            $("#dis_'.$campo['tabla_col_nombre'].'").load("ajax.php?a=ubigeo&tipo=4&codigo="+pro);
                        });
                        $("#dis_'.$campo['tabla_col_nombre'].'").change(function(event){
                            var dis=$("#dis_'.$campo['tabla_col_nombre'].'").find(":selected").val();
                            $("#'.$campo['tabla_col_nombre'].'").val(dis);
                        });
                    });
                    </script>';
            break;
    }
    switch($campo['col_control']){
        case 'TXT':
        case 'NUM':
        case 'IGV':
            if($campo['tbl_col_calculo']>''){
                // 0= Operador(suma, multiplicacion, etc)
                // 1= campos a operar(campo1,campo2)
                $valorc=array();
                $calculo=explode(":",$campo['tbl_col_calculo']);
                $valores=explode(",",$calculo[1]);
                for($i=0;$i<count($valores);$i++){
                    if(is_numeric($valores[$i])){
                        $valorc[]=$valores[$i];
                    }else{
                        $valorc[]='parseFloat($("#'.$valores[$i].'").val())';
                    }
                }
                $ctrl.='<script language="javascript">';
                for($c=0;$c<count($valores);$c++){
                    if(!is_numeric($valores[$i])){
                        $ctrl.='$("#'.$valores[$c].'").keyup(function(e){';
                        $ctrl.='$("#'.$campo['tabla_col_nombre'].'").val('.implode($calculo[0],$valorc).')';
                        $ctrl.='});';
                    }
                    
                }                                
                $ctrl.='</script>';
            }
            break;
    }
    return $ctrl;
}

//*********************** Paginacion *****************************/
function paginacion($color='black'){
	$regporpag=$_SESSION['operador']['regporpag'];
	$ctotal=$_SESSION['operador']['sqlctotal'];
	$cactual=$_SESSION['operador']['sqlctotalactual'];
	$sqlpos=$_SESSION['operador']['sqlpos'];
	if($regporpag>0 && $cactual>0){
		$mod=(($ctotal%$regporpag)==0)?$regporpag:$ctotal%$regporpag;
	}
	$cad='<script language="javascript">
	function navegacion(v){
		pos=document.getElementById("sqlpos");
		switch(v){
			case 1:
				if(pos.value==0){return;}
				pos.value=0;
			break;
			case 2:
				if(pos.value==0){return;}
				pos.value=parseInt(pos.value)-'.$regporpag.';
			break;
			case 3:
				if(pos.value=='.($ctotal-$mod).'){return;}
				if(pos.value==""){pos.value=0;}
				pos.value=parseInt(pos.value)+'.$regporpag.';
			break;
			case 4:
				if(pos.value=='.($ctotal-$mod).'){return;}
				pos.value='.($ctotal-$mod).';
			break;
			
		}
		document.form1.submit();
	}
	</script>
	<input type="hidden" id="sqlpos" name="sqlpos" value="'.$sqlpos.'">
	<a href="#" onclick="navegacion(1);" title="Inicio"><img src="images/go-first.png"></a>
	<a href="#" onclick="navegacion(2);" title="Anterior"><img src="images/go-previous.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<font color="'.$color.'">';
    if($ctotal>0){
         $cad.= (!isset($sqlpos))?"1/".$cactual." de ".$ctotal:($sqlpos+1)."/".($sqlpos+$cactual). " de ".$ctotal;
    }else{
    	$cad.= "0/0 de 0";
    }
    return $cad.'</font>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="#" onclick="navegacion(3);" title="Siguiente"><img src="images/go-next.png"></a>
	<a href="#" onclick="navegacion(4);" title="&Uacute;ltimo"><img src="images/go-last.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;';
}

/**************************************/
function menu_lista($perfil=0){
    
    if($perfil>0){    
    echo '<div id="menu">';   
    menu::menu_lista(0,$perfil);
    echo '<ul class="right">';
    //echo '<li id="store"><a class="top" href="#" onclick="Extranet(3);"><b>Joomla</b></a></li>';
    //echo '<li id="store"><a class="top" target="_blank" href="ayuda.php?id='.$_GET['tbl_id'].'">Ayuda</a></li>';
    echo '<li id="store"><a class="top" onclick="getGuia(1,'.(int)$_GET['tbl_id'].')">Ayuda</a></li>';
    echo '<li id="store"><a class="top" onclick="Salir();">Salir</a></li>';
    echo '</ul>';
    echo '</div>';
    }
}
function menu_navegacion($menu_id=0){
    if($_SESSION['SIS'][1]>''){
        $str='<div class="breadcrumb">';
        $str.='<a href="index.php">Inicio</a>';
        if($menu_id>0 && $menu_id<>6){
            $str.=' » '.menu::menu_nav($menu_id);        
        }
        $str.='</div>';
        echo $str;
    }
}

function Pagina($ruta=''){
    //echo 'User: '.$_SESSION['SIS'][1];
    if($_SESSION['SIS'][1]>''){
        $ruta=($ruta=='login')?'home':$ruta;
        if($ruta>''){
//            $arr=explode("/",$ruta);
//            print_r($arr);
//            $ruta=(count($arr)>=1)?$arr[1]:$arr[0];
            if(file_exists($ruta.".php")){
                include $ruta.".php";
            }else{
                echo '<div class="warning">No se encuentra el recurso '.$ruta.'.php.</div>';
            }
        }else{
            include "home.php";
        }
       
    }else{
        include "login.php";
    }   
}

/************************************************/

function operador_lista(){
    $reg=operador::ope_edit('L',0);
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,Login',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['ope_id']."'/></td>            
            <td>".$reg[$x]['ope_id']."</td>
            <td>".$reg[$x]['ope_login']."</td>
            <td width='10' align='center'><a href='index.php?menu=ope_form&a=U&id=".$reg[$x]['ope_id']."' title='Editar'><img src='images/b_edit.png'></a></td>            
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

/***********************************************/
function personas_lista($id=0){
    $reg=persona::lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,DNI,Nombres,Nacionalidad,Fec. Nac.,Sexo,Pais',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['persona_id']."'/></td>            
            <td >".$reg[$x]['persona_id']."</td>
	    <td >".$reg[$x]['pers_dni']."</td>
            <td >".$reg[$x]['pers_nombres']." ".$reg[$x]['pers_apepat']." ".$reg[$x]['pers_apemat']."</td>
            <td >".$reg[$x]['pers_nacionalidad']."</td>
            <td >".$reg[$x]['pers_fecnac']."</td>
            <td >".$reg[$x]['pers_sexo']."</td>
            <td >".$reg[$x]['pers_dir_pais']."</td>
            <td width='10' align='center'><a href='index.php?menu=personas_edit&a=U&id=".$reg[$x]['persona_id']."' title='Editar'><img src='images/b_edit.png'></a></td>            
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

function trabajador_lista($id=0){
    $reg=persona::trabajador_lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,DNI,Nombres,Nacionalidad,Fec. Nac.,Sexo,Pais',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['ope_id']."'/></td>            
            <td >".$reg[$x]['persona_id']."</td>
	    <td >".$reg[$x]['pers_dni']."</td>
            <td >".$reg[$x]['pers_nombres']." ".$reg[$x]['pers_apepat']." ".$reg[$x]['pers_apemat']."</td>
            <td >".$reg[$x]['pers_nacionalidad']."</td>
            <td >".$reg[$x]['pers_fecnac']."</td>
            <td >".$reg[$x]['pers_sexo']."</td>
            <td >".$reg[$x]['pers_dir_pais']."</td>
            <td width='10' align='center'><a href='index.php?menu=trab_form&a=U&id=".$reg[$x]['persona_id']."' title='Editar'><img src='images/b_edit.png'></a></td>
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

function contacto_lista($empresa_id=0){
    $reg=persona::contacto_lista(0,$empresa_id);
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,DNI,Nombres,Nacionalidad,Fec. Nac.,Sexo,Pais,Empresa',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['ope_id']."'/></td>
            <td>".$reg[$x]['persona_id']."</td>
	    <td>".$reg[$x]['pers_dni']."</td>
            <td>".$reg[$x]['pers_nombres']." ".$reg[$x]['pers_apepat']." ".$reg[$x]['pers_apemat']."</td>
            <td>".$reg[$x]['pers_nacionalidad']."</td>
            <td>".$reg[$x]['pers_fecnac']."</td>
            <td>".$reg[$x]['pers_sexo']."</td>
            <td>".$reg[$x]['pers_dir_pais']."</td>
            <td>".$reg[$x]['emp_nombre']."</td>
            <td width='10' align='center'><a onclick=\"contac_form(1,'U',".$reg[$x]['contacto_id'].",".$reg[$x]['empresa_id'].")\" title='Editar'><img src='images/b_edit.png'></a></td>
            </tr>";
        }    
        echo "</tbody></table>";
    }
}



function pers_nacionalidad_ddl($id){
		$cad="<option value='0'></option>";
		if($reg=persona::pers_nacionalidad()){
			foreach($reg as &$r){
				$sel=($r['ubigeo_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['ubigeo_id']."' ".$sel.">".$r['ubigeo_nac']."</option>";
			}
		}
		return $cad;
	}
	
	function pers_pais_ddl($id){
		$cad="<option value='0'></option>";
		if($reg=persona::pers_pais()){
			foreach($reg as &$r){
				$sel=($r['ubigeo_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['ubigeo_id']."' ".$sel.">".$r['ubigeo_nombre']."</option>";
			}
		}
		return $cad;
	}

function ubigeo_ddl($tipo='',$id='',$codigo=''){    
    
    if($id>''){
        $ubi=persona::pers_dir_ubigeo('S',$id,'','');
        $codigo=$ubi[0]['ubigeo_codigo'];
    }
    $cad="<option value='0'></option>";
    if($reg=persona::pers_dir_ubigeo('L',0,$tipo,$codigo)){
            foreach($reg as &$r){
                    $sel=($r['ubigeo_id']==$id)?"SELECTED":"";
                    $cad.="<option value='".$r['ubigeo_id']."' ".$sel.">".$r['ubigeo_nombre']."</option>";
            }
    }
    return $cad;       
}

function pers_dir_ubigeo_ddl($tipo='',$id='',$codigo=''){    
    
    
    $cad="<option value='0'></option>";
    if($reg=persona::pers_dir_ubigeo('L',0,$tipo,$codigo)){
            foreach($reg as &$r){
                    $sel=($r['ubigeo_id']==$id)?"SELECTED":"";
                    $cad.="<option value='".$r['ubigeo_id']."' ".$sel.">".$r['ubigeo_nombre']."</option>";
            }
    }
    return $cad;       
}

        
	function pers_sexo_ddl($id){
		$cad="<option value='0'></option>";
		if($reg=persona::pers_sexo()){
			foreach($reg as &$r){
				$sel=($r['pers_sexo_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['pers_sexo_id']."' ".$sel.">".$r['nombre']."</option>";
			}
		}
		return $cad;
	}
	function persona_perfil_ddl($id){
		$cad="<option value='0'></option>";
		if($reg=persona::persona_perfil()){
			foreach($reg as &$r){
				$sel=($r['persona_perfil_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['persona_perfil_id']."' ".$sel.">".$r['nombre']."</option>";
			}
		}
		return $cad;
	}
        function pers_estado_ddl($id){
		$cad="<option value='0'></option>";
		if($reg=persona::pers_estado()){
			foreach($reg as &$r){
				$sel=($r['pers_estado_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['pers_estado_id']."' ".$sel.">".$r['pees_nombre']."</option>";
			}
		}
		return $cad;
	}
        

function persona_ficha($accion='',$id=0){
  $reg=persona::edit('E',$id); 
  echo '<table width="100%"  class="form">';
  echo '<tr><td colspan="2">Datos Personales:</td></tr>';
  echo '<tr>';
  echo '<td width="19%" align="center" valign="top"><table width="100%">';
  echo '<tr>';
  echo '<td height="112">';
  echo '<img id="foto"" width="100px"></td>';
  echo '</tr>';      
  echo '</table></td>
    <td width="81%"><table width="100%" class="form">
      <tr>
        <td>DNI:</td>
        <td>'.persona_control($accion,'pers_dni',20,$reg['pers_dni']).'</td>
      </tr>
      <tr>
        <td >Nombre:</td>
        <td>'.persona_control($accion,'pers_nombres',50,$reg['pers_nombres']).'</td>
      </tr>
      <tr>
        <td>Apellido Paterno:</td>
        <td>'.persona_control($accion,'pers_ape_pat',50,$reg['pers_apepat']).'</td>
      </tr>
      <tr>
        <td>Apellido Materno:</td>
        <td>'.persona_control($accion,'pers_apemat',50,$reg['pers_apemat']).'</td>
      </tr>                                                            
    </table></td>
  </tr>        
  </tr>
</table>';
}

function persona_control($accion='',$nombre='',$size=20,$valor=''){
    switch($accion){
        case "I":
            return '<input type="text" name="'.$nombre.'" size="'.$size.'" value="'.$valor.'" />';
            break;
        case "U":
            return $valor;
            break;
    }
}


function empresa_lista($id=0){
    $reg=empresa::lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,RUC,Nombre,Tipo,Email,Direcci&oacute;n,Tel&eacute;fono',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['persona_id']."'/></td>            
            <td >".$reg[$x]['empresa_id']."</td>
            <td >".$reg[$x]['emp_ruc']."</td>
	    <td >".$reg[$x]['emp_nombre']."</td>            
            <td >".$reg[$x]['empresa_tipo_id']."</td>
            <td >".$reg[$x]['emp_email']."</td>
            <td >".$reg[$x]['emp_direccion']."</td>
            <td >".$reg[$x]['emp_telef']."</td>
            <td width='10' align='center'><a href='index.php?menu=empresa_form&a=U&id=".$reg[$x]['empresa_id']."' title='Editar'><img src='images/b_edit.png'></a></td>            
            </tr>";
        }    
        echo "</tbody></table>";
    }
}





function cliente_lista($id=0){
    $reg=empresa::cliente_lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,RUC,Nombre,Tipo,Email,Direcci&oacute;n,Tel&eacute;fono',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['persona_id']."'/></td>            
            <td >".$reg[$x]['empresa_id']."</td>
            <td >".$reg[$x]['emp_ruc']."</td>
	    <td >".$reg[$x]['emp_nombre']."</td>            
            <td >".$reg[$x]['empresa_tipo_id']."</td>
            <td >".$reg[$x]['emp_email']."</td>
            <td >".$reg[$x]['emp_direccion']."</td>
            <td >".$reg[$x]['emp_telef']."</td>
            <td width='10' align='center'><a href='index.php?menu=cliente_form&a=U&id=".$reg[$x]['empresa_id']."' title='Editar'><img src='images/b_edit.png'></a></td>            
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

function proveedor_lista($id=0){
    $reg=empresa::proveedor_lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,RUC,Nombre,Tipo,Email,Direcci&oacute;n,Tel&eacute;fono',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['persona_id']."'/></td>            
            <td >".$reg[$x]['empresa_id']."</td>
            <td >".$reg[$x]['emp_ruc']."</td>
	    <td >".$reg[$x]['emp_nombre']."</td>            
            <td >".$reg[$x]['empresa_tipo_id']."</td>
            <td >".$reg[$x]['emp_email']."</td>
            <td >".$reg[$x]['emp_direccion']."</td>
            <td >".$reg[$x]['emp_telef']."</td>
            <td width='10' align='center'><a href='index.php?menu=proveedor_form&a=U&id=".$reg[$x]['empresa_id']."' title='Editar'><img src='images/b_edit.png'></a></td>            
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

function empresa_ficha($accion='',$empresa_id=0){
    $reg=empresa::edit('S',$empresa_id);
    echo '<table width="100%" class="form">
  <tr>
    <td>RUC:</td>
    <td class="edit113">'.persona_control($accion,'emp_ruc',20,$reg['emp_ruc']).'</td>
  </tr>
  <tr>
    <td>Nombre:</td>
    <td class="edit113">'.persona_control($accion,'emp_nombre',50,$reg['emp_nombre']).'</td>
  </tr>
  <tr>
    <td>Tipo:</td>
    <td class="edit113"><select name="empresa_tipo_id" id="empresa_tipo_id"></select></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td class="edit113">'.persona_control($accion,'emp_email',50,$reg['emp_email']).'</td>
  </tr>
  <tr>
    <td>Direcci&oacute;n</td>
    <td class="edit113">'.persona_control($accion,'emp_direccion',50,$reg['emp_direccion']).'</td>
  </tr>
  
  <tr>
    <td>Tel&eacute;fono:</td>
    <td class="edit113">'.persona_control($accion,'emp_telef',20,$reg['emp_telef']).'</td>
  </tr>
  
  <tr>
    <td>Ubigeo:</td>
    <td class="edit113"><select name="ubigeo_id" id="ubigeo_id">
      
    </select></td>
  </tr>
  
  <tr>
    <td>Estado:</td>
    <td class="edit113"><select name="pers_estado_id">
      
    </select></td>
  </tr>
</table>';
}

function get_empresa($empresa_id=0,$campo=''){
    if($empresa_id>0){
        $reg=empresa::edit('S',$empresa_id);
        return $reg[$campo];
    }else{
        return '';
    }
    
}


function empresa_perfil_ddl($id){
		$cad="<option value='0'></option>";
		if($reg=empresa::empresa_perfil()){
			foreach($reg as &$r){
				$sel=($r['empresa_perfil_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['empresa_perfil_id']."' ".$sel.">".$r['nombre']."</option>";
			}
		}
		return $cad;
	}


function emp_tipo_ddl($id){
		$cad="<option value='0'></option>";
		if($reg=empresa::emp_tipo()){
			foreach($reg as &$r){
				$sel=($r['emp_tipo_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['emp_tipo_id']."' ".$sel.">".$r['emp_tipo_nombre']."</option>";
			}
		}
		return $cad;
	}
        
/*************** Local ***********************************/
function local_lista($empresa_id=0){
    if($empresa_id>0){
        $reg=local::lista($empresa_id);
        $nreg=count($reg);
        if($nreg>0){
            echo "<table class='list'>".cabecera(true,'Id,Nombre,Direcci&oacute;n,Ubigeo,Tel&eacute;fono,Responsable,Comentario',1);
            echo "<tbody>";
            for($x=0;$x<$nreg;$x++){            
                echo "<tr>
                <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['local_id']."'/></td>            
                <td >".$reg[$x]['local_id']."</td>
                <td >".$reg[$x]['local_siglas']."</td>
                <td >".$reg[$x]['local_direccion']." ".$reg[$x]['pers_apepat']." ".$reg[$x]['pers_apemat']."</td>           
                <td >".$reg[$x]['ubigeo_id']."</td>
                <td >".$reg[$x]['local_telef']."</td>    
                <td >".$reg[$x]['local_respons']."</td>
                <td >".$reg[$x]['local_coment']."</td>
                <td width='10' align='center'><a href='#' onclick=\"local_form(1,'U',".$reg[$x]['local_id'].",".$reg[$x]['empresa_id'].")\" title='Editar'><img src='images/b_edit.png'></a></td>            
                </tr>";
            }    
            echo "</tbody></table>";
        }
    }
}

/**************** Control Imagen *******************/
function cargar_imagen($w=100,$h=100,$ruta='images/',$id=0,$control='',$file='0.jpg'){
    if(file_exists($file) && $file>''){
        $get_file=$file;
    }else{
        $get_file='images/no_image.jpg';
    }
    return "<img class='imagen' id='img_".$control."' width='".$w."' height='".$h."' src='".$get_file."' onclick=\"CargarImagen(1,'".$ruta."','".$id."','".$control."','".$get_file."')\"><input type='hidden' id='".$control."' name='".$control."' value='".$get_file."'>";
}

/**************** Documentos **********************/
function documentos_lista($id_origen,$tabla_id=0,$rotulo=""){
		$cad="<table class='listado'><tr class='lista'><td class='lista111'>Documentos adjuntos ".$rotulo."</td>
		<td align='right' class='lista111'><a href='subir.php?tabla_id=".($tabla_id+0)."' onclick='wopen(this.href);return false;'><img src='images/mas.png' width='35px'></a></td></tr></table>";
		$cad.="<table class='list'>".cabecera(false,'Id,Nombre,Descripci&oacute;n,Tipo,Tama&ntilde;o,Creado el',3);
		if($reg=documento::lista($id_origen)){
			foreach($reg as &$r){
				$cad.="<tr>".
				"<td class='celdac'>".$r['documento_id']."</td><td >".$r['docu_rotulo']."</td>
				<td >".$r['docu_descripcion']."</td>
				<td class='celdac'>".$r['docu_tipo']."</td>
				<td class='celdac'>".$r['docu_tam']."</td><td class='celdac'>".$r['docu_fec_creacion']."</td>
                                <td class='celdac' width='25px'><a href='ajax.php?key=documentos_edit&a=D&id=".$r['documento_id']."' onclick='documentos_edit(this.href,".($_SESSION['operador']['formId']+0).");return false;'><img src='images/b_drop.png'></a></td>
				<td class='celdac'><a href='ajax.php?key=documentos_panel&id=".$r['documento_id']."&formId=".($_SESSION['operador']['formId'])."' title='documentos_lista' onclick='page(this.href,this.title);return false;'><img src='images/b_edit.png'></a></td>
				<td class='celdac' width='25px'></td>
                                </tr>";
			}
		}
		return $cad."</table>";
	}
        
function variable($nombre=''){return variables::var_valor($nombre);}


/************************ Mantenimiento Tablas ***********************************/

function tabla_lista(){
        $reg=tabla::tbl_lista(0);
        $nreg=count($reg);
        if($nreg>0){
            echo "<table class='list'>".cabecera(true,'Id,Nombre,Alias,Descripci&oacute;n',1);
            echo "<tbody>";
            //echo "<tr class='filter'><td colspan='6'></d></tr>";
            for($x=0;$x<$nreg;$x++){
                echo "<tr>
                <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['tabla_id']."'/></td>            
                <td >".$reg[$x]['tabla_id']."</td>
                <td >".$reg[$x]['tbl_nombre']."</td>
                <td >".$reg[$x]['tbl_alias']."</td>           
                <td >".$reg[$x]['tbl_desc']."</td>                                                
                <td width='10' align='center'><a href='index.php?menu=tabla_form&a=U&id=".$reg[$x]['tabla_id']."' title='Editar'><img src='images/b_edit.png'></a></td>
                </tr>";
            }    
            echo "</tbody></table>";
        }
    
}

function tbl_grupo_lista($tabla_id=0){
        $reg=tabla_grupo::lista($tabla_id);
        $nreg=count($reg);
        if($nreg>0){
            echo "<table class='list'>".cabecera(true,'Id,Nombre,Orden',2);
            echo "<tbody>";
            for($x=0;$x<$nreg;$x++){
                echo "<tr>
                <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['tabla_grupo_id']."'/></td>            
                <td class='center'>".$reg[$x]['tabla_grupo_id']."</td>
                <td >".$reg[$x]['tabla_grupo_nombre']."</td>
                <td class='center'>".$reg[$x]['tabla_grupo_orden']."</td>
                <td width='10' align='center'><a onclick=\"grupo_form(1,'U',".$reg[$x]['tabla_grupo_id'].",".$reg[$x]['tabla_id'].")\" title='Editar'><img src='images/b_edit.png'></a></td>
                <td width='10' align='center'><a onclick=\"DeleteGrupo(".$reg[$x]['tabla_id'].",".$reg[$x]['tabla_grupo_id'].")\" title='Eliminar'><img src='images/b_drop.png'></a></td>
                </tr>";
            }    
            echo "</tbody></table>";
        }
    
}

function tbl_col_lista($tabla_id=0,$orden=''){    
        $reg=tabla_col::lista($tabla_id,$orden);
        $nreg=count($reg);
        if($nreg>0){
            echo "<table class='list'>".cabecera(true,'Id,Grupo,Nombre,Rotulo,Descripci&oacute;n,Lado,Orden F.,Orden L.,Ctr,Longitud',2);
            echo "<tbody>";
            for($x=0;$x<$nreg;$x++){                
                echo "<tr>
                <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['tabla_col_id']."'/></td>            
                <td >".$reg[$x]['tabla_col_id']."</td>
                <td >".$reg[$x]['grupo']."</td>
                <td >".$reg[$x]['tabla_col_nombre']."</td>                
                <td >".$reg[$x]['tabla_col_rotulo']."</td>
                <td >".$reg[$x]['tabla_col_desc']."</td> 
                <td >".$reg[$x]['tabla_col_panel_pos']."</td>
                <td >".$reg[$x]['tabla_col_orden']."</td>
                <td >".$reg[$x]['tbl_col_orden_lst']."</td>
                <td >".$reg[$x]['col_control']."</td>
                <td >".$reg[$x]['tabla_col_ancho']."</td>
                <td width='10' align='center'><a onclick=\"col_form(1,'U',".$reg[$x]['tabla_col_id'].",".$reg[$x]['tabla_id'].",'tabla_col_form.php')\" title='Editar'><img src='images/b_edit.png'></a></td>
                <td width='10' align='center'><a onclick=\"DeleteCol(".$reg[$x]['tabla_id'].",".$reg[$x]['tabla_col_id'].")\" title='Eliminar'><img src='images/b_drop.png'></a></td>    
                </tr>";
            }    
            echo "</tbody></table>";
        }
    
}

function tbl_accion_lista($tabla_id=0){
        $reg=tabla_accion::lista($tabla_id);
        $nreg=count($reg);
        if($nreg>0){
            echo "<table class='list'>".cabecera(true,'Id,Tipo,Icono,Nombre,Orden,Descripción',2);
            echo "<tbody>";
            for($x=0;$x<$nreg;$x++){
                $img=($reg[$x]['tbl_accion_icono']>'')?"<img height='16' width='16' src='".$reg[$x]['tbl_accion_icono']."'>":"";
                echo "<tr>
                <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['tabla_grupo_id']."'/></td>
                <td class='center'>".$reg[$x]['tabla_accion_id']."</td>
                <td class='center'>".tbl_accion_tipo_ddl('S',$reg[$x]['tbl_accion_tipo'])."</td>
                <td class='center'>".$img."</td>
                <td>".$reg[$x]['tbl_accion_nombre']."</td>
                <td class='center'>".$reg[$x]['tbl_accion_orden']."</td>
                <td>".$reg[$x]['tbl_accion_descripcion']."</td>
                <td width='10' align='center'><a onclick=\"accion_form(1,'U',".$reg[$x]['tabla_accion_id'].",".$reg[$x]['tabla_id'].")\" title='Editar'><img src='images/b_edit.png'></a></td>
                <td width='10' align='center'><a onclick=\"DeleteAccion(".$reg[$x]['tabla_id'].",".$reg[$x]['tabla_accion_id'].")\" title='Eliminar'><img src='images/b_drop.png'></a></td>
                </tr>";
            }
            echo "</tbody></table>";
        }
    
}

function tbl_accion_tipo_ddl($accion='',$id=0){    
    $reg=array(1=>"Lista",2=>"Formulario",3=>"General");
    switch($accion){
        case 'L':
            foreach ($reg as $key => $value){
                $select=($key==$id)?' selected ':'';
                $str.='<option value="'.$key.'" >'.$value.'</option>';
            }
            break;
        case 'S':
            $str=$reg[$id];
            break;
    }
    
    return $str;
}


function tbl_grupo_ddl($tbl_id=0,$id=0){
		$cad="<option value=''></option>";
		if($reg=tabla_grupo::lista($tbl_id)){
			foreach($reg as &$r){
				$sel=($r['tabla_grupo_id']==$id)?"SELECTED":"";
				$cad.="<option value='".$r['tabla_grupo_id']."' ".$sel.">".$r['tabla_grupo_nombre']."</option>";
			}
		}
		return $cad;
	}
        
function tbl_col_tipo_ddl($id=''){   
    $reg=array('TXT','SN','IGV','RUC','ETQ','HTM','TXA','EMA','LST','LSA','IMG','HR0','GRP','CAL','MES','AXO','HOR','MON','UBI','BTN','ADJ','IFR','PK','TBL','PWD','SOC','SRC','NUM','HDN','CAR','NRO','FRM','CHK','MGN');
    sort($reg);
    $cad="<option value=''></option>";
    for($i=0;$i<count($reg);$i++){
        $sel=($reg[$i]==$id)?"SELECTED":"";        
        $cad.="<option value='".$reg[$i]."' ".$sel.">".$reg[$i]."</option>";
    }    
    return $cad;
}



function tbl_col_panel_ddl($id=''){
    $r=array('Izquierda','Derecha');
    $reg=array('L','R');
    $cad="<option value=''></option>";
    for($i=0;$i<count($reg);$i++){
        $sel=($reg[$i]==$id)?"SELECTED":"";        
        $cad.="<option value='".$reg[$i]."' ".$sel.">".$r[$i]."</option>";
    }    
    return $cad;
}
function tbl_col_align_ddl($id=''){
    $r=array('Izquierda','Derecha','Centro');
    $reg=array('L','R','C');
    //$cad="<option value=''></option>";
    for($i=0;$i<count($reg);$i++){
        $sel=($reg[$i]==$id)?"SELECTED":"";        
        $cad.="<option value='".$reg[$i]."' ".$sel.">".$r[$i]."</option>";
    }    
    return $cad;
}


function time_ddl($id='',$format=''){
    switch($format){
        case 'M':
            $limite=24;
            break;
        case 'S':
            $limite=60;
            break;
    }          
    for($i=0;$i<$limite;$i++){
        $reg=(strlen((string)$i)==1)?"0".$i:$i;
        //$sel=($i==$id)?"SELECTED":"";        
        $cad.="<option value='".$reg."' ".$sel.">".$reg."</option>";
    }    
    return $cad;
}

/*******************************/
function perfil_ddl($id=0){
    $empresa_id=$_SESSION['SIS'][5];
    if($reg=operador::ope_perfil($empresa_id)){
        foreach($reg as &$r){
            $sel=($r['perfil_id']==$id)?"SELECTED":"";
            $cad.="<option value='".$r['perfil_id']."' ".$sel.">".$r['perfil_nombre']."</option>";
        }
    }
    return $cad;
}

function menu_perfil_ddl($id=0,$perfil_id=0,$lvl=0){
    menu::menu_perfil('L',$id,$perfil_id,$lvl);
//    for($i=0;$i<count($reg);$i++){
//        echo $reg[$i]['menu_nombre']."<br>";
//    }
}

function emp_perfil_ddl($perfil_id=0){
    menu::perfil_empresa('L',$perfil_id);
//    for($i=0;$i<count($reg);$i++){
//        echo $reg[$i]['menu_nombre']."<br>";
//    }
}

function tablero_perfil_ddl($perfil_id=0){
    menu::perfil_tablero('L',$perfil_id);
//    for($i=0;$i<count($reg);$i++){
//        echo $reg[$i]['menu_nombre']."<br>";
//    }
}


function mi_empresa_ddl(){
    
    $reg=empresa::mi_empresa();    
    if($reg){
        if(count($reg)>1){
            $cad="<option value='0'></option>";
        }
            foreach($reg as &$r){                    
                    $cad.="<option value='".$r['empresa_id']."'>".$r['emp_nombre']."</option>";
            }
    }
    return $cad;
}

function persona_correo_lista($id=0){
    $reg=persona::persona_correo_lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Para',0,0,'left');
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['ope_id']."'/></td>
            <td >".$reg[$x]['pers_nombres']." ".$reg[$x]['pers_apepat']." ".$reg[$x]['pers_apemat']." </td>
            </tr>";
        }
        echo "</tbody></table>";
    }
}


/************************ Enviar Mail **********************************/

function send_mail_persona($asunto,$mensaje,$adjuntos){
    $reg=persona::persona_correo_lista();
    $nreg=count($reg);
    if($nreg>0){
        for($x=0;$x<$nreg;$x++){
            if($reg[$x]['pers_mail']>''){
                send_mail('andy@solucionestecperu.com',$reg[$x]['pers_mail'], $asunto,$mensaje,$adjuntos,'','');
                $persona_id[]=$reg[$x]['persona_id'];
                $para[]=$reg[$x]['pers_mail'];
            }           
        }
        mensaje::edit('I',0,implode(',',$persona_id),implode(',',$para),$asunto,$mensaje,$adjuntos);
        persona::edit('M','');
        return "<div class='success'>El correo ha sido enviado.</div>";
    }else{
        return "<div class='warning'>Error al enviar.</div>";
    }
}

function get_tipo_file($ext=''){
    switch ($ext) { 
      case "pdf": $ctype="application/pdf"; break; 
      case "exe": $ctype="application/octet-stream"; break; 
      case "zip": $ctype="application/zip"; break; 
      case "doc": $ctype="application/msword"; break; 
      case "xls": $ctype="application/vnd.ms-excel"; break; 
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break; 
      case "gif": $ctype="image/gif"; break; 
      case "png": $ctype="image/png"; break; 
      case "jpeg": 
      case "jpg": $ctype="image/jpg"; break; 
      default: $ctype="application/force-download"; 
    }
    return $ctype;
}

function send_mail($sDe='',$sPara='', $sAsunto='', $sMensaje='', $sFile='',$cc='',$cco=''){
	$UN_SALTO="\r\n";
	$DOS_SALTOS="\r\n\r\n";
	//$remitente=variable('dominio');
	//$sMensaje=str_replace(chr(13),'<br>',$sMensaje);
	$mensaje="<html><head></head><body>";
	$mensaje.=$sMensaje;
	$mensaje.="</body></html>";
	$separador="_separador_de_trozos_".md5 (uniqid (rand()));
	$cabecera="Date: ".date("l j F Y, G:i").$UN_SALTO;
	$cabecera.="MIME-Version: 1.0".$UN_SALTO;
	$cabecera.="From:".$sDe.$UN_SALTO;
	//$cabecera.="Cc: ".$cc.$UN_SALTO;
	//$cabecera.="Bcc: ".$cco.$UN_SALTO;
	$cabecera.="X-Mailer: PHP/". phpversion().$UN_SALTO;
	$cabecera.="Content-Type: multipart/mixed;".$UN_SALTO;
	$cabecera.=" boundary=$separador".$DOS_SALTOS;
	$texto="--$separador".$UN_SALTO;
	$texto.="Content-Type: text/html; charset=\"UTF-8\"".$UN_SALTO;
	$texto.="Content-Transfer-Encoding: 7bit".$DOS_SALTOS;
	$texto.=$mensaje;
	if($sFile>''){
		$archivos=split(',',$sFile);
		foreach ($archivos as $sFile) {
                    $info=pathinfo($sFile);
                    $adj .= $UN_SALTO."--$separador".$UN_SALTO;
                    $adj .="Content-Type:".get_tipo_file($info['extension'])."; name=\"".$info['basename']."\"".$UN_SALTO;
                    $adj .="Content-Transfer-Encoding: base64".$UN_SALTO;
                    $adj .="Content-Disposition: attachment; filename=\"".$info['basename']."\"".$DOS_SALTOS;
                    
                    $fp = fopen($sFile, "r");
                    $buff = fread($fp, filesize($sFile));
                    fclose($fp);
                    $adj .=chunk_split(base64_encode($buff));
                    $adj .=$UN_SALTO."--$separador".$UN_SALTO;
		}
	}
	$mensaje=$texto.$adj;
	//ini_set('SMTP',"mail.solucionestecperu.com");
	//ini_set('smtp_port','21');
	return mail($sPara, $sAsunto, $mensaje,$cabecera);
}



function listar_dir($path='',$nivel=0){
    $dir_handle = opendir($path) or die("Unable to open $path");
    echo ($nivel==0)?'<ul class="dir"><li ><a title="'.$path.'" onclick="getFile(this)">'.$path.'</a>':'';
    echo "<ul class='dir'>";
    $nivel++;
    while ($file = readdir($dir_handle)){
        if ($file != "." && $file != "..") { 
            if (is_dir($path."//".$file)) { 
                $ruta=$path."/".$file;
                echo '<li ><a title="'.$ruta.'" onclick="getFile(this)">'.$file.'</a></li>';
                listar_dir($ruta,$nivel);
            }
        }
    }
    closedir($dir_handle);
    echo "</ul>";
    echo ($nivel==0)?"</li></ul>":"";
}


function mensaje_lista(){
    $reg=mensaje::edit('L');
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,Fecha,Asunto,Mensaje,Nro. Envios',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){
            $envios=explode(",",$reg[$x]['msj_para']);
            $cuerpo=(strlen($reg[$x]['msj_cuerpo'])>60)?substr($reg[$x]['msj_cuerpo'],0,60)." ...":$reg[$x]['msj_cuerpo'];
            echo "<tr>                
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['ope_id']."'/></td>
            <td class='center'>".$reg[$x]['mensaje_id']."</td>    
            <td class='center'>".$reg[$x]['msj_fecha']."</td>            
            <td>".$reg[$x]['msj_asunto']."</td>
            <td>".$cuerpo."</td>
            <td class='center'>".count($envios)."</td>
            <td class='center'><a><img src='images/view_mail.png' title='Ver'></a></td>
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

function buzon_lista(){
    $reg=tc::edit('L');
    $nreg=count($reg);
    $estado=array("<img src='images/mail_new.png' title='No leido'>","<img src='images/mail_read.png' title='Leido'>");
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'&nbsp;,Fecha,Asunto,De',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr ".(($reg[$x]['tc_estado']==0)?"class='bold'":"").">
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['tc_id']."'/></td>
            <td align='center' width='20'>".$estado[$reg[$x]['tc_estado']]."</td>    
            <td>".$reg[$x]['tc_fecha']."</td>
            <td>".$reg[$x]['tc_asunto']."</td>
            <td>".$reg[$x]['tc_nombre']." (".$reg[$x]['tc_email'].")</td>
            <td class='center'><a href='index.php?menu=tc_form&a=U&id=".$reg[$x]['tc_id']."'><img title='Ver mensaje' src='images/view_mail.png'></a></td>
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

function canal_ddl($id=0){    
    if($reg=canal::canal_lista()){
        foreach($reg as &$r){
            $sel=($r['tec_web2_canal_id']==$id)?"SELECTED":"";
            $cad.="<option value='".$r['tec_web2_canal_id']."' ".$sel.">".$r['twc_nombre']."</option>";
        }
    }
    return $cad;
}


function producto_lista(){
    $reg=producto::lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,Nombre,Precio,Stock',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['ope_id']."'/></td>            
            <td >".$reg[$x]['producto_id']."</td>
	    <td >".$reg[$x]['prod_nombre']."</td>            
            <td >".$reg[$x]['prod_precio']."</td>
            <td >".$reg[$x]['prod_stock']."</td>                                    
            <td width='10' align='center'><a href='index.php?menu=producto_form&a=U&id=".$reg[$x]['producto_id']."' title='Editar'><img src='images/b_edit.png'></a></td>            
            </tr>";
        }    
        echo "</tbody></table>";
    }
}


function producto_adjuntos($tipo,$producto_id){
    
    switch($tipo){
        case 'IMG':
            $css="selectable";
            $dir=@opendir("productos/fotos/".$producto_id."/");            
            break;
        case 'DOC':
            $css="selectable_doc";
            $dir=@opendir("productos/documentos/".$producto_id."/");
            break;
    }
    
    if($dir){
    //echo $dir;
    //echo '<table border="1">';
    echo '<ol id="'.$css.'">';
    while ($file = readdir($dir)) {
        if($file == "." || $file == ".." || $file == "index.php" )	
            continue;
            $archivo=$_GET['dir']."/".$file;
            //echo "tam. ".size($archivo);
            //$info=pathinfo($archivo);
            //if(filetype($archivo)!='dir'){
                //echo '<tr><td align="center">'.$file.'</td><td>'.filesize($archivo).'</td></tr>';
                //echo '<div style="margin:5;float:left;padding:3px;height:60px;border:solid 1px gray">'.$file.'</div>';
                echo '<li class="ui-default" onclick="select(this)" ondblclick="getValor(\''.$archivo.'\');">'.$file.'</li>';
            //}

    }
    closedir($dir);
    //echo '</table>';
    echo '</ol>';
    }
    
}

function archivo_lista($tabla_id=0,$tabla_reg_id=0){
    $tipos=archivo::arc_tipo_ddl();
    $align="right";
    foreach($tipos as &$tipo){
        if($tabla_reg_id>0){
        $archivos=archivo::lista($tabla_id,$tabla_reg_id,$tipo['arc_tipo_id']);
        }
        $css="selectable";
              
        $align=($align=='left')?"right":"left"; 
        echo '<fieldset style="width:370px;float:'.$align.'">';
        echo '<legend>'.$tipo['arc_tipo_nombre'].'</legend>';
        //echo '<ol id="'.$css.'">';
        echo '<table class="list">';
        for($x=0;$x<count($archivos);$x++){
            switch($tipo['arc_tipo_id']){
                case 1: // Imagen
                    $src='images/iconos/image.png';
                    break;
                case 2: // Documento
                    $src='images/iconos/document.png';
                    break;
            }
            //echo '<li id="'.$archivos[$x]['archivo_id'].'" class="ui-default" onclick="select(this)">'.$file.'</li>';
            echo '<tr>
                    <td width="10"><a title="Ver '.$archivos[$x]['arc_nombre'].'" target="_blank" href="'.$archivos[$x]['arc_ruta'].'"><img src="'.$src.'"></a></td>
                    <td>'.$archivos[$x]['arc_descripcion'].'</td>
                    <td width="10"><a onclick="upload('.$tabla_id.','.$tabla_reg_id.')"><img src="images/b_edit.png"></a></td>
                    <td width="10"><a onclick="eliminar('.$archivos[$x]['archivo_id'].','.$tabla_id.','.$tabla_reg_id.');"><img src="images/b_drop.png"></a></td>
                  </tr>';
        }
        //echo '</ol>';
        echo '</table>';
        echo '</fieldset>';
        //}
        
    }
    
    
}

function arc_tipo_ddl($id=''){
    
    $reg=archivo::arc_tipo_ddl();    
    //$cad="<option value=''></option>";
    for($i=0;$i<count($reg);$i++){
        $sel=($reg[$i]['arc_tipo_id']==$id)?"SELECTED":"";        
        $cad.="<option value='".$reg[$i]['arc_tipo_id']."' ".$sel.">".$reg[$i]['arc_tipo_nombre']."</option>";
    }    
    return $cad;
}


/* comprobantes */
function cp_lista($tipo=''){
    $RegistrosAMostrar=variable('paginacion');
    if(isset($_GET['pag'])){
        $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
        $PagAct=$_GET['pag'];  //caso contrario los iniciamos
    }else{
        $RegistrosAEmpezar=0;
        $PagAct=1;
    }
    $limit=$RegistrosAEmpezar.','.$RegistrosAMostrar;
    $reg=cp::cp_lista("L",$tipo,$limit);
    $edit=($tipo=='1')?"cp_edit":"ventas_edit";
    echo '<table width="100%">';
    echo cabecera('Id,RUC,Proveedor,Nro.,Tipo,Fec Emisión,Fec. Venc.,Monto,Descripción', '2');
    if(is_array($reg)){
        $NroRegistros=$reg[0]['total'];
        $nreg=count($reg);
        for($i=0;$i<sizeof($reg);$i++){
            $prv=cliente::cliente_edit($reg[$i]['cliente_id'],'S');
            $item=cp_det::cp_det_lista($reg[$i]['cp_id']);
            $bgcolor=($bgcolor=='#FFFFFF')?'#F2F2F2':'#FFFFFF';
            $fe=(es_fecha($reg[$i]['cp_fec_emis']))?$reg[$i]['cp_fec_emis']:"";
            $fv=(es_fecha($reg[$i]['cp_fec_venc']))?$reg[$i]['cp_fec_venc']:"";
            $moneda=tabla::moneda_lista($reg[$i]['moneda_id']);
            $descrip=($reg[$i]['cp_descrip']>'')?$reg[$i]['cp_descrip']:$item[0]['pro_nombre'];
            echo "<tr ".efecto('#89B4BD',$bgcolor).">";
            editar_eliminar('3',$edit,$reg[$i]['cp_id']);
            echo "<td  align=center>".$reg[$i]['cp_id']."</td>
            <td >&nbsp;".$prv[0]['cli_ruc']."</td>
            <td >&nbsp;".$prv[0]['cli_nombre']."</td>
            <td >&nbsp;".$reg[$i]['cp_nro']."</td>
            <td >&nbsp;".$reg[$i]['cp_tipo_nombre']."</td>
            <td >&nbsp;".$fe."</td>
            <td >&nbsp;".$fv."</td>
            <td >&nbsp;".$moneda[0]['mon_sigla']." ".$reg[$i]['cp_monto_tot']."</td>
            <td >&nbsp;".$descrip."</td>
            <tr>";
        }
        echo "<tr><td colspan='12' align='center'>";
        paginando($NroRegistros,$RegistrosAMostrar,$PagAct,$nreg);
        echo "</td></tr>";
    }else{
        echo "<tr><td>&nbsp;</td></tr>";
    }
    echo '</table>';
}

function cp_tipo_ddl($id){
		$reg=cp_compras::cp_tipo_ddl();
		$nreg=count($reg);                
		for($i=0;$i<$nreg;$i++){
			$sel=($reg[$i]['cp_tipo_id']==$id)?'SELECTED':'';
			echo'<option value="'.$reg[$i]['cp_tipo_id'].'" '.$sel.'>'.$reg[$i]['cp_tipo_nombre'].'</option>';
		}
}

function cp_cliente_ddl($id){
		$reg=cp_compras::cp_cliente_ddl();
		$nreg=count($reg);
                echo '<option value="0"></option>';
		for($i=0;$i<$nreg;$i++){
			$sel=($reg[$i]['cp_tipo_id']==$id)?'SELECTED':'';
			echo'<option value="'.$reg[$i]['cliente_id'].'" '.$sel.'>'.$reg[$i]['cli_nombre'].'</option>';
		}
}

function cp_medio_ddl($id){
		$reg=cp::cp_medio_ddl();
		$nreg=count($reg);
                echo '<option value="0"></option>';
		for($i=0;$i<$nreg;$i++){
			$sel=($reg[$i]['cp_medio_id']==$id)?'SELECTED':'';
			echo'<option value="'.$reg[$i]['cp_medio_id'].'" '.$sel.'>'.$reg[$i]['cp_medio_nombre'].'</option>';
		}
}

function cp_pro_ddl($id){
		$reg=cp::cp_pro_ddl($id);
		$nreg=count($reg);
                echo '<option value="0"></option>';
		for($i=0;$i<$nreg;$i++){
			$sel=($reg[$i]['cp_medio_id']==$id)?'SELECTED':'';
			echo'<option value="'.$reg[$i]['cp_detalle_id'].'" '.$sel.'>'.$reg[$i]['pro_nombre'].'</option>';
		}
}

function centro_costo_ddl($id){
		$reg=cp::centro_costo_ddl();
		$nreg=count($reg);
                echo '<option value="0"></option>';
		for($i=0;$i<$nreg;$i++){
			$sel=($reg[$i]['centro_costo_id']==$id)?'SELECTED':'';
			echo'<option value="'.$reg[$i]['centro_costo_id'].'" '.$sel.'>'.$reg[$i]['cc_nombre'].'</option>';
		}
}

    function cp_estado_ddl($id=0){
                $id=($id==0)?1:$id;
		$reg=cp::cp_estado_ddl();
		$nreg=count($reg);
                echo '<option value="0"></option>';
		for($i=0;$i<$nreg;$i++){                        
			$sel=($reg[$i]['cp_estado_id']==$id)?'SELECTED':'';
			echo'<option value="'.$reg[$i]['cp_estado_id'].'" '.$sel.'>'.$reg[$i]['cp_estado_nombre'].'</option>';
		}
    }

    function cp_filtro_ddl($id){
        $filtro=array("","Nro","Tipo","Centro Costo","Proveedor");
        for($i=1;$i<count($filtro);$i++){
            $sel=($i==$id)?'SELECTED':'';
            echo '<option value="'.$i.'" '.$sel.'>'.$filtro[$i].'</option>';
        }
    }

function cp_det_lista($cp_id=0){
    $reg=cp_comp_det::lista($cp_id);
    
    if(is_array($reg)){
        echo "<table class='list'>";
        for($i=0;$i<sizeof($reg);$i++){                                                
            echo "<tr class='active'>";                        
            echo "<td width='5%'  align=center>".$reg[$i]['cp_compras_detalle_id']."</td>
            <td width='50%'>&nbsp;".$reg[$i]['pro_nombre']."</td>
            <td width='10%'>&nbsp;".$reg[$i]['pro_precio_compra']."</td>
            <td width='10%'>&nbsp;".$reg[$i]['pro_cantidad']."</td>
            <td width='15%'>&nbsp;".$reg[$i]['pro_nroserie']."</td>
            
            <td class='center'><button type='button' class='button icon trash' onclick=\"Detalle(".(int)$reg[$i]['cp_compras_detalle_id'].",'D');\">Eliminar</button></td>
            ";
        }
        echo "</table>";
    }
    
}

function cp_detalle($cp_id=0){
    $reg=cp_det::cp_det_lista($cp_id);
    echo '<table width="550" border="0" cellpading="0" cellspacing="0">';
    //echo cabecera('Producto,Descripcion,Cantidad,Precio,Total', '0');
        for($i=0;$i<5;$i++){

            $bgcolor=($bgcolor=='#F2F2F2')?'#FFFFFF':'#F2F2F2';
             echo "<tr>";
            if(is_array($reg)){
            $fe=(es_fecha($reg[$i]['cp_fec_emis']))?$reg[$i]['cp_fec_emis']:"";
            $fv=(es_fecha($reg[$i]['cp_fec_venc']))?$reg[$i]['cp_fec_venc']:"";
            $moneda=tabla::moneda_lista($reg[$i]['moneda_id']);           
            echo "
            <td align='center' witdh='80'>&nbsp;".$reg[$i]['pro_cantidad']."</td>
            <td  width='370'>&nbsp;".$reg[$i]['pro_descripcion']."</td>
            <td  width='50'>&nbsp;".$reg[$i]['pro_precio_compra']."</td>
            <td  width='50'>&nbsp;".$reg[$i]['pro_subtotal']."</td>
            <tr>";
            }else{
                echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
            }
        }
    
    echo '</table>';
}

function mes_ddl($id=0){
	$reg=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
	$nreg=count($reg);
	$cad="<option value=''></option>";
        $mes=($id>=0)?$id:(int)date("n");
	for($x=1;$x<$nreg;$x++){
		$sel=($x==$mes)?'SELECTED':'';
		$cad.="<option value='".$x."' ".$sel.">".$reg[$x]."</option>";
	}
	return $cad;
}

function cp_compras_lista($id='',$qry=''){
        
	$reg=cp_compras::cp_lista('L',2,$limit);
        
        if(is_array($reg)){
        $str="<table class='list'>".cabecera(false,'Id,NRO.,Fecha,Cliente,Descripción,Moneda,Importe,Estado',1);
        $str.="<tbody>";
            foreach ($reg as $value){
                
                $str.="<tr>                                
                <td  align=center>".$value['cp_compras_id']."</td>
                <td >&nbsp;<span class='nombre'>".$value['cp_nro']."</span>&nbsp;</td>
                <td >&nbsp;".substr($value['cp_fec_emis'],0,10)."&nbsp;</td>
                <td >&nbsp;".$value['cli_nombre']."</td>
                <td width='20%'>&nbsp;</td>
                <td align='center'>&nbsp;".$value['mon_nombre']."</td>
                <td align='right'>&nbsp;".$value['cp_monto_tot']."</td>
                <td>&nbsp;".$value['cp_estado_nombre']."</td>
                <td align='center'><a title='Editar' class='button icon edit' href='index.php?menu_id=39&menu=comprobante_edit&id=".$value['cp_compras_id']."'></a></td>
                </tr>";
            }    
        $str.="</tbody></table>";
        }
        return $str;
}

function moneda_ddl($id){
    	$reg=cp_compras::moneda_lista();
        //$str="<option value=''></option>";
    	for($x=0;$x<count($reg);$x++){
    		$sel=($reg[$x]['moneda_id']==$id)?'SELECTED':'';
    		$str.="<option value='".$reg[$x]['moneda_id']."' $sel>".$reg[$x]['mon_sigla']."</option>";
    	}
        return $str;
}

function ocs_ddl($id=0){   
    $reg=ocs::ocs_ddl();
    $nreg=count($reg);
    echo '<option value="0"></option>';
    for ($i=0;$i<$nreg;$i++){
        $cliente=cliente::cliente_edit($reg[$i]['cliente_id'],'S');
        $sel=($reg[$i]['ocs_id']==$id)?'selected':'';
        echo '<option value="'.$reg[$i]['ocs_id'].'" '.$sel.'>'.$reg[$i]['ocs_nro'].' - '.substr($reg[$i]['ocs_fec_emis'],0,10).' - '.$cliente[0]['cli_nombre'].'</option>';
    }
}


function mantenimiento_lista($menu=0){
    $reg=tabla::tbl_lista(1,$menu);
    $grupo=0;
    echo '<table class="list"><thead>
<tr><td align="center" ><b>Tablas</b></td>
</tr></thead><tbody>';
    if(is_array($reg)){
        for($i=0;$i<sizeof($reg);$i++){
           
//            if($reg[$i]['menu_id']==1){
//            //if($reg[$i]['menu_id']==1){
//                echo '';
//            }else{
            
            if($grupo<>$reg[$i]['menu_id'] && $reg[$i]['menu_id']>0){
                $grupo=$reg[$i]['menu_id'];
                $grupo_nombre=$reg[$i]['grupo'];
                echo '<tr><td class="titulo">'.$grupo_nombre.'</td></tr>';
            }
            echo '<tr><td>&nbsp;<a href="index.php?menu=mantenimiento_list&tabla_id='.$reg[$i]['tabla_id'].'&tbl_menu='.(int)$menu.'">'.$reg[$i]['tbl_alias'].'</a></td></tr>';
            
        //}
        
        }
    }
    echo '</tbody></table>';
}

function tbl_col_prop_ddl($id=''){
    $reg=array('tabla_col_nombre'=>'Nombre',
                'tabla_col_rotulo'=>'Rotulo',
                'tabla_col_desc'=>'Descripción',
                'tabla_grupo_id'=>'Grupo',
                'tabla_col_panel_pos'=>'Lado panel',
                'tabla_col_ancho'=>'Ancho',
                //''=>'Alto',
                'ctr_max_length'=>'Caract. max.',
                'tbl_col_valor_ini'=>'Valor inicial',
                'col_control'=>'Control',
                'tabla_col_orden'=>'Orden',
                'tabla_col_obligatorio'=>'Obligatorio',
                'tabla_col_virtual'=>'Virtual',
                'ctr_orden_sp'=>'Orden SP',
                'lst_ancho'=>'Ancho(lista)',
                'tbl_col_orden_lst'=>'Orden(lista)',
                'lst_align'=>'Alineación',
                'fuente_tbl'=>'Fuente',
                'tbl_col_dependencia'=>'Dependencia',
                'lst_formula'=>'Formula');
    asort($reg);
    $cad="<option value=''></option>";
    foreach ($reg as $key => $value){
        $sel=($key==$id)?"SELECTED":"";
        $cad.="<option value='".$key."' ".$sel.">".$value."</option>";
    }
    return $cad;
}


function tbl_col_prop_lista($tabla_id=0,$campo=''){
    $reg=tabla::tbl_col($tabla_id);           
    if(is_array($reg)){
        echo '<table width="100%" class="list">';
        echo '<thead><tr><td>Rotulo</td><td>Nombre</td><td>Tipo</td><td></td></tr></thead>';
        foreach ($reg as $value) {
            echo '<tr>
                  <td>'.$value['tabla_col_rotulo'].'</td>
                  <td>'.$value['tabla_col_nombre'].'</td>
                  <td>'.$value['col_control'].'</td>
                  <td>'.tbl_col_prop_cotrol($tabla_id,$value['tabla_col_nombre'].'_'.$value['tabla_col_id'],$campo,$value[$campo]).'</td>
                  </tr>';
        }
        echo '</table>';
    }
}

function tbl_col_prop_cotrol($tabla=0,$nombre='',$campo='',$valor=''){
     switch($campo){
        case 'tabla_col_panel_pos':
            $str='<select name="'.$nombre.'_'.$campo.'">';
            $str.=tbl_col_panel_ddl($valor);
            $str.='</select>';
            break;
        case 'lst_align':
            $str='<select name="'.$nombre.'_'.$campo.'">';
            $str.=tbl_col_align_ddl($valor);
            $str.='</select>';            
            break;
        case 'col_control':
            $str='<select name="'.$nombre.'_'.$campo.'">';
            $str.=tbl_col_tipo_ddl($valor);
            $str.='</select>';
            break;
        case 'tabla_grupo_id':
            $str='<select name="'.$nombre.'_'.$campo.'">';
            $str.=tbl_grupo_ddl($tabla,$valor);
            $str.='</select>';
            break;
        default:
            $str='<input type="text" name="'.$nombre.'_'.$campo.'" value="'.$valor.'">';
            break;
    }
    return $str;
}


function tbl_col_propiedad_edit($tabla_id=0,$campo=''){
    $reg=tabla::tbl_col($tabla_id);           
    if(is_array($reg)){       
        foreach ($reg as $value) {
            tabla_col::edit_prop($value['tabla_col_id'],$campo,$_REQUEST[$value['tabla_col_nombre'].'_'.$value['tabla_col_id'].'_'.$campo]);
        }        
    }
}


function erp_notificacion($codigo='',$mensaje_opcional=''){
    $css=array(1=>'success',2=>'warning',3=>'attention');
    if($mensaje_opcional>''){
        $reg=explode(':',$mensaje_opcional);
        $tipo=$reg[0];
        $texto=$reg[1];
    }else{
        $reg=notificacion::msj_erp($codigo);
        $tipo=$reg['msj_erp_tipo_id'];
        $texto=$reg['msj_erp_descrip'];
    }        
    if($texto>''){
        return '<div id="notificacion" class="'.$css[$tipo].'">'.$texto.'</div>'; 
    }
    
}

function ExportarPDF($tipo=0,$html='',$ruta='',$nombre='',$orientacion=''){
$pdf = new MiPDF($orientacion, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->empresa_id=$_SESSION['SIS'][5];
$pdf->header=1;
$pdf->footer=0;
// set document information
$pdf->SetCreator("");
$pdf->SetAuthor("");
$pdf->SetTitle("");
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$imagen="logo_empresa".$_SESSION['SIS'][5].".png";

//PDF_HEADER_LOGO
$titulo="";
$direccion="";
//$pdf->SetHeaderData($imagen, PDF_HEADER_LOGO_WIDTH,$titulo,$direccion);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

$pdf->writeHTML($html, true, false, false, false, '');
$file_salida=$ruta.$nombre;
switch($tipo){
    case 1:
        $pdf->Output($file_salida, 'F');
        return $file_salida;
        break;
    case 2:
        //@unlink($file_salida);
        $pdf->Output($file_salida, 'I');
        break;
}

}

function ComprobantePDF($id=0,$tipo=0){
$pdf = new MiPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->header=0;
$pdf->footer=0;
// set document information
$pdf->SetCreator("");
$pdf->SetAuthor("");
$pdf->SetTitle("");
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

$reg=cp_compras::cp_edit($id,'S');

$items=cp_comp_det::lista($id);




$pdf->Cell(0, 0,$reg['cp_nro'], 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Ln();
$pdf->Cell(0, 0,$reg['cliente'], 1, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->SetY(-100);
foreach ($items as $item) {
    $c+=1;
    $pdf->Cell(5, 0,$c, 1, false, 'L', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(150,0,$item['producto'], 1, false, 'L', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(20,0,$item['pro_cantidad'], 1, false, 'L', 0, '', 0, false, 'T', 'M');
    $pdf->Cell(30,0,$item['pro_precio_compra'], 1, false, 'L', 0, '', 0, false, 'T', 'M');
    $pdf->Ln();
}

//$js = 'print(true);';
// set javascript
//$pdf->IncludeJS($js); 
 

$file_salida="comprobantes/".$reg['cp_nro'].".pdf";
switch($tipo){
    case 1:
        $pdf->Output($file_salida, 'F');
        return $file_salida;
        break;
    case 2:
        //@unlink($file_salida);
        $pdf->Output($file_salida, 'I');
        break;
}
}

function ExportarPDF2($tipo=0,$html='',$ruta='',$nombre='',$orientacion=''){
//ob_clean();

$pdf = new MiPDF($orientacion, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->empresa_id=$_SESSION['SIS'][5];
$pdf->header=1;
$pdf->footer=1;
// set document information
$pdf->SetCreator("");
$pdf->SetAuthor("");
$pdf->SetTitle("");
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$imagen="logo_empresa".$_SESSION['SIS'][5].".png";

//PDF_HEADER_LOGO
$titulo="";
$direccion="";
//$pdf->SetHeaderData($imagen, PDF_HEADER_LOGO_WIDTH,$titulo,$direccion);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

$pdf->writeHTML($html, true, false, false, false, '');
$file_salida=$ruta.$nombre;
switch($tipo){
    case 1:
        $pdf->Output($file_salida, 'F');
        return $file_salida;
        break;
    case 2:
        //@unlink($file_salida);
        $pdf->Output($file_salida, 'I');
        break;
}

}

function CotizacionSalida($id=0,$empresa_id=0){
    $reg=cotizacion::edit("S",$id);
    $c=0;    
    $str.='<html>
          <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <style>
          .list {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-bottom: 5px;
}
.list td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.list thead td {
	background-color: #EFEFEF;
	padding: 2px 5px;
}
.list thead td a, .list thead td {
	text-decoration: none;
	color: #222222;
	font-weight: bold;
}
.list tbody td a {
	text-decoration: underline;
}
          </style>
          </head>
          <body>';  
    $str.='<table width="100%">
          <tr><td bgcolor="#CCCCCC" colspan="5" align="center">COTIZACION Nro '.$reg['cot_nro'].'</td></tr>
          <tr><td width="20%">RAZON SOCIAL </td><td width="3%">:</td><td width="35%">'.$reg['cliente'].'</td><td align="right" width="15%">Referencia:</td><td align="center">'.$reg['cot_referencia'].'&nbsp;</td></tr>
          <tr><td>ATENCION </td><td >:</td><td colspan="3">'.$reg['contact_nombre'].'</td></tr>
          <tr><td>PROYECTO </td><td >:</td><td>'.$reg['proy_nombre'].'&nbsp;</td><td align="right">Fecha:</td><td align="center">'.date("d/m/Y").'</td></tr>
          </table><br>';
    
    $str.='<table width="100%" border="1" cellpadding="3">
            <tr bgcolor="#CCCCCC">
                <td width="6%" align="center">ITEM</td>
                <td width="50%" align="center">DESCRIPCION</td>               
                            
                <td align="center" width="10%">CANT.</td>
                <td align="center" width="6%">MON.</td>
                <td align="center" width="14%">UNIT.</td>
                <td align="center" width="14%">TOTAL</td>
            </tr>';
     $items=cotizacion::edit("D",$reg['cotizacion_id']);
     $search=array("<",">");
     $replace=array("","");
     foreach($items as $item){
        $c++;
        $str.='<tr>
                <td align="center">'.$c.'</td>
                <td>
                <table width="100%">
                    <tr><td colspan="2"><b>'.$item['prod_nombre'].'</b></td></tr>';
        $prop=producto::prod_propiedad($item['producto_id']);
        
        $propiedad='';

        foreach ($prop->rows as $value){
            if($value['prod_propiedad_valor']>''){
                
                $propiedad_valor=str_replace($search,$replace,$value['prod_propiedad_valor']);;
                $propiedad.='<tr><td width="50%">'.$value['prod_clasif_propiedad_nombre'].'</td><td width="50%">'.$propiedad_valor.'&nbsp;'.$value['prod_clasif_propiedad_umed'].'</td></tr>';
            }
        }             
        $propiedad=($propiedad>'')?'<table class="list">'.$propiedad.'</table>':'';
         
         $str.='<tr><td colspan="2">'.$propiedad.'</td></tr>';
         $descripcion=str_replace('<','',$item['pro_descripcion']);
         $precio=round($item['pro_precio_venta']);
         $total=$precio*$item['pro_cantidad'];
         $descto='';
         if($item['pro_descuento']>0){
             $descto=number_format(($total*($item['pro_descuento']/100)),2,'.',',');
             $descto='<tr><td colspan="2">Descto. ('.$item['pro_descuento'].'%): '.$descto.'</td></tr>';
             $descto.='<tr><td colspan="2"><hr></td></tr>';
         }
         $str.='<tr><td colspan="2">'.str_replace("\n","<br>", $descripcion).'</td></tr>
                    <tr><td colspan="2"><hr></td></tr>
                    '.$descto.'
                    <tr><td width="25%">Marca:</td><td width="75%">'.$item['marca_nombre'].'</td></tr>
                    <tr><td>Modelo:</td><td>'.$item['modelo_nombre'].'</td></tr>                    
                </table>                
                </td>                
                <td align="right">'.$item['pro_cantidad'].'</td>
                <td align="center">'.$item['moneda'].'</td>
                <td align="right">'.number_format($precio,2,'.',',').'</td>
                <td align="right">'.number_format($total,2,'.',',').'</td>
            </tr>';
     }
            
     $str.='</table><br>';     
     $str.='<table width="100%">
            <tr>
                <td colspan="3"><u>CONDICIONES COMERCIALES</u>:<br></td>
            </tr>
            
            <tr><td width="20%">Precios</td><td width="5%">:</td><td width="75%">'.nl2br($reg['cot_cond_precios']).'&nbsp;</td></tr>
            <tr><td>Plazo de Entrega</td><td>:</td><td>'.nl2br($reg['cot_cond_plazo_ent']).'&nbsp;</td></tr>
            <tr><td>Lugar de Entrega</td><td>:</td><td>'.nl2br($reg['cot_cond_lugar_ent']).'&nbsp;</td></tr>
            <tr><td>Forma de Pago</td><td >:</td><td>'.nl2br($reg['cot_cond_forma_pago']).'&nbsp;</td></tr>
            <tr><td>Garantía</td><td >:</td><td>'.nl2br($reg['cot_cond_garantia']).'&nbsp;</td></tr>
            <tr><td>Validez</td><td>:</td><td>'.nl2br($reg['cot_cond_validez']).'&nbsp;</td></tr>
            </table></body></html>';
          
     
     $valor=array('html'=>$str,'codigo'=>$reg['cot_nro']);
     
     return $valor;
             
}

function ProformaSalida($proforma_id=0,$empresa_id=0){
    $reg=imp_proforma::edit('S',$proforma_id);
    $search=array("<",">");
    $replace=array("","");
    if($reg['pais_id']==2192){ // Peru
        $lbl_fecha='Fecha';
        $lbl_titulo='SOLICITUD DE COTIZACION';
        $lbl_prov='Proveedor';
        $lbl_cont='Contacto';
        $lbl_cli='Cliente';
        $lbl_proy='Proyecto';
        $lbl_ref='Referencia';
        $lbl_id='Id';
        $lbl_prod_nombre='Descripción';
        $lbl_cantidad='Cantidad';
        $prod='producto_nombre';
        $prop_campo='prod_clasif_propiedad_nombre';
    }else{
        $lbl_fecha='Date';
        $lbl_titulo='REQUEST FOR QUOTE';
        $lbl_prov='Manufacturer';
        $lbl_cont='Contact';
        $lbl_cli='Client';
        $lbl_proy='Project';
        $lbl_ref='Our Reference';
        $lbl_id='Item';
        $lbl_prod_nombre='Product description';
        $lbl_cantidad='Quantity';
        $prod='producto_alias';
        $prop_campo='prod_clasif_propiedad_alias';
    }
    
    
     $items=imp_proforma::edit("D",$reg['imp_proforma_id']);
     $detalle='<table border="1" cellpadding="2">';
     $detalle.='<tr>
                    <td width="10%" align="center"><b>'.$lbl_id.'</b></td>
                    <td width="10%" align="center"><b>'.$lbl_cantidad.'</b></td>
                    <td width="80%" align="center"><b>'.$lbl_prod_nombre.'</b></td>
                </tr>';
     $c=0;
     foreach($items as &$item){
         $c++;
         $prop=producto::prod_propiedad($item['producto_id']);
         
         $propiedad='';
         foreach ($prop->rows as $value){                
            if($value['prod_propiedad_valor']>''){                    
                $propiedad_valor=str_replace($search,$replace,$value['prod_propiedad_valor']);;
                $propiedad.='<tr><td width="30%">'.$value[$prop_campo].'</td><td width="70%">'.$propiedad_valor.'&nbsp;'.$value['prod_clasif_propiedad_umed'].'</td></tr>';
            }
         }
         $propiedad=($propiedad>'')?'<table class="list">'.$propiedad.'</table>':'';
         $descripcion=($item['prod_descrip']>'')?'<br>'.nl2br($item['prod_descrip']):'';
         $detalle.='<tr>
                <td align="center">'.$c.'</td>
                <td align="center">&nbsp;'.$item['prod_cantidad'].'</td>
                <td>&nbsp;<b>'.$item[$prod].'</b>'.$descripcion.'<br>'.$propiedad.'</td>
                </tr>';
     }
     $detalle.='</table>';
    
      

    $condiciones.=($reg['imp_cond_precios']>'')?'<tr><td width="20%">Precios</td><td width="5%">:</td><td width="75%">'.nl2br($reg['imp_cond_precios']).'</td></tr>':'';
    $condiciones.=($reg['imp_cond_plazo_ent']>'')?'<tr><td>Plazo Entrega</td><td>:</td><td>'.nl2br($reg['imp_cond_plazo_ent']).'</td></tr>':'';
    $condiciones.=($reg['imp_cond_lugar_ent']>'')?'<tr><td>Lugar Entrega</td><td>:</td><td>'.nl2br($reg['imp_cond_lugar_ent']).'</td></tr>':'';
    $condiciones.=($reg['imp_cond_forma_pago']>'')?'<tr><td>Forma Pago</td><td>:</td><td>'.nl2br($reg['imp_cond_forma_pago']).'</td></tr>':'';
    $condiciones.=($reg['imp_cond_garantia']>'')?'<tr><td>Garantia</td><td>:</td><td>'.nl2br($reg['imp_cond_garantia']).'</td></tr>':'';
    $condiciones.=($reg['imp_cond_validez']>'')?'<tr><td>Validez</td><td>:</td><td>'.nl2br($reg['imp_cond_validez']).'</td></tr>':'';
    $condiciones.=($reg['imp_cond_penalidad']>'')?'<tr><td>Penalidad</td><td>:</td><td>'.nl2br($reg['imp_cond_penalidad']).'</td></tr>':'';
    $condiciones.=($reg['imp_cond_carta_fianza']>'')?'<tr><td>Canta Fianza</td><td>:</td><td>'.nl2br($reg['imp_cond_carta_fianza']).'</td></tr>':'';
    $condiciones=($condiciones>'')?'<table width="100%" border="0">'.$condiciones.'</table>':'';

    $search=array('[TITULO]','[FECHA]','[NRO]','[PROVEEDOR]','[CONTACTO]','[CLIENTE]','[PROYECTO]','[REFERENCIA]',
                  '[LBL_FECHA]','[LBL_PROVEEDOR]','[LBL_CONTACTO]','[LBL_CLIENTE]','[LBL_PROYECTO]','[LBL_REFERENCIA]',
                  '[DETALLE]','[CONDICIONES]');
    $replace=array($lbl_titulo,$reg['fecha'],$reg['imp_prof_nro'],$reg['proveedor'],$reg['prov_contacto'],$reg['cliente'],$reg['proyecto'],$reg['cot_nro'],
                   $lbl_fecha,$lbl_prov,$lbl_cont,$lbl_cli,$lbl_proy,$lbl_ref,
                   $detalle,$condiciones);
    $str=file_get_contents('plantillas/pro_formato.html');
    $str=str_replace($search,$replace,$str);
        
    
     $valor=array('html'=>$str,'codigo'=>$reg['imp_prof_nro']);
     
     return $valor;
}
/* Orden Compra cliente */
function OCLSalida($oc_id=0,$empresa_id=0){
    $reg=oc::edit('S',$oc_id);   
    $search=array("<",">");
    $replace=array("","");
    $lbl_id='Id';
    $lbl_prod_nombre='Descripción';
    $lbl_cantidad='Cantidad';
    $lbl_precio='Precio';
    $lbl_st='Sub Total';    
    
    
    $items=oc::edit("D",$reg['oc_id']);
    $detalle='<table class="list" >';
    $detalle.='<thead>
            <tr>
            <td width="10%" align="center">'.$lbl_id.'</td>
            <td width="50%" align="center">'.$lbl_prod_nombre.'</td>
            <td width="10%" align="center">'.$lbl_cantidad.'</td>
            <td width="15%" align="center">'.$lbl_precio.'</td>
            <td width="15%" align="center">'.$lbl_st.'</td>
            </tr></thead><tbody>';
    $c=0;
    $sub=0;
    $total=0;
    foreach($items as $item){
        $c++;
        $sub=round($item['pro_cantidad']*$item['pro_precio_compra'],2);
        $total+=$sub;
        $detalle.='<tr>
                <td align="center">'.$c.'</td>
                <td>'.$item['producto'].'<br>'.$item['pro_descripcion'].'</td>
                <td align="center">&nbsp;'.$item['pro_cantidad'].'</td>
                <td align="right">'.$item['pro_precio_compra'].'&nbsp;</td>
                <td align="right">'.($sub).'&nbsp;</td>
                </tr>';
     }
     $detalle.='<tr><td colspan="4" align="right">Total US$ </td><td align="right">'.$total.'</td></tr>';
     $detalle.='</tbody></table>';
     
     $condiciones='<table><tbody><tr><td colspan="2"><b>&nbsp;Indicaciones:</b></td></tr>';
     $condiciones.=($reg['oc_cond_precios']>'')?'<tr><td width="25%">&nbsp;Precios</td><td width="7%">'.$reg['oc_cond_precios'].'</td></tr>':'';
     $condiciones.=($reg['oc_cond_plazo_ent']>'')?'<tr><td>&nbsp;Plazo Entrega</td><td>'.$reg['oc_cond_plazo_ent'].'</td></tr>':'';
     $condiciones.=($reg['oc_cond_lugar_ent']>'')?'<tr><td>&nbsp;Lugar Entrega</td><td>'.$reg['oc_cond_lugar_ent'].'</td></tr>':'';
     $condiciones.=($reg['oc_cond_forma_pago']>'')?'<tr><td>&nbsp;Forma Pago</td><td>'.$reg['oc_cond_forma_pago'].'</td></tr>':'';
     $condiciones.=($reg['oc_cond_garantia']>'')?'<tr><td>&nbsp;Garantia</td><td>'.$reg['oc_cond_garantia'].'</td></tr>':'';
     $condiciones.=($reg['oc_cond_validez']>'')?'<tr><td>&nbsp;Validez</td><td>'.$reg['oc_cond_validez'].'</td></tr>':'';
     $condiciones.=($reg['oc_cond_penalidad']>'')?'<tr><td>&nbsp;Penalidad</td><td>'.$reg['oc_cond_penalidad'].'</td></tr>':'';
     $condiciones.=($reg['oc_cond_carta_fianza']>'')?'<tr><td>&nbsp;Canta Fianza</td><td>'.$reg['oc_cond_carta_fianza'].'</td></tr>':'';
     $condiciones.='</tbody></table>';  
    
    $search=array('[NRO]','[PROVEEDOR]','[EMPRESA]','[PROYECTO]','[REFERENCIA]','[FECHA]','[DETALLE]','[CONDICIONES]');
    $replace=array($reg['oc_nro'],$reg['cliente'],$reg['empresa'],$reg['proyecto'],'',$reg['fecha'],$detalle,$condiciones);
    $str=file_get_contents('plantillas/ocl_formato.html');
    $str=str_replace($search,$replace,$str);

    
     $valor=array('html'=>$str,'codigo'=>$reg['oc_nro']); 
     
     return $valor;
}

function OCSalida($compras_id=0,$empresa_id=0){
    $reg=compras::edit('S',$compras_id);
    $search=array("<",">");
    $replace=array("","");
    if($reg['pais_id']==2192){ // Peru
        $lbl_fecha='FECHA';
        $lbl_titulo='ORDEN DE COMRRA';
        $lbl_prov='PROVEEDOR';
        $lbl_cont='CONTACTO';
        $lbl_ref='Referencia';
        $lbl_id='Id';
        $lbl_prod_nombre='Descripción';
        $lbl_cantidad='Cantidad';
        $lbl_precio='Precio';
        $lbl_st='Sub Total';
        $lbl_operador='Responsable';
        
        $c_precios='Precios';
        $c_plazo='Plazo Entrega';
        $c_lugar='Lugar Entrega';
        $c_pago='Forma Pago';
        $c_garantia='Garantia';
        $c_validez='Validez';
        $c_penalidad='Penalidad';
        $c_carta='Carta Fianza';
        $prod='producto_nombre';
        $prop_campo='prod_clasif_propiedad_nombre';
    }else{
        $lbl_fecha='DATE';
        $lbl_titulo='PURCHASE ORDER';
        $lbl_prov='MANUFACTURER';
        $lbl_cont='CONTACTO';
        $lbl_ref='Reference number';
        $lbl_id='Item';
        $lbl_prod_nombre='Description';
        $lbl_cantidad='Quantity';
        $lbl_precio='Price';
        $lbl_st='Sub Total';
        $lbl_operador='RESPONSIBLE';
        
        $c_precios='Incoterms';
        $c_plazo='Delivery time';
        $c_lugar='Payment';
        $c_pago='Transport via';
        $c_garantia='Freight cost';
        $c_validez='Insurance cost';
        $c_penalidad='';
        $c_carta='';
        $prod='producto_alias';
        $prop_campo='prod_clasif_propiedad_alias';
    }
    
    $proveedor=$reg['proveedor'].'<br><font size="8">'.$reg['prov_direccion'].'<br>Tel.: '.$reg['prov_telef'].'<br>Fax:'.$reg['prov_fax'].'</font>';
    $invoice=$reg['invoice'].'<br><font size="8">'.$reg['inv_direccion'].'<br>Tel.: '.$reg['inv_telef'].'<br>Fax:'.$reg['inv_fax'].'</font>';
    
    $items=compras::edit("D",$reg['compras_id']);
    $detalle='<table border="1" cellpadding="3">';
    $detalle.='<thead>
            <tr bgcolor="#CCCCCC">
            <td width="10%" align="center">'.$lbl_id.'</td>
            <td width="50%" align="center">'.$lbl_prod_nombre.'</td>
            <td width="10%" align="center">'.$lbl_cantidad.'</td>
            <td width="15%" align="center">'.$lbl_precio.'</td>
            <td width="15%" align="center">'.$lbl_st.'</td>
            </tr></thead><tbody>';
    $c=0;
    $sub=0;
    $total=0;
    foreach($items as $item){
        $c++;
        $prop=producto::prod_propiedad($item['producto_id']);    
             $propiedad='';
            
             foreach ($prop->rows as $value){
                
                if($value['prod_propiedad_valor']>''){
                    $propiedad_valor=str_replace($search,$replace,$value['prod_propiedad_valor']);;
                    $propiedad.='<tr><td>'.$value[$prop_campo].'</td><td>'.$propiedad_valor.'&nbsp;'.$value['prod_clasif_propiedad_umed'].'</td></tr>';                    
                }
             }
             $propiedad=($propiedad>'')?'<br><table class="list">'.$propiedad.'</table>':'';
            
        $sub=round($item['prod_cantidad']*$item['prod_precio_venta'],2);
        $total+=$sub;
        $moneda=$item['moneda'];
        $detalle.='<tr>
                <td align="center">'.$c.'</td>
                <td><b>'.$item[$prod].'</b>
                    <br>'.$item['prod_descripcion'].'
                    '.$propiedad.'
                </td>
                <td align="center">&nbsp;'.$item['prod_cantidad'].'</td>
                <td align="right">'.$item['prod_precio_venta'].'&nbsp;</td>
                <td align="right">'.($sub).'&nbsp;</td>
                </tr>';
     }
     $detalle.='<tr><td colspan="4" align="right">Total '.$moneda.' </td><td align="right">'.$total.'</td></tr>';
     $detalle.='</tbody></table>';
     //$condiciones='<table width="100%" border="0">';
     $condiciones.=($reg['comp_cond_precios']>'')?'<tr><td width="20%">'.$c_precios.'</td><td>'.$reg['comp_cond_precios'].'</td></tr>':'';
     $condiciones.=($reg['comp_cond_plazo_ent']>'')?'<tr><td width="20%">'.$c_plazo.'</td><td>'.$reg['comp_cond_plazo_ent'].'</td></tr>':'';
     $condiciones.=($reg['comp_cond_lugar_ent']>'')?'<tr><td width="20%">'.$c_lugar.'</td><td>'.$reg['comp_cond_lugar_ent'].'</td></tr>':'';
     $condiciones.=($reg['comp_cond_forma_pago']>'')?'<tr><td width="20%">'.$c_pago.'</td><td>'.$reg['comp_cond_forma_pago'].'</td></tr>':'';
     $condiciones.=($reg['comp_cond_garantia']>'')?'<tr><td width="20%">'.$c_garantia.'</td><td>'.$reg['comp_cond_garantia'].'</td></tr>':'';
     $condiciones.=($reg['comp_cond_validez']>'')?'<tr><td width="20%">'.$c_validez.'</td><td>'.$reg['comp_cond_validez'].'</td></tr>':'';
     $condiciones.=($reg['comp_cond_penalidad']>'')?'<tr><td width="20%">'.$c_penalidad.'</td><td>'.$reg['comp_cond_penalidad'].'</td></tr>':'';
     $condiciones.=($reg['comp_cond_carta_fianza']>'')?'<tr><td width="20%">'.$c_carta.'</td><td>'.$reg['comp_cond_carta_fianza'].'</td></tr>':'';
     
     $condiciones=($condiciones>'')?'<table width="100%" border="0">'.$condiciones.'</table>':'';
     //$condiciones.='</table>';
    $marks=str_replace(chr(13),'<br>',$reg['comp_marks']);
    $search=array('[SUPP]','[MARKS]','[INVOICE]','[DELIVERY]','[EMPRESA]','[NRO]','[TITULO]','[PROVEEDOR]','[CLIENTE]','[CONTACTO]','[PROYECTO]','[OPERADOR]','[FECHA]','[DETALLE]','[CONDICIONES]','[FIRMA]','[REFERENCIA]',
                  '[LBL_PROVEEDOR]','[LBL_CLIENTE]','[LBL_CONTACTO]','[LBL_PROYECTO]','[LBL_OPERADOR]','[LBL_FECHA]','[LBL_FIRMA]','[LBL_REFERENCIA]');
    $replace=array($reg['proveedor'],$marks,$invoice,$reg['delivery'],$reg['empresa'],$reg['comp_nro'],$lbl_titulo,$proveedor,'[CLIENTE]',$reg['prov_contacto'],$reg['proyecto'],$reg['responsable'],$reg['fecha'],$detalle,$condiciones,'[FIRMA]',$reg['oc_nro'],
                   $lbl_prov,'[LBL_CLIENTE]',$lbl_cont,'[LBL_PROYECTO]',$lbl_operador,$lbl_fecha,'[LBL_FIRMA]',$lbl_ref);
    $str=file_get_contents('plantillas/oc_formato.html');
    $str=str_replace($search,$replace,$str);

    
     $valor=array('html'=>$str,'codigo'=>$reg['comp_nro']);
     
     return $valor;
}


function contacto_ddl($contacto_id=0,$cliente_id=0){
    $reg=contacto::lista();
    for($x=0;$x<count($reg);$x++){
        $sel=($reg[$x]['contacto_id']==$contacto_id)?'SELECTED':'';
    	$str.="<option value='".$reg[$x]['contacto_id']."' $sel>".$reg[$x]['pers_completo']." - ".$reg[$x]['cont_email']."</option>";
    }
    return $str;
}

function cotizacion_ddl(){
    $reg=cotizacion::lista($_SESSION['SIS'][5],$_SESSION['SIS'][2]);
    foreach ($reg as $value) {
        //$sel=($reg[$x]['contacto_id']==$contacto_id)?'SELECTED':'';
        if($value['cot_nro']>''){
            $str.='<option value="'.$value['cotizacion_id'].'" >'.$value['cot_nro'].' - '.$value['cliente'].'</option>';
        }
    }
    return $str;
}

function proforma_ddl(){
    $reg=importacion::proforma_lista();
    foreach ($reg as $value) {
        //$sel=($reg[$x]['contacto_id']==$contacto_id)?'SELECTED':'';
        if($value['imp_prof_nro']>''){
            $str.='<option value="'.$value['imp_proforma_id'].'" >'.$value['imp_prof_nro'].'</option>';
        }
    }
    return $str;
}


function prod_clasif_ddl(){
    $reg=producto::prod_clasificacion();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $str.='<option value="'.$value['prod_clasificacion_id'].'" >'.$value['prod_clasif_nombre'].'</option>';
    }
    return $str;
}

function prod_subclasif_ddl($id){
    $reg=producto::prod_subclasif($id);
    
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $str.='<option value="'.$value['prod_subclasif_id'].'" >'.$value['prod_subclasif_alias'].'</option>';
    }
    return $str;
}

function prod_clasifpropiedad_ddl($id){
    $reg=producto::prod_clasifpropiedad($id);    
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $str.='<option value="'.$value['prod_clasifpropiedad_id'].'" >'.$value['prod_clasif_propiedad_nombre'].'</option>';
    }
    return $str;
}

function prod_categoria_ddl($id){
    $reg=producto::prod_clasifpropiedad($id);
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $str.='<option value="'.$value['prod_clasifpropiedad_id'].'" >'.$value['prod_clasif_propiedad_nombre'].'</option>';
    }
    return $str;
}


function tipo_costo_ddl($id=0){
    $reg=imp_proforma::imp_tipo_costo_ddl();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['imp_tipo_costo_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['imp_tipo_costo_id'].'" '.$sel.'>'.$value['imp_tc_nombre'].'</option>';
    }
    return $str;
}

function trabajador_ddl($id=0){
    $reg=empresa::trabajador_lista($_SESSION['SIS'][5]);    
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['trabajador_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['trabajador_id'].'" '.$sel.'>'.$value['pers_completo'].'</option>';
    }
    return $str;
}

/* Genera la cotizacion desde proforma */
function proforma_cotizacion($id){
	$reg=imp_proforma::edit('S',$id);
	$comision=5;
        $utilidad=6;
	$cad='<table width="100%">';
        $cad.='<tr><td>Nro. Cot.</td><td><input type="text" name="cot_nro" id="cot_nro" value="'.$reg['imp_prof_nro'].'" ></td></tr>';
        $cad.='<tr><td>Utilidad (%)</td><td><input type="text" name="cot_utilidad" id="cot_utilidad" value="'.$utilidad.'" ></td></tr>';
        $cad.='<tr><td>Comis. Vent (%)</td><td><input type="text" name="cot_comision" id="cot_comision" value="'.$comision.'" ></td></tr>';
        $cad.='</table>';			
	return $cad;
}

function EnviarCorreo($tipo='',$id=0){
    $cc=variable('MAIL_CC');
    switch ($tipo){
        case 'C': // Cotizaciom
            $reg=cotizacion::edit('S',$id);
            $para=$reg['correo_contacto'];
            $asunto="COTIZACION Nro. ".$reg['cot_nro'];
            $de=$reg['correo_atiende'];
            $adjunto=$reg['cot_nro'].".pdf";
            break;
        case 'P': // Proforma
            $reg=imp_proforma::edit('S',$id);
            $para=$reg['correo_contacto'];
            $asunto="REQUEST FOR QUOTE / SOLICITUD DE COTIZACION";
            $de=$reg['correo_atiende'];
            $adjunto=$reg['imp_prof_nro'].".pdf";
            break;
        case 'OC':
            $reg=compras::edit('S',$id);
            $para=$reg['correo_contacto'];
            $asunto="TRADE ORDER / N. ".$reg['comp_nro'];
            $de=$reg['correo_atiende'];
            $adjunto=$reg['comp_nro'].".pdf";
            break;
        case 'OCL':
            $reg=oc::edit('S',$id);
            $para=$reg['correo_contacto'];
            $asunto="PURCHASE ORDER NÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Âº ".$reg['oc_nro'];
            $de=$reg['correo_atiende'];
            $adjunto=$reg['oc_nro'].".pdf";  
            break;
    }
    
    if($tipo=='C'){
        $para=para_lista($reg['cliente_id']);
    }else{
        $para='<input name="mail_para" id="mail_para" type="text" size="50" value="'.$para.'" />';
    }
    
    //<input name="mail_para" id="mail_para" type="text" size="50" value="'.$para.'" />
    $str='<table width="100%" border="0">
          <tr><td>De</td><td><b>'.$de.'</b></td></tr>
          <tr>
            <td valign="top">Para<input type="hidden" id="mail_de" name="mail_de" value="'.$de.'"></td>
            <td>'.$para.'</td>
          </tr>
          <tr><td>CC</td><td><b>'.$cc.'</b></td></tr>
          <tr>
            <td>Asunto</td>
            <td><input name="mail_asunto" id="mail_asunto" type="text" size="50" value="'.$asunto.'" /></td>
          </tr>
          <tr>
            <td valign="top">Mensaje</td>
            <td><textarea name="mail_mensaje" id="mail_mensaje" cols="50" rows="5"></textarea></td>
          </tr>
          <tr><td>Adjunto</td><td><b>'.$adjunto.'</b></td></tr>
          </table>';
    return $str;
}

function para_lista($cliente_id=0){
    $reg=contacto::lista($cliente_id);
    foreach ($reg as $value){
        $str.='<input type="checkbox" name="mail_para[]" id="mail_para[]" value="'.$value['cont_email'].'">'.$value['pers_completo'].'('.$value['cont_email'].')<br>';
    }
    return '<div style="overflow:auto;border: 1px solid #999999;background-color:#FFFFFF">'.$str.'</div>';
}

function Reasignar($tbl_id=0,$id=0){
    switch($tbl_id){
        case 67: // tabla Cotizacion
            $reg=cotizacion::edit('S',$id);
            $operador=$reg['responsable'];
            $operador_id_desde=$reg['operador_id'];
            break;
    }    
    $str='<table width="100%" border="0">
          <tr>
            <td>Desde<input type="hidden" name="operador_id_desde" id="operador_id_desde" value="'.$operador_id_desde.'"></td>
            <td><b>'.$operador.'</b></td>
          </tr>
          <tr>
            <td>Hacia</td>
            <td><select id="operador_id_hacia" name="operador_id_hacia">'.trabajador_ddl().'</select></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
                <input type="radio" name="tipo_asignacion" id="tipo_asignacion" value="1" checked />Seleccionados<br>
                <input type="radio" name="tipo_asignacion" id="tipo_asignacion" value="2" />Todos Vigentes
            </td>
          </tr>          
          </table>';
    return $str;
}

function imp_gasto_lista($imp_prof_det_id=0){
    $reg=imp_proforma::imp_gasto('L',$imp_prof_det_id);    
    if(is_array($reg)){    
        $str="<table class='list'>".cabecera(false,'Id,Descripción,Moneda,Costo',2);
        $str.="<tbody>";
        foreach ($reg as $value) {
            $total+=$value['imp_prof_gasto_valor'];
            $str.="<tr>            
            <td align='center' width='20'>".$value['imp_prof_gasto_id']."</td>    
            <td>".$value['imp_prof_gasto_nombre']."</td>
            <td class='center'>".$value['moneda']."</td>
            <td class='right'>".$value['imp_prof_gasto_valor']."</td>           
            <td width='5px' class='center'><a onclick=\"imp_prof_gasto('U','".$value['imp_prof_gasto_id']."','".$imp_prof_det_id."')\"><img title='Editar' src='images/b_edit.png'></a></td>
            <td width='5px' class='center'><a onclick=\"imp_prof_gasto('D','".$value['imp_prof_gasto_id']."','".$imp_prof_det_id."')\"><img title='Eliminar' src='images/b_drop.png'></a></td>
            </tr>";
        }    
        $str.="<tr><td colspan='3' class='right'>Total Gastos:</td><td class='right'>".(round($total,2))."</td><td colspan='2'></td></tr></tbody></table>";
    }
    return $str;
}

function imp_gasto_form($id=0){
    $reg=imp_proforma::imp_gasto('S',$id);
    $str='
        <table width="100%" border="0">
        <tr>
            <td>Nombre</td>
            <td><input name="nombre" type="text" id="nombre" size="40" value="'.$reg['imp_prof_gasto_nombre'].'" /></td>
        </tr>
        <tr>
            <td>Valor</td>
            <td><input name="valor" type="text" id="valor" size="15" value="'.$reg['imp_prof_gasto_valor'].'" /></td>
        </tr>
        </table>';
    return $str;
}
function imp_adv_ddl($id=0){
    $reg=imp_proforma::advalorem_ddl();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['adv_valor']==$id)?' selected ':'';
        $str.='<option value="'.$value['adv_valor'].'" '.$sel.'>'.$value['adv_nombre'].' : '.$value['adv_valor'].'</option>';
    }
    return $str;
}

function atajos_lista($operador_id=0){
    $operador_id=$_SESSION['SIS'][2];
    $reg=atajos::edit('S',$operador_id);    
    if(is_array($reg)){
        $str="<table class='list'>";
        $str.="<tbody>";
        foreach ($reg as $value){            
            $str.="<tr>                        
            <td><a href='".$value['atajo_url']."'>".$value['atajo_nombre']."</a></td>                               
            <td width='5px' class='center'><a onclick=\"CrearAccesoDirecto('D',".$value['atajo_id'].")\"><img title='Eliminar' src='images/b_drop.png'></a></td>
            </tr>";
        }
        $str.="</tbody></table>";
    }
    return $str;
}

function get_style($empresa_id=0){
    switch($empresa_id){
        case 1: // Electrowerke
            $css='styles/styles1.css';
            break;
        case 2: // Electrotec
            $css='styles/styles2.css';
            break;
        default:
            $css='styles/styles.css';
            break;
    }
    return $css;
}

function get_logo($empresa_id=0){
    switch($empresa_id){
        case 1: // Electrowerke
            $logo='<img src="images/logo_empresa1.png" width="160" height="80"  title="Administration" />';
            break;
        case 2: // Electrotec
            $logo='<img src="images/logo_empresa2.png" width="190" height="80"  title="Administration" />';
            break;
        default:
            $logo='<a href="http://www.solucionestecperu.com" target="_blank">
                   <img src="images/logo2009.png" height="50"  title="Administration" />
                   </a>';
            break;
    }
    return $logo;
}

function cotizacion_lista($empresa_id=0){
    $empresa_id=$_SESSION['SIS'][5];
    $reg=cotizacion::edit('L',$empresa_id);
    if(is_array($reg)){
        $str="<table class='list'>".cabecera(false,'Nro,Estado,Cliente',0);
        $str.="<tbody>";
        foreach ($reg as $value){
            $url="index.php?menu_id=29&menu=persona_form&tbl_id=67&id=".$value['cotizacion_id']."&a=U&cotizacion_id=".$value['cotizacion_id']."&cli_id=".$value['cliente_id'];
            $str.="<tr>
            <td><a href='".$url."'>".$value['cot_nro']."</a></td>
            <td class='center'>".$value['estado']."</td>
            <td>".$value['cliente']."</td>
            </tr>";
        }    
        $str.="</tbody></table>";
    }
    return $str;
}

function cotizacion_estado($ano=0,$mes=0){
    $ano=($ano>0)?$ano:date("Y");
    $mes=($mes>0)?$mes:date("m");
    $reg=cotizacion::cot_estado_ddl();
    if(is_array($reg)){
        $str.="<table class='list'>";
        $str.='<thead>
               <tr><td colspan="2" align="center">
               Año:<select id="ano_id" name="ano_id" onchange="CotEstado();">'.periodo_ddl($ano,5,0).'</select>
               Mes:<select id="mes_id" name="mes_id" onchange="CotEstado();">'.mes_ddl($mes).'</select>
               </td></tr>
               <tr><td class="center">Estado</td><td class="center">Total</td></tr>
               </thead>';
        $str.="<tbody>";
        foreach ($reg as $value){
            $total=cotizacion::cot_estado_lista($value['cot_estado_id'],$ano,$mes);
            $url="index.php?menu_id=29&menu=personas&tbl_id=67&cot_estado_id=".$value['cot_estado_id'];
            $enlace=($total>0)?"<a href='".$url."'>".$value['cot_estado_nombre']."</a>":$value['cot_estado_nombre'];
            $str.="<tr>
            <td>".$enlace."</td>
            <td class='center'><b>".$total."</b></td>
            </tr>";
        }
        $str.="</tbody></table>";
    }
    return $str;
}
/**************Conversion de monedas******************/
function conversor_divisas($moneda_origen, $moneda_destino, $cantidad,$tipo=''){
    // 1=soles  2=dolares   3=euros
       
    $moneda=cp_compras::mon_tipo_cambio($moneda_origen,$moneda_destino,$cantidad,'C',$tipo);

    
    return round($moneda,2);
        
}

function clasifx_lista(){
    //echo '<div id="clasif" style="float:left;width:25%;height:400px;border:solid gray 1px;overflow:auto">';
    clasifx::lista(0);
 
}

function producto_clasifx(){
    $reg=producto::lista();
    $nreg=count($reg);
    if($nreg>0){
        echo "<table class='list'>".cabecera(true,'Id,Nombre,Precio,Stock',1);
        echo "<tbody>";
        for($x=0;$x<$nreg;$x++){            
            echo "<tr>
            <td width='10' align='center'><input type='checkbox' name='selected[]' value='".$reg[$x]['ope_id']."'/></td>            
            <td >".$reg[$x]['producto_id']."</td>
	    <td >".$reg[$x]['prod_nombre']."</td>            
            <td >".$reg[$x]['prod_precio']."</td>
            <td >".$reg[$x]['prod_stock']."</td>                                    
            <td width='10' align='center'><a href='index.php?menu=producto_form&a=U&id=".$reg[$x]['producto_id']."' title='Editar'><img src='images/b_edit.png'></a></td>            
            </tr>";
        }    
        echo "</tbody></table>";
    }
}

function tipo_cambio(){
    $reg=doc_financiero::tipo_cambio();
    $str='<table class="list">
          <thead>
          <tr><td colspan="3" align="center">Actualizado al: '.$reg['fecha'].'</td></tr>
          <tr><td>&nbsp;</td><td align="center">Dólares</td><td align="center">Euros</td></tr>
          </thead>
          <tbody>
          <tr><td>Compra</td><td class="center">'.$reg['mon_tc_compra_us'].'</td><td class="center">'.$reg['mon_tc_compra_eu'].'</td></tr>
          <tr><td>Venta</td><td class="center">'.$reg['mon_tc_venta_us'].'</td><td class="center">'.$reg['mon_tc_venta_eu'].'</td></tr>
          <tr><td colspan="3" align="right"><a class="button" href="index.php?menu_id=55&menu=persona_form&tbl_id=99&id=0&a=I">Actualizar</a></td></tr>
          </tbody>
        </table>';
    return $str;
    
}

function doc_financiero_lista($tipo=0,$moneda=0){
    $reg=doc_financiero::lista($tipo,$moneda);
    $str="<table class='list'>".cabecera(false,'Cliente,Fec. Emision,Fec. Venc.,Importe,Estado',1);
    $str.="<tbody>";
    foreach ($reg as $value) {
        $str.='<tr>            
            <td>'.$value['cliente'].'</td>
            <td>'.$value['doc_fin_fec_emis'].'</td>
            <td>'.$value['doc_fin_fec_venc'].'</td>
            <td>'.$value['moneda'].' '.number_format($value['doc_fin_valor'],2,'.',',').'</td>
            <td>'.$value['estado'].'</td>
            <td><a href="index.php?menu_id=65&menu=persona_form&tbl_id=128&id=3&a=U&doc_financiero_id='.$value['doc_financiero_id'].'"><img src="images/b_edit.png" title="Editar"></a></td>
            </tr>';
    }
    $str.="</tbody></table>";    
    return $str;
}

function doc_financiero_lista_reporte(){
    $reg=doc_financiero::lista_reporte();
    if($reg){
    $str='<table class="list">
          <thead>
          <tr align="center">
          <td>Cliente</td>
          <td>Concepto</td>
          <td>Tipo</td>
          <td>Fec. Venc.</td>
          <td>Importe</td>
          <td>Garantia</td>
          </tr>
          </thead>';
    $str.='<tbody>';
    foreach ($reg as $value) {
        switch($value['moneda_id']){
            case 1:
                $imp_total_soles+=$value['doc_fin_valor'];
                
                break;
            case 2:
                $imp_total_dolar+=$value['doc_fin_valor'];
                
                break;
        }  
        switch($value['moneda_id_garantia']){
            case 1:               
                $gar_total_soles+=$value['doc_fin_garantia'];
                break;
            case 2:                
                $gar_total_dolar+=$value['doc_fin_garantia'];
                break;
        }  
        $str.='<tr>
            <td>'.$value['cliente'].'</td>
            <td>'.$value['doc_fin_concepto'].'</td>
            <td>'.$value['tipo'].'</td>
            <td class="center">'.$value['doc_fin_fec_venc'].'</td>
            <td class="right">'.$value['moneda_imp'].' '.number_format($value['doc_fin_valor'],2,'.',',').'</td>
            <td class="right">'.$value['moneda_gar'].' '.number_format($value['doc_fin_garantia'],2,'.',',').'</td>
            </tr>';
    }
    $str.='<tr><td colspan="3">&nbsp;</td><td align="center"><b>Total</b></td>
               <td align="right"><b>S/. '.number_format($imp_total_soles,2,'.',',').'</b></td>
               <td align="right"><b>S/. '.number_format($gar_total_soles,2,'.',',').'</b></td></tr>';
    $str.='<tr><td colspan="3">&nbsp;</td><td align="center">&nbsp;</td>
               <td align="right"><b>$. '.number_format($imp_total_dolar,2,'.',',').'</b></td>
               <td align="right"><b>$. '.number_format($gar_total_dolar,2,'.',',').'</b></td></tr></tbody></table>';
    }
    return $str;
}




function tablero_lista($perfil_id=0,$posicion=''){
    $reg=tablero::lista($perfil_id,$posicion);
    if($reg){
    foreach ($reg as $value){
        $str.='<div class="dashboard-heading">'.$value['tab_titulo'].'</div>
               <div class="dashboard-content" id="tablero'.$value['tablero_id'].'">';
        if($value['tab_contenido']>''){
            $str.=call_user_func($value['tab_contenido']);
        }
        
        $str.='</div><br>';
    }
    }
    return $str;
}

function letra_amortizacion($letra_detalle_id=0){
    $reg=letra::edit('S',$letra_detalle_id);
    $str='<table id="f1" width="100%" border="0">
          <tr>
          <td>Fecha de pago </td>
          <td><input size="12" type="text" id="fecha" name="fecha"><script>Javascript:Calendario(\'fecha\');</script></td>
          </tr>
          <tr>
          <td>Monto a pagar</td>
          <td><input name="monto" type="text" id="monto" value="'.$reg['monto_pagado'].'"></td>
          </tr>
          <tr>
          <td>Acción a tomar</td>
          <td><select onchange="HiddenShow(this.value);" id="accion_tomar" name="accion_tomar"><option value="1">Solo amortizar letra</option><option value="2">Cancelar letra actual y generar nueva</option></select></td>
          </tr>
          </table>
          <table style="display:none" id="f2" width="100%" border="0">
          <tr>
          <td width="40%">Nro. Letra</td>
          <td><input name="nro" type="text" id="nro"></td>
          </tr>
          <tr>
          <td>Fec. vencimiento </td>
          <td><input size="12" type="text" id="fecha_venc" name="fecha_venc"><script>Javascript:Calendario(\'fecha_venc\');</script></td>
          </tr>
          </table>';
    return $str;
}

function letra_lista_reporte($tipo){
    switch($tipo){
        case 1: // Por cobrar
            $rotulo="Cliente";
            $campo="cliente";
            break;
        case 2: // Por Pagar
            $rotulo="Proveedor";
            $campo="proveedor";
            break;
    }
    
   
    $str='<table class="list">
  <thead>
  <tr align="center">
    <td rowspan="2" align="center" valign="middle">Fe. emision </td>
    <td rowspan="2" align="center" valign="middle">Letra</td>
    <td rowspan="2" align="center" valign="middle">Factura</td>
    <td rowspan="2" align="center" valign="middle">N. orden </td>    
    <td rowspan="2" align="center" valign="middle">Importe inicial </td>
    <td rowspan="2" align="center" valign="middle">Pago</td>
    <td rowspan="2" align="center" valign="middle">Saldo</td>
    <td rowspan="2" align="center" valign="middle">Fec. pago </td>
    <td rowspan="2" align="center" valign="middle">Fec. venc. </td>
    <td rowspan="2" align="center" valign="middle">Banco</td>
    <td colspan="2" align="center" valign="middle">Dias</td>
    <td colspan="2"align="center" valign="middle">Importe</td>
  </tr>
  <tr>
    <td align="center" valign="middle">Atraso</td>
    <td align="center" valign="middle">Por vencer </td>
    <td align="center" valign="middle">Atraso</td>
    <td align="center" valign="middle">Por vencer </td>
  </tr>
  </thead>';
    $str.="<tbody>";
    $empresa=letra::letra_empresa();
    
    foreach ($empresa as $var) {
        $reg=letra::lista($var['cliente_id'],$var['proveedor_id']);
        $str.='<tr><td colspan="14"><b>'.$var[$campo].'</b></td></tr>';
        $importe=0;
        foreach($reg as $value){
        $importe+=$value['letra_det_monto'];
        $detalle=letra::detalle($value['letra_detalle_id']);
        $class=($class=='active')?'':'active';
        $str.='<tr class="'.$class.'">
        <td class="center">'.$value['letra_det_fec_emis'].'</td>
        <td>'.$value['letra_det_nro'].'</td>
        <td class="right"></td>
        <td></td>            
        <td class="right">'.$value['moneda'].' '.number_format($value['letra_det_monto'],2,'.',',').'</td>                
        <td class="right"></td>
        <td class="right"></td>
        <td class="right"></td>
        <td class="right">'.$value['letra_det_fec_venc'].'</td>
        <td class="right"></td>
        <td class="right"></td>
        <td class="right"></td>
        <td class="right"></td>
        <td class="right"></td>
        </tr>';        
        if($detalle){
            foreach ($detalle as $item){
                
                $str.='<tr class="'.$class.'">
                <td class="center">'.$value['letra_det_fec_emis'].'</td>
                <td>'.$item['letra_det_nro'].'-'.$item['letra_det_amort_revision'].'</td>
                <td class="right"></td>
                <td></td>
                <td>'.$value[$campo].'</td>
                <td></td>
                <td class="right">'.number_format($item['letra_det_amort_monto_pago'],2,'.',',').'</td>               
                <td class="right">'.number_format($item['letra_det_amort_saldo'],2,'.',',').'</td>
                <td class="right">'.$item['letra_det_amort_fec_pago'].'</td>
                <td>'.$item['letra_det_fec_venc'].'</td>
                <td>'.$item['banco'].'</td>
                <td class="right"></td>
                <td class="right"></td>
                <td class="right"></td>
                <td class="right"></td>
                </tr>';
            }
        }                                        
    }
    $str.='<tr>
           <td></td><td></td><td></td><td></td><td align="right"><b>'.$value['moneda'].' '.number_format($importe,2,'.',',').'</b></td><td></td><td></td>
           <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
           </tr>';
    
    }
    $str.="</tbody></table>";
    return $str;
}

function doc_fin_tipo_ddl($id=0){
    $reg=doc_financiero::doc_fin_tipo();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['doc_fin_tipo_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['doc_fin_tipo_id'].'" '.$sel.'>'.$value['doc_fin_tipo_nombre'].'</option>';
    }
    return $str;

}

function cliente_ddl($id=0){
    $empresa_id=$_SESSION['SIS'][5];
    $reg=cliente::cliente_ddl($empresa_id);
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['cliente_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['cliente_id'].'" '.$sel.'>'.$value['emp_nombre'].'</option>';
    }
    return $str;
}

function banco_ddl($id=0){
    
    $reg=letra::banco_ddl();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['banco_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['banco_id'].'" '.$sel.'>'.$value['banco_nombre'].'</option>';
    }
    return $str;
}

function Redirect($campo_pk='',$id=0){
    $url=$_SERVER['REQUEST_URI'];
    $url=explode("?",$url);
    $url=$url[1];
    
    $search=array("a=I","a=I","id=0",$campo_pk."=0");
    $replace=array("a=U","a=U","id=".$id,$campo_pk."=".$id);
    
    $url=str_replace($search, $replace, $url);
    return $url;
}

function letras_pagar_lista(){
    $reg=letra::edit('D',2);
    $str="<table class='list'>".cabecera(false,'Nro,Vencimiento,Dias por vencer,Proveedor,Monto,Ubicacion',0);
    $str.="<tbody>";
    foreach ($reg as $value){
        $href="index.php?menu_id=67&menu=persona_form&tbl_id=162&id=".$value['letra_id']."&a=U&letra_id=".$value['letra_id']."&tab=1";
        $dias=($value['dias_venc']<=0)?0:abs($value['dias_venc']);
        $str.='<tr>
            <td><a href="'.$href.'">'.$value['letra_det_nro'].'</a></td>
            <td>'.$value['letra_det_fec_venc'].'</td>
            <td>'.$dias.'</td>
            <td class="left">'.$value['proveedor'].'</td>
            <td class="center">'.$value['moneda'].' '.$value['letra_monto'].'</td>
            <td class="center">'.$value['banco'].'</td>            
            </tr>';
    }
    $str.="</tbody></table>";
    return $str;    
}
function letras_cobrar_lista(){
    $reg=letra::edit('D',1);
    $str="<table class='list'>".cabecera(false,'Nro,Vencimiento,Dias por vencer,Cliente,Monto,Ubicacion',0);
    $str.="<tbody>";
    foreach($reg as $value){
        $href="index.php?menu_id=67&menu=persona_form&tbl_id=162&id=".$value['letra_id']."&a=U&letra_id=".$value['letra_id']."&tab=1";
        $dias=($value['dias_venc']<=0)?0:abs($value['dias_venc']);
        $str.='<tr>
            <td><a href="'.$href.'">'.$value['letra_det_nro'].'</a></td>
            <td>'.$value['letra_det_fec_venc'].'</td>
            <td class="center">'.$dias.'</td>
            <td class="left">'.$value['cliente'].'</td>
            <td class="center">'.$value['moneda'].' '.$value['letra_monto'].'</td>
            <td class="center">'.$value['banco'].'</td>
            </tr>';
    }
    $str.="</tbody></table>";
    return $str;
}

function letra_det_lista($letra_tipo_id=0,$moneda_id=0){
    switch($letra_tipo_id){
        case '1':
            $titulo='Cliente';
            $campo='cliente';
            $tabla_id=162;
            $menu_id=67;
            break;
        case '2':
            $titulo='Proveedor';
            $campo='proveedor';
            $tabla_id=172;
            $menu_id=72;
            break;
    }
    $reg=letra::letra_resumen('L',$letra_tipo_id,$moneda_id);
    $str="<table class='list'>".cabecera(false,'Nro,Vencimiento,Dias por vencer,'.$titulo.',Monto,Ubicacion',1);
    $str.="<tbody>";
    foreach($reg as $value){
        $href="index.php?menu_id=".$menu_id."&menu=persona_form&tbl_id=".$tabla_id."&id=".$value['letra_id']."&a=U&letra_id=".$value['letra_id']."&tab=1";
        $dias=($value['dias_venc']<=0)?0:abs($value['dias_venc']);
        $str.='<tr>
            <td><a href="'.$href.'">'.$value['letra_det_nro'].'</a></td>
            <td>'.$value['letra_det_fec_venc'].'</td>
            <td class="center">'.$dias.'</td>
            <td class="left">'.$value[$campo].'</td>
            <td class="center">'.$value['moneda'].' '.$value['letra_det_monto'].'</td>
            <td class="center">'.$value['banco'].'</td>
            <td class="center" width="5"><a href="'.$href.'"><img src="images/b_edit.png" title="Editar"></a></td>
            </tr>';
    }
    $str.="</tbody></table>";
    return $str;
}


function cotizacion_informe(){
    $empresa_id=$_SESSION['SIS'][5];
    $reg=cotizacion::cot_informe($empresa_id);
    //$str="<table border='1' class='list'>".cabecera(false,'Responsable,Cliente,Proyecto,No. Cotizacion,Descripcion Producto/Servicio,Precio Total,Fecha,Estado,Observaciones',0);
    $str='<table border="1" class="list"><tr bgcolor="silver" align="center">
    <td><b>Responsable</b></td>
    <td><b>Cliente</b></td>
    <td><b>Proyecto</b></td>
    <td><b>No. Cotizacion </b></td>
    <td><b>Descripción Producto/Servicio </b></td>
    <td><b>Total items</b></td>
    <td><b>Precio total </b></td>
    <td><b>Fecha</b></td>
    <td><b>Estado</b></td>
    <td><b>Observaciones</b></td>
  </tr>';
    $str.="<tbody>";
    $total=0;
    $productos=array();
    $items=0;
    foreach ($reg as $value){
        $detalle=cotizacion::edit('D',$value['cotizacion_id']);
        $user=$reg['responsable'];
        //if($user===$reg['responsable']){
            $class=($class=='active')?'':'active';
        //}
        foreach ($detalle as $item){
            $productos[]='('.round($item['pro_cantidad']).') '.$item['prod_nombre'];
            $total+=($item['total']);
            $items+=$item['pro_cantidad'];
        }
        $str.='<tr class="'.$class.'">
            <td>'.$value['responsable'].'</td>
            <td>'.$value['cliente'].'</td>
            <td class="left">'.$value['proy_nombre'].'</td>
            <td class="center">'.$value['cot_nro'].'</td>
            <td class="center">'.(implode(', ',$productos)).'</td>
            <td class="center">'.$items.'</td>
            <td class="center">'.$reg['moneda'].' '.$total.'</td>
            <td class="center">'.substr($value['cot_fec_emis'],0,10).'</td>
            <td class="center">'.$value['estado'].'</td>            
            <td class="center">'.$value['cot_descrip'].'</td>
            </tr>';
        
    }
    $str.="</tbody></table>";
    return $str;   
}

function cot_estado_ddl($id=0){
    $reg=cotizacion::cot_estado_ddl();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['cot_estado_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['cot_estado_id'].'" '.$sel.'>'.$value['cot_estado_nombre'].'</option>';
    }
    return $str;
}

function proveedor_ddl($id=0){
    $empresa_id=$_SESSION['SIS'][5];
    $reg=empresa::proveedor_ddl($empresa_id);
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['proveedor_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['proveedor_id'].'" '.$sel.'>'.$value['emp_nombre'].'</option>';
    } 
    return $str;
}

function evento_lista($fecha=''){
    $fecha=($fecha>'')?$fecha:date("Y-m-d");
    $reg=evento::lista($fecha);
    $str="<table class='list'>".cabecera(false,'Dia,Nombre,Hora inicio,Hora fin',1);
    $str.="<tbody>";
    foreach($reg as $value){
        $str.='<tr>            
            <td class="center">'.ucwords($value['dia']).'</td>            
            <td class="left">'.$value['evento_nombre'].'</td>            
            <td class="center">'.$value['evento_hora_ini'].'</td>
            <td class="center">'.$value['evento_hora_fin'].'</td>
            <td class="center" width="5"><a onclick="col_form(\'C\',1,\'U\','.$value['evento_id'].')"><img src="images/b_edit.png"></a></td>
            </tr>';
    }
    $str.="</tbody></table>";
    return $str;
}

function recurso_lista($fecha=''){
    $fecha=($fecha>'')?$fecha:date("Y-m-d");
    $reg=recurso::lista($fecha);
    $str="<table class='list'>".cabecera(false,'Dia,Recurso,Actividad,Hora inicio,Hora fin',1);
    $str.="<tbody>";
    foreach($reg as $value){
        $str.='<tr>
            <td class="center">'.ucwords($value['dia']).'</td>            
            <td class="left">'.$value['recurso'].'</td>
            <td class="left">'.$value['rec_cal_actividad'].'</td>
            <td class="center">'.$value['rec_cal_hora_ini'].'</td>
            <td class="center">'.$value['rec_cal_hora_fin'].'</td>
            <td class="center" width="5"><a onclick="col_form(\'R\',1,\'U\','.$value['recurso_calendario_id'].')"><img src="images/b_edit.png"></a></td>
            </tr>';
    }
    $str.="</tbody></table>";
    return $str; 
}

function recurso_ddl($tipo=0,$id=0){
    $reg=recurso::recurso_ddl($tipo,$_SESSION['SIS'][5]);
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['recurso_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['recurso_id'].'" '.$sel.'>'.$value['recurso_nombre'].'</option>';
    }
    return $str;
}

function recurso_tipo_ddl($id=0){    
    $reg=recurso::recurso_tipo_ddl();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['recurso_tipo_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['recurso_tipo_id'].'" '.$sel.'>'.$value['recurso_tipo_nombre'].'</option>';
    }
    return $str;
}



function calendar($mes,$anio){
    $mes=($mes>0)?$mes:date("m");
    $anio=($anio>0)?$anio:date("Y");
        $dia=1;
        $hoy=date("Y-m-d");
        //echo $hoy;
        if(strlen($mes)==1) $mes='0'.$mes;
        
        $str='<table class="list">
         <thead>
         <tr class="center">
          <td>D</td>
          <td>L</td>
          <td>M</td>
          <td>M</td>
          <td>J</td>
          <td>V</td>
          <td>S</td>
         </tr>
         </thead>';
        

        //echo $mes.$dia.$anio;
        $numero_primer_dia = date('w', mktime(0,0,0,$mes,$dia,$anio));
        $ultimo_dia=ultimoDia($mes,$anio);
        
        $total_dias=$numero_primer_dia+$ultimo_dia;

        $diames=1;
        //$j dias totales (dias que empieza a contarse el 1Ã‚Âº + los dias del mes)
        $j=1;
        while($j<$total_dias){
                $str.='<tr>';
                //$i contador dias por semana
                $i=0;
                while($i<7){
                        if($j<=$numero_primer_dia){
                                $str.='<td></td>';
                        }elseif($diames>$ultimo_dia){
                                $str.= '<td></td>';
                        }else{
                                if($diames<10) $diames_con_cero='0'.$diames;
                                else $diames_con_cero=$diames;

                                $fecha=$anio.'-'.$mes.'-'.$diames_con_cero;
                                $day=($hoy==$fecha)?'<b>'.$diames.'</b>':$diames;
                                $str.='<td class="center"><a onclick="set_date('.$fecha.')">'.$day.'</a></td>';
                                $diames++;
                        }
                        $i++;
                        $j++;
                }
                $str.='</tr>';
        }        
        $str.='</table>';
        return $str;
}

function ultimoDia($mes,$ano){
    $ultimo_dia=28;
    while (checkdate($mes,$ultimo_dia + 1,$ano)){
       $ultimo_dia++;
    }
    return $ultimo_dia;
}

function periodo_ddl($id=0,$inicio=0,$fin=0){
    $a=date("Y");
    $inicio=$a-$inicio;
    $fin=$a+$fin;
    
    //$id=($id>0)?$id:$a;
    $str='<option value=""></option>';
    for($i=$inicio;$i<=$fin;$i++){
        $sel=($i==$id)?' selected ':'';
        $str.='<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
    }
    return $str;
}

function plan_contable_items($id=0){
    $reg=plan_contable::lista($id);
    foreach($reg as $item){
        $str.='<tr><td class="center">'.$item['plan_contable_id'].'</td>';
        $str.='<td>'.$item['plan_contable_codigo'].'</td>';
        $str.='<td>'.$item['plan_contable_nombre'].'</td>';
        $str.='<td>'.$item['plan_contable_id_padre'].'</td>';
        $str.='<td>'.(($item['plan_contable_sw']==1)?'Si':'No').'</td>';
        $str.='<td>'.$item['plan_contable_debe'].'</td>';
        $str.='<td>'.$item['plan_contable_haber'].'</td>';
        $str.='<td width="10"><a href="index.php?menu_id=80&menu=persona_form&tbl_id=179&a=U&id='.$item['plan_contable_id'].'"><img title="Editar" src="images/b_edit.png"></a></td></tr>';
        plan_contable_items($item['plan_contable_id']);
    }
    
    return $str;
}

function plan_contable_lista($id=0){
    $str="<table class='list'>".cabecera(false,'Id,Codigo,Nombre,Padre,Uso,Debe,Haber',1);
    $str.="<tbody>";
    $str.=plan_contable_items($id);
    $str.="</tbody></table>";
    return $str;
}

function sn_ddl($id=0){
    $array=array('0'=>"No",'1'=>"Si");
   
    foreach ($array as $key => $value) {
        $sel=($id==$key)?' selected ':'';
        $str.='<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
    }
    return $str;
        
}




//--[ funciones para el mÃƒÂ³dulo de alertas]--------------------------------------

function modulos_alerta_dll()
{
	$reg=modulo_alerta::lista();
	$cad='<table>';
	if($reg!=null)
	{
		foreach($reg as &$reg)
		{
			$cad.='<tr onclick="view_alertas(\''.$reg['modulos_alerta_id'].'\');"><td>'.$reg['modulos_alerta_nombre'].'</td></tr>';
		}
	}	
	$cad.='</table>';
	return $cad;
}
function modulo_alerta_lista($id){

	$reg=modulo_alerta::search_notice($id);
	$cad='<input type="hidden" id="conteo_alerta_msg" value="'.(count($reg)+0).'">';
	if($reg!=null)
	{
		foreach($reg as &$reg)
		{	
			$reg['tg_alerta_msg_output']=preg_replace('/\$valor_notice/','<b>'.$reg['valor_notice'].'</b>',$reg['tg_alerta_msg_output']);
			$reg['tg_alerta_msg_output']=preg_replace('/\$valor/','<b>'.$reg['valor'].'</b>',$reg['tg_alerta_msg_output']);
			$cad.='<a title="cerrar" onclick="close_alert_msg('.$reg['tg_alertas_id'].');" ><div class="alert_msg" id="'.$reg['tg_alertas_id'].'"><span class="alert_msg_close" ><b>x</b></span>'.$reg['tg_alerta_msg_output'].'</div></a>';
		}
	}
	
	return $cad;
}


//--[ funciones para el mÃƒÂ³dulo de alertas]----------------------------------------------------------



//--[ funciones mÃƒÂ³dulo de generador de estadÃƒÂ­sticas]----------------------------------------------------------
function ddl_tipo_estadistica($est_tipo_dato){
	$cad='<option value=""></option>';
	if($reg=estadisticas::ddl_est_tipo($est_tipo_dato)){
		foreach($reg as &$reg){
			$cad.='<option value="'.$reg['est_tipo_siglas'].'">'.$reg['est_tipo_nombre'].'</option>';
		}
	}
	return $cad;
}

function construir_estadistica($id){
	return $id;
}
function construir_reporte($id){
	return $id;
}

//--[ fin funciones mÃƒÂ³dulo de generador de estadÃƒÂ­sticas]----------------------------------------------------------

function tab_doc_financiero($moneda_id=2){
    $tipo=doc_financiero::doc_fin_tipo();
    $moneda=cp_compras::moneda_lista($moneda_id);
    $str='<table class="list">';
    $str.='<thead><tr><td class="center">Moneda:<select id="moneda_id" name="moneda_id" onchange="DocFinMoneda(this.value)">'.moneda_ddl($moneda_id).'</select></td><td colspan="2" class="center">Vencidos</td><td colspan="2" class="center">Por vencer</td></tr>';
    $str.='<tr><td>&nbsp;</td><td>Cantidad</td><td>Monto ('.$moneda[0]['mon_sigla'].')</td><td>Cantidad</td><td>Monto ('.$moneda[0]['mon_sigla'].')</td></tr></thead>';
    $str.='<tbody>';
    foreach ($tipo as $value) {
        $doc=doc_financiero::doc_fin_resumen('S',$value['doc_fin_tipo_id'],$moneda_id);
        $total_vence+=$doc['total'];
        $str.='<tr><td>'.$value['doc_fin_tipo_nombre'].'</td>
                   <td></td><td></td>
                   <td class="center"><a title="Ver detalle" onclick="DocFinDetalle(\'D\',\''.$value['doc_fin_tipo_nombre'].'\','.$value['doc_fin_tipo_id'].','.$moneda_id.')">'.$doc['cantidad'].'</a></td><td>'.number_format($doc['total'],2,'.',',').'</td>
               </tr>';
    }
    $letra=letra::letra_tipo_ddl();
    foreach ($letra as $item) {
        $tipo=letra::letra_resumen('S',$item['letra_tipo_id'],$moneda_id);
        $total_letra+=$tipo['total'];
        $str.='<tr><td>'.$item['letra_tipo_nombre'].'</td>
                   <td></td><td></td>
                   <td class="center"><a title="Ver detalle" onclick="DocFinDetalle(\'L\',\''.$item['letra_tipo_nombre'].'\','.$item['letra_tipo_id'].','.$moneda_id.')">'.$tipo['cantidad'].'</a></td><td>'.number_format($tipo['total'],2,'.',',').'</td>                   
               </tr>';
    }
    $str.='<tr class="filter"><td>&nbsp;</td><td>&nbsp;</td><td></td><td></td><td><b>'.number_format(($total_vence+$total_letra),2,'.',',').'</b></td></tr>';
    $str.='</tbody></table>';
    return $str;
}

function movimiento_lista(){
    return '';
}

function cp_lista_reporte($tipo=''){
    switch($tipo){
        case 1: // compras
            $titulo='Proveedor';
            $campo='proveedor';
            break;
        case 2: // ventas
            $titulo='Cliente';
            $campo='cliente';
            break;
    }
    $reg=cp::lista($tipo);
    $str='<table class="list" border="1" width="100%">
          <thead><tr bgcolor="#CCCCCC">          
          <td width="5%">Id</td>
    <td width="10%">Fec. emision</td>
    <td width="10%">Tipo</td>
    <td width="10%">Nro</td>
    <td width="30%">'.$titulo.'</td>
    <td width="5%">Mon</td>
    <td width="10%">Importe</td>
                  <td width="5%">IGV</td>
                  <td width="10%">Total</td>
                  <td width="5%">TC</td>
          </tr></thead >
          ';
    $str.='<tbody>';
    
    foreach($reg as $item){
        
        switch($item['moneda_id']){
            case 1: // Soles
                $total_sol+=$item['cp_monto_tot'];
                $total_sub_sol+=$item['cp_monto_sub'];
                $total_igv_sol+=$item['cp_monto_igv'];
                break;
            case 2: // Dolares
                $total_us+=$item['cp_monto_tot'];
                $total_sub_us+=$item['cp_monto_sub'];
                $total_igv_us+=$item['cp_monto_igv'];
                break;
        }
        $str.='<tr><td width="5%" class="center">'.$item['cp_id'].'</td>';
        $str.='<td width="10%" class="center">'.$item['cp_fec_emis'].'</td>';
        $str.='<td width="10%">'.$item['cp_tipo_nombre'].'</td>';
        $str.='<td width="10%">'.$item['cp_nro'].'</td>';
        $str.='<td width="30%">'.$item[$campo].'</td>';
        $str.='<td width="5%">'.$item['moneda'].'</td>';
        $str.='<td width="10%" class="right">'.number_format($item['cp_monto_sub'],2,'.',',').'</td>';
        $str.='<td width="5%" class="right">'.number_format($item['cp_monto_igv'],2,'.',',').'</td>';       
        $str.='<td width="10%" class="right">'.number_format($item['cp_monto_tot'],2,'.',',').'</td>';
        $str.='<td width="5%" class="right">'.$item['cp_mon_cambio'].'</td></tr>';
        
    }
    $str.='<tr>
            <td colspan="5" class="right">Total:</td>
            <td class="center"> S/.</td>
            <td class="right"><b>'.number_format($total_sub_sol,2,'.',',').'</b></td>
            <td class="right"><b>'.number_format($total_igv_sol,2,'.',',').'</b></td>
            <td class="right"><b>'.number_format($total_sol,2,'.',',').'</b></td><td></td></tr>';
    $str.='<tr>
            <td colspan="5" class="right">Total:</td>
            <td class="center">US$.</td>
            <td class="right"><b>'.number_format($total_sub_us,2,'.',',').'</b></td>
            <td class="right"><b>'.number_format($total_igv_us,2,'.',',').'</b></td>
            <td class="right"><b>'.number_format($total_us,2,'.',',').'</b></td><td></td></tr>';
    $str.="</tbody></table>";
    return $str;
}

function pagos_lista_reporte(){    
    $reg=pagos::lista();
    $str='<table class="list" border="1" width="100%">
          <thead><tr bgcolor="#CCCCCC">          
          <td width="5%">Id</td>
            <td width="10%">Fec. emision</td>
            <td width="30%">Proveedor</td>
            <td width="20%">Documento</td>            
            <td width="5%">Mon.</td>
            <td width="10%">Importe</td>
            <td width="10%">Cobrado</td>
            <td width="10%">Saldo</td>                  
          </tr></thead >
          ';
    $str.='<tbody>';
    
    foreach($reg as $item){                
        switch($item['moneda_id']){
            case 1:
                $total_sol+=$item['pago_monto'];
                break;
            case 2:
                $total_us+=$item['pago_monto'];
                break;
        }
        $str.='<tr><td width="5%" class="center">'.$item['pago_id'].'</td>';
        $str.='<td width="10%" class="center">'.$item['pago_fecha'].'</td>';
        $str.='<td width="30%">'.$item['proveedor'].'</td>';
        $str.='<td width="20%">'.$item['cp_nro'].'</td>';        
        $str.='<td width="5%" class="center">'.$item['moneda'].'</td>';
        $str.='<td width="10%" class="right">'.number_format($item['pago_monto'],2,'.',',').'</td>';
        $str.='<td width="10%" class="right">'.number_format($item['cobrado'],2,'.',',').'</td>';
        $str.='<td width="10%" class="right">'.number_format($item['pago_saldo'],2,'.',',').'</td></tr>';
        
    }
    //$str.='<tr><td colspan="5"></td><td>Total S/.</td><td class="right"><b>'.number_format($total_sol,2,'.',',').'</b></td><td></td><td></td></tr>';
    //$str.='<tr><td colspan="5"></td><td>Total US$</td><td class="right"><b>'.number_format($total_us,2,'.',',').'</b></td><td></td><td></td></tr>';
    $str.="</tbody></table>";
    return $str;
}

function letra_fecha_filtro($valor=''){
    $item=array('fecha_ini'=>'Emision','fecha_fin'=>'Vencimiento');
    foreach ($item as $key => $value) {
        $selec=($valor==$key)?' selected ':'';
        $cad.='<option value="'.$key.'" '.$selec.'>'.$value.'</option>';
    }
    return $cad;
      
}

function pago_lista_reporte(){
    $str='<table class="list" border="1" width="100%">
          <thead><tr align="center" bgcolor="#CCCCCC">
            <td width="5%">Id</td>
            <td width="10%">Fec. emision</td>
            <td width="20%">Documento</td>
            <td width="10%">Mon.</td>
            <td width="20%">Importe</td>
            <td width="20%">Pagado</td>
            <td width="15%">Saldo</td>
          </tr></thead>';
    $str.='<tbody>';
    $proveedores=pagos::pago_proveedor_ddl();
    foreach ($proveedores as $proveedor){
        $str.='<tr bgcolor="#FFFFCC"><td colspan="7"><b>'.$proveedor['emp_nombre'].'</b></td></tr>';
        $reg=pagos::lista($proveedor['proveedor_id']);
        $total_sol=0;
        $total_us=0;
        $cobrado_sol=0;
        $saldo_sol=0;
        $cobrado_us=0;
        $saldo_us=0;
        foreach($reg as $item){
            switch($item['moneda_id']){
                case 1:
                    $total_sol+=$item['pago_monto'];
                    $cobrado_sol+=$item['pagado'];
                    $saldo_sol+=$item['pago_saldo'];
                    break;
                case 2:
                    $total_us+=$item['pago_monto'];
                    $cobrado_us+=$item['pagado'];
                    $saldo_us+=$item['pago_saldo'];
                    break;
            }
            $str.='<tr><td width="5%" class="center">'.$item['pago_id'].'</td>';
            $str.='<td width="10%" class="center">'.$item['pago_fecha'].'</td>';
            $str.='<td width="20%">'.$item['cp_nro'].'</td>';
            $str.='<td width="10%" class="center">'.$item['moneda'].'</td>';
            $str.='<td width="20%" class="right">'.number_format($item['pago_monto'],2,'.',',').'</td>';
            $str.='<td width="20%" class="right">'.number_format($item['pagado'],2,'.',',').'</td>';
            $str.='<td width="15%" class="right">'.number_format($item['pago_saldo'],2,'.',',').'</td></tr>';
        }
        $str.='<tr><td colspan="3"></td><td>Total S/.</td>
                   <td class="right"><b>'.number_format($total_sol,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($cobrado_sol,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($saldo_sol,2,'.',',').'</b></td>
               </tr>';
        $str.='<tr><td colspan="3"></td><td>Total US$</td>
                   <td class="right"><b>'.number_format($total_us,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($cobrado_us,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($saldo_us,2,'.',',').'</b></td>
               </tr>';
    }    
    
    $str.="</tbody></table>";
    return $str;
}


function cobranza_lista_reporte(){
    $str='<table class="list" border="1" width="100%">
          <thead><tr align="center" bgcolor="#CCCCCC">
            <td width="5%">Id</td>
            <td width="10%">Fec. emision</td>
            <td width="20%">Documento</td>
            <td width="10%">Mon.</td>
            <td width="20%">Importe</td>
            <td width="20%">Cobrado</td>
            <td width="15%">Saldo</td>
          </tr></thead>';
    $str.='<tbody>';
    $clientes=cobranza::cob_cliente_ddl();
    foreach ($clientes as $cliente){
        $str.='<tr bgcolor="#FFFFCC"><td colspan="7"><b>'.$cliente['emp_nombre'].'</b></td></tr>';
        $reg=cobranza::lista($cliente['cliente_id']);
        $total_sol=0;
        $total_us=0;
        $cobrado_sol=0;
        $saldo_sol=0;
        $cobrado_us=0;
        $saldo_us=0;
        foreach($reg as $item){
            switch($item['moneda_id']){
                case 1:
                    $total_sol+=$item['cob_monto'];
                    $cobrado_sol+=$item['cobrado'];
                    $saldo_sol+=$item['cob_saldo'];
                    break;
                case 2:
                    $total_us+=$item['cob_monto'];
                    $cobrado_us+=$item['cobrado'];
                    $saldo_us+=$item['cob_saldo'];
                    break;
            }
            $str.='<tr><td width="5%" class="center">'.$item['cobranza_id'].'</td>';
            $str.='<td width="10%" class="center">'.$item['cob_fecha_ini'].'</td>';
            $str.='<td width="20%">'.$item['cp_nro'].'</td>';
            $str.='<td width="10%" class="center">'.$item['moneda'].'</td>';
            $str.='<td width="20%" class="right">'.number_format($item['cob_monto'],2,'.',',').'</td>';
            $str.='<td width="20%" class="right">'.number_format($item['cobrado'],2,'.',',').'</td>';
            $str.='<td width="15%" class="right">'.number_format($item['cob_saldo'],2,'.',',').'</td></tr>';
        }
        $str.='<tr><td colspan="3"></td><td>Total S/.</td>
                   <td class="right"><b>'.number_format($total_sol,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($cobrado_sol,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($saldo_sol,2,'.',',').'</b></td>
               </tr>';
        $str.='<tr><td colspan="3"></td><td>Total US$</td>
                   <td class="right"><b>'.number_format($total_us,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($cobrado_us,2,'.',',').'</b></td>
                   <td class="right"><b>'.number_format($saldo_us,2,'.',',').'</b></td>
               </tr>';
    }    
    
    $str.="</tbody></table>";
    return $str;
}

function cob_cliente_ddl($id=0){    
    $reg=cobranza::cob_cliente_ddl();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['cliente_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['cliente_id'].'" '.$sel.'>'.$value['emp_nombre'].'</option>';
    }
    return $str;
}

function pago_proveedor_ddl($id=0){    
    $reg=pagos::pago_proveedor_ddl();
    $str='<option value=""></option>';
    foreach ($reg as $value){
        $sel=($value['proveedor_id']==$id)?' selected ':'';
        $str.='<option value="'.$value['proveedor_id'].'" '.$sel.'>'.$value['emp_nombre'].'</option>';
    }
    return $str;
}


function reporte($reporte_id=0){
    $reg=reporte::edit('S',$reporte_id);
    $sql=$reg['reporte_sql'];
    $result=mysql_query($sql);
}


?>