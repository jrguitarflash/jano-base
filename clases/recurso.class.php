<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of recurso
 *
 * @author Andy
 */
class recurso { 
    function lista($fecha=''){
        $prg=array();
        $where=($fecha>'')?" and rec_cal_fecha='".$fecha."'":"";
        $where.=($_REQUEST['recurso_tipo_id']>0)?" and recurso_tipo_id=".$_REQUEST['recurso_tipo_id']:"";
        $where.=($_REQUEST['recurso_id']>0)?" and recurso_id=".$_REQUEST['recurso_id']:"";
        $sql="select*,concat(dayname(rec_cal_fecha),' ',day(rec_cal_fecha))as dia,
              (select recurso_nombre from v_recurso where recurso_id=rc.recurso_id and recurso_tipo_id=rc.recurso_tipo_id)as recurso
              from recurso_calendario rc where bestado='1'".$where;
        $result = mysql_query($sql);
        //echo $sql;
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
	return $prg;
    }
    function edit($accion='',$id=0){
        switch($accion){
            case 'F':
                $sql="select monthname(".$id.") as mes,dayname(".$id.")as dia,day(".$id.")as ndia,year(".$id.")as ano";
                $result = mysql_query($sql);
                $row=mysql_fetch_array($result,1);
                return $row;
                break;
            case 'S':
                $sql="select*,
                      (select recurso_nombre from v_recurso where recurso_id=rc.recurso_id and recurso_tipo_id=rc.recurso_tipo_id)as recurso
                      from recurso_calendario rc where recurso_calendario_id=".$id;
                $result = mysql_query($sql);
                $row=mysql_fetch_array($result,1);
                return $row;
                break;
            case 'I':
                $sql="insert into recurso_calendario(recurso_tipo_id,recurso_id,rec_cal_fecha,rec_cal_hora_ini,rec_cal_hora_fin,rec_cal_actividad)
                      values('".$_REQUEST['recurso_tipo_id']."','".$_REQUEST['recurso_id']."','".$_REQUEST['rec_cal_fecha']."','".$_REQUEST['rec_cal_hora_ini']."','".$_REQUEST['rec_cal_hora_fin']."','".$_REQUEST['rec_cal_actividad']."')";
                $result = mysql_query($sql);
                break;
            case 'U':
                $sql="update recurso_calendario set
                      recurso_tipo_id='".$_REQUEST['recurso_tipo_id']."',
                      recurso_id='".$_REQUEST['recurso_id']."',
                      rec_cal_fecha='".$_REQUEST['rec_cal_fecha']."',
                      rec_cal_hora_ini='".$_REQUEST['rec_cal_hora_ini']."',
                      rec_cal_hora_fin='".$_REQUEST['rec_cal_hora_fin']."',
                      rec_cal_actividad='".$_REQUEST['rec_cal_actividad']."'                      
                      where recurso_calendario_id=".$id;
                $result=mysql_query($sql);
                break;
        }
    }
    
    function recurso_tipo_ddl(){
        $prg=array();
        $sql="select*from recurso_tipo where bestado='1' order by recurso_tipo_nombre";
        $result = mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
	return $prg;
    }
    function recurso_ddl($tipo=0,$empresa_id=0){
        $where=($tipo>0)?" and recurso_tipo_id=".$tipo:"";
        $prg=array();
        $sql="select*from v_recurso where empresa_id=".$empresa_id." and bestado='1' ".$where." order by recurso_nombre";
        $result = mysql_query($sql);
        echo $sql;
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
	return $prg;
    }
}

?>
