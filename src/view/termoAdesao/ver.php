<?php
header('Content-Type: text/html; charset=utf-8', true);
$cliente = $this->getDados('cliente');
$usuario = Usuario::buscar($cliente->getUsuarioId()); 
?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "cliente.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox">
        </div>
        <div class="clear"> </div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">
                        <span>Ver Usuário</span>
                    </h3>
                    <div class="inside">
                        <ul class="list-cadastro">
                            <li>
                                <h4>DADOS</h4>
                                <ul>
                                    <li>
                                        <strong>Email</strong><br />
                                        <?php if($usuario != null) echo $usuario->getEmail(); ?>
                                    </li>
                                    <li style="background:#f5f5f5;">
                                        <strong>Nome:</strong><br />
                                        <?php if($cliente != null) echo $cliente->getNome();  ?>
                                    </li>
                                    <li>
                                        <strong>CPF</strong><br />
                                        <?php if($cliente != null) echo $cliente->getCpf();  ?>
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