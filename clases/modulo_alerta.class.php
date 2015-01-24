<?php
class modulo_alerta
{
	function lista()
	{
		$sql="select * from modulos_alerta where bestado='1'";
		$result=mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
		return $prg;
	}
	
	function edit($id, $accion='E')
	{
		switch($accion){
			case 'E':
				$sql="select * from modulos_alerta where bestado='1' and modulos_alerta_id='".($id+0)."'";
				$result=mysql_query($sql) or Msg_error($sql);
				while($row=mysql_fetch_array($result,1)){$prg[]=$row;}		
				return $prg;
			break;
			default:
			return 'no se encuentra la accion';
			break;
		}
	}
	function search_notice($id)
	{
		$sql="select 
		nombre_column,valor,valor_notice,indicador, tg_alerta_msg.tg_alerta_msg_output,tg_alertas_id 
		from tg_alertas 
		inner join tg_alerta_msg on (tg_alerta_msg_tabla=nombre_tabla and tg_alerta_msg_accion=accion and tg_alerta_msg_indicador=indicador)
		where (bestado='1' or date_format(fecha_accion,'%Y-%m-%d')= date_format(curdate(),'%Y-%m-%d'))
		 and tg_alertas.modulos_alerta_id=".$id." order by tg_alertas_id DESC limit 3";
		$result=mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result)){$prg[]=$row;}		
		return $prg;
	}
	function update_notice_visit($id){
		$sql="update tg_alertas set bestado='0' where bestado='1' and tg_alertas_id=".$id;
		mysql_query($sql) or Msg_error($sql);
		/*seguiran viendose en tanto sea la fecha de hoy*/
	}
}

?>