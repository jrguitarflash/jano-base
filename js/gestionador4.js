window.onload=function() 
{
	Calendario3('fechIni');
	Calendario3('fechFin');
}

function clearFechas()
{
	document.getElementById('fechIni').value="";
	document.getElementById('fechFin').value="";
}

function getBusCuenxPag(opci)
{
	document.form1.opci.value=opci;
	document.form1.method='post';
	document.form1.submit();
}

function geneExcelCuenxPag(id) 
{
	location.target="_blank";
	location.href="reporteExcel/reporte_cuenxpag.php?id="+id;	
}

function geneExcelGroupxPag(tare,fechIn,fechFn) 
{
	location.target="_blank";
	location.href="reporteExcel/reporte_cuenxpag.php?tare="+tare+"&fech1="+fechIn+"&fech2="+fechFn;	
}