<?php
    header('Content-Type: text/html; charset=utf-8', true);    
    $acompanhante = $this->getDados('acompanhante');
    $servicosAcompanhante = $this->getDados('servicosAcompanhante');
?>


<script type="text/javascript" src="http://j.maxmind.com/app/geoip.js"></script>


<style type="text/css">  
    #googleMap { height: 100% }
</style>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz-izkZlMj8pCSosNtyjeUhFiPYbIqfaU&sensor=false"></script>

<script>
/*pra pegar informações d alocalizaçãoda pessoa*/
    var lat = geoip_latitude();
    //alert(lat);
    var lon = geoip_longitude();
    //alert(lon);
    var city = geoip_city();
    //alert(city);
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



<script type="text/javascript">
    $(document).ready(function($){
    	
        
        $('#email').focus();
       
                
        $("#ok").click(function() {
        	var senha = $.trim($("#senha").val());
        	var email = $.trim($("#email").val());
        	var nome = $.trim($("#nome").val());
        	
        	if(email.length <= 0){
            	alert('é necessário um email');
                $("#email").focus();
                return false;
			}
        	            
            else if(!validaEmail(email)){
            	alert('email invalido');
                $("#email").focus();
                return false;
			}

            
            else if(senha.length <= 0){
                alert('é necessário definir a senha');
                $("#senha").focus();
                return false;
            }

            else if(nome.length <= 0){
                alert('é necessário definir o nome');
                $("#nome").focus();
                return false;
            }
            
            else{
                $("#cadastro").submit();
            }
            
          
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
                        <span>Cadastrar serviço</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <input type="hidden" name="acompanhanteId" id="acompanhanteId" value="<?php echo $acompanhante->getId(); ?>" />
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">   
                                    
                                    <li>
                                        <label for="email">Valor</label>
                                        <input type="text" id="valor" name="email" value="<?php if($usuario != null) echo $usuario->getEmail();  ?>" />
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
                                        <label for="nome">Localização</label>
                                        <div id="googleMap"></div>
                                        <br />
                                        <label>Pesquisar por endereço</label>
                                        <input type="text" id="endereco" />
                                        <input type="button" value="Marcar" id="marcar" onclick="marcar()">
                                    </li>
                                    
                                    
                                </ul>
                            </fieldset>
                            <ul id="bts">
                                <li>
                                    <input type="button" class="classBt" value=" OK " id="ok"/>
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
