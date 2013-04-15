<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $acompanhante = $this->getDados('acompanhante');
    $usuario = $this->getDados('usuario');
?>
<script type="text/javascript">
    $(document).ready(function($){
    	function validaEmail (email)
    	{
    		er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
    		if(er.exec(email))
    			return true;
    		else
    			return false;
    	};
        
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
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "acompanhanteFoto.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Fotos da Acompanhante</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">
                                                                    
                                    <li>
                                        <label for="email">Foto</label>
                                        <input type="file" id="foto" name="foto" accept="image/*"/>
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