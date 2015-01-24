<?php
//$dia=
?>
<!--<link rel="stylesheet" type="text/css" href="styles/datepicker.css" />-->
<div class="box">
	<div class="heading">
    	<h1>Calendario</h1>
	  	<!--<div class="buttons">
			<a class="button" onClick="document.form1.submit();"><span>Grabar</span></a>
			<a class="button" href="index.php?menu=contac_list"><span>Ir a lista</span></a>
		</div>-->
    </div>
<div class="content">
<form action="index.php?menu_id=74&menu=calendario_list" method="post" name="form1">
<input type="hidden" name="fecha" id="fecha" value="<?=$_REQUEST['fecha']?>">
<input type="hidden" name="tab" id="tab" value="<?=$_REQUEST['tab']?>">

<table width="100%" >	    
  
  <!--<tr>
    <td align="center" ><select name="mes_id" id="mes_id" onchange="document.form1.submit();"><?=mes_ddl($_REQUEST['mes_id'])?></select>&nbsp;
      <select name="ano_id" id="ano_id" onchange="document.form1.submit();"><?=periodo_ddl($_REQUEST['ano_id'],5,1)?></select>
      </td>
    <td align="right"><a onclick="col_form(1,'I',0)"><img title="Agregar" src="images/add.png"></a></td>
  </tr>-->
  <tr>
    <td width="20%" align="center" ><div id="datepicker"></div><!--<br><?=calendar($_REQUEST['mes_id'],$_REQUEST['ano_id'])?>--></td>
	    <td width="81%" valign="top" >
                <div id="ui-tabs">
	<ul>
        <li><a href="#tab-recurso">Recursos</a></li>
	<li><a href="#tab-general">Calendario</a></li>	
        	
	</ul>
                    <div id="tab-general">
                        <div style="text-align:right"><a onclick="col_form('C',1,'I',0)"><img title="Agregar" src="images/add.png"></a></div>
                        <div id="eventos"><?=evento_lista()?></div>
                    </div>
                    <div id="tab-recurso">
                        <div style="float:left;width:450px">Recurso:<select id="recurso_tipo_id" name="recurso_tipo_id"><?=recurso_tipo_ddl(0)?></select><select id="recurso_id" name="recurso_id"><?=recurso_ddl(0,0)?></select></div><div style="float:right;width:20px"><a onclick="col_form('R',1,'I',0)"><img title="Agregar" src="images/add.png"></a></div>                        
                        <div id="recurso"><?=recurso_lista($_REQUEST['fecha'])?></div>
                    </div>
                 </div>
            </td>
  </tr>
</table>
</form>
</div>
</div>
<script>
$(document).ready(function(){
    $("#recurso_tipo_id").change(function(event){
        $("#recurso_id").load("ajax.php?a=recurso_ddl&tipo="+$(this).val());
    });
    
    $('#ui-tabs').tabs({
        selected:  $("#tab").val(),
        select: function(event, ui){
        $("#tab").val(ui.index);
        }   
    });
    
});    

 

$.ajax({
    type:"POST",
    url: 'ajax.php?a=evento&accion=E',    
    dataType: 'json',
    success: function(json){
        if(json){
            $( "#datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                onChangeMonthYear:function(year, month,obj){
                    //$('#eventos').load('ajax.php?a=evento&accion=F&fecha='+date);
                    //$('#recurso').load('ajax.php?a=recurso&accion=F&fecha='+date);
                },
                dateFormat:"yy-mm-dd",
                onSelect: function(date, inst) {
                    $('#fecha').val(date);
                    $('#eventos').load('ajax.php?a=evento&accion=F&fecha='+date);
                    $('#recurso').load('ajax.php?a=recurso&accion=F&fecha='+date);
                },
                beforeShowDay: function(day){
                    for (i = 0; i < json.length; i++) {
                        var dia=day.getFullYear()+'-'+(day.getMonth()+1)+'-'+day.getDate();
                        //alert(json[i]+' / '+dia);
                        if(dia==json[i]){
                            
                            return [true, "locked"];
                        }
                        
                    }
                    return [true, ""];//enable all other days
                        
                }
            });
        }
    }
 });
 
 function col_form(tipo,sw,accion,id){
    var form;    
        switch(tipo){
            case 'C': // Calendario
                form="calendario_form";
                titulo="Calendario";
                alto=350;
                break;
            case 'R': // Recurso
                form="recurso_form";
                titulo="Recursos";
                alto=400;
                break;
        }
	switch(sw){
		case 1:
			$('#dialog').remove();
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="'+form+'.php?a='+accion+'&id='+id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
			$('#dialog').dialog({
			title: titulo,
			bgiframe: false,
			width: 500,
			height: alto,
			resizable: false,			
			modal: false
	});
			break;
		case 0:
                        document.form1.submit();
			
			break;
	}
	
};

$("#recurso_tipo_id").change(function(event){
    $('#recurso').load('ajax.php?a=recurso&accion=F&fecha='+$('#fecha').val()+'&recurso_tipo_id='+$(this).val());
});
$("#recurso_id").change(function(event){
    $('#recurso').load('ajax.php?a=recurso&accion=F&fecha='+$('#fecha').val()+'&recurso_tipo_id='+$('#recurso_tipo_id').val()+'&recurso_id='+$(this).val());
});
    
  </script>