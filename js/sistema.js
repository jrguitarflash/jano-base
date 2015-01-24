function Calendario(control){
    $(document).ready(function(){
        $('#'+control).datepicker({
            showOn: "button",
            buttonImage: "images/cal.png",
            buttonImageOnly: true,
            //yearRange:"2000:c+0",
            yearRange:"c-80:c+5", 
            //minDate:"-5Y",
            //maxDate:"+5Y",
            dayNames: ['Domingo', 'Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesShort:['Dom', 'Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin:['Dom', 'Lun','Mar','Mie','Jue','Vie','Sab'],
            monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"],
            monthNamesShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"],
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd",
            showButtonPanel: true
        });
        $('#ui-datepicker-div').draggable({
            scroll: false,
            cursor: "move"
        });
    });
}

function Calendario2(control){
    $(document).ready(function(){
        $('#'+control).datepicker({
            showOn: "button",
            buttonImage: "images/cal.png",
            buttonImageOnly: true,
            yearRange:"c-80:c+0",
            dayNames: ['Domingo', 'Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesShort:['Dom', 'Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin:['Dom', 'Lun','Mar','Mie','Jue','Vie','Sab'],
            monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"],
            monthNamesShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"],
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd",
            showButtonPanel: true,
            onSelect: function(dateText, inst) {
                document.form1.submit();
            }
        });
        $('#ui-datepicker-div').draggable({
            scroll: false,
            cursor: "move"
        });
    });
}

function Calendario3(control){
    $(document).ready(function(){
        $('#'+control).datepicker({
            showOn: "button",
            buttonImage: "images/cal.png",
            buttonImageOnly: true,
            //yearRange:"2000:c+0",
            yearRange:"c-80:c+5", 
            //minDate:"-5Y",
            //maxDate:"+5Y",
            dayNames: ['Domingo', 'Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesShort:['Dom', 'Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin:['Dom', 'Lun','Mar','Mie','Jue','Vie','Sab'],
            monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"],
            monthNamesShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"],
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd",
            showButtonPanel: true
        });
        $('#ui-datepicker-div').draggable({
            scroll: false,
            cursor: "move"
        });
    });
}

function Imprime(capa,ancho,alto){
    var posicion_x;
    var posicion_y;
    posicion_x=(screen.width-ancho)/2;
    posicion_y = (screen.height - alto)/2;
    var contenido = document.getElementById(capa).innerHTML;
    ventana = window.open("print_page.htm", "ERP", "left=" + posicion_x + ",top=" + posicion_y + ",width=" + ancho + ",height=" + alto + ",toolbar=0,scrollbars=1,status=0,resizable=1");
    //ventana.document.open();
    ventana.document.write("<html><head><title>MP</title>");
    ventana.document.write("<link rel='stylesheet' href='styles/print.css'/></head>");
    ventana.document.write("<body>");
    ventana.document.write("<div class='Cabecera'>Sistema de Gestión Empresarial <br><b>TEC-ERP v.1.0</b></div>");
    ventana.document.write("<div>")
    ventana.document.write(contenido);
    ventana.document.write("</div>");
    ventana.document.write("</body></html>")
    ventana.document.close();    
    ventana.print();
    ventana.focus();
}

function CargarImagen(sw,ruta,id,control,file){
	switch(sw){
            case 1:
		$('#dialog').remove();
		$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="upload_image.php?control='+control+'&ruta='+ruta+'&id='+id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
		$('#dialog').dialog({
                    title: 'Cargar Imagen',
                    bgiframe: false,
                    width: 350,
                    height: 150,
                    resizable: false,
                    modal: true		
                });
		break;
            case 0:	
                //alert(ruta+file);
		$("#img_"+control).attr("src",ruta+file);
                $("#"+control).attr("value",ruta+file);
		$('#dialog').dialog('close');
		break;
	}
	
}

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
		abrir('pers_perfil.php?ids='+c+'&perfil='+document.form1.perfil.value,'P',300,150);
    }else{        
        alert("Seleccione registros.");
    }

}

function sql_cond(campo,cond,valor,operador){
	var sql='';
	switch(cond){
		case '%_%':sql=" like '%"+valor+"%' ";break;
		case '%_':sql=" like '%"+valor+"' ";break;
		case '_%':sql=" like '"+valor+"%' ";break;
		case '=':sql="='"+valor+"'";break;
		case '!=':sql="!='"+valor+"' ";break;
		case '>':sql=">'"+valor+"' ";break;
		case '<':sql="<'"+valor+"' ";break;
	}
			
	if(campo>''){
		sql=operador+' '+campo+sql;
	}else{
		sql='';
	}
		
	return sql;
}

function sql_criterio(campo,cond,valor,operador){	
	var sql='';
	switch(operador){
		case 'AND':operador=" Y ";break;
		case 'OR':operador=" O ";break;
		case 'NOT':operador=" Y NO IGUAL ";break;		
	}
	switch(cond){
            case '%_%':cond=" Contiene ";break;
            case '%_':cond=" termina con ";break;
            case '_%':cond=" comienza con ";break;
            case '=':cond=" igual a ";break;
            case '!=':cond=" no igual a";break;
            case '>':cond=" mayor que ";break;
            case '<':cond=" menor que ";break;
	}
		
	if(campo>''){
		sql=operador+' '+campo+cond+"'"+valor+"'";
	}else{
		sql='';
	}
		
	return sql;
}

function BusquedaAvanzada(sql){
    $('#qry').val(sql);
    document.form1.submit();
}

function Search(id,frm){
	//$('#dialog').load('ajax.php?a=tbl_buscar&id='+id).dialog({
        $('#dialog').remove();
        $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe id="searching" src="'+frm+'.php?tbl_id='+id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	$('#dialog').dialog({
    	title: 'Búsqueda Avanzada',
        bgiframe: true,
        width: 650,
        height: 450,
        resizable: false,
        modal: true,
        buttons:{
            "Buscar": function(){
//                sql=sql_cond($('#cpo1').val(),$('#cond1').val(),$('#val1').val(),'AND');
//                sql+=sql_cond($('#cpo2').val(),$('#cond2').val(),$('#val2').val(),$('#oper2').val());
//                sql+=sql_cond($('#cpo3').val(),$('#cond3').val(),$('#val3').val(),$('#oper3').val());
//                criterio=sql_criterio($('#cpo1 option:selected').text(),$('#cond1').val(),$('#val1').val(),'AND');
//                criterio+=sql_criterio($('#cpo2 option:selected').text(),$('#cond2').val(),$('#val2').val(),$('#oper2').val());
//                criterio+=sql_criterio($('#cpo3 option:selected').text(),$('#cond3').val(),$('#val3').val(),$('#oper3').val());
//                $('#criterio').val(criterio);
//                $('#qry').val(sql);
//                document.form1.submit();
            var $f=$("#searching");
            $f[0].contentWindow.Busqueda(id);
            },
            "Cancelar": function(){
                    $(this).dialog('close');
            }
        }		
    });
}

function orden(campo){
	document.form1.order.value=campo;
	document.form1.submit();
}

function Extranet(opcion){
    form=document.form_login;
    switch(opcion){
        case 1: // Joomla (Comunidad Virtual - Empresa)
            form.action="../joomla/index.php";
            form.submit();
            break;
        case 2: // Oscommerce (Catalogo de Productos)
            form.action="../oscommerce/admin/login.php?action=process";
            form.submit();
            break;
        case 3: // Dotproject (Gestion de  Proyectos)
            form.action="../dotproject/index.php";
            form.submit();
        case 4:
            // Sugar CRM (CRM de Clientes)
            break;
    }
}

function form_popup(sw,accion,ancho,alto,id,tabla_id,form,padre_id,param){
    
    var formulario=(form>'')?form:'tbl_form_popup.php';
	switch(sw){
		case 1:
			$('#dialog').remove();
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="'+formulario+'?a='+accion+'&id='+id+'&tbl_id='+tabla_id+param+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="no"></iframe></div>');	
			$('#dialog').dialog({
                            title: "Ficha : "+tabla_id,		
                            bgiframe: false,
                            width: ancho,
                            minHeight: alto,
                            height: alto,
                            resizable: false,
                            close: function (event, ui) {
                                //alert('ajax.php?a=tbl_lista&id='+id+'&tbl_id='+padre_id+'&tabla_id='+tabla_id+param);
                                $('#lista_'+tabla_id).load('ajax.php?a=tbl_lista&id='+id+'&tbl_id='+padre_id+'&tabla_id='+tabla_id+param);
                                //console.log('ajax.php?a=tbl_lista&id='+id+'&tbl_id='+padre_id+'&tabla_id='+tabla_id+param);
                                //"ajax.php?a=tbl_lista&id=0&tbl_id=67&tabla_id=65&cotizacion_id=503&producto_id=0"
                                
                            },	
                            modal: false		

                        });

			break;
		case 0:
                    $('#dialog').dialog('close');
                    //$('#lista_'+tabla_id).load('ajax.php?a=tbl_lista&id='+id+'&tbl_id='+padre_id+'&tabla_id='+tabla_id+param);
//                        if($("#form1").length){
//                            $("#form1").submit();
//                        }else{
//                            window.location.reload();
//                        }
			break;
	}
	
};

function form_ficha(accion,tipo_control,col_id,tabla_id,control,dependencia,ancho,alto){
    var valor='';
    var param='';    
    valor=$('#'+dependencia).val();
    param=(dependencia>'')?'&'+dependencia+'='+valor:'';
    $('#dialog').remove();
    $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="tbl_form_ficha.php?a='+accion+'&col_id='+col_id+'&tabla_id='+tabla_id+'&control='+control+param+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="no"></iframe></div>');
    $('#dialog').dialog({
        title: "Ficha : "+tabla_id,
        bgiframe: false,
        width: ancho,
        height: alto,
        resizable: false,
        close:function (event, ui){
            //alert($('#'+dependencia).val());
            //alert('ajax.php?a=tbl_lista&id='+id+'&tbl_id='+padre_id+'&tabla_id='+tabla_id+param);
            switch(tipo_control){
                case 'LST':
                    
                    $('#'+control).load("ajax.php?a=select&col_id="+col_id+"&valor="+valor);
                    break;
            }
            
        },	
        modal: true
    });			
	
};

function Accion(accion,ancho,alto,form,padre_id,tbl_id,id,menu_id,titulo,param){
    //if(padre_id>0 && id)
    var parametros=(param>"")?"&"+param:"";
    //alert(parametros);
    switch(accion){
        case 'U': 
        case 'I':
            if(padre_id>0){                
                form_popup(1,accion,ancho,alto,id,tbl_id,form,padre_id,parametros);
            }else{
                //alert(frm);
                window.location.href="index.php?menu_id="+menu_id+"&menu="+form+"&tbl_id="+tbl_id+"&id="+id+"&a="+accion+parametros;
            }
            break;
        case 'M':
            
            break;
        case 'D': //
            if(padre_id>0){
                //alert('ajax.php?a=tbl_lista&accion=D&id='+id+'&tbl_id='+padre_id+'&tabla_id='+tbl_id+parametros);
                
                if(confirm('Desea eliminar este registro?.')){
                    $('#lista_'+tbl_id).load('ajax.php?a=tbl_lista&accion=D&id='+id+'&tbl_id='+padre_id+'&tabla_id='+tbl_id+parametros);
                }
            }else{
                if(confirm('Desea eliminar este registro?.')){
                    $('#id').val(id); 
                    $('#form1').submit();     
                }
            }
            break;          
    }
}


function OpenMapa(sw,id){
	switch(sw){
            case 1:
		$('#dialog').remove();
		$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="mapa.php?id='+id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
		$('#dialog').dialog({
                    title: 'Mapa',
                    bgiframe: false,
                    width: 800,
                    height: 550,
                    resizable: false,
                    modal: true
                });
		break;
            case 0:
		$('#dialog').dialog('close');
		break;
	}
	
}

function Georeferencia(){
    window.open("http://maps.google.es/maps/myplaces?vpsrc=6&ctz=300&abauth=463971d1:BtTQk4n_uZrG50KNm_MwaV9MNMg&vps=4&ei=p9N1T8UtorrIBbXdjZgI&num=10");
}

function ProdCalculo(id){
//        switch(sw){
//            case 1:
                $('#dialog').remove();
                $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="prod_calculo.php?id='+id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
                $('#dialog').dialog({
                    title: "Calculo estandar de Importación",
                    bgiframe: false,
                    width: 600,
                    height: 480,
                    resizable: false,
                    modal: false,
                    close: function (event, ui) {
                        //alert('OK');
                        //window.document.reload();
                    }
                });
//		break;
//            case 0:
//                $('#dialog').dialog('close');
//		break;
//	}
	
};

function GrabarLista(tabla_id,param){
    var parametros=(param>"")?"&"+param:"";
    //alert(parametros);
    var Data = {};
    $('#lista_'+tabla_id+' input:not(:checkbox)').each(function(){
        if($(this).val()>''){
            Data[$(this).attr('id')] = $(this).val();
        }
    });
    console.log(tabla_id+parametros);
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=grabar_lista&tabla_id='+tabla_id+parametros,
        data:Data,
        dataType: 'json',
        success: function(data) {
            alert(data.mensaje);
        }
    });
}

function SubirArchivo(ruta,operador_id,control){
    new AjaxUpload('#file_'+control, {
            action: 'ajax.php?a=subir_archivo',
            name:'file',
            autoSubmit: true,
            responseType: 'json',
            onChange: function(file, ext) {
                $('#file_'+control).html(file);
            },
            onSubmit : function(file , ext){
                //Paso de paramentro adicionales (POST)
		this.setData({
                    operador_id:operador_id,
                    ruta:ruta
                    
		});
                $('#file_'+control).append('<img src="images/loading.gif" id="loading" style="padding-left: 5px;" />');
            },
            onComplete: function(file, json){
                if(json.success){
                    $('#loading').remove();
                    $('#'+control).val(json.file);
                    alert(json.success);
                    //$('#file_source').html("Seleccione archivo");
                    //$('#upload_file').dialog( "close" );
		}
		if (json.error) {
                    $('#loading').remove();
                    alert(json.error);
		}
            }
    });
}

function CotDetalle(accion){
    //alert('Cerrando..');
    //window.location.href="cot_traza.php";
    //window.opener.$('#dialog').dialog('close');
    //window.opener.$('#dialog').remove();
    window.parent.$('#dialog').dialog('close');
    //window.parent.$('#dialog').remove();
    window.parent.$('#content').prepend('<div id="dialog2" style="padding: 3px 0px 0px 0px;"><iframe src="cot_traza.php" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
    window.parent.$('#dialog2').dialog({
        title: "Otro",
        bgiframe: false,
        width: 700,
        height: 500,
        resizable: false,
        close: function (event, ui) {
            
        },
        modal: true
    });
}

function ImprimirPDF(objeto){
    if(navigator.appName != 'Microsoft Internet Explorer'){
        window.frames[objeto].focus(); 
        window.frames[objeto].print(); 
    }else{
        window.frames[objeto].focus(); 
        window.frames[objeto].print(); 
        
    }
}

function GenerarCotizacionPDF(id){    
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=genera_prof&tipo=C',
        data:'id='+id,
        cache:false,
        dataType: 'json',
        success: function(data){
                var file=data.mensaje+'?'+Math.random();
                $('#dialog').remove();
                $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe name="documento" id="documento" src="'+file+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
                $('#dialog').dialog({
                    title: "Vista previa : Cotización",
                    width: $(document).width()-20,
                    height: 600,
                    resizable: false,
                    modal: false,
                    buttons:{
                        "Enviar por Correo": function(){
                            $('#documento').attr('src','');
                            $('#correo').remove();
                            $('#content').prepend('<div style="z-index:1" id="correo"></div>');
                            $('#correo').load('ajax.php?a=enviar_correo_pdf&accion=F&tipo=C&id='+id).dialog({
                                title: "Enviar Correo",
                                width: 450,
                                minHeight: 270,
                                resizable: true,                                
                                modal:false,
                                close: function (event, ui) {
                                    $('#documento').attr('src',file);
                                },
                                buttons: {
                                    "Enviar": function(){
                                        var para = new Array();		
                                        $("input[name='mail_para[]']:checked").each(function(){                                                
                                           // if($(this).val()>1){
                                                para.push($(this).val());
                                            //}
                                        });
                                        //if(para>''){
                                        	console.log(para.length);
                                        	for (i=0;i<para.length;i++) 
                                        	{
                                        		console.log(para[i]);
                                        	}
                                        	if(para.length>0){
                                            $.ajax({
                                                type:"POST",
                                                url: 'ajax.php?a=cot_mail',
                                                data:"mail_para="+para+"&mail_asunto="+$('#mail_asunto').val()+"&mail_mensaje="+$('#mail_mensaje').val()+"&mail_adjunto="+data.mensaje,
                                                dataType: 'json',
                                                success: function(json){
                                                    if(json.result){
                                                        alert(json.result);
                                                        $("#correo").dialog('close');
                                                    }

                                                }
                                            });
                                        }else{
                                            alert('En "Para" debe marcar un contacto.')
                                        }
                                    },
                                    "Cancelar": function() {
                                        $(this).dialog('close');
                                    }
                                }
                            });
                        },
                        "Imprimir": function(){
                            ImprimirPDF('documento');
                        },
                        "Cerrar": function(){
                                $(this).dialog('close');
                        }
                    }
                });
        }
    });
}

function GenerarProformaPDF(id){    
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=genera_prof&tipo=P',
        data:'id='+id,
        dataType: 'json',
        success: function(data){                
                var file=data.mensaje+'?'+Math.random();
                $('#dialog').remove();
                $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;z-index:0"><iframe name="documento" id="documento" src="'+file+'" style="padding:0; margin: 0;display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
                $('#dialog').dialog({
                    title: "Vista previa : Solicitud de Cotización",
                    bgiframe: true,
                    width: 750,
                    height: 600,
                    resizable: true,
                    modal: false,
                    buttons:{
                        "Enviar por Correo": function(){
                            $('#documento').attr('src','');
                            $('#correo').remove();
                            $('#content').prepend('<div style="z-index:1" id="correo"></div>');
                            $('#correo').load('ajax.php?a=enviar_correo_pdf&accion=F&tipo=P&id='+id).dialog({
                                title: "Enviar Correo",
                                bgiframe: true,
                                width: 450,
                                minHeight: 270,                                
                                resizable: false,
                                modal:false,
                                close: function (event, ui) {
                                    $('#documento').attr('src',file);
                                },
                                buttons: {                                    
                                    "Enviar": function(){                                        
                                        $.ajax({
                                            type:"POST",
                                            url: 'ajax.php?a=enviar_correo_pdf&accion=S',
                                            data:"mail_para="+$('#mail_para').val()+"&mail_asunto="+$('#mail_asunto').val()+"&mail_mensaje="+$('#mail_mensaje').val()+"&mail_adjunto="+data.mensaje,
                                            dataType: 'json',
                                            success: function(json) {
                                                if(json.result){
                                                    alert(json.result);
                                                    $("#correo").dialog('close');
                                                }
                                                
                                            }
                                        });
                                    },
                                    "Cancelar": function() {
                                        $(this).dialog('close');
                                    }
                                }
                            });
                        },
                        "Imprimir": function(){
                            ImprimirPDF('documento');
                        },
                        "Cerrar": function(){
                                $(this).dialog('close');
                        }
                    }
                });
        }
    });
}

function GenerarOCPDF(id){
    
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=genera_prof&tipo=OC',
        data:'id='+id,
        dataType: 'json',
        success: function(data){
                //alert(data.mensaje);
                var file=data.mensaje+'?'+Math.random();
                $('#dialog').remove();
                $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe name="documento" id="documento" src="'+file+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
                $('#dialog').dialog({
                    title: "Vista previa : O/C",
                    bgiframe: true,
                    width: $(document).width()-20,
                    height: 600,
                    resizable: false,
                    modal: false,
                    buttons:{
                        "Enviar por Correo": function(){
                            $('#documento').attr('src','');
                            $('#correo').remove();
                            $('#content').prepend('<div id="correo"></div>');
                            $('#correo').load('ajax.php?a=enviar_correo_pdf&accion=F&tipo=OC&id='+id).dialog({
                                title: "Enviar Correo",
                                bgiframe: true,
                                width: 450,
                                minHeight: 270,
                                resizable: false,
                                zIndex:3000,
                                modal:true,
                                close: function (event, ui) {
                                    $('#documento').attr('src',file);
                                },
                                buttons:{
                                    "Enviar": function(){
                                        //alert($('#mail_para').val());
                                        $.ajax({
                                            type:"POST",
                                            url: 'ajax.php?a=enviar_correo_pdf&accion=S',
                                            data:"mail_para="+$('#mail_para').val()+"&mail_asunto="+$('#mail_asunto').val()+"&mail_mensaje="+$('#mail_mensaje').val()+"&mail_adjunto="+data.mensaje,
                                            dataType: 'json',
                                            success: function(json){
                                                if(json.result){
                                                    alert(json.result);
                                                    $("#correo").dialog('close');
                                                }
                                            }
                                        });
                                    },                                    
                                    "Cancelar": function() {
                                        $(this).dialog('close');
                                    }
                                }
                            });
                        },
                        "Imprimir": function(){
                            ImprimirPDF('documento');
                        },
                        "Cerrar": function(){
                                $(this).dialog('close');
                        }
                    }
                });
        }
    });
}
/* Orden de Compra Local */
function GenerarOCLPDF(id){    
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=genera_prof&tipo=OCL',
        data:'id='+id,
        dataType: 'json',
        success: function(data){
                //alert(data.mensaje);
                $('#dialog').remove();
                $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe name="documento" src="'+data.mensaje+'?'+Math.random()+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
                $('#dialog').dialog({
                    title: "Vista previa : O/C",
                    bgiframe: true,
                    width: $(document).width()-20,
                    height: 600,
                    resizable: false,
                    modal: false,
                    buttons:{
                        "Enviar por Correo": function(){
                            //alert(data.mensaje);
                            $('#correo').remove();
                            $('#content').prepend('<div id="correo"></div>');
                            $('#correo').load('ajax.php?a=enviar_correo_pdf&accion=F&tipo=OCL&id='+id).dialog({
                                title: "Enviar Correo",
                                bgiframe: true,
                                width: 450,
                                minHeight: 270,
                                resizable: false,
                                modal:true,
                                buttons:{
                                    "Enviar": function(){
                                        //alert($('#mail_para').val());
                                        $.ajax({
                                            type:"POST",
                                            url: 'ajax.php?a=enviar_correo_pdf&accion=S',
                                            data:"mail_para="+$('#mail_para').val()+"&mail_asunto="+$('#mail_asunto').val()+"&mail_mensaje="+$('#mail_mensaje').val()+"&mail_adjunto="+data.mensaje,
                                            dataType: 'json',
                                            success: function(json){
                                                if(json.result){
                                                    alert(json.result);
                                                    $("#correo").dialog('close');
                                                }
                                            }
                                        });
                                    },                                    
                                    "Cancelar": function() {
                                        $(this).dialog('close');
                                    }
                                }
                            });
                        },
                        "Imprimir": function(){
                            ImprimirPDF('documento');
                        },
                        "Cerrar": function(){
                                $(this).dialog('close');
                        }
                    }
                });
        }
    });
}

function Importacion(id){
    if(id){
        //if(confirm('Desea enviar a importar los elementos seleccionados?.')){
        $.ajax({
            type:"POST",
            url: 'ajax.php?a=compras',
            data:"oc_id="+id,
            dataType: 'json',
            success: function(json) {
                if(json.result){
                    //alert(json.result);
                    $('#content').prepend('<div id="compras" style="padding: 3px 0px 0px 0px;">'+json.result+'</div>');
                    $('#compras').dialog({
                        title: "Compras Items",
                        bgiframe: true,
                        width: 300,
                        height:150,
                        minHeight:150,
                        resizable: false,
                        modal:true,
                        buttons: {
                            "Aceptar": function() {
                                $(this).dialog('close');
                            }
                        }
                    });
                }

            }
        });
        //}
    }
}

function getPage(page) {
	var urlHalves = String(document.location).toLowerCase();
	
	if (urlHalves){
            document.location.href=urlHalves+'&page='+page;
	}
	
	
}

function Enfocar(objeto){
    var c=0;    
    $('#tab-'+objeto+' input:text').each(function(){
        c++;
        if(c==1)$(this).focus();
        //Data[$(this).attr('id')] = $(this).val();
    });
}

function getAyuda(sw,id){
	switch(sw){
            case 1:
		$('#ayuda').remove();
		$('#content').prepend('<div id="ayuda" style="padding: 3px 0px 0px 0px;"><iframe src="ayuda.php?id='+id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
		$('#ayuda').dialog({
                    title: 'Ayuda',
                    bgiframe: false,
                    width: 550,
                    height: 350,
                    resizable: false,
                    modal: true		
                });
		break;
            case 0:
		$('#ayuda').dialog('close');
		break;
	}
	
}

function getGuia(sw,id){
	switch(sw){
            case 1:
		$('#ayuda').remove();
		$('#content').prepend('<div id="ayuda" style="padding: 3px 0px 0px 0px;"><iframe src="ayuda/guia'+id+'.htm" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
		$('#ayuda').dialog({
                    title: 'Guia de Usuario',
                    bgiframe: false,
                    width: 700,
                    height: 500,
                    resizable: false,
                    modal: true		
                });
		break;
            case 0:	                
		$('#ayuda').dialog('close');
		break;
	}
	
}

function GenerarOC(tabla_id){
    var selectedItems = new Array();		
    $("input[@name='selected[]']:checked").each(function(){
        //alert($(this).val())
        if($(this).val()!='on'){
        selectedItems.push($(this).val());
        }
    });
    $("#ids").val(selectedItems);
    if($("#ids").val()>''){
    var html='<table width="100%">';
    html+='<tr><td>&nbsp;Nro. O/C</td><td><input type="hidden" id="compras_id" name="compras_id"><input size="20" type="text" id="comp_nro" name="comp_nro"></td></tr>';
    html+='</table>';
    html+='<script language="javascript">'
    html+='$(document).ready(function(){'
    html+=' $("#comp_nro").autocomplete({'
    html+='     source: "ajax.php?a=search_oc",'
    html+='     minLength: 2,'
    html+='     select: function(event, ui) {'
    html+='         $("#compras_id").val(ui.item.id);'
    html+='         $("#comp_nro").val(ui.item.nro);'
    html+='         return false;'
    html+='     },'
    html+='     focus: function(event, ui){'
    html+='         $("#comp_nro").val(ui.item.nro);'
    html+='         return false;'
    html+='     }'
    html+=' });'
    html+='});'
    html+='</script>';
    $('#content').prepend('<div id="compras" style="padding: 3px 0px 0px 0px;">'+html+'</div>');
    $('#compras').dialog({
        title: "Generar Orden de Compra",
        bgiframe: true,
        width: 300,
        minHeight: 150,
        resizable: false,
        modal:true,
        buttons: {
            "Aceptar": function(){
                $.ajax({
                    type:"POST",
                    url: 'ajax.php?a=generar_oc',
                    data:"compras_id="+$('#compras_id').val()+"&comp_nro="+$('#comp_nro').val()+"&ids="+$("#ids").val(),
                    dataType: 'json',
                    success: function(json){
                        if(json.result){
                            window.location.href='index.php?menu=personas&tbl_id=90';
                            //alert(json.result);
                            //$("#correo").dialog('close');
                        }
                    }
                });
            },
            "Cancelar": function() {
                $(this).dialog('close');
            }
        }
    });
    }else{
        alert('Seleccione registros.');
    }
}

function CambiarMargen(cotizacion_id,control){
        //alert(control);
        $('#margen').remove();
        $('#content').prepend('<div id="margen" style="padding: 3px 0px 0px 0px;"><iframe id="prod_margen" src="prod_margen.php?id='+cotizacion_id+'&control='+control+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	$('#margen').dialog({
            title: 'Cambiar Margen',
            bgiframe: true,
            width: 400,
            height:180,
            resizable: false,
            modal: true,
            buttons: {
                "Aceptar": function(){
                    var $f=$("#prod_margen");
                    $f[0].contentWindow.Enviar();                    
                },
                "Cancelar": function() {
                    $(this).dialog('close');
                }		
            }		
        });
}

function Salir(){
    if(confirm("¿Desea salir del Sistema?.")){
        window.location.href='logout.php';
    }
}

function ProfVersion(id){
    if(confirm("¿Desea generar una nueva versión?.")){
        $.ajax({
            type:"POST",
            url: 'ajax.php?a=prof_version',
            data:"imp_proforma_id="+id,
            dataType: 'json',
            success: function(json){
                if(json.imp_proforma_id){
                    //alert(json.imp_proforma_id);
                    window.location.href='index.php?menu=persona_form&tbl_id=106&id='+json.imp_proforma_id+'&a=U&imp_proforma_id='+json.imp_proforma_id;
                }
            }
        });
    }
}

function CambiarVersion(tbl_id,id){
    if(confirm("¿Desea generar una nueva versión?.")){
        $.ajax({
            type:"POST",
            url: 'ajax.php?a=cambiar_version',
            data:"id="+id+"&tbl_id="+tbl_id,
            dataType: 'json',
            success: function(json){
                if(json.id){
                    //alert(json.pk);                    
                    window.location.href='index.php?menu_id='+$('#menu_id').val()+'&menu=persona_form&tbl_id='+tbl_id+'&id='+json.id+'&a=U&'+json.pk+'='+json.id;
                }
            }
        });
    }
}

function ProfCot(id){
    $('#dialog').remove();
    $('#content').prepend('<div id="dialog"></div>');
    //$('#dialog').dialog({
    $('#dialog').load('ajax.php?a=prof_cot&accion=FRM&id='+id).dialog({
        title: 'Generar Cotización',
        bgiframe: true,
        width: 350,
        height: 190,
        resizable: false,
        modal: true,
        buttons:{
            "Aceptar": function(){
                $.ajax({
                    type:"POST",
                    url: 'ajax.php?a=prof_cot&accion=G&id='+id,
                    data:"imp_proforma_id="+id,
                    dataType: 'json',
                    success: function(json){
                        if(json.imp_proforma_id){
                            //alert(json.imp_proforma_id);
                            // Ir a la ficha de Cotizacion
                            window.location='index.php?menu=persona_form&tbl_id=67&id='+json.imp_proforma_id+'&a=U&cotizacion_id='+json.imp_proforma_id;

                        }
                    }
                });
            },
            "Cancelar": function() {
                $(this).dialog('close');
            }
        }
    });
}

function EmpresaPerfil(tbl_id,reg_id){
    var selectedItems = new Array();
    $("input[@name='selected[]']:checked").each(function(){
        //alert($(this).val())
        if($(this).val()!='on'){
        selectedItems.push($(this).val());
        }
    });
    if(selectedItems>''){
        var html='<center><select id="emp_perfil_id" name="emp_perfil_id"><option value="1">Cliente</option><option value="2">Proveedor</option></select>';
        $('#emp_perfil').remove();
        $('#content').prepend('<div id="emp_perfil" style="padding: 10px 0px 0px 0px;">'+html+'</div>');
	$('#emp_perfil').dialog({
            title: 'Asignar Perfil',
            bgiframe: true,
            width:250,
            height:125,
            resizable: false,
            modal: true,
            buttons: {
                "Aceptar": function(){                    
                    $.ajax({
                        type:"POST",
                        url: 'ajax.php?a=emp_perfil',
                        data:"ids="+selectedItems+"&emp_perfil_id="+$("#emp_perfil_id").val(),
                        dataType: 'json',
                        success: function(json){
                            if(json.mensaje){
                                $("#emp_perfil").dialog('close');
                                alert(json.mensaje);
                                window.location.reload();
                                
                            }
                        }
                    });
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

function CalImportacion(tbl_id,reg_id){
    //alert(reg_id);
     $('#calculo').remove();
        $('#content').prepend('<div id="calculo" style="padding: 3px 0px 0px 0px;"><iframe id="prod_margen" src="calculo_importacion.php?tbl_id='+tbl_id+'&id='+reg_id+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="no"></iframe></div>');
	$('#calculo').dialog({
            title: 'Calculo de Importación y Nacionalización',
            bgiframe: true,
            width: 600,
            height:540,
            resizable: false,
            modal: true,
            close: function (event, ui) {
                //window.location.reload();
                $("#form1").submit();
            }
        });
}


function GeneraProforma(tbl_id){
    //alert(tbl_id);
    var selectedItems = new Array();
    $("input[@name='selected[]']:checked").each(function(){
        //alert($(this).val())
        if($(this).val()!='on'){
        selectedItems.push($(this).val());
        }
    });
    if(selectedItems>''){
        //alert(selectedItems);
        if(confirm("¿Desea Elaborar la Solicitud de Proforma a Fabricante/Proveedor?.")){
        $.ajax({
            type:"POST",
            url: 'ajax.php?a=gen_prof&tbl_id='+tbl_id,
            data:"ids="+selectedItems,
            dataType: 'json',
            success: function(json){
                if(json.imp_proforma_id){
                    //alert(json.sql);
                    $('#cot_descrip').val(json.sql);
                    // Ir a la ficha de Cotizacion
                   window.location='index.php?menu=persona_form&tbl_id=106&id='+json.imp_proforma_id+'&a=U&imp_proforma_id='+json.imp_proforma_id;
                }
            }
        });
        }
    }else{
        alert("Seleccione registros.");
    }
}

function Reasignar(tbl_id,reg_id){
    var items = new Array();
    $("input[@name='selected[]']:checked").each(function(){
        if($(this).val()!='on'){
            items.push($(this).val());
        }
    });
    if(items>''){
        $('#dialog').remove();
        $('#content').prepend('<div id="dialog"></div>');
        $('#dialog').load('ajax.php?a=reasignar&accion=F&tbl_id='+tbl_id+'&ids='+items).dialog({
            title: 'Reasignar',
            bgiframe: true,
            width: 350,
            height: 180,
            resizable: false,
            modal: true,
            buttons:{
                "Aceptar": function(){
                    if($('#operador_id_hacia').val()>0){
                        var tipo=$("input[name='tipo_asignacion']:checked").val();
                        $.ajax({
                            type:"POST",
                            url: 'ajax.php?a=reasignar&accion=S&tbl_id='+tbl_id,
                            data:"ids="+items+"&tipo="+tipo+"&operador_id_desde="+$('#operador_id_desde').val()+"&operador_id_hacia="+$('#operador_id_hacia').val(),
                            dataType: 'json',
                            success: function(json){
                                if(json.mensaje){
                                    alert(json.mensaje);
                                    // Ir a la lista
                                    //window.location='index.php?menu=persona_form&tbl_id=106&id='+json.imp_proforma_id+'&a=U&imp_proforma_id='+json.imp_proforma_id;
                                    window.location.reload();
                                }
                            }
                        });
                    }
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

function CrearAccesoDirecto(accion,id){
    switch(accion){
        case 'I':
            $.ajax({
                type:"POST",
                url: 'ajax.php?a=acceso_directo&accion='+accion,
                data:"id="+id,
                dataType: 'json',
                success: function(json){
                    if(json.mensaje){
                        alert(json.mensaje);
                    }
                }
            });
            break;
        case 'D':
            if(confirm('Desea quitar el acceso directo?.')){
                $('#atajo_lista').load('ajax.php?a=acceso_directo&accion=D&id='+id);
            }
            break;
    }
    
}

function Adjudicar(tbl_id,reg_id){
    var items = new Array();
    $("input[@name='selected[]']:checked").each(function(){
        if($(this).val()!='on'){
            items.push($(this).val());
        }
    });
    if(items>''){        
        $('#adj').remove();
        $('#content').prepend('<div id="adj" style="padding:20px">Adjudicar :<select id="adj_id"><option value="1">Si</option><option value="2">No</option></select></div>');
	$('#adj').dialog({
            title: 'Adjudicar Producto(s)',
            bgiframe: true,
            width: 250,
            height:150,
            resizable: false,
            modal: true,
            buttons:{
                "Aceptar": function(){
                    //alert("ids="+items+"&sw="+$("#adj_id").val());
                    $.ajax({
                        type:"POST",
                        url: 'ajax.php?a=adjudicado&accion=A&tbl_id='+tbl_id,
                        data:"ids="+items+"&sw="+$("#adj_id").val(),
                        dataType: 'json',
                        success: function(json){
                            if(json.id){
                                switch(tbl_id){
                                    case 105: // Orden de Compra - Importacion
                                        window.location.href='index.php?menu_id=53&menu=persona_form&tbl_id=90&id='+json.id+'&a=U&compras_id='+json.id+'&tab=2';
                                        break;
                                    case 70: // Orden de Compra - Cliente
                                        window.location.href='index.php?menu_id=59&menu=persona_form&tbl_id=69&id='+json.id+'&a=U&oc_id='+json.id+'&tab=2';
                                        break;
                                    default:
                                        document.form1.submit();
                                        break;
                                }
                                
                                
                            }
                        }
                    });
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

function GenerarCheque(tbl_id,reg_id){
        $('#cheque').remove();
        $('#content').prepend('<div id="cheque" style="padding: 3px 0px 0px 0px;"><iframe width="100%" height="100%" frameborder="no" scrolling="no" src="cheque_form.php"></iframe></div>');
	$('#cheque').dialog({
            title: 'Generar Cheque',
            bgiframe: true,
            width: 500,
            height:300,
            resizable: false,
            modal: true,
            buttons:{
                "Aceptar": function(){
                    
                }
             }
        });
}

function LetraRevision(tbl_id,reg_id){
     $('#letra').remove();
        $('#content').prepend('<div id="letra" style="padding: 3px 3px 3px 3px;"></div>');
	$('#letra').load('ajax.php?a=letra_amort&accion=F&reg_id='+reg_id).dialog({
            title: 'Amortización de Letra',
            bgiframe: true,
            width: 400,
            height:180,
            resizable: false,
            modal: true,
            buttons:{
                "Aceptar": function(){                    
                    $.ajax({
                        type:"POST",
                        url: 'ajax.php?a=letra_amort&accion=I&tbl_id='+tbl_id+'&reg_id='+reg_id,
                        data:"acc_tomar="+$("#accion_tomar").val()+"&fecha="+$("#fecha").val()+"&monto="+$("#monto").val()+"&nro="+$("#nro").val()+"&fecha_venc="+$("#fecha_venc").val(),
                        dataType: 'json',
                        success: function(json){
                            if(json.mensaje){                                                                
                                //$("#letra").html(json.mensaje)
                                grupo=($("#accion_tomar").val()=="1")?2:1;
                                $('#tab').val(grupo);
                                $('#form1').submit();
                            }
                        }
                      });   
                      
                },
                "Cancelar": function(){
                    //$("#f1").css('display','none');
                    //$(this).dialog('option','height',300);
                    $(this).dialog('close');
                }
             }
        });  
}

function HiddenShow(accion){   
    switch(accion){
        case "1":
            $("#f2").css('display','none');
            $("#f1").css('display','block');
            break;
        case "2":
            $("#f1").css('display','none');
            $("#f2").css('display','block');
            break;
    }
    
}

function FiltrarLista(tabla_id){
    var Data = {};
    $('#filtros input[type=text],select').each(function(){
        if($(this).val()>''){            
            Data[$(this).attr('id')] = $(this).val();
        }
    });
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=filtrar_lista&tabla_id='+tabla_id,
        data:Data,
        dataType: 'json',
        success: function(json){
            if(json.mensaje){
                $('#form1').submit();
            }
        }
    });
}

function GenerarCP(tbl_id,reg_id){
    //alert(reg_id);
    $.ajax({
        type:"POST",
        url: 'ajax.php?a=cp_pdf',
        data:"id="+reg_id,
        dataType: 'json',
        success: function(json){
            if(json.pdf){
                //alert(json.pdf);
                ventana = window.open(json.pdf, "MP","");
                ventana.print();
                ventana.focus();
                $("#correo").dialog('close');
            }
        }
    });
}

function TipoCambio(){
    window.open("http://www.sunat.gob.pe/cl-at-ittipcam/tcS01Alias","Tipo Cambio","height=400,width=500");
}

function DocFinDetalle(accion,titulo,tipo,moneda_id){
    var lista='Error';
    switch(accion){
        case 'L': // Letras
            lista='ajax.php?a=doc_fin_resumen&accion=L&tipo='+tipo+'&moneda_id='+moneda_id;
            break;
        case 'D': // Doc. Financieros
            titulo='Documentos Fiancieros - '+titulo;
            lista='ajax.php?a=doc_fin_resumen&accion=D&tipo='+tipo+'&moneda_id='+moneda_id;
            break;
    }
    $('#doc_fin').remove();
        $('#content').prepend('<div id="doc_fin" style="padding: 3px 3px 3px 3px;"></div>');
	$('#doc_fin').load(lista).dialog({
            title: titulo,
            bgiframe: true,
            width: 850,
            height:250,
            resizable: true,
            modal: false,
            buttons:{               
                "Cerrar": function(){
                    //$("#f1").css('display','none');
                    //$(this).dialog('option','height',300);
                    $(this).dialog('close');
                }
             }
        });  
}

function DocFinMoneda(moneda_id){
    $('#tablero8').load('ajax.php?a=doc_fin_resumen&accion=T&moneda_id='+moneda_id);
}

function CotEstado(){
    var ano=$("#ano_id").val();
    var mes=$("#mes_id").val();
    //alert("aÃ±o: "+ano+" mes:"+mes);
    $('#tablero2').load('ajax.php?a=cot_estado&ano_id='+ano+'&mes_id='+mes);
}

function ExportCP(){
    
}

function ContratoPDF(tbl_id,id){
    window.open("export_pdf_contrato.php?id="+id, "MP","");
}

function ActivarCotizacion(tbl_id,id){
    if(confirm("¿Desea generar esta cotización?")){
        $.ajax({
            type:"POST",
            url: 'ajax.php?a=activar_cot',
            data:"tbl_id="+tbl_id+"&id="+id,
            dataType: 'json',
            success: function(json){
                if(json.sucess){                 
                    $('#form1').submit(); 
                }
            }
        });
    }
}

function CargarTardanza(tbl_id,id){
    $('#tardanza').remove();
    $('#content').prepend('<div id="tardanza" style="padding: 3px 3px 3px 3px;"></div>');
    $('#tardanza').load("tardanza_form.php").dialog({
        title: "Cargar tardanzas",
        bgiframe: true,
        width: 400,
        height:180,
        resizable:false,
        modal: false
    });
}

function CotPreTrash(tbl_id){    
    var items = new Array();
    $("input[@name='selected[]']:checked").each(function(){
        if($(this).val()!='on'){
            items.push($(this).val());
        }
    });
    if(items>''){
        if(confirm('¿Desea enviar a la papelera los registros seleccionados?.')){
            $.ajax({
                type:"POST",
                url: 'ajax.php?a=drop_registro',
                data:"tbl_id="+tbl_id+"&ids="+items,
                dataType: 'json',
                success: function(json){
                    if(json.success){                 
                        $('#form1').submit(); 
                    }
                }
            });
        }
    }else{
        alert('Selecciones registros.');
    }
}

function RecuperarReg(tbl_id){    
    var items = new Array();
    $("input[@name='selected[]']:checked").each(function(){
        if($(this).val()!='on'){
            items.push($(this).val());
        }
    });
    if(items>''){
        if(confirm('¿Desea quitar de la papelera los registros seleccionados?.')){
            $.ajax({
                type:"POST",
                url: 'ajax.php?a=drop_registro',
                data:"tbl_id="+tbl_id+"&ids="+items+"&estado=1",
                dataType: 'json',
                success: function(json){
                    if(json.success){                 
                        $('#form1').submit(); 
                    }
                }
            });
        }
    }else{
        alert('Selecciones registros.');
    }
}



function Alertas(accion,id){   
    if(accion==0){
        if(confirm('¿Desea finalizar tarea?')){
            $.ajax({
                type:"POST",
                url: 'ajax.php?a=prog_alerta',
                data:"accion="+accion+"&id="+id,
                dataType: 'json',
                success: function(json){
                    if(json.mensaje){
                        window.location.reload();
                    }
                }
            });
        }
    }else{
        $.ajax({
            type:"POST",
            url: 'ajax.php?a=prog_alerta',
            data:"accion="+accion+"&id="+id,
            dataType: 'json',
            success: function(json){
                if(json.mensaje){
                    window.location.reload();
                }
            }
        });
    }           
}

function AsientoImport(id){
    alert(id);
}

function AsientoVentas(tabla_id){
    $('#asiento').remove();
    $('#content').prepend('<div id="asiento" style="padding: 3px 3px 3px 3px;"></div>');
    $('#asiento').load("asientos_exportacion.php").dialog({
        title: "Exportacion - Asiento de Ventas",
        bgiframe: true,
        width: 450,
        height:210,
        resizable:false,
        modal: true,
        buttons:{               
            "Procesar": function(){
                  alert($('#cuenta').val());
            },
            "Cerrar": function(){
                    //$("#f1").css('display','none');
                    //$(this).dialog('option','height',300);
                    $(this).dialog('close');
                }
             }
    });
}

    /* Function, Method and Load -> New(01/04/2014) */

    window.onload=function()
    {

        /* EVALUAR CAMPO DE PROVEEDOR VALIDO */
        evaCampProvLimp();

        /* AÑADIR EVENTO A CAMPO PRECIO */
        evaCampPreci();

        /* INICIAR CAMPO DINAMICO FS */
        ce_jsonFsCoti_ini();

        /* OCULTAR NOTIFICACIONES */
        setTimeout('ce_oculNotiEje()',1200);

        /* INICIAR CHECK VALI */
        cot_json1();

        /* Iniciar fecha de almacen sn_ */
        sn_iniFechAlm();

        /* iniciar proyecto en cotizacion */
        cot_iniProye();

    }

    function evaCampProv(valProv)
    {
        if(valProv=='-1' || valProv=='0')
        {
            valPro='';
            document.getElementById('prov_contacto_id').length=0;
        }
        else
        {
            valPro=document.getElementById('valor_proveedor_id').value;
        }
        return valPro;
    }


    function puntitos()
    //function puntitos(donde,caracter,campo)
    {
    
        var caracter=document.getElementById('prod_precio_venta').value.charAt(document.getElementById('prod_precio_venta').length-1);
        var donde=document.getElementById('prod_precio_venta');
        var campo='decimales';
    
        var decimales = false
        /*
        campo = eval("donde.form." + campo)
            for (d =0; d < campo.length; d++)
                {
                if(campo[d].checked == true)
                    {
                    dec = new Number(campo[d].value)
                    break;
                    }
                }
            if (dec != 0)
                {decimales = true}
        */

        dec = new Number(1);
        decimales = true;

      //pat = /[\*,\+,\(,\),\?,\\,\$,\[,\],\^]/
        pat = /[\*.\+.\(.\).\?.\\.\$.\[.\].\^]/
        valor = donde.value
        largo = valor.length
        crtr = true
        if(isNaN(caracter) || pat.test(caracter) == true)
            {
            if (pat.test(caracter)==true) 
                {caracter = "\\" + caracter}
            carcter = new RegExp(caracter,"g")
            valor = valor.replace(carcter,"")
            donde.value = valor
            crtr = false
            }
        else
            {
            var nums = new Array()
            cont = 0
            for(m=0;m<largo;m++)
                {
                if(valor.charAt(m) == "." || valor.charAt(m) == " " || valor.charAt(m) == ",")
                    {continue;}
                else{
                    nums[cont] = valor.charAt(m)
                    cont++
                    }
                
                }
            }

        if(decimales == true) {
            ctdd = eval(1 + dec);
            nmrs = 1
            }
        else {
            ctdd = 1; nmrs = 3
            }
        var cad1="",cad2="",cad3="",tres=0
        
        if(largo > nmrs && crtr == true)
        {
            for (k=nums.length-ctdd;k>=0;k--)
            {
                cad1 = nums[k]
                cad2 = cad1 + cad2
                tres++
                if((tres%3) == 0)
                {
                    if(k!=0){
                        //cad2 = "." + cad2
                        cad2 = "," + cad2
                        }
                }
            }
                
            for (dd = dec; dd > 0; dd--)    
            {
                cad3 += nums[nums.length-dd] 
            }
            
            if(decimales == true)
            //{cad2 += "," + cad3}
            {
                cad2 += "." + cad3
            }
            donde.value = cad2
        }
        //donde.focus()
    }

    function evaCampPreci()
    {
            if(document.getElementById('prod_precio_venta'))
            {
                document.getElementById('prod_precio_venta').removeAttribute("onkeypress");
                document.getElementById('prod_precio_venta').setAttribute("onkeypress","puntitos()");
            }
    }

    function evaCampProvLimp()
    {
        if(document.getElementById('valor_proveedor_id'))
        {
        document.getElementById('valor_proveedor_id').value=evaCampProv(document.getElementById('valor_proveedor_id').value);
        }
    }

    function getCampFormat()
    {
        if(document.getElementById('prod_precio_venta'))
        {
            var numFormat=document.getElementById('prod_precio_venta').value;
            arrNumFormat=new Array();
            arrNumFormat=numFormat.split(",",numFormat.length);
            numFormatFinal="";
            for(i=0;i<arrNumFormat.length;i++)
            {
                console.log(arrNumFormat[i]);
                numFormatFinal=numFormatFinal+arrNumFormat[i];
            }
            document.getElementById('prod_precio_venta').value=numFormatFinal;
        }
    }

    /* Function, Method and Load -> New(30/04/2014) */

    function ce_importFs(tbId)
    {
        //alert("El ID de la Tupla es:"+tbId);
        $('#ce_dialog1').dialog('open');
    }

    /* CE POPUP DIALOG 1  */

    $(function() 
    {
        $( "#ce_dialog1" ).dialog({
        autoOpen: false,
        width:720,
        height:380,
        show: {
        effect: "blind",
        duration: 1000
        },
        hide: {
        /*effect:"drop",*/
        /*effect: "explode",*/
        effect: "blind",
        duration: 1000
        }
        });
    });


    function ce_jsonFsCoti()
    {
        //availableTags3=new Array();
        availableTags3=[];

        param="";
        $.getJSON('json/jsonFsCoti.php?'+param,{format: "json"}, function(data) 
        {

        for(i=0;i<data.length;i++)
        {
            //console.log(data[i]['emp_nombre']);
            //availableTags3[i]=data[i]['emp_nombre'];

            availableTags3.push({key:data[i]['cs_cotiServId'],value:data[i]['cs_correServ']});
        }

        $( "#ce_fsDes" ).autocomplete({
        //source: availableTags3

          minLength: 0,
          source: availableTags3,
          focus: function( event, ui ) {
            $( "#ce_fsDes" ).val( ui.item.value );
            return false;
          },
          select: function( event, ui ) {
            $( "#ce_fsDes" ).val( ui.item.value );
            $( "#ce_fsId" ).val( ui.item.key );

            return false;
          } 

        });

        }); 
    }

    function ce_jsonFsCoti_ini()
    {
        if(document.getElementById('ce_fsId'))
        {
            ce_jsonFsCoti();
        }
    }

    function ce_ajaxDetFs()
    {
        idFs=document.getElementById('ce_fsId').value;

        var request = $.ajax({
        url: "ajax/ajaxDetFs.php",
        type: "POST",
        data: {idFs:idFs},
        dataType: "html"
        });
        
        request.done(function(msg) {
        //document.getElementById('scInventario').value='';
        //var acontenidoAjax = a('#loading').html('');
        $("#ce_ajaxDetFs").html( msg );
        });
        
        request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
        });
    }

    function ce_ajaxDetFs_espe()
    {
        setTimeout("ce_ajaxDetFs()",1200);
    }

    function ce_jsonImportFs()
    {
        fsId=document.getElementById('ce_fsId').value;
        cotiId=document.getElementById('id').value;

        param="fsId="+fsId;
        param=param+"&cotiId="+cotiId;

        /* Iniciar Json standar */
        $.getJSON('json/jsonImportFs.php?'+param,{format: "json"}, function(data) 
        {
            if(data[0]>0)
            {
                $('#ce_dialog1').dialog('close');
                id=cotiId;
                ce_ajaxImportFs(id);
            }
        });
        
    }

    function ce_ajaxImportFs(id)
    {  
        $('#lista_65').load("ajax.php?a=tbl_lista&id=0&tbl_id=67&tabla_id=65&cotizacion_id="+id+"&producto_id=0");
    }

    function ce_oculNotiEje()
    {

        var list = document.getElementsByClassName("success");
        for (var i = 0; i < list.length; i++) 
        {
            // list[i] is a node with the desired class name
            console.log(list);
            list[i].style.display="none";
        } 
    }

    //---------------------------------AMPUTACION DE VISITAS--------------------------------------------------

    function cot_json1() // iniCheckValid
    {
        if(document.getElementById('cot_checkVali'))
        {
            param="idCoti="+document.getElementById('cotizacion_id').value;
            param=param+"&json=cot_checkVali";
            param=param+"&tare=INI";
            param=param+"&valActi=";
              $.getJSON('json/cot_json.php?'+param,{format: "json"}, function(data) 
              {
                    console.log('checkValue: '+data[0]);
                    insChek=document.getElementById('cot_checkVali');
                    if(data[0]==1)
                    {
                        insChek.checked=true;
                    }
                    else
                    {
                        insChek.checked=false;
                    }
                    insChek.removeAttribute('onclick');
                    insChek.setAttribute('onclick','cot_json2()');
              });
        }
    }

    function cot_json2() // actuCheckValid
    {
        if(document.getElementById('cot_checkVali'))
        {
            valAct=0;
            insChek=document.getElementById('cot_checkVali');
            if(insChek.checked==true)
            {
                valAct=1;
            }
            else
            {
                valAct=0;
            }
            param="idCoti="+document.getElementById('cotizacion_id').value;
            param=param+"&json=cot_checkVali";
            param=param+"&tare=ACT";
            param=param+"&valActi="+valAct;
              $.getJSON('json/cot_json.php?'+param,{format: "json"}, function(data) 
              {
                    console.log('checkValue: '+data[0]);
              });
        }
        
    }

    //-------------------------------------------------------------------------------------------------------------------------------
        //#
    //----------------------------------NUMERO DE SERIE DE PRODUCTOS-----------------------------------------------------------------

        $(function() {
        $( "#sn_numSeri" ).dialog({
        autoOpen: false,
        width:720,
        height:480,
        show: {
        effect: "blind",
        duration: 1000
        },
        /*hide: {
        effect: "explode",
        effect: "blind",
        duration: 1000
        }*/
        });
        });

        function sn_inputDina(id,cant)
        {
            cadInput="";

            for(i=1;i<=cant;i++)
            {
                cadInput=cadInput+"<label id='lbl2' >N° serie "+i+"</label><input type='text' class='campo sn_seriMayus' id='seriNum_"+i+"' >";
            }
            document.getElementById(id).innerHTML=cadInput;
        }

        function sn_numSeri(id)
        {
            insInd=0;
            insCheck=document.getElementsByTagName('input');
            idDetComp=0;
            for(i=0;i<insCheck.length;i++)
            {
                var node=insCheck[i];
                if(node.getAttribute('type')=='checkbox' && node.checked==true)
                {
                    insInd++;
                    idDetComp=node.value;
                }
                else
                {
                    insInd;
                }
            }

            //console.log(insInd);

            fechAct=new Date()
            //fechActOri=new Date(fechAct.getTime()-(1 * 24 * 3600 * 1000));
            fechActOri=new Date(fechAct.getTime());
            año=fechActOri.getFullYear();
            mes=fechActOri.getMonth()+1;
            dia=fechActOri.getDate();

            if(insInd==1)
            {
                $('#sn_numSeri').dialog('open');
                //alert("esto sera facil...! :)");
                document.getElementById('hdnIdDetComp').value=idDetComp;
                document.getElementById('hdnFechAct').value=año+"-"+mes+"-"+dia;
                document.getElementById('txtFechAlm').value=año+"-"+mes+"-"+dia;
                param="idDet="+idDetComp;
                param=param+"&json=sn_desCan_obte";

                $.getJSON('json/sn_json.php?'+param,{format: "json"}, function(data) 
                {
                    document.getElementById('sn_desProd').innerHTML=data[0]['prod_nombre'];
                    document.getElementById('hdnCant').value=data[0]['prod_cantidad'];
                    sn_inputDina('sn_inputDina',data[0]['prod_cantidad']);
                    sn_ajaxNumSeri();
                    setTimeout('sn_numSeriInput()',1200);
                });
            }
            else
            {
                alert("seleccionar solo un item...! :(");
            }
        }

        function sn_iniFechAlm()
        {
            if(document.getElementById('txtFechAlm'))
            {
                Calendario3('txtFechAlm');
            }
        }

        function sn_addNumSeri()
        {
            //alert("esto sera facil...! :)");
            fechAct=document.getElementById('hdnFechAct').value;
            fechAlm=document.getElementById('txtFechAlm').value;
            //numSeri=document.getElementById('txtNumSeri').value;
            json="sn_numSeri_agre";
            idDetComp=document.getElementById('hdnIdDetComp').value;

            // Iniciar array de input dinamicos
            arrInputDina=new Array();
            tamInput=parseInt(document.getElementById('hdnCant').value);

            flagVali=0;

            for(i=1;i<=tamInput;i++)
            {
                arrInputDina[i]=document.getElementById('seriNum_'+i).value;
                if(document.getElementById('seriNum_'+i).value=="")
                {
                    flagVali=1;
                }
            }

            if(flagVali==0 && (document.getElementById('hdnDese').value==0 || (document.getElementById('hdnCant').value>0 && document.getElementById('hdnUsu').value==46 )))
            {
                $.ajax({
                type:"POST",
                url: 'json/sn_json.php',
                data:{fechAct:fechAct,fechAlm:fechAlm,json:json,idDetComp:idDetComp,arrInputDina:arrInputDina},
                dataType: 'json',
                success: function(data) 
                {
                    document.getElementById('successPrin').innerHTML=data[0];
                    setTimeout('sn_oculNoti()',1200);
                    //document.getElementById('txtFechAlm').value="";
                    //document.getElementById('txtNumSeri').value="";
                    sn_ajaxNumSeri();
                    setTimeout('sn_recarForm()',1200);
                }
                });
            }
            else
            {
                if(flagVali==1)
                {
                    alert("Completar todos los N° Serie");
                    sn_numSeri(9);
                }
                else
                {
                    alert("No se puede editar los N° de serie");
                    sn_numSeri(9);
                }
            }
        }

        function sn_recarForm()
        {
            $("#form1").submit();
        }
    
        function sn_oculNoti()
        {
            document.getElementById('successPrin').style.display="none";
        }

        function sn_ajaxNumSeri()
        {
            idDetComp=document.getElementById('hdnIdDetComp').value;
            ajax="sn_numSerixId_obte";
            var request = $.ajax({
            url: "ajax/sn_ajax.php",
            type: "POST",
            data: {ajax:ajax,idDetComp:idDetComp},
            dataType: "html"
            });
            
            request.done(function(msg) {
            //document.getElementById('scInventario').value='';
            //var acontenidoAjax = a('#loading').html('');
            $("#sn_ajaxSeriNum").html( msg );
            });
            
            request.fail(function(jqXHR, textStatus) {
            alert( "Request failed: " + textStatus );
            });
        }

        function sn_eliNumSeri(id)
        {
            param="json=sn_numSeri_eli";
            param=param+"&idNumSeri="+id;
            $.getJSON('json/sn_json.php?'+param,{format: "json"}, function(data) 
            {
                document.getElementById('successPrin').style.display="block";
                document.getElementById('successPrin').innerHTML=data[0];
                console.log(data[0]);
                setTimeout('sn_oculNoti()',1200);
                sn_ajaxNumSeri();
                setTimeout('sn_numSeriInput()',1200);
            });
        }

        function sn_numSeriInput()
        {
            param="json=sn_numSerixId_obte";
            param=param+"&idDetComp="+document.getElementById('hdnIdDetComp').value;
            $.getJSON('json/sn_json.php?'+param,{format: "json"}, function(data) 
            {
                ind=1;
                cant=parseInt(document.getElementById('hdnCant').value);
                sn_cleanSeriInput(cant);
                document.getElementById('hdnDese').value=data.length;
                for(i=0;i<data.length;i++)
                {
                    document.getElementById('seriNum_'+ind).value=data[i]['numSeri'];
                    ind++;
                }
                console.log(data);
            });
        }

        function sn_cleanSeriInput(cant)
        {
            for(i=1;i<=cant;i++)
            {
                document.getElementById('seriNum_'+i).value="";
            }
        }

        /*
         *
        */

        /*************************
        * Proyecto de Cotizaciones
        *************************/

        function cot_iniProye()
        {
            if(document.getElementById('cot_idProye'))
            {
                if(document.getElementById('cot_idProye').value!='' && document.getElementById('cot_idProye').value>0)
                {
                    //parametros
                    id=document.getElementById('cot_idProye').value;
                    json="ediProy_ini";

                    //cadena de parametros
                    param="proyeId="+id;
                    param+="&json="+json;

                    if(document.getElementById('cot_idCoti').value==0)
                    {
                        $.getJSON('json/coti_json.php?'+param,{format: "json"}, function(data) 
                        {
                            if(data.length>0)
                            {
                                document.getElementById('frm_proy_nombre').value=data[0]['proy_nombre'];
                                document.getElementById('frm_proyecto_id').value=id;
                            }
                        });
                    }
                }
            }
        }

        /*-------------------------------------*/
            //MODULO COTIZACION
        /*-------------------------------------*/

        //New update - 07/01/2015 - CLOSE

            function cot_items_ord(id)
            {
                alert("Ordenando Items....!");

                //Data de Checks Seleccionados
                    insCheck=document.getElementsByTagName('input');
                    arrCheck=new Array();
                    insInd=0;
                    for(i=0;i<insCheck.length;i++)
                    {
                        var node=insCheck[i];
                        if(node.getAttribute('type')=='checkbox' && node.checked==true)
                        {
                            arrCheck[insInd]=node.value;
                            insInd++;
                        }
                        else
                        {
                            insInd;
                        }
                    }

                console.log(arrCheck);

                //Open Popup
                cot_ordItems_event();
                $('#cot_ordItems_pop').dialog('open');
                cot_checkItems_reini();
            }

            function cot_detCot_impor(id)
            {
                ce_ajaxImportFs(id);
                setTimeout('cot_ordItems_event()',2100);
            }

            function cot_ordItems_event()
            {
                console.log("Iniciando instancia de evento...!");

                $('input[name="selected[]"]').click(function(mievento)
                {
                    //code
                    alert("click me");

                    //Data de Checks Seleccionados

                        //obtener array check
                        insCheck=document.getElementsByTagName('input');
                        arrCheck=new Array();
                        insInd=0;
                        for(i=0;i<insCheck.length;i++)
                        {
                            var node=insCheck[i];
                            if(node.getAttribute('type')=='checkbox' && node.checked==true)
                            {
                                arrCheck[insInd]=node.value;
                                insInd++;
                            }
                        }

                        //obtener array ultimo check
                        tamCheck=arrCheck.length-1;
                        arrVaci=new Array();

                        if(arrCheck.length==0)
                        {
                            arrCheckItems=arrVaci;
                        }

                        for(i=0;i<arrCheck.length;i++)
                        {
                            //evaluar si existe
                            flagExist=0;
                            for(j=0;j<arrCheckItems.length;j++)
                            {
                                if(arrCheck[i]==arrCheckItems[j])
                                {
                                    flagExist=1;
                                }
                            }

                            if(flagExist==0)
                            {
                                arrCheckItems[arrCheckItems.length]=arrCheck[i];
                            }
                        }

                        console.log("array base: "+arrCheck);
                        console.log("array reordenado: "+arrCheckItems);
                });
            }

            function cot_checkItems_reini()
            {
                //Reiniciando check items
                insCheck=document.getElementsByTagName('input');
                insInd=0;
                for(i=0;i<insCheck.length;i++)
                {
                    insCheck[i].checked=false;
                }

                arrCheckItems=new Array();
            }

            $(document).ready(function()
            {
                //iniciar array check
                arrCheckItems=new Array();

                cot_ordItems_event();

                $('#cot_ordItems_btn').click(function(mievento)
                {
                    alert("event click...");
                    /*vars*/
                    arrCheck=new Array();
                    arrCheck=arrCheckItems;
                    json="cot_itemCot_ord";
                    ordVal=document.getElementById('cot_ordIni').value;

                    /*param*/

                    /*peticion json*/
                    $.ajax({
                    type:"POST",
                    url: 'json/cot_json.php',
                    data:{json:json,arrCheck:arrCheck,ordVal:ordVal},
                    dataType: 'json',
                    success: function(data) 
                    {
                        //alert(data[0]);
                        if(data[0]>0)
                        {
                            console.log(data);
                            id=document.getElementById('id').value;
                            cot_detCot_impor(id);
                            arrCheckItems=[];
                        }

                    }
                    });

                });

                $('#cot_reinItems_btn').click(function(mievento)
                {
                    cot_checkItems_reini();
                });

            });

            $(function() 
            {
                $( "#cot_ordItems_pop" ).dialog({
                autoOpen: false,
                width:200,
                height:150,
                show: {
                effect: "blind",
                duration: 1000
                },
                /*hide: {
                effect: "explode",
                effect: "blind",
                duration: 1000
                }*/
                });
            });