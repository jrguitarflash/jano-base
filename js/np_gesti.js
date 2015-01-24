//Load

	window.onload=function()
	{
		view=document.getElementById('np_view').value;

		switch(view)
		{
			case 'np_listNot':

				document.getElementById('np_titView').innerHTML="Notas de Pedidos";
				np_notPed_lis();

			break;

			case 'np_nuevNot':

				document.getElementById('np_titView').innerHTML="Nueva Nota de Pedido";
				Calendario3('np_fech');
				Calendario3('np_fechConfir');
				kd_empMov_json();

			break;

			case 'np_detNot':

				document.getElementById('np_titView').innerHTML="Detalle de Nota de Pedido";
				Calendario3('np_fech');
				Calendario3('np_fechConfir');
				kd_empMov_json();
				np_detNot_cap();
				np_iniSelect(document.getElementById('np_estaId').value,'np_estaNot');
				np_iniSelect(document.getElementById('np_tipId').value,'np_tipMov');

			default:
			break;
		}
	}

//Eventos

	$(document).ready(function()
	{

		$('#np_acciNuevItem').click(function()
		{
			console.log("Accion agregar item a detalle");
			np_acciNuevItem();
		});

		$('#np_acciActuNot').click(function()
		{
			console.log("Accion actualizar nota de pedido...!");
			document.frmNotNuev.method="post";
			document.frmNotNuev.action="";
			document.frmNotNuev.accion.value="np_actuNot";
			document.frmNotNuev.submit();
		});

		$('#np_nuevNot').click(function()
		{
			location.href="index.php?menu_id=146&menu=np_nuevNot";
		});

		$('#np_listNot').click(function()
		{
			location.href="index.php?menu_id=146&menu=np_listNot";
		});

		$('#np_popLine').click(function()
		{
			$('#np_lineProd').dialog('open');
		});

		$('#np_agreLine').click(function()
		{
			np_agreItemLine('','addDet');
		});

		$('#np_acciNuevNot').click(function()
		{
			console.log("Accion nueva nota de pedido...!");
			document.frmNotNuev.method="post";
			document.frmNotNuev.action="";
			document.frmNotNuev.accion.value="np_geneNot";
			document.frmNotNuev.submit();
		});

		$('#np_estaNot').click(function()
		{
			np_notPed_lis();
		});

		$('#np_tipMov').click(function()
		{
			np_notPed_lis();
		});

		$('#np_acciActuEmail').click(function()
		{
			np_mailPer_edit();
		});

		// evento externo de kardex

		$('#lp_txtBusq').change(function(mievento)
		{
			lp_cargBusLine_ajax();
		});

		$('#lp_txtBusq').keyup(function(mievento)
		{
			lp_cargBusLine_ajax();
		});


	});

//Funciones

	function np_trabOpe_cap()
	{
		//parametros
		ajax="trabOpe_cap";

		//peticion ajax
		var request = $.ajax({
		url: "ajax/np_ajax.php",
		type: "POST",
		data: {ajax:ajax},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#np_destiNot").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}

	function np_mailPer_edit()
	{
		//parametro
		perId=document.getElementById('np_perId').value;
		perEmail=document.getElementById('np_emailPer').value;
		json="mailPer_edit";

		//cadena parametro
		param="perId="+perId;
		param=param+"&perEmail="+perEmail;
		param=param+"&json="+json;

		if(np_valiEmail(perEmail))
		{
			//peticion json
			$.getJSON('json/np_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					alert("Email actualizado correctamente..!");
					np_trabOpe_cap();
				}
				else
				{
					alert("Email no actualizado")
				}
			});
		}
		else
		{
			alert("Email no valido...!");
		}

	}

	function np_emailPer_obte(id)
	{
		//parametro
		perId=id;
		json="emailPer_obte";

		//cadena parametro
		param="perId="+perId;
		param=param+"&json="+json;

		//peticion json
		$.getJSON('json/np_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('np_emailPer').value=data[0]['perEmail'];
			document.getElementById('np_nomPer').innerHTML=data[0]['perNom'];
		});
	}

	function np_mailPer_pop(id)
	{
		//console
		console.log("Abriendo popup editar email: "+id);

		//abrir popup
		$('#np_mailPer_pop').dialog('open');

		//enviar id a popup
		document.getElementById('np_perId').value=id;

		//obtener email de persona
		np_emailPer_obte(id);
	}

	function np_genRepNot(id)
	{
		//parametros
		url="reporte/np_repoNot.php";
		param="id";
		val=id;

		//peticion de redireccion
		np_geneRep(url,param,val);
	}

	function np_notPed_eli(id)
	{
		//parametros
		idNot=id;
		json="notPed_eli";

		//cadena parametros
		param="idNot="+idNot;
		param=param+"&json="+json;

		if(confirm("Eliminar nota de pedido...!"))
		{

			//peticion json
			$.getJSON('json/np_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					alert("Nota de pedido eliminado correctamente....!");
					np_notPed_lis();
				}
				else
				{
					alert("Nota de pedido no eliminado...!");
				}
			});

		}

	}

	function np_detNot_eli(id)
	{
		//parametros
		idDet=id;
		json="detNot_eli";

		//cadena de parametros
		param="idDet="+idDet;
		param=param+"&json="+json;

		if(confirm("Eliminar detalle de item....!"))
		{

			//peticion json
			$.getJSON('json/np_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					alert("Item eliminado correctamente...!");
					np_detNot_cap();
				}
				else
				{
					alert("Item no eliminado...!");
				}
			});

		}
	}

	function np_acciNuevItem()
	{
		//parametros
		cant=document.getElementById('np_cantProd').value;
		idLine=0;

		//Obtener item de linea seleccionado
		insLine=document.frmLineProd.kd_lineId;
		for(i=0;i<insLine.length;i++)
		{
			if(insLine[i].checked)
			{
				idLine=insLine[i].value;
			}
		}

		//parametros
		cant=cant;
		idLine=idLine;
		idDet=document.getElementById('np_detId').value;
		json="acciNuevItem";

		//cadena parametros
		param="cant="+cant;
		param=param+"&idLine="+idLine;
		param=param+"&json="+json;
		param=param+"&idNot="+idDet;

		if((cant/cant)!=1)
		{
			alert("Cantidad no valida");
		}
		else if(idLine==0)
		{
			alert("Seleccionar item de linea");
		}
		else
		{

			$.getJSON('json/np_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					alert("item añadido correctamente..!");
					np_detNot_cap();
				}
				else
				{
					alert("item no añadido...!");
				}
			});

		}
	}

	function np_detNot_cap()
	{
		//obtener parametros
		valNotId=document.getElementById('np_detId').value;
		ajax="detNot_cap";

		//peticion ajax
		var request = $.ajax({
		url: "ajax/np_ajax.php",
		type: "POST",
		data: {ajax:ajax,valNotId:valNotId},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#np_detNot").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});

	}

	function np_detDir(id)
	{
		location.href="index.php?menu_id=146&menu=np_detNot&id="+id;
	}

	function np_notPed_lis()
	{
		//iniciar parametros
		insEsta=document.getElementById('np_estaNot');
		valEsta=insEsta.options[insEsta.selectedIndex].value;
		insTip=document.getElementById('np_tipMov');
		valTip=insTip.options[insTip.selectedIndex].value;
		ajax="notPed_lis";

		//peticion ajax
		var request = $.ajax({
		url: "ajax/np_ajax.php",
		type: "POST",
		data: {ajax:ajax,valTip:valTip,valEsta:valEsta},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#np_lisNot").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});

	}

	function np_agreItemLine(ind,ope)
	{
		cant=document.getElementById('np_cantProd').value;
		idLine=0;

		//Obtener item de linea seleccionado
		insLine=document.frmLineProd.kd_lineId;
		for(i=0;i<insLine.length;i++)
		{
			if(insLine[i].checked)
			{
				idLine=insLine[i].value;
			}
		}

		//parametros
		cant=cant;
		idLine=idLine;
		ind=ind;
		ope=ope;
		ajax="detNot";

		if(ope=="delDet")
		{
			np_detNot(cant,idLine,ind,ope,ajax);
		}
		else
		{
			if((cant/cant)!=1)
			{
				alert("Cantidad no valida");
			}
			else if(idLine==0)
			{
				alert("Seleccionar item de linea");
			}
			else
			{

				np_detNot(cant,idLine,ind,ope,ajax);
			}
		}

	}

	function np_detNot(cant,idLine,ind,ope,ajax)
	{
		console.log("cantidad valida:"+cant);
		console.log("Item de linea valido:"+idLine)

		//parametros
		cant=cant;
		idLine=idLine;
		ind=ind;
		ope=ope;
		ajax="detNot";

		var request = $.ajax({
		url: "ajax/np_ajax.php",
		type: "POST",
		data: {ajax:ajax,cant:cant,idLine:idLine,ind:ind,ope:ope},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#np_detNot").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}

	//funcion externa de linea

	function lp_cargBusLine_ajax()
	{
		//MSG
		console.log("msg");

		//alert("filtraremos la busqueda....! "+document.getElementById('lp_txtBusq').value);

		desBus=document.getElementById('lp_txtBusq').value
		tare="filtro";
		ajax="busLineProd";

		var request = $.ajax({
		url: "ajax/kd_ajax.php",
		type: "POST",
		data: {ajax:ajax,desBus:desBus,tare:tare},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#kd_lineProd_ajax").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});

	}

	//funcion externa de kardex

	function kd_empMov_json()
	{
		availableTags2=[];

		filBus='tod';

		param="json=emp_obte";
		param=param+"&filBus="+filBus;
		$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
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

			  $( "#np_cliDes" ).autocomplete({
			  //source: availableTags2

		      minLength: 0,
		      source: availableTags2,
		      focus: function( event, ui ) {
		        $( "#np_cliDes" ).val( ui.item.value );
		        return false;
		      },
		      select: function( event, ui ) {
		        $( "#np_cliDes" ).val( ui.item.value );
		        $( "#np_cliId" ).val( ui.item.key );
		 
		        return false;
		      } 
			  });
		});
	}

//Interfaces

	$(function() 
	{
		$( "#np_lineProd" ).dialog({
		autoOpen: false,
		width:920,
		height:520
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
		$( "#np_mailPer_pop" ).dialog({
		autoOpen: false,
		width:570,
		height:220
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
