<?php
    header('Content-Type: text/html; charset=utf-8', true);
    
    $cliente = $this->getDados('cliente');    
    $acompanhante = $this->getDados('acompanhante');
    $comentario = $this->getDados('comentario');
?>
<script type="text/javascript">
    $(document).ready(function($){
        $('#comentario').focus();
                
        $("#ok").click(function() {
        	var servico = $.trim($("#comentario").val());
        	
        	
        	if(comentario.length <= 0){
            	alert('Não necessÃ¡rio o nome do comentario');
                $("#comentario").focus();
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
                        <span>Cadastrar Comentario</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    <li>
                                        <label for="nome">Comentarioo</label>
                                        <input type="text" id="comentario" name="comentario" value="<?php if($comentario != null) echo $comentario->getComentario();  ?>" />
                                                                             <input type="text" id="acompanhanteId" name="acompanhanteId" value="<?php if($comentario != null) echo $comentario->getId();  ?>" />
                                         <input type="text" id="clienteId" name="clienteId" value="<?php  echo $cliente->getId();  ?>" />
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