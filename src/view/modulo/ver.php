<?php
header('Content-Type: text/html; charset=utf-8', true);

$modulo = $this->getDados('modulo');
$acoes = Acao::listarPorModulo($modulo->getId()); 

?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "modulo.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox">
        </div>
        <div class="clear"> </div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">
                        <span>Ver Módulo</span>
                    </h3>
                    <div class="inside">
                        <ul class="list-cadastro">
                            <li>
                                <h4>DADOS</h4>
                                <ul>
                                    <li>
                                        <strong>Nome do módulo</strong><br />
                                        <?php if($modulo != null) echo $modulo->getNome(); ?>
                                    </li>
                                    <?php if($acoes != null){ ?>
                                    <li><br /></li>                                    
                                    <li style="background:#f5f5f5;">
                                        <strong>Ações deste módulo:</strong><br />
									</li>
									<li>
									<strong>Nome / código da ação</strong><br />
									</li>
                                        <?php 
                                        
                                        	foreach ($acoes as $acao) {
                                        
											?>
												<li>                                        			
                                        			<?php echo $acao->getNome()." / ".$acao->getCodigoAcao(); ?>
                                    			</li>
                                    			
											<?php 

                                        	}
										}?>
                                    
                                    
                                    
                                     
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