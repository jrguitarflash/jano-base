<?php
include("include/comun.php");
?>
<html>
    <head>
    <title>Manager</title>
    <script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>    
<script language="javascript">   
    function getFile(obj){ 
		$("ul>li>a").each(function(){            
            $(this).removeClass("select");
        });       
		$(obj).addClass("select");
        $('#files').load('ajax.php?a=file&dir='+obj.title);
    }
    function select(valor){
        $("#selectable>li").each(function(){            
            $(this).removeClass("ui-selected").addClass("ui-default");
        });
        $(valor).removeClass("ui-default").addClass("ui-selected");
    }    
    function getValor(valor){        
        window.parent.addAdjunto(valor);
    }
 
</script>
<style>
	body{font-family:Arial, Helvetica, sans-serif;}
	table{font-size:12px}
	
	.dir{
	margin-left:5px;
	padding-left:2px
	}
	.dir li {
	padding: 2px 0px 2px 20px;		
	background: url('images/filemanager/folder.png') 0px top no-repeat;
	list-style:none;	
	text-align:left
	}
	.select{font-weight:bold}
	.dir li a{cursor:pointer}
	
	#selectable .ui-default{border:gray solid 1px; }
	#selectable .ui-selecting { background: #FECA40; }
	#selectable .ui-selected { background: #F39814; color: white;border:gray solid 1px; }
        
	#selectable { list-style-type: none; margin: 0; padding: 0;cursor:pointer }
	#selectable li { margin: 3px; padding: 1px; float: left; width: 100px; height: 80px; font-size: 1em; text-align: center;}
</style>	
    </head>


<body>
<table width="100%" border="1">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="30%" align="center" valign="top"><div id="dirs"><?=listar_dir('images')?></div></td>
    <td valign="top"><div style="height:250px;overflow:auto" id="files"></div></td>
  </tr>
  
</table>
</body>
</html>