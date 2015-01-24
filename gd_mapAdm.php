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

				//agregar una nueva marca
							
					google.maps.event.addListener(map, 'click', function(event) 
					{
						addMark(event.latLng);
					});
				
				//borrar todas las marcas añadidas
				
					var b = document.getElementById("borrar");
					b.addEventListener("click",function()
					{	
						// Recorrempos el array de puntos y los borramos
						for (p in puntos) {
						puntos[p].setMap(null);
						}	
					});
				
				//borrar una marca
				
					/*google.maps.event.addListener(marker,"rightclick",function(event)
					{	
						// Recorrempos el array de puntos y los borramos
						console.log(event.latLng);
						console.log(puntos);
						marker.setMap(null);
					});*/
				
				//obtener posicion de marca añadida
				
					google.maps.event.addListener(map, 'click', function(event) 
					{
						document.getElementById("posicion").innerHTML = event.latLng;
						console.log(event.latLng.object.K);
					});
			}

			function addMark(location)
			{
				var marker = new google.maps.Marker({
				position: location,
				map: map,
				title:document.getElementById('title').value
				});
				puntos.push(marker);
				
				google.maps.event.addListener(marker,"rightclick",function(event)
				{	
					// Recorrempos el array de puntos y los borramos
					console.log(event.latLng);
					console.log(puntos);
					marker.setMap(null);
				});
				
				var contentString = '<div id="content">'+
								  '<div id="siteNotice">'+
									'<p>'+document.getElementById('title').value+'</p>'
								  '</div>'+
								  '</div>';
								  
				var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				  
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
						<td></td>
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
						<td align="center" ><input type="radio" ></td>
						<td></td>
						<td>Documentos</td>
						<td>Gestion</td>
						<td>Lugar</td>
						<td>Latitud</td>
						<td>Longitud</td>
					</tr>
				</tbody>
			</table>

			<textarea id="title" ></textarea>
		
			<span id="posicion" ></span>
			
			<span id="borrar" >Borrar</span>

		</fieldset>

		<div id="map-canvas" ></div>

	</body>

</html>