/* Load */

	window.onload=function()
	{
		if(document.getElementById('scc_creadSegui'))
		{
			scc_creadSegui_json1();
			scc_detSegui_json10('alertSeguiPen','avenciSem');
			scc_detSegui_json10('alertSeguiVen','venciSem');
		}
		else if(document.getElementById('scc_detSegui'))
		{
			//Tabs
			$(function() {
			$( "#tabs" ).tabs();
			});

			Calendario3('fechAdel');

			scc_detSegui_json1();

			scc_detSegui_json10('alertSeguiPen','avenciSem');
			scc_detSegui_json10('alertSeguiVen','venciSem');
		}
	}

/* scc_creadSegui */

	//JSON
	function scc_creadSegui_json2()
	{
		valOrd=scc_itemCombo();
	}

	function scc_creadSegui_json1()
	{
		availableTags2=[];

		param="json=centCost";
		$.getJSON('json/scc_creadSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			for(i=0;i<data.length;i++)
			{
				//console.log(data[i]['prod_nombre']);

				//availableTags2[i]['key']=data[i]['producto_id'];
				//availableTags2[i]['value']=data[i]['prod_nombre'];
				
				//availableTags2.add(data[i]['producto_id'],data[i]['prod_nombre']);

				availableTags2.push({key:data[i]['centId'],value:data[i]['centVal']+"-"+data[i]['desProye']});

				//availableTags2[i]['key']=data[i]['producto_id'];
				//availableTags2[i]['value']=data[i]['prod_nombre'];

			}

			console.log(availableTags2);

			/*
				var availableTags = [
				{key: "1",value: "NAME 1"},{key: "2",value: "NAME 2"},{key: "3",value: "NAME 3"},{key: "4",value: "NAME 4"},{key: "5",value: "NAME 5"}
				 ];
			*/

			  $( "#centVal" ).autocomplete({
			  //source: availableTags2

		      minLength: 0,
		      source: availableTags2,
		      focus: function( event, ui ) {
		        $( "#centVal" ).val( ui.item.value );
		        return false;
		      },
		      select: function( event, ui ) {
		        $( "#centVal" ).val( ui.item.value );
		        $( "#centId" ).val( ui.item.key );
		 
		        return false;
		      } 
			  });
		});
	}

	//AJAX

	//JS
	function scc_creadSegui_dirDet(id)
	{
		location.href="index.php?menu_id=138&menu=scc_detSegui&id="+id;
	}

	function scc_creadSegui_eliSegui(id)
	{
		document.scc_creadSegui_frm.accion.value="scc_eliSegui";
		document.scc_creadSegui_frm.accionId.value=id;
		document.scc_creadSegui_frm.method="post";
		document.scc_creadSegui_frm.submit();
	}

	function scc_creadSegui_geneSegui()
	{
		document.scc_creadSegui_frm.accion.value="scc_geneSegui";
		document.scc_creadSegui_frm.accionId.value=document.getElementById('centId').value;
		document.scc_creadSegui_frm.method="post";
		document.scc_creadSegui_frm.submit();
	}

/* scc_detSegui */

	//JSON
	function scc_detSegui_json13(tip)
	{
		// INICAR PARAMETROS

		json="actuPlaz";
		tip=tip;
		idOrd=scc_itemCombo('idOrdAdel');
		plazInter=document.getElementById('scc_plazInter').value;
		plazExt=document.getElementById('scc_plazExt').value;

		// EVALUAR TIPO DE PLAZO
		if(tip==1)
		{
			plaz=plazInter;
		}
		else if(tip==2)
		{
			plaz=plazExt;
		}
		else
		{
			excep="";
		}

		// UNIR PARAMETROS
		param="json="+json;
		param=param+"&tip="+tip;
		param=param+"&plaz="+plaz;
		param=param+"&idOrd="+idOrd;

		// INICIAR INTERCAMBIO JSON

		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				alert("Plazo actualizado correctamente...!");
			}
			else
			{
				alert("Plazo no actualizado.....!");
			}
		});

	}

	function scc_detSegui_json1()
	{
		idOrd=scc_itemCombo('idOrdAdel');
		json="ordComp";
		param="idOrd="+idOrd;
		param=param+"&json="+json;
		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('adelProv').innerHTML=data[0]['proveedor'];
			document.getElementById('adelTerm').innerHTML=data[0]['incoterm'];
			document.getElementById('adelPlaz').innerHTML=data[0]['plazoEntre'];
			document.getElementById('adelMont').innerHTML=data[0]['moneda']+" "+data[0]['monto'];
			document.getElementById('adelEquiServ').innerHTML=data[0]['equipServ'];
			document.getElementById('scc_plazInter').value=data[0]['plazInter'];
			document.getElementById('scc_plazExt').value=data[0]['plazExter'];
			//document.getElementById('plazProv').value=data[0]['plazFab'];
			scc_detSegui_ajax1();
		});
	}

	function scc_detSegui_json2()
	{
		idSegui=document.getElementById('idSegui').value;
		idOrd=scc_itemCombo('idOrdAdel');
		tipAdelId=scc_itemCombo('tipAdel');
		fechAdel=document.getElementById('fechAdel').value;
		desAdel=document.getElementById('desAdel').value;

		param="idSegui="+idSegui;
		param=param+"&idOrd="+idOrd;
		param=param+"&tipAdelId="+tipAdelId;
		param=param+"&fechAdel="+fechAdel;
		param=param+"&desAdel="+desAdel;
		param=param+"&json=ingreAdel";

		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('successPrin').innerHTML=data[0];
			scc_detSegui_ajax1();
		});
	}

	function scc_detSegui_json3(id)
	{
		param="idAdel="+id;
		param=param+"&json=eliAdel";

		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('successPrin').innerHTML=data[0];
			scc_detSegui_ajax1();
		});

	}

	function scc_detSegui_json4(id)
	{
		param="json=prevEdit";
		param=param+"&idAdel="+id;
		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('idAdel').value=data[0]['idAdel'];
			scc_escoItem('tipAdel',data[0]['tipId']);
			document.getElementById('fechAdel').value=data[0]['fechAdel'];
			document.getElementById('desAdel').value=data[0]['desAdel'];
		});
	}

	function scc_detSegui_json5()
	{

		idAdel=document.getElementById('idAdel').value;
		tipAdelId=scc_itemCombo('tipAdel');
		fechAdel=document.getElementById('fechAdel').value;
		desAdel=document.getElementById('desAdel').value;

		param="idAdel="+idAdel;
		param=param+"&tipAdelId="+tipAdelId;
		param=param+"&fechAdel="+fechAdel;
		param=param+"&desAdel="+desAdel;
		param=param+"&json=editAdel";

		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('successPrin').innerHTML=data[0];
			scc_detSegui_ajax1();
		});
	}

	function scc_detSegui_json9()
	{
		fechRealArrVal=new Array();
		fechRealArrId=new Array();

		insFech=document.scc_detSeguiFrm.fechReal2;
		tamFech=insFech.length;
		for(i=1;i<tamFech;i++)
		{
			fechRealArrVal[i]=document.getElementById('fechReal_'+i).value;
			fechRealArrId[i]=insFech[i].value;
		}

		console.log(fechRealArrVal);
		console.log(fechRealArrId);

		json="actFechReal";

		$.ajax({
        type:"POST",
        url: 'json/scc_detSegui_json.php',
        data:{fechRealArrVal:fechRealArrVal,fechRealArrId:fechRealArrId,json:json},
        dataType: 'json',
        success: function(data) {
            /*alert(data[0]+" "+data[1]+" tam:"+data[2]);*/
            document.getElementById('successPrin').innerHTML=data[0];
            scc_loadDetSegui();
        }
	    });

	}

	function scc_detSegui_json10(json,id)
	{
		param="json="+json;
		$.getJSON('json/scc_creadSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById(id).innerHTML=data[0];
		});
	}

	function scc_detSegui_json11()
	{
		param="plazProv="+document.getElementById('plazProv').value;
		param=param+"&idOrd="+scc_itemCombo('idOrdAdel');
		param=param+"&json=actuPlazProv";
		console.log(param);
		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('successPrin').innerHTML=data[0];
		});
	}

	function scc_detSegui_json12() //plazAdi_actu
	{
		param="segId="+document.getElementById('idSegui').value; 
		param=param+"&diAd="+document.getElementById('scc_termDay').value;
		param=param+"&json=plazAdi_actu";
		$.getJSON('json/scc_detSegui_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('successPrin').innerHTML=data[0];
		});	
	}


	//AJAX
	function scc_detSegui_ajax1()
	{

		idSegui=document.getElementById('idSegui').value;
		idOrd=scc_itemCombo('idOrdAdel');
		ajax="detAdel";
		var request = $.ajax({
		url: "ajax/scc_detSegui_ajax.php",
		type: "POST",
		data: {idSegui:idSegui,idOrd:idOrd,ajax:ajax},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#scc_detAdelAjax").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}

	function scc_detSegui_ajax2()
	{
		
		idSegui=document.getElementById('idSegui').value;
		ajax="detSegui2";
		var request = $.ajax({
		url: "ajax/scc_detSegui_ajax.php",
		type: "POST",
		data: {idSegui:idSegui,ajax:ajax},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#scc_detSeguiAjax").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}


	//JS
	function scc_itemCombo(id)
	{
		insId=document.getElementById(id);
		valId=insId.options[insId.selectedIndex].value;
		return valId;
	}

	function scc_escoItem(id,val)
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

	function scc_lineTime()
	{
		id=document.getElementById('idSegui').value;
		document.getElementById('scc_timeLine').src="scc_timeLine.php?id="+id;
	}

	function scc_loadDetSegui()
	{
		scc_detSegui_ajax2();
		setTimeout('scc_listFechReal()',1200);
		scc_lineTime();
	}

	function scc_listFechReal()
	{
		insFech=document.scc_detSeguiFrm.fechReal2;
		tamFech=insFech.length;
		for(i=1;i<tamFech;i++)
		{
			Calendario3('fechReal_'+i);
		}
	}

	function scc_geneRepSegui(id)
	{
		location.href="reporteExcel/scc_repSeguiCent.php?id="+id;
	}