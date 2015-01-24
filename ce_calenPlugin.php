<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='libJquery/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='libJquery/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='libJquery/fullcalendar/lib/moment.min.js'></script>
<script src='libJquery/fullcalendar/lib/jquery.min.js'></script>
<script src='libJquery/fullcalendar/lib/jquery-ui.custom.min.js'></script>
<script src='libJquery/fullcalendar/fullcalendar.min.js'></script>
<script type="text/javascript" src='libJquery/fullcalendar/jquery.qtip.js' ></script>
<link rel="stylesheet" type="text/css" href="libJquery/fullcalendar/jquery.qtip.css">
<!--<script src='libJquery/fullcalendar/qtip.js'></script>-->

<style type="text/css">
	.name
	{
		font-weight: bolder;
	}
</style>

<script>

	$(document).ready(function() 
	{
	
		eventsArr=[
				{
					title: 'All Day Event',
					start: '2014-06-17T14:00:00',
					end: '2014-06-17T15:30:00'
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
					title: "Meeting",
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
					url: 'Javascript:alert("Detalle de evento");',
					start: '2014-06-28'
				}
			];

	eventsArrComer=[];
	eventsArrTecni=[];
	eventsArrVaca=[];

	param="json=ce_evenPer_capturar";

    $.getJSON('json/ce_json.php?'+param,{format: "json"}, function(data) 
    {
    	for(i=0;i<data.length;i++)
    	{
    		if(data[i]['funId']==1 && data[i]['checkVaca']==0)
    		{
    			eventsArrComer.push({title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni']+"T"+data[i]['hourIni'],end:data[i]['fechFin']+"T"+data[i]['hourFin'],description:"abc"});
    		}
    		else if(data[i]['funId']==3 && data[i]['checkVaca']==0)
    		{
    			eventsArrTecni.push({title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni']+"T"+data[i]['hourIni'],end:data[i]['fechFin']+"T"+data[i]['hourFin']});
    		}
    		else if((data[i]['funId']==3 || data[i]['funId']==1) && data[i]['checkVaca']==1)
    		{
    			//eventsArrVaca.push({title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni']+"T"+data[i]['hourIni'],end:data[i]['fechFin']+"T"+data[i]['hourFin']});
    			eventsArrVaca.push({title:data[i]['perEw']+",\n"+data[i]['desEven'],start:data[i]['fechIni'],end:data[i]['fechFin']});

    		}
    		else
    		{
    			excep="Excepcion";
    		}
    	}

    	var fecha=new Date();
		var año = fecha.getFullYear();
        var mes= fecha.getMonth();
        var dia=fecha.getDate();

    	$('#calendar').fullCalendar(
		{
			dayClick: function(date, jsEvent, view) 
			{

	        //alert('Clicked on: ' + date.format());

	        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

	        //alert('Current view: ' + view.name);

	        // change the day's background color just for fun
	        //$(this).css('background-color', 'red');

	        $('#calendar').fullCalendar('changeView','basicDay');
	        $('#calendar').fullCalendar( 'gotoDate', date );

		    },
			header: {
				left: 'prev,next today',
				center: 'title',
				//right: 'month,agendaWeek,agendaDay'
				right: 'month,basicWeek,basicDay'
			},
			defaultView:'month',
			defaultDate: new Date(año,mes,dia),
			editable: false,
			eventSources:
			[
				{
					events:eventsArrComer,
		            color: '#4285F4',
		            textColor: 'white',
		            eventRender: function(event, element) {
				        element.qtip({
				            content: event.description
				        });
				    }
				},
				{
					events:eventsArrTecni,
		            color: '#E77A27',
		            textColor: 'white'
				},
				{
					events:eventsArrVaca,
		            color: '#FDD20A',
		            textColor: 'black'
				}
			],
		});

    });

		
	});

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

</body>
</html>
