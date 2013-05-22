<?php
    header('Content-Type: text/html; charset=utf-8', true);
    
    $cliente = $this->getDados('cliente');    
    $acompanhante = $this->getDados('acompanhante');
    $comentario = $this->getDados('comentario');
    $usuario = $this->getDados('usuario');
    $avaliacao = $this->getDados('avaliacao');
?>
<script type="text/javascript">
    $(document).ready(function($){
        $('#avaliacao').focus();
                
        $("#ok").click(function() {
        	var servico = $.trim($("#avaliacao").val());
        	
        	
        	if(nota.length <= 0){
            	alert('Não necessÃ¡rio o nome do comentario');
                $("#avaliacao").focus();
                return false;
			}           
            else{
                $("#cadastro").submit();
            }          
        });                
    });
</script>
<style>
<!--

-->
</style>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "comentario.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Comentario</span>
                  
                              
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    <li>
                                        <label for="nome">Nota</label>
                                        <input type="text" id="nota" name="nota" value="<?php if($avaliacao != null) echo $avaliacao->getNota();  ?>" />
                                         <input  id="acompanhanteId" name="acompanhanteId"  type="hidden"  text="acompanhanteId"  value="<?php if($acompanhante != null) echo $acompanhante->getId();  ?>" />
                                          
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