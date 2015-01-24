	$(function() 
	{
		$( "#tabs" ).tabs();
	});

	function include(archivo)
	{
	  var nuevo = document.createElement("script");
	  nuevo.setAttribute("type", "text/javascript");
	  nuevo.setAttribute("src", archivo);
	  document.getElementsByTagName("head")[0].appendChild(nuevo);
	} 

	function iniComboEmp() 
	{
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
		
		$.getJSON('json/jsonGetDirexEmp.php?emp='+val,{format: "json"}, function(data) 
		{
			document.getElementById('txaDire').value=data['dire'];
		});
		
		var request = $.ajax({
		url: "ajax/ajaxConsulContac.php",
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
		url: "ajax/ajaxConsulContacNuevo.php",
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
		

			//var instValContac=document.getElementById('contac');
			var instValObs=document.getElementById('obsVisi');
			var instValEmp=document.getElementById('filCli');
			var instObsPen=document.getElementById('obsPen');
			var instConEle=document.getElementById('contacElegi');
			var instDire=document.getElementById('txaDire');

			// ---- Values direccion origen & fecha visita ----- //

			var valDirOrig=document.getElementById('vi_dirOrigen').value;
			var valFechVisi=document.getElementById('vi_fechVisi').value;

			document.getElementById('vi_dirOrigen').value="";
			document.getElementById('vi_fechVisi').value="";

			// --------------------- [] --------------------------- //
			
			var getVal=id;
			//var getValContac=instValContac.options[instValContac.selectedIndex].value;
			var tareDet=tare;
			var getValObs=instValObs.value;
			var getValEmp=instValEmp.value;
			var getValObsPen=instObsPen.value;
			var getValDire=document.getElementById('txaDire').value;

			//iniciar id visi
			idVisi=document.getElementById('vi_id').value;
			
			instValObs.value="";
			instObsPen.value="";
			checkboxes.options.length="";
			//instValContac.options.length="";
			instValEmp.value="";
			instConEle.innerHTML="";
			instDire.value="";
		
		//alert(val);
		//console.log(getValContac);	
		
		var request = $.ajax({
		url: "ajax/ajaxGestDetVisi.php",
		type: "POST",
		data: {getVal: getVal,
			   tareDet: tareDet,
			   getValObs:getValObs,
			   getValEmp:getValEmp,
			   getVectContac:valoresContac,
			   getValObsPen:getValObsPen,
			   getValDire:getValDire,
			   valDirOrig:valDirOrig,
			   valFechVisi:valFechVisi,
			   idVisi:idVisi},
		dataType: "html"
		});
		
		request.done(function(msg) 
		{

			//document.getElementById('scInventario').value='';
			//var acontenidoAjax = a('#loading').html('');


			if(idVisi==0)
			{
				$("#ajaxDetVisi").html( msg );
			}
			else
			{
				//iniciar detalle de visitas
				vi_visixId_ini();
			}

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
		
		if (confirm('Confirma borrar la visita'))
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
		else
		{
			alert('Usted ha cancelado la operacion');	
		}
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
		$("#ajaxListRecla").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}

	/*------------------- JS - DETALLE PASAJES --------------------------------*/

	function vi_uiDetPas_open()
	{
		/*

			if(document.getElementById('vi_cantPas').value>0)
			{
				$('#vi_uiDetPas').dialog('open');
				vi_geneDetPas();
			}
			else
			{
				alert("Completar cantidad de pasajes....!");
			}
		
		*/

		$('#vi_uiDetPas').dialog('open');
		vi_geneDetPasDina();
	}

	function vi_uiDetPas_show()
	{

		$('#vi_uiDetPas').dialog('open');
	}

	function vi_uiDetPas_acep()
	{

		$('#vi_uiDetPas').dialog('close');
		//cantDetPas=document.getElementById('vi_cantPas').value;
		//console.log(insDetPas.length);
		var totPas=parseFloat(0);

		cadPasDes="";
		cadPasMont="";
		ind1=0;
		ind2=0;

		//document.getElementById('detPasDes_0').value="";
		document.getElementById('detPasMont_0').value="";

		/*

			for(i=0;i<=cantDetPas;i++)
			{
				if(document.getElementById('detPasMont_'+i).value>0)
				{
					totPas=totPas+parseFloat(document.getElementById('detPasMont_'+i).value);
				}
			}

		*/
		
		
		/*

			$('#detPasMont').each(function()
			{

			});

		*/

		/*

			var x = $('input[name="detPasMont[]"]').val();
			console.log(x);
		
		*/

		$('input[name="detPasMont[]"]').each(function() 
		{
			var aValue = parseFloat($(this).val()); 
			console.log(aValue);
			//if(aValue>0 && document.getElementById('detPasDes_'+ind1).value!='')

			/*

			if( typeof aValue=="number")
			{
				aValue=aValue;
			}
			else
			{
				aValue=0;
			}

			*/

			if(isNaN(aValue))
			{
				aValue=0.00;	
			}

			if(ind2>=1)
			{

				if(aValue>0)
				{
					totPas=totPas+aValue;
					if(ind2==1)
					{
						//cadPasDes=cadPasDes+document.getElementById('detPasDes_'+ind1).value;
						cadPasMont=cadPasMont+aValue;
					}	
					else
					{
						//cadPasDes=cadPasDes+"|"+document.getElementById('detPasDes_'+ind1).value;
						cadPasMont=cadPasMont+"|"+aValue;
					}

					ind2++;	
				}
				else
				{
					if(ind2==1)
					{
						//cadPasDes=cadPasDes+document.getElementById('detPasDes_'+ind1).value;
						cadPasMont=cadPasMont+aValue;
					}	
					else
					{
						//cadPasDes=cadPasDes+"|"+document.getElementById('detPasDes_'+ind1).value;
						cadPasMont=cadPasMont+"|"+aValue;
					}

					ind2++;		
				}

			}
			else
			{
				ind2++
			}

			ind1++;
		});

		document.getElementById('txtPasa').value=totPas.toFixed(2);

		//obtener valores concatenados
		//document.getElementById('detPasDes_0').value=cadPasDes;

		document.getElementById('detPasMont_0').value=cadPasMont;

		//console vars
		console.log(totPas);
		//console.log(cadPasDes);
		console.log(cadPasMont);
	}

	function vi_geneDetPas()
	{
		cantDetPas=document.getElementById('vi_cantPas').value;
		campDina="";
		ind=1;

		for(i=0;i<cantDetPas;i++)
		{
			campDina+="<label id='lbl2' >N°"+ind+":</label><textarea class='campo' name='detPasDes[]' id='detPasDes_"+(ind)+"' placeholder='ingresar detalle' ></textarea>";
			campDina+="</label><input class='campo' type='text' name='detPasMont[]' id='detPasMont_"+(ind++)+"' placeholder='ingresar monto' ><br>";
		}

			campDina+="<label id='lbl2' ></label><button class='campo' onclick='vi_uiDetPas_acep()' >Aceptar</button>";

		document.getElementById('vi_uiDetPas').innerHTML=campDina;			
	}

	function vi_geneDetPasDina()
	{
		//ini id visi
		idVisi=document.getElementById('vi_id').value;

		console.log("Generando campos dinamicos de detalle pasaje...!");
		param="json=vi_geneForm";
		param+="&idVisi="+idVisi;
		ind=1;

		$.getJSON('json/vi_json.php?'+param,{format: "json"}, function(data) 
		{

			console.log(data);
			campDina="";

			for(i=0;i<data.length;i++)
			{
				campDina+="<label id='lbl2' >Punto Origen N°"+ind+":</label><textarea class='campo' name='detPasOri[]' id='detPasDes_"+(ind)+"' placeholder='ingresar detalle' disabled>"+data[i]['dirOrig']+"</textarea>";
				campDina+="<label class='campo' >Punto Destino N°"+ind+":</label><div class='campo vi_puntDes' name='detPasDes[]' id='detPasDes_"+(ind)+"' placeholder='ingresar detalle' disabled >"+data[i]['direccion']+" <b>("+(data[i]['empresa'])+")</b> "+"</div>";
				campDina+="</label><input class='campo' type='text' name='detPasMont[]' id='detPasMont_"+(ind++)+"' placeholder='ingresar monto' ><br>";
			}

			campDina+="<label id='lbl2' ></label><button class='campo' onclick='vi_uiDetPas_acep()' >Aceptar</button>";

			document.getElementById('vi_uiDetPas').innerHTML=campDina;

		});
	}

	/*-------------------------------- [*] -------------------------------------*/

	
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
		//setTimeout('cargList()',12000)
		//location.href="index.php?menu_id=102&menu=reclamo_lista&filtro=4";
		console.log(idRecla);
	}

	function outGastosPopup()
	{
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

	function setDetVisitas()
	{

		$( "#dialog3" ).dialog( "close" );
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

/* ------------------------------- CODIGO NO UTILIZADO ---------------------------------- */

	//Agregar un nuevo evento a cualquier elemento


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

/*--------------------------------------[*]---------------------------------------------- */

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
  
    /*----------------------------- SELECCION Y DESELECCION DE CONTACTOS ------------------------ */
  
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

    /*--------------------------------------------[*]---------------------------------------------*/

//FUNCTION LOAD

	window.onload=function()
	{
		//iniciar vista
		view=document.getElementById('vi_view').value;

		//controlador load view
		switch(view)
		{
			case 'visita_reporte':

				console.log(view);

				vi_visixId_ini();

				Calendario3('txtFechIni');
				Calendario3('txtFechFin');

				//---- add fech visi ---//
				Calendario3('vi_fechVisi');
				//-------- [*] ------ //

				contacElegi=document.getElementById('contacElegi');
				contacElegi.addEventListener("click",funPrueba, false);
				
				//contac=document.getElementById('contac');
				//contac.addEventListener("click",mosContac, false);
				
				//document.getElementById('filCli').value=document.getElementById('nomCli').value;

				//inicio de complete
				iniComboEmp();
				comboEmpDina();

			break;

			case 'historial_visita':

				console.log(view);

				//iniciar calendario
				Calendario('txtFechIni');

				//inicio de complete
				iniComboEmp();
				comboEmpDina();

			break;

			case 'vi_visiIng_lst':

				console.log(view);

				//iniciar calendario
				Calendario('vi_fechVisi');

				vi_visixVend_obte();

			break;

			default:

				console.log("No found view");

			break;
		}

	}

//FUNCTION EVENTS

	$(document).ready(function()
	{

		$('#vi_newVisi').click(function(evento)
		{
			url="index.php";
			param="menu_id=107&menu=visita_reporte&id=0";
			gd_direPagParam(url,param);
		});

		$('#vi_volList').click(function(evento)
		{
			url="index.php";
			param="menu_id=157&menu=vi_visiIng_lst";
			gd_direPagParam(url,param);
		});

		$('#vi_fechVisi').keypress(function(evento)
		{
			vi_visixVend_obte();
		});

	});

//FUNCTION AJAX

	function vi_visixVend_obte()
	{
		/*vars*/
		idVende=0;
		fechVisi=document.getElementById('vi_fechVisi').value;
		ajax="vi_visixVend_obte";

		/**param/

		/*peticion ajax*/
		var request = $.ajax(
		{
			url: "ajax/vi_ajax.php",
			type: "POST",
			data: {ajax:ajax,idVende:idVende,fechVisi:fechVisi},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#vi_visiEmp_tab").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	function vi_visixId_ini()
	{
		/*vars*/
		idVisi=document.getElementById('vi_id').value;
		ajax="vi_visixId_ini";

		/*param*/

		/*peticion ajax*/
		var request = $.ajax(
		{
			url: "ajax/vi_ajax.php",
			type: "POST",
			data: {ajax:ajax,idVisi:idVisi},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#vi_detVisi_tab").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});

	}

//FUNCTION JSON

	function vi_detVisi_borra(id)
	{
		//msj
		console.log("loading...!");

		//vars
		idDet=id;
		json="vi_detVisi_borra";

		//params
		param="json="+json;
		param+="&idDet="+idDet;

		if(confirm("¿ Desea eliminar el Detalle de la Visita ?"))
		{
			//peticion json
			$.getJSON('json/vi_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					vi_visixId_ini();
				}
				else
				{
					alert("Visita no eliminada...!");
				}
			});
		}
	}

	function vi_visiResp_borra(id)
	{
		//vars
		visiId=id;
		json="vi_visiResp_borra";

		//param
		param="visiId="+visiId;
		param+="&json="+json;

		if(confirm("¿ Desea eliminar la visita ?"))
		{
			//peticion json
			$.getJSON('json/vi_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					vi_visixVend_obte();
				}
			});
		}
	}

//FUNCTION UI

	$(function() 
	{
		$( "#dialog" ).dialog({
		autoOpen: false,
		width:700,
		height:500,
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
		
	$(function() 
	{
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

	//UI Detalle de Pasajes [vi_uiDetPas]

	$(function() {
		$( "#vi_uiDetPas" ).dialog({
		autoOpen: false,
		width:1200,
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
 
//FUNCTION

	function vi_editVisi_lnk(id)
	{
		url="index.php";
		param="menu_id=107&menu=visita_reporte&id="+id;
		gd_direPagParam(url,param);
	}
  



	
	

