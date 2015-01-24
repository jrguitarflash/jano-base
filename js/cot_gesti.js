//Load
window.onload=function()
{
	viewAcci=document.getElementById('viewActi').value;

	switch(viewAcci)
	{
		case 'cot_proyeCot':

			Calendario3('cot_fechAdju');
			kd_empMov_json();
			cot_proyCoti_list();

		break;

		default:
		break;
	}
}

//Eventos
$(document).ready(function()
{

	$('#cot_acciSaveUsu').click(function(mievento)
	{
		//accion guardar usuario finales
		cot_nuevUsuFin_crear();
	});

	$('#cot_popNuevUsu').click(function(mievento)
	{
		$('#cot_uiNuevUsu').dialog('open');
	});

	$('#cot_acciNuevProye').click(function(mievento) // new
	{
		//iniciar interface
		$( "#cot_uiNuevProye" ).dialog({title:'Nuevo Proyecto'});
		$( "#cot_uiNuevProye" ).dialog('open');

		//limpiar campos
		document.getElementById('cot_nomProye').value='';
		document.getElementById('cot_desCli').value='';
		document.getElementById('cot_idCli').value='';
		document.getElementById('cot_fechAdju').value='';

		//desabihilitar button editar
		document.getElementById('cot_acciSaveProye').disabled=false;
		document.getElementById('cot_acciEditProye').disabled=true;

	});

	$('#cot_acciSaveProye').click(function(mievento)
	{
		cot_nuevProye_crear();
	});

	$('#cot_usuResp').click(function(mievento)
	{
		cot_proyCoti_list();
	});

	$('#cot_estaId').click(function(mievento)
	{
		cot_proyCoti_list();
	});

	$('#cot_desProye').change(function(mievento)
	{
		cot_proyCoti_list();
	});

    $('#cot_desProye').keyup(function(mievento)
	{
		cot_proyCoti_list();
	});

	$('#cot_acciEditProye').click(function(mievento)
	{
		cot_proye_edit();
	});

	$('#cot_acciCreadCoti').click(function(mievento)
	{
		cot_creadCoti();
	});
});

//Funciones

function cot_creadCoti()
{
	//obtener valor de radio activo
	console.log("obteniendo id de proyecto");
	insFrm=document.cot_frmProye.cot_rdbProye;
	id=0;
	for(i=0;i<insFrm.length;i++)
	{
		if(insFrm[i].checked)
		{
			id=insFrm[i].value;
		}
	}

	console.log("id:"+id);

	if(id==0)
	{
		alert("Seleccionar un Proyecto.......!");
	}
	else
	{
		Accion('I','500','400','persona_form',0,67,0,'29','cotizacion','cli_id=0&cotizacion_id=0&coti=proye&proyeId='+id);
	}
}

function cot_nuevUsuFin_crear()
{
	//parametros
	desEmp=document.getElementById('cot_desEmp').value;
	rucEmp=document.getElementById('cot_rucEmp').value;
	mailEmp=document.getElementById('cot_mailEmp').value;
	telEmp=document.getElementById('cot_telEmp').value;
	direEmp=document.getElementById('cot_direEmp').value;
	json="nuevUsuFin_crear";

	//cadena de parametros
	param="desEmp="+desEmp;
	param+="&rucEmp="+rucEmp;
	param+="&mailEmp="+mailEmp;
	param+="&telEmp="+telEmp;
	param+="&direEmp="+direEmp;
	param+="&json="+json;


	//peticion json
	$.getJSON('json/coti_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('cot_msjConfirUsu').innerHTML="Usuario Final añadido correctamente...!";

			//retorno mensaje por defecto
			msj="Mensaje de confirmacion";
			id="cot_msjConfirUsu";
			setTimeout('cot_oculMsj("'+msj+'","'+id+'")',1200);

			//limpiar campos
			document.getElementById('cot_desEmp').value="";
			document.getElementById('cot_rucEmp').value="";
			document.getElementById('cot_mailEmp').value="";
			document.getElementById('cot_telEmp').value="";
			document.getElementById('cot_direEmp').value="";

			//cagar usuarios finales
			kd_empMov_json();
		}
		else
		{
			console.log('Usurio fina no añadido');
		}
	});
}

function cot_proye_edit()
{
	//parametros
	idProye=document.getElementById('cot_idProye').value;
	proyNom=document.getElementById('cot_nomProye').value;
	cliId=document.getElementById('cot_idCli').value;
	fechAdju=document.getElementById('cot_fechAdju').value;
	json="proye_edit";

	//cadena de parametros
	param="idProye="+idProye;
	param+="&proyNom="+proyNom;
	param+="&cliId="+cliId;
	param+="&fechAdju="+fechAdju;
	param+="&json="+json;

	//peticion json
	$.getJSON('json/coti_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]==1)
		{

			document.getElementById('cot_msjConfirProye').innerHTML="Proyecto editado correctamente...!";

			//retorno mensaje por defecto
			msj="Mensaje de confirmacion";
			id="cot_msjConfirProye";
			setTimeout('cot_oculMsj("'+msj+'","'+id+'")',1200);

			//carga de proyectos
			cot_proyCoti_list();
		}
		else if(data[0]==3)
		{
			document.getElementById('cot_msjConfirProye').innerHTML="Proyecto solo editado por Responsable...!";

			//retorno mensaje por defecto
			msj="Mensaje de confirmacion";
			id="cot_msjConfirProye";
			setTimeout('cot_oculMsj("'+msj+'","'+id+'")',1200);
		}
		else
		{
			console.log("Proyecto no editado");
		}
	});
}

function cot_ediProy_ini(id)
{
	//parametros
	document.getElementById('cot_idProye').value=id;
	proyeId=id;
	json="ediProy_ini";

	//cadena parametros
	param="proyeId="+proyeId;
	param+="&json="+json;


	//peticion json
	$.getJSON('json/coti_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data.length>0)
		{
			document.getElementById('cot_nomProye').value=data[0]['proy_nombre'];
			document.getElementById('cot_desCli').value=data[0]['proy_desCli'];
			document.getElementById('cot_idCli').value=data[0]['proy_cliId'];
			document.getElementById('cot_fechAdju').value=data[0]['proy_fechAdju'];

			//iniciar interface
			$( "#cot_uiNuevProye" ).dialog({title:'Editar Proyecto'});
			$( "#cot_uiNuevProye" ).dialog('open');

			//desabihilitar button nuevo
			document.getElementById('cot_acciSaveProye').disabled=true;
			document.getElementById('cot_acciEditProye').disabled=false;

			//msj
			console.log("your arrive for you task-list");

		}
		else
		{
			console.log("data de proyecto no cargada...!");
		}
	});

}

function cot_proyCoti_list()
{
	//parametros
	ajax="proyCoti_list";

	insResp=document.getElementById('cot_usuResp');
	valResp=insResp.options[insResp.selectedIndex].value;

	filtro=valResp;

	insEsta=document.getElementById('cot_estaId');
	valEsta=insEsta.options[insEsta.selectedIndex].value;

	desProye=document.getElementById('cot_desProye').value;

	//peticion ajax
	var request = $.ajax({
	url: "ajax/coti_ajax.php",
	type: "POST",
	data: {ajax:ajax,valResp:valResp,filtro:filtro,valEsta:valEsta,desProye:desProye},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#cot_proyCoti_list").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cot_oculMsj(msj,id)
{
	document.getElementById(id).innerHTML=msj;
}

function cot_nuevProye_crear()
{
	//parametros
	proyNom=document.getElementById('cot_nomProye').value;
	cliId=document.getElementById('cot_idCli').value;
	fechAdju=document.getElementById('cot_fechAdju').value;
	json="nuevProye_crear";

	//cadena parametros
	param="proyNom="+proyNom;
	param=param+"&cliId="+cliId;
	param=param+"&fechAdju="+fechAdju;
	param=param+"&json="+json;

	//peticion json
	$.getJSON('json/coti_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('cot_msjConfirProye').innerHTML="Proyecto creado correctamente...!";

			//Limpiar campos
			document.getElementById('cot_nomProye').value="";
			document.getElementById('cot_idCli').value="";
			document.getElementById('cot_desCli').value="";
			document.getElementById('cot_fechAdju').value="";

			//retorno mensaje por defecto
			msj="Mensaje de confirmacion";
			id="cot_msjConfirProye";
			setTimeout('cot_oculMsj("'+msj+'","'+id+'")',1200);

			//carga ajax de proyectos
			cot_proyCoti_list();
		}
		else
		{
			document.getElementById('cot_msjConfirProye').innerHTML="Proyecto no generado..!";
		}
	});
}

function cot_agruFl(id)
{
	if(document.getElementById(id+"_child").style.display=="none")
	{
		document.getElementById(id+"_child").style.display="";
		document.getElementById(id).innerHTML="-";
	}
	else
	{
		document.getElementById(id+"_child").style.display="none";
		document.getElementById(id).innerHTML="+";
	}
}

function kd_empMov_json()
{
	availableTags2=[];

	filBus='usu';

	param="json=emp_obte";
	param=param+"&filBus="+filBus;
	$.getJSON('json/coti_json.php?'+param,{format: "json"}, function(data) 
	{
		for(i=0;i<data.length;i++)
		{
			//console.log(data[i]['prod_nombre']);

			//availableTags2[i]['key']=data[i]['producto_id'];
			//availableTags2[i]['value']=data[i]['prod_nombre'];
			
			//availableTags2.add(data[i]['producto_id'],data[i]['prod_nombre']);

			availableTags2.push({key:data[i]['empId'],value:data[i]['empDes']});

			//availableTags2[i]['key']=data[i]['producto_id'];
			//availableTags2[i]['value']=data[i]['prod_nombre'];

		}

		console.log(availableTags2);

		/*
			var availableTags = [
			{key: "1",value: "NAME 1"},{key: "2",value: "NAME 2"},{key: "3",value: "NAME 3"},{key: "4",value: "NAME 4"},{key: "5",value: "NAME 5"}
			 ];
		*/

		  $( "#cot_desCli" ).autocomplete({
		  //source: availableTags2

	      minLength: 0,
	      source: availableTags2,
	      focus: function( event, ui ) {
	        $( "#cot_desCli" ).val( ui.item.value );
	        return false;
	      },
	      select: function( event, ui ) {
	        $( "#cot_desCli" ).val( ui.item.value );
	        $( "#cot_idCli" ).val( ui.item.key );
	 
	        return false;
	      } 
		  });
	});
}

//Interfaces
$(function() 
{
	$( "#cot_uiNuevProye" ).dialog({
	autoOpen: false,
	width:720,
	height:420
	/*show: {
	effect: "blind",
	duration: 1000
	},*/
	//hide: {
	/*effect: "explode",*/
	//effect: "blind",
	//duration: 1000
	//}
	});
});

$(function() 
{
	$( "#cot_uiNuevUsu" ).dialog({
	autoOpen: false,
	width:520,
	height:480
	/*show: {
	effect: "blind",
	duration: 1000
	},*/
	//hide: {
	/*effect: "explode",*/
	//effect: "blind",
	//duration: 1000
	//}
	});
});