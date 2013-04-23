<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $modulo = $this->getDados('modulo');
    
?>
<script type="text/javascript">
    $(document).ready(function($){
    	
       
                
        $("#ok").click(function() {
        	var nome = $.trim($("#nome").val());
        	var link = $.trim($("#link").val());
        	
        	
        	if(nome.length <= 0){
            	alert('é necessário um nome para o módulo');
                $("#email").focus();
                return false;
        	}

            else if(link.length <= 0){
                alert('é necessário definir o link do módulo');
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
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "modulo.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Módulo</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    <li>
                                        <label for="nome">Nome do módulo</label>
                                        <input type="text" id="nome" name="nome" value="<?php if($modulo != null) echo $modulo->getNome();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <label for="link">Link do módulo </label>
                                        <input type="text" id="link" name="link" value="<?php if($modulo != null) echo $modulo->getLink();  ?>" />
                                        <label>*(nome do controlador sem o controll ex:
                                        <br />se o modulo for de Foto o link vai ficar foto e o o controlador
                                        <br/>vai ficar FotoControll )</label>
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