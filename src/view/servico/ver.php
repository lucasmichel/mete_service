<?php
header('Content-Type: text/html; charset=utf-8', true);

$servico = $this->getDados('servico');

 

?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "servico.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox">
        </div>
        <div class="clear"> </div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">
                        <span>Ver Serviço</span>
                    </h3>
                    <div class="inside">
                        <ul class="list-cadastro">
                            <li>
                                <h4>DADOS</h4>
                                <ul>
                                    <li>
                                        <strong>Nome do serviço</strong><br />
                                        <?php if($servico != null) echo $servico->getNome(); ?>
                                    </li>                                     
                                </ul>
                            </li>
                        </ul>
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