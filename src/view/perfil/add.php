<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
$(document).ready(function($){
    $('#nome').focus();
    $('form').validate( {
        messages: {
                nome: { required: 'Digite um nome' }
        }
    });
});
</script>
<div class="wrap">
<?php 
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "perfil.php");
?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
                    <div class="box">
                            <div class="table">
                                <h3 class="hndle">
                                        <span>Cadastrar Perfil</span>
                                </h3>
                                <div class="inside">
                                    <form method="post">
                                        <fieldset>
                                            <legend>Dados</legend>
                                            <ul class="list-cadastro">
                                                <li>
                                                    <label for="nome">Nome</label>
                                                    <input type="text" id="nome" name="nome" value="" class="required" />
                                                </li>
                                            </ul>
                                        </fieldset>
                                        <hr></hr>
                                            <fieldset>
                                                    <legend>Módulos/Ações</legend>
                                                    <?php 
                                                        // LISTANDO TODAS OS MODULOS //
                                                        try {
                                                                $modulos = Modulo::listar();                                                                
                                                                foreach($modulos as $modulo){
                                                    ?>
                                                    <ul class="list-cadastro">
                                                            <li style="color:#333333;"><strong><?php echo $modulo->getNome();?></strong></li>
                                                            <li>
                                                                <?php 
                                                                        try {
                                                                                $acoes = Acao::listar($modulo->getId());
                                                                                foreach($acoes as $acao){
                                                                ?>
                                                                    <ul>
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" id="ch_<?php echo $modulo->getId()."_".$acao->getCodigoAcao();?>" name="ch_<?php echo $modulo->getId()."_".$acao->getCodigoAcao();?>" />
                                                                                <?php echo $acao->getNome();?>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                    <?php 
                                                                                    }
                                                                            }
                                                                            catch(ListaVazia $e){}
                                                                    ?>
                                                            </li>
                                                    </ul>
                                                    <?php 
                                                                    }
                                                            }
                                                            catch(ListaVazia $e){}
                                                    ?>
                                            </fieldset>
                                            <ul id="bts">
                                                    <li>
                                                            <input type="submit" class="bt-cadastro border" value=" OK " />
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