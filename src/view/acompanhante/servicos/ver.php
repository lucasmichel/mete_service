<?php
    header('Content-Type: text/html; charset=utf-8', true);    
    $acompanhante = $this->getDados('acompanhante');
    $servicosAcompanhante = $this->getDados('servicosAcompanhante');    
    $listaLocalizacao = $this->getDados('listaLocalizacao');
?>


<script type="text/javascript" src="http://j.maxmind.com/app/geoip.js"></script>


<style type="text/css">  
    #googleMap { height: 100% }
</style>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz-izkZlMj8pCSosNtyjeUhFiPYbIqfaU&sensor=false"></script>

<script>
/*pra pegar informações d alocalizaçãoda pessoa*/
  var lat = geoip_latitude();
  var lon = geoip_longitude();
  var city = geoip_city();
/*pra pegar informações d alocalizaçãoda pessoa*/

var map = null;
var markersArray = [];
var centersArray = [];


var latitude = [];
var longitude = [];
var endereco = [];

<?php 

if($listaLocalizacao!= null){
    $contador = 0;
    foreach ($listaLocalizacao as $localizacao) {
        //meuVarDump($localizacao);
        echo "latitude[".$contador."] = '".$localizacao->getLatitude()."';\n";
        echo "longitude[".$contador."] = '".$localizacao->getLongitude()."';\n";
        echo "endereco[".$contador."] = '".$localizacao->getEnderecoFormatado()."';\n";
        $contador++;
    }
}
?>





var myCenter = new google.maps.LatLng(lat, lon);

function initialize(){
    var mapProp = {
      center:myCenter,
      zoom:12,
      mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    /*marker=new google.maps.Marker({
      position:myCenter,
      animation:google.maps.Animation.BOUNCE
    });

    marker.setMap(map);*/
    
    /*
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });*/

    var tamanho = latitude.length;
    alert(tamanho);
    for (var i = 0; i < tamanho; i++) {
      var myCenterInterno = new google.maps.LatLng(latitude[i], longitude[i]);
      marker=new google.maps.Marker({
        position:myCenterInterno,
        animation:google.maps.Animation.BOUNCE
      });
      marker.setMap(map);
      
      
      infowindow = new google.maps.InfoWindow({
        content: '<div class="classBalao" style="width: 100%; height: 100%">' + endereco[i] +'</div>',
        //content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
        maxWidth: 200
      });  
      infowindow.open(map,marker);
      
    }

}

google.maps.event.addDomListener(window, 'load', initialize);


/*
function placeMarker(location) {
    
  map.setOptions({ draggableCursor: 'wait' });
    
  var marker = new google.maps.Marker({
    position: location,
    map: map,
    title: 'Localização dos serviço'
  });
  
 
  
    var txtEndereco = location.lat() +','+ location.lng();
    
    
    
    geocoder = new google.maps.Geocoder();
    
    
    
    geocoder.geocode({'address':txtEndereco}, function(results, status){ 
        
    
        
        if( status = google.maps.GeocoderStatus.OK){
            
           
           //alert("FORMATADO: "+results[0].formatted_address);
            
           //var myString =results[0].formatted_address;
           //var myArray = myString.split(',');

           // display the result in myDiv
           //for(var i=0;i<myArray.length;i++){
            //alert(myArray[i])
            
           //}
            
           endereco.push(results[0].formatted_address);
            
            var infowindow = new google.maps.InfoWindow({
              content: '<div class="classBalao" style="width: 100%; height: 100%">' + results[0].formatted_address +'</div>',
              //content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
              maxWidth: 200
            });  
            infowindow.open(map,marker);
            map.setOptions({ draggableCursor: 'move' });
            
            //if (resultse) {
                //for (i in resultse) {
                  //alert("long_name :"+resultse[i]["long_name"]+ " I = "+i);
                  //alert("short_name :"+resultse[i]["short_name"]+ " I = "+i);
                  
                //}
              //}
            
            
            
            //cidade.push(city);
            //estado.push(state);
            
        }
        else{
            alert("ERROR!: "+status);
        }
  
    });
    
 
  
  
  latitude.push(location.lat());
  longitude.push(location.lng());

  
  markersArray.push(marker);
  
  //map.setOptions({ draggableCursor: 'move' });
  map.setOptions({ draggableCursor: 'wait' });
  
}


function marcar(){
    var endereco = document.getElementById("endereco").value ;        
    geocoder = new google.maps.Geocoder();		
    geocoder.geocode({'address':endereco}, function(results, status){ 
        if( status = google.maps.GeocoderStatus.OK){
            
            //alert(results[0].formatted_address);
            
            //alert(results[0].geometry.city);
            //alert(results[0].address_components.long_name);
            //alert();
            
            resultse = results[0].address_components;
            
            
            
            
            //var city = resultse[0]["long_name"];
            //var state = resultse[1]["short_name"];
            //var country = resultse[2]["types"];
            //alert('Cidade: '+city);
            //alert('Estado: '+state);
            //alert('Pais: '+country);
            
            
            myCenter = results[0].geometry.location;
            //markerInicio = new google.maps.Marker({position: myCenter,map: map});		
            //map.setCenter(myCenter); 
            
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(myCenter.lat(), myCenter.lng()),
              map: map,
              title: 'Localização dos serviço'
            });
            
            var infowindow = new google.maps.InfoWindow({
              //content: 'Latitude: ' + myCenter.lat() + '<br>Longitude: ' + myCenter.lng()
              content: '<div class="classBalao" style="width: 100%; height: 100%">' + results[0].formatted_address +'</div>',
              maxWidth: 200
            });  
            
            infowindow.open(map,marker);
            
            centersArray.push(marker);
            
            latitude.push(myCenter.lat());
            longitude.push(myCenter.lng());
            
            endereco.push(results[0].formatted_address);
            
        }			
    });
}

*/





// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
  }
  clearCenters();
}


function clearCenters() {
  if (centersArray) {
    for (i in centersArray) {
      centersArray[i].setMap (null);
    }
  }
}



// Shows any overlays currently in the array
function showOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(map);
    }
  }
  showCenters();
}


function showCenters() {
  if (centersArray) {
    for (i in centersArray) {
      centersArray[i].setMap (map);
    }
  }
}


// Deletes all markers in the array by removing references to them
function deleteOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
    markersArray.length = null;
  }
  deleteCenters();
}


// Deletes all markers in the array by removing references to them
function deleteCenters() {
  if (centersArray) {
    for (i in centersArray) {
      centersArray[i].setMap(null);
    }
    centersArray.length = null;
    latitude.length = null;
    longitude.length = null;
    endereco.length = null;
  }
}


</script>



<div class="wrap">
    <h2><span>Serviço da acompanhante: <?php echo $acompanhante->getnome();?></span></h2>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar serviço</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <input type="hidden" name="acompanhanteId" id="acompanhanteId" value="<?php echo $acompanhante->getId(); ?>" />
                            <ul class="list-cadastro">   
                                <li>
                                    <strong>Valor</strong>
                                    <?php if($servicosAcompanhante != null) echo $servicosAcompanhante->getValor();  ?>
                                </li>
                                <li>
                                    <strong>Serviço</strong>
                                    <?php
                                        if($servicosAcompanhante!=null){
                                            $idServico = $servicosAcompanhante->getServicoId();
                                            $servico = Servico::buscar($idServico);
                                            echo $servico->getNome();
                                        }
                                    ?>                                    
                                </li>
                                <li>
                                    
                                    <div style="width: 100%; height: 70%; ">
                                        <label for="nome">Localização</label>
                                        <div  id="googleMap"></div>
                                    </div>
                                </li>
                            </ul>                            
                            <br />
                            <br />
                            <ul class="list-cadastro">   
                                <li>
                                    <input type="button" class="classBt" value=" VOLTAR " id="voltar" name="voltar"/>
                                </li>
                            </ul>
                        </form>                                
                            
                          
                    </div><!--fim div inside-->
                </div><!--fim div table-->
                <div class="table-footer"></div>
            </div><!--fim div box-->
        </div><!--fim div box-content-->
    </div><!--fim div dashboard-wrap-->
</div><!--fim div wrap-->
