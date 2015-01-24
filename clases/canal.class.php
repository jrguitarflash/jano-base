<?php

class canal{
    function canal_lista(){
		$sql="SELECT * from tec_web2_canal where bestado='1' order by twc_nombre";
		return qry($sql);
    }
    
}
?>
