window.onload=function()
{
	Calendario3('fechIni');
	Calendario3('fechFin');
	Calendario3('fechPagCob');
	Calendario3('fechPagVenc');
	cleanFichCobran();
	oculNoti('none','cobranNu');
	oculNoti('none','cambNu');
	document.getElementById('cambAct').src="http://www.sunat.gob.pe/cl-at-ittipcam/tcS01Alias";
}

function overCliLook()
{
	document.getElementById('filCli').title=document.getElementById('filCli').value;
}

function oculNoti(prop,id)
{
	document.getElementById(id).style.display=prop;
}

function cleanEmp()
{
	document.getElementById('filCli').value="";
}

function iniComboEmp() {
	 (function( $ ) {
	$.widget( "custom.combobox", {
	_create: function() {
	this.wrapper = $( "<span>" )
	.addClass( "custom-combobox" )
	.insertAfter( this.element );
	this.element.hide();
	this._createAutocomplete();
	this._createShowAllButton();
	},
	_createAutocomplete: function() {
	var selected = this.element.children( ":selected" ),
	value = selected.val() ? selected.text() : "";
	this.input = $( "<input>" )
	.appendTo( this.wrapper )
	.val( value )
	.attr( "title", "" )
	.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
		//.attr( "onchange", "Javascript:setTimeout('cliente()',1000);" )
		//.attr( "onkeypress", "Javascript:setTimeout('enterLoadCliente(event)',1000);" )
		// evento plus : onkeydown
		// detectar browser: var browserName=navigator.appName; 
		//.attr( "onkeyup", "Javascript:setTimeout('enterLoadCliente()',1000);" )
		//.attr( "onchange", "Javascript:setTimeout('cliente()',1000);" )
	.attr( "onMouseOver", "overCliLook()" )
	.attr( "id", "filCli" )
	.attr( "name", "filCli" )
	.autocomplete({
	delay: 0,
	minLength: 0,
	source: $.proxy( this, "_source" )
	})
	.tooltip({
	tooltipClass: "ui-state-highlight"
	});
	this._on( this.input, {
	autocompleteselect: function( event, ui ) {
	ui.item.option.selected = true;
	this._trigger( "select", event, {
	item: ui.item.option
	});
	},
	autocompletechange: "_removeIfInvalid"
	});
	},
	_createShowAllButton: function() {
	var input = this.input,
	wasOpen = false;
	$( "<a>" )
	.attr( "tabIndex", -1 )
	.attr( "title", "Mostrar Clientes" )
	.tooltip()
	.appendTo( this.wrapper )
	.button({
	icons: {
	primary: "ui-icon-triangle-1-s"
	},
	text: false
	})
	.removeClass( "ui-corner-all" )
	.addClass( "custom-combobox-toggle ui-corner-right" )
	.mousedown(function() {
	wasOpen = input.autocomplete( "widget" ).is( ":visible" );
	})
	.click(function() {
	input.focus();
	// Close if already visible
	if ( wasOpen ) {
	return;
	}
	// Pass empty string as value to search for, displaying all results
	input.autocomplete( "search", "" );
	});
	},
	_source: function( request, response ) {
	var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
	response( this.element.children( "option" ).map(function() {
	var text = $( this ).text();
	if ( this.value && ( !request.term || matcher.test(text) ) )
	return {
	label: text,
	value: text,
	option: this
	};
	}) );
	},
	_removeIfInvalid: function( event, ui ) {
	// Selected an item, nothing to do
	if ( ui.item ) {
	return;
	}
	// Search for a match (case-insensitive)
	var value = this.input.val(),
	valueLowerCase = value.toLowerCase(),
	valid = false;
	this.element.children( "option" ).each(function() {
	if ( $( this ).text().toLowerCase() === valueLowerCase ) {
	this.selected = valid = true;
	return false;
	}
	});
	// Found a match, nothing to do
	if ( valid ) {
	return;
	}
	// Remove invalid value
	this.input
	.val( "" )
	.attr( "title", value + " didn't match any item" )
	.tooltip( "open" );
	this.element.val( "" );
	this._delay(function() {
	this.input.tooltip( "close" ).attr( "title", "" );
	}, 2500 );
	this.input.data( "ui-autocomplete" ).term = "";
	},
	_destroy: function() {
	this.wrapper.remove();
	this.element.show();
	}
	});
	})( jQuery );
}

function comboEmpDina() 
{
	$(function() {
	$( "#combobox" ).combobox();
	$( "#toggle" ).click(function() {
	$( "#combobox" ).toggle();
	});
	});
}

iniComboEmp();
comboEmpDina();

$(function() {
$( "#dialog" ).dialog({
autoOpen: false,
width:540,
height:620,
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

$(function() {
$( "#dialog2" ).dialog({
autoOpen: false,
width:500,
height:380,
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

$(function() {
$( "#dialog3" ).dialog({
autoOpen: false,
width:500,
height:380,
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

function getCobaNewPopup() 
{
	document.getElementById('ui-dialog-title-dialog').innerHTML="Nueva Cobranza";
	document.getElementById('saveCobran').removeAttribute("onclick");
	document.getElementById('saveCobran').setAttribute("onclick","outCobaNewPopup2();");
	$( "#dialog").dialog( "open" );
	cleanFichCobran();
}

function outCobaNewPopup() 
{
	$( "#dialog").dialog( "close" );
}

function outCobaNewPopup2() 
{
	//$( "#dialog").dialog( "close" );
	console.log('se guardara la cobranza');
	insTipCob=document.getElementById('tipCobran');
	insMone=document.getElementById('mone');

	if(insTipCob.options[insTipCob.selectedIndex].value=="")
	{
		alert("No selecciono el tipo de cobranza");
	}
	else if(document.getElementById('filCli').value=="")
	{
		alert("No selecciono al cliente");
	}
	else if(insMone.options[insMone.selectedIndex].value=="")
	{
		alert("No selecciono el tipo de moneda");
	}
	else
	{
		setCobranzaTipo();
		setTimeout('ajaxCargBusCobran()',1200);
		cleanFichCobran();
	}
}

function getCambNewPopup() 
{
	$( "#dialog2").dialog( "open" );
}

function outCambNewPopup() 
{
	$( "#dialog2").dialog( "close" );
}

function outCambNewPopup2() 
{
	//$( "#dialog2").dialog( "close" );
	setCambioAct();
	setTimeout('ajaxTipCamb()',1200);
}

function cleanFichCobran()
{
	document.getElementById('filCli').value="";

	insTipCob=document.getElementById('tipCobran');
	insTipCob.options[0].selected=true;

	document.getElementById('fechPagCob').value="";
	document.getElementById('fechPagVenc').value="";
	document.getElementById('facPart1').value="";
	document.getElementById('facPart2').value="";
	document.getElementById('movim').value="";

	insTipCob=document.getElementById('mone');
	insTipCob.options[0].selected=true;

	document.getElementById('impor').value="";
	document.getElementById('reten').value="";
}

function getEmpPopup() 
{
	$( "#dialog3" ).dialog( "open" );
}

function outEmpPopup()
{
	//document.getElementById('txtRuc').blur();
	document.getElementById('txtEmp').focus();

	$( "#dialog3" ).dialog( "close" );

	//getEmp();
	//setTimeout('freshVisi()',1200);
	//setTimeout('ajaxComboEmp()',3200);
}

function outEmpPopup2()
{
	$( "#dialog3" ).dialog( "close" );
	getEmp();

	//setTimeout('freshVisi()',1200);
	//setTimeout('ajaxComboEmp()',3200);
}

function getCobaEditPopup(idCob) 
{
	document.getElementById('ui-dialog-title-dialog').innerHTML="Editar Cobranza";
	document.getElementById('saveCobran').removeAttribute("onclick");
	document.getElementById('saveCobran').setAttribute("onclick","getCobaEditPopup2('"+idCob+"');");

	$( "#dialog").dialog( "open" );
	//cleanEmp();
	setGetEditCobran(idCob);
}

function getCobaEditPopup2(idCob)
{
	setEditCobran(idCob);
	setTimeout('ajaxCargBusCobran()',1200);
}

function getEmp()
{
	var EmpVals=new Array();
	EmpVals[0]=document.getElementById('txtRuc').value;
	EmpVals[1]=document.getElementById('txtEmp').value;
	EmpVals[2]=document.getElementById('txtEmpDire').value;
	EmpVals[3]=document.getElementById('txtEmpTel').value;
	
	//alert(val);
	//console.log(EmpVals[1]);
	alert(EmpVals[1]);	
	
	var request = $.ajax({
	url: "ajax/ajaxGetEmpSf.php",
	type: "POST",
	data: {EmpVals:EmpVals},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#combobox").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setCobranzaTipo()
{
	var insTipCob=document.getElementById('tipCobran');
	valTipCob=insTipCob.options[insTipCob.selectedIndex].value;

	fechPagCob=document.getElementById('fechPagCob').value;

	valFac1=document.getElementById('facPart1').value;
	valFac2=document.getElementById('facPart2').value;

	valCli=document.getElementById('filCli').value;

	valMovi=document.getElementById('movim').value;

	var insMone=document.getElementById('mone');
	valMone=insMone.options[insMone.selectedIndex].value;

	valImpo=document.getElementById('impor').value;

	valReten=document.getElementById('reten').value;

	//instEstAnul=document.getElementById('estAnul');
	//valEstAnul=instEstAnul.options(instEstAnul.selectedIndex).value;

	param='valTipCob='+valTipCob;
	param=param+'&fechPagCob='+fechPagCob;
	param=param+'&valFac='+valTipCob+' '+valFac1+'-'+valFac2+' /';
	param=param+'&valCli='+valCli;
	param=param+'&valMovi='+valMovi;
	param=param+'&valImpo='+valImpo;
	param=param+'&valReten='+valReten;
	param=param+'&valMone='+valMone;
	param=param+'&cambVenta='+document.getElementById('cambVenta').value;
	param=param+'&docum='+valFac1+valFac2;
	param=param+'&valFechVto='+document.getElementById('fechPagVenc').value;
	//param=param+'&estAnul='+valEstAnul;

	//alert(param);

	$.getJSON('json/jsonSetCobranSf.php?'+param,{format: "json"}, function(data) 
	{
		console.log(data['noti']);
		document.getElementById('cobranNu').innerHTML=data['noti'];
		oculNoti('block','cobranNu');
		setTimeout('oculNoti("none","cobranNu")',1500);				
	});

}

function busCobran()
{
	document.frmCobran.method="post";
	//document.frmCobran.opci.value="enviar";
	document.frmCobran.submit();
}

function setCambioAct()
{

	//var f = new Date();
	//console.log(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());

	valFecha=document.getElementById('fechActual').value;
	valComp=document.getElementById('cambComp').value;
	valVent=document.getElementById('cambVent').value;

	param='valFecha='+valFecha;
	param=param+'&valComp='+valComp;
	param=param+'&valVent='+valVent;

	console.log(param);

	
	$.getJSON('json/jsonSetCambioSf.php?'+param,{format: "json"}, function(data) 
	{
		console.log(data['noti']);
		document.getElementById('cambNu').innerHTML=data['noti'];
		oculNoti('block','cambNu');
		setTimeout('oculNoti("none","cambNu")',1500);				
	});

}

function setEliCobran(idCob)
{
	if (confirm("Confirma eliminar la cobranza")) 
	{
		param='idCob='+idCob;
		$.getJSON('json/jsonDeleteCobranSf.php?'+param,{format: "json"}, function(data) 
		{
			if (data['noti']==1) 
			{
				alert("Cobranza eliminada correctamente");
			}
			else
			{
				alert("Cobranza no eliminada correctamente");
			}
		});

	}
	else
	{
		alert("Usted cancelo accion");
	}
}

function setGetEditCobran(id)
{

	param='idCobran='+id;
	$.getJSON('json/jsonGetEditCobranSf.php?'+param,{format: "json"}, function(data) 
	{	
		console.log(data[0]['CO_A_MOVIM']);
		document.getElementById('movim').value=data[0]['CO_A_MOVIM'];
		document.getElementById('facPart1').value=data[0]['CO_C_DOCUM1'];
		document.getElementById('facPart2').value=data[0]['CO_C_DOCUM2'];
		document.getElementById('fechPagCob').value=data[0]['fechIng'];
		document.getElementById('fechPagVenc').value=data[0]['fechVto'];
		document.getElementById('filCli').value=data[0]['desCli'];

		selValCombo('tipCobran',data[0]['CO_C_TPDOC']);
		selValCombo('mone',data[0]['CO_C_MONED']);

		valImpor=selImporRetenCorrec(data[0]['CO_C_MONED'],data[0]['CO_N_MONTO'],data[0]['CO_N_MTOUS']);
		valImporf=parseFloat(valImpor);
		document.getElementById('impor').value=valImporf.toFixed(2);

		valReten=selImporRetenCorrec(data[0]['CO_C_MONED'],data[0]['CO_N_IGV'],data[0]['CO_N_IGVUS']);
		valRetenf=parseFloat(valReten);

		var porReten=porcPartTod(valImporf,valRetenf);
		
		document.getElementById('reten').value=porReten.toFixed(2);

	});

}

function selValCombo(id,val)
{
		insTipCob=document.getElementById(id);
		for(i=0;i<insTipCob.length;i++)
		{
			if(insTipCob.options[i].value==val)
			{
				insTipCob.options[i].selected=true;
			}
		}
}

function selImporRetenCorrec(mone,monNac,monExtra)
{
	if (mone=='ME') 
	{
		valImpReten=monExtra;	
	}
	else
	{
		valImpReten=monNac;
	}
	return valImpReten;
}

function porcPartTod(todVal,partVal)
{
	var porcen;

	porcen=(partVal/todVal)*100;

	return porcen;
}

function setEditCobran(idCob)
{

	var insTipCob=document.getElementById('tipCobran');
	valTipCob=insTipCob.options[insTipCob.selectedIndex].value;

	fechPagCob=document.getElementById('fechPagCob').value;

	valFac1=document.getElementById('facPart1').value;
	valFac2=document.getElementById('facPart2').value;

	valCli=document.getElementById('filCli').value;

	valMovi=document.getElementById('movim').value;

	var insMone=document.getElementById('mone');
	valMone=insMone.options[insMone.selectedIndex].value;

	valImpo=document.getElementById('impor').value;

	valReten=document.getElementById('reten').value;

	//instEstAnul=document.getElementById('estAnul');
	//valEstAnul=instEstAnul.options(instEstAnul.selectedIndex).value;

	param='valTipCob='+valTipCob;
	param=param+'&fechPagCob='+fechPagCob;
	param=param+'&valFac='+valTipCob+' '+valFac1+'-'+valFac2+' /';
	param=param+'&valCli='+valCli;
	param=param+'&valMovi='+valMovi;
	param=param+'&valImpo='+valImpo;
	param=param+'&valReten='+valReten;
	param=param+'&valMone='+valMone;
	param=param+'&cambVenta='+document.getElementById('cambVenta').value;
	param=param+'&docum='+valFac1+valFac2;
	param=param+'&valFechVto='+document.getElementById('fechPagVenc').value;
	param=param+'&valIdCob='+idCob;

	$.getJSON('json/jsonSetEditCobranSf.php?'+param,{format: "json"}, function(data) 
	{
		console.log(data['noti']);
		document.getElementById('cobranNu').innerHTML=data['noti'];
		oculNoti('block','cobranNu');
		setTimeout('oculNoti("none","cobranNu")',1500);
	});
}

function setTipCobran(idTip)
{
	
	var tam=document.frmCheckCob.checkCob.length;
	insCheck=document.frmCheckCob.checkCob;
	var tamSel=0;
	checkArrCob=new Array();
	ind=0;

	if (tam>0) 
	{
		for(i=0;i<tam;i++)
		{
			if(insCheck[i].checked)
			{
				tamSel++;
				insCheck[i].checked=false;
				checkArrCob[ind++]=insCheck[i].value;
			}
		}
		console.log("check disponibles:"+tam);
		console.log("check seleccinados:"+tamSel);
	}
	else
	{
	   console.log("check disponibles:"+tam);
	   console.log("check seleccinados:"+0);
	}

	if (tamSel>0) 
	{
		for(i=0;i<checkArrCob.length;i++)
		{
			console.log(checkArrCob[i]);
		}

		if(confirm("Confirma agrupar las cobranzas seleccionadas"))
		{
			ajaxSetTipCobran(checkArrCob,idTip);
			setTimeout("msjEnvGroup()",1200);
			setTimeout('ajaxCargBusCobran()',1200);
		}
		else
		{
			alert("Usted cancelo dicha accion");
		}
	}
	else
	{
			alert("No selecciono ninguna cobranza");
	}

}

function msjEnvGroup()
{
	alert(document.getElementById('resulCheck').value+" cobranzas agrupadas correctamente..!");
}

function ajaxSetTipCobran(checkArrCob,idTip)
{
	var request = $.ajax({
	url: "ajax/ajaxSetTipCobranSf.php",
	type: "POST",
	data: {checkArrCob:checkArrCob,idTip:idTip},
	dataType: "html"
	});
	
	request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
	$("#resulAjax").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

}

function geneReporExcel(tipCob,filCob,fechIni,fechFin,numDoc,valRuc)
{
	valTipCob=tipCob;
	valFilCob=filCob;
	valFechIni=fechIni;
	valFechFin=fechFin;
	valNumDoc=numDoc;
	valRuc=valRuc;

	param="?valTipCob="+valTipCob;
	param=param+"&valFilCob="+valFilCob;
	param=param+"&valFechIni="+valFechIni;
	param=param+"&valFechFin="+valFechFin;
	param=param+"&valNumDoc="+valNumDoc;
	param=param+"&valRuc="+valRuc;

	location.target="_blank";
	location.href="reporteExcel/reporte_cobran.php"+param;
}

function ajaxCargBusCobran()
{

	tipCob=document.getElementById('pTipCob').value;
	filCob=document.getElementById('pFilCob').value;
	fechIni=document.getElementById('pFechIni').value;
	fechFin=document.getElementById('pFechFin').value;
	numDoc=document.getElementById('pNumDoc').value;
	valRuc=document.getElementById('pValRuc').value;

	var request = $.ajax({
	url: "ajax/ajaxCargCobranBusSf.php",
	type: "POST",
	data: {valTipCob:tipCob,valFilCob:filCob,valFechIni:fechIni,valFechFin:fechFin,valNumDoc:numDoc,valRuc:valRuc},
	dataType: "html"
	});
	
	request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
	$("#ajaxCobranSf").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function ajaxTipCamb()
{

	var request = $.ajax({
	url: "ajax/ajaxTipCambSf.php",
	type: "POST",
	//data: {valTipCob:tipCob,valFilCob:filCob,valFechIni:fechIni,valFechFin:fechFin,valNumDoc:numDoc,valRuc:valRuc},
	dataType: "html"
	});
	
	request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
	$("#ajaxTipCamb").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

}