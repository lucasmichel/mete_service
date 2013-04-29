<script type="text/javascript">
    function validarCamposObrigatorios(){
        if(($.trim($("#nome").val()) == '')||($("input:checked").size() == 0)){
            alert('Preencha os campos obrigatórios.','Alerta');
            return false;
        }
        return true;
    }

</script>
<?php
$perfil = $this->getDados('VIEW');
?>
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
                        <span>Editar Perfil</span>
                    </h3>
                    <div class="inside">
                        <form id="editarPerfil" name="editarPerfil" method="post" onSubmit="return validarCamposObrigatorios();">
                            <input type="hidden" id="id" name="id" value="<?php echo $perfil->getId(); ?>" />
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">
                                    <li>
                                        <label for="nome">Nome</label>
                                        <input type="text" id="nome" name="nome" value="<?php echo $perfil->getNome(); ?>" />
                                    </li>
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>Módulos/Ações</legend>
                                <?php
                                // LISTANDO TODAS OS MODULOS //
                                try {
                                    $modulos = Modulo::listar();
                                    foreach ($modulos as $modulo) {
                                         
                                        ?>
                                        <ul class="list-cadastro">
                                            <li><?php echo $modulo->getNome(); ?></li>
                                            <li>
                                                <?php
                                                try {
                                                    $acoes = Acao::listarPorModulo($modulo->getId());                                                    
                                                    foreach ($acoes as $acao) {                
                                                        
                                                        
                                                        
                                                        foreach ($perfil->getAcoes() as $act) {
                                                            if (($act->getModulo()->getId()) == ($modulo->getId()) && ($act->getCodigoAcao()) == ($acao->getCodigoAcao())) {
                                                                $check = "checked='checked'";
                                                                break;
                                                            } else {
                                                                $check = '';
                                                            }
                                                        }
                                                ?>
                                                    <ul>
                                                        <li>
                                                            <label>
                                                                <input <?php echo $check; ?> type="checkbox" id="ch_<?php echo $modulo->getId() . "_" . $acao->getCodigoAcao(); ?>" name="ch_<?php echo $modulo->getId() . "_" . $acao->getCodigoAcao(); ?>" />
                                                                <?php 
                                                                    echo $acao->getNome(); 
                                                                ?>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                <?php
                                                    }
                                                } catch (ListaVazia $e) {
                                                    
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                        <?php
                                    }
                                } catch (ListaVazia $e) {
                                    
                                }
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