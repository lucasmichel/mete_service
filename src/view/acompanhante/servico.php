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
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "acompanhante.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Serviços da Acompanhante</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    <li>
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" value="<?php if($usuario != null) echo $usuario->getEmail();  ?>" />
                                    </li>
                                    <li>
                                        <label for="senha">Senha</label>
                                        <input type="password" id="senha" name="senha" value="" class="required" />
                                    </li>
                                    <li>
                                        <label for="nome">Nome</label>
                                        <input type="text" id="nome" name="nome" value="<?php if($acompanhante != null) echo $acompanhante->getNome();  ?>"  />
                                    </li>
                                    
                                    <li>
                                        <label for="idade">Idade</label>
                                        <input type="text" id="idade" name="idade" value="<?php if($acompanhante != null) echo $acompanhante->getIdade();  ?>" />
                                    </li>

                                    <li>
                                        <label for="altura">Altura</label>
                                        <input type="text" id="altura" name="altura" value="<?php if($acompanhante != null) echo $acompanhante->getAltura();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="peso">Peso</label>
                                        <input type="text" id="peso" name="peso" value="<?php if($acompanhante != null) echo $acompanhante->getPeso();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="busto">Busto</label>
                                        <input type="text" id="busto" name="busto" value="<?php if($acompanhante != null) echo $acompanhante->getBusto();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="Cintura">Cintura</label>
                                        <input type="text" id="cintura" name="cintura" value="<?php if($acompanhante != null) echo $acompanhante->getCintura();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="quadril">Quadril</label>
                                        <input type="text" id="quadril" name="quadril" value="<?php if($acompanhante != null) echo $acompanhante->getQuadril();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="olhos">Olhos</label>
                                        <input type="text" id="olhos" name="olhos" value="<?php if($acompanhante != null) echo $acompanhante->getOlhos();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="pernoite">Pernoite</label>
                                        <input type="radio" name="pernoite" id="pernoite" value="1" <?php if(($acompanhante != null)&&($acompanhante->getPernoite() == 1)) echo'checked';  ?>  >Sim<br>
										<input type="radio" name="pernoite" id="pernoite" value="0" <?php if(($acompanhante != null)&&($acompanhante->getPernoite() == 0)) echo'checked';  ?> >Não
                                        
                                    </li>
                                    
                                     <li>
                                        <label for="atendo">Atendo a:</label>
                                        <input type="text" id="atendo" name="atendo" value="<?php if($acompanhante != null) echo $acompanhante->getAtendo();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="especialidade">Especialidade:</label>
                                        <input type="text" id="especialidade" name="especialidade" value="<?php if($acompanhante != null) echo $acompanhante->getEspecialidade();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="horarioAtendimento">Horario de atendimento:</label>
                                        <input type="text" id="horarioAtendimento" name="horarioAtendimento" value="<?php if($acompanhante != null) echo $acompanhante->getHorarioAtendimento();  ?>" />
                                    </li>
                                    
                                </ul>
                            </fieldset>
                            <ul id="bts">
                                <li>
                                    <input type="button" class="bt-cadastro border" value=" OK " id="ok"/>
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