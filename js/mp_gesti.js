/* AJAX
	ajaxGridMovPer.php
	ajaxDetMovPer.php
	ajaxValidAdmin.php
	ajaxBusMovPer.php
*/

/* JSON
	jsonValidDetMov.php
	jsonAprobMov.php
*/

window.onload=function()
{

	var query = document.getElementById("modojs").src.match(/\?.*$/);

	if(query) 
	{
		//self[query.split("=")[0]] = query.split("=")[1]);
		var param=query[0];
		modo=param.split("=",2);
		console.log(modo[1]);
	}


	if(modo[1]=="1")
	{
		Calendario3('mp_fechSali');
		Calendario3('mp_fechRetor');
		setTimeout("oculNoti('success')",1800);
		mp_hourSali();
		mp_hourRetor();
	}
	else if(modo[1]=="2")
	{
		Calendario3('mp_fechMov');
		mp_ajaxBusMovPer();
		ajaxTrabxAre();
	}
	else
	{
		console.log('inicio vacio');
	}

}

function mp_ajaxGridMovPer(id,acci)
{
	//alert("id:"+id+"\n"+"acci:"+acci);

	// PARAMETROS OPERATIVOS
	acciGrid=acci;
	idDet=id;
	idMovPer='';

	// PARAMETROS DATA
	motiv=document.getElementById('mp_motiv').value;
	ubi=document.getElementById('mp_ubi').value;
	det=document.getElementById('mp_det').value;

	mp_cleanInput('mp_motiv');
	mp_cleanInput('mp_ubi');
	mp_cleanInput('mp_det');

	var request = $.ajax({
	url: "ajax/ajaxGridMovPer.php",
	type: "POST",
	data: {acciGrid:acciGrid,idDet:idDet,idMovPer:idMovPer,motiv:motiv,ubi:ubi,det:det},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxGridMovPer").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

}

function mp_cleanInput(id)
{
	document.getElementById(id).value="";
}

function mp_loadEvent(event)
{
	switch(event)
	{
		case 'saveMovPer':
			alert("Guardando movimiento de personal...!");
			submitForm('mp_frmMovPer','enviar1');
		break;

		default:
		break;
	}
}

function submitForm(valForm,valSend)
{
	document.forms[valForm].accion.value=valSend;
	document.forms[valForm].submit();
}

function oculNoti(id)
{
	if(document.getElementById(id))
	{
		document.getElementById(id).style.display="none";
	}
}

/* POPUP DIALOG 1  */

$(function() 
{
	$( "#dialog1" ).dialog({
	autoOpen: false,
	width:720,
	height:450,
	show: {
	effect: "blind",
	duration: 1000
	},
	hide: {
	effect: "explode",
	/*effect: "blind",*/
	duration: 1000
	}
	});
});


function mp_openPopup1(id)
{
	$('#dialog1').dialog('open');
	mp_ajaxDetMovPer(id);

	/*
	document.getElementById('mp_valiDetMov').removeAttribute("onclick");
	document.getElementById('mp_valiDetMov').setAttribute("onclick"," mp_jsonValidDetMov('"+id+"','1')");

	document.getElementById('mp_rechaDetMov').removeAttribute("onclick");
	document.getElementById('mp_rechaDetMov').setAttribute("onclick"," mp_jsonValidDetMov('"+id+"','2')");
	*/
}

/* POPUP DIALOG 2  */

$(function() 
{
	$( "#dialog2" ).dialog({
	autoOpen: false,
	width:480,
	height:250,
	show: {
	effect: "blind",
	duration: 1000
	},
	hide: {
	effect:"drop",
	/*effect: "explode",*/
	/*effect: "blind",*/
	duration: 1000
	}
	});
});

function mp_openPopup2(detId,aprobId)
{
	$('#dialog2').dialog('open');
	mp_ajaxValidAdmin(detId,aprobId);
}

/* POPUP DIALOG 3  */

$(function() 
{
	$( "#dialog3" ).dialog({
	autoOpen: false,
	width:620,
	height:380,
	show: {
	effect: "blind",
	duration: 1000
	},
	hide: {
	effect:"drop",
	/*effect: "explode",*/
	/*effect: "blind",*/
	duration: 1000
	}
	});
});

function mp_openPopup3(idMov)
{
	$('#dialog3').dialog('open');

	document.getElementById('mp_validAprob').removeAttribute("onclick");
	document.getElementById('mp_validAprob').setAttribute("onclick","mp_jsonAprobMov('"+idMov+"','valid')");

	document.getElementById('mp_cancelAprob').removeAttribute("onclick");
	document.getElementById('mp_cancelAprob').setAttribute("onclick","mp_jsonAprobMov('"+idMov+"','cancel')");
}

function mp_closePopup3()
{
	$('#dialog3').dialog('close');
}

/* POPUP DIALOG 4  */

$(function() 
{
	$( "#dialog4" ).dialog({
	autoOpen: false,
	width:620,
	height:380,
	show: {
	effect: "blind",
	duration: 1000
	},
	hide: {
	effect:"drop",
	/*effect: "explode",*/
	/*effect: "blind",*/
	duration: 1000
	}
	});
});

function mp_openPopup4(idMov)
{
	$('#dialog4').dialog('open');
	document.getElementById('mp_gastRendi').removeAttribute("onclick");
	document.getElementById('mp_gastRendi').setAttribute("onclick","mp_ajaxSaveRendiMov('"+idMov+"','add','')");
	mp_ajaxSaveRendiMov(idMov,'load','');
}

function mp_ajaxDetMovPer(id)
{

	idMov=id;

	var request = $.ajax({
	url: "ajax/ajaxDetMovPer.php",
	type: "POST",
	data: {idMov:idMov},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetMovPer").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function mp_jsonValidDetMov(idMov,idAprob)
{
	console.log(idMov);
	arrDetMov=new Array();
	var insCheck=document.mp_frmDetMovPer.idDetMov;
	tamCheck=insCheck.length;
	console.log(tamCheck);
	ind=0;

	for(i=0;i<tamCheck;i++)
	{
		if(insCheck[i].checked)
		{
			arrDetMov[ind++]=insCheck[i].value;
			console.log(arrDetMov[ind]);
		}
	}

	/* AJAX TYPE JSON */
	Data={};

	$.ajax({
        type:"POST",
        url: 'json/jsonValidDetMov.php',
        data:{arrDetMov:arrDetMov,idMov:idMov,idAprob:idAprob},
        dataType: 'json',
        success: function(data) {
            /*alert(data[0]+" "+data[1]+" tam:"+data[2]);*/
            var notiLoad=document.getElementById('notiLoad');
            notiLoad.innerHTML=data[1];
            setTimeout("oculNoti('success')",1800);
            mp_ajaxDetMovPer(idMov);
        }
    });
}

function mp_ajaxValidAdmin(detId,aprobId)
{

	var request = $.ajax({
	url: "ajax/ajaxValidAdmin.php",
	type: "POST",
	data: {detId:detId,aprobId:aprobId},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxValidAdmin").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

/* AJAX REUTILIZABLE DEL MODULO DE VACACIONES */

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

}


function mp_hourSali()
{
    // find the input fields and apply the time select to them.
    $('#sample21 input').ptTimeSelect({
        onBeforeShow: function(i){
            $('#sample21-data')
                .append(
                    'onBeforeShow(event) Input field: [' + 
                    $(i).attr('name') + 
                    "], value: [" +
                    $(i).val() +
                    "]<br>");
        },
        onClose: function(i) {
            $('#sample21-data')
                .append(
                    'onClose(event)Time selected: ' + 
                    $(i).val() + 
                    "<br>");
        }
    }); //end ptTimeSelect()
}


function mp_hourRetor()
{
    // find the input fields and apply the time select to them.
    $('#sample22 input').ptTimeSelect({
        onBeforeShow: function(i){
            $('#sample22-data')
                .append(
                    'onBeforeShow(event) Input field: [' + 
                    $(i).attr('name') + 
                    "], value: [" +
                    $(i).val() +
                    "]<br>");
        },
        onClose: function(i) {
            $('#sample22-data')
                .append(
                    'onClose(event)Time selected: ' + 
                    $(i).val() + 
                    "<br>");
        }
    }); //end ptTimeSelect()
}

function mp_jsonAprobMov(idMov,tare)
{
	//arrValid=new Array(new Array());
	arrValid=new Array();
	arrValid[0]=document.getElementById('mp_gerenAre').options[document.getElementById('mp_gerenAre').selectedIndex].value;
	arrValid[1]=document.getElementById('mp_pruebAre').options[document.getElementById('mp_pruebAre').selectedIndex].value;
	arrValid[2]=1;

	arrValid[3]=document.getElementById('mp_gerenFinan').options[document.getElementById('mp_gerenFinan').selectedIndex].value;
	arrValid[4]=document.getElementById('mp_pruebFinan').options[document.getElementById('mp_pruebFinan').selectedIndex].value;
	arrValid[5]=2;

	arrValid[6]=document.getElementById('mp_gerenGene').options[document.getElementById('mp_gerenGene').selectedIndex].value;
	arrValid[7]=document.getElementById('mp_pruebGene').options[document.getElementById('mp_pruebGene').selectedIndex].value;
	arrValid[8]=3;

	/*arrValid[0][0]=document.getElementById('mp_gerenAre').options[document.getElementById('mp_gerenAre').selectedIndex].value;
	console.log(arrValid[0][0]);*/

	if(tare=='confirm')
	{
		$("#ajaxBusMovPer").html( "<table width='100%' ><tr><td colspan='12' align='center' ><img src='images/loading2.gif' ></td></tr></table>" );
	}

	$.ajax({
        type:"POST",
        url: 'json/jsonAprobMov.php',
        data:{arrValid:arrValid,idMov:idMov,tare:tare},
        dataType: 'json',
        success: function(data) {
            /*alert(data[0]+" "+data[1]+" tam:"+data[2]);*/
            var notiLoad=document.getElementById('notiLoad');
            notiLoad.innerHTML=data[0];
            if(tare!='confirm')
            {
	            setTimeout("oculNoti('success')",1800);
	            setTimeout("mp_closePopup3();",1800);
        	}
        	 setTimeout("mp_ajaxBusMovPer()",1800);
        }
    });

}

function mp_ajaxBusMovPer()
{
	console.log("Buscando movimientos de trabajadores.....!");
	fechSali=document.getElementById('mp_fechMov').value;
	perId=document.getElementById('slcTrab').options[document.getElementById('slcTrab').selectedIndex].value;
	areId=document.getElementById('slcAre').options[document.getElementById('slcAre').selectedIndex].value;

	var request = $.ajax({
	url: "ajax/ajaxBusMovPer.php",
	type: "POST",
	data: {fechSali:fechSali,perId:perId,areId:areId},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxBusMovPer").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function mp_geneRepor()
{
	document.mp_frmRepor.submit();
}

function mp_ajaxSaveRendiMov(idMov,tare,idDet)
{
	console.log("Guardando rendicion de movimiento....!"+' id:'+idMov+' tare:'+tare);

	insMoneMov=document.getElementById('mp_moneRendi');

	desGas=document.getElementById('mp_desRendi').value;
	montGas=document.getElementById('mp_montRendi').value;
	moneGas=insMoneMov.options[insMoneMov.selectedIndex].value;

	console.log("des:"+desGas+" mont:"+montGas+" mone:"+moneGas);

	cc_limpNuevoText('mp_desRendi');
	cc_limpNuevoText('mp_montRendi');

	var request = $.ajax({
	url: "ajax/ajaxSaveRendiMov.php",
	type: "POST",
	data: {desGas:desGas,montGas:montGas,moneGas:moneGas,tare:tare,idMov:idMov,idDet:idDet},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxSaveRendiMov").html( msg );
	mp_ajaxBusMovPer();
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

}

function cc_limpNuevoText(id)
{
	document.getElementById(id).value="";
}




