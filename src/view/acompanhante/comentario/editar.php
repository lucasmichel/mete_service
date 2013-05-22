<?php
    header('Content-Type: text/html; charset=utf-8', true);
    
    $cliente = $this->getDados('cliente');    
    $acompanhante = $this->getDados('acompanhante');
    $comentario = $this->getDados('comentario');
    $usuario = $this->getDados('usuario');
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
                        <span>Alterar Comentario</span>
                         <h5>Código acompanhante: <?php echo $acompanhante->getId(); ?></h5> 
                              
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    <li>
                                        <label for="nome">Comentario</label>
                                        <input type="text" id="comentario" name="comentario" value="<?php if($comentario != null) echo $comentario->getComentario();  ?>" />
                                         
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