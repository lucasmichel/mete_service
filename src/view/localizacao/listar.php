




<!DOCTYPE html>
<html>
<head>

<script type="text/javascript" src="http://j.maxmind.com/app/geoip.js"></script>


<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #googleMap { height: 100% }
    </style>


    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz-izkZlMj8pCSosNtyjeUhFiPYbIqfaU&sensor=false">
</script>

<script>
/*pra pegar informações d alocalizaçãoda pessoa*/

var lat = geoip_latitude();
alert(lat);
  var lon = geoip_longitude();
alert(lon);
  var city = geoip_city();
alert(city);
/*pra pegar informações d alocalizaçãoda pessoa*/


var map = null; 

//var myCenter = new google.maps.LatLng(-8.102738577783168,-35.299072265625);
var myCenter = new google.maps.LatLng(lat, lon);
var marker;

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:12,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

marker=new google.maps.Marker({
  position:myCenter,
  animation:google.maps.Animation.BOUNCE
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);





function marcar(){

  				var endereco = document.getElementById("endereco").value ;
  				//alert(endereco)
  				geocoder = new google.maps.Geocoder();		
  				geocoder.geocode({'address':endereco}, function(results, status){ 
  					if( status = google.maps.GeocoderStatus.OK){

						alert(results[0].geometry.location);
						myCenter = results[0].geometry.location;
						markerInicio = new google.maps.Marker({position: myCenter,map: map});		
						map.setCenter(myCenter); 

					}			
				});
  		}

</script>
</head>

<body>
<div id="googleMap"></div>

<div>
			<label>EndereÃ§o</label>
			<input type="text" id="endereco">
		</div>
		
		<input type="button" value="Marcar" id="marcar" onclick="marcar()">

</body>
</html>
