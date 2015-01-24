<?php
if($_POST['id']>''){
	tc::edit('D',$_POST['id']);	
}
?>
<script type="text/javascript">
function Delete(){		
    var selectedItems = new Array();	
    $("input[@name='selected[]']:checked").each(function(){
            //alert($(this).val())
            if($(this).val()>0){
            selectedItems.push($(this).val());
            }
    });

    $("#id").val(selectedItems);    
    if($("#id").val()>''){
        if(confirm("Desea eliminar?.")){
            $("#form1").submit();
        }        
    }else{
        alert("Seleccione registros.");
    }
		
	

}
</script>
<div class="box">
	<div class="heading">
    	<h1>Buzón - Lista</h1>
	  	<div class="buttons">
			<a onclick="Delete();" class="button"><span>Eliminar</span></a>			
		</div>
    </div>
    <div class="content">
    <form name="form1" id="form1" action="index.php?menu=tc_list" method="post">
    <input type="hidden" id="id" name="id">
    <?=buzon_lista();?>
    </form>
    </div>
</div>