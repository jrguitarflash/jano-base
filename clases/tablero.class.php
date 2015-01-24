<?php
class tablero{
    function lista($perfil_id=0,$posicion=''){
        $sql="select t.tablero_id,t.tab_titulo,t.tab_contenido from perfil_tablero p inner join tablero t
              on p.tablero_id=t.tablero_id
             where perfil_id=".(int)$perfil_id." and t.tab_posicion='".$posicion."'";
        $result= mysql_query($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    function edit($accion,$id){
        switch($accion){
            case 'S':
                $sql="SELECT*FROM atajos where bestado='1' and operador_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
                break;
            case 'I':
                $sql="select tec_atajos('I','','".$_SESSION['SIS'][2]."','','0','".$id."','','');";
                $result=mysql_query($sql);
                break;
            case 'D':
                $sql="update atajos set bestado='0' where atajo_id=".(int)$id;
                $result=mysql_query($sql);
                break;
        }

    }
}
?>