<?php
class estadisticas
{ 
	function ddl_est_tipo($est_tipo_dato=0){
		$sql="select * from est_tipo where est_tipo_dato='".$est_tipo_dato."' and bestado='1'";
		$result=mysql_query($sql) or  Msg_error($sql);
		while($reg=mysql_fetch_array($result)){ $prg[]=$reg;}
		return $prg;
	}	
	function create($accion){
		switch($accion){
			case 'I':
				$sql="select tec_reportes('I','".
				$_GET['titulo']."','".
				$_GET['descripcion']."','".
				$_GET['tipo']."','".
				$_GET['frecuencia']."','".
				$_GET['plantilla']."','".
				$_GET['sql']."')";
			break;	
		}
		
			
		$result=mysql_query($sql) or  Msg_error($sql);
		if($accion=='I'){
			$reg=mysql_fetch_array($result);
			return $reg[0];
		
		}else{
			return 'vacio';
		}
	}
/*

create function tec_reportes(
$accion char(1),
$rep_titulo varchar(250),
$rep_descripcion varchar(250),
$rep_tipo char(10),
$rep_frecuencia char(10),
$rep_plantilla char(10),
$rep_sql text
) returns varchar(100) charset utf8 collate utf8_general_ci
begin
case $accion
	when 'I' then
	insert into reportes(rep_titulo,rep_descripcion,rep_tipo,rep_frecuencia,rep_plantilla,rep_sql)
	values ($rep_titulo,$rep_descripcion,$rep_tipo,$rep_frecuencia,$rep_plantilla,$rep_sql);
        return LAST_INSERT_ID();
end case;
end;
*/
	
}
?>