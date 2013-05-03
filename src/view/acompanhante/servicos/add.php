<?php
    header('Content-Type: text/html; charset=utf-8', true);    
    $acompanhante = $this->getDados('acompanhante');
    $servicosAcompanhante = $this->getDados('servicosAcompanhante');
?>
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
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "acompanhante.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar serviço da acompanhante</span>
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
                                        <label for="senha">Serviço</label>
                                        <input type="password" id="senha" name="senha" value="" class="required" />
                                    </li>
                                    <li>
                                        <label for="nome">Localização</label>
                                        <input type="text" id="nome" name="nome" value="<?php if($acompanhante != null) echo $acompanhante->getNome();  ?>"  />
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
