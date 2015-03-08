<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8" ></meta>

		<script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC08f97Ey_2y88PCeQ-ogRhJ4c0XPNKaP8"></script>

		<link rel="stylesheet" type="text/css" href="styles/decorador.css">

		<style type="text/css">
		
			html, body, #map-canvas { height: 90%; margin: 30px; padding: 0;}

			#content{ width:auto; }
			
		</style>

		<script type="text/javascript" >

			var puntos = [];
			var marker;

			function iniMapAdm()
			{

				//Iniciar propiedades de mapa
				
					var myLatlng = new google.maps.LatLng(-12.120984, -76.996237);
					//var myLatlng = new google.maps.LatLng(0, 0);
					var mapOptions = {
					zoom: 12,
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					
				//Cadena con mensaje de referencia
				var contentString = '<div id="content">'+
								  '<div id="siteNotice">'+
									'<p>Oficiona ELECTROWERKE SAC</p>'
								  '</div>'+
								  '</div>';
								  
				var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });

				
				//renderizar mapa en body
				
					map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
					
					var marker = new google.maps.Marker({
					position: map.getCenter(),
					map: map,
					title: 'Click to zoom'
				  });
					  
				//renderizar referencia de ubicacion
				
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map,marker);
					  });
			}

			google.maps.event.addDomListener(window, 'load', iniMapAdm);

		</script>

	<head>
	<body>

		<fieldset>
			<legend>Detalle de Ruta</legend>

			<table class="gd_detRut" >
				<thead>
					<tr>
						<td align="center" >Item</td>
						<td>Documentos</td>
						<td>Gestion</td>
						<td>Lugar</td>
						<td>Latitud</td>
						<td>Longitud</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>Documentos</td>
						<td>Gestion</td>
						<td>Lugar</td>
						<td>Latitud</td>
						<td>Longitud</td>
					</tr>
				</tbody>
			</table>

		</fieldset>

		<div id="map-canvas" ></div>

	</body>

</html>