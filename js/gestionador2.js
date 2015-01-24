$(function() {
$( "#tabs" ).tabs();
});


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
	.attr( "onchange", "Javascript:setTimeout('ajaxGetRucCli()',1000);" )
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

function ajaxGetRucCli()
{

	var valCli=document.getElementById('filCli').value;
	
	//alert(val);
	var request = $.ajax({
	url: "ajax/ajaxGetRucCli.php",
	type: "POST",
	data: {valCli: valCli},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxRucCli").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

window.onload=function () 
{
	
	Calendario('txtFech');	
	Calendario('txtFechCu');
	Calendario('txtFechEdit');
	
	$(function() {
	$( "#dialog" ).dialog({
	autoOpen: false,
	width:700,
	height:520,
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
	height:420,
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
	
	loadCli();
}

function loadCli()
{
	document.getElementById('filCli').value=document.getElementById('virEmp').value;
}

function getAmorCuen() 
{
	$( "#dialog" ).dialog( "open" );
}

function getCombosDetCu(id,val,data)
{
		var insBan=document.getElementById(id);
		lenBan=insBan.length;
		for (i=0;i<lenBan;i++) 
		{
			if (insBan[i].value==data[0][val]) 
			{
				insBan[i].selected=true;			
			}					
		}
}

function getEditCuen(idDet) 
{
	$( "#dialog2" ).dialog( "open" );
	console.log(idDet);
	dataCom=new Array();
	
	$.getJSON('json/jsonGetDetCuxCob.php?idDet='+idDet,{format: "json"}, function(data) 
	{
		console.log(data[0]['fecha']);
		console.log("Banco:"+data[0]['idBan']);
		
		document.getElementById('txtFechEdit').value=data[0]['fecha'];
		document.getElementById('txtMonEdit').value=data[0]['monto'];
		
		dataCom=data;
		console.log(dataCom[0]['idCuBanco']);
	
		getCombosDetCu('slcBancoEdit','idBan',dataCom);
		ajaxGetCuen('edit');
		setTimeout("getCombosDetCu('slcCuentaEdit','idCuBanco',dataCom)",1700);
		getCombosDetCu('slcEstaEdit','idCuEstado',dataCom);
		document.getElementById('idDetCu').value=idDet;
								
	});
}

function setDetCuen(tare,id)
{
		
	var getVal=id;
	var tareDet=tare;
	
	insCuen=document.getElementById('slcCuenta');
	var getValCuen=insCuen.options[insCuen.selectedIndex].value;
	
	var getValFecha=document.getElementById('txtFech').value;
	
	var getValMonto=document.getElementById('txtMon').value;
	
	var getValEsta=document.getElementById('slcEsta').value;
	
	//alert(val);
	//console.log(getValContac);
	console.log(getValCuen);
	
	var request = $.ajax({
	url: "ajax/ajaxGestDetCuen.php",
	type: "POST",
	data: {getVal: getVal,tareDet: tareDet,getValCuen:getValCuen,getValFecha:getValFecha,getValMonto:getValMonto,getValEsta:getValEsta },
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetCuen").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function setEliCuen(tare,id)
{
	
	var getVal=id;
	var tareDet=tare;
	
	//alert(val);
	//console.log(getValContac);	
	
	var request = $.ajax({
	url: "ajax/ajaxGestDetCuen.php",
	type: "POST",
	data: {getVal: getVal,tareDet: tareDet},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetCuen").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function grabCuen()
{
	document.cuentax_form.submit();
}

function ajaxGetCuen(tare)
{
	//alert(val);
	//console.log(getValContac);
	
	if (tare=='noEdit') 
	{
		insBan=document.getElementById('slcBanco');
		var getVal=insBan.options[insBan.selectedIndex].value;
		var conteAjax="#slcCuenta";
	}else if (tare=='edit') 
	{
		insBan=document.getElementById('slcBancoEdit');
		var getVal=insBan.options[insBan.selectedIndex].value;
		var conteAjax="#slcCuentaEdit";
	}
	else 
	{
		console.log('no existe accion');
	}
	
	var request = $.ajax({
	url: "ajax/ajaxGetCuen.php",
	type: "POST",
	data: {getVal: getVal},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$(conteAjax).html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function addEditCuxCob(idCu,slcCu,fech,mon,slcEst)
{
	dataCuxCob=new Array();	
	
	dataCuxCob[0]=document.getElementById(idCu).value;
	
	insCuen=document.getElementById(slcCu);
	dataCuxCob[1]=insCuen.options[insCuen.selectedIndex].value;
	
	dataCuxCob[2]=document.getElementById(fech).value;
	
	dataCuxCob[3]=document.getElementById(mon).value;
	
	dataCuxCob[4]=document.getElementById(slcEst).value;
	
	return dataCuxCob;
}

function ajaxAgreDetCu(tare,idDet)
{
	
	//alert(val);
	//console.log(getValContac);
	
	dataCuxCob=new Array();

	if (tare=='add') 
	{
		dataCuxCob=addEditCuxCob('idCu','slcCuenta','txtFech','txtMon','slcEsta');
	}
	else if (tare=='actu')
	{
		dataCuxCob=addEditCuxCob('idCu','slcCuentaEdit','txtFechEdit','txtMonEdit','slcEstaEdit');
		idDet=document.getElementById('idDetCu').value
	}
	else 
	{
		console.log('ninguna accion asignada');
		dataCuxCob[0]=document.getElementById('idCu').value;
	}

	console.log(dataCuxCob[0]);
	
	var request = $.ajax({
	url: "ajax/ajaxAgreDetCu.php",
	type: "POST",
	data: {dataCuxCob:dataCuxCob,tare:tare,idDet:idDet},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetCuen").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function grabActCu()
{
	document.cuentax_edit.submit();
}
	
  



	
	

