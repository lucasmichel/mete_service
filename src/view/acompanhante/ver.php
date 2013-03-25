<?php
header('Content-Type: text/html; charset=utf-8', true);
?>
<?php
$usuario = new Usuario();
$usuario = $this->getDados('VIEW');

?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "usuario.php");
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
                                        <strong>Login</strong><br />
                                        <?php echo $usuario->getLogin(); ?>
                                    </li>
                                    <li style="background:#f5f5f5;">
                                        <strong>Data/Hora ultimo login:</strong><br />
                                        <?php                                            
                                        echo formataData($usuario->getDataUltimoLogin()); ?>
                                    </li>
                                    <li>
                                        <strong>Perfil</strong><br />
                                        <?php echo $usuario->getPerfil()->getNome(); ?>
                                    </li>
                                    <li style="background:#f5f5f5;">
                                        <strong>Email:</strong><br />
                                        <?php                                            
                                        echo $usuario->getEmail(); ?>
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