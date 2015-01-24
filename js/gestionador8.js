$(function() {
$( "#dialog2" ).dialog({
autoOpen: false,
width:510,
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


$(function() {
$( "#dialog3" ).dialog({
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

function getCambNewPopup() 
{
	$( "#dialog2").dialog( "open" );
}

function outCambNewPopup() 
{
	$( "#dialog2").dialog( "close" );
}

window.onload=function()
{
	document.getElementById('cambAct').src="http://www.sbs.gob.pe/app/stats/tc-cv.asp";
	document.getElementById('filCli').style.width='210px';
}

function getPagNewPopup() 
{
	$( "#dialog3").dialog( "open" );
}

function outPagNewPopup() 
{
	$( "#dialog3").dialog( "close" );
}