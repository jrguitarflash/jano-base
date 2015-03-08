
//Utilidades JS

	/*--------------------------------------------------------------*/
		// np_
	/*--------------------------------------------------------------*/

		// iniciar campo select x id
		function np_iniSelect(val,id)
		{
			var insId=document.getElementById(id);
			for(i=0;i<insId.length;i++)
			{
				if(insId.options[i].value==val)
				{
					insId.options[i].selected=true;
				}
			}
		}

		// iniciar campo select x name
		function np_iniSelectMul(data,id)
		{
			var insId=document.getElementById(id);
			for(j=0;j<data.length;j++)
			{
				for(i=0;i<insId.length;i++)
				{
					if(insId.options[i].value==data[j])
					{
						insId.options[i].selected=true;
					}
				}
			}
		}

		// generar nueva vista con parametros para reporte
		function np_geneRep(url,param)
		{
			//parametros
			url=url;
			param=param;

			//url de parametros
			dire=url+"?"+param;

			//peticion de enlace
			ins=document.createElement('a');
			ins.target="_blank";
			ins.href=dire;
			document.body.appendChild(ins);
			ins.click();
		}

		// validar email
		function np_valiEmail(mail)
		{
	    	return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
		}

	/*----------------[*]-------------------------------------------*/

	/*--------------------------------------------------------------*/
		// kd_
	/*--------------------------------------------------------------*/

		// obtener valor de select
		function kd_obteValComb(id)
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

	/*--------------------[*]---------------------------------------*/

	/*--------------------------------------------------------------*/
		// gd_
	/*--------------------------------------------------------------*/

		// direccionar pagina sin parametros
		function gd_direPag(url)
		{
			location.href=url;
		}

		// direcciona vista con parametros
		function gd_direPagParam(url,param)
		{
			location.href=url+"?"+param;
		}

		// iterar paginas en campo select
		function gd_fillSelect(id,tamVal,pag)
		{
			insId=document.getElementById(id);
			insId.innerHTML="";

			tamVal=gd_itePag(tamVal,pag);
			
			for(i=1;i<=tamVal;i++)
			{
				option=document.createElement('option');
				option.text=i;
				option.value=i;
				insId.add(option,null);
			}
		}

		// tamaño valido de paginas
		function gd_itePag(tamVal,pag)
		{
			val=parseInt(tamVal/pag);

			if(val<(tamVal/pag))
			{
				tamVal=val+1;
			}
			else
			{
				tamVal=val;
			}

			return tamVal;
		}

		// mostrar total de paginas
		function gd_totPag(id,tamVal,pag)
		{
			document.getElementById(id).innerHTML=gd_itePag(tamVal,pag);
		}

		// mostrar total en el body
		function gd_totRow(id,tot)
		{
			document.getElementById(id).innerHTML=tot;
		}

	   // elegir peticion crear y editar json
	   function gd_petiJson_ele(id,petCread,petEdit) 
	   {
	   		if(id==0)
	   		{
	   			json=petCread;
	   		}
	   		else
	   		{
	   			json=petEdit;
	   		}

	   		return json;
	   }

	   // enviar valor inner a id
	   function gd_enviInner(id,val)
	   {
	   		document.getElementById(id).innerHTML=val;
	   }

	   // enviar valor value a input text
	   function gd_enviValText(id,val)
	   {
	   		document.getElementById(id).value=val;
	   }

	   // capturar data de checkbox
	   function gd_checkData(insFrm)
	   {
	   		insForm=insFrm;
			//console.log(insForm.length);
			data=new Array();
			ind=0;

			for(i=0;i<insForm.length;i++)
			{
				if(insForm[i].checked)
				{
					data[ind++]=insForm[i].value;
					insForm[i].checked=false;
				}
			}

			return data;
	   }

	/*-----------------------[*]------------------------------------*/

	/*--------------------------------------------------------------*/
		// scc_
	/*--------------------------------------------------------------*/

	   // iniciar data autocomplete
	   function scc_dataComp_ini(jsonFlag,jsonPeti,valId,valDes)
	   {

	   		availableTags2=[];

			param="json="+jsonFlag;
			$.getJSON('json/'+jsonPeti+'.php?'+param,{format: "json"}, function(data) 
			{
				 for(i=0;i<data.length;i++)
				 {
					availableTags2.push({key:data[i][valId],value:data[i][valDes]});
				 }

				 console.log(availableTags2);

				 $( "#"+valDes ).autocomplete
				 ({
					 //source: availableTags2

				     minLength: 0,
				     source: availableTags2,
				     focus: function( event, ui ) {
				     $( "#"+valDes ).val( ui.item.value );
				        return false;
				     },

				     select: function( event, ui ) {
				     $( "#"+valDes ).val( ui.item.value );
				     $( "#"+valId ).val( ui.item.key );
				     	return false;
				     } 
				});
			});
	   }

	/*------------------------[*]-----------------------------------*/

	/*--------------------------------------------------------------*/
		// nc_
	/*--------------------------------------------------------------*/

	   // obtener multi select
	   function nc_multiSelect_obte(id)
	   {
	   		insSelect=document.getElementById(id);
	   		valCad="";
	   		ind=0;
	   		for(i=0;i<insSelect.length;i++)
	   		{
	   			if(insSelect[i].selected)
	   			{
		   			if(ind==0)
		   			{
		   				valCad=valCad+""+insSelect[i].value;
		   			}
		   			else
		   			{
		   				valCad=valCad+"|"+insSelect[i].value;
		   			}
		   			ind++;
	   			}
	   		}
	   		return valCad;
	   }

	   // reiniciar seleccion de select
	   function nc_select_reini(id)
	   {
	   		insSelect=document.getElementById(id);

	   		for(i=0;i<insSelect.length;i++)
	   		{
	   			insSelect.options[i].selected=false;
	   		}
	   }

	/*-------------------------[*]----------------------------------*/

	/*--------------------------------------------------------------*/
		// cc_
	/*--------------------------------------------------------------*/

		// obtener estado check
		function cc_estaCheck_obte(id)
		{
			insId=document.getElementById(id);
			flag=0;
			if(insId.checked)
			{
				flag=1;
			}
			return flag;
		}

	/*-------------------------[*]----------------------------------*/

	/*--------------------------------------------------------------*/
		// finan_
	/*--------------------------------------------------------------*/

		// elegir peticion crear y editar json
		function gd_peti2Json_ele(id,petCread,petEdit) 
	    {
	   		if(id==0 || id=="")
	   		{
	   			json=petCread;
	   		}
	   		else
	   		{
	   			json=petEdit;
	   		}

	   		return json;
	    }


	/*--------------------------------------------------------------*/
