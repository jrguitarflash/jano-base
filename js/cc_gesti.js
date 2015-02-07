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

		cc_flCotiAdju();
		//cc_prodCatalog();
		cc_empProv();
		//cc_empProv2();
		Calendario3('ocFechCli');

	}
	else if(modo[1]=="2")
	{
		//cc_flCotiAdju2();
		cc_pcCentCost();
		setTimeout('cc_oculNoti()',1700);
		cc_ajaxEliCentCost('','filtro');
	}
	else if(modo[1]=="3")
	{
		cc_flCotiAdju();
		//cc_prodCatalog();
		cc_empProv();
		//cc_empProv2();
		Calendario3('ocFechCli');
		setTimeout('cc_oculNoti()',1700);
		puntitos();

		/*-------------------------------------------*/
			// Modulo Finanzas & Centro Costos - Load
		/*-------------------------------------------*/

		finan_opeBanTem_obte();

		//------------------------o---------------------
	}
	else if(modo[1]=="4")
	{
		Calendario3('cc_fechApe');
	}
	else if(modo[1]=="5")
	{
		// New update 05/01/2015

		console.log("inizilated... view: "+modo[1]);
		//console.log(cc_estaCheck_obte('cc_chkOrd'));

		Calendario3('cc_fechApe');

		//cc_ordEmp_obte();
		cc_centEmp_obte();
		cc_centDest_obte();

	}
	else
	{
		console.log('inicio vacio');
	}

}

$(document).ready(function()
{
	//*****************************
	//Eventos Modulo Financiero
	//*****************************

	$('#finan_creadOpe').click(function(mievento) // new
	{
		console.log("Creando nueva operacion bancarioa temporal...!");
		finan_openBanTem_cre();

	});

	$('#finan_calComis').click(function(mievento) // new
	{
		console.log("Generando calculo de operaciones bancarias...!");
		finan_calcuReno('comisInte_calcu');
	});

	$('#finan_renoOpe').click(function(mievento) //new
	{
		finan_calcuReno('opeBan_reno');
	});

	$('#finan_cargAlerta').click(function(mievento) //new
	{
		location.href="cronjob/finan_cronjob.php?cron=prevAlert";
	});

	//-------------------o--------------------

});

//***********************************
	//Funciones Modulo Financiero
//***********************************

function finan_openBanTem_cre()
{
	//parametros
	if(document.getElementById('idCentCost'))
	{
		insTip=document.frmAsigPro.finan_tipDoc;
	}
	else
	{
		insTip=document.frmCosPro.finan_tipDoc;
	}

	tipDocId=new Array();
	ind=0;
	ajax='openBanTem_cre';
	centTemp=document.getElementById('finan_centTemp').value;
	tipCent=1;

	//evaluar centro existente
	if(document.getElementById('idCentCost'))
	{
		tipCent=2;
		centTemp=document.getElementById('idCentCost').value;
	}

	for(i=0;i<insTip.length;i++)
	{
		if(insTip[i].checked)
		{
			tipDocId[ind++]=insTip[i].value;
			insTip[i].checked=false;
		}
	}

	console.log(tipDocId);

	if(tipDocId.length>0)
	{
		
		//peticion ajax
		var request = $.ajax({
		url: "ajax/cc_ajax.php",
		type: "POST",
		data: {tipDocId:tipDocId,ajax:ajax,centTemp:centTemp,tipCent:tipCent},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#finan_detOpe").html( msg );
		finan_iniCalen('finan_fechCli');
		finan_iniCalen('finan_fechDoc');
		finan_iniCalen('finan_fechIni');
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
		
		//alert("Operacion financiera seleccionada");
	}
	else
	{
		alert("Operacion financiera no seleccionada");
	}

}

function finan_opeBanTem_obte()
{
	//parametros
	ajax='opeBanTem_obte';
	centTemp=document.getElementById('finan_centTemp').value;
	tipCent=1;

	if(document.getElementById('idCentCost'))
	{
		tipCent=2;
		centTemp=document.getElementById('idCentCost').value;
	}

	//peticion ajax
	var request = $.ajax({
	url: "ajax/cc_ajax.php",
	type: "POST",
	data: {ajax:ajax,centTemp:centTemp,tipCent:tipCent},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#finan_detOpe").html( msg );
	finan_iniCalen('finan_fechCli');
	finan_iniCalen('finan_fechDoc');
	finan_iniCalen('finan_fechIni');
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function finan_opeBanTem_eli(opeBanId)
{
	//parametros
	opeBanId=opeBanId
	json="opeBanTem_eli";
	tipCent=1;

	if(document.getElementById('idCentCost'))
	{
		tipCent=2;
		centTemp=document.getElementById('idCentCost').value;
	}

	//parametros param
	param="opeBanId="+opeBanId;
	param+="&json="+json;
	param+="&tipCent="+tipCent;

	//peticion  json
	$.getJSON('json/cc_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			console.log("Operacion bancaria eliminada...!");
			finan_opeBanTem_obte();
		}
		else
		{
			console.log("Operacion bancaria no eliminada...!");
		}
	});
}

function finan_iniCalen(finanFech)
{

	if(document.getElementById('idCentCost'))
	{
		insChk=document.frmAsigPro.finan_chkOpe;
	}
	else
	{
		insChk=document.frmCosPro.finan_chkOpe;
	}

	for(i=0;i<insChk.length;i++)
	{
		if(insChk[i].value>0)
		{
			Calendario3(finanFech+"_"+insChk[i].value);
		}
	}
}

function finan_opeBanTem_actu(opeBanId)
{
	//parametros
	insMone=document.getElementById('finan_mone_'+opeBanId);
	
	moneId=insMone.options[insMone.selectedIndex].value;
	monto=document.getElementById('finan_mont_'+opeBanId).value;
	fechCli=document.getElementById('finan_fechCli_'+opeBanId).value;
	fechDoc=document.getElementById('finan_fechDoc_'+opeBanId).value;
	opeIdBan=opeBanId;
	json="opeBanTem_actu";
	tipCent=1;
	fechIni=document.getElementById('finan_fechIni_'+opeBanId).value;
	tasAnu=document.getElementById('finan_tasAnu_'+opeBanId).value;
	comisInte=document.getElementById('finan_comisInte_'+opeBanId).value;
	correOpe=document.getElementById('finan_num_'+opeBanId).value;

	//obtener estados de operacion bancaria
	estaVenci=finan_estaCheck('finan_estaVenci_'+opeBanId);
	estaEntre=finan_estaCheck('finan_estaEntre_'+opeBanId);

	console.log(estaVenci);


	if(document.getElementById('idCentCost'))
	{
		tipCent=2;
	}

	//parametros param
	param="moneId="+moneId;
	param+="&monto="+monto;
	param+="&fechCli="+fechCli;
	param+="&fechDoc="+fechDoc;
	param+="&opeIdBan="+opeIdBan;
	param+="&json="+json;
	param+="&tipCent="+tipCent;
	param+="&fechIni="+fechIni;
	param+="&tasAnu="+tasAnu;
	param+="&comisInte="+comisInte;
	param+="&estaVenci="+estaVenci;
	param+="&estaEntre="+estaEntre;
	param+="&correOpe="+correOpe;


	//peticion json
	$.getJSON('json/cc_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			console.log("Operacion actualizada correctamente...!");
			finan_opeBanTem_obte();
		}
		else
		{
			console.log("Operacion no actualizada...!");
		}

	});
}

function finan_calcuReno(json)
{
	//parametros
	ind=0;
	opeIdBan=new Array();
	tipCent=0;
	json=json;
	if(document.getElementById('idCentCost'))
	{
		insChk=document.frmAsigPro.finan_chkOpe;
		tipCent=2;
	}
	else
	{
		insChk=document.frmCosPro.finan_chkOpe;
		tipCent=1;
	}

	for(i=0;i<insChk.length;i++)
	{
		if(insChk[i].checked)
		{
			opeIdBan[ind++]=insChk[i].value;
			insChk[i].checked=false;
		}
	}

	//peticion ajax
	$.ajax
	({
	    type:"POST",
	    url: 'json/cc_json.php',
	    data:{opeIdBan:opeIdBan,tipCent:tipCent,json:json},
	    dataType: 'json',
	    success: function(data) 
	    {
	    	if(data[0]>0)
	    	{
	    		console.log("Operaciones bancarias calculadas o renovadas correctamente.....!");
	    		finan_opeBanTem_obte();
	    	}
	    	else
	    	{
	    		console.log("Operaciones no calculadas o renovadas");
	    	}
	    }
	});

}

function finan_estaCheck(id)
{
	if(document.getElementById(id).checked)
	{
		val=1
	}
	else
	{
		val=0;
	}
	return val;
}

//-----------------o--------------------

//funciones

$(function() {
$( "#tabs" ).tabs();
});

$(function() {
	$( "#dialog1" ).dialog({
	autoOpen: false,
	width:620,
	height:350,
	show: {
	effect: "blind",
	duration: 1000
	},
	hide: {
	/*effect: "explode",*/
	effect: "blind",
	duration: 1000
	}
	});
	});

function cc_multiFl()
{
	console.log("Añadiendo FL multiple");

	if(cc_valiInputFl()==0 || document.getElementById('cotiFl').value=='')
	{
		alert('FL no valida');
	}
	else
	{
		valFl=document.getElementById('cotiFl').value;
		insCombFl=document.getElementById('cc_flMulti');
		insCombFl.add(new Option(valFl,valFl,null));
		document.getElementById('cotiFl').value="";

		console.log(insCombFl.length);
	}

}

function cc_deleMultiFl()
{
	valFl=document.getElementById('cotiFl').value;
	insCombFl=document.getElementById('cc_flMulti');
	insCombFl.options[insCombFl.selectedIndex]=null;
}

function cc_oculNoti()
{
	document.getElementById('success').style.display='none';
}

function cc_dirDetPro(idCent)
{
	location.href="index.php?menu_id=127&menu=cc_asigPro&idCen="+idCent;
}

function cc_reporExcelComp()
{
	location.href="reporteExcel/cc_reporExcelComp.php";
}

function cc_openEditFl(id)
{
	param="idDet="+id;

	$.getJSON('json/jsonGetDetCoti.php?'+param,{format: "json"}, function(data) 
	{
		console.log("producto nombre:"+data[0]['prodNom']);
		console.log("producto id:"+data[0]['producto_id']);

		document.getElementById('txtProd').value=data[0]['prodNom'];
		document.getElementById('txtProdId').value=data[0]['producto_id'];
		document.getElementById('txtCant').value=data[0]['cant'];
		document.getElementById('txtPreUni').value=data[0]['preUni'];
		document.getElementById('txtProve').value=data[0]['proveNom'];
		document.getElementById('txtProveId').value=data[0]['proveedorId'];
		document.getElementById('txtPlazo').value=data[0]['plazo'];
		document.getElementById('desProdServ').value=data[0]['pro_descripcion'];

		cc_escoItemCombo('tipClasif',data[0]['prodClasiId']);
		cc_escoItemCombo('txtMone',data[0]['moneda_id']);

		cc_mosCompProd('txtProd');

	});

	document.getElementById('acciEdit').removeAttribute("onclick");
	document.getElementById('acciEdit').setAttribute("onclick","cc_ajaxGestDetFl('"+id+"','edit')");
	$( "#dialog1" ).dialog( "open" );
}

function cc_openEditComp(id,acci)
{
	param="idDet="+id;
	param=param+"&acci="+acci;

	$.getJSON('json/jsonGetDetComp.php?'+param,{format: "json"}, function(data) 
	{

		document.getElementById('txtProve').value=data[0]['proveDes'];
		document.getElementById('txtProveId').value=data[0]['proveId'];
		document.getElementById('txtPlazo').value=data[0]['plazo'];
		//document.getElementById('desProdServ').value=data[0]['desOrd'];

		cc_escoItemCombo('txtTipComp',data[0]['tipDoc']);
		cc_escoItemCombo('txtMone',data[0]['moneId']);

		//cc_mosCompProd('txtProd');

	});

	document.getElementById('acciEdit').removeAttribute("onclick");
	document.getElementById('acciEdit').setAttribute("onclick","cc_ajaxGestDetComp('"+id+"','"+acci+"')");
	$( "#dialog1" ).dialog( "open" );
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

function cc_openNuevoFl(id,acci)
{

	//cc_limpNuevoText('txtProd');
	//cc_limpNuevoText('txtProdId');
	//cc_limpNuevoText('txtCant');
	//cc_limpNuevoText('txtPreUni');
	cc_limpNuevoText('txtProve');
	cc_limpNuevoText('txtProveId');
	cc_limpNuevoText('txtPlazo');
	//cc_limpNuevoText('desProdServ');

	//cc_limpNuevoSpan('spnMode');
	//cc_limpNuevoSpan('spnMarca');

	/*
		document.getElementById('acciEdit').removeAttribute("onclick");
		document.getElementById('acciEdit').setAttribute("onclick","cc_ajaxGestDetComp('','"+acci+"')");
		$( "#dialog1" ).dialog( "open" );
	*/

	var param;
	idCentCost=comproSituElemen('idCentCost');
	param="idCent="+idCentCost;

	if(acci=='add2')
	{
		$.getJSON('json/jsonEvaEstProye.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]['estaProye']=='cerrado')
			{
				alert('No es posible crear ordenes el proyecto esta cerrado...!');
			}
			else
			{
				cc_escoItemCombo('txtMone',2);
				cc_ajaxGestDetComp('',acci);
			}			

		});
	}
	else
	{
		cc_escoItemCombo('txtMone',2);
		cc_ajaxGestDetComp('',acci);
	}

}

function cc_closeEditFl()
{
	$( "#dialog1" ).dialog( "close" );
}

function cc_limpNuevoText(id)
{
	document.getElementById(id).value="";
}

function cc_limpNuevoSpan(id)
{
	document.getElementById(id).innerHTML="";
}

function cc_geneOc(oc)
{
	switch(oc)
	{

		case 'ocNac':
			alert("Generando oc nacional");
			/*
				document.frmCosPro.method="post";
				document.frmCosPro.accion.value="enviar";
				document.frmCosPro.submit();
			*/
		break;

		case 'ocInt':
			alert("Generando oc internacional");
				//event.preventDefault()
				//event.stopPropagation();
				//event.isDefaultPrevented();
			/*
				document.frmCosPro.method="post";
				document.frmCosPro.accion.value="enviar2";
				document.frmCosPro.submit();
			*/
		break;

		case 'ocServ':
			alert("Generando oc servicio");
		break;

		case 'centCost':

			if(cc_valiInputFl()==0)
			{
				alert('FL no valida');
			}
			else if(document.getElementById('adjOrdCli').value=='')
			{
				alert('No adjunto oc de cliente');
			}
			else
			{

				insFl=document.frmCosPro.cc_flMulti;
				for(i=0;i<insFl.length;i++)
				{
					insFl.options[i].selected=true;
				}

				alert("Generando Nuevo Proyecto");
				getCampFormat();
				document.frmCosPro.method="post";
				document.frmCosPro.accion.value="enviar3";
				document.frmCosPro.submit();
			}

		break;

		case 'geneOrdComp':
			alert("Generando Ordenes de Compras");
			document.frmCosCread.method="post";
			document.frmCosCread.accion.value="enviar4";
			document.frmCosCread.submit();
		break;

		case 'actEstCent':
			alert("Actualizando estados de proyectos");
			document.frmCosCread.method="post";
			document.frmCosCread.accion.value="enviar5";
			document.frmCosCread.submit();
		break;

		case 'asigPro':


			var param;
			param="idCent="+document.getElementById('idCentCost').value;


			$.getJSON('json/jsonEvaEstProye.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]['estaProye']=='cerrado')
				{
					alert('No es posible guardar el proyecto esta cerrado...!');
				}
				else
				{
					alert("Guardando centro de costos");
					getCampFormat();
					document.frmAsigPro.method="post";
					document.frmAsigPro.accion.value="enviar6";
					document.frmAsigPro.submit();
				}			

			});


		break;

		case 'closeProy':

			var param;
			param="idCent="+document.getElementById('idCentCost').value;


			$.getJSON('json/jsonEvaEstProye.php?'+param,{format: "json"}, function(data) 
			{
			if(data[0]['estaProye']=='cerrado')
			{
				alert('No es posible cerrar el proyecto esta cerrado...!');
			}
			else
			{
					if(confirm("El centro de costo sera cerrado"))
					{
						console.log("La accion fue aceptada");
						document.frmAsigPro.method="post";
						document.frmAsigPro.accion.value="enviar7";
						document.frmAsigPro.submit();
					}
					else
					{
						console.log("La accion fue cancelada");
					}
			}			
			});

		break;

		default:
			alert("Accion por defecto..!");
		break;
	}
}


function cc_flCotiAdju()
{
	availableTags=new Array();
	param="fl=''";
	$.getJSON('json/jsonFlCotiAdju.php?'+param,{format: "json"}, function(data) 
	{
	/*
	var availableTags = [
	"ActionScript",
	"AppleScript",
	"Asp",
	"BASIC",
	"C",
	"C++",
	"Clojure",
	"COBOL",
	"ColdFusion",
	"Erlang",
	"Fortran",
	"Groovy",
	"Haskell",
	"Java",
	"JavaScript",
	"Lisp",
	"Perl",
	"PHP",
	"Python",
	"Ruby",
	"Scala",
	"Scheme",
	"jj"
	];
	*/

	for(i=0;i<data.length;i++)
	{
		//console.log(data[i]['cot_nro']);
		availableTags[i]=data[i]['cot_nro'];
	}

	$( "#cotiFl" ).autocomplete({
	source: availableTags
	});

	});	
}

function cc_flCotiAdju2()
{
	availableTags=new Array();
	param="fl=''";
	$.getJSON('json/jsonFlCotiCentCost.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['cot_nro']);
		availableTags[i]=data[i]['cot_nro'];
	}

	$( "#cotiFl" ).autocomplete({
	source: availableTags
	});

	});	
}

function cc_pcCentCost()
{
	availableTags=new Array();
	param="fl=''";
	$.getJSON('json/jsonPcCentCost.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['pcCentCost']);
		availableTags[i]=data[i]['pcCentCost'];
	}

	$( "#pcCorre" ).autocomplete({
	source: availableTags
	});

	});	
}

function cc_limpCampDina(id,id2)
{
	document.getElementById(id).value='';
	document.getElementById(id2).value='';
}

function cc_limpCampDinaProd(id,id2)
{
	document.getElementById(id).value='';
	document.getElementById(id2).value='';
	document.getElementById('spnMode').innerHTML='';
	document.getElementById('spnMarca').innerHTML='';
}


function obj(){
    obj=new Object();
    this.add=function(key,value){
        obj[key]=value;
    }
    this.obj=obj;
}

function cc_prodCatalog()
{

	cc_limpCampDinaProd('txtProd','txtProdId');

	//availableTags2=new Object();
	availableTags2=[];
	//availableTags2=new Array();
	//availableTags2=new obj();
	//var availableTags2 = {} 

	insClasif=document.getElementById('tipClasif');
	clasif=insClasif.options[insClasif.selectedIndex].value;

	param="tipClasi="+clasif;

	$.getJSON('json/jsonProdCatalog.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['prod_nombre']);

		//availableTags2[i]['key']=data[i]['producto_id'];
		//availableTags2[i]['value']=data[i]['prod_nombre'];
		
		//availableTags2.add(data[i]['producto_id'],data[i]['prod_nombre']);
		availableTags2.push({key:data[i]['producto_id'],value:data[i]['prod_nombre']});

		//availableTags2[i]['key']=data[i]['producto_id'];
		//availableTags2[i]['value']=data[i]['prod_nombre'];

	}

	console.log(availableTags2);

	/*
	var availableTags = [
	{key: "1",value: "NAME 1"},{key: "2",value: "NAME 2"},{key: "3",value: "NAME 3"},{key: "4",value: "NAME 4"},{key: "5",value: "NAME 5"}
	 ];
	 */

	$( "#txtProd" ).autocomplete({
	//source: availableTags2

      minLength: 0,
      source: availableTags2,
      focus: function( event, ui ) {
        $( "#txtProd" ).val( ui.item.value );
        return false;
      },
      select: function( event, ui ) {
        $( "#txtProd" ).val( ui.item.value );
        $( "#txtProdId" ).val( ui.item.key );
 
        return false;
      } 
	  });


	});
}


function cc_empProv()
{

	//availableTags3=new Array();
	availableTags3=[];

	param="prod=''";
	$.getJSON('json/jsonEmpProv.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		//console.log(data[i]['emp_nombre']);
		//availableTags3[i]=data[i]['emp_nombre'];

		availableTags3.push({key:data[i]['empresa_id'],value:data[i]['emp_nombre']});
	}

	$( "#txtProve" ).autocomplete({
	//source: availableTags3

	  minLength: 0,
	  source: availableTags3,
	  focus: function( event, ui ) {
	    $( "#txtProve" ).val( ui.item.value );
	    return false;
	  },
	  select: function( event, ui ) {
	    $( "#txtProve" ).val( ui.item.value );
	    $( "#txtProveId" ).val( ui.item.key );

	    return false;
	  } 

	});

	});	

}

function cc_empProv2()
{

	//availableTags3=new Array();
	availableTags3=[];

	param="prod=''";
	$.getJSON('json/jsonEmpProv.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['emp_nombre']);
		//availableTags3[i]=data[i]['emp_nombre'];

		availableTags3.push({key:data[i]['empresa_id'],value:data[i]['emp_nombre']});
	}

	$( "#txtProve2" ).autocomplete({
	//source: availableTags3

	  minLength: 0,
	  source: availableTags3,
	  focus: function( event, ui ) {
	    $( "#txtProve2" ).val( ui.item.value );
	    return false;
	  },
	  select: function( event, ui ) {
	    $( "#txtProve2" ).val( ui.item.value );
	    $( "#txtProveId2" ).val( ui.item.key );

	    return false;
	  } 

	});

	});	

}

function cc_valiInputFl()
{
	valFl=document.getElementById('cotiFl').value;
	arrValFl=new Array();
	arrValFl=valFl.split('-');
	param="valFl="+valFl;
	if(valFl.length>0 && arrValFl[0]=='FL')
	{
		vali=1;
	}
	else
	{
		vali=0;
	}
	return vali;
}

function cc_jsonGeneFl()
{
	//cc_ajaxDetFlNad();
	valFl=document.getElementById('cotiFl').value;
	arrValFl=new Array();
	arrValFl=valFl.split('-');
	param="valFl="+valFl;
	$.getJSON('json/jsonGeneFl.php?'+param,{format: "json"}, function(data) 
	{
		if(data.length>0 && valFl.length>0 && arrValFl[0]=='FL')
		{
			document.getElementById('txaCli').value=data[0]['emp_nombre'];
			document.getElementById('txaProye').value=data[0]['proy_nombre'];
		}
		else
		{
			document.getElementById('txaCli').value='';
			document.getElementById('txaProye').value='';
			document.getElementById('txtOcCli').value='';
			document.getElementById('ocFechCli').value='';
			document.getElementById('txtProve2').value='';
			document.getElementById('txtProveId2').value='';
		}
	});
}

function cc_jsonGeneComp()
{
	cc_ajaxDetCompNad();
	valFl=document.getElementById('cotiFl').value;
	arrValFl=new Array();
	arrValFl=valFl.split('-');
	param="valFl="+valFl;
	$.getJSON('json/jsonGeneFl.php?'+param,{format: "json"}, function(data) 
	{
		if(data.length>0 && valFl.length>0 && arrValFl[0]=='FL')
		{
			document.getElementById('txaCli').value=data[0]['emp_nombre'];
			document.getElementById('txaProye').value=data[0]['proy_nombre'];
			document.getElementById('txaCli2').value=data[0]['emp_nombre'];
			document.getElementById('txaProye2').value=data[0]['proy_nombre'];
			cc_escoItemCombo('txtMone2',data[0]['moneda_id']);
			document.getElementById('totCoti').value=data[0]['totCoti'];
			puntitos();
		}
		else
		{
			document.getElementById('txaCli').value='';
			document.getElementById('txaProye').value='';
			document.getElementById('txtOcCli').value='';
			//document.getElementById('ocFechCli').value='';
			//document.getElementById('txtProve2').value='';
			//document.getElementById('txtProveId2').value='';
			document.getElementById('txaCli2').value='';
			document.getElementById('txaProye2').value='';
			document.getElementById('totCoti').value='';
		}
	});
}

function cc_ajaxDetFl()
{

	$("#ajaxDetFl").html( "<table width='100%' ><tr><td colspan='12' align='center' ><img src='images/loading2.gif' ></td></tr></table>" );

	valFl=document.getElementById('cotiFl').value;
	arrValFl=new Array();
	arrValFl=valFl.split('-');

	if(valFl.length>0 && arrValFl[0]=='FL')
	{
		valFl=valFl;
	}
	else
	{
		valFl=0;
	}

	var request = $.ajax({
	url: "ajax/ajaxDetFl.php",
	type: "POST",
	data: {valFl:valFl},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cc_ajaxDetFlNad()
{	
	valFl=0;

	var request = $.ajax({
	url: "ajax/ajaxDetFl.php",
	type: "POST",
	data: {valFl:valFl},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cc_ajaxDetCompNad()
{	
	valFl=0;

	var request = $.ajax({
	url: "ajax/ajaxDetComp.php",
	type: "POST",
	data: {valFl:valFl},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function comproSituElemen(id)
{
	if(document.getElementById(id))
	{
		idCenCost=document.getElementById(id).value;
	}
	else
	{
		idCenCost='';
	}
	return idCenCost;
}

function cc_ajaxGestDetFl(idDet,acciGrid)
{
	console.log("accion:"+acciGrid);
	console.log("id:"+idDet);


	insClasiId=document.getElementById('tipClasif');
	clasiId=insClasiId.options[insClasiId.selectedIndex].value;

	insMoneId=document.getElementById('txtMone');
	moneId=insMoneId.options[insMoneId.selectedIndex].value;

	idProd=document.getElementById('txtProdId').value;
	cant=document.getElementById('txtCant').value;
	preUni=document.getElementById('txtPreUni').value;
	proveId=document.getElementById('txtProveId').value;
	plazo=document.getElementById('txtPlazo').value;
	desProdServ=document.getElementById('desProdServ').value;

	var request = $.ajax({
	url: "ajax/ajaxGestDetFl.php",
	type: "POST",
	data: {acciGrid:acciGrid,idDet:idDet,clasiId:clasiId,idProd:idProd,cant:cant,moneId:moneId,preUni:preUni,proveId:proveId,plazo:plazo,desProdServ:desProdServ},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cc_evaEstEliProye(idDet,acciGrid)
{

	var param;
	idCentCost=comproSituElemen('idCentCost');
	param="idCent="+idCentCost;

	if(acciGrid=='delete2')
	{
		$.getJSON('json/jsonEvaEstProye.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]['estaProye']=='cerrado')
			{
				alert('No es posible eliminar el proyecto esta cerrado...!');
			}
			else
			{
				cc_ajaxGestDetComp(idDet,acciGrid);
			}			

		});
	}
	else
	{
		cc_ajaxGestDetComp(idDet,acciGrid);
	}

}

function cc_ajaxGestDetComp(idDet,acciGrid)
{

	$("#ajaxDetFl").html( "<table width='100%' ><tr><td colspan='12' align='center' ><img src='images/loading2.gif' ></td></tr></table>" );


	console.log("accion:"+acciGrid);
	console.log("id:"+idDet);

	idCentCost=comproSituElemen('idCentCost');

	insMoneId=document.getElementById('txtMone');
	insTipComp=document.getElementById('txtTipComp');

	moneId=insMoneId.options[insMoneId.selectedIndex].value;
	proveId=document.getElementById('txtProveId').value;
	plazo=document.getElementById('txtPlazo').value;
	tipDoc=insTipComp.options[insTipComp.selectedIndex].value;
	//desOrd=document.getElementById('desProdServ').value;
	desOrd='';
	cliDes=document.getElementById('txaCli').value;
	cotiFl=document.getElementById('cotiFl').value;
	console.log(cotiFl);

	var request = $.ajax({
	url: "ajax/ajaxGestDetComp.php",
	type: "POST",
	data: {acciGrid:acciGrid,idDet:idDet,proveId:proveId,plazo:plazo,tipDoc:tipDoc,moneId:moneId,desOrd:desOrd,idCentCost:idCentCost,cliDes:cliDes,cotiFl:cotiFl},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	cc_closePopup(acciGrid);
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cc_closePopup(acci)
{
	if(acci=='delete' || acci=='delete2')
	{
		vacio='';
	}
	else
	{
		cc_closeEditFl();
	}
}

function cc_mosComp(id)
{
	document.getElementById(id).title=document.getElementById(id).value;
}

function cc_mosCompProd(id)
{
	document.getElementById(id).title=document.getElementById(id).value;
	cc_getMarModel();
}

function cc_getMarModel()
{

	prodId=document.getElementById('txtProdId').value;
	param="prodId="+prodId;

	$.getJSON('json/jsonGetMarModel.php?'+param,{format: "json"}, function(data) 
	{
		console.log('marca:'+data[0]);
		console.log('modelo:'+data[1]);

		document.getElementById('spnMode').innerHTML=data[1];
		document.getElementById('spnMarca').innerHTML=data[0];

	});
}

function cc_filCenCost()
{
	document.frmCosCread.method="post";
	document.frmCosCread.submit();
}

function cc_direNuevCent(idCentCost)
{

	location.href="index.php?menu_id=127&menu=cc_asigPro&idCen="+idCentCost;

}

function cc_direEvaEst(idCentCost,estProye)
{
	/*
	if(estProye=='1')
	{
		location.href="index.php?menu_id=127&menu=cc_asigPro&idCen="+idCentCost;
	}
	else
	{
		alert("El proyecto se encuentra cerrado..!");
	}
	*/
	location.href="index.php?menu_id=127&menu=cc_asigPro&idCen="+idCentCost;
}

function evaFilEstProy(acci,valFil)
{
	if(valFil=='todos')
	{
		acci="todos";
	}
	else
	{
		acci=acci;
	}
	return acci;
}


function cc_ajaxEliCentCost(idCent,acci)
{
	if(acci=="filtro")
	{

		/* Obtener id seleccionado de estados */
		var insEstProy=document.getElementById('estCentCost');
		valEstProy=insEstProy.options[insEstProy.selectedIndex].value;

		acci=evaFilEstProy(acci,valEstProy);
		
		var request = $.ajax({
		url: "ajax/ajaxEliCentCost.php",
		type: "POST",
		data: {idCent:idCent,acci:acci,valEstProy:valEstProy},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#ajaxEliCentCost").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});

	}
	else
	{

		if(confirm("Confirma eliminar este centro de costo"))
		{
			//alert("Usted elimino el centro de costo n° "+idCent);
			$("#ajaxEliCentCost").html( "<table width='100%' ><tr><td colspan='12' align='center' ><img src='images/loading2.gif' ></td></tr></table>" );
			
			var request = $.ajax({
			url: "ajax/ajaxEliCentCost.php",
			type: "POST",
			data: {idCent:idCent,acci:acci,valEstProy:valEstProy},
			dataType: "html"
			});
			
			request.done(function(msg) {
			//document.getElementById('scInventario').value='';
			//var acontenidoAjax = a('#loading').html('');
			$("#ajaxEliCentCost").html( msg );
			cc_ajaxEliCentCost('','filtro');
			});
			
			request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
			});
		}
		else
		{
			alert("Usted cancelo la operacion");
		}

	}
	
}

function evaFileUpload()
{
	console.log('upload');
	 // love the query selector
    var fileInput = document.querySelector("#adjOrdCli");
    var files = fileInput.files;
    // cache files.length 
    var fl=files.length;
    var i=0;

    while ( i < fl) 
    {
        // localize file var in the loop
        var file = files[i];
        alert(file.name+" "+file.size+" "+file.type+" ");
        console.log(file);
        i++;
    } 
}

function puntitos()
//function puntitos(donde,caracter,campo)
{

	var caracter=document.getElementById('totCoti').value.charAt(document.getElementById('totCoti').length-1);
	var donde=document.getElementById('totCoti');
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

	dec = new Number(2);
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


	function getCampFormat()
	{
		var numFormat=document.getElementById('totCoti').value;
		arrNumFormat=new Array();
		arrNumFormat=numFormat.split(",",numFormat.length);
		numFormatFinal="";
		for(i=0;i<arrNumFormat.length;i++)
		{
			console.log(arrNumFormat[i]);
			numFormatFinal=numFormatFinal+arrNumFormat[i];
		}
		document.getElementById('totCoti').value=numFormatFinal;
	}

	function cs_visuDetCot(id)
	{
		url="index.php?menu_id=134&menu=os_espeOrd";
		param="&id="+id;
		location.href=url+param;
	}


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

	/* FUNCION QUE GENERA REPORTE VISITA EN CENTRO DE COSTO */

	function visi_geneRep(id,fechIni,fechFin,vend)
	{

	$('#dialog2').dialog('open');
			param="?id="+id;
			param=param+"&txtFechIni="+fechIni;
			param=param+"&txtFechFin="+fechFin;
			param=param+"&vend="+vend;
			document.getElementById('cs_reporCorServ').src="reporte/reporte_visita.php"+param;
	}

	// ADJUDICAR VISITAS A CENTROS

		/* POPUP */

		$(function() { // Dialog3
		$( "#dialog3" ).dialog({
		autoOpen: false,
		width:620,
		height:350,
		show: {
		effect: "blind",
		duration: 1000
		},
		hide: {
		/*effect: "explode",*/
		effect: "blind",
		duration: 1000
		}
		});
		});

		// FUNCTION STANDAR

			function cc_impuVisi()
			{
				alert("Amputacion de visitas");
				$('#dialog3').dialog('open');
				cc_json2();
				cc_ajax1();
			}

		// FUNCTION JSON

			function cc_json1() // impuVisi
			{
				idVisiArr=new Array();
				insIdVisi=document.cc_frmVisi.idVisi;
				tamIdVisi=insIdVisi.length;
				flag=0;	

				for(i=0;i<tamIdVisi;i++)
				{
					if(insIdVisi[i].checked)
					{
						idVisiArr[flag++]=insIdVisi[i].value;
					}
				}

				console.log(idVisiArr);
				json="impuVisi";

				$.ajax({
		        type:"POST",
		        url: 'json/cc_json.php',
		        data:{idVisiArr:idVisiArr,json:json},
		        dataType: 'json',
		        success: function(data) 
		        {
		        	//alert(data[0]);
		        	cc_ajaxGestDetComp('','load2');
		        	$("#dialog3").dialog('close');
		        }
		    	});

			}

			function cc_json2() // persoEw
			{

					//availableTags3=new Array();
					availableTags3=[];

					param="json=persoEw";
					$.getJSON('json/cc_json.php?'+param,{format: "json"}, function(data) 
					{

					for(i=0;i<data.length;i++)
					{
						//console.log(data[i]['emp_nombre']);
						//availableTags3[i]=data[i]['emp_nombre'];

						availableTags3.push({key:data[i]['vendId'],value:data[i]['vend']});
					}

					$( "#perEw" ).autocomplete({
					//source: availableTags3

					  minLength: 0,
					  source: availableTags3,
					  focus: function( event, ui ) {
					    $( "#perEw" ).val( ui.item.value );
					    return false;
					  },
					  select: function( event, ui ) {
					    $( "#perEw" ).val( ui.item.value );
					    $( "#perId" ).val( ui.item.key );

					    return false;
					  } 

					});

					});
			}

		/*------------------[*]----------------------*/

		// FUNCTION AJAX

			function cc_ajax1() // filVisi
			{

				idCent=document.getElementById('idCentCost').value;
				perId=document.getElementById('perId').value;
				ajax="filVisi";
				var request = $.ajax({
				url: "ajax/cc_ajax.php",
				type: "POST",
				data: {perId:perId,ajax:ajax,idCent:idCent},
				dataType: "html"
				});

				document.getElementById('perEw').value="";
				document.getElementById('perId').value="";
				
				request.done(function(msg) {
				//document.getElementById('scInventario').value='';
				//var acontenidoAjax = a('#loading').html('');
				$("#cc_ajaxVisi").html( msg );
				});
				
				request.fail(function(jqXHR, textStatus) {
				alert( "Request failed: " + textStatus );
				});
			}

			//New update 23/12/2014

			//New update 06/01/2015 - CLOSE

			function cc_ordxOrd_obte()
			{
				/*vars*/
				ajax="cc_ordxOrd_obte";
				ordId=document.getElementById('cc_asigOrigId').value;

				/*param*/

				/*peticion ajax*/
				var request = $.ajax({
				url: "ajax/cc_ajax.php",
				type: "POST",
				data: {ajax:ajax,ordId:ordId},
				dataType: "html"
				});
				
				request.done(function(msg) 
				{
				$("#cc_ordAsig_tab").html( msg );
				});
				
				request.fail(function(jqXHR, textStatus) {
				alert( "Request failed: " + textStatus );
				});
			}

			function cc_ordxCent_obte()
			{
				/*vars*/
				ajax="cc_ordxCent_obte";
				centId=document.getElementById('cc_asigOrigId').value;

				/*param*/

				/*peticion ajax*/
				var request = $.ajax({
				url: "ajax/cc_ajax.php",
				type: "POST",
				data: {ajax:ajax,centId:centId},
				dataType: "html"
				});
				
				request.done(function(msg) 
				{
				$("#cc_ordAsig_tab").html( msg );
				});
				
				request.fail(function(jqXHR, textStatus) {
				alert( "Request failed: " + textStatus );
				});
			}

		// Function Json

			function cc_centAnu_cre()
			{
				//vars
				cc_correCent="CC-"+document.getElementById('cc_nro').value+"-"+kd_obteValComb('cc_peri');
				cc_alias=document.getElementById('cc_ali').value;
				cc_proyDes=document.getElementById('cc_des').value;;
				cc_fechApe=document.getElementById('cc_fechApe').value;;
				json="cc_centAnu_cre";

				//param
				param="cc_correCent="+cc_correCent;
				param+="&cc_alias="+cc_alias;
				param+="&cc_proyDes="+cc_proyDes;
				param+="&cc_fechApe="+cc_fechApe;
				param+="&json="+json;

				//peticion json
				$.getJSON('json/cc_json.php?'+param,{format: "json"}, function(data) 
				{
					if(data[0]>0)
					{
						$(".elem-gd").notify("Centro anual generada correctamente","success");

						//Limpiar campos
						gd_enviValText('cc_nro',"");
						gd_enviValText('cc_ali',"");
						gd_enviValText('cc_des',"");
						gd_enviValText('cc_fechApe',"");

					}
					else
					{
						$(".elem-gd").notify("Centro anual no generada","error");
					}
				});
			}

			//New update 05/01/2015 - CLOSE

			function cc_ordEmp_obte()
			{
				scc_dataComp_ini("cc_ordEmp_obte","cc_json","cc_asigOrigId","cc_asigOrig");
			}

			function cc_centEmp_obte()
			{
				scc_dataComp_ini("cc_centEmp_obte","cc_json","cc_asigOrigId","cc_asigOrig");	
			}

			function cc_centDest_obte()
			{
				scc_dataComp_ini("cc_centDest_obte","cc_json","cc_asigDestId","cc_asigDest");	
			}

			function cc_ordxDest_actu(dataCheck)
			{
				/*vars*/
				centDest=document.getElementById('cc_asigDestId').value;
				ordId=dataCheck;
				json="cc_ordxDest_actu";

				/*param*/

				/*peticion json*/
				$.ajax({
		        type:"POST",
		        url: 'json/cc_json.php',
		        data:{json:json,centDest:centDest,ordId:ordId},
		        dataType: 'json',
		        success: function(data) 
		        {
		        	//alert(data[0]);
		        	if(data[0]>0)
		        	{
		        		$(".elem-gd").notify("Ordenes asignadas correctamente..!","success");
		        		cc_filAsigOrd_eva();
		        	}
		        	else
		        	{
		        		$(".elem-gd").notify("Ordenes no asignadas.....!","error");
		        	}
		        }
		    	});
			}

		// Function JS

			//New update 06/01/2014 - CLOSE

			function cc_filAsigOrd_eva()
			{
				if(cc_estaCheck_obte('cc_chkOrd')==1)
				{
					cc_ordEmp_obte();
				}
				else
				{
					cc_centEmp_obte();
				}
			}

			function cc_ordAsig_obte()
			{
				if(cc_estaCheck_obte('cc_chkOrd')==1)
				{
					cc_ordxOrd_obte();
				}
				else
				{
					cc_ordxCent_obte();
				}
			}

		// Function Popup

		// Function Events

			$(document).ready(function()
			{
				$('#cc_saveApeCent_acci').click(function(mievento)
				{
					console.log("Peticion:cc_saveApeCent_acci");
					cc_centAnu_cre();
					//alert("hello...!");
				});

				//New update 05/01/2015 - CLOSE
				//			 06/01/2015


				$('#cc_chkOrd').click(function(mievento)
				{
					console.log("hello event...");
					//alert("hello event..");
					cc_filAsigOrd_eva();

					//limpiar cc origen
					document.getElementById('cc_asigOrig').value="";
					document.getElementById('cc_asigOrigId').value="";

					//refresh ord asig
					cc_ordAsig_obte();

					
				});

				$('#cc_asigDest').change(function(mievento)
				{
					cc_ordAsig_obte();
				});

				$('#cc_asigDest').keyup(function(mievento)
				{
					cc_ordAsig_obte();
				});

				$('#cc_asigOrig').change(function(mievento)
				{
					cc_ordAsig_obte();
				});

				$('#cc_asigOrig').keyup(function(mievento)
				{
					cc_ordAsig_obte();
				});

				$('#cc_asigOrd').click(function(mievento)
				{
					if(document.getElementById('cc_asigDestId').value!='')
					{
						alert("Asignando orden a centro....!");

						insForm=document.cc_ordAsig_frm.cc_ordAsig_chk;
						//console.log(gd_checkData(insForm));

						arrCheck=new Array();
						arrCheck=gd_checkData(insForm);
						console.log(arrCheck.length);

						if(arrCheck.length==0)
						{
							alert("sin checks..!");
						}
						else
						{
							alert("con check...!");
							cc_ordxDest_actu(arrCheck);
							setTimeout('cc_ordAsig_obte()',1200);
						}
					}
					else
					{
						alert("Seleccionar centro destino...!");
					}
				});

			});