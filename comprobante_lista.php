<?php
if($_GET['a']>''){
	if($_GET['a']=='C'){		
		$nro=comp_nro(0,'');
		$id=(int)substr($nro,-6); 		
		cp_compras::cp_copy($_GET['id'],'I',$nro);//Duplicar
		cp_compras::cp_copy($_GET['id'],'D',$id);//Detalle
	}else{
		cp_compras::cp_edit($_GET['id'],$_GET['a']);
	}
}
?>
<script language="javascript">
function nuevo(){
	//var local=document.form1.local_id.value;
	//var tipo=document.form1.cp_tipo_id.value;
	//location.href='index.php?menu=comprobante_edit&id=0&a=I&local_id='+local+'&cp_tipo_id='+tipo;
}
function EliminarCP(id,nro){
	if(confirm("Desea anular el comprobante nro. '"+nro+"'")){
		document.form1.id.value=id;
		document.form1.a.value='A';
		document.form1.submit();	
	}
}

function checkall(v){	
	var c=document.getElementsByTagName('input');
	for(x in c){
		if(c[x].type=='checkbox'){
			c[x].checked=v;
		}
	}
}


function duplicar(){
	var id='';	
		controles=document.getElementsByTagName('input');
		chk=[];
		for(x=0;x<controles.length;x++){
			if(controles[x].type=='checkbox' && controles[x].checked){
				chk[chk.length]=controles[x].id;
			}
		}
		id=chk.join(',');
		if(chk.length==1){			
			if(confirm("Desea duplicar el comprobante nro. '"+document.getElementById('nro_'+id).value+"'")){
				document.form1.id.value=id;
				document.form1.a.value='C';
				document.form1.submit();	
			}			
		}else{
			alert('Debe seleccionar un comprobante');
		}		
}

</script>
<form action="index.php?menu=comprobante_lista" name="form1" method="post">
<input type="hidden" name="a">
<input type="hidden" name="id">
<input type="hidden" name="local_id" value="1" />
<div class="box">
	<div class="heading">
    	<h1>Comprobantes</h1>
		<div class="option">
		<select name="cp_tipo_id" id="cp_tipo_id" onchange="document.form1.submit()">
	    <?
		$id=($_GET['cp_tipo_id']>0)?$_GET['cp_tipo_id']:$_GET['valor'];
		echo cp_tipo_ddl($id);
		?>
	    </select>
		Mes :<select name="mes_id" id="mes_id" onchange="document.form1.submit()"><?=mes_ddl($_GET['mes_id'])?></select>
	  	</div>
    </div>	
    <div class="content">
	<table class="list">
		<thead>
        <tr>
          <td>Fecha</td>
          <td>RUC</td>
          <td>Proveedor</td>
          <td>Concepto</td>
          <td align="center">SubTotal</td>
          <td align="center">IGV</td>
          <td align="center">Total</td>
          <td>&nbsp;</td>
        </tr>
		</thead>
        <tr>
          <td><input name="textfield" type="text" size="12" /></td>
          <td><input name="textfield2" type="text" size="15" /></td>
          <td><input type="text" name="textfield3" /></td>
          <td><input type="text" name="textfield4" /></td>
          <td><input name="textfield5" type="text" size="6" /></td>
          <td><input name="textfield6" type="text" size="6" /></td>
          <td><input name="textfield7" type="text" size="6" /></td>
          <td>
		  <div class="buttons">
			<a href="#" onclick="nuevo();" class="button icon add"><span>Nuevo</span></a>
			<a href="#" onclick="duplicar();" class="button icon newwin"><span>Detalle</span></a>	
                  </div>
		  </td>
        </tr>
      </table>
    <?=cp_lista_ventas(1,$_GET['valor']);?>  
    </div>
</div>
</form>