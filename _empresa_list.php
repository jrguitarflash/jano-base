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
</script>
<form name="form1" action="index.php?menu=empresa_list" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<div class="box">
	<div class="heading">
    	<h1>Empresa</h1>
	  	<div class="buttons">
			<a class="button" href="index.php?menu=empresa_form&a=I&id=0&a=I&perfil=<?=(int)$_GET['perfil']?>"><span style="width:50px;">Insertar</span></a>
			<a class="button"><span style="width:50px;">Eliminar</span></a>
			<a class="button" onclick="GetIds();//abrir('pers_perfil.php?ids=','P',300,150);"><span style="width:50px;">Perfil</span></a>
		</div>
    </div>
    <div class="content">
    <?=empresa_lista();?>  
    </div>
</div>
</form>