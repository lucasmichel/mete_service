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
var markerArray = [];
var infowindowArray = [];

var latitudeArray = [];
var longitudeArray = [];
var enderecoArray = [];
<?php 
if($listaLocalizacao!= null){
    $contador = 0;
    foreach ($listaLocalizacao as $localizacao) {
        //meuVarDump($localizacao);
        echo "latitudeArray[".$contador."] = '".$localizacao->getLatitude()."';\n";
        echo "longitudeArray[".$contador."] = '".$localizacao->getLongitude()."';\n";
        echo "enderecoArray[".$contador."] = '".$localizacao->getEnderecoFormatado()."';\n";
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
    
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });
    
    
    /*preenche as marcas ja salvas*/
    var tamanho = latitudeArray.length;
    
    for (var i = 0; i < tamanho; i++) {
      var myCenterInterno = new google.maps.LatLng(latitudeArray[i], longitudeArray[i]);
      marker=new google.maps.Marker({
        position:myCenterInterno,
        animation:google.maps.Animation.BOUNCE
      });
      marker.setMap(map);
      
      infowindow = new google.maps.InfoWindow({
        content: '<div class="classBalao" style="width: 100%; height: 100%">' + enderecoArray[i] +'</div>',
        //content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
        maxWidth: 200
      });  
      infowindow.open(map,marker);
      
      infowindowArray.push(infowindow);
      markerArray.push(marker);
      
    }
    /*preenche as marcas ja salvas*/
  

}

google.maps.event.addDomListener(window, 'load', initialize);



function placeMarker(location) {
    
  map.setOptions({ draggableCursor: 'wait' });
    
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'Localização dos serviço',
        animation:google.maps.Animation.BOUNCE
    });
    marker.setMap(map);
  
    var txtEndereco = location.lat() +','+ location.lng();
    
    geocoder = new google.maps.Geocoder();
  
    geocoder.geocode({'address':txtEndereco}, function(results, status){ 
        
        if( status = google.maps.GeocoderStatus.OK){           
            
            
            
            var infowindow = new google.maps.InfoWindow({
              content: '<div class="classBalao" style="width: 100%; height: 100%">' + results[0].formatted_address +'</div>',
              //content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
              maxWidth: 200
            });  
            
            infowindow.open(map,marker);
            
            infowindowArray.push(infowindow);
            markerArray.push(marker);
            
            latitudeArray.push(myCenter.lat());
            longitudeArray.push(myCenter.lng());            
            enderecoArray.push(results[0].formatted_address);

            
            map.setOptions({ draggableCursor: 'move' });
            
        }
        else{
            alert("ERROR!: "+status);
        }        
    });
  //map.setOptions({ draggableCursor: 'move' });
  map.setOptions({ draggableCursor: 'wait' });
  
}


function marcar(){
    var endereco = document.getElementById("endereco").value ;        
    geocoder = new google.maps.Geocoder();		
    geocoder.geocode({'address':endereco}, function(results, status){ 
        if( status = google.maps.GeocoderStatus.OK){
            
            resultse = results[0].address_components;
            
            
            myCenter = results[0].geometry.location;
            //markerInicio = new google.maps.Marker({position: myCenter,map: map});		
            //map.setCenter(myCenter); 
            
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(myCenter.lat(), myCenter.lng()),
              map: map,
              title: 'Localização dos serviço',
              animation:google.maps.Animation.BOUNCE
            });
            
            var infowindow = new google.maps.InfoWindow({
              //content: 'Latitude: ' + myCenter.lat() + '<br>Longitude: ' + myCenter.lng()
              content: '<div class="classBalao" style="width: 100%; height: 100%">' + results[0].formatted_address +'</div>',
              maxWidth: 200
            });  
            
            infowindow.open(map,marker);
            
            infowindowArray.push(infowindow);
            markerArray.push(marker);
            
            latitudeArray.push(myCenter.lat());
            longitudeArray.push(myCenter.lng());            
            enderecoArray.push(results[0].formatted_address);
            
        }			
    });
}


// Removes the overlays from the map, but keeps them in the array
function clearMarker() {
  if (markerArray) {
    for (i in markerArray) {
      markerArray[i].setMap(null);
    }
  }
  clearInfowindow();
}


function clearInfowindow() {
  if (infowindowArray) {
    for (i in infowindowArray) {
      infowindowArray[i].setMap(null);
    }
  }
}



// Shows any overlays currently in the array
function showMarker() {
  if (markerArray) {
    for (i in markerArray) {
      markerArray[i].setAnimation(google.maps.Animation.BOUNCE);
      markerArray[i].setMap(map);
      
    }
  }
  showInfowindow();
}


function showInfowindow() {
  if (infowindowArray) {
    for (i in infowindowArray) {
      infowindowArray[i].setMap (map);
    }
  }
}


// Deletes all markers in the array by removing references to them
function deleteMarkers() {
  if (markerArray) {
    for (i in markerArray) {
      markerArray[i].setMap(null);
    }
    
  }
  deleteInfowindowArray();
}


// Deletes all markers in the array by removing references to them
function deleteInfowindowArray() {
  if (infowindowArray) {
    for (i in infowindowArray) {
      infowindowArray[i].setMap(null);
    }
    
    markerArray.length = null;
    infowindowArray.length = null;
    
    latitudeArray.length = null;
    longitudeArray.length = null;
    enderecoArray.length = null;
  }
}


$(document).ready(function(){    
    $("#cadastrar").click(function() {        
        
        var servicoAcompanhanteId = $('#servico :selected').val();
        var preco = $("#valor").val();
        alert('FALTA CONCLUIR O EDITAR AKI!!!!!!!!!!!!!!!!');
        
        var request = $.ajax({
	  url: "<?php echo BASE;?>/acompanhante/editarServico/<?php echo $acompanhante->getId();?>",
	  type: "POST",
	  data: {latitude: latitudeArray, longitude: longitudeArray, endereco: enderecoArray, preco:preco, servicoAcompanhanteId: servicoAcompanhanteId },
	  dataType: "html",
	  async:true,
	  success:function(retorno){              
		if(retorno != "erro"){
                        alert("Cadstro de serviço realizado com sucesso!");
			window.document.location = "<?php echo BASE;?>/acompanhante/visualizarServicos/<?php echo $acompanhante->getId();?>";
		}else{
                        alert("ERRO: "+retorno);

			/*var name=confirm("Já existe uma ata com esses dados registrada no banco de dados. Deseja editá-la?.")
			if (name==true){                                                                                
				window.document.location = "<?php echo BASE;?>/atas/editar/"+retorno;
			} else{                                        			                        
				//$("#finalizar").removeAttr("disabled");
				$("#cadastrarAta input[type=text]").val("");
				$("#cadastrarAta select").val("0");						
			}	*/				
		}	
	  }     

	});
        
    });
    
    
    
});

</script>



<div class="wrap">
    <h2><span>Serviços da acompanhante: <?php echo $acompanhante->getnome();?></span></h2>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Editar serviço</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <input type="hidden" name="acompanhanteId" id="acompanhanteId" value="<?php echo $acompanhante->getId(); ?>" />
                            <input type="hidden" name="servicosAcompanhanteId" id="servicosAcompanhanteId" value="<?php echo $servicosAcompanhante->getId(); ?>" />
                            <ul class="list-cadastro">   
                                <li>
                                    <label for="valor">Valor</label>
                                    <input alt="decimalLucas" type="text" id="valor" name="valor" value="<?php if($servicosAcompanhante != null) echo $servicosAcompanhante->getValor();  ?>" />
                                </li>
                                <li>
                                    <label for="perfil">Serviço</label>
                                    <select id="servico" name="servico" class="required">
                                        <option value="">Selecione</option>
                                        <?php
                                        if($servicosAcompanhante!=null){
                                            $idServico = $servicosAcompanhante->getServicoId();
                                        }
                                        else {
                                            $idServico = null;
                                        }
                                        try {
                                            $servicos = Servico::listar("nome");
                                                foreach ($servicos as $servico) {
                                                    ?>
                                            <option <?php if($idServico == $servico->getId()) {
                                                        echo "selected"; 
                                                    }
                                                    ?> value="<?php echo $servico->getId(); ?>"><?php echo $servico->getNome(); ?>
                                            </option>
                                                    <?php
                                                }
                                            } catch (Exception $e) {

                                            ?>
                                                <option value="erro" ><?php echo $e->getMessage();?></option>
                                            <?php

                                        }
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    
                                    <div style="width: 100%; height: 50%; ">
                                        <label for="nome">Localização</label>
                                        <div  id="googleMap"></div>

                                        <label>Pesquisar por endereço</label>
                                        <input type="text" id="endereco" />
                                        <input type="button" value="Pesquisar Ponto" class="classBt" onclick="marcar();">
                                        <input type="button" value="Ocultar Pontos" class="classBt" onclick="clearMarker();">
                                        <input type="button" value="Exibir Pontos Existentes" class="classBt" onclick="showMarker();">
                                        <input type="button" value="ECLUIR!! Pontos Existentes" class="classBt" onclick="deleteMarkers();">

                                    </div>
                                </li>
                            </ul>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <ul class="list-cadastro">   
                                <li>
                                    <input type="button" class="classBt" value=" CADASTRAR " id="cadastrar" name="cadastrar"/>
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
