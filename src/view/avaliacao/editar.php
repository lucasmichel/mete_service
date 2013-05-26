<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $avaliacao = $this->getDados('avaliacao');
?>
<script type="text/javascript">
$(document).ready(function($){
    
    $('#avaliacao').focus();
            
    $("#ok").click(function() {
    	var servico = $.trim($("#avaliacao").val());
    	
    	
    	if(nota.length <= 0){
        	alert('N�o necessário o nome do comentario');
            $("#avaliacao").focus();
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
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "comentario.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Editar Avaliacao</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <input type="hidden" id="id" name ="id" value="<?php echo $avaliacao->getId();?>"/>
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">
                                    
                                    <li>
                                        <label for="clienteId">Cliente</label>
                                        <select id="clienteId" name="clienteId">
                                            <option value="">Selecione</option>
                                            <?php
                                            if($comentario!=null){
                                                $idCliente = $comentario->getClienteId();
                                            }
                                            else {
                                                $idCliente = null;
                                            }
                                            try {
                                                $objs = Cliente::listar("nome");
                                                foreach ($objs as $obj) {
                                                    ?>
                                            <option <?php if($idCliente == $obj->getId()) {
                                                        echo "selected"; 
                                                    }
                                                    ?> value="<?php echo $obj->getId(); ?>"><?php echo $obj->getNome(); ?>
                                            </option>
                                                    <?php
                                                }
                                            } catch (ListaVazia $e) {
                                                
                                            }
                                            ?>
                                        </select>
                                    </li>
                                    
                                    <li>
                                        <label for="nome">Avaliacao</label>
                                        <input type="text" id="nota" name="nota" value="<?php if($avaliacao != null) echo $avaliacao->getNota();  ?>" />
                                    </li>                                   
                                    
                                    <li>
                                        <label for="acompanhanteId">Acompanhante:</label>
                                        <select id="acompanhanteId" name="acompanhanteId">
                                            <option value="">Selecione</option>
                                            <?php
                                            if($comentario!=null){
                                                $idAcompanhante = $comentario->getAcompanhanteId();
                                            }
                                            else {
                                                $idAcompanhante = null;
                                            }
                                            try {
                                                $objs = Acompanhante::listar("nome");
                                                foreach ($objs as $obj) {
                                                    ?>
                                            <option <?php if($idAcompanhante == $obj->getId()) {
                                                        echo "selected"; 
                                                    }
                                                    ?> value="<?php echo $obj->getId(); ?>"><?php echo $obj->getNome(); ?>
                                            </option>
                                                    <?php
                                                }
                                            } catch (ListaVazia $e) {
                                                
                                            }
                                            ?>
                                        </select>
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