
window.onload=function()
{

	var query = document.getElementById("modojs").src.match(/\?.*$/);

	if(query) 
	{
		//self[query.split("=")[0]] = query.split("=")[1]);
		var param=query[0];
		modo=param.split("=",2);
		console.log(modo[1]);
	}

	if(modo[1]=="1")
	{
		cs_loadEvent('iniCli');
		cs_loadEvent('iniTabs');
		cs_loadEvent('iniFech');
		cs_loadEvent('oculNoti');
	}
	else if(modo[1]=="2")
	{
		cs_loadEvent('iniCli');
		cs_loadEvent('iniTabs');
		cs_loadEvent('iniFech');
		cs_loadEvent('oculNoti');
		cs_ajaxDetCotServ();
	}
	else if(modo[1]=="3")
	{

	}
	else
	{
		console.log("inicio vacio");
	}
}

function cs_loadEvent(acci,id,tare)
{
	switch(acci)
	{
		case 'nuevCoti':
			location.href="index.php?menu_id=133&menu=cs_genCot";
		break;

		case 'geneCoti':
			//location.href="index.php?menu_id=133&menu=cs_espeCot";
			cs_submitForm('cs_frmCotiServ','enviar1');
		break;

		case 'nuevDet':
			if(tare=='edit')
			{
				$('#dialog1').dialog('open');
				document.getElementById('cs_saveCoti').removeAttribute("onclick");
				document.getElementById('cs_saveCoti').setAttribute("onclick","cs_loadEvent('saveDet','"+id+"','"+tare+"')");
				cs_jsonDetCotxId(id);
			}
			else
			{
				cs_cleanInput('cs_detDes');
				cs_cleanInput('cs_detUnid');
				cs_cleanInput('cs_detPreUni');
				cs_cleanInput('cs_detCant');
				$('#dialog1').dialog('open');
			}		
		break;

		case 'saveDet':
			if(tare=='add' || tare=='edit')
			{
				$('#dialog1').dialog('close');
			}
			console.log("Añadiendo nuevo detalle....!");
			cs_jsonCoordiDetServ(id,tare);

		break;

		case 'iniCli':
			cs_jsonEmpCli();
		break;

		case 'iniTabs':
			$(function() {
			$( "#tabs" ).tabs();
			});
		break;

		case 'iniFech':
			Calendario3('cs_fechCot');
		break;

		case 'cleanEmp':
			cs_cleanInput('cs_empAlias');
			cs_cleanInput('cs_empId');
		break;

		case 'oculNoti':
			setTimeout("cs_oculNoti('success')",1800);
			setTimeout("cs_transNoti('success','0.3')",1500);
			setTimeout("cs_transNoti('success','0.7')",1200);
		break;

		case 'actuCotServ':
			cs_jsonActuCotServ();
		break;

		case 'visuDetCot':
			url="index.php?menu_id=134&menu=cs_espeCot";
			param="&id="+id;
			cs_visuDetCot(url,param);
		break;

		case 'ejeRepoCot':
			$('#dialog2').dialog('open');
			param="?id="+id;
			document.getElementById('cs_reporCorServ').src="reporte/cs_reporCotServ.php"+param;
		break;

		case 'ejeRepoOrd':
			$('#dialog2').dialog('open');
			param="?id="+id;
			document.getElementById('cs_reporCorServ').src="reporte/cs_reporOrdServ.php"+param;
		break;

		case 'direView':
			url="index.php?menu_id=134&menu=cs_lisCot";
			param="";
			cs_visuDetCot(url,param);
		break;

		case 'direCenCost':
			url="index.php?menu_id=134&menu=cc_asigPro";
			param="&idCen="+id;
			cs_visuDetCot(url,param);
		break;

		default:
		break;
	}
}

/* POPUP DIALOG 1  */

$(function() 
{
	$( "#dialog1" ).dialog({
	autoOpen: false,
	width:620,
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

/* POPUP DIALOG 2 */

$(function() 
{
	$( "#dialog2" ).dialog({
	autoOpen: false,
	width:800,
	height:620,
	show: {
	effect: "fade",
	duration: 1000
	},
		closeOnEscape: false,
    buttons: {
    /*'Your button name': function() {
              //var bValid = true;
          //allFields.removeClass('ui-state-error');
    },*/
    'Cancel': function() {
          $(this).dialog('close');
          document.getElementById('cs_reporCorServ').src="";
    }
  	},
  	close: function() {
        //allFields.val('').removeClass('ui-state-error');
         document.getElementById('cs_reporCorServ').src="";
  	},
	hide: {
	/*effect:"drop",*/
	/*effect: "explode",*/
	effect: "fade",
	duration: 1000
	}
	});
});


function cs_jsonEmpCli()
{
	//availableTags3=new Array();
	availableTags3=[];

	param="";
	$.getJSON('json/jsonEmpCli.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		//console.log(data[i]['emp_nombre']);
		//availableTags3[i]=data[i]['emp_nombre'];

		availableTags3.push({key:data[i]['empresa_id'],value:data[i]['emp_nombre']});
	}

	$( "#cs_empAlias" ).autocomplete({
	//source: availableTags3

	  minLength: 0,
	  source: availableTags3,
	  focus: function( event, ui ) {
	    $( "#cs_empAlias" ).val( ui.item.value );
	    return false;
	  },
	  select: function( event, ui ) {
	    $( "#cs_empAlias" ).val( ui.item.value );
	    $( "#cs_empId" ).val( ui.item.key );

	    return false;
	  } 

	});

	});	
}

function cs_cleanInput(id)
{
	document.getElementById(id).value='';
}

function cs_submitForm(valForm,valSend)
{
	document.forms[valForm].accion.value=valSend;
	document.forms[valForm].submit();
}

function cs_oculNoti(id)
{
	if(document.getElementById(id))
	{
		document.getElementById(id).style.display="none";
	}
}

function cs_transNoti(id,trans)
{
	if(document.getElementById(id))
	{
		document.getElementById(id).style.opacity=trans;
	}
}

function cs_direGen(url,param)
{
	location.href=url+param;
}

function cs_jsonActuCotServ()
{
	/* Mensaje de sueños y promesas */
	console.log("Actualizando cotizacion de servicio....!");

	/* Iniciando identificador de cotizacion de servicio */
	cotServId=document.getElementById('cs_cotServId').value;

	/* Iniciando parametros generales de cotizacion */
	fecha=document.getElementById('cs_fechCot').value;
	clieId=document.getElementById('cs_empId').value;
	insRespComer=cs_capItemCombo('cs_respComer');
	descrip=document.getElementById('cs_desServ').value;
	priori=cs_capItemCombo('cs_priorCot');
	estado=cs_capItemCombo('cs_estServ');
	moneda=cs_capItemCombo('cs_moneId');

	param="fechCoti="+fecha;
	param=param+"&cliId="+clieId;
	param=param+"&respComerId="+insRespComer;
	param=param+"&desServ="+descrip;
	param=param+"&priorId="+priori;
	param=param+"&estServId="+estado;
	param=param+"&moneId="+moneda;
	param=param+"&cotiServId="+cotServId;

	/* Iniciando parametros condicion de cotizacion */
	requi=document.getElementById('cs_requiServ').value;
	tiem=document.getElementById('cs_tiemEje').value;
	garan=document.getElementById('cs_garanServ').value;
	condPag=document.getElementById('cs_condPag').value;
	tiemVali=document.getElementById('cs_tiemVali').value;
	param=param+"&reqCond="+requi;
	param=param+"&tiemEje="+tiem;
	param=param+"&garanCond="+garan;
	param=param+"&condPag="+condPag;
	param=param+"&tiemVali="+tiemVali;

	//console.log(param);

	$.getJSON('json/jsonActuCotServ.php?'+param,{format: "json"}, function(data) 
	{
		cs_incluMen(data[0]);
		cs_loadEvent('oculNoti');
	});
}

function cc_escoItemCombo(id,val)
{
	insId=document.getElementById(id);
	for(i=0;i<insId.length;i++)
	{
		if(insId.options[i].value==val)
		{
			insId.options[i].selected=true;
		}
	}
}

function cs_setValInput(id,val)
{
	document.getElementById(id).value=val;
}

function cs_capItemCombo(id)
{
	ins=document.getElementById(id);
	val=ins.options[ins.selectedIndex].value;
	return val;
}

function cs_incluMen(noti)
{
	insNoti=document.getElementById('successCab');
	insNoti.innerHTML=noti;
}

function cs_jsonCoordiDetServ(id,tare)
{
	/* Iniciar identificador de cotizacion servicio */
	cotServId=document.getElementById('cs_cotServId').value;
	detCotId=id;

	/* Iniciar parametros de detalle servicio */
	detDes=document.getElementById('cs_detDes').value;
	detUnid=document.getElementById('cs_detUnid').value;
	detPreUni=document.getElementById('cs_detPreUni').value;
	detCant=document.getElementById('cs_detCant').value;
	detTip=cs_capItemCombo('cs_tipServ');

	var param="";
	param="detDes="+detDes;
	param=param+"&detUnid="+detUnid;
	param=param+"&detPreUni="+detPreUni;
	param=param+"&detCant="+detCant;
	param=param+"&cotServId="+cotServId;
	param=param+"&tare="+tare;
	param=param+"&detCotId="+detCotId;
	param=param+"&detTip="+detTip;

	console.log(param);

	/* Iniciar Json standar */
	$.getJSON('json/jsonCoordiDetServ.php?'+param,{format: "json"}, function(data) 
	{
		cs_incluMen(data[0]);
		cs_loadEvent('oculNoti');
		cs_ajaxDetCotServ();
	});

}

function cs_ajaxDetCotServ()
{

	/* Iniciar identificador de cotizacion de servicios */
	idCotServ=document.getElementById('cs_cotServId').value;

	var request = $.ajax({
	url: "ajax/ajaxDetCotServ.php",
	type: "POST",
	data: {idCotServ:idCotServ},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetCotServ").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cs_visuDetCot(url,param)
{
	location.href=url+param;
}

function cs_jsonDetCotxId(idCot)
{
	console.log("Iniciando datos para edicion....!"+' '+idCot);
	param="idCot="+idCot;

	/* Iniciar Json standar */
	$.getJSON('json/jsonDetCotxId.php?'+param,{format: "json"}, function(data) 
	{
		cs_setValInput('cs_detDes',data[0]['desDetCoti']);
		cs_setValInput('cs_detUnid',data[0]['unidDetCoti']);
		cs_setValInput('cs_detPreUni',data[0]['preUniDet']);
		cs_setValInput('cs_detCant',data[0]['cantDetCoti']);
		cs_setValInput('cs_tipServ',data[0]['tipDetServId']);
	});
}