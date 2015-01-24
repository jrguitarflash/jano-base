<?php
if($_POST['accion']=='Z'){
	tabla::edit('Z',0);
	echo '<div class="success">Sincronización completada.</div>';
}

?>
<script language="javascript">
function GetIds(){ 
var c;
elem=document.form1.elements;
    col=new Array;
    for(x=0;x<elem.length;x++){
        if(elem[x].type=='checkbox' && elem[x].checked){			
            col.push(elem[x].value);
        }
    }	
    c=col.join(',');	
    if(c>''){
			//window.location='m_ssc.php?menu=3&form=inc_union&a=U&id='+c;
			abrir('emp_perfil.php?ids='+c+'&perfil='+document.form1.perfil.value,'P',300,150);		        
    }else{
        alert("Seleccione registros.");
    }

}
function sincronizar(){
	$('#accion').val('Z');
	$('#form1').submit();
}
</script>
<form name="form1" id="form1" action="index.php?menu=tabla_list" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="accion" id="accion" />
<div class="box">
	<div class="heading">
    	<h1>Tablas</h1>
	  	<div class="buttons">
			<a class="button" onclick="sincronizar();"><span style="width:50px;">Sincronizar</span></a>
			<a class="button" href="index.php?menu=tabla_form&a=I&id=0&a=I"><span style="width:50px;">Insertar</span></a>
			<a class="button"><span style="width:50px;">Eliminar</span></a>			
		</div>
    </div>
    <div class="content">
    <?=tabla_lista();?>  
    </div>
</div>
</form>