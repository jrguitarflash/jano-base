/*  Gestionador del modulo de observacion */

window.onload=function () 
{

	Calendario3('txtFechRe');
	Calendario3('txtFechLi');
	Calendario3('txtFechAcor');
	Calendario3('txtFechVeri');
	Calendario3('txtFechEfec');
	Calendario3('txtFecEfecSatis');
	Calendario3('txtFechNoConf');
	Calendario3('txtFechSegAud');
	setTimeout('oculNoti()',2100);
	document.getElementById('filCli').value=document.getElementById('filCliDupli').value;

}

function oculNoti()
{
	document.getElementById('success').style.display='none';
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

	function getEmpPopup() 
	{
		$( "#dialog4" ).dialog( "open" );
	}

	function outEmpPopup()
	{
		$( "#dialog4" ).dialog( "close" );
		getEmp();
		//setTimeout('freshVisi()',1200);
		setTimeout('ajaxComboEmp()',3200);
	}

	function getContacPopup() 
	{
		$( "#dialog2" ).dialog( "open" );
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
			
		function clearFormContac()
		{
			document.getElementById('txtNom').value="";
			document.getElementById('txtApePat').value="";
			document.getElementById('txtApMat').value="";
			document.getElementById('txtTel').value="";
			document.getElementById('txtEmail').value="";
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
	
function saveFormatRecla()
{
	if (frmRecla.filCli.value=='') 
	{
		alert('Seleccione un cliente...!');
	}
	else if (document.getElementById('contac').options[document.getElementById('contac').selectedIndex]==null) 
	{
		alert('Seleccione un contacto..!');
	}
	else if (frmRecla.slcResp.options[frmRecla.slcResp.selectedIndex].value=='') 
	{
		alert('Seleccione un responsable....!');	
	}
	else 
	{
		document.frmRecla.accion.value="enviar";
		document.frmRecla.submit();
	}
}


function borrarObsRe(idObs,tare,des)
{
	if (confirm('Confirma borrar la accion correctiva..!')) 
	{
		var opci=tare;
		var idObs=idObs;
		var des=des;
	
		var request = $.ajax({
		url: "ajax/ajaxBorrarObsRe.php",
		type: "POST",
		data: {opci:opci,idObs:idObs,des:des},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#ajaxListRecla").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}
	else 
	{
		alert('Usted cancelo la accion..!');	
	}
}

function editaObsRe(id)
{
	location.href="index.php?menu_id=111&menu=obsr_edit&id="+id;
}

function editFormatRecla()
{
	
	if (frmRecla.filCli.value=='') 
	{
		alert('Seleccione un cliente...!');
	}
	else if (document.getElementById('contac').options[document.getElementById('contac').selectedIndex]==null) 
	{
		alert('Seleccione un contacto..!');
	}
	else if (frmRecla.slcResp.options[frmRecla.slcResp.selectedIndex].value=='') 
	{
		alert('Seleccione un responsable....!');	
	}
	else 
	{
	document.frmRecla.accion.value="enviar";
	document.frmRecla.submit();
	}
}

function geneObsRecla(id)
{
	var a = document.createElement('a');
	a.href="reporte/reporte_obs_recla.php?id="+id;
	a.target = '_blank';
	document.body.appendChild(a);
	a.click();
}

function borrarObsQue(idObs,tare,des)
{
	if (confirm('Confirma borrar la queja seleccionada..!')) 
	{
		var opci=tare;
		var idObs=idObs;
		var des=des;
	
		var request = $.ajax({
		url: "ajax/ajaxBorrarObsQue.php",
		type: "POST",
		data: {opci:opci,idObs:idObs,des:des},
		dataType: "html"
		});
		
		request.done(function(msg) {
			
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		
		$("#ajaxListRecla").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}
	else 
	{
		alert('Usted cancelo la accion..!');	
	}
}

function editaObsQue(id)
{
	location.href="index.php?menu_id=112&menu=obsq_edit&id="+id;
}