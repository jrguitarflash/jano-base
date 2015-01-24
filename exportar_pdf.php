<?php
session_start();
include("include/comun.php");
$id=$_GET['tbl_id'];
function contenido($id){
    if($reg=tabla::tabla_col_lista($id)){
        $rotulo="<tr bgcolor='silver'>";
            foreach($reg as &$r){
                if($r['tbl_col_orden_lst']>0){                                            
                    $campos[]=($r['lst_formula']>'')?$r['lst_formula'].' AS '.$r['tabla_col_nombre']:$r['tabla_col_nombre'];
                    $rotulo.="<td align='center'><b>".$r['tabla_col_rotulo']."</b></td>";		
                }
            }
        $rotulo.="</tr>";
    }
    $cad="<tbody>";
    $t=tabla::tabla_edit('E',$id);
    $orden=" order by ".$t['lst_cpo_orden']." ASC ";
	$condicion=tbl_param($t['tbl_sql_cond']);
    $where=($condicion>'')?$condicion:"";
    $sql="SELECT ".implode($campos,',')." FROM ".$t['tbl_nombre']." WHERE ".$where.$orden;
    if($result=qry($sql)){
        foreach($result as &$row){
            $cad.="<tr>";
            foreach($reg as &$r){
                if($r['tbl_col_orden_lst']>0){
                    $search=array('<img src="images/p_alta.png" width="14" height="14"  title="Alta">','<img src="images/p_normal.png" title="Normal"  width="14" height="14" >','<img src="images/p_baja.png" title="Baja"  width="14" height="14" >');
                    $replace=array('Alta','Normal','Baja');
                    $align= Array('i'=>'left','d'=>'right','c'=>'center');
                    $valor=  str_replace($search, $replace,$row[$r['tabla_col_nombre']]);
                    $cad.="<td align='".$align[$r['lst_align']]."'>".$valor."</td>";				
                }
            }
            $cad.="</tr>";
        }
    }
    $cad.="</body>";
    return "<table >".$rotulo.$cad."</table>";
}
$html="<html>";
$html.="<head>";
$html.="<style>
body { font-family: verdana, sans-serif;} 
.list {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #000000;
	border-left: 1px solid #000000;
	margin-bottom: 5px;
}
.list td {
	border-right: 1px solid #000000;
	border-bottom: 1px solid #000000;
}
.list thead td {
	background-color: #EFEFEF;
	font-weight: bold;

}
.list tbody td {
	vertical-align: middle;
	padding: 1px 5px;
	/*background: #FFFFFF;*/
}

</style>";
$html.="<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
$html.="</head>";
$html.="<body>";
$html.="<table width='100%'>
        <tr><td>Sistema de Gestión Empresarial .:. TEC-ERP v.1.0</td></tr>
        <tr><td>Operador :".$_SESSION['SIS'][1]."</td></tr>
        <tr><td>".$_SESSION['SIS'][6]."</td></tr>
        </table><br>";
$html.=contenido($id);
$html.="</body>";
$html.="</html>";
//echo $html;
ExportarPDF2(2,$html,'','tabla.pdf');
?>
