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

		cc_flCotiAdju();
		cc_prodCatalog();
		cc_empProv();
		cc_empProv2();
		Calendario3('ocFechCli');

	}
	else if(modo[1]=="2")
	{
		cc_flCotiAdju2();
	}
	else
	{
		console.log('inicio vacio');
	}

}

$(function() {
$( "#tabs" ).tabs();
});

$(function() {
	$( "#dialog1" ).dialog({
	autoOpen: false,
	width:700,
	height:620,
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

function cc_openEditFl(id)
{
	param="idDet="+id;

	$.getJSON('json/jsonGetDetCoti.php?'+param,{format: "json"}, function(data) 
	{
		console.log("producto nombre:"+data[0]['prodNom']);
		console.log("producto id:"+data[0]['producto_id']);

		document.getElementById('txtProd').value=data[0]['prodNom'];
		document.getElementById('txtProdId').value=data[0]['producto_id'];
		document.getElementById('txtCant').value=data[0]['cant'];
		document.getElementById('txtPreUni').value=data[0]['preUni'];
		document.getElementById('txtProve').value=data[0]['proveNom'];
		document.getElementById('txtProveId').value=data[0]['proveedorId'];
		document.getElementById('txtPlazo').value=data[0]['plazo'];
		document.getElementById('desProdServ').value=data[0]['pro_descripcion'];

		cc_escoItemCombo('tipClasif',data[0]['prodClasiId']);
		cc_escoItemCombo('txtMone',data[0]['moneda_id']);

		cc_mosCompProd('txtProd');

	});

	document.getElementById('acciEdit').removeAttribute("onclick");
	document.getElementById('acciEdit').setAttribute("onclick","cc_ajaxGestDetFl('"+id+"','edit')");
	$( "#dialog1" ).dialog( "open" );
}

function cc_escoItemCombo(id,val)
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

function cc_openNuevoFl(id)
{

	cc_limpNuevoText('txtProd');
	cc_limpNuevoText('txtProdId');
	cc_limpNuevoText('txtCant');
	cc_limpNuevoText('txtPreUni');
	cc_limpNuevoText('txtProve');
	cc_limpNuevoText('txtProveId');
	cc_limpNuevoText('txtPlazo');
	cc_limpNuevoText('desProdServ');

	cc_limpNuevoSpan('spnMode');
	cc_limpNuevoSpan('spnMarca');

	document.getElementById('acciEdit').removeAttribute("onclick");
	document.getElementById('acciEdit').setAttribute("onclick","cc_ajaxGestDetFl('','add')");
	$( "#dialog1" ).dialog( "open" );
}

function cc_closeEditFl()
{
	$( "#dialog1" ).dialog( "close" );
}

function cc_limpNuevoText(id)
{
	document.getElementById(id).value="";
}

function cc_limpNuevoSpan(id)
{
	document.getElementById(id).innerHTML="";
}

function cc_geneOc(oc)
{
	switch(oc)
	{

		case 'ocNac':
			alert("Generando oc nacional");
			document.frmCosPro.method="post";
			document.frmCosPro.accion.value="enviar";
			document.frmCosPro.submit();
		break;

		case 'ocInt':
			alert("Generando oc internacional");
			//event.preventDefault()
			//event.stopPropagation();
			//event.isDefaultPrevented();
			document.frmCosPro.method="post";
			document.frmCosPro.accion.value="enviar2";
			document.frmCosPro.submit();
		break;

		case 'ocServ':
			alert("Generando oc servicio");
		break;

		default:
		break;
	}
}


function cc_flCotiAdju()
{
	availableTags=new Array();
	param="fl=''";
	$.getJSON('json/jsonFlCotiAdju.php?'+param,{format: "json"}, function(data) 
	{
	/*
	var availableTags = [
	"ActionScript",
	"AppleScript",
	"Asp",
	"BASIC",
	"C",
	"C++",
	"Clojure",
	"COBOL",
	"ColdFusion",
	"Erlang",
	"Fortran",
	"Groovy",
	"Haskell",
	"Java",
	"JavaScript",
	"Lisp",
	"Perl",
	"PHP",
	"Python",
	"Ruby",
	"Scala",
	"Scheme",
	"jj"
	];
	*/

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['cot_nro']);
		availableTags[i]=data[i]['cot_nro'];
	}

	$( "#cotiFl" ).autocomplete({
	source: availableTags
	});

	});	
}

function cc_flCotiAdju2()
{
	availableTags=new Array();
	param="fl=''";
	$.getJSON('json/jsonFlCotiCentCost.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['cot_nro']);
		availableTags[i]=data[i]['cot_nro'];
	}

	$( "#cotiFl" ).autocomplete({
	source: availableTags
	});

	});	
}

function cc_limpCampDina(id,id2)
{
	document.getElementById(id).value='';
	document.getElementById(id2).value='';
}

function cc_limpCampDinaProd(id,id2)
{
	document.getElementById(id).value='';
	document.getElementById(id2).value='';
	document.getElementById('spnMode').innerHTML='';
	document.getElementById('spnMarca').innerHTML='';
}


function obj(){
    obj=new Object();
    this.add=function(key,value){
        obj[key]=value;
    }
    this.obj=obj;
}

function cc_prodCatalog()
{

	cc_limpCampDinaProd('txtProd','txtProdId');

	//availableTags2=new Object();
	availableTags2=[];
	//availableTags2=new Array();
	//availableTags2=new obj();
	//var availableTags2 = {} 

	insClasif=document.getElementById('tipClasif');
	clasif=insClasif.options[insClasif.selectedIndex].value;

	param="tipClasi="+clasif;

	$.getJSON('json/jsonProdCatalog.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['prod_nombre']);

		//availableTags2[i]['key']=data[i]['producto_id'];
		//availableTags2[i]['value']=data[i]['prod_nombre'];
		
		//availableTags2.add(data[i]['producto_id'],data[i]['prod_nombre']);
		availableTags2.push({key:data[i]['producto_id'],value:data[i]['prod_nombre']});

		//availableTags2[i]['key']=data[i]['producto_id'];
		//availableTags2[i]['value']=data[i]['prod_nombre'];

	}

	console.log(availableTags2);

	/*
	var availableTags = [
	{key: "1",value: "NAME 1"},{key: "2",value: "NAME 2"},{key: "3",value: "NAME 3"},{key: "4",value: "NAME 4"},{key: "5",value: "NAME 5"}
	 ];
	 */

	$( "#txtProd" ).autocomplete({
	//source: availableTags2

      minLength: 0,
      source: availableTags2,
      focus: function( event, ui ) {
        $( "#txtProd" ).val( ui.item.value );
        return false;
      },
      select: function( event, ui ) {
        $( "#txtProd" ).val( ui.item.value );
        $( "#txtProdId" ).val( ui.item.key );
 
        return false;
      } 
	  });


	});
}


function cc_empProv()
{

	//availableTags3=new Array();
	availableTags3=[];

	param="prod=''";
	$.getJSON('json/jsonEmpProv.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['emp_nombre']);
		//availableTags3[i]=data[i]['emp_nombre'];

		availableTags3.push({key:data[i]['empresa_id'],value:data[i]['emp_nombre']});
	}

	$( "#txtProve" ).autocomplete({
	//source: availableTags3

	  minLength: 0,
	  source: availableTags3,
	  focus: function( event, ui ) {
	    $( "#txtProve" ).val( ui.item.value );
	    return false;
	  },
	  select: function( event, ui ) {
	    $( "#txtProve" ).val( ui.item.value );
	    $( "#txtProveId" ).val( ui.item.key );

	    return false;
	  } 

	});

	});	

}

function cc_empProv2()
{

	//availableTags3=new Array();
	availableTags3=[];

	param="prod=''";
	$.getJSON('json/jsonEmpProv.php?'+param,{format: "json"}, function(data) 
	{

	for(i=0;i<data.length;i++)
	{
		console.log(data[i]['emp_nombre']);
		//availableTags3[i]=data[i]['emp_nombre'];

		availableTags3.push({key:data[i]['empresa_id'],value:data[i]['emp_nombre']});
	}

	$( "#txtProve2" ).autocomplete({
	//source: availableTags3

	  minLength: 0,
	  source: availableTags3,
	  focus: function( event, ui ) {
	    $( "#txtProve2" ).val( ui.item.value );
	    return false;
	  },
	  select: function( event, ui ) {
	    $( "#txtProve2" ).val( ui.item.value );
	    $( "#txtProveId2" ).val( ui.item.key );

	    return false;
	  } 

	});

	});	

}

function cc_jsonGeneFl()
{
	cc_ajaxDetFlNad();
	valFl=document.getElementById('cotiFl').value;
	arrValFl=new Array();
	arrValFl=valFl.split('-');
	param="valFl="+valFl;
	$.getJSON('json/jsonGeneFl.php?'+param,{format: "json"}, function(data) 
	{
		if(data.length>0 && valFl.length>0 && arrValFl[0]=='FL')
		{
			document.getElementById('txaCli').value=data[0]['emp_nombre'];
			document.getElementById('txaProye').value=data[0]['proy_nombre'];
		}
		else
		{
			document.getElementById('txaCli').value='';
			document.getElementById('txaProye').value='';
			document.getElementById('txtOcCli').value='';
			document.getElementById('ocFechCli').value='';
			document.getElementById('txtProve2').value='';
			document.getElementById('txtProveId2').value='';
		}
	});
}

function cc_ajaxDetFl()
{

	$("#ajaxDetFl").html( "<table width='100%' ><tr><td colspan='12' align='center' ><img src='images/loading2.gif' ></td></tr></table>" );

	valFl=document.getElementById('cotiFl').value;
	arrValFl=new Array();
	arrValFl=valFl.split('-');

	if(valFl.length>0 && arrValFl[0]=='FL')
	{
		valFl=valFl;
	}
	else
	{
		valFl=0;
	}

	var request = $.ajax({
	url: "ajax/ajaxDetFl.php",
	type: "POST",
	data: {valFl:valFl},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cc_ajaxDetFlNad()
{	
	valFl=0;

	var request = $.ajax({
	url: "ajax/ajaxDetFl.php",
	type: "POST",
	data: {valFl:valFl},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cc_ajaxGestDetFl(idDet,acciGrid)
{
	console.log("accion:"+acciGrid);
	console.log("id:"+idDet);

	insClasiId=document.getElementById('tipClasif');
	clasiId=insClasiId.options[insClasiId.selectedIndex].value;

	insMoneId=document.getElementById('txtMone');
	moneId=insMoneId.options[insMoneId.selectedIndex].value;

	idProd=document.getElementById('txtProdId').value;
	cant=document.getElementById('txtCant').value;
	preUni=document.getElementById('txtPreUni').value;
	proveId=document.getElementById('txtProveId').value;
	plazo=document.getElementById('txtPlazo').value;
	desProdServ=document.getElementById('desProdServ').value;

	var request = $.ajax({
	url: "ajax/ajaxGestDetFl.php",
	type: "POST",
	data: {acciGrid:acciGrid,idDet:idDet,clasiId:clasiId,idProd:idProd,cant:cant,moneId:moneId,preUni:preUni,proveId:proveId,plazo:plazo,desProdServ:desProdServ},
	dataType: "html"
	});
	
	request.done(function(msg) {
	//document.getElementById('scInventario').value='';
	//var acontenidoAjax = a('#loading').html('');
	$("#ajaxDetFl").html( msg );
	});
	
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});
}

function cc_mosComp(id)
{
	document.getElementById(id).title=document.getElementById(id).value;
}

function cc_mosCompProd(id)
{
	document.getElementById(id).title=document.getElementById(id).value;
	cc_getMarModel();
}

function cc_getMarModel()
{

	prodId=document.getElementById('txtProdId').value;
	param="prodId="+prodId;

	$.getJSON('json/jsonGetMarModel.php?'+param,{format: "json"}, function(data) 
	{
		console.log('marca:'+data[0]);
		console.log('modelo:'+data[1]);

		document.getElementById('spnMode').innerHTML=data[1];
		document.getElementById('spnMarca').innerHTML=data[0];

	});
}

function cc_filCenCost()
{
	document.frmCosCread.method="post";
	document.frmCosCread.submit();
}