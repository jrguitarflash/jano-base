$(function() {
$( "#tabs" ).tabs();
});

$(function() {
$( "#dialog1" ).dialog({
autoOpen: false,
width:540,
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

function nuevaFactura() 
{
	$( "#dialog1").dialog( "open" );
}