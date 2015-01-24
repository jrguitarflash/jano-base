<?php
class menu{
    static function menu_lista($id=0,$perfil=0){
        $search=array("SIS2","SIS5","SIS6");
        $replace=array($_SESSION['SIS'][2],$_SESSION['SIS'][5],$_SESSION['SIS'][6]);
        $sql="SELECT * FROM menu WHERE bestado=1 and menu_padre_id=".($id+0)." and menu_id in(select menu_id from menu_perfil where perfil_id=".(int)$perfil.") order by menu_posicion";
        $result=mysql_query($sql) or Msg_error($sql);
        $num=mysql_num_rows($result);
        if($num>0){
            //$class=($id==0)?'class="top"':'';
            $class_ul=($id==0)?'class="left" style="display:none;"':'';
            echo '<ul '.$class_ul.'>'."\n";
            while($row=mysql_fetch_array($result)){
                $hijos=menu::menu_edit('C',$row['menu_id']);
                if($id==0){
                    $class='class="top"';
                }else{
                    $class=($hijos>0 && $row['menu_padre_id']<>0)?'class="parent" ':'';
                }
                //$class=($hijos>0 && $row['menu_padre_id']<>0)?'class="parent" ':$class;
                $target=($row['menu_target']>'')?' target="'.$row['menu_target'].'"':'';
                /* SIS5=empresa_id SIS6=rotulo empresa*/
                $href='#';
                if($row['menu_url']){
                    $href=str_replace($search,$replace,$row['menu_url']);
                    //$href=str_replace('?menu=','?menu_id='.$row['menu_id'].'&menu=',$href);
                }
                $nombre=str_replace($search,$replace,$row['menu_nombre']);
                echo '<li id="menu_'.$row['menu_id'].'"><a href="'.$href.'" '.$class.' '.$target.'>'.$nombre.'</a>'."\n";
                menu::menu_lista($row['menu_id'],$perfil);
                echo '</li>'."\n";
            }
            echo '</ul>'."\n";
        }
    }
    
    function menu_padre($id=0,$perfil=0){
        $sql="SELECT * FROM menu WHERE menu_padre_id=".($id+0)." and menu_id in(select menu_id from menu_perfil where perfil_id=".(int)$perfil.") order by menu_posicion";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
        
    }
    
    function menu_nav($menu_id=0){
        if($menu_id>0){
            $sql="select*from menu where menu_id=".$menu_id;
            $result=mysql_query($sql);
            $row=mysql_fetch_array($result,1);
            $href='#';
            if($row['menu_url']){
                $href=str_replace('SIS5',$_SESSION['SIS'][5],$row['menu_url']);            
            }
            $nombre=str_replace('SIS6',$_SESSION['SIS'][6],$row['menu_nombre']);
            $str1='<a href="'.$href.'">'.$nombre.'</a>';
            if($row['menu_padre_id']>0){
                $str2=menu::menu_nav($row['menu_padre_id']).' » ';
            }
            return $str2.$str1;        
        }
    }
    
    function perfil_empresa($accion='',$perfil=0){
        switch($accion){
            case 'I':
                $sql="delete from perfil_empresa where perfil_id=".(int)$perfil;
                mysql_query($sql);
                $sql="SELECT * FROM empresa WHERE bestado=1 and mi_empresa='1' order by emp_nombre";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result)){
                    $empresa_id=$_REQUEST['empresa_'.$row['empresa_id']];
                    if($empresa_id>0){
                        $sql="insert into perfil_empresa(empresa_id,perfil_id)values(".(int)$empresa_id.",".(int)$perfil.")";
                        mysql_query($sql);
                    }
                }
                break;
            case 'L':
                $sql="SELECT *,
                      ifnull((select perfil_id from perfil_empresa p where p.empresa_id=empresa.empresa_id and perfil_id=".(int)$perfil."),0)as perfil
                      FROM empresa WHERE bestado=1 and mi_empresa='1' order by emp_nombre";
                $result=mysql_query($sql);                          
                echo "<ul class='acceso'>";
                while($row=mysql_fetch_array($result)){
                    $chk=($row['perfil']>0)?"checked":"";
                    echo "<li><input value='".$row['empresa_id']."' ".$chk." type='checkbox' name='empresa_".$row['empresa_id']."' />".$row['emp_nombre']."</li>";
                    
                }
                echo "</ul>";
                break;
        }
         
    }
    
    function perfil_tablero($accion='',$perfil=0){
        switch($accion){
            case 'I':
                $sql="delete from perfil_tablero where perfil_id=".(int)$perfil;
                mysql_query($sql);
                $sql="SELECT * FROM tablero WHERE bestado=1 order by tab_titulo";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result)){
                    $tablero_id=$_REQUEST['tablero_'.$row['tablero_id']];
                    if($tablero_id>0){
                        $sql="insert into perfil_tablero(tablero_id,perfil_id)values(".(int)$tablero_id.",".(int)$perfil.")";
                        mysql_query($sql);
                    }
                }
                break;
            case 'L':
                $sql="SELECT *,
                      ifnull((select perfil_id from perfil_tablero p where p.tablero_id=tablero.tablero_id and perfil_id=".(int)$perfil."),0)as perfil
                      FROM tablero WHERE bestado='1' order by tab_titulo";
                $result=mysql_query($sql);                          
                echo "<ul class='acceso'>";
                while($row=mysql_fetch_array($result)){
                    $chk=($row['perfil']>0)?"checked":"";
                    echo "<li><input value='".$row['tablero_id']."' ".$chk." type='checkbox' name='tablero_".$row['tablero_id']."' />".$row['tab_titulo']."</li>";
                    
                }
                echo "</ul>";
                break;
        }
         
    }
    
    function menu_perfil($accion='',$id=0,$perfil=0){
        switch($accion){
            case 'I':
                $sql="delete from menu_perfil where perfil_id=".(int)$perfil;
                mysql_query($sql);
                $sql="SELECT * FROM menu WHERE bestado=1 order by menu_posicion";
                $result=mysql_query($sql) or Msg_error($sql);
                while($row=mysql_fetch_array($result)){
                    $menu_id=$_REQUEST['menu_'.$row['menu_id']];
                    if($menu_id>0){
                        $sql="insert into menu_perfil(menu_id,perfil_id)values(".(int)$menu_id.",".(int)$perfil.")";
                        mysql_query($sql) or Msg_error($sql);
                    }
                    
                }                
                break;
            case 'L':
                $sql="SELECT *,
                      ifnull((select perfil_id from menu_perfil p where p.menu_id=menu.menu_id and perfil_id=".(int)$perfil."),0)as perfil
                      FROM menu WHERE bestado=1 and menu_padre_id=".(int)$id." order by menu_posicion";
                $result=mysql_query($sql) or Msg_error($sql);                          
                echo "<ul class='acceso'>";
                while($row=mysql_fetch_array($result)){
                    $chk=($row['perfil']>0)?"checked":"";
                    echo "<li><input value='".$row['menu_id']."' ".$chk." type='checkbox' name='menu_".$row['menu_id']."' />".$row['menu_nombre']."</li>";
                    menu::menu_perfil($accion,$row['menu_id'],$perfil);                               
                }
                echo "</ul>";
        }
                  
    }
    
    
    static function menu_edit($accion='',$id=0){        
        switch($accion){
            case 'S':
                $sql="select*from menu where menu_id=".(int)$id;
                break;                                    
            case 'P':
                $sql="select*from menu where menu_padre_id=".(int)$id;
                break;
            case 'C':
                $sql="select count(*)as C from menu where menu_padre_id=".(int)$id;
                break;
        }
        if ($sql>""){
            $result = mysql_query($sql);
            if ($accion=='C'){
                $row=mysql_fetch_array($result);
		return $row['C'];			}                        
            if ($accion=='S'){
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		return $prg;
            }
            if($accion=='L' || $accion=='P'){
                while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
                return $prg;
            }
	}
    }
}
?>