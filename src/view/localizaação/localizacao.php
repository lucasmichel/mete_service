<?php
function mostaMapa($endereco){
	echo ("</pre><div id=\"ResultDiv\" style=\"text-align: center;\"></div><pre>");
	$key = "AIzaSyA8LxxiqPBU5Ypvk8O7raIibE6tCZbG70U";
	echo "<script src=\"http://maps.googleapis.com/maps/api/js?key=" . $key . "&sensor=true\" type=\"text/javascript\"></script>";
	?>
 
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markermanager/src/markermanager.js"></script>
<script type="text/javascript">
var myLatlng = new google.maps.LatLng(-25.4283563, -49.2732515);
var myOptions = {
zoom: 18,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP,
draggable: true,
mapTypeControl: false,
navigationControl : true
}
var address = <?php echo "'".$endereco."'"; ?>;
map = new google.maps.Map(document.getElementById("ResultDiv"), myOptions);
var addr = address+', Parana, Brasil';
var geocoder = new google.maps.Geocoder();
 
geocoder.geocode( { 'address': addr}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
map.setCenter(results[0].geometry.location);
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location,
title: 'Wagner Pro'
});
 
} else {
alert('Geocode não funcionou corretamente : ' + status);
}
});
</script>
<?php
}
?>