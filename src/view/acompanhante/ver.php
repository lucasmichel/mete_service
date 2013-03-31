<?php
header('Content-Type: text/html; charset=utf-8', true);

$acompanhante = $this->getDados('acompanhante');

$usuario = Usuario::buscar($acompanhante->getId()); 

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
                                        <strong>Email</strong><br />
                                        <?php if($usuario != null) echo $usuario->getEmail(); ?>
                                    </li>
                                    <li style="background:#f5f5f5;">
                                        <strong>Nome:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getNome();  ?>
                                    </li>
                                    <li>
                                        <strong>Idade</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getIdade();  ?>
                                    </li>
                                    <li style="background:#f5f5f5;">
                                        <strong>Altura:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getAltura();  ?>
                                    </li>
                                    
                                    <li >
                                        <strong>Peso:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getPeso();  ?>
                                    </li>

                                    <li style="background:#f5f5f5;">
                                        <strong>Busto:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getBusto();  ?>
                                    </li>
                                    
                                    <li>
                                        <strong>Cintura:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getCintura();  ?>
                                    </li>
                                    
                                    <li style="background:#f5f5f5;">
                                        <strong>Quadril:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getQuadril();  ?>
                                    </li>
                                    
                                    <li>
                                        <strong>Olhos:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getOlhos();  ?>
                                    </li>
                                    
                                    <li style="background:#f5f5f5;">
                                        <strong>Pernoite:</strong><br />
                                        <?php if(($acompanhante != null)&&($acompanhante->getPernoite() == 1)) 
                                        	echo'Sim';
                                        else
											echo 'Não';  
                                        ?>
                                    </li>
                                    
                                    <li>
                                        <strong>Atendo a:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getAtendo();  ?>
                                    </li>
                                    
                                    <li style="background:#f5f5f5;">
                                        <strong>Especialidade:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getEspecialidade();  ?>
                                    </li>
                                     
                                    <li>
                                        <strong>Horario de atendimento:</strong><br />
                                        <?php if($acompanhante != null) echo $acompanhante->getHorarioAtendimento();  ?>
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