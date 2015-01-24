<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='../libJquery/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='../libJquery/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='../libJquery/fullcalendar/lib/moment.min.js'></script>
<script src='../libJquery/fullcalendar/lib/jquery.min.js'></script>
<script src='../libJquery/fullcalendar/lib/jquery-ui.custom.min.js'></script>
<script src='../libJquery/fullcalendar/fullcalendar.min.js'></script>

<!-- -->

<script type="text/javascript" >

	
	function openWindow(pagina,tare,id,evenIni,evenFin) 
	{

	  param="json=ce_evenxId_traer";
      param=param+"&evenId="+id;
      $.getJSON('../json/ce_json.php?'+param,{format: "json"}, function(data) 
      {

	  var opciones="toolbar=no,"; 
	  opciones=opciones+"location=no,"; 
	  opciones=opciones+"directories=no,"; 
	  opciones=opciones+"status=no,";
	  opciones=opciones+"menubar=no,"; 
	  opciones=opciones+"scrollbars=no,";
	  opciones=opciones+"resizable=yes,"; 
	  opciones=opciones+"width=808,"; 
	  opciones=opciones+"height=550,"; 
	  opciones=opciones+"top=85,"; 
	  opciones=opciones+"left=280";
	  param="?ce_tare="+tare;
	  param=param+"&ce_evenId="+id;
	  param=param+"&ce_fechIni="+evenIni;
	  param=param+"&ce_fechFin="+evenFin;

	  if(tare!='editEven')
	  {
	  	  if(dateCompa(fechaHoyIni,fechaHoy)>=0)
		  {
		  	var popupEvent=window.open(pagina+param,"",opciones);
		  }
		  else
		  {
		  	alert("No es posible acceder a fechas anteriores...!");
		  }
	  }
	  else
	  {

		  var fecha=new Date();
		  var año = fecha.getFullYear();
		  var mes= fecha.getMonth()+1;
		  var dia=fecha.getDate();

		  var fecha2=data[0]['fechIni'];
		  arrFecha2=fecha2.split("-",3);
		  año2=arrFecha2[0];
		  mes2=arrFecha2[1];
		  dia2=arrFecha2[2]

		  fechaHoy=new Date(año,mes,dia);
		  fechaHoyIni=new Date(año2,mes2,dia2);
		  console.log(fechaHoyIni);
		  
		  if(dateCompa(fechaHoyIni,fechaHoy)>=0)
		  {
		  	detEven="";
		  	detEven="Nombre: "+data[0]['perEw']+"\n\n";
		  	detEven=detEven+"Descripcion: "+data[0]['desEven']+"\n\n";
		  	detEven=detEven+"Fecha: "+data[0]['fechIni']+" | "+data[0]['fechFin']+"\n\n";
		  	detEven=detEven+"Hora: "+data[0]['hourIni']+" | "+data[0]['hourFin'];
		  	
		  	if(confirm(detEven))
		  	{
		  		var popupEvent=window.open(pagina+param,"",opciones);
		  	}

		  }
		  else
		  {
		  	alert("No es posible acceder a fechas anteriores...!");
		  }

	  }

	  });

	}

	$(document).ready(function() 
	{
		loadCalendario();
	});

	function dateCompa(fecha1, fecha2) {

	  return fecha1.getTime() - fecha2.getTime();

	}

	function refreshCalendar()
	{
		console.log("Loading...!");
		location.href="ce_evenVisu.php";
	}

	function frmRefreshCalendar(id)
	{
		alert("id de evento: "+id);
	}

	function loadCalendario()
	{
		//document.getElementById('calendar').innerHTML="";
		//document.getElementById('calendar').removeAttribute('class');

		evenArr=[];
		evenArrVaca=[];

		/*
		evenArr=[
				{
					title: 'All Day Event',
					start: '2014-06-01'
				},
				{
					title: 'Long Event',
					start: '2014-06-07',
					end: '2014-06-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-16T16:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-06-12T10:30:00',
					end: '2014-06-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-06-12T12:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-06-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-06-28'
				}
			];
			*/

		param="json=ce_evenxId_capturar";

		$.getJSON('../json/ce_json.php?'+param,{format: "json"}, function(data) 
	    {
	    	console.log(data);
	    	for(i=0;i<data.length;i++)
	    	{
	    		if(data[i]['hourIni']=='00:00:00' && data[i]['hourFin']=='00:00:00' && data[i]['checkVaca']==1)
	    		{
	    			evenArrVaca.push({url:"Javascript:openWindow('ce_frmEven.php','editEven','"+data[i]['evenId']+"','','')",title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni'],end:data[i]['fechFin']});
	    		}
	    		else if( (data[i]['funId']==1 || data[i]['funId']==2) && data[i]['checkVaca']==0 )
	    		{
	    			evenArr.push({url:"Javascript:openWindow('ce_frmEven.php','editEven','"+data[i]['evenId']+"','','')",title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni']+"T"+data[i]['hourIni'],end:data[i]['fechFin']+"T"+data[i]['hourFin']});
	    		}
	    		else if(data[i]['funId']==3 && data[i]['checkVaca']==0)
	    		{
	    			evenArr.push({url:"Javascript:openWindow('ce_frmEven.php','editEven','"+data[i]['evenId']+"','','')",title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni']+"T"+data[i]['hourIni'],end:data[i]['fechFin']+"T"+data[i]['hourFin']});
	    		}
	    		else if(data[i]['checkVaca']==1)
	    		{
	    			evenArrVaca.push({url:"Javascript:openWindow('ce_frmEven.php','editEven','"+data[i]['evenId']+"','','')",title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni']+"T"+data[i]['hourIni'],end:data[i]['fechFin']+"T"+data[i]['hourFin']});
	    		}
	    		else
	    		{
	    			excep="Excepcion";
	    		}
	    	}

		var fecha=new Date();
		var año = fecha.getFullYear();
        var mes= fecha.getMonth()+1;
        var dia=fecha.getDate();
        fechaHoy=new Date(año,mes,dia);

        console.log(año+"-"+mes+"-"+dia);
		
		$('#calendar').fullCalendar({
			header: 
			{
				left: 'prev,next today',
				center: 'title',
				//right: 'month,agendaWeek,agendaDay,basicWeek,basicDay'
				right: 'month,agendaDay,agendaWeek'
			},
			defaultView:'agendaWeek',
			defaultDate: new Date(año,mes-1,dia),
			selectable: true,
			selectHelper: true,
			editable: false,
			select: function(start, end) {

				//var title = prompt('Event Title:');
				var title ="abc";
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					//$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}

				testFechIni=eventData.start._d.getFullYear()+"-"+(eventData.start._d.getUTCMonth()+1)+"-"+eventData.start._d.getUTCDate();
				testFechFin=eventData.end._d.getFullYear()+"-"+(eventData.end._d.getUTCMonth()+1)+"-"+eventData.end._d.getUTCDate();

				if(testFechIni==testFechFin)
				{
					evenFechFin=new Date(eventData.end._d.getTime());
				}
				else
				{
					evenFechFin=new Date(eventData.end._d.getTime()- (1 * 24 * 3600 * 1000));
				}

				evenIni=(eventData.start._d.getFullYear()+"-"+(eventData.start._d.getUTCMonth()+1)+"-"+eventData.start._d.getUTCDate());
				fechaHoyIni=new Date(eventData.start._d.getFullYear(),(eventData.start._d.getUTCMonth()+1),eventData.start._d.getUTCDate());
				evenFin=(evenFechFin.getFullYear()+"-"+(evenFechFin.getUTCMonth()+1)+"-"+evenFechFin.getUTCDate());
				calenFechas="fecha ini: "+evenIni;
				calenFechas=calenFechas+" \n fecha fin: "+evenFin;
				calenFechas=calenFechas+" \n hora ini:";
				calenFechas=calenFechas+" \n hora fin:";
				
				console.log(calenFechas);
				console.log(eventData.start._d.getUTCMonth());
				console.log(eventData.end._d.getUTCMonth());
				console.log(eventData);

				$('#calendar').fullCalendar('unselect');

				console.log("hoy:"+fechaHoy+" fech:"+evenIni);

				if(dateCompa(fechaHoyIni,fechaHoy)>=0)
				{
					openWindow("ce_frmEven.php",'','',evenIni,evenFin);
				}
				else
				{
					alert("Imposible acceder a fechas anteriores...!");
				}
			},
			/*
			eventDrop: function(event, delta, revertFunc) {

		        alert(event.title + " was dropped on " + event.start.format());

		        if (!confirm("Are you sure about this change?")) {
		            //revertFunc();
		            console.log("ningun cambio efectuado");
		        }

	    	},
	    	*/
	    	eventSources:
			[
				{
					events:evenArr,
					color: '#4285F4',
		            textColor: 'white'
				},
				{
					events:evenArrVaca, 
					//color: '#FDD20A',
					backgroundColor: '#FDD20A',
		            textColor: 'black',
		            className: 'ce_casiEven'				
		        }
			]
		});
		});
	}

</script>

<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		width: 900px;
		margin: 40px auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

	<!-- POPUP CALENDARIO -->

</body>
</html>
