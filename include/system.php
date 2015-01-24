<?php
function cabecera($chk=false,$rotulos='',$colspan=3,$ancho='',$align='center',$color='#556688'){
	$rotulos=explode(',',$rotulos);
        $chk=($chk)?"<td align='center'><input type=\"checkbox\" onclick=\"$('input[name*=\'selected\']').attr('checked', this.checked);\" /></td>":"";
	//$ancho=(eregi(',',$ancho))?explode(',',$ancho):'';
	$cabecera="<thead><tr align=$align bgcolor=$color>".$chk;
	
	for($x=0;$x<count($rotulos);$x++){
		$cabecera.="<td width='".$ancho[$x+1]."'><b>".$rotulos[$x]."</b></td>";
	}
        $cabecera.=($colspan>0)?"<td colspan='$colspan' width='$ancho[0]' class='cAccion'>&nbsp;</td>":"";
	$cabecera.="</tr></thead>";
	return $cabecera;
}

function qry($sql,$onerow=false){
    $result=mysql_query($sql) or Msg_error($sql);
    if($onerow==true){
            if($row=mysql_fetch_array($result,1)){return $row;}
    }else{
            while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
            return $prg;
    }
}

function Msg_error($xsql=''){
    switch (mysql_errno()) {
        case 1062:  $Def='CODIGO DUPLICADO '; break;
        case 1064:  $Def='ERROR DE SINTAXIS EN LA INSTRUCCION '; break;
        case 1146:  $Def='TABLA DE DATOS, NO EXISTE '; break;
        case 1312:  $Def='EL RESULTADO, NO HA SIDO ENTREGADO A MYSQL CLIENTE '; break;
        default: $Def='::'; break;
    }
	$caller=debug_backtrace();
    die('<div class="warning">Error<br>
	Fuente: '.$caller[1]['class'].' -> '.$caller[1]['function'].'<br>
	Referencia: ('.mysql_errno().') '.$Def.'<br>
	Mensaje: '.mysql_error().'<br>
	Instruccion: '.$xsql.'<br>		
	</div>');
}



function qryPaginada($sql,$sw=false,$order=""){
		$_SESSION['operador']['sqlpos']=($_GET['sqlpos']>'')?$_GET['sqlpos']:$_SESSION['operador']['sqlpos'];
		$_SESSION['operador']['regporpag']=100;
		if($_SESSION['operador']['sfield']>''){
			$svalue=str_replace('_',$_SESSION['operador']['svalue'],$_SESSION['operador']['scomodin']);
			$con=($sw==false)?" WHERE ":" AND ";
			$sql.=$con.$_SESSION['operador']['sfield'].' LIKE "'.$svalue.'"';
		}
		if($order>""){$sql.=" ORDER BY ".$order;}
		if($_SESSION['operador']['sqlpos']>''){
			$sql.=' LIMIT '.$_SESSION['operador']['sqlpos'].','.$_SESSION['operador']['regporpag'];
		}else{
			$sql.=' LIMIT 0,'.$_SESSION['operador']['regporpag'];
		}
		//echo $sql."<br>";
		$result=mysql_query($sql) or Msg_error($sql);
		while($row=mysql_fetch_array($result,1)){$prg[]=$row;}
		//$sql=substr($sql,strrpos($sql,'FROM'));
		$sql=str_replace($_SESSION['operador']['orderby'],'',$sql);
		//echo $sql."<br>";
		$sql=preg_replace('/LIMIT [0-9]{0,3},[0-9]{0,3}$/i', '', $sql);
		$sql="SELECT COUNT(*) FROM(".$sql.") AS T_1";
		//echo $sql;
		///*
		if($result=mysql_query($sql)){
			$row=mysql_fetch_row($result);
			$_SESSION['operador']['sqlctotal']=($row[0]+0);
			$_SESSION['operador']['sqlctotalactual']=count($prg);
		}
		//*/
		return $prg;
	}


?>