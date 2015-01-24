<?php
class clasifx{
    function lista($id,$c=0){
        $sql="SELECT * FROM clasif_x WHERE bestado=1 and padre_id=".(int)$id;
        $result=mysql_query($sql) or Msg_error($sql);
        $num=mysql_num_rows($result);
        
        
        if($num>0){
            $c++;
            $class=($c==1)?' class="tree" ':'';
            echo '<ol'.$class.'>'."\n";
            while($row=mysql_fetch_array($result)){
                $nombre=$row['nombre'];
                $n=clasifx::edit('C',$row['id']);
                if($n>0){
                    echo '<li><label for="t'.$row['id'].'">'.$nombre.'</label> <input type="checkbox" id="t'.$row['id'].'" />'."\n";
                    clasifx::lista($row['id'],$c);
                    echo '</li>'."\n";
                }else{
                    echo '<li class="file"><a >'.$nombre.' '.$c.'</a></li>'."\n";
                }
            }
            echo '</ol>'."\n";
        }
    }
    function edit($accion='',$id=0){
        switch($accion){
            case 'C':
                $sql="select count(*)as C from clasif_x where padre_id=".(int)$id;
                break;
        }
        $result=mysql_query($sql);
        if($accion=='C'){
            $row=  mysql_fetch_array($result);
            return $row['C'];
        }
        
    }
}
?>