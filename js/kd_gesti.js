window.onload=function()
{

	viewMenu=document.getElementById('viewMenu').value;

	switch(viewMenu)
	{

		case 'kd_prevGuia':

		break;

		case 'kd_geneKardx':

			// INICIAR NIVELES DE PRODUCTO
			//kd_cateProd_ajax();
			//setTimeout("marLine_obte()",1200);
			//setTimeout("kd_prodLine_ajax()",1700);
			
			//setTimeout('kd_tipProd_ajax()',1200);
			//setTimeout('kd_marxTip_obte()',1400);
			//setTimeout('kd_modxTipMar_obte()',1600);

			//setTimeout('kd_marMod_ajax()',1400);

			Calendario3('kd_fechMov');
			kd_detKardxid_ajax();
			kd_iniGenKardx();
			kd_empMov_json();

			// Iniciar almacenes disponibles

			kd_almEmp_cap("#kd_almEmp");
			kd_almEmp_cap("#kd_destiUbi");

			// iniciar calendario fecha factura
			Calendario3('kd_FacEmis');

			// iniciar transportistas
			kd_trans_cap();

			//iniciar ew de compras
			kd_ewComp_cap();

			//iniciar ew seleccionadas
			setTimeout('kd_lineProdxEw_obte()',1200);
			

		break;

		case 'kd_listKardx':

			kd_iniHistKardx_ajax();

		break;

		case 'kd_repAlm':

			// INICIAR NIVELES DE PRODUCTO
			kd_cateProd_ajax();
			setTimeout('kd_tipProd_ajax()',1200);
			setTimeout('kd_marxTip_obte()',1400);
			setTimeout('kd_modxTipMar_obte()',1600);

			//setTimeout('kd_marMod_ajax()',1400);



			// INICIAMOS RANGO DE FECHAS
			Calendario3('kd_fechIni');
			Calendario3('kd_fechFin');

		break;

		//New update 29/12/2014

		case 'kd_movxSeri_fil':

			console.log(viewMenu);

			scc_dataComp_ini('kd_numSeri_read','kd_json','kd_numSeriId','kd_numSeri');

		break;

		default:
		break;
	}

}

$(document).ready(function()
{

	$('#kd_notPed').click(function(mievento) // new
	{
		console.log("cargando detalle de nota de pedido...!");
		kd_detNot_cap();
	});

	$('#kd_acciNuevSeri').click(function(mievento)
	{
		kd_nuevNumSeri_open();
	});

	$('#kd_nuevKardx').click(function(mievento)
	{
		//location.href="index.php?menu_id=144&menu=kd_nuevKardx";
		
		//kd_geneMovKardx_json();
		kd_nuevMovKardx_json();
	});

	$('#kd_geneMov').click(function(mievento)
	{
		kd_geneMovKardx_json();
	});

	$('#kd_tipMov').click(function()
	{
		kd_empMov_json();
	});

	$('#kd_subClasi').click(function()
	{
		kd_cateProd_ajax();
		setTimeout("marLine_obte()",1200);
		setTimeout("kd_prodLine_ajax()",1300);
		//setTimeout('kd_tipProd_ajax()',1200);
		//setTimeout('kd_marxTip_obte()',1400);
		//setTimeout('kd_modxTipMar_obte()',1600);
		//setTimeout('kd_marMod_ajax()',1400);
	});

	$('#kd_catProd').click(function()
	{
		marLine_obte();
		setTimeout("kd_prodLine_ajax()",1200);
		//kd_tipProd_ajax();
		//setTimeout('kd_marxTip_obte()',1200);
		//setTimeout('kd_modxTipMar_obte()',1600);
		//setTimeout('kd_marMod_ajax()',1200);	
	});

	$('#kd_tipProd').click(function()
	{
		//kd_marMod_ajax();
		kd_marxTip_obte();
		setTimeout('kd_modxTipMar_obte()',1200);	
	});

	/*
	$('#kd_marMod').click(function()
	{
		kd_prodLine_ajax();
	});
	*/

	$('#kd_mod').click(function()
	{
		kd_prodLine_ajax();
	});

	$('#kd_agreDet').click(function()
	{
		alert("agregar detalle movimiento...!");
		kd_detKard_json();
		setTimeout('kd_detKardxid_ajax()',1200);
	});

	$('#kd_saveMov').click(function()
	{
		kd_setGenKardx();
		setTimeout('kd_detKardxid_ajax()',1200);
	});

	$('#kd_kardxPrin').click(function()
	{
		kd_direKardxPrin();
	});

	$('#kd_tipMovHist').click(function()
	{
		kd_iniHistKardx_ajax();
	});

	$('#kd_sbmtNuevSeri').click(function()
	{
		kd_numSeri_ingre();
		setTimeout('kd_seriMov_mos()',1200);
	});

	$('#kd_smbtAddMov').click(function()
	{
		kd_movSeri_aña();
		setTimeout('kd_seriMov_mos2()',1200);
	});

	$('#smbtRegre').click(function()
	{
		kd_seriStock_regre();
	});

	$('#lp_txtBusq').change(function(mievento)
	{
		lp_cargBusLine_ajax();
	});

	$('#lp_txtBusq').keyup(function(mievento)
	{
		lp_cargBusLine_ajax();
	});

	/*$('#lp_txtBusq').keypress(function(mievento)
	{
		lp_cargBusLine_ajax();
	});*/

	$('#kd_acciGene').click(function()
	{

		insTipRep=document.getElementById('kd_tipRep');
		valTipRep=insTipRep.options[insTipRep.selectedIndex].value;
		
		if(valTipRep=='seleccionar')
		{
			alert("Seleccionar el tipo de reporte...!");
		}
		else
		{
			switch(valTipRep)
			{
				case '1':

					console.log("Generando tipo de reporte Inventario....!");

					insFil=document.frmRepAlm.kd_fil;
					valFil=0;
					for(i=0;i<insFil.length;i++)
					{
						if(insFil[i].checked)
						{
							valFil=insFil[i].value;
						}
					}

					// EVALUAR FILTRO DE REPORTE

					if(valFil==1)
					{
						valId=kd_getValCombo('kd_subClasi');
					}
					else if(valFil==2)
					{
						valId=kd_getValCombo('kd_catProd');
					}
					else if(valFil==3)
					{
						valId=kd_getValCombo('kd_tipProd');
					}
					else if(valFil==4)
					{
						valId=kd_getValCombo('kd_mar');
					}
					else if(valFil==5)
					{
						valId=kd_getValCombo('kd_mod');
					}
					else if(valFil==6)
					{
						//valId=kd_getValCombo('kd_mod');
						valId=0;
					}
					else
					{
						valId=0;
					}

					document.getElementById('kd_ifmRepAlm').src="reporte/kd_repInv.php?tip="+valTipRep+"&valFil="+valFil+"&valId="+valId;
				
				break;

				case '2':

					console.log("Generando tipo de reporte Movimiento....!");

					tipMov=kd_getValCombo('kd_tipMov');
					filEmp=kd_getValRadio2();
					valEmp=document.getElementById('kd_empId').value;
					fechIni=document.getElementById('kd_fechIni').value;
					fechFin=document.getElementById('kd_fechFin').value;

					if(tipMov=="seleccionar")
					{
						alert("seleccinar tipo de movimiento");
					}
					else
					{
						//console.log("tipMov: "+tipMov+"\n"+"filEmp: "+filEmp+"\n"+"valEmp: "+valEmp+"\n"+"fechIni: "+fechIni+"\n"+"fechFin:"+fechFin);
						param="&tipMov="+tipMov+"&filEmp="+filEmp+"&valEmp="+valEmp+"&fechIni="+fechIni+"&fechFin="+fechFin;
						document.getElementById('kd_ifmRepAlm').src="reporte/kd_repInv.php?tip="+valTipRep+param;
					}


				break;

				default:
				break;
			}

		}

	});

	$('#kd_mar').click(function()
	{
		//kd_modxTipMar_obte();
		kd_prodLine_ajax();
	});

	$('#kd_agreDet2').click(function()
	{
		//MSG
		console.log("msg");

		//SERIES DINAMICOS
		if(document.getElementById('kd_cant').value>0)
		{
			prodId=kd_getValRadio();
			if(prodId>0)
			{
				//validar ingreso de movimiento
				idKdx=document.getElementById('kd_kdxId').value;
				json="ingMov_vali";

				param="kardxId="+idKdx;
				param+="&json="+json;

				if(idKdx==0)
				{
					alert("Guardar Movimiento antes de continuar...!");
				}
				else
				{
					$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
					{
						if(data[0]>0)
						{
							alert("El ingreso de items al movimiento a vencido...!");
						}
						else
						{
							tipMov=document.getElementById('kd_tipMov').value;
							if(tipMov==1)
							{
								$('#kd_numSeriDina').dialog('open');
								kd_geneNumDina();
							}
							else if(tipMov==2)
							{
								//alert("popup de series en stock");
								$('#kd_numSeriStock').dialog('open');
								kd_serixProd_cap(prodId,'#kd_dataSeriStock');
							}
							else if(tipMov==3)
							{
								$("#kd_movInter").dialog('open');
								kd_serixProd_cap(prodId,'#kd_detMovInter');
							}
							else
							{
								excep="ningun movimiento";
							}

						}

					});
				}


			}
			else
			{
				alert("No ha seleccinado un producto valido");
			}
		}
		else
		{
			alert("Cantidad valida mayor a cero");
		}
	});

	$('#kd_sbmtItem').click(function()
	{
		//msg
		console.log("msg");

		//cargar parametros
		kd_detKard2_json();

	});

	$('#kd_sbmtSali').click(function()
	{
		//msj
		console.log("msj");

		//carga de persistencia
		kd_detKard3_json();

		//cargar detalle de movimiento
		setTimeout('kd_detKardxid_ajax()',1200);

		//carga detalle de series en stock
		prodId=kd_getValRadio();
		setTimeout("kd_serixProd_cap('"+prodId+"','#kd_dataSeriStock')",1200);

		//cerrar popup
		$('#kd_numSeriStock').dialog('close');
	});

	$('#sbmtMovInter').click(function()
	{

		console.log("Movimiento interno....!");

		//carga de persistencia
		kd_detKard3_json();

		//cargar detalle de movimiento
		setTimeout('kd_detKardxid_ajax()',1200);

		//carga detalle de series en stock
		prodId=kd_getValRadio();
		setTimeout("kd_serixProd_cap('"+prodId+"','#kd_detMovInter')",1200);

		//cerrar popup
		$('#kd_movInter').dialog('close');

	});

	$('#kd_geneGuia').click(function()
	{
		console.log("Generando guia de remision...!");

		// Generando glosa,item y guia de remision
		glosaMov_actu();
	});

	$('#kd_nuevTrans').click(function()
	{
		$('#kd_transMov').dialog('open');
	});

	$('#kd_transBnt').click(function()
	{
		console.log("Evaluando nuevo transportista");
		//kd_nuevTrans_crear();
		kd_empTrans_crear();
	});

	$('#kd_ewComp').change(function()
	{
		if(document.getElementById('kd_ewComp').value=='')
		{
			document.getElementById('kd_ewCompId').value=0;
		}

	});

	$('#kd_confirAten').click(function() //new1!
	{
		console.log("confirmando atencion de nota de pedido...!");
		
		//parametros
		insNot=document.getElementById('kd_notPed');
		notId=insNot.options[insNot.selectedIndex].value;
		json="atenNot_confir";

		//cadena parametros
		param="notId="+notId;
		param+="&json="+json;

		if(confirm("Desea confirmar la atencion del pedido"))
		{
			//peticion json
			$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					alert("Nota de pedido fue confirmada...!");
					kd_notPend_cap();
					setTimeout('kd_detNot_cap()',1200);
				}
				else
				{
					alert("Nota de pedido no confirmada");
				}
			});
		}
	});

	$('#kd_showNot').click(function()
	{
		console.log("Mostrar nota de pedido..!");
		kd_showNotped();
	});

	$('#kd_ewComp').change(function(mievento)
	{
		kd_lineProdxEw_obte();
	});

	$('#kd_ewComp').keyup(function(mievento)
	{
		kd_lineProdxEw_obte();
	});

	//New update 30/12/2014

	$('#kd_numSeri').change(function(mievento)
	{
		console.log("Peticion evento");
		kd_prodxNum_read();
		kd_histNum_read();
	});

	$('#kd_numSeri').keyup(function(mievento)
	{
		console.log("Peticion evento");
		kd_prodxNum_read();
		kd_histNum_read();
	});


});

$(function() 
{
	$( "#kd_transMov" ).dialog({
	autoOpen: false,
	width:720,
	height:420
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
	$( "#kd_movInter" ).dialog({
	autoOpen: false,
	width:720,
	height:420
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
	$( "#kd_seriStock" ).dialog({
	autoOpen: false,
	width:720,
	height:420
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
	$( "#kd_numSeriPopup" ).dialog({
	autoOpen: false,
	width:720,
	height:420
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
	$( "#kd_nuevNumSeri" ).dialog({
	autoOpen: false,
	width:320,
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
	$( "#kd_numSeriDina" ).dialog({
	autoOpen: false,
	width:780,
	height:420
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
	$( "#kd_numSeriStock" ).dialog({
	autoOpen: false,
	width:580,
	height:420
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

function kd_showNotped()
{
	//parametro
	notId=kd_obteValComb('kd_notPed');

	//peticion utils
	np_geneRep('reporte/np_repoNot.php','id',notId);
}

function kd_notPend_cap() //new --
{
	//parametro
	insTip=document.getElementById('kd_tipMov');
	tipMov=insTip.options[insTip.selectedIndex].value;
	ajax="notPend_cap";

	//peticion ajax
	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {ajax:ajax,tipMov:tipMov},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_notPed").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function kd_detNot_cap()
{
	//parametros
	insNot=document.getElementById('kd_notPed');
	notId=insNot.options[insNot.selectedIndex].value;
	ajax="detNot_cap";

	//cadena de parametros
	param="notId="+notId;
	param=param+"&ajax="+ajax;

	//peticion ajax
	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {ajax:ajax,notId:notId},
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

function kd_ewComp_cap()
{
	//code
	availableTags4=[];
	param="json=ewComp_cap";

	$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
	{
		for(i=0;i<data.length;i++)
		{

			availableTags4.push({key:data[i]['compras_id'],value:data[i]['comp_nro']});
		}

		  console.log(availableTags4);

		  $( "#kd_ewComp" ).autocomplete({
		  //source: availableTags3

	      minLength: 0,
	      source: availableTags4,
	      focus: function( event, ui ) {
	        $( "#kd_ewComp" ).val( ui.item.value );
	        return false;
	      },
	      select: function( event, ui ) {
	        $( "#kd_ewComp" ).val( ui.item.value );
	        $( "#kd_ewCompId" ).val( ui.item.key );
	 
	        return false;
	      } 
		  });
	});
}

function kd_empTrans_crear()
{
	//code
	empNom=document.getElementById('kd_empTrans').value;
	ruc=document.getElementById('kd_transRuc').value;
	dire=document.getElementById('kd_transDire').value;
	tel=document.getElementById('kd_telTrans').value;
	json="empTrans_crear";

	//param
	param="empNom="+empNom;
	param+="&ruc="+ruc;
	param+="&dire="+dire;
	param+="&tel="+tel;
	param+="&json="+json

	$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			console.log("Empresa de transporte añadida correctamente");

			//cerrar popup
			$('#kd_transMov').dialog('close');

			//limpiar campos popup
			document.getElementById('kd_empTrans').value="";
			document.getElementById('kd_transRuc').value="";
			document.getElementById('kd_transDire').value="";
			document.getElementById('kd_telTrans').value="";

			//cargar trabajadores actuales
			kd_trans_cap();
		}
		else
		{
			console.log("Empresa no añadida correctamente");
		}
	});


}

function kd_trans_cap()
{

	availableTags3=[];
	param="json=empTrans_obte";

	$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
	{
		for(i=0;i<data.length;i++)
		{

			availableTags3.push({key:data[i]['empId'],value:data[i]['empDes']});
		}

		  console.log(availableTags3);

		  $( "#kd_transDes" ).autocomplete({
		  //source: availableTags3

	      minLength: 0,
	      source: availableTags3,
	      focus: function( event, ui ) {
	        $( "#kd_transDes" ).val( ui.item.value );
	        return false;
	      },
	      select: function( event, ui ) {
	        $( "#kd_transDes" ).val( ui.item.value );
	        $( "#kd_transId" ).val( ui.item.key );
	 
	        return false;
	      } 
		  });
	});
}

function kd_nuevTrans_crear()
{
	//code
	transNom=document.getElementById('kd_transNom').value;
	transApe=document.getElementById('kd_transApe').value;
	transDni=document.getElementById('kd_transDni').value;
	transRuc=document.getElementById('kd_transRuc').value;
	transDomi=document.getElementById('kd_transDomi').value;
	json="nuevTrans_crear";

	//param
	param="transNom="+transNom;
	param=param+"&transApe="+transApe;
	param=param+"&transDni="+transDni;
	param=param+"&transRuc="+transRuc;
	param=param+"&transDomi="+transDomi;
	param=param+"&json="+json;


	$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			console.log("trabajador añadido correctamente..!");
			//limpiar campos
			document.getElementById('kd_transNom').value="";
			document.getElementById('kd_transApe').value="";
			document.getElementById('kd_transDni').value="";
			document.getElementById('kd_transRuc').value="";
			document.getElementById('kd_transDomi').value="";
			$('#kd_transMov').dialog('close');

			//cargar trabajadores actuales
			kd_trans_cap();
		}
		else
		{
			console.log("trabajador no añadido correctamente...!");
		}
	});
}

function glosaMov_actu()
{
	id=document.getElementById('kd_geneGuiaId').value;
	json="glosaMov_actu";

	detArr=new Array();
	glosaArr=new Array();
	itemArr=new Array();

	//nuevos array para generar guia
	uniArr=new Array();
	chkArr=new Array();
	prodArr=new Array();


	insDet=document.kd_frmDetGuia.kd_detId;
	insCheck=document.kd_frmDetGuia.kd_chkDes;
	ind=0;

	for(i=1;i<insDet.length;i++)
	{
		detArr[i]=insDet[i].value;
		glosaArr[i]=document.getElementById('kd_glosa_'+i).value;
		itemArr[i]=document.getElementById('kd_item_'+i).value;

		//llenado de array
		if(insCheck[i].checked)
		{
			valCheck=1;
		}
		else
		{
			valCheck=0;
		}
		uniArr[i]=document.getElementById('kd_unid_'+i).value;
		chkArr[i]=valCheck;
		prodArr[i]=document.getElementById('kd_desProd_'+i).value;
		
		ind++;
	}

	console.log(detArr);
	console.log(glosaArr);
	console.log(itemArr);

	//testeos de nuevos array
	console.log(uniArr);
	console.log(chkArr);
	console.log(prodArr);


	$.ajax({
    type:"POST",
    url: 'json/kd_json.php',
    data:{json:json,detArr:detArr,glosaArr:glosaArr,itemArr:itemArr,uniArr:uniArr,chkArr:chkArr,prodArr:prodArr},
    dataType: 'json',
    success: function(data) 
    {
    	if(data[0]>0)
    	{
    		console.log("Generando guia de remision: "+id);

			ins=document.createElement('a');
			ins.target="_blank";
			ins.href="reporte/jasperReporte/reporteGuia/kd_repoGuia.php?p1="+id;
			document.body.appendChild(ins);
			ins.click();
    	}   
    	else
    	{
    		console.log("Error al generar guia de remision: "+id);

    		ins=document.createElement('a');
			ins.target="_blank";
			ins.href="reporte/jasperReporte/reporteGuia/kd_repoGuia.php?p1="+id;
			document.body.appendChild(ins);
			ins.click();
    	} 
    }
    });
}

function kd_prevGuia(id)
{
	console.log("mostrando guia previa: "+id);
	location.href="index.php?menu_id=144&menu=kd_prevGuia&id="+id;
}

function kd_almEmp_cap(idConte)
{
	ajax="almEmp_cap";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$(idConte).html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function kd_movKardx_eli(id)
{
	console.log("Eliminando kardex con id: "+id);

	param="json=movKardx_eli";
	param=param+"&kardxId="+id;

	if(confirm("Desea eliminar el movimiento"))
	{
		$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				//alert("Movimiento eliminado correctamente...!");
				kd_iniHistKardx_ajax();
			}
			else
			{
				alert("Movimiento con detalle no eliminado...!");
			}
		});
	}
}

function kd_geneRepMov(id)
{
	ins=document.createElement('a');
	ins.target="_blank";
	ins.href="reporte/kd_repoMov.php?kardxId="+id;
	document.body.appendChild(ins);
	ins.click();
}

function kd_geneRepo(rep)
{
	if(rep=="pdf")
	{
		tipMov=kd_getValCombo('kd_tipMovHist');
		ins=document.createElement('a');
		ins.target="_blank";
		ins.href="reporte/kd_repoKardx.php?tipMov="+tipMov;
		document.body.appendChild(ins);
		ins.click();
	}
	else if(rep="excel")
	{
		console.log("Generando reporte excel");
		tipMov=kd_getValCombo('kd_tipMovHist');
		ins=document.createElement('a');
		ins.target="_blank";
		ins.href="reporteExcel/kd_repMovExcel.php?tipMov="+tipMov;
		document.body.appendChild(ins);
		ins.click();
	}
	else
	{

	}
}

function kd_serixProd_cap(prodId,idConte)
{
	ajax="serixProd_cap";
	almcId=kd_getValCombo('kd_almEmp');

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {ajax:ajax,prodId:prodId,almcId:almcId},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$(idConte).html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function kd_geneNumDina()
{
	//cantidad de campos a iterar
	cant=document.getElementById('kd_cant').value;

	//iterar campos de numeros de serie requeridos
	campDina="";
	ind=1;

	//agregar input observacion
	campDina="<label id='lbl2' >Observacion:</label>";
	campDina+="<textarea class='campo' id='kd_obsItem'></textarea>"

	for(i=0;i<cant;i++)
	{
		campDina+="<label id='lbl2' >N° Serie "+(ind++)+":</label><input class='campo' type='text' id='kd_numSeriDina_"+i+"' >";
		/*campDina+="<select id='kd_estaSeri_"+i+"' class='campo' ><option value='1' >completo</option><option value='2' >incompleto</option></select>";
		campDina+="<textarea class='campo' ></textarea>";*/
	}

	document.getElementById('kd_numSeriDinaIn').innerHTML=campDina;
}

function kd_lineProdxEw_obte()
{
	//parametros
	valEw=document.getElementById('kd_ewCompId').value;
	tare="ew";
	ajax="lineProdxEw_obte";
	desBus='';

	//peticion ajax
	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {ajax:ajax,desBus:desBus,tare:tare,valEw:valEw},
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

function marLine_obte()
{
	//MSG
	//console.log("msg");

	// OBTENER PARAMETROS
	catId=kd_getValCombo('kd_catProd');
	ajax="marLine_obte";

	// CARGAR AJAX
	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {ajax:ajax,catId:catId},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_mar").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function kd_modxTipMar_obte()
{
	tipId=kd_getValCombo('kd_tipProd');
	marId=kd_getValCombo('kd_mar');
	ajax="modxTipMar_obte";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {tipId:tipId,marId:marId,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_mod").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

}

function kd_marxTip_obte()
{
	tipId=kd_getValCombo('kd_tipProd');
	console.log(tipId);
	ajax="marxTip_obte";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {tipId:tipId,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_mar").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});	
}

function kd_getValRadio2()
{
	insId=document.frmRepAlm.kd_checkEmp;
	console.log(insId.length);
	ind=0;
	for(i=0;i<insId.length;i++)
	{
		if(insId[i].checked)
		{
			ind=insId[i].value;
		}

		//alert(insId[i].value);
	}
	return ind;
}

function kd_seriStock_regre()
{
	detKardxId=document.getElementById('kd_detMovId').value;
	detMovId=new Array();
	ind=0;
	json="seriStock_regre";

	insFrmRegre=document.kd_frmRegre.checkRegreId;
	for(i=0;i<insFrmRegre.length;i++)
	{
		if(insFrmRegre[i].checked)
		{
			detMovId[ind++]=insFrmRegre[i].value;
		}
	}

	$.ajax({
        type:"POST",
        url: 'json/kd_json.php',
        data:{json:json,detMovId:detMovId},
        dataType: 'json',
        success: function(data) 
        {
        	if(data[0]>0)
        	{
        		document.getElementById('msjRegre').innerHTML="Numeros de serie regresados correctamente....!";

        		setTimeout("lp_refreshMsj('msjRegre')",1200);
        		setTimeout("kd_numSeri_mos()",1200);
        		setTimeout('kd_seriMov_mos2()',1200);
        	}   
        	else
        	{
        		document.getElementById('msjRegre').innerHTML="Numeros de serie no regresados....!";
        	} 
        }
    });
}

function kd_seriMov_mos2()
{
	detKdxId=document.getElementById('kd_detMovId').value;
	ajax="seriMov_mos2";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {detKdxId:detKdxId,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_seriMov_mos2").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});	
}

function kd_movSeri_aña()
{
	detKardxId=document.getElementById('kd_detMovId').value;
	idNumSeri=new Array();
	ind=0;
	json="movSeri_aña";

	insFrmStock=document.kd_frmStock.checkSeriId;
	for(i=0;i<insFrmStock.length;i++)
	{
		if(insFrmStock[i].checked)
		{
			idNumSeri[ind++]=insFrmStock[i].value;
		}
	}

	$.ajax({
        type:"POST",
        url: 'json/kd_json.php',
        data:{json:json,idNumSeri:idNumSeri,detKardxId:detKardxId},
        dataType: 'json',
        success: function(data) 
        {
        	if(data[0]>0)
        	{
        		document.getElementById('msjStock').innerHTML="Numeros de serie elegidos correctamente....!";

        		setTimeout("lp_refreshMsj('msjStock')",1200);
        		setTimeout("kd_numSeri_mos()",1200);
        	}   
        	else
        	{
        		document.getElementById('msjStock').innerHTML="Numeros de serie no elegidos....!";
        	} 
        }
    });

}


function kd_numSeri_mos()
{
	idDetMov=document.getElementById('kd_detMovId').value;
	ajax="numSeri_mos";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {idDetMov:idDetMov,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_numSeri_mos").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function kd_seriMov_eli(id)
{
	detMovId=id;
	json="seriMov_eli";

	param="detMovId="+detMovId;
	param=param+"&json="+json;

	$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('msjNuevSeri').innerHTML="Numero de serie eliminado con exito....!";

			setTimeout("lp_refreshMsj('msjNuevSeri')",1200);
			setTimeout('kd_seriMov_mos()',1200);

		}
		else
		{
			document.getElementById('msjNuevSeri').innerHTML="Numero de serie no eliminado....!";
		}
	});

}

function lp_refreshMsj(id)
{
	document.getElementById(id).innerHTML="Mensaje de confirmacion";
}

function kd_seriMov_mos()
{
	detKdxId=document.getElementById('kd_detMovId').value;
	ajax="seriMov_mos";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {detKdxId:detKdxId,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_seriMov_mos").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});	
}

function kd_numSeri_ingre()
{
	detKadxId=document.getElementById('kd_detMovId').value;
	desProd=document.getElementById('kd_desSeri').value;
	numSeri=document.getElementById('kd_numSeri').value;

	param="detKadxId="+detKadxId;
	param=param+"&desProd="+desProd;
	param=param+"&numSeri="+numSeri;
	param=param+"&json=numSeri_ingre";

	$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
	{
		if(data[0]>0)
		{
			document.getElementById('msjNuevSeri').innerHTML="Numero de serie añadido correctamente....!";

			setTimeout("lp_refreshMsj('msjNuevSeri')",1200);
		}
		else
		{
			document.getElementById('msjNuevSeri').innerHTML="Numero de serie no añadido....!";
		}
	});
}

function kd_seriStock_open()
{
	$('#kd_seriStock').dialog('open');
}

function kd_nuevNumSeri_open()
{
	$('#kd_nuevNumSeri').dialog('open');
}

function kd_numSeriPopup_open(id)
{
	if(kd_getValCombo('kd_tipMov')==1)
	{
		$('#kd_numSeriPopup').dialog('open');
		alert("id detalle: "+id+" preparado para numeros de serie");
		document.getElementById('kd_detMovId').value=id;
		setTimeout('kd_seriMov_mos()',1200);
	}
	else if(kd_getValCombo('kd_tipMov')==2)
	{
		kd_seriStock_open();
		document.getElementById('kd_detMovId').value=id;
		kd_numSeri_mos();
		kd_seriMov_mos2();
	}
	else
	{
		 excep="Ningun tipo de movimiento por mostrar";
	}
}

function kd_iniHistKardx_ajax()
{
	tipMov=kd_getValCombo('kd_tipMovHist');
	ajax="iniHistKardx";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {tipMov:tipMov,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#iniHistKardx_ajax").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});	
}

function kd_direDetKardx(id,tip)
{
	if(tip==1)
	{
		location.href="index.php?menu_id=144&menu=kd_geneKardx&id="+id;
	}
	else if(tip==2)
	{
		location.href="index.php?menu_id=144&menu=kd_geneKardxs&id="+id;
	}
	else if(tip==3)
	{
		location.href="index.php?menu_id=144&menu=kd_geneKardxi&id="+id;
	}
	else
	{
		excep="ningun tipo";
	}
}

function kd_iniRadioDoc(val)
{
	console.log("tipDoc:"+val);
	insRadio=document.frmGenMov.kd_doc;

	for(i=0;i<insRadio.length;i++)
	{
		if(insRadio[i].value==val)
		{
			insRadio[i].checked=true;
		}
	}
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

function kd_iniGenKardx()
{
	kardxId=document.getElementById('kd_kdxId').value;
	param="kardxId="+kardxId;
	param=param+"&json=iniGenKardx";

	$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
	{
		kd_iniCombo('kd_tipMov',data[0]['tipMov']);

		if(data.length>0)
		{
			console.log(data);

			//obtener ew de compra
			document.getElementById('kd_ewComp').value=data[0]['comp_nro'];
			document.getElementById('kd_ewCompId').value=data[0]['ewCompId'];

			//evaluar tipo de movimiento
			tipMov=kd_getValCombo('kd_tipMov');
			if(tipMov==1)
			{
				document.getElementById('kd_empDes').value=data[0]['empDes'];
				document.getElementById('kd_empId').value=data[0]['empId'];
			}
			else if(tipMov==2)
			{
				document.getElementById('kd_empDes').value=data[0]['empDes'];
				document.getElementById('kd_empId').value=data[0]['empId'];
			}
			else if(tipMov==3)
			{
				document.getElementById('kd_empDes').value="ELECTROWERKE S.A.";
				document.getElementById('kd_empId').value=309;
			}
			else
			{
				excep="no existe tipo";
			}

			document.getElementById('kd_fechMov').value=data[0]['fechMov'];

			//Iniciar Numero de documento
			numDoc=data[0]['numDoc'];
			numDocArr=numDoc.split("-",2);
			numDoc1=numDocArr[0];
			numDoc2=numDocArr[1];
			document.getElementById('kd_numDoc1').value=numDoc1;
			document.getElementById('kd_numDoc2').value=numDoc2;
			
			document.getElementById('kd_desMov').value=data[0]['desMov'];
			kd_iniCombo('kd_tipMov',data[0]['tipMov']);
			kd_iniCombo('kd_moneId',data[0]['moneMov']);
			kd_iniCombo('kd_almEmp',data[0]['almcId']);
			kd_iniRadioDoc(data[0]['tipDoc']);
			kd_oculRadio(data[0]['tipMov']);

			//Iniciar campos adicionales
			document.getElementById('kd_desti').value=data[0]['desti'];
			document.getElementById('kd_transDes').value=data[0]['transDes'];
			document.getElementById('kd_transId').value=data[0]['transId'];

			numFac=data[0]['numFac'];
			numFacArr=numFac.split("-",2);
			numDoc1=numFacArr[0];
			numDoc2=numFacArr[1];
			document.getElementById('kd_facIni').value=numDoc1;
			document.getElementById('kd_facFin').value=numDoc2;

			document.getElementById('kd_FacEmis').value=data[0]['facEmis'];

		}
	});
}

function kd_oculRadio(tipMov)
{
	insRadio=document.frmGenMov.kd_doc;
	for(i=0;i<insRadio.length;i++)
	{
		if(tipMov==2)
		{
			insRadio[2].style.display="none";
			document.getElementById('kd_lblDua').style.display="none";
		}
	}
}

function kd_direKardxPrin()
{
	location.href="index.php?menu_id=144&menu=kd_listKardx";	
}

function kd_eliDetMov(idDet)
{
	tipMov=kd_getValCombo('kd_tipMov');
	console.log("tipMov:"+tipMov);

	param="json=eliDetMov";
	param=param+"&idKdxDet="+idDet;
	param=param+"&tipMov="+tipMov;

	if(confirm("Desea eliminar el item ingresado...!"))
	{
		$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				alert("Item eliminado correctamente....!");
				kd_detKardxid_ajax();

				//test data
				console.log(data);

				//cargar stock actual
				kd_prodLine_ajax();
			}
			else
			{
				alert("Item no eliminado...!")
			}
		});
	}
}


function kd_setGenKardx()
{
	kdxId=document.getElementById('kd_kdxId').value;
	tipMov=kd_getValCombo('kd_tipMov');
	empId=document.getElementById('kd_empId').value;
	fechMov=document.getElementById('kd_fechMov').value;
	tipDoc=kd_getValTipDoc();
	numDoc=document.getElementById('kd_numDoc1').value+"-"+document.getElementById('kd_numDoc2').value;
	desMov=document.getElementById('kd_desMov').value;
	moneMov=kd_getValCombo('kd_moneId');
	almcId=kd_getValCombo('kd_almEmp');
	ewCompId=document.getElementById('kd_ewCompId').value;


	//parametros adicionales de datos generales

	kd_desti=document.getElementById('kd_desti').value;
	kd_transId=document.getElementById('kd_transId').value;
	kd_numFac=document.getElementById('kd_facIni').value+"-"+document.getElementById('kd_facFin').value;
	kd_FacEmis=document.getElementById('kd_FacEmis').value;


	//test parametro
	console.log(tipDoc);

	//evaluar json a llamar
	if(kdxId==0)
	{
		json="geneMovKardx";
	}
	else
	{
		json="geneMov_upd";		
	}


	param="kdxId="+kdxId;
	param=param+"&tipMov="+tipMov;
	param=param+"&empId="+empId;
	param=param+"&fechMov="+fechMov;
	param=param+"&tipDoc="+tipDoc;
	param=param+"&numDoc="+numDoc;
	param=param+"&desMov="+desMov;
	param=param+"&moneMov="+moneMov;
	param=param+"&almcId="+almcId;
	param=param+"&kd_desti="+kd_desti;
	param=param+"&kd_transId="+kd_transId;
	param=param+"&kd_numFac="+kd_numFac;
	param=param+"&kd_FacEmis="+kd_FacEmis;
	param=param+"&ewCompId="+ewCompId;
	param=param+"&json="+json;

	//console.log(moneMov);
	if(tipDoc>0)
	{
		$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				if(json=="geneMov_upd")
				{
					alert("Se genero el movimiento correctamente...!");
					setTimeout(function(){location.href="index.php?menu_id=144&menu=kd_listKardx";},700);
				}
				else
				{
					if(tipMov==1)
					{
						location.href="index.php?menu_id=144&menu=kd_geneKardx&id="+data[0];
					}
					else if(tipMov==2)
					{
						location.href="index.php?menu_id=144&menu=kd_geneKardxs&id="+data[0];
					}
					else if(tipMov==3)
					{
						location.href="index.php?menu_id=144&menu=kd_geneKardxi&id="+data[0];
					}
					else
					{
						console.log("Tipo  de movimiento no valido...!");
					}
				}
			}
			else
			{
				alert("Se genero el movimiento correctamente...!");
				setTimeout(function(){location.href="index.php?menu_id=144&menu=kd_listKardx";},700);
			}
		});
	}
	else
	{
		alert("Seleccionar un tipo de documento...!");
	}
}

function kd_getValCombo(id)
{
	insId=document.getElementById(id);
	if(insId.length>0)
	{
		valId=insId.options[insId.selectedIndex].value;
	}
	else
	{
		valId=0;
	}
	
	return valId;
}

function kd_getValTipDoc()
{
	insId=document.frmGenMov.kd_doc;
	//console.log(insId.length);
	ind=0;
	for(i=0;i<insId.length;i++)
	{
		if(insId[i].checked)
		{
			ind=insId[i].value;
		}

		//alert(insId[i].value);
	}
	return ind;	
}

function kd_getValRadio()
{
	insId=document.frmLineProd.kd_lineId;
	console.log(insId.length);
	ind=0;
	for(i=0;i<insId.length;i++)
	{
		if(insId[i].checked)
		{
			ind=insId[i].value;
		}

		//alert(insId[i].value);
	}
	return ind;
}

function kd_detKardxid_ajax()
{
	kdxId=document.getElementById('kd_kdxId').value;
	ajax="detKardxid";

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {kdxId:kdxId,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_detKardx_ajax").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function kd_detKard3_json()
{
	json="detKard3_agre";
	prodId=kd_getValRadio();
	idKdx=document.getElementById('kd_kdxId').value;
	preUni=document.getElementById('kd_preUni').value;
	kdxCant=document.getElementById('kd_cant').value;
	tipMov=kd_getValCombo('kd_tipMov');
	almcId=kd_getValCombo('kd_almEmp');
	obsItem=document.getElementById('kd_obsItem').value;


	// evaluar eleccion ubicacion almacen
	if(tipMov==3)
	{
		almcId=kd_getValCombo('kd_destiUbi');
	}
	else
	{
		almcId=almcId;
	}

	console.log("almacen:"+almcId);
	console.log("tipMov:"+tipMov);

	//obtener array de checkbox seleccionados
	if(tipMov==3)
	{
		arrStock=new Array();
		insSeriStock=document.kd_frmSeriStock2.kd_seriStock;
		ind=0;
		for(i=0;i<insSeriStock.length;i++)
		{
			if(insSeriStock[i].checked)
			{
				arrStock[ind++]=insSeriStock[i].value;
			}
		}
	}
	else
	{
		arrStock=new Array();
		insSeriStock=document.kd_frmSeriStock.kd_seriStock;
		ind=0;
		for(i=0;i<insSeriStock.length;i++)
		{
			if(insSeriStock[i].checked)
			{
				arrStock[ind++]=insSeriStock[i].value;
			}
		}
	}


	//obtener cadena de array seri
	cadArr="";
	for(i=0;i<arrStock.length;i++)
	{
		if(i==0)
		{
			cadArr=cadArr+arrStock[i];
		}
		else
		{
			cadArr=cadArr+"|"+arrStock[i];
		}
	}

	//mostrar variables
	console.log(cadArr);
	console.log(kdxCant);
	console.log(arrStock.length);

	//validacion de inicio de flujo persistente

	if(kdxCant==arrStock.length)
	{
		if(prodId>0)
		{

			param="prodId="+prodId;
			param=param+"&kdxId="+idKdx;
			param=param+"&preUni="+preUni;
			param=param+"&kdxCant="+kdxCant;
			param=param+"&json="+json;
			param=param+"&tipMov="+tipMov;
			param=param+"&cadArr="+cadArr;
			param=param+"&almcId="+almcId;
			param=param+"&obsItem="+obsItem;


			$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
			{
				if(data[0]>0)
				{
					alert("Item añadido correctamente...!");

					//limpiar campo
					document.getElementById('kd_obsItem').value='';
				}
				else
				{
					//alert("Item no añadido, stock no disponible...!");
					console.log(data[0]);

					//limpiar campo
					document.getElementById('kd_obsItem').value='';
				}
			});
			}
		else
		{
			alert("Seleccionar el item del producto...!");
		}
		//console.log("En buena hora flujo detectado");
	}
	else
	{
		alert("Cantidad elegida no valida");
	}


}

function kd_detKard2_json()
{
	json="detKard2_agre";
	prodId=kd_getValRadio();
	idKdx=document.getElementById('kd_kdxId').value;
	preUni=document.getElementById('kd_preUni').value;
	kdxCant=document.getElementById('kd_cant').value;
	tipMov=kd_getValCombo('kd_tipMov');
	almcId=kd_getValCombo('kd_almEmp');
	obsItem=document.getElementById('kd_obsItem').value;


	//capturar data de numeros de serie
	cant=document.getElementById('kd_cant').value;
	cadArr="";
	contVali=0;
	for(i=0;i<cant;i++)
	{

		//validar campos vacios
		if(document.getElementById('kd_numSeriDina_'+i).value=='')
		{
			contVali++;
		}

		if(i==0)
		{
			cadArr+=document.getElementById('kd_numSeriDina_'+i).value;
			//document.getElementById('kd_numSeriDina_'+i).value="";
		}	
		else
		{
			cadArr+="|"+document.getElementById('kd_numSeriDina_'+i).value;
			//document.getElementById('kd_numSeriDina_'+i).value="";
		}
	}

	console.log(cadArr);

	if(contVali>0)
	{
		alert("Completar todos los campos de numeros de serie...!");
	}
	else if(prodId>0)
	{

		param="prodId="+prodId;
		param=param+"&kdxId="+idKdx;
		param=param+"&preUni="+preUni;
		param=param+"&kdxCant="+kdxCant;
		param=param+"&json=detKard2_vali";
		param=param+"&tipMov="+tipMov;
		param=param+"&cadArr="+cadArr;
		param=param+"&almcId="+almcId;
		param=param+"&obsItem="+obsItem;

		$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
		{

			console.log(data);

			if(data.length>0)
			{
				var cadSeri="";

				for(i=0;i<data.length;i++)
				{
					cadSeri=cadSeri+"N° "+data[i]['ind']+": "+data[i]['numSeri']+"\n\n";
				}

				alert("Numeros de serie ya existen...!"+"\n\n"+cadSeri);
			}
			else
			{

				param="prodId="+prodId;
				param=param+"&kdxId="+idKdx;
				param=param+"&preUni="+preUni;
				param=param+"&kdxCant="+kdxCant;
				param=param+"&json=detKard2_agre";
				param=param+"&tipMov="+tipMov;
				param=param+"&cadArr="+cadArr;
				param=param+"&almcId="+almcId;
				param=param+"&obsItem="+obsItem;

				$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
				{
					if(data[0]>0)
					{
						alert("Item añadido correctamente...!");

						//cerrar popup de entradas
						$('#kd_numSeriDina').dialog('close');

						//cargar detalle de movimiento
						setTimeout('kd_detKardxid_ajax()',1200);

						//cargar Stock afectado
						setTimeout('kd_prodLine_ajax()',1200);

						//limpiar campos de formulario
							for(i=0;i<cant;i++)
							{

								if(i==0)
								{
									//cadArr+=document.getElementById('kd_numSeriDina_'+i).value;
									document.getElementById('kd_numSeriDina_'+i).value="";
								}	
								else
								{
									//cadArr+="|"+document.getElementById('kd_numSeriDina_'+i).value;
									document.getElementById('kd_numSeriDina_'+i).value="";
								}
							}
					}
					else
					{
						alert("Item no añadido, stock no disponible...!");
					}
				});

			}
		});
	}
	else
	{
		alert("Seleccionar el item del producto...!");
	}
}

function kd_detKard_json()
{
	json="detKard_agre";
	prodId=kd_getValRadio();
	idKdx=document.getElementById('kd_kdxId').value;
	preUni=document.getElementById('kd_preUni').value;
	kdxCant=document.getElementById('kd_cant').value;
	tipMov=kd_getValCombo('kd_tipMov');

	if(prodId>0)
	{

		param="prodId="+prodId;
		param=param+"&kdxId="+idKdx;
		param=param+"&preUni="+preUni;
		param=param+"&kdxCant="+kdxCant;
		param=param+"&json="+json;
		param=param+"&tipMov="+tipMov;

		$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				alert("Item añadido correctamente...!");
			}
			else
			{
				alert("Item no añadido, stock no disponible...!");
			}
		});
	}
	else
	{
		alert("Seleccionar el item del producto...!");
	}
}

function kd_prodLine_ajax()
{

	//MSG
	console.log("msg");

	//AJAX
	ajax="prodLine";

	//PARAMETERS
	valSub=kd_getValCombo('kd_subClasi');
	valCat=kd_getValCombo('kd_catProd');
	mar=kd_getValCombo('kd_mar');

	//valTip=kd_getValCombo('kd_tipProd');
	//marModel=kd_getValCombo('kd_marMod');
	//mod=kd_getValCombo('kd_mod');	

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {valSub:valSub,valCat:valCat,mar:mar,ajax:ajax},
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

function kd_marMod_ajax()
{

	ajax="obteMarModxId";

	insTip=document.getElementById('kd_tipProd');

	if(insTip.length>0)
	{
		valTip=insTip.options[insTip.selectedIndex].value;
	}
	else
	{
		valTip=0;
	}

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {valTip:valTip,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_marMod").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});	
}

function kd_tipProd_ajax()
{

	ajax="obteTipxId";

	insCat=document.getElementById('kd_catProd');

	if(insCat.length>0)
	{
		valCat=insCat.options[insCat.selectedIndex].value;
	}
	else
	{
		valCat=0;
	}

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {valCat:valCat,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_tipProd").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}


function kd_cateProd_ajax()
{

	ajax="obteCatexid";

	insSub=document.getElementById('kd_subClasi');

	if(insSub.length>0)
	{
		valSub=insSub.options[insSub.selectedIndex].value;
	}
	else
	{
		insSub=0;
	}

	var request = $.ajax({
	url: "ajax/kd_ajax.php",
	type: "POST",
	data: {valSub:valSub,ajax:ajax},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#kd_catProd").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

//Generar movimiento nuevo
function kd_nuevMovKardx_json()
{
	tipMov=kd_getValCombo('kd_tipMovHist');

	if(tipMov==1)
	{
		location.href="index.php?menu_id=144&menu=kd_geneKardx&id=0";
	}
	else if(tipMov==2)
	{
		location.href="index.php?menu_id=144&menu=kd_geneKardxs&id=0";
	}
	else if(tipMov==3)
	{
		location.href="index.php?menu_id=144&menu=kd_geneKardxi&id=0";
	}
}


function kd_geneMovKardx_json()
{

	param="json=geneMovKardx";
	param=param+"&tipMov="+kd_getValCombo('kd_tipMovHist');

	//tipo de movimiento
	tipMov=kd_getValCombo('kd_tipMovHist');

	if(kd_getValCombo('kd_tipMovHist')>0)
	{
		$.getJSON('json/kd_json.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				if(tipMov==1)
				{
					location.href="index.php?menu_id=144&menu=kd_geneKardx&id="+data[0];
				}
				else if(tipMov==2)
				{
					location.href="index.php?menu_id=144&menu=kd_geneKardxs&id="+data[0];
				}
				else if(tipMov==3)
				{
					location.href="index.php?menu_id=144&menu=kd_geneKardxi&id="+data[0];
				}
				else
				{
					excep="ningun tipo evaluado";
				}
			}
			else
			{
				console.log("No se genero movimiento");
			}
		});
	}
	else
	{
		alert("Seleccionar el tipo de movimiento para generar...!");
	}
}

function kd_evaEmpMov()
{
	insTip=document.getElementById('kd_tipMov');
	valTip=insTip.options[insTip.selectedIndex].value;

	if(valTip==1)
	{
		filBus="prov";
	}
	else if(valTip==2)
	{
		filBus="cli";
	}
	else if(valTip==3)
	{
		filBus="tod";
	}
	else
	{
		filBus="";
	}

	return filBus;
}


function kd_empMov_json()
{
	availableTags2=[];

	filBus=kd_evaEmpMov();

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

		  $( "#kd_empDes" ).autocomplete({
		  //source: availableTags2

	      minLength: 0,
	      source: availableTags2,
	      focus: function( event, ui ) {
	        $( "#kd_empDes" ).val( ui.item.value );
	        return false;
	      },
	      select: function( event, ui ) {
	        $( "#kd_empDes" ).val( ui.item.value );
	        $( "#kd_empId" ).val( ui.item.key );
	 
	        return false;
	      } 
		  });
	});
}

//New update 30/12/2014

	//FUNCTION AJAX

		function kd_prodxNum_read()
		{
			/*vars*/
			numSeri=document.getElementById('kd_numSeri').value;
			ajax="kd_prodxNum_read";

			/*param*/

			/*peticion ajax*/
			var request = $.ajax({
			url: "ajax/kd_ajax.php",
			type: "POST",
			data: {ajax:ajax,numSeri:numSeri},
			dataType: "html"
			});
			
			request.done(function(msg) {
			//document.getElementById('scInventario').value='';
			//var acontenidoAjax = a('#loading').html('');
			$("#kd_prodSeri_tab").html( msg );
			});
			
			request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
			});
		}

		function kd_histNum_read()
		{
			/*vars*/
			numSeri=document.getElementById('kd_numSeri').value;
			ajax="kd_histNum_read";

			/*param*/

			/*peticion ajax*/
			var request = $.ajax({
			url: "ajax/kd_ajax.php",
			type: "POST",
			data: {ajax:ajax,numSeri:numSeri},
			dataType: "html"
			});
			
			request.done(function(msg) {
			//document.getElementById('scInventario').value='';
			//var acontenidoAjax = a('#loading').html('');
			$("#kd_histSeri_tab").html( msg );
			});
			
			request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
			});

		}

	//FUNCTION JSON
	//FUNCTION JS
	//FUNCTION POPUP
	//FUNCTION EVENTS

