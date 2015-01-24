//Load
	window.onload=function()
	{
		view=document.getElementById('nc_view').value;

		switch(view)
		{
			case 'nc_noConform_frm':

				//vista actual
				console.log(view);

				//inicio de tabs
				$(function() 
				{
					$( "#tabs" ).tabs();
				});

				//parametros centros autocomplete
				nc_centCost_obte();

				//inicio de inputs fecha
				Calendario3('nc_fechRecep');
				Calendario3('nc_fechCie');
				Calendario3('nc_fechCorrec');

				//iniciar no conformidad
				nc_noConforxId_obte();

				//iniciar archivos adjuntos
				nc_infoAdju_obte();

				//iniciar detalle de equipos
				nc_detEquipxId_obte();

				//iniciar medidas correctivas
				nc_medCorrec_obte();

				//#New update 26/12/2014 - CLOSE

				//carga ajax observacion
				setTimeout("nc_tipConfxId_obte()",1200);
				setTimeout("nc_noConforxId_obte()",1500);

				//New update 08/01/2015 - CLOSE
				//			 12/01/2015			

				Calendario3('nc_fechPrev');
				nc_medPrev_obte();

			break;

			case 'nc_noConform_lst':

				//inicio de inputs fecha
				Calendario3('nc_fechRecep');

				//iniciar paginado
				nc_noConforxFil_cont();

			break;

			case 'nc_noConform_prc':

				//iniciar calendarios fechas
				Calendario3('nc_fechIni');
				Calendario3('nc_fechFin');

			break;

			default:
			break;
		}
	}

//Functions Events

	$(document).ready(function()
	{
		$('#nc_nuevMed_pop').click(function(evento)
		{
			id=document.getElementById('nc_id').value;
			if(id>0)
			{
				$('#nc_medCorre_pop').dialog('open');
				//iniciar id nuevo
				document.getElementById('nc_medId').value=0;

				//limpiar form
				nc_frmMed_reini();
			}
			else
			{
				alert("guardar antes de continuar...!");
			}
		});

		$('#nc_nuevEquip_pop').click(function(evento)
		{
			if(document.getElementById('nc_id').value>0)
			{
				$('#nc_equiProye_pop').dialog('open');
				nc_ordexCent_obte();
			}
			else
			{
				alert("Por favor guardar el proyecto seleccionado...!");
			}

		});

		$('#nc_nuevConfor_lnk').click(function(evento)
		{
			url="index.php";
			param="menu_id=154&menu=nc_noConform_frm&id=0";
			gd_direPagParam(url,param);
		});

		$('#nc_volList_lnk').click(function(evento)
		{
			url="index.php";
			param="menu_id=155&menu=nc_noConform_lst";
			gd_direPagParam(url,param);
		});

		$('#nc_saveConfor_acci').click(function(evento)
		{
			nc_noConfor_cre();
		});

		$('#nc_ccDes').keyup(function(evento)
		{
			nc_datCent_obte();
		});

		$('#nc_nroComp').click(function(evento)
		{
			nc_detxOrd_obte();
		});

		$('#nc_estaConfor').click(function(evento)
		{
			nc_noConforxFil_cont();
		});

		$('#nc_pagEle').click(function(evento)
		{
			nc_noConfor_obte();
		});

		$('#nc_agreAdju_acci').click(function(evento)
		{
			conforId=document.getElementById('nc_id').value;

			if(conforId>0)
			{
				document.nc_adju_frm.method='post';
				document.nc_adju_frm.target='nc_iframe';
				document.nc_adju_frm.action='iframe/nc_iframe.php';
				document.nc_adju_frm.nc_iframe_peti.value="nc_infoNoConfor_adju";
				document.nc_adju_frm.nc_conforId_adju.value=conforId;
				document.nc_adju_frm.submit();
			}
			else
			{
				alert("Guardar no conformidad antes de continuar...!");
			}
			
		});

		$('#nc_detEquip_add').click(function(evento)
		{
			nc_detEquip_cre();
		});

		$('#nc_saveMed_acci').click(function(evento)
		{
			nc_medCorre_cre();
		});

		$('#nc_fechFin').keypress(function(evento)
		{
			console.log("Enviando peticion a iframe...");

			document.nc_prcConfor_frm.method='get';
			document.nc_prcConfor_frm.target='nc_prcConfor_iframe';
			document.nc_prcConfor_frm.action='reporte/nc_repPorce.php';
			document.nc_prcConfor_frm.submit();

		});

		$('#nc_obsPrin').click(function(evento)
		{
			console.log("peticion evento");
			nc_tipConfxId_obte();
		});

		//New update 26/12/2014 - CLOSE
		$('#nc_obsLst').click(function(evento)
		{
			//nc_noConfor_obte();
			nc_noConforxFil_cont();
		});

		//New update 08/12/2015 - CLOSE
		//			 12/01/2015

		$('#nc_nuevPrev').click(function(evento)
		{
			$('#nc_medPrev_pop').dialog('open');

			//reiniciar params
			document.getElementById('nc_ordPrev').innerHTML="----";
			document.getElementById('nc_prevId').value=0;
		});

		$('#nc_savePrev_acci').click(function(evento)
		{
			//alert("enviando prevencion...!");
			nc_medPrev_cre();
		});

		//New update 13/01/2015 - CLOSE

		$('#nc_exporConfor_lnk').click(function(evento)
		{
			//alert("exportando no conformidades....!");
			fech=document.getElementById('nc_fechRecep').value;
			esta=kd_obteValComb('nc_estaConfor');
			obs=kd_obteValComb('nc_obsLst');
			ori=kd_obteValComb('nc_oriObs'); //New update 15/01/2015 - CLOSE

			url="reporte/nc_repExp.php";
			param="fech="+fech;
			param+="&estaId="+esta;
			param+="&obsId="+obs;
			param+="&origId="+ori; //New update 15/01/2015 - CLOSE
			np_geneRep(url,param);
		});

		//New update 14/01/2015 - CLOSE
		$('#nc_oriObs').click(function(evento)
		{
			nc_noConforxFil_cont();
		});

	});

//Functions

	function nc_editConfor_link(id)
	{
		url="index.php";
		param="menu_id=154&menu=nc_noConform_frm&id="+id;
		gd_direPagParam(url,param);
	}

	function np_iniSelect_obj(val,id)
	{
		np_iniSelect(val,id);
	}

	function nc_notiAdju(flag,ruta)
	{
		if(flag>0 && ruta!="")
		{
			$(".elem-gd").notify("informe adjunto correctamente","success");

			//iniciar archivos adjuntos
			nc_infoAdju_obte();
		}
		else
		{
			$(".elem-gd").notify("informe no adjunto","error");
		}
	}

	function nc_frmMed_reini()
	{
		gd_enviInner('nc_medCorre','---');
		gd_enviValText('nc_correcDes','');
		gd_enviValText('nc_correcResp','');
		gd_enviValText('nc_fechCorrec','');

		nc_select_reini('nc_ingAsigMul');
	}

	function nc_repDet_gene(id)
	{
		url="reporte/nc_repDet.php";
		param="id="+id;
		np_geneRep(url,param);
	}

//Functions UI

	$(function() 
	{
		$( "#nc_medCorre_pop" ).dialog({
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

	$(function() 
	{
		$( "#nc_equiProye_pop" ).dialog({
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

	//New update 08/01/2015 - CLOSE

	$(function() 
	{
		$( "#nc_medPrev_pop" ).dialog({
		autoOpen: false,
		width:920,
		height:350
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

	function nc_ordexCent_obte()
	{
		//vars
		centId=document.getElementById('nc_ccId').value;

		//param
		ajax="nc_ordexCent_obte";

		//peticion ajax
		var request = $.ajax(
		{
			url: "ajax/nc_ajax.php",
			type: "POST",
			data: {ajax:ajax,centId:centId},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#nc_nroComp").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	function nc_detxOrd_obte()
	{
		//vars
		ordId=kd_obteValComb('nc_nroComp');
		ajax="nc_detxOrd_obte";

		//param

		//peticion ajax
		var request = $.ajax(
		{
			url: "ajax/nc_ajax.php",
			type: "POST",
			data: {ajax:ajax,ordId:ordId},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#nc_detOrd").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	function nc_noConfor_obte()
	{
		//vars

		//parametros
		fechRecep=document.getElementById('nc_fechRecep').value;
		estaConfor=kd_obteValComb('nc_estaConfor');
		limIni=(10*parseInt(kd_obteValComb('nc_pagEle')))-10;
		limFin=10;
		ajax="nc_noConfor_obte";
		obsId=kd_obteValComb('nc_obsLst');
		oriObs=kd_obteValComb('nc_oriObs'); //New update 14/01/2015 - CLOSE

		console.log(limIni);

		//peticion ajax
		var request = $.ajax(
		{
			url: "ajax/nc_ajax.php",
			type: "POST",
			data: {ajax:ajax,fechRecep:fechRecep,estaConfor:estaConfor,limIni:limIni,limFin:limFin,obsId:obsId,oriObs:oriObs},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#nc_noConfor_tab").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	function nc_infoAdju_obte()
	{
		//vars
		ajax="nc_infoAdju_obte";
		conforId=document.getElementById('nc_id').value;

		//parametros

		//peticion ajax
		var request = $.ajax(
		{
			url: "ajax/nc_ajax.php",
			type: "POST",
			data: {ajax:ajax,conforId:conforId},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#nc_adjuFile_tab").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});

	}

	function nc_detEquipxId_obte()
	{
		conforId=document.getElementById('nc_id').value;
		ajax="nc_detEquipxId_obte";

		//peticion ajax
		var request = $.ajax(
		{
			url: "ajax/nc_ajax.php",
			type: "POST",
			data: {ajax:ajax,conforId:conforId},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#nc_detEquip_tab").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	function nc_medCorrec_obte()
	{
		/*vars*/
		conforId=document.getElementById('nc_id').value;
		ajax="nc_medCorrec_obte";

		/*peticion ajax*/
		var request = $.ajax(
		{
			url: "ajax/nc_ajax.php",
			type: "POST",
			data: {ajax:ajax,conforId:conforId},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			$("#nc_medCorrec_tab").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

	//New Update 26/12/2014 - CLOSE

	function nc_tipConfxId_obte()
	{
		//vars
		idObs=kd_obteValComb('nc_obsPrin');
		ajax="nc_tipConfxId_obte";
		console.log(ajax);

		//params

		//peticion ajax
		var request = $.ajax({
		url: "ajax/nc_ajax.php",
		type: "POST",
		data: {ajax:ajax,idObs:idObs},
		dataType: "html"
		});

		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#nc_tipConfor").html( msg );

		//New Update
		if(idObs==1)
		{
			gd_enviInner('nc_tipObs_lbl',"Tipo no conformidad");
		}
		else
		{
			gd_enviInner('nc_tipObs_lbl',"Post venta");
		}

		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});

	}

	//New update 12/01/2015 - CLOSE

	function nc_medPrev_obte()
	{
		//vars
		conforId=document.getElementById('nc_id').value;
		ajax="nc_medPrev_obte";

		//param

		//peticion ajax
		var request = $.ajax(
		{
			url: "ajax/nc_ajax.php",
			type: "POST",
			data: {ajax:ajax,conforId:conforId},
			dataType: "html"
		});
		
		request.done(function(msg) 
		{
			//console.log(msg);
			$("#nc_medPrev_tab").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) 
		{
			alert( "Request failed: " + textStatus );
		});
	}

//Functions Json

	function nc_centCost_obte()
	{
		scc_dataComp_ini("nc_centCost_obte","nc_json","nc_ccId","nc_ccDes");
	}

	function nc_noConfor_cre()
	{
		//parametros
		conforId=document.getElementById('nc_id').value;
		centId=document.getElementById('nc_ccId').value;
		detecId=kd_obteValComb('nc_detecDes');
		procId=kd_obteValComb('nc_proce');
		tipObs=kd_obteValComb('nc_obs');
		estaConfor=kd_obteValComb('nc_estaConfor');
		fechRecep=document.getElementById('nc_fechRecep').value;
		desConfor=document.getElementById('nc_desConfor').value;
		respInme=document.getElementById('nc_respInme').value;
		fechCie=document.getElementById('nc_fechCie').value;
		tipConfor=kd_obteValComb('nc_tipConfor');
		medPrev=document.getElementById('nc_medPrev').value;
		obsId=kd_obteValComb('nc_obsPrin');

		//new update 14/01/2014 - CLOSE
		oriObs=kd_obteValComb('nc_oriObs');

		//peticion json
		id=document.getElementById('nc_id').value;
		json=gd_petiJson_ele(id,'nc_noConfor_cre','nc_noConfor_edit');

		//parametros
		param="json="+json;
		param+="&centId="+centId;
		param+="&detecId="+detecId;
		param+="&procId="+procId;
		param+="&tipObs="+tipObs;
		param+="&estaConfor="+estaConfor;
		param+="&fechRecep="+fechRecep;
		param+="&desConfor="+desConfor;
		param+="&respInme="+respInme;
		param+="&fechCie="+fechCie;
		param+="&tipConfor="+tipConfor;
		param+="&conforId="+conforId;
		param+="&medPrev="+medPrev;
		param+="&obsId="+obsId;
		param+="&oriObs="+oriObs;

		console.log(param);

		//peticion json
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			console.log(data[0]);
			if(data[0]>0)
			{
				if(json=='nc_noConfor_cre')
				{
					$(".elem-gd").notify("No conformidad generada correctamente","success");
					url="index.php";
					param="menu_id=154&menu=nc_noConform_frm&id="+data[0];
					gd_direPagParam(url,param);
				}
				else
				{
					$(".elem-gd").notify("No conformidad actualizada correctamente","success");
				}

			}
			else
			{
				$(".elem-gd").notify("No conformidad no generada","error");
			}
		});
	}

	function nc_datCent_obte()
	{
		//vars
		centId=document.getElementById('nc_ccId').value;

		//parametros
		param="json=nc_datCent_obte";
		param+="&centId="+centId;

		//peticion json
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data.length>0)
			{
				gd_enviInner('nc_proye',data[0]['nc_proye']);
				gd_enviInner('nc_cli',data[0]['nc_cli']);
				document.getElementById('nc_ingAsig').value=data[0]['ingRespDes'];
			}
		});
	}

	function nc_noConforxFil_cont()
	{
		//vars
		fechRecep=document.getElementById('nc_fechRecep').value;
		estaConfor=kd_obteValComb('nc_estaConfor');
		json="nc_noConforxFil_cont";
		obsId=kd_obteValComb('nc_obsLst');
		oriObs=kd_obteValComb('nc_oriObs'); //New update 14/01/2014 - CLOSE

		//param
		param="json="+json;
		param+="&fechRecep="+fechRecep;
		param+="&estaConfor="+estaConfor;
		param+="&obsId="+obsId;
		param+="&oriObs="+oriObs; 

		//peticion json
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			console.log(data);

			gd_fillSelect('nc_pagEle',data[0],10);
			gd_totPag('nc_totPag',data[0],10);
			nc_noConfor_obte();

		});
	}

	function nc_noConforxId_obte()
	{
		//vars
		conforId=document.getElementById('nc_id').value;
		json="nc_noConforxId_obte";

		//param
		param="conforId="+conforId;
		param+="&json="+json;

		//peticion json
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			console.log(data);
			
			if(data.length>0)
			{
				for(i=0;i<data.length;i++)
				{
					console.log(data);

					gd_enviInner('nc_nroConfor',data[i]['nc_nro']);
					gd_enviValText('nc_ccId',data[i]['nc_centProyeId']);
					gd_enviValText('nc_ccDes',data[i]['proyeDes']);

					nc_datCent_obte();

					gd_enviValText('nc_fechRecep',data[i]['nc_fechRecep']);
					gd_enviValText('nc_desConfor',data[i]['nc_des']);
					gd_enviValText('nc_respInme',data[i]['nc_respInme']);
					gd_enviValText('nc_fechCie',data[i]['nc_fechCie']);

					/*
					var iniSelect1=new np_iniSelect_obj(data[i]['nc_detecId'],'nc_detecDes');
					var iniSelect2=new np_iniSelect_obj(data[i]['nc_procAfectId'],'nc_proce');
					*/
					
					detec=data[i]['nc_detecId'];
					proce=data[i]['nc_procAfectId'];
					tipObs=data[i]['nc_tipObsId'];
					tipConfor=data[i]['nc_tipNoConforId'];
					estaConfor=data[i]['nc_estaConforId'];
					medPrev=data[i]['nc_medPrev'];
					obsId=data[i]['nc_obsId'];

					/* New update 14/01/2015 - CLOSE */
					oriObs=data[i]['nc_oriObs'];

					np_iniSelect(detec,'nc_detecDes');
					np_iniSelect(proce,'nc_proce');
					np_iniSelect(tipObs,'nc_obs');
					np_iniSelect(tipConfor,'nc_tipConfor');
					np_iniSelect(estaConfor,'nc_estaConfor');
					np_iniSelect(obsId,'nc_obsPrin');

					gd_enviValText('nc_medPrev',medPrev);

					/* New update 14/01/2015 - CLOSE */					
					np_iniSelect(oriObs,'nc_oriObs');

				}
				
			}
		});
	}

	function nc_infoAdju_borra(id)
	{
		//vars
		adjuId=id;
		json="nc_infoAdju_borra";

		//param
		param="adjuId="+adjuId;
		param+="&json="+json;


		//peticion json
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				$(".elem-gd").notify("Adjunto eliminado correctamente","success");

				//iniciar archivos adjuntos
				nc_infoAdju_obte();
			}
		});
	}

	function nc_detEquip_cre()
	{
		/*vars*/
		conforId=document.getElementById('nc_id').value;
		insFrm=document.nc_detEquip_frm;
		detCompId=gd_checkData(insFrm);
		json="nc_detEquip_cre";

		console.log(detCompId);

		/*peticion json*/
		$.ajax({
	    type:"POST",
	    url: 'json/nc_json.php',
	    data:{json:json,detCompId:detCompId,conforId:conforId},
	    dataType: 'json',
	    success: function(data) 
	    {
	    	console.log(data[0]);
	    	if(data[0]>0)
	    	{
	    		$(".elem-gd").notify("Items añadidos correctamente","success");
	    		nc_detEquipxId_obte();
	    	}
		}

	    });
	}

	function nc_detEquip_borra(id)
	{
		//vars
		equiId=id;
		json="nc_detEquip_borra";

		//param
		param="json="+json;
		param+="&equiId="+equiId;

		//peticion json
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				$(".elem-gd").notify("Items eliminado correctamente","success");
	    		nc_detEquipxId_obte();
			}

		});
	}

	function nc_medCorre_cre()
	{
		/*vars*/
		medId=document.getElementById('nc_medId').value;
		conforId=document.getElementById('nc_id').value;
		medDes=document.getElementById('nc_correcDes').value;
		respMed=document.getElementById('nc_correcResp').value;
		fechCorrec=document.getElementById('nc_fechCorrec').value;
		ingAsig=nc_multiSelect_obte('nc_ingAsigMul');
		json=gd_petiJson_ele(medId,'nc_medCorre_cre','nc_medCorrec_edit');

		console.log(fechCorrec);

		//param
		param="medId="+medId;
		param+="&conforId="+conforId;
		param+="&medDes="+medDes;
		param+="&respMed="+respMed;
		param+="&fechCorrec="+fechCorrec;
		param+="&ingAsig="+ingAsig;
		param+="&json="+json;

		//peticion json
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{

				$(".elem-gd").notify("medida guardado correctamente","success");
				nc_medCorrec_obte();

				if(json=="nc_medCorre_cre")
				{
					//limpiar form med
					nc_frmMed_reini();
				}
			}
		});
	}

	function nc_medxId_ini(id,item)
	{
		/*iniciar popup*/
		$('#nc_medCorre_pop').dialog('open');
		document.getElementById('nc_medId').value=id;

		/*vars*/
		medId=id
		json="nc_medxId_ini";

		/*param*/
		param="medId="+medId;
		param+="&json="+json;

		/*peticion json*/
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data.length>0)
			{
				//iniciar medida correctiva
				//console.log("existe data..! asignar visualizacion :) chvr tio..!");

				var ingAsig=data[0]['nc_ingAsig'];
				dataAsig=ingAsig.split("|");
				console.log(dataAsig);
				nc_select_reini('nc_ingAsigMul');
				//insFrm=document.nc_med_frm.nc_ingAsigMul;
				np_iniSelectMul(dataAsig,'nc_ingAsigMul');

				des=data[0]['nc_medCorrecDes'];
				resp=data[0]['nc_respMed'];
				fech=data[0]['nc_fechCorrec'];
				corre=data[0]['nc_medCorrecId'];

				gd_enviInner('nc_medCorre',item);
				gd_enviValText('nc_correcDes',des);
				gd_enviValText('nc_correcResp',resp);
				gd_enviValText('nc_fechCorrec',fech);
				
			}
		});
	}

	function nc_medCorrec_borra(id)
	{
		/*vars*/
		medId=id;
		json="nc_medCorrec_borra";

		/*param*/
		param="medId="+medId;
		param+="&json="+json;

		if(confirm("¿ Desea eliminar la medida correctiva ?"))
		{
			/*peticion json*/
			$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					$(".elem-gd").notify("medida eliminado correctamente","success");
					nc_medCorrec_obte();
				}
			});
		}
	}

	function nc_noConfor_borrar(id)
	{
		/*vars*/
		conforId=id;
		json="nc_noConfor_borrar";

		/*param*/
		param="conforId="+conforId;
		param+="&json="+json;

		if(confirm("¿ Desea eliminar no conformidad ?"))
		{
			/*peticion json*/
			$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					$(".elem-gd").notify("conformidad eliminada correctamente","success");

					//iniciar paginado
					nc_noConforxFil_cont();
				}
				else
				{
					$(".elem-gd").notify("conformidad no eliminada","error");
				}
			});
		}
	}

	//New update 08/01/2015 - CLOSE
	//			 12/01/2015

	function nc_medPrev_cre()
	{
		/*vars*/
		noConforId=document.getElementById('nc_id').value;
		desPrev=document.getElementById('nc_prevDes').value;
		fechPrev=document.getElementById('nc_fechPrev').value;
		medId=document.getElementById('nc_prevId').value;
		json=gd_petiJson_ele(medId,"nc_medPrev_cre","nc_medPrev_edit");

		/*param*/
		param="noConforId="+noConforId;
		param+="&desPrev="+desPrev;
		param+="&fechPrev="+fechPrev;
		param+="&json="+json;
		param+="&medId="+medId;

		/*peticion json*/
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				if(json=="nc_medPrev_cre")
				{
					$(".elem-gd").notify("conformidad guardada correctamente","success");
					nc_medPrev_obte();

					//limpiar campos
					document.getElementById('nc_prevDes').value="";
					document.getElementById('nc_fechPrev').value="";
				}
				else
				{
					$(".elem-gd").notify("prevencion actualizada correctamente","success");
					nc_medPrev_obte();
				}

			}
			else
			{
				$(".elem-gd").notify("conformidad no guardada","error");
			}
		});
	}

	function nc_medPrevxId_borra(id)
	{
		/*vars*/
		medId=id;
		json="nc_medPrevxId_borra";

		/*param*/
		param="medId="+medId;
		param+="&json="+json;


		/*peticion json*/
		if(confirm("¿ Desea eliminar la medida preventiva ?"))
		{
			$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					$(".elem-gd").notify("prevencion eliminada correctamente","success");
					nc_medPrev_obte();
				}
				else
				{
					$(".elem-gd").notify("prevencion no eliminada","error");
				}
			});
		}
	}

	function nc_medPrevxId_obte(id,ind)
	{
		/*vars*/
		medId=id;
		ind=ind;
		json="nc_medPrevxId_obte";

		/*param*/
		param="medId="+medId;
		param+="&json="+json;

		/*peticion json*/
		$.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data.length>0)
			{
				//console.log(data);

				//iniciando popup prevencion
				$('#nc_medPrev_pop').dialog('open');

				//iniciando parametros
				document.getElementById('nc_ordPrev').innerHTML=ind;
				document.getElementById('nc_prevId').value=medId;
				document.getElementById('nc_prevDes').value=data[0]['nc_medPrevDes'];
				document.getElementById('nc_fechPrev').value=data[0]['nc_medPrevFech'];
			}
		});
	}
