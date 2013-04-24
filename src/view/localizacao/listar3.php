<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<META NAME="Description" CONTENT="A page demonstrating Geo-location with Google Maps">
<META NAME="Keywords" CONTENT="google maps, api, google maps api">
<title>Google Maps Geo-Locator Example!</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyA8LxxiqPBU5Ypvk8O7raIibE6tCZbG70U"
type="text/javascript"></script>
<script type="text/javascript">
<?php
//CENTER MAP BASED ON USER'S GEOIP
include("GeoLiteCity/geoipcity.php");
include("GeoLiteCity/geoipregionvars.php");
// uncomment for Shared Memory support
// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);

$gi = geoip_open("GeoLiteCity/GeoLiteCity.dat",GEOIP_STANDARD);

//FOR DEBUGGING PURPOSES, IF THIS IS BEING HOSTED ON A LOCAL MACHINE (127.0.0.1), THEN USE GOOGLE'S IP ADDRESS AS AN EXAMPLE. THIS WILL CENTER THE MAP ON MOUNTAIN VIEW, CA
if (!$_SERVER['REMOTE_ADDR']=="127.0.0.1") {
$userIP = $_SERVER['REMOTE_ADDR'];
} else {
$userIP = "192.168.1.6";
}

$record = geoip_record_by_addr($gi,$userIP);
$existsZoom = 11; //Zoom level used if IP is found in the GeoIP database
$zoom = 1; //Zoom used if the IP is not found in the GeoIP database
$lat = 20; //Latitude used if the IP is not found in the GeoIP database
$lng = -20; //Longitude used if the IP is not found in the GeoIP database

//SEE IF USER IP EXISTS IN THE GEOIP DATABASE. IF NOT, RETURN DEFAULT LAT/LON COORDINATES
if (!empty($record->latitude)) {
$zoom = $existsZoom;
$lat = $record->latitude;
}

if (!empty($record->longitude)) {
$zoom = $existsZoom;
$lng = $record->longitude;
}

//Print out the code
print " var DefaultUserLat = $lat;\n";
print " var DefaultUserLng = $lng;\n";
print " var DefaultUserZoom = $zoom;\n";
geoip_close($gi);
?>
function initialize()
{
if (GBrowserIsCompatible()) {
var map = new GMap2(document.getElementById("map_canvas"));
map.setCenter(new GLatLng(DefaultUserLat , DefaultUserLng), DefaultUserZoom ); //These are our default user coordinates and default zoom level set in the PHP area.
map.setUIToDefault();
}
}
</script>

</head>
<body onload="initialize()" onunload="GUnload()">
<div id="map_canvas" style="width: 500px; height: 300px"></div>
</body>
</html>