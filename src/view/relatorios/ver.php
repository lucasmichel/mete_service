<?php
header('Content-Type: text/html; charset=utf-8', true);
$cliente = $this->getDados('cliente');
//$usuario = Usuario::buscar($cliente->getUsuarioId()); 
?>
<div class="wrap">
    <?php
    //include_once(VIEW . DS . "default" . DS . "tops" . DS . "cliente.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox">
        </div>
        <div class="clear"> </div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">
                        <h2>Lista de Relatorios </h2>
                    </h3>
                    <div class="inside">
                        <ul class="list-cadastro">
                            <li>
                                <h4>Lista</h4>
                                <ul>
                                <?php
                                            if (Acao::checarPermissao( DefaulControll::MODULO)) {
											?>
                                			 <a href="relatorios/visualizarAvaliacao">Relatorio Avaliacao</a>
                                   <?php
                                            if (Acao::checarPermissao(3, AcompanhanteControll::MODULO)) {
											?>
                                                <a href="relatorioo/editar/<?php echo $objeto->getId(); ?>">Editar</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(4, AcompanhanteControll::MODULO)) {
											?>    
                                                <a href="relatorio/excluir/<?php echo $objeto->getId(); ?>">Excluir</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(5, AcompanhanteControll::MODULO)) {
                                            ?>                              
                                             <?php
                                }
                                ?>
                                </ul>
                            </li>
                        </ul>
                            <?php
                                }
                                ?>
                        <hr> </hr>
                        <ul id="bts">
                            <li>
                                <input type="button" class="bts border" value="Voltar" onclick="location.href='voltar'" />
                            </li>
                        </ul>
                    </div> <!--fim div inside-->
                </div><!--fim div table-->
                <div class="table-footer"></div>
            </div> <!--fim div box-->
        </div> <!--fim div box-content-->
    </div><!--fim div dashboard-wrap-->
</div><!--fim div wrap-->