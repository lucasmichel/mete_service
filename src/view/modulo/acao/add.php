<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $acao = $this->getDados('acao');
    $modulo = $this->getDados('modulo');
    
?>
<script type="text/javascript">
    $(document).ready(function($){
    	
        
        $('#nome').focus();
       
                
        $("#ok").click(function() {
        	var nome = $.trim($("#nome").val());
        	var codigoAcao = $.trim($("#codigoAcao").val());
        	
        	
        	if(nome.length <= 0){
            	alert('é necessário o nome da ação');
                $("#nome").focus();
                return false;
			}
        	            
            else if(codigoAcao.length <= 0){
                alert('é necessário definir o código da ação');
                $("#codigoAcao").focus();
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
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "modulo.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Ações do Módulo: <?php echo $modulo->getNome();?></span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro" action=modulo/adicionarAcao/<?php echo $modulo->getId() ?>>
                        	<input type="hidden" id="idModulo" name="idModulo" value="<?php if($modulo != null) echo $modulo->getId();  ?>" />
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    <li>
                                        <label for="nome">Nome da ação</label>
                                        <input type="text" id="nome" name="nome" value="<?php if($acao != null) echo $acao->getNome();  ?>" />
                                    </li>
                                    <li>
                                        <label for="Acao">Código da ação</label>
                                        <input alt="integer" type="text" id="codigoAcao" name="codigoAcao" value="<?php if($acao != null) echo $acao->getCodigoAcao();  ?>"/>
                                    </li>
                                   
                                   
                                     <li>
                                        <label for="button1">Esta ação será um sub menu?</label>

                                        <input id="subMenu" type="radio" value="1" name="subMenu" 
                                                <?php if(($acao != null)&&($acao->getSubMenu() == 1))
                                                        echo 'checked="checked"';  
                                                ?>
                                        >Sim</input>

                                        <input id="subMenu" type="radio" value="0" name="subMenu"  
                                                <?php if(($acao != null)&&($acao->getSubMenu() == 0))
                                                        echo 'checked="checked"';
                                                if($acao == null)
                                                        echo 'checked="checked"';
                                                ?>
                                        >Não</input>
										
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
