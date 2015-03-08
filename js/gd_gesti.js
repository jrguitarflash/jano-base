//Load

	window.onload=function()
	{
		var view=document.getElementById('gd_view').value;
		console.log('view:'+ view );

		switch(view)
		{
			case 'gd_listGestAdmin':

				Calendario3('gd_fechGest');

				$(".elem-gd").notify("Gestiones Documentarias","success");

				myVar = setInterval(function () {gd_gestFechxEsta_cont()}, 10000);

			break;

			case 'gd_listGestUser':

				Calendario3('gd_fechGest');

			break;

			case 'gd_fichGestAdmin':

				Calendario3('gd_fechGest');

				$(".elem-gd").notify("Ficha de Gestiones Documentarias","success");

				id=document.getElementById('gd_idGestOcul').value;

				gd_formGest_ini(id); //iniciar form gest doc

			break;

			case 'gd_fichGestUser':

				Calendario3('gd_fechGest');

			break;


			case 'gd_listRutAdmin':

				Calendario3('gd_fechRut');

			break;

			case 'gd_listRutResp':

				Calendario3('gd_fechRut');

			break;

			case 'gd_showRutAdmin':

				Calendario3('gd_fechRut');

			break;

			case 'gd_showRutResp':

				Calendario3('gd_fechRut');

			break;

			case 'gd_fichRutAdmin':

				Calendario3('gd_fechRut');

				Calendario3('gd_fechGest');

				rutId=document.getElementById('gd_idRutOcul').value;
				gd_rutxId_cap(rutId);

				//iniciar detalle ruta
				gd_detRutxId_cap(rutId);

			break;

			default:
			break;
		}
	}

//Functions Events

	$(document).ready(function()
	{
		$('#gd_lnkCreGestAdm').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_fichGestAdmin&id=0";
			gd_direPagParam(url,param);
		});

		$('#gd_lnkCreGestUser').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_fichGestUser&id=0";
			gd_direPagParam(url,param);
		});

		$('#gd_lnkVolGestAdm').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_listGestAdmin";
			gd_direPagParam(url,param);
		});

		$('#gd_lnkVolGestUser').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_listGestUser";
			gd_direPagParam(url,param);
		});

		$('#gd_lnkMarcRut').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_showRutAdmin";
			gd_direPagParam(url,param);
		});

		$('#gd_lnkShowRut').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_showRutResp";
			gd_direPagParam(url,param);
		});

		$('#gd_backRutAdm').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_listRutAdmin";
			gd_direPagParam(url,param);
		});

		$('#gd_backRutResp').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_listRutResp";
			gd_direPagParam(url,param);
		});

		$('#gd_acciSaveGest').click(function(evento)
		{

			doc=document.getElementById('gd_doc').value;
			gest=document.getElementById('gd_gest').value;
			fech=document.getElementById('gd_fechGest').value;
			hora=kd_obteValComb('gd_hour');
			lugar=document.getElementById('gd_lug').value;
			usuId='';
			estaGest=kd_obteValComb('gd_estaGest');
			lati='';
			longi='';

			console.log(estaGest);

			//Peticion Json
			gd_gestDoc_cread(doc,gest,fech,hora,lugar,usuId,estaGest,lati,longi);

		});

		$('#gd_estaGest').click(function(evento)
		{
			fechGest=document.getElementById('gd_fechGest').value;
			estaId=kd_obteValComb('gd_estaGest');

			console.log(estaId);

			gd_gestDoc_cont(estaId,fechGest);
		});

		$('#gd_pagEle').click(function(evento)
		{
			pagGest=kd_obteValComb('gd_pagEle');
			estaId=kd_obteValComb('gd_estaGest');
			fechGest=document.getElementById('gd_fechGest').value;

			gd_gestDocxLim(pagGest,estaId,fechGest);
		});

		$('#gd_creadRut').click(function(evento)
		{
			url="index.php";
			param="menu_id=148&menu=gd_fichRutAdmin";
			param+="&id=0";
			gd_direPagParam(url,param);
		});

		$('#gd_uiGestDoc').click(function(evento)
		{
			if(document.getElementById('gd_idRutOcul').value>0)
			{
				$('#gd_listGest_pop').dialog('open');
			}
			else
			{
				alert("Por favor guardar antes de continuar...!");
			}

		});

		$('#gd_acciSaveRut').click(function(evento)
		{
			respId=kd_obteValComb('gd_respRut');
			admId=0;
			estaRutId=kd_obteValComb('gd_estaRut');
			fechRut=document.getElementById('gd_fechRut').value;
			hourRut=kd_obteValComb('gd_hourRut');

			gd_rutGest_cread(respId,admId,estaRutId,fechRut,hourRut);
		});

		$('#gd_estaRut').click(function(evento)
		{
			estaId=kd_obteValComb('gd_estaRut');
			fechRut=document.getElementById('gd_fechRut').value;
			gd_rutGest_cont(estaId,fechRut);
		});

		$('#gd_pagRut').click(function(evento)
		{
			pagRut=kd_obteValComb('gd_pagRut');
			estaId=kd_obteValComb('gd_estaRut');
			fechRut=document.getElementById('gd_fechRut').value;

			gd_rutxLim_cap(pagRut,estaId,fechRut);
		});

		$('#gd_acciAgreDet').click(function(evento)
		{
			estaVali=kd_obteValComb('gd_estaGest');

			if(estaVali!=1)
			{
				alert("gestiones no validas");
			}
			else
			{
				alert("gestiones pendientes seleccinadas");
				insFrm=document.gd_frmGest.gd_chkGest;
				//console.log(gd_checkData(insFrm));

				data=gd_checkData(insFrm);
				rutId=document.getElementById('gd_idRutOcul').value;
				gd_rutGest_det(rutId,data);
			}

		});

		$('#gd_acciConcreRut').click(function(evento)
		{
			insFrm=document.gd_frmRut.gd_chkRut;
			data=gd_checkData(insFrm);
			gd_detRutxId_concre(data);
		});

	});

//FUnctions

   function gd_ediGest_link(id) //linkear edicion gest
   {
   		url="index.php";
   		param="menu_id=148&menu=gd_fichGestAdmin";
   		param+="&id="+id;
   		gd_direPagParam(url,param);
   }

   function gd_formGest_ini(id)
   {
   		if(id>0)
   		{
   			document.getElementById('gd_numGest').innerHTML=id;
   			gd_gestDocxId_cap(id);
   		}
   }

   function gd_dirMarRut(id)
   {
   		url="index.php";
		param="menu_id=148&menu=gd_showRutAdmin";
		param+="&id="+id;
		gd_direPagParam(url,param);
   }

   function gd_linkEditRut(id)
   {
   		url="index.php";
		param="menu_id=148&menu=gd_fichRutAdmin";
		param+="&id="+id;
		gd_direPagParam(url,param);
   }

   function gd_lnkShowRut(id)
   {
   		url="index.php";
		param="menu_id=148&menu=gd_showRutResp";
		param+="&id="+id;
		gd_direPagParam(url,param);
   }

//Functions UI

	$(function() 
	{
		$( "#gd_listGest_pop" ).dialog({
		autoOpen: false,
		width:920,
		height:590
		/*show: {
		effect: "blind",
		duration: 1000
		},
		hide: {*/
		/*effect: "explode",*/
		/*effect: "blind",
		duration: 1000*/
		//}
		});
	});

//Functions Ajax

	function gd_gestDocxLim(pagGest,estaId,fechGest)
	{
		ajax="gd_gestDocxLim";

		var request = $.ajax(
		{
			url: "ajax/gd_ajax.php",
			type: "POST",
			data: {ajax:ajax,pagGest:pagGest,estaId:estaId,fechGest:fechGest},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#gd_gestDoc_ajax").html( msg );

			//show tot rows
			totRow=$('#gd_gestDoc_ajax >tr').length;
			gd_totRow('gd_valMed',totRow);
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	function gd_rutxLim_cap(pagGest,estaId,fechRut)
	{
		ajax="gd_rutxLim_cap";

		var request = $.ajax(
		{
			url: "ajax/gd_ajax.php",
			type: "POST",
			data: {ajax:ajax,pagGest:pagGest,estaId:estaId,fechRut:fechRut},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#gd_rutGest_ajax").html( msg );

			//show tot rows
			totRow=$('#gd_rutGest_ajax >tr').length;
			gd_totRow('gd_valMed',totRow);
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	function gd_detRutxId_cap(rutId)
	{
		ajax="gd_detRutxId_cap";

		var request = $.ajax(
		{
			url: "ajax/gd_ajax.php",
			type: "POST",
			data: {ajax:ajax,rutId:rutId},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#gd_detRut_ajax").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

//Functions Json

	function gd_gestDoc_cread(doc,gest,fech,hora,lugar,usuId,estaGest,lati,longi)
	{

		id=document.getElementById('gd_idGestOcul').value;

		param="doc="+doc;
		param+="&gest="+gest;
		param+="&fech="+fech;
		param+="&hora="+hora;
		param+="&lugar="+lugar;
		param+="&usuId="+usuId;
		param+="&estaGest="+estaGest;
		param+="&lati="+lati;
		param+="&longi="+longi;
		param+="&json="+gd_petiJson_ele(id,'gd_gestDoc_cread','gd_gestDoc_edit');
		param+="&idGest="+id;

		$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
		{

			if(data[0]>0)
			{
				$(".elem-gd").notify("Gestiones Documentarias Añadidas","success");

				//direccionar ruta generada
				id=data[0];
				url="index.php";
				param="menu_id=148&menu=gd_fichGestAdmin&id="+id;
				gd_direPagParam(url,param);
			}
			else
			{
				$(".elem-gd").notify("Gestiones Documentarias No Añadidas","error");			
			}


		});
	}

	function gd_gestDoc_cont(estaId,fechGest)
	{

		param="estaId="+estaId;
		param+="&fechGest="+fechGest;
		param+="&json=gd_gestDoc_cont";

		$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
		{
			//console.log(data);

			//#tot resul
			totResul=data[0];
			
			//#fill pag gest
			gd_fillSelect('gd_pagEle',totResul,5);
			
			//console.log(kd_obteValComb('gd_pagEle'));

			//#call ajax gest
			pagGest=kd_obteValComb('gd_pagEle');
			estaId=kd_obteValComb('gd_estaGest');
			fechGest=document.getElementById('gd_fechGest').value;
			gd_gestDocxLim(pagGest,estaId,fechGest);

			//show tot pag
			gd_totPag('gd_totPag',totResul,5);

		});
	}

	function gd_gestDocxId_cap(id)
	{
		param="json=gd_gestDocxId_cap";
		param+="&gestId="+id;

		$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('gd_usuDes').innerHTML=data[0]['usuDes'];
			np_iniSelect(data[0]['gd_estaGest'],'gd_estaGest');
			document.getElementById('gd_doc').value=data[0]['gd_doc'];
			document.getElementById('gd_gest').value=data[0]['gd_gest'];
			document.getElementById('gd_fechGest').value=data[0]['gd_fech'];
			np_iniSelect(data[0]['gd_hora'],'gd_hour');
			document.getElementById('gd_lug').value=data[0]['gd_lugar'];
		});
	}

	function gd_gestDoc_eli(id)
	{
		param="json=gd_gestDoc_eli";
		param+="&idGest="+id;

		if(confirm("¿ Eliminar Gestion Documentaria ?"))
		{
			$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]==1)
				{
					$(".elem-gd").notify("Gestiones Documentarias Eliminada","success");

					//Listar Data de Gestiones
					fechGest=document.getElementById('gd_fechGest').value;
					estaId=kd_obteValComb('gd_estaGest');
					console.log(estaId);
					gd_gestDoc_cont(estaId,fechGest);

				}
				else
				{
					$(".elem-gd").notify("Gestiones Documentarias No Eliminada","error");			
				}
			});
		}

	}

	function gd_gestFechxEsta_cont()
	{
		param="json=gd_gestFechxEsta_cont";

		$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
		{
			document.getElementById('gd_notiGest').innerHTML="Pendientes Hoy: "+data[0];
		});
	}

	function gd_rutGest_cread(respId,admId,estaRutId,fechRut,hourRut)
	{
		id=document.getElementById('gd_idRutOcul').value;

		param="respId="+respId;
		param+="&admId="+admId;
		param+="&estaRutId="+estaRutId;
		param+="&fechRut="+fechRut;
		param+="&hourRut="+hourRut;
		param+="&json="+gd_petiJson_ele(id,'gd_rutGest_cread','gd_rutGest_actu');
		param+="&idRut="+id;

		$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				$(".elem-gd").notify("Rutas de gestiones añadidas","success");

				//direccionar ruta generada
				id=data[0];
				url="index.php";
				param="menu_id=148&menu=gd_fichRutAdmin&id="+id;
				gd_direPagParam(url,param);
			}
			else
			{
				$(".elem-gd").notify("Rutas de gestiones no añadidas","error");
			}
		});
	}

	function gd_rutxId_cap(rutId)
	{
		param="rutId="+rutId;
		param+="&json=gd_rutxId_cap";

		$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data.length>0)
			{
				console.log("Data obtenida");
				gd_enviInner('gd_correRut',data[0]['gd_correRut']);
				gd_enviValText('gd_fechRut',data[0]['gd_fechRut']);
				np_iniSelect(data[0]['gd_estaRutId'],'gd_estaRut');
				np_iniSelect(data[0]['gd_hourRut'],'gd_hourRut');
				np_iniSelect(data[0]['gd_respId'],'gd_respRut');
			}
			else
			{
				console.log("No se encontro Data");
			}
		});
	}

	function gd_rutGest_cont(estaId,fechRut)
	{
		param="estaId="+estaId;
		param+="&fechRut="+fechRut;
		param+="&json=gd_rutGest_cont";

		$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
		{

			//console.log(data);

			//#tot resul
			totResul=data[0];
			
			//#fill pag gest
			gd_fillSelect('gd_pagRut',totResul,5);
			
			//console.log(kd_obteValComb('gd_pagEle'));

			//#call ajax gest
			pagRut=kd_obteValComb('gd_pagRut');
			estaId=kd_obteValComb('gd_estaRut');
			fechRut=document.getElementById('gd_fechRut').value;
			//gd_gestDocxLim(pagRut,estaId,fechRut);
			gd_rutxLim_cap(pagRut,estaId,fechRut);

			//show tot pag
			gd_totPag('gd_totPag',totResul,5);

		});
	}

	function gd_rutGest_eli(rutId)
	{
		param="json=gd_rutGest_eli";
		param+="&rutId="+rutId;

		if(confirm("Eliminar ruta seleccionada"))
		{
			$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					$(".elem-gd").notify("Rutas eliminada","success");

					//obtener rutas
					pagRut=kd_obteValComb('gd_pagRut');
					estaId=kd_obteValComb('gd_estaRut');
					fechRut=document.getElementById('gd_fechRut').value;
					gd_rutxLim_cap(pagRut,estaId,fechRut); 
				}
				else
				{
					$(".elem-gd").notify("Rutas no eliminada","error");
				}
			});
		}
	}

	function gd_rutGest_det(rutId,data)
	{	
		json="gd_rutGest_det";

		$.ajax({
	    type:"POST",
	    url: 'json/gd_json.php',
	    data:{rutId:rutId,gestDocId:data,json:json},
	    dataType: 'json',
	    success: function(data) 
	    {
	    	if(data[0]>0)
			{
				$(".elem-gd").notify("Detalle de ruta añadida","success");

				//obtener gestiones de rutas
				pagGest=kd_obteValComb('gd_pagEle');
				estaId=kd_obteValComb('gd_estaGest');
				fechGest=document.getElementById('gd_fechGest').value;

				gd_gestDocxLim(pagGest,estaId,fechGest);

				//iniciar detalle ruta
				rutId=document.getElementById('gd_idRutOcul').value;
				gd_detRutxId_cap(rutId);
			}
			else
			{

				$(".elem-gd").notify("Detalle no añadido","error");	
			}
		}

	    });
	}

	function gd_detRutxId_eli(detRutId)
	{
		param="json=gd_detRutxId_eli";
		param+="&detRutId="+detRutId;

		if(confirm("Eliminar detalle de ruta"))
		{
			$.getJSON('json/gd_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					$(".elem-gd").notify("Detalle de ruta eliminado","success");

					//iniciar detalle ruta
					rutId=document.getElementById('gd_idRutOcul').value;
					gd_detRutxId_cap(rutId);
				}

			});
		}
	}

	function gd_detRutxId_concre(data)
	{
		rutId=new Array();
		rutId=data;

		json="gd_detRutxId_concre";

		$.ajax({
	    type:"POST",
	    url: 'json/gd_json.php',
	    data:{rutId:rutId,gestDocId:data,json:json},
	    dataType: 'json',
	    success: function(data) 
	    {
	    	if(confirm("Concretar las rutas seleccionadas"))
	    	{
		    	if(data[0]>0)
		    	{
		    		$(".elem-gd").notify("Rutas concretadas correctamente","success");

		    		//capturar rutas
		    		pagRut=kd_obteValComb('gd_pagRut');
					estaId=kd_obteValComb('gd_estaRut');
					fechRut=document.getElementById('gd_fechRut').value;

					gd_rutxLim_cap(pagRut,estaId,fechRut);
		    	}
		    	else
		    	{
		    		$(".elem-gd").notify("Rutas no concretadas","error");
		    	}
	    	}
	    }

		});
	}