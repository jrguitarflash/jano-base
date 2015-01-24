window.onload=function()
{
   lp_cargLineProd_ajax();

   // Carga de nivel de productos
   lp_cargCate_ajax();
   setTimeout("lp_cargTip_ajax()",1200);
   setTimeout("lp_cargMarMod_ajax()",1400);
   setTimeout("lp_cargProd_ajax()",1600);

   // Cantidad de productos en linea
   setTimeout('lp_cantLineProd()',1200);

   // CARGA DE ESTRUCTURA DE PRODUCTOS
   lp_cargCate2_ajax();
   lp_marxCat_obte();
}

$(document).ready(function()
{

	$('#lp_acciNuevProd').click(function(mievento)
	{
        
		if(document.getElementById('lp_permUsu').value==6)
		{
			alert("No tiene permiso para esta opcion...!");
		}
		else
		{
			lp_nuevProd_open();

			// MOSTRAR FORM NUEVO
			document.getElementById('kd_acciNuevProd').style.display="block";
			document.getElementById('lp_acciEdit').style.display="none";

			// LIMPIAR CAMPOS
			document.getElementById('kd_nomEspa').value="";
			document.getElementById('kd_nomIngle').value="";
			document.getElementById('kd_desProd').value="";
			document.getElementById('lp_stockMin2').value="";
			document.getElementById('lp_stockMax2').value="";

			// CAMBIAR TITULO DE POPUP
			document.getElementById('lp_nuevProd').title="Nuevo producto";
		}


	});

	$("#subClasi").click(function(mievento)
	{
	   //alert("evento para la carga de categorias");
	   lp_cargCate_ajax();
	   setTimeout("lp_cargTip_ajax()",1200);
	   setTimeout("lp_cargMarMod_ajax()",1400);
	   setTimeout("lp_cargProd_ajax()",1600);
	});

	$('#cateProd').click(function(mievento)
	{
		lp_cargTip_ajax();
		setTimeout("lp_cargMarMod_ajax()",1200)
		setTimeout("lp_cargProd_ajax()",1400);
	});

	$('#tipProd').click(function(mievento)
	{
		lp_cargMarMod_ajax();
		setTimeout("lp_cargProd_ajax()",1200);
	});

	$('#marMod').click(function(mievento)
	{
		lp_cargProd_ajax();
	});

	$('#lp_acciImpor').click(function(mievento)
	{
		lp_cargImporProd_json();
	});

	$('#lp_acciPopImpor').click(function(mievento)
	{
		lp_imporProd_open();
	});

	$('#lp_acciPopConf').click(function(mievento)
	{
		lp_confStock_open();
	});

	$('#lp_txtBusq').change(function(mievento)
	{
		lp_cargBusLine_ajax();
		setTimeout('lp_cantLineProd()',1200);
	});

	$('#lp_txtBusq').keyup(function(mievento)
	{
		lp_cargBusLine_ajax();
	});

	/*$('#lp_txtBusq').keypress(function(mievento)
	{
		lp_cargBusLine_ajax();
	});*/

	$('#lp_saveConf').click(function(mievento)
	{
		lp_actuConfStock_json();
		setTimeout('lp_cargBusLine_ajax()',1200);
		$('#lp_confStock').dialog('close');

	});

	// BLOQUE DE EVENTOS PARA NUEVOS PRODUCTOS

	$("#subClasi2").click(function(mievento)
	{
	   //alert("evento para la carga de categorias");
	   lp_cargCate2_ajax();
	   //setTimeout("lp_cargTip2_ajax()",1200);
	   //setTimeout("lp_cargMarMod2_ajax()",1400);
	});

	$('#cateProd2').click(function(mievento)
	{
		//lp_cargTip2_ajax();
		//setTimeout("lp_cargMarMod2_ajax()",1200);
		console.log("cargando marca...!");
		lp_marxCat_obte();
	});

	$('#tipProd2').click(function(mievento)
	{
		lp_cargMarMod2_ajax();
	});

	//----------------EVENTOS NUEVOS---------------------------

	$('#lp_acciNuevSub').click(function(mievento)
	{
		lp_nuevSub_open();
	});

	$('#lp_acciNuevCate').click(function(mievento)
	{
		lp_nuevCate_open();
		setTimeout('lp_obteSubClasi2_ajax()',700);
	});

	$('#lp_acciNuevTip').click(function(mievento)
	{
		lp_nuevTip_open();
		lp_cargCate3_ajax();
	});

	$('#lp_acciNuevMarMod').click(function(mievento)
	{
		lp_nuevMarMod_open();
		lp_cargTip3_ajax();
		lp_marProd_ajax();
	});

	$('#lp_acciNuevMar').click(function(mievento)
	{
		lp_nuevMar_open();
	});

	//-----------------UI NUEVOS PRODUCTOS EVENTOS-----------------

	$('#kd_acciNuevProd').click(function(mievento)
	{
		lp_nuevProd();
		setTimeout('lp_cargLineProd_ajax()',1200);
	});

	$('#kd_acciNuevSub').click(function(mievento)
	{
		lp_nuevSub();
		setTimeout('lp_obteSubClasi_ajax()',1200);
	});

	$('#lp_sbmtNuevCate').click(function(mievento)
	{
		lp_nuevCate();
	});

	$('#lp_sbmtNuevTip').click(function(mievento)
	{
		lp_nuevTip();
	});

	$('#sbmtNuevMarMod').click(function()
	{
		lp_nuevMarMod();
	});

	$('#sbmtNuevMar').click(function()
	{
		lp_nuevMar();
	});

	$('#lp_acciEdit').click(function()
	{
		prodCread_actu();
		//setTimeout('lp_cargLineProd_ajax()',1200);
		setTimeout('lp_cargBusLine_ajax()',1200);
	});

	$('#kd_dispoStock').click(function()
	{
		lp_cargBusLine_ajax();
		setTimeout('lp_cantLineProd()',1200);
	});

	$('#kd_almcTip').click(function()
	{
		lp_cargBusLine_ajax();
		setTimeout('lp_cantLineProd()',1200);
	});

});

function lp_geneRepo(rep)
{
	if(rep=="pdf")
	{
		desBus=document.getElementById("lp_txtBusq").value;
		ins=document.createElement('a');
		ins.target="_blank";
		ins.href="reporte/kd_repoLine.php?desBus="+desBus;
		document.body.appendChild(ins);
		ins.click();
	}
	else if(rep="excel")
	{
		desBus=document.getElementById("lp_txtBusq").value;
		ins=document.createElement('a');
		ins.target="_blank";
		ins.href="reporteExcel/lp_repLineExcel.php?desBus="+desBus;
		document.body.appendChild(ins);
		ins.click();
	}
	else
	{

	}
}

function test()
{
	document.getElementById('test').removeAttribute('title');
	document.getElementById('test').setAttribute('title',"test2");
}

function prodCread_actu()
{
	idLine=document.getElementById('lp_idParam').value;
	sub=kd_getValCombo('subClasi2');
	cat=kd_getValCombo('cateProd2');
	mar=kd_getValCombo('lp_marProd3');
	nomEspa=document.getElementById('kd_nomEspa').value;
	nomIng=document.getElementById('kd_nomIngle').value;
	des=document.getElementById('kd_desProd').value;
	min=document.getElementById('lp_stockMin2').value;
	max=document.getElementById('lp_stockMax2').value;
	json="prodCread_actu";

	// INICIAR CADENA DE PARAMETROS

	param="idLine="+idLine;
	param=param+"&sub="+sub;
	param=param+"&cat="+cat;
	param=param+"&mar="+mar;
	param=param+"&nomEspa="+nomEspa;
	param=param+"&nomIng="+nomIng;
	param=param+"&des="+des;
	param=param+"&min="+min;
	param=param+"&max="+max;
	param=param+"&json="+json;

	// SOLICITAR PETICION JSON
	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('msjNuevProd').innerHTML="Producto editado correctamente .....!";
			setTimeout("lp_refreshMsj('msjNuevProd')",2100);
		}
		else
		{
			document.getElementById('msjNuevProd').innerHTML="Producto no editado .....!";
			setTimeout("lp_refreshMsj('msjNuevProd')",2100);
		}

	});

}

function lp_prodCread_ini(id)
{
	idLine=id;
	json="prodCread_ini";

	param="idLine="+idLine;
	param=param+"&json=prodCread_ini";

	// GET DATA BY JSON

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		document.getElementById('kd_nomEspa').value=data[0]['nomEspa'];
		document.getElementById('kd_nomIngle').value=data[0]['nomIngle'];
		document.getElementById('kd_desProd').value=data[0]['des'];
		document.getElementById('lp_stockMin2').value=data[0]['stockMin'];
		document.getElementById('lp_stockMax2').value=data[0]['stockMax'];
		kd_iniCombo('subClasi2',data[0]['idSubClasi']);
		kd_iniCombo('lp_marProd3',data[0]['idMar']);
		lp_cargCate2_ajax();
		setTimeout("kd_iniCombo('cateProd2',"+data[0]['idCat']+")",700);
	});
}

function kd_iniCombo(id,val)
{
	insId=document.getElementById(id);
	console.log(insId.length);
	for(i=0;i<insId.length;i++)
	{
		if(insId.options[i].value==val)
		{
			insId.options[i].selected='true';
		}
	}
}

function lp_marxCat_obte()
{

	ajax="marxCat_obte";
	catId=kd_getValCombo('cateProd2');

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {ajax:ajax,catId:catId},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#lp_marProd3").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_nuevMar()
{
	//----------------NUEVA MARCA----------------------------------
	mar=document.getElementById('lp_marCamp').value;
	json="nuevMar";
	//--------------------------------------------------------------

	param="mar="+mar;
	param=param+"&json="+json;

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]==1)
		{
			document.getElementById('msjMar').innerHTML="Nueva Marca añadida correctamente.....!";

			setTimeout("lp_refreshMsj('msjMar')",2100);

			//CARGA DE MARCAS
			lp_marProd_ajax();

			//LIMPIAR CAMPO
			document.getElementById('sbmtNuevMar').value="";
		}
		else if(data[0]==2)
		{
			document.getElementById('msjMar').innerHTML="Marca no añadida, ya existe...!";

			setTimeout("lp_refreshMsj('msjMar')",2100);
		}
		else
		{
			document.getElementById('msjMar').innerHTML="Nueva marca no añadida.....!";
		}
	});
}

function lp_refreshMsj(id)
{
	document.getElementById(id).innerHTML="Mensaje de confirmacion";
}

function lp_nuevMarMod()
{
	//----------------NUEVA MARCA MODELO----------------------------------
	tip=kd_getValCombo('lp_tip3Combo');
	mar=kd_getValCombo('lp_marProd3');
	mod=document.getElementById('lp_modCamp').value;
	json="nuevMarMod";
	//----------------------------------------------
	param="tip="+tip;
	param=param+"&mar="+mar;
	param=param+"&mod="+mod;
	param=param+"&json="+json;

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
		   document.getElementById('msjNuevMarMod').innerHTML="Nueva Marca-Modelo añadido correctamente...!";

		   setTimeout("lp_refreshMsj('msjNuevMarMod')",2100);

		   // CARGA NIVELES DE PRODUCTOS
		   lp_cargCate2_ajax();
		   setTimeout("lp_cargTip2_ajax()",1200);
		   setTimeout("lp_cargMarMod2_ajax()",1400);
		   //document.getElementById('lp_marCamp').value;
		}
		else
		{
			document.getElementById('msjNuevMarMod').innerHTML="Nueva Marca-Modelo no añadido...!";
		}
	});



}

function lp_marProd_ajax()
{
	ajax="marProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#lp_marProd3").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_nuevTip()
{
	//------------NUEVO TIPO-----------------------
	cate=kd_getValCombo('lp_cate3Comb');
	tip=document.getElementById('lp_tip3').value;
	json="nuevTip";
	//----------------------------------------------

	param="cate="+cate;
	param=param+"&tip="+tip;
	param=param+"&json="+json;

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
		   document.getElementById('msjNuevTip').innerHTML="Tipo añadido correctamente.....!";

		   setTimeout("lp_refreshMsj('msjNuevTip')",2100);

		   // CARGA NIVELES DE PRODUCTOS
		   lp_cargCate2_ajax();
		   setTimeout("lp_cargTip2_ajax()",1200);
		   setTimeout("lp_cargMarMod2_ajax()",1400);
		}
		else
		{
			document.getElementById('msjNuevTip').innerHTML="Tipo no añadido....!";
		}
	});

}

function lp_nuevCate()
{
	//-----------------NUEVA CATEGORIA--------------------------
	subClasi=kd_getValCombo('lp_subClasi3');
	cate=document.getElementById('lp_cate3').value;
	json="nuevCate";
	//----------------------------------------------------------
	param="subClasi="+subClasi;
	param=param+"&cate="+cate;
	param=param+"&json=nuevCate";

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('msjNuevCate').innerHTML="Nueva categoria añadida correctamente...!";

			setTimeout("lp_refreshMsj('msjNuevCate')",2100);

			// CARGA NIVELES DE PRODUCTOS
			lp_cargCate2_ajax();
		    setTimeout("lp_cargTip2_ajax()",1200);
		    setTimeout("lp_cargMarMod2_ajax()",1400);
		    document.getElementById('lp_cate3').value="";
		}
		else
		{
			document.getElementById('msjNuevCate').innerHTML="Nueva categoria no añadida ...!";
		}
	});
}

function lp_obteSubClasi2_ajax()
{
	ajax="obteSubClasi";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) 
	{
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#lp_subClasi3").html( msg );
		valClasi=kd_getValCombo('subClasi2');
		kd_iniCombo('lp_subClasi3',valClasi);
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_obteSubClasi_ajax()
{
	ajax="obteSubClasi";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#subClasi2").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_nuevSub()
{

	alert("Nueva Sub-clasificacion..!");

	//------------ NUEVA SUB-CLASIFICACION ----------------------

	subClasi=document.getElementById('kd_subClasi').value;

	//------------------------------------------------------------

	param="subClasi="+subClasi;

	param=param+"&json=nuevSub";

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('msjNuevSub').innerHTML="Sub-clasificacion añadida correctamente...!"
			setTimeout("lp_refreshMsj('msjNuevSub')",2100);
			document.getElementById('kd_subClasi').value="";
		}
		else
		{
			document.getElementById('msjNuevSub').innerHTML="Sub-clasificacion no añadida...!"
		}
	});
}

function lp_nuevProd()
{

	alert("Nuevo producto..!");

	//--------- FORMULARIO NUEVO PRODUCTO ----------------
	
	subClasi=kd_getValCombo('subClasi2');
	cate=kd_getValCombo('cateProd2');
	//tip=kd_getValCombo('tipProd2');
	//marMod=kd_getValCombo('marMod2');
	mar=kd_getValCombo('lp_marProd3');
	nomEspa=document.getElementById('kd_nomEspa').value;
	nomIngle=document.getElementById('kd_nomIngle').value;
	desProd=document.getElementById('kd_desProd').value;
	stockMin=document.getElementById('lp_stockMin2').value;
	stockMax=document.getElementById('lp_stockMax2').value;
	
	//---------------------------------------------------

	param="subClasi="+subClasi;
	param=param+"&cate="+cate;
	param=param+"&mar="+mar;
	//param=param+"&tip="+tip;
	//param=param+"&marMod="+marMod;
	param=param+"&nomEspa="+nomEspa;
	param=param+"&nomIngle="+nomIngle;
	param=param+"&desProd="+desProd;
	param=param+"&stockMin="+stockMin;
	param=param+"&stockMax="+stockMax;

	param=param+"&json=nuevProd";

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('msjNuevProd').innerHTML="Nuevo producto agregado correctamente....!";
			setTimeout("lp_refreshMsj('msjNuevProd')",2100);

			// LIMPIAR CAMPOS 
			document.getElementById('kd_nomEspa').value="";
			document.getElementById('kd_nomIngle').value="";
			document.getElementById('kd_desProd').value="";
			document.getElementById('lp_stockMin2').value="";
			document.getElementById('lp_stockMax2').value="";
		}
		else
		{
			document.getElementById('msjNuevProd').innerHTML="Nuevo producto no añadido....!";
		}
	});
}

function kd_getValCombo(id)
{
	insId=document.getElementById(id);
	valId=insId.options[insId.selectedIndex].value;
	return valId;
}

$(function() 
{
	$( "#lp_nuevMarMod" ).dialog({
	autoOpen: false,
	width:480,
	height:350
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
	$( "#lp_nuevTip" ).dialog({
	autoOpen: false,
	width:420,
	height:320
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
	$( "#lp_nuevMar" ).dialog({
	autoOpen: false,
	width:380,
	height:250
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
	$( "#lp_nuevCate" ).dialog({
	autoOpen: false,
	width:420,
	height:320
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
	$( "#lp_nuevSub" ).dialog({
	autoOpen: false,
	width:420,
	height:320
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
	$( "#lp_imporProd" ).dialog({
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
	$( "#lp_confStock" ).dialog({
	autoOpen: false,
	width:920,
	height:670
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
	$( "#lp_nuevProd" ).dialog({
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

function lp_nuevMar_open()
{
	$('#lp_nuevMar').dialog('open');	
}

function lp_nuevMarMod_open()
{
	$('#lp_nuevMarMod').dialog('open');	
}

function lp_nuevTip_open()
{
	$('#lp_nuevTip').dialog('open');	
}

function lp_nuevSub_open()
{
	$('#lp_nuevSub').dialog('open');	
}

function lp_nuevCate_open()
{
	$('#lp_nuevCate').dialog('open');	
}

function lp_nuevProd_open()
{
	// MODIFICAR TITULO DE POPUP
	$('#lp_nuevProd').dialog({title:'Nuevo Producto'});

	$('#lp_nuevProd').dialog('open');
}

function lp_nuevProd_edit(id,edit)
{

	if(document.getElementById('lp_permUsu').value==6)
	{
		alert("No tiene permiso para esta opcion...!");
	}
	else
	{

		// CAMBIAR TITULO DE POPUP

		//insTitle=document.getElementById('lp_nuevProd');
		//insTitle.removeAttribute('title');
		//insTitle.createAttribute('title');
		//insTitle.setAttribute('title',"Editar Producto");
		$('#lp_nuevProd').dialog({title:'Editar Producto'});

		$('#lp_nuevProd').dialog('open');

		// INICIAR PARAMETROS DE EDICION
		document.getElementById('lp_idParam').value=id;
		document.getElementById('lp_tareParam').value=edit;
		document.getElementById('kd_acciNuevProd').style.display="none";
		document.getElementById('lp_acciEdit').style.display="block";

		// INICIAR DATA DE EDICION
		lp_prodCread_ini(id);

	}

}

function lp_actuConfStock_json()
{
	// your code
	lineId=document.getElementById('lp_lineStockId').value;
	stockMin=document.getElementById('lp_stockMin').value;
	stockMax=document.getElementById('lp_stockMin').value;
	preUni=document.getElementById('lp_preUni').value;

	insMoneId=document.getElementById('lp_moneId');
	moneId=insMoneId.options[insMoneId.selectedIndex].value;

	param="lineId="+lineId;
	param=param+"&stockMin="+stockMin;
	param=param+"&stockMax="+stockMax;
	param=param+"&preUni="+preUni;
	param=param+"&moneId="+moneId;
	param=param+"&json=actuConfStock";

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			alert("Datos actualizados correctamente...!");
		}
		else
		{

		}
	});
}

function lp_iniConfStock_json()
{
	// your code
	param="json=iniConfStock";
	param=param+"&lineStockId="+document.getElementById('lp_lineStockId').value;

	$.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
	{
		document.getElementById('lp_nom').innerHTML=data[0]['nomEspa'];
		document.getElementById('lp_sub').innerHTML=data[0]['sub'];
		document.getElementById('lp_cate').innerHTML=data[0]['cat'];
		document.getElementById('lp_tip').innerHTML=data[0]['tip'];
		document.getElementById('lp_mar').innerHTML=data[0]['mar'];
		document.getElementById('lp_model').innerHTML=data[0]['model'];
		document.getElementById('lp_stockMin').value=data[0]['stockMin'];
		document.getElementById('lp_stockMax').value=data[0]['stockMax'];
		document.getElementById('lp_stockActu').innerHTML=data[0]['stockActu'];
		document.getElementById('lp_preUni').value=data[0]['preciUnit'];

		insMone=document.getElementById('lp_moneId');
		for(i=0;i<insMone.length;i++)
		{
			if(insMone.options[i].value==data[0]['moneId'])
			{
				insMone.options[i].selected=true;
			}
		}

	});

}

function lp_evaCheckAct()
{
	insFormLine=document.lp_frmLineProd.lp_lineProdId;
	valCheckAct=insFormLine.length;
	tamAct=new Array();
	tamAct[0]=0;

	for(i=0;i<valCheckAct;i++)
	{
		if(insFormLine[i].checked)
		{
			tamAct[0]=tamAct[0]+1;
			tamAct[1]=insFormLine[i].value;
		}
	}

	return tamAct;
}

function lp_cantLineProd()
{
	if ($('#lp_tabLineProd >tbody >tr').length == 0)
	{
    	document.getElementById('cantProd').innerHTML="<strong>Cantidad Actual:</strong> "+0;
	}
	else
	{
		document.getElementById('cantProd').innerHTML="<strong>Cantidad Actual:</strong> "+$('#lp_tabLineProd >tbody >tr').length;
	}
}

function lp_imporProd_open()
{
	$('#lp_imporProd').dialog('open');
}

function lp_confStock_open()
{
	arrResul=lp_evaCheckAct();

	if(arrResul[0]==1)
	{
	  $('#lp_confStock').dialog('open');
	  document.getElementById('lp_lineStockId').value=arrResul[1];
	  setTimeout('lp_iniConfStock_json()',1200);
	}
	else
	{
		alert("Seleccionar un item para configurar stock");
	}
}

function lp_eliLineProd(id)
{
	param="json=eliLineProd";
	param=param+"&idLine="+id;

	param2="json=movExis_eva";
	param2=param2+"&idLine="+id;

	if(document.getElementById('lp_permUsu').value==6)
	{
		alert("No tiene permiso para esta opcion...!");
	}
	else
	{

		$.getJSON('json/lp_json.php?'+param2,{format: "json"}, function(data)     
		{
			console.log(data);
			if(data[0]==0)
			{
				if(confirm("Confirma eliminar producto....!"))
				{	
				    $.getJSON('json/lp_json.php?'+param,{format: "json"}, function(data) 
				    {
				    	if(data[0]>0)
				    	{
				    		alert("Produto eliminado correctamente...!");
				    		lp_cargLineProd_ajax();
				    		setTimeout('lp_cantLineProd()',1200);
				    	}
				    	else
				    	{
				    		alert("El producto no fue eliminado....!");
				    	}
				    });
			    }
			}
			else
			{
				//setTimeout(function() {alert("Producto no sera eliminado tiene movimientos")},1000);
				alert("Producto no sera eliminado tiene movimientos");
			}

	    });

	}
}

function lp_cargImporProd_json()
{
	insProd=document.frmNivProd.chkProdId;
	tamProd=insProd.length;
	arrProd=new Array();
	ind=0;

	for(i=0;i<tamProd;i++)
	{
		if(insProd[i].checked)
		{
			arrProd[ind]=insProd[i].value;
			ind++;
		}
	}

	console.log(arrProd);

	json="imporProd";

    $.ajax({
    type:"POST",
    url: 'json/lp_json.php',
    data:{arrProd:arrProd,json:json},
    dataType: 'json',
    success: function(data) 
    {
    	if(data[0]>0)
    	{
    		alert("Productos importados correctamente...!");
    		lp_cargProd_ajax();
    		lp_cargLineProd_ajax();
    		setTimeout('lp_cantLineProd()',1200);
    	}
    	else
    	{
    		alert("Seleccionar los productos a importar...!");
    	}
    }
    });
}

function lp_cargBusLine_ajax()
{
	//alert("filtraremos la busqueda....! "+document.getElementById('lp_txtBusq').value);

	desBus=document.getElementById('lp_txtBusq').value
	tare="filtro";
	ajax="busLineProd";
	insDispo=document.getElementById('kd_dispoStock');
	dispo=insDispo.options[insDispo.selectedIndex].value;
	console.log(dispo);

	//Tipos de almacenes
	insAlmc=document.getElementById('kd_almcTip');
	almcTip=insAlmc.options[insAlmc.selectedIndex].value;

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {ajax:ajax,desBus:desBus,tare:tare,dispo:dispo,almcTip:almcTip},
	dataType: "html"
	}); 
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#lineProd").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

}

function lp_cargLineProd_ajax()
{
	ajax="lineProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#lineProd").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargCate_ajax()
{
	insSubClasi=document.getElementById('subClasi');
	idSubClasi=insSubClasi.options[insSubClasi.selectedIndex].value;
	ajax="cateProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idSubClasi:idSubClasi,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#cateProd").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargCate3_ajax()
{
	insSubClasi=document.getElementById('subClasi2');
	tamSub=insSubClasi.length;

	if(tamSub>0)
	{
		idSubClasi=insSubClasi.options[insSubClasi.selectedIndex].value;
	}
	else
	{
		idSubClasi=-1;
	}
	
	
	ajax="cateProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idSubClasi:idSubClasi,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#lp_cate3Comb").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargCate2_ajax()
{
	insSubClasi=document.getElementById('subClasi2');
	tamSub=insSubClasi.length;

	if(tamSub>0)
	{
		idSubClasi=insSubClasi.options[insSubClasi.selectedIndex].value;
	}
	else
	{
		idSubClasi=-1;
	}
	
	
	ajax="cateProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idSubClasi:idSubClasi,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#cateProd2").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargTip_ajax()
{

	insCate=document.getElementById('cateProd');

	idCate=insCate.options[insCate.selectedIndex].value;
	ajax="tipProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idCate:idCate,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#tipProd").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargTip2_ajax()
{

	insCate=document.getElementById('cateProd2');
	tamCate=insCate.length;

	if(tamCate>0)
	{
		idCate=insCate.options[insCate.selectedIndex].value;
	}
	else
	{
		idCate=-1;
	}
	
	ajax="tipProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idCate:idCate,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#tipProd2").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargTip3_ajax()
{

	insCate=document.getElementById('cateProd2');
	tamCate=insCate.length;

	if(tamCate>0)
	{
		idCate=insCate.options[insCate.selectedIndex].value;
	}
	else
	{
		idCate=-1;
	}
	
	ajax="tipProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idCate:idCate,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#lp_tip3Combo").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargMarMod_ajax()
{

	insTip=document.getElementById('tipProd');

	idTip=insTip.options[insTip.selectedIndex].value;
	
	ajax="marMod";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idTip:idTip,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#marMod").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargMarMod2_ajax()
{

	insTip=document.getElementById('tipProd2');

	tamTip=insTip.length;

	if(tamTip>0)
	{
		idTip=insTip.options[insTip.selectedIndex].value;
	}
	else
	{
		idTip=-1;
	}
	
	
	ajax="marMod";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idTip:idTip,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#marMod2").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function lp_cargProd_ajax()
{

	insSubClasi=document.getElementById('subClasi');
	idSub=insSubClasi.options[insSubClasi.selectedIndex].value;

	insCate=document.getElementById('cateProd');
	idCate=insCate.options[insCate.selectedIndex].value;

	insTip=document.getElementById('tipProd');
	idTip=insTip.options[insTip.selectedIndex].value;

	insMarMod=document.getElementById('marMod');
	idMarMod=insMarMod.options[insMarMod.selectedIndex].value;
	ajax="listProd";

	var request = $.ajax({
	url: "ajax/lp_ajax.php",
	type: "POST",
	data: {idMarMod:idMarMod,idTip:idTip,idCate:idCate,idSub:idSub,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#listProd").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}