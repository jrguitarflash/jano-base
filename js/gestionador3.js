function recla_iniComb(val,id) //JS
{
	insId=document.getElementById(id);
	for(i=0;i<insId.length;i++)
	{
		if(insId[i].value==val)
		{
			insId[i].selected=true;	
		}
	}
}

function recla_obsxTip() // AJAX
{
	// cargando observacion de reclamo
	console.log("cargando observacion de reclamo");

	// instancias requeridas
	insTip=document.getElementById('recla_tipObs');

	// parametros requeridos
	ajax="obsxTip";
	tip=insTip.options[insTip.selectedIndex].value;

	var request = $.ajax({
	url: "ajax/recla_ajax.php",
	type: "POST",
	data: {ajax:ajax,tip:tip},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#recla_obs").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}


$(function() {
$( "#tabs" ).tabs();
});

function include(archivo)
{
  var nuevo = document.createElement("script");
  nuevo.setAttribute("type", "text/javascript");
  nuevo.setAttribute("src", archivo);
  document.getElementsByTagName("head")[0].appendChild(nuevo);
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
	.attr( "onkeyup", "Javascript:setTimeout('enterLoadCliente()',1000);" )
	.attr( "onchange", "Javascript:setTimeout('cliente()',1000);" )
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

function ajaxComboEmp()
{
	//include('libJquery/autocomplete/jquery-1.9.1.js');
	//include('libJquery/autocomplete/jquery-ui.js');
	//include('js/gestionador.js');
	
	//iniComboEmp();
	//comboEmpDina();
}

function cliente()
{
	val=document.getElementById('filCli').value;
	document.getElementById('contacElegi').innerHTML="seleccione un contacto";
	//var getVal=val.options[val.selectedIndex].va;
	//alert(val);
	
	document.getElementById('contac2').length="";	
	
	var request = $.ajax({
	url: "ajax/ajaxConsulContacRe.php",
	type: "POST",
	data: {val: val},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#contac").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function ajaxContacNuevo(ci,c1,c2,c3,c4,c5)
{
	val=document.getElementById('filCli').value;
	//var getVal=val.options[val.selectedIndex].va;
	//alert(val);
	var request = $.ajax({
	url: "ajax/ajaxConsulContacReNuevo.php",
	type: "POST",
	data: {val:val,ci:ci,c1:c1,c2:c2,c3:c3,c4:c4,c5:c5},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#contac").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function getEmail()
{
	val=document.getElementById('respo');
	var getVal=val.options[val.selectedIndex].value;
	//alert(val);
	var request = $.ajax({
	url: "ajax/ajaxConsulEmail.php",
	type: "POST",
	data: {getVal: getVal},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxEmail").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function getEmail2()
{
	val=document.getElementById('respo2');
	var getVal=val.options[val.selectedIndex].value;
	//alert(val);
	var request = $.ajax({
	url: "ajax/ajaxConsulEmail2.php",
	type: "POST",
	data: {getVal: getVal},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxEmail2").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function getDetRecla(id,filtro)
{
	var getVal=id;
	var getVal2=filtro;
	//alert(val);
	var request = $.ajax({
	url: "ajax/ajaxConsulDetRecla.php",
	type: "POST",
	data: {getVal: getVal,getVal2:getVal2},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetRecla").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function getEmp()
{
	var EmpVals=new Array();
	EmpVals[0]=document.getElementById('txtRuc').value;
	EmpVals[1]=document.getElementById('txtEmp').value;
	EmpVals[2]=document.getElementById('txtEmpMail').value;
	EmpVals[3]=document.getElementById('txtEmpWeb').value;
	EmpVals[4]=document.getElementById('txtEmpDire').value;
	EmpVals[5]=document.getElementById('txtEmpTel').value;
	
	//alert(val);
	console.log(EmpVals[1]);	
	
	var request = $.ajax({
	url: "ajax/ajaxGetEmp.php",
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

function setDetVisit(tare,id)
{
	
	var valoresContac=[];
	var checkboxes=document.visiRepor.contac2;
	//console.log(checkboxes.length);
	for(var i=0;i<checkboxes.options.length;i++)
	{
		//alert('cachina');
	/*	if (checkboxes[i].selected) 
		{ */
			valoresContac.push(checkboxes[i].value);
			console.log(checkboxes.options[i].value);
	/*	} */
	}	

	var instValContac=document.getElementById('contac');
	var instValObs=document.getElementById('obsVisi');
	var instValEmp=document.getElementById('filCli');
	var instObsPen=document.getElementById('obsPen');
	var instConEle=document.getElementById('contacElegi');
	
	var getVal=id;
	var getValContac=instValContac.options[instValContac.selectedIndex].value;
	var tareDet=tare;
	var getValObs=instValObs.value;
	var getValEmp=instValEmp.value;
	var getValObsPen=instObsPen.value;
	
	instValObs.value="";
	instObsPen.value="";
	checkboxes.options.length="";
	instValContac.options.length="";
	instValEmp.value="";
	instConEle.innerHTML="";
	
	
	//alert(val);
	console.log(getValContac);	
	
	var request = $.ajax({
	url: "ajax/ajaxGestDetVisi.php",
	type: "POST",
	data: {getVal: getVal,tareDet: tareDet,getValContac:getValContac,getValObs:getValObs,getValEmp:getValEmp,getVectContac:valoresContac,getValObsPen:getValObsPen},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetVisi").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function getValVisi(filVisi) 
{
	var filVal=new Array();
	
	if (filVisi=="fech-cli-ven") {
		filVal[0]=document.getElementById('txtFechIni').value;
		filVal[1]=document.getElementById('filCli').value;
		insVal=document.getElementById('respo');
		filVal[2]=insVal.options[insVal.selectedIndex].value;
	}
	else if (filVisi=="fech-cli") {
		filVal[0]=document.getElementById('txtFechIni').value;
		filVal[1]=document.getElementById('filCli').value;
	}
	else if (filVisi=="fech-ven") {
		filVal[0]=document.getElementById('txtFechIni').value;
		insVal=document.getElementById('respo');
		filVal[1]=insVal.options[insVal.selectedIndex].value;
	}
	else if (filVisi=="fech") 
	{
		filVal[0]=document.getElementById('txtFechIni').value;
	}
	else if (filVisi=="cli") 
	{
		filVal[0]=document.getElementById('filCli').value;
	}
	else
	{
		insVal=document.getElementById('respo');
		filVal[0]=insVal.options[insVal.selectedIndex].value;
	}
	return filVal;
}


function clearFilVisi()
{
	document.getElementById('txtFechIni').value="";
	document.getElementById('filCli').value="";
	document.getElementById('respo').selectedIndex=0;	
}

function getFilVisi()
{
	var fil1=document.getElementById('txtFechIni').value;
	var fil2=document.getElementById('filCli').value;
	var fil3=document.getElementById('respo').options[document.getElementById('respo').selectedIndex].value;
	
	if (fil1!="" && fil2!="" && fil3!="") {
		fil="fech-cli-ven";
	}
	else if (fil1!="" && fil2!="") {
		fil="fech-cli";
	}
	else if (fil1!="" && fil3!="") {
		fil="fech-ven";
	}		
	else if (fil1!="") {
		fil="fech";
	}
	else if (fil2!="") {
		fil="cli";
	}
	else{
		fil="ven";	
	}
	return fil;
}

function ajaxEliVisi(id)
{
	
	var request = $.ajax({
	url: "ajax/ajaxConsulVisiHistEli.php",
	type: "POST",
	data: {id:id},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxBusVisi").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setBusVisi()
{
	
	/*	
	insFil=document.getElementsByName('filtro');
	val=insFil.length;
	console.log(val);
	
	for (i=0;i<insFil.length;i++) 
	{
			if (insFil[i].checked) 
			{
				console.log(insFil[i].value);
				filVisi=insFil[i].value;			
			}
	}
	*/
	
	var filVisi=getFilVisi();
	var filVal=getValVisi(filVisi);
	clearFilVisi();
	
	//var getVal=id;
	//var tareDet=tare;
	
	//alert(val);
	//console.log(getValContac);	
	
	var request = $.ajax({
	url: "ajax/ajaxConsulVisiHist.php",
	type: "POST",
	data: {filVisi:filVisi,filVal:filVal},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxBusVisi").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setEliVisit(tare,id)
{
	
	var getVal=id;
	var tareDet=tare;
	
	//alert(val);
	//console.log(getValContac);	
	
	var request = $.ajax({
	url: "ajax/ajaxGestDetVisi.php",
	type: "POST",
	data: {getVal: getVal,tareDet: tareDet},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetVisi").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setReclamo()
{
	console.log('setReclamo');
	document.reclamo_form.submit();	
}

function setActEmail2()
{
	console.log('setActReclamo');
	val=document.getElementById('respo2');
	var getVal=val.options[val.selectedIndex].value;
	var getVal2=document.getElementById('mail2').value;
	//alert(val);
	console.log(getVal+getVal2);
	var request = $.ajax({
	url: "ajax/ajaxConsulActEmail2.php",
	type: "POST",
	data: {getVal:getVal,getVal2:getVal2},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxEmail2").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setActEmail()
{
	console.log('setActReclamo');
	val=document.getElementById('respo');
	var getVal=val.options[val.selectedIndex].value;
	var getVal2=document.getElementById('mail').value;
	//alert(val);
	console.log(getVal+getVal2);
	var request = $.ajax({
	url: "ajax/ajaxConsulActEmail.php",
	type: "POST",
	data: {getVal:getVal,getVal2:getVal2},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxEmail").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setActEmailRecep()
{
	console.log('setActReclamoRecep');
	getVal=document.getElementById('recep').value;
	getVal2=document.getElementById('mailRecep').value;
	//var getVal=val.options[val.selectedIndex].value;
	//var getVal2=document.getElementById('mail').value;
	//alert(val);
	console.log(getVal+getVal2);
	var request = $.ajax({
	url: "ajax/ajaxConsulActEmailRecep.php",
	type: "POST",
	data: {getVal:getVal,getVal2:getVal2},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxEmailRecep").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setConfirRecla(idRecla)
{
	console.log('setActReclamoRecep');
	var getVal=idRecla;
	//getVal2=document.getElementById('mailRecep').value;
	//var getVal=val.options[val.selectedIndex].value;
	//var getVal2=document.getElementById('mail').value;
	//alert(val);
	//console.log(getVal+getVal2);
	var request = $.ajax({
	url: "ajax/ajaxCloseRecla.php",
	type: "POST",
	data: {getVal:getVal},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxConfirRecla").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}


	$(function() {
	$( "#dialog" ).dialog({
	autoOpen: false,
	width:500,
	height:300,
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
	height:400,
	show: {
	effect: "blind",
	duration: 1000
	},
	hide: {
	/*
	effect: "explode",
	*/
	/*
	blind
	bounce
	clip
	drop
	explode
	fade
	fold
	highlight
	puff
	pulsate
	scale
	shake
	size
	slide
	transfer
	*/
	effect: "fade",
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
	
	$(function() {
	$( "#dialog4" ).dialog({
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
	
	function cargList()
	{
		location.href="index.php?menu_id=102&menu=reclamo_lista&filtro=4";	
	}
	
	function getReclaPopup(id,filtro) 
	{
		getDetRecla(id,filtro);
		$( "#dialog" ).dialog( "open" );
	}

	function getContacPopup() 
	{
		$( "#dialog2" ).dialog( "open" );
	}

	function getGastosPopup() 
	{
		$( "#dialog3" ).dialog( "open" );
	}

	function getEmpPopup() 
	{
		$( "#dialog4" ).dialog( "open" );
	}

	function outReclaPopup(idRecla)
	{
		$("#dialog").dialog("close");
		setConfirRecla(idRecla);
		setTimeout('cargList()',1200)
		//location.href="index.php?menu_id=102&menu=reclamo_lista&filtro=4";
		console.log(idRecla);
	}

	function outGastosPopup()
	{
		$( "#dialog3" ).dialog( "close" );
		setDetVisitas();
	}

	function outEmpPopup()
	{
		$( "#dialog4" ).dialog( "close" );
		getEmp();
		//setTimeout('freshVisi()',1200);
		setTimeout('ajaxComboEmp()',3200);
	}

	function freshVisi() 
	{
		location.href="index.php?menu_id=107&menu=visita_reporte";
	}

	function outContacPopup()
	{
		elemento = document.getElementById("txtEmail");
		//elemento.blur();
		elemento.focus();

		console.log(document.getElementById('filCli').value);
		console.log(document.getElementById('txtNom').value);
		console.log(document.getElementById('txtApePat').value);
		console.log(document.getElementById('txtApMat').value);
		console.log(document.getElementById('txtTel').value);
		console.log(document.getElementById('txtEmail').value);
		
		ci=document.getElementById('filCli').value;
		c1=document.getElementById('txtNom').value;
		c2=document.getElementById('txtApePat').value;
		c3=document.getElementById('txtApMat').value;
		c4=document.getElementById('txtTel').value;
		c5=document.getElementById('txtEmail').value;
		
		clearFormContac();
		
		$( "#dialog2" ).dialog( "close" );
		
		if (ci.value=="") 
		{
			alert("seleccione la empresa para el nuevo contacto");
		}
		else if(c1=="" && c2=="")
		{
			alert("ingrese como minimo un nombre y un apellido");
		}
		else 
		{
			ajaxContacNuevo(ci,c1,c2,c3,c4,c5);
			console.log("nuevo contacto via ajax...");
		}
	}

	function clearFormContac()
	{
		document.getElementById('txtNom').value="";
		document.getElementById('txtApePat').value="";
		document.getElementById('txtApMat').value="";
		document.getElementById('txtTel').value="";
		document.getElementById('txtEmail').value="";
	}

	window.onload=function()
	{
		Calendario('txtFechIni');
		Calendario3('txtFechFin');
		Calendario3('fech');
		contacElegi=document.getElementById('contacElegi');
		contacElegi.addEventListener("click",funPrueba, false);

		//contac=document.getElementById('contac');
		//contac.addEventListener("click",mosContac, false);

		// EVALUVAR CAMPO VALIDO
		if(document.getElementById('nomCli'))
		{
			document.getElementById('filCli').value=document.getElementById('nomCli').value;
		}

		// INICIAR CADENA ID OBSERVACION
		if(document.getElementById('recla_cadObs'))
		{
			cadObs=document.getElementById('recla_cadObs').value;
			cadObsArr=new Array()
			cadObsArr=cadObs.split("|",2);
			console.log(cadObsArr);
			recla_iniComb(cadObsArr[0],'recla_tipObs');
			recla_obsxTip();
			setTimeout("recla_iniComb('"+cadObsArr[1]+"','recla_obs')",1200);
		}
		else
		{
			recla_obsxTip();
		}


	}

	function setDetVisitas()
	{
		document.visiRepor.sltMone.value=document.getElementById('sltMone').options[document.getElementById('sltMone').selectedIndex].value;
		document.visiRepor.txtPasa.value=document.getElementById('txtPasa').value;
		document.visiRepor.txtHospe.value=document.getElementById('txtHospe').value;
		document.visiRepor.txtAli.value=document.getElementById('txtAli').value;
		document.visiRepor.txtTrans.value=document.getElementById('txtTrans').value;
		console.log(document.visiRepor.sltMone.value+" "+document.visiRepor.txtPasa.value);
		document.visiRepor.method="post";			
		document.visiRepor.submit();
	}

	function setReporVisi(id,fechIni,fechFin,trab)
	{
		var a = document.createElement('a');
		a.href="reporte/reporte_visita.php?id="+id+"&txtFechIni="+fechIni+"&txtFechFin="+fechFin+"&vend="+trab;
		a.target = '_blank';
		document.body.appendChild(a);
		a.click();
	}

	function getReporVisi(id,fechIni,fechFin,vend)
	{
		console.log("hello world reporte via ajax... \n id:"+id+"\n fechIni:"+fechIni+"\n fechFin:"+fechFin+"\n vend:"+vend);
		document.histVisi.id.value=id;
		document.histVisi.txtFechIni.value=fechIni;
		document.histVisi.txtFechFin.value=fechFin;
		document.histVisi.vend.value=vend;
		document.histVisi.submit();
	}

	function valFile()
	{
		document.reclamo_form.accion.value="enviar2";
		document.reclamo_form.submit();
		console.log(document.getElementById('adjunt').value);
	}

/* ------------------------------------------------------------- */

/* Agregar un nuevo evento a cualquier elemento */



function nuevoEvento(elemento, evento, funcion) 
{
    // para cualquier navegador
    try {
        if (elemento.addEventListener)
            elemento.addEventListener(evento, funcion, false);
 
         // para IE
         else
             elemento.attachEvent("on" + evento, funcion);
     } catch(e) {
         alert("No se pudo agregar el evento\n" + e.name + " - " + e.message);
     }
}

 
// codigo javascript no intrusivo que asigna al evento onload una funcion


function addLoadEvent(func) 
{
    var oldonload = window.onload;
    if (typeof window.onload != 'function')
        window.onload = func;
    else {
        window.onload = function() {
            if (oldonload)
                oldonload();
            func();
         }
    }
}

/* ------------------------------------------------------------------------------------ */
	function concatContacEnabled(instaContac)
	{
		valContac="";
		for (i=0;i<instaContac.length;i++) 
		{
			if (instaContac[i].selected) 
			{
				switch(valContac) 
				{
				case '':
					valContac=instaContac.options[i].text;
				break;
				default:
					valContac=valContac+" , "+instaContac.options[i].text;
				break;
				}
			}
		}
		return valContac;
	}

	function concatContac(instaContac)
	{
		valContac="";
		for (i=0;i<instaContac.length;i++) 
		{

				switch(valContac) 
				{
				case '':
					valContac=instaContac.options[i].text;
				break;
				default:
					valContac=valContac+" , "+instaContac.options[i].text;
				break;
				}
			
		}
		return valContac;
	}

	function mosContac()
	{
		instaContac=document.getElementById('contac2');
		//valContac=instaContac.options[instaContac.selectedIndex].innerHTML;
		valContac="";
		instVisi=document.getElementById('contacElegi');
		instVisi.innerHTML=concatContac(instaContac);
	}


	function iniEvent()
   {
		nuevoEvento(document.getElementById("contac"),"click",mosContac);
   }
   
    /*addLoadEvent(iniEvent);*/
   
	function funPrueba()
	{
		alert(document.getElementById('contacElegi').innerHTML+" "+"esta seleccionada actualmente");	
	}
   
   /*
   window.onload=function () 
   {
   contacElegi=document.getElementById('contacElegi');
	contacElegi.addEventListener("click",funPrueba, false);
	}
  */
  
  	function setRutVisi()
  	{
		document.getElementById('notiAdju').innerHTML=document.getElementById('adjunt').value;
  	}
  
   function setRutVisi2()
  	{
		document.getElementById('notiAdju2').innerHTML=document.getElementById('adjunt2').value;
  	}
  
   function setRutVisi3()
  	{
		document.getElementById('notiAdju3').innerHTML=document.getElementById('adjunt3').value;
  	}
  
  	function setResetVisi() 
  	{
  		document.getElementById('ajaxBusVisi').innerHTML="<ul class='listHist'>Resultados de busqueda</ul>";
  		document.getElementById('clearFrame').innerHTML="<iframe name='reporVisi' id='reporVisi' class='frameReporVisi'></iframe>";
  	}
  
  /*  SELECCION Y DESELECCION DE CONTACTOS */
  
  function slcContac()
  {
		insEle1=document.getElementById('contac');
		insEle2=document.getElementById('contac2');
		
		console.log('seleccion');
		
		for (i=0;i<insEle1.length;i++) 
		{
			if (insEle1[i].selected && insEle1[i].value!='') {
				var elOptNew = document.createElement('option');
   			elOptNew.text = insEle1.options[i].text;
  				elOptNew.value = insEle1.options[i].value;
  				insEle2.add(elOptNew,null);
  				insEle1[0].selected=true;
			}
		}
		mosContac();
  }
  
  function dSlcContac()
  {
		insEle2=document.getElementById('contac2');
		for (i=0;i<insEle2.length;i++) 
		{
			if (insEle2[i].selected) {
  				insEle2.remove(i);
			}
		} 
		mosContac();
  }
  
function enterLoadCliente() 
{
        /*if (event.which == 13 || event.keyCode == 13) 
        {
            //code to execute here
            cliente();
            //return false;
        }
        //return true;
        */
       cliente();
}

	
  



	
	

