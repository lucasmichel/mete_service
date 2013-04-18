<?php
class listar2 {
	// Host do GoogleMaps
	private $mapsHost = 'maps.google.com';
	// Sua Google Maps API Key
	public $mapsKey = 'AIzaSyA8LxxiqPBU5Ypvk8O7raIibE6tCZbG70U';

	function __construct($key = null) {
		if (!is_null($key)) {
			$this->mapsKey = $key;
		}
	}

	function carregaUrl($url) {
		if (function_exists('curl_init')) {
			$cURL = curl_init($url);
			curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
			$resultado = curl_exec($cURL);
			curl_close($cURL);
		} else {
			$resultado = file_get_contents($url);
		}

		if (!$resultado) {
			return false;
			//trigger_error('Não foi possível carregar o endereço: <strong>' . $url . '</strong>');
		} else {
			return $resultado;
		}
	}

	function geoLocal($endereco) {
		$url = 'http://'. $this->mapsHost .'/maps/geo?output=csv&key='. $this->mapsKey .'&q='. urlencode($endereco);
		$dados = $this->carregaUrl($url);
		list($status, $zoom, $latitude, $longitude) = explode(',', $dados);
		if ($status != 200) {
			return false;
			//trigger_error('Não foi possível carregar o endereço <strong>"'.$endereco.'"</strong>, código de resposta: ' . $status);
		}
		return array('lat' => $latitude, 'lon' => $longitude, 'zoom' => $zoom, 'endereco' => $endereco);
	}
}

?>

<?php
// Instancia a classe
$gmaps = new gMaps('SUA GMAK AQUI');

// Pega os dados (latitude, longitude e zoom) do endereço:
$endereco = 'Av. Brasil, 1453, Rio de Janeiro, RJ';
$dados = $gmaps->geolocal($endereco);

// Exibe os dados encontrados:
print_r($dados);
?>

<head>
<script src="http://maps.google.com/maps?file=api&v=2&key={GMAK}" type="text/javascript">

if (GBrowserIsCompatible()) {
    var map = new GMap2(document.getElementById("googleMap"));
    var lat = {LATITUDE}; // Latitude do marcador
    var lon = {LONGITUDE}; // Longitude do marcador
    var zoom = {ZOOM}; // Zoom
 
    map.addControl(new GMapTypeControl());
    map.addControl(new GLargeMapControl());
    map.setCenter(new GLatLng(lat, lon), zoom);
 
    var marker = new GMarker(new GLatLng(lat,lon));
 
    GEvent.addListener(marker, "click", function() {
        marker.openInfoWindowHtml("<h2>Minha marca</h2><p>Meu texto!</p>");
    });
 
    map.addOverlay(marker);
    map.setCenter(point, zoom);
}
</script>

<div id="googleMap"></div>

</head>
