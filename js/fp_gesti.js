/* fp_flujProbIn */

	$(function() 
	{
		$( "#fp_cotiAct" ).dialog({
		autoOpen: false,
		width:920,
		height:400,
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

	function fp_cotiAct_visu()
	{
		$('#fp_cotiAct').dialog('open');
		fp_cotiAct_ajax();
	}

	function fp_repFlujProb_clean()
	{
		document.getElementById('fp_repFlujProb').src="";
	}

	function fp_cotiAct_ajax()
	{

		insVendId=document.getElementById('vendId');
		valVendId=insVendId.options[insVendId.selectedIndex].value;

		var request = $.ajax({
		url: "ajax/fp_cotiAct_ajax.php",
		type: "POST",
		data: {valVendId:valVendId},
		dataType: "html"
		});
		
		request.done(function(msg) {
		//document.getElementById('scInventario').value='';
		//var acontenidoAjax = a('#loading').html('');
		$("#fp_cotiAct_ajax").html( msg );
		});
		
		request.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
		});
	}

/* fp_cotiAct */

	$(function() 
	{
		$( "#fp_conFian" ).dialog({
		autoOpen: false,
		width:400,
		height:200,
		show: {
		effect: "blind",
		duration: 1000
		},
		hide: {
		//effect: "explode",
		//effect: "blind",
		duration:0 
		}
		});
	});

	function fp_cotiAct_gene()
	{
		$('#fp_conFian').dialog('close');
		$('#fp_cotiAct').dialog('close');

		//-----------------------------------------------
		insCotiId=document.fp_cotiAct_frm.cotiId;
		tamCotiId=insCotiId.length;
		checkCotiId=0;
		var arrCotiId=new Array();
		console.log(tamCotiId);
		for(i=0;i<tamCotiId;i++)
		{
			if(insCotiId[i].checked)
			{
				arrCotiId[checkCotiId]=insCotiId[i].value;
				insCotiId[i].checked=false;
				checkCotiId++;
			}
		}
		//-------------------------------------------------
		insVendId=document.getElementById('vendId');
		valVendId=insVendId.options[insVendId.selectedIndex].text;

		//--------------------------------------------------------------
		document.getElementById('fp_repFlujProb').src="reporte/fp_repFlujProb.php?arrCotiId="+arrCotiId+"&vend="+valVendId;
	}

	function fp_cotiAct_conf()
	{
		$('#fp_conFian').dialog('close');
		$('#fp_conFian').dialog('open');
	}


/* fp_conFian */

	function fp_conFian_confir()
	{
		$('#fp_conFian').dialog('close');
		fp_conFian_json();
	}

	function fp_conFian_json()
	{
		//--------------------------------------------
		insCotiId=document.fp_cotiAct_frm.cotiId;
		tamCotiId=insCotiId.length;
		checkCotiId=0;
		var arrCotiId=new Array();
		console.log(tamCotiId);
		for(i=0;i<tamCotiId;i++)
		{
			if(insCotiId[i].checked)
			{
				arrCotiId[checkCotiId]=insCotiId[i].value;
				insCotiId[i].checked=false;
				checkCotiId++;
			}
		}

		//console.log(checkCotiId);
		console.log(arrCotiId);
		//insCotiId.length=0;

		//-------------------------------------------
		insTipFian=document.fp_conFian_frm.tipFian;
		tamTipFian=insTipFian.length;
		checkTipFian=0;
		var arrTipFian=new Array();
		console.log(tamTipFian);
		for(i=0;i<tamTipFian;i++)
		{
			if(insTipFian[i].checked)
			{
				arrTipFian[checkTipFian]=insTipFian[i].value;
				insTipFian[i].checked=false;
				checkTipFian++;
			}
		}

		console.log(arrTipFian);

		//--------------------------------------------------

		
		fianAde=document.getElementById('fianAde').value;
		fianFiel=10;
		

		//-------------------------------------------------
		$.ajax({
	        type:"POST",
	        url: 'json/fp_conFian_json.php',
	        data:{arrCotiId:arrCotiId,arrTipFian:arrTipFian,fianAde:fianAde,fianFiel:fianFiel},
	        dataType: 'json',
	        success: function(data) 
	        {
	        	if(data[0]>0)
	        	{
	        		alert('Filas afectadas...!');
	        		fp_cotiAct_ajax();
	        	}
	        	else
	        	{
	        		alert('No filas afectadas...!');
	        		fp_cotiAct_ajax();
	        	}
	        }
    	});
	}


