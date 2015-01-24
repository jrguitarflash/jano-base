/* [LOAD] */

	window.onload=function()
	{
		if(document.getElementById('ce_calenEven'))
		{
			document.getElementById('ce_calenPlugin').src="ce_calenPlugin.php";
		}
	}

	function openWindow(pagina,tare,id) 
	{

	  var opciones="toolbar=no,"; 
	  opciones=opciones+"location=no,"; 
	  opciones=opciones+"directories=no,"; 
	  opciones=opciones+"status=no,";
	  opciones=opciones+"menubar=no,"; 
	  opciones=opciones+"scrollbars=yes,";
	  opciones=opciones+"resizable=yes,"; 
	  opciones=opciones+"width=808,"; 
	  opciones=opciones+"height=550,"; 
	  opciones=opciones+"top=85,"; 
	  opciones=opciones+"left=280";
	  param="?ce_tare="+tare;
	  param=param+"&ce_evenId="+id;
	  var popupEvent=window.open(pagina+param,"",opciones);
	}