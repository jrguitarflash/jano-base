$(function() {
$( "#tabs" ).tabs();
});

window.onload=function()
{
	Calendario3('txtFechGozIni');
	Calendario3('txtFechGozFin');
	setTimeout('jsOculNoti()',2500);
	setTimeout('jsonForCalAsig()',500);

	//Inicializar campos

	var query = document.getElementById("modojs").src.match(/\?.*$/);

	if(query) 
	{
		//self[query.split("=")[0]] = query.split("=")[1]);
		var param=query[0];
		modo=param.split("=",2);
		console.log(modo[1]);
	}

	console.log(query);

	if(modo[1]=="1")
	{
		ajaxPeriTrab();
		//console.log(modo);
	}
	else if(modo[1]=="2")
	{
		ajaxPeriTrabxPeri();
		//console.log(modo);
	}
	else
	{
		console.log('inicio vacio');
	}

}

function jsOculNoti()
{
	document.getElementById('success').style.display='none';
}

function jsonEvaDisPeri(trabId,perId)
{
	param="trabId="+trabId;
	param="&perId="+perId;
	$.getJSON('json/jsonEvaDisPeri.php?'+param,{format: "json"}, function(data) 
	{
		valEvaDispo=data[0];
		return valEvaDispo;
	});	
}

function jsonForCalAsig()
{
	insTrabId=document.getElementById('slcTrab');
	valTrabId=insTrabId.options[insTrabId.selectedIndex].value;

	insPerId=document.getElementById('slcPeri');
	valPerId=insPerId.options[insPerId.selectedIndex].value;

	param="trabId="+valTrabId;
	param=param+"&perId="+valPerId;

	$.getJSON('json/jsonForCalAsig.php?'+param,{format: "json"}, function(data) 
	{
		insForcal=document.frmVacaAsig.diHabil;
		for(i=0;i<insForcal.length;i++)
		{
			if(insForcal[i].value==data[0])
			{
				insForcal[i].checked=true;
			}
		}

	});
}

$(function() {
	$( "#dialog1" ).dialog({
	autoOpen: false,
	width:300,
	height:200,
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

function showDetDiGoz(id)
{
	var param="vacaId="+id;
	$.getJSON('json/jsonShowDetDiGoz.php?'+param,{format: "json"}, function(data) 
	{
		document.getElementById('fechInGoc').innerHTML="<strong>Fecha Inicial Goce:</strong> "+data[0]['vaca_mesGocIni'];
		document.getElementById('fechFinGoc').innerHTML="<strong>Fecha Final Goce:</strong> "+data[0]['vaca_mesGocFin'];
	});

	$( "#dialog1" ).dialog( "open" );
}

function ajaxTrabxAre()
{	

	var insValAre=document.getElementById('slcAre');
	valAre=insValAre.options[insValAre.selectedIndex].value;
	
	console.log(valAre);

	var request = $.ajax({
	url: "ajax/ajaxTrabxAre.php",
	type: "POST",
	data: {valAre:valAre},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#slcTrab").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

	setTimeout('ajaxPeriTrab()',1700);
}

function ajaxTrabxAreAsig()
{	

	var insValAre=document.getElementById('slcAre');
	valAre=insValAre.options[insValAre.selectedIndex].value;
	
	console.log(valAre);

	var request = $.ajax({
	url: "ajax/ajaxTrabxAre.php",
	type: "POST",
	data: {valAre:valAre},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#slcTrab").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function ajaxTrabxAreIni()
{	

	var insValAre=document.getElementById('slcAre');
	valAre=insValAre.options[insValAre.selectedIndex].value;
	
	console.log(valAre);

	var request = $.ajax({
	url: "ajax/ajaxTrabxAreIni.php",
	type: "POST",
	data: {valAre:valAre},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#slcTrab").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function ajaxPeriTrab()
{	

	var insValAr=document.getElementById('slcAre');
	var insValTrab=document.getElementById('slcTrab');
	var insValPeri=document.getElementById('slcPeri');

	valAr=insValAr.options[insValAr.selectedIndex].value;
	valTrab=insValTrab.options[insValTrab.selectedIndex].value;
	valPeri=insValPeri.options[insValPeri.selectedIndex].value;
	
	//console.log(valAre);

	/*
	insValHab=document.frmVacaPeriod.diHabil;
	for(i=0;i<insValHab.length;i++)
	{
		if(insValHab[i].checked)
		{
			valHab=insValHab[i].value;
		}
	}

	console.log(valHab);
	*/

	var request = $.ajax({
	url: "ajax/ajaxPeriTrab.php",
	type: "POST",
	data: {valTrab:valTrab,valPeri:valPeri,valAr:valAr},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#tabs-1").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function ajaxPeriTrabxPeri()
{	

	var insValPeri=document.getElementById('slcPeri');

	valPeri=insValPeri.options[insValPeri.selectedIndex].value;
	
	//console.log(valAre);

	var request = $.ajax({
	url: "ajax/ajaxPeriTrabxPeri.php",
	type: "POST",
	data: {valPeri:valPeri},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#tabs-1").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function jsAsigVaca()
{
	insValTrab=document.getElementById('slcTrab');
	valTrab=insValTrab.options[insValTrab.selectedIndex].value;

	insValPer=document.getElementById('slcPeri');
	valPer=insValPer.options[insValPer.selectedIndex].value;

	fechIni=document.getElementById('txtFechGozIni').value;
	fechFin=document.getElementById('txtFechGozFin').value;

	insValHab=document.frmVacaAsig.diHabil;
	for(i=0;i<insValHab.length;i++)
	{
		if(insValHab[i].checked)
		{
			valHab=insValHab[i].value;
		}
	}

	var param='trabId='+valTrab;
	param=param+'&fechEva='+document.getElementById('txtFechGozIni').value;
	param=param+'&valPer='+valPer;
	param=param+'&fechIni='+fechIni;
	param=param+'&fechFin='+fechFin;
	param=param+'&valHab='+valHab;

	//console.log(getNumeroDeNits());
	//console.log(valHab);
	
	$.getJSON('json/jsonEvaAsig.php?'+param,{format: "json"}, function(data) 
	{
		valData=parseInt(data[0]);
		valDiHab=parseInt(data[1]);
		numNoHab=parseInt(data[5]);

		numNoHab=jsEvaForCalValid(numNoHab,valHab);

		//console.log(valDiHab);
		//or = ||
		//and = &&
		//console.log(jsonTestNomMes());
		console.log(data[2]+' '+data[3]+' '+valPer);
		console.log(numNoHab);
		console.log(data[6]);


			if(data[3]==1 && data[2]==valPer)
			{
				if(document.getElementById('txtFechGozIni').value!='' && document.getElementById('txtFechGozFin').value!='')
				{
					if(valData<=0)
					{
						if(((getNumeroDeNits()-numNoHab)+valDiHab)<=valHab)
						{
							document.frmVacaAsig.method='POST';
							document.frmVacaAsig.accion.value='enviar';
							document.frmVacaAsig.submit();
						}
						else
						{
							alert("Dias asignados no son validos..!"+"\n"+"Dias disponibles:"+evaDiaNeg((valHab-valDiHab))+"\n"+"Dias Solicitados:"+(getNumeroDeNits()-numNoHab));
						}

					}
					else
					{
						alert("Las fechas ya fueron asignadas....!");
					}
					//console.log(valData+1);
				}
				else
				{
					alert("Completar los rangos de fechas...!");
				}
				//alert("si se puede asignar dias al periodo....!");
			}
			else if(data[3]==2 && data[2]==valPer)
			{
				alert("El periodo esta lleno...!");
			}
			else
			{
				alert("Existe periodo por completar...!");
			}

	});
	
}

function jsEvaForCalValid(numNoHab,valHab)
{
	if(valHab==22)
	{
		numNoHab=numNoHab;
	}
	else
	{
		numNoHab=0;
	}
	return numNoHab;
}

function jsForCalVaca()
{
	//console.log("loading...!");
	document.frmVacaAsig.method='POST';
	document.frmVacaAsig.accion.value='enviar2';
	document.frmVacaAsig.submit();
}

function evaDiaNeg(valDia)
{
	if(valDia<0)
	{
		valDia=0;
	}
	else
	{
		valDia=valDia;
	}
	return valDia;
}

function evaValNan(valHab)
{
	//if(isNaN(valHab))
	if(valHab==null)
	{
		valHab=0;
	}
	else
	{
		valHab=valHab;
	}
	return	valHab;
}

function getNumeroDeNits()
{
    var d1 = $('#txtFechGozIni').val().split("-");
    var dat1 = new Date(d1[0], parseFloat(d1[1])-1, parseFloat(d1[2]));
    var d2 = $('#txtFechGozFin').val().split("-");
    var dat2 = new Date(d2[0], parseFloat(d2[1])-1, parseFloat(d2[2]));
     
    var fin = dat2.getTime() - dat1.getTime();
    var dias = Math.floor(fin / (1000 * 60 * 60 * 24))
     
    return dias+1;
}

function crearCookie()
{
	saludo1="hi";
	saludo2="hello";
	document.cookie="v1="+saludo1;
	document.cookie="v2="+saludo2;
}

function llamarCookie()
{
	misCookies = document.cookie;
	listaCookies = misCookies.split(";");
	console.log(listaCookies);

	/*
		for (i in listaCookies) 
		{
		    busca1 = listaCookies[i].search("saludo1");
		    if (busca1 > -1) {micookie=listaCookies[i];}
		    console.log(micookie);
	    }
    */	
}

function borrarCookie() 
{
	document.cookie = 'saludo2'+'=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
}

function jsonEliVaca(vacaId)
{
	if(confirm("Confirma eliminar registro..!"))
	{
		var param="vacaId="+vacaId;

		$.getJSON('json/jsonEliVaca.php?'+param,{format: "json"}, function(data) 
		{
			if(data[0]>0)
			{
				ajaxPeriTrab();
			}				
		});
	}
	else
	{
		alert("Accion cancelada...!");
	}
}

function jsGenePer()
{
	console.log("Generando nuevo periodo....");
	document.frmPerAn.accion.value='enviar';
	document.frmPerAn.method='post';
	document.frmPerAn.submit();
}

function jsActPer()
{
	console.log("Activando periodos......");
	document.frmPerAn.accion.value='enviar2';
	document.frmPerAn.method='post';
	document.frmPerAn.submit();
}

function jsonTestNomMes()
{

	var fechIni=document.getElementById('txtFechGozIni').value;
	var fechFin=document.getElementById('txtFechGozFin').value;

	param="fechIni="+fechIni;
	param=param+"&fechFin="+fechFin;

	$.getJSON('json/jsonTestNomMes.php?'+param,{format: "json"}, function(data) 
	{
		console.log("Diferencia dias completos:"+data[0]);
		console.log("Diferencia dias habiles:"+data[1]);
		numNoHab=data[1];
		document.getElementById('txtDiNoHab').value=numNoHab;
	});
}