<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $servico = $this->getDados('servico');
?>
<script type="text/javascript">
    $(document).ready(function($){
        $('#nome').focus();
                
        $("#ok").click(function() {
        	var servico = $.trim($("#nome").val());
        	
        	
        	if(servico.length <= 0){
            	alert('é necessário o nome do serviço');
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
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "servico.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Serviço</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    <li>
                                        <label for="nome">Nome do serviço</label>
                                        <input type="text" id="nome" name="nome" value="<?php if($servico != null) echo $servico->getNome();  ?>" />
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