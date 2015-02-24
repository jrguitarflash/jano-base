<!-- Iniciando libreria graficos -->

<script type="text/javascript" src="libJquery/jplot/jquery.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/plugins/jqplot.logAxisRenderer.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="libJquery/jplot/plugins/jqplot.barRenderer.min.js"></script>
<link rel="stylesheet" type="text/css" hrf="libJquery/jplot/jquery.jqplot.min.css" />

<!-- iniciando grafico -->

<script type="text/javascript" >

$(document).ready(function()
{  

	line3=[];

	
    /*
    var line3 = [['Cup Holder Pinion Bob', 7], ['Generic Fog Lamp Marketing Gimmick', 9],
    ['HDTV Receiver', 15], ['8 Track Control Module', 12],
    ['SSPFM (Sealed Sludge Pump Fourier Modulator)', 3],
    ['Transcender/Spice Rack', 6], ['Hair Spray Rear View Mirror Danger Indicator', 18]];
    */
    

	console.log(line3);
    

    //vars
    json="nc_grafTip";
    fechIni=document.getElementById('nc_fechIni').value;
    fechFin=document.getElementById('nc_fechFin').value;
    tipObs=document.getElementById('nc_TipPorce').value;

    //params
    param="json="+json;
    param+="&nc_fechIni="+fechIni;
    param+="&nc_fechFin="+fechFin;
    param+="&nc_tipObs="+tipObs;

    //peticion json
    $.getJSON('json/nc_json.php?'+param,{format: "json"}, function(data) 
	{
		//data
		console.log(data);
		arrTemp=new Array();

		//iterar data
		for(i=0;i<data.length;i++)
		{
			arrTemp=new Array();
			porce=data[i]['obsPor'];
			arrTemp[0]=data[i]['obsDes'];
			arrTemp[1]=parseFloat(porce);
			line3.push(arrTemp);
		}

		console.log(line3);

		//grafico segun parametros
	    var plot3 = $.jqplot('chart3', [line3], {
	      series:[{renderer:$.jqplot.BarRenderer}],
	      axes: {
	        xaxis: {
	          renderer: $.jqplot.CategoryAxisRenderer,
	          label: 'Warranty Concern',
	          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
	          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
	          tickOptions: {
	              angle: -30,
	              fontFamily: 'Courier New',
	              fontSize: '9pt'
	          }
	           
	        },
	        yaxis: {
	          label: 'Occurance',
	          labelRenderer: $.jqplot.CanvasAxisLabelRenderer
	        }
	      }
	    });

	});

});
 

</script>

<!-- HTML BODY -->

<h1>Graficos</h1>

<div id='chart3' ></div>

<?php print "<input type='hidden' id='nc_fechIni' value='".$_POST['nc_fechIni']."' >"; ?>
<?php print "<input type='hidden' id='nc_fechFin' value='".$_POST['nc_fechFin']."' >"; ?>
<?php print "<input type='hidden' id='nc_TipPorce' value='".$_POST['nc_TipPorce']."' >"; ?>

<!-- HTML POPUP -->