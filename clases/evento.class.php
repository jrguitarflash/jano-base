<?php
/**
 * Description of evento
 *
 * @author Andy
 */
class evento{
    function lista($fecha=''){        
        $prg=array();
        $where=($fecha>'')?" and evento_fecha='".$fecha."'":"";
        $where.=($_REQUEST['mes']>'')?" and month(evento_fecha)=".$_REQUEST['mes']:"";
        $sql="select*,concat(dayname(evento_fecha),' ',day(evento_fecha))as dia from eventos where bestado='1'".$where;
        $result = mysql_query($sql);
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
                $sql="select*from eventos where evento_id=".$id;
                $result = mysql_query($sql);
                $row=mysql_fetch_array($result,1);
                return $row;
                break;
            case 'I':
                $sql="insert into eventos(evento_fecha,evento_hora_ini,evento_hora_fin,evento_nombre,evento_descrip)
                      values('".$_REQUEST['evento_fecha']."','".$_REQUEST['evento_hora_ini']."','".$_REQUEST['evento_hora_fin']."','".$_REQUEST['evento_nombre']."','".$_REQUEST['evento_descrip']."')";
                $result = mysql_query($sql);
                break;
            case 'U':
                $sql="update eventos set
                      evento_fecha='".$_REQUEST['evento_fecha']."',
                      evento_hora_ini='".$_REQUEST['evento_fecha']."',
                      evento_hora_fin='".$_REQUEST['evento_fecha']."',
                      evento_nombre='".$_REQUEST['evento_fecha']."',
                      evento_descrip='".$_REQUEST['evento_fecha']."'
                      where evento_id=".$id;
                $result=mysql_query($sql);
                break;
        }
    }
}

?>
