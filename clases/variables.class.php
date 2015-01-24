<?php
class variables{
//------------------------------------------------------------------------------
    function variables_lista(){
        $sql="SELECT * FROM variable WHERE bestado='1'";
        $result=mysql_query($sql) or Msg_error($sql);
        while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
        return $prg;
    }
    
    function var_valor($nombre=''){
        $sql="SELECT var_valor FROM variable WHERE bestado='1' 
        AND UCASE(var_nombre)=UCASE('".$nombre."')";
        $result=mysql_query($sql) or Msg_error($sql);
	    $row=mysql_fetch_array($result);
	    return $row[0];
    }
    function var_edit($nombre='',$valor=''){
        $sql="update variable set var_valor='".$valor."' where UCASE(var_nombre)=UCASE('".$nombre."')";
        $result=mysql_query($sql) or Msg_error($sql);	    	    
    }
    
    function var_tc(){
        $sql="select*from moneda_tc where mon_tc_fecha=curdate() limit 1";
        $result=mysql_query($sql) or Msg_error($sql);
	$row=mysql_fetch_array($result);
	return $row;
    }
	

//------------------------------Fin Clase----------------------------------
}
?>