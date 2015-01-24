<?php
$tbl_id=$_GET['tbl_id'];
if($_POST['mail_id']>''){ // Mandar Mail
    persona::edit('M',$_POST['mail_id']);
    echo "<script>window.location.href='index.php?menu=mensaje_form'</script>";
}
if($_POST['id']>''){ // Eliminar
    tabla::tbl_edit_tbl($tbl_id,$_REQUEST['id'],'D');
    //persona::edit('D',$_POST['id']);	
}
if($_POST['accion']=="ADDCOT"){
    $id=explode(",",$_POST['ids']);
    for($c=0;$c<count($id);$c++){
        switch($_REQUEST["destino_tipo"]){
            case 1:
                cotizacion::cot_prod($_POST['destino_valor'],$id[$c]);
                break;
            case 2:
                importacion::edit($_POST['destino_valor'],$id[$c]);
                break;
        }
        //echo $_POST['destino_valor']." - ".$id[$c]."<br>";
    }
    
    switch($_REQUEST["destino_tipo"]){
        case 1:
            echo "<script>window.location.href='index.php?menu_id=".(int)$_REQUEST['menu_id']."&menu=persona_form&tbl_id=67&id=".$_POST['destino_valor']."&a=U&cotizacion_id=".$_POST['destino_valor']."#tab-Detalle'</script>";
            break;
        case 2:
            echo "<script>window.location.href='index.php?menu_id=".(int)$_REQUEST['menu_id']."&menu=persona_form&tbl_id=106&id=".$_POST['destino_valor']."&a=U&imp_proforma_id=".$_POST['destino_valor']."#tab-Equipos'</script>";
            break;
    }
        
    
}
?>
<script type="text/javascript">
function SendMail(){

	
		var selectedItems = new Array();
		
		$("input[@name='selected[]']:checked").each(function(){
			//alert($(this).val())
			if($(this).val()>1){
                            selectedItems.push($(this).val());
			}
		});
		
		$("#ids").val(selectedItems);
		if($("#ids").val()>''){
			$("#form1").submit();
		}else{
			alert("Seleccione registros.");
		}
		
	

}
function Packing(){
    var selectedItems = new Array();		
    $("input[@name='selected[]']:checked").each(function(){
        //alert($(this).val())
        if($(this).val()>1){
        selectedItems.push($(this).val());
        }
    });

    $("#ids").val(selectedItems);
    if($("#ids").val()>''){
        alert($("#ids").val());
            //$("#form1").submit();
    }else{
        alert("Seleccione registros.");
    }
}
function Delete(id){
    if(confirm('Desea eliminar este registro?.')){
       $('#id').val(id); 
       $('#form1').submit();     
    }
}
function AddCot(){
    var selectedItems = new Array();		
    $("input[@name='selected[]']:checked").each(function(){
        //alert($(this).val())
        if($(this).val()>''){
        selectedItems.push($(this).val());
        }
    });
    $("#ids").val(selectedItems);
    if($("#ids").val()>''){
        //alert($("#ids").val());
        $("#accion").val("ADDCOT");
        $('#dialog').remove();
        var html='<table width="100%" >';
        html+='<tr><td width="25%" align="right">Destino:</td><td><select style="width:250px" name="destino_id" id="destino_id" onchange="Destino(this.value);"><option value="1">Cotización para Cliente</option><option value="2">Solicitud de Proforma de Importación</option></select></td></tr>';
        html+='<tr><td width="25%" align="right">NRO:</td><td><select style="width:250px" name="destino_nro" id="destino_nro"><?=cotizacion_ddl()?></select></td></tr>';
        html+='<table>';
        $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;">'+html+'</div>');
	$('#dialog').dialog({
            title: 'Enviar a ',
            bgiframe: true,
            width: 400,
            height: 150,
            resizable: false,
            modal: true,
            buttons: {
                "Aceptar": function() {
                    $("#destino_tipo").val($("#destino_id").val());
                    $("#destino_valor").val($("#destino_nro").val());
                    $("#form1").submit();                    
                },
                "Cancelar": function() {
                        $(this).dialog('close');
                }		
            }		
        });           
    }else{
        alert("Seleccione registros.");
    }
}

function Destino(destino_id){
    $("#destino_nro").load("ajax.php?a=destino&id="+destino_id);
}
</script>
<form name="form1" id="form1" action="index.php?menu_id=<?=(int)$_REQUEST['menu_id']?>&menu=personas&tbl_id=<?=(int)$_GET['tbl_id']?>" method="post">
<input type="hidden" name="destino_tipo" id="destino_tipo">    
<input type="hidden" name="destino_valor" id="destino_valor">
<input type="hidden" name="menu_id" id="menu_id" value="<?=$_REQUEST['menu_id']?>">
<input type="hidden" name="id" id="id">
<input type="hidden" name="accion" id="accion">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<input type="hidden" name="order" id="order">
<input type="hidden" name="sort" id="sort">
<input type="hidden" name="qry" id="qry">
<input type="hidden" name="criterio" id="criterio">
<input type='hidden' name='ids' id="ids">
<input type="hidden" name="flow" value="<?php echo $_SESSION['operador']['flow']?>">
<div class="box">    
	<div class="heading">
    	<?=tbl_form_cab('L',$tbl_id,0)?>		
	  	<div class="buttons">
		<?=tbl_filtro($tbl_id)?>
			Buscar: <input id="filtro" name="filtro" size="30" type="text" value="<?//=$_SESSION['operador']['key']?>" />&nbsp;<a href="#" onclick="document.form1.submit();"><img src="images/buscar.png" title="Buscar"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <? echo tbl_opcion($tbl_id,'personas_edit','&perfil='.(int)$_GET['perfil'])?>
			<!--<a href="index.php?menu=personas_edit&a=I&perfil=<?=(int)$_GET['perfil']?>&empresa_id=<?=(int)$_GET['empresa_id']?>" class="button"><span style="width:50px;">Insertar</span></a>
			<a class="button" onclick="GetIds();//abrir('pers_perfil.php?ids=','P',300,150);"><span style="width:50px;">Perfil</span></a>-->
		</div>
    </div>
    <div class="content">
	<? echo tbl_criterio($tbl_id)?>
        <div id="lista_<?=$tbl_id?>">
        <?=tbl_lista($tbl_id);?>
        </div>
	<!--<div class="pagination">
		<div class="links">
		<?php echo paginacion();?>
		</div>
		<div class="results">
		<a href="#" onClick="ordenar('');return false;" title="Ayuda"><img src='images/ayuda.png'></a><img src="images/split_img.png">
	<a href="#" onClick="info('ajax.php?key=info_tabla&id=1');" title="Exportar"><img src="images/pdf.png"></a><img src="images/split_img.png">
	<a title="Exportar" href="exportar.php<?php echo substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'?'));?>"><img src="images/excel.png"></a>
		</div>
	</div>-->


	
    </div>
  </div>
<script type="text/javascript"><!--
document.form1.filtro.focus();
//--></script> 
</form>

<div id="dialog" style="display:none;">

</div>
