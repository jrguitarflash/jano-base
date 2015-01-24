<?php
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Programa.xls"');
header("Content-Transfer-Encoding: binary");
ob_clean();
flush();
session_start();

include("include/comun.php");
$id=$_GET['tbl_id'];

function contenido($id){
	if($reg=tabla::tabla_col_lista($id)){
            $rotulo="<tr>";
		foreach($reg as &$r){
                    if($r['tbl_col_orden_lst']>0){                                            
			$campos[]=($r['lst_formula']>'')?$r['lst_formula'].' AS '.$r['tabla_col_nombre']:$r['tabla_col_nombre'];
			$rotulo.="<td><b>".$r['tabla_col_rotulo']."</b></td>";
                    }
		}
            $rotulo.="</tr>";
	}
	
	$t=tabla::tabla_edit('E',$id);
	$orden=" order by ".$t['lst_cpo_orden']." ASC ";
        $where=($t['tbl_sql_cond']>'')?$t['tbl_sql_cond']:"";
        $where= tbl_param($where);
	$sql="SELECT ".implode($campos,',')." FROM ".$t['tbl_nombre']." WHERE ".$where.$orden;
	if($result=qry($sql)){
		foreach($result as &$row){
			$cad.="<tr>";
			foreach($reg as &$r){
                            if($r['tbl_col_orden_lst']>0){
				$align= Array('i'=>'left','d'=>'right','c'=>'center');
				$cad.="<td align='".$align[$r['lst_align']]."'>".$row[$r['tabla_col_nombre']]."</td>";
                            }
			}
			$cad.="</tr>";
		}
	}
        
        
	return "<table border='1'>".$rotulo.$cad."</table>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php echo contenido($id);?>
</body>
</html>