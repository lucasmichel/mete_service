<?php
header('Content-Type: text/html; charset=utf-8', true);
$acompanhante = $this->getDados('acompanhante');
?>
<div class="wrap">
    <?php
    //meuVarDump("testeee");
    //include_once(VIEW . DS . "default" . DS . "tops" . DS . "comentario.php");
    ?>
    <h2>Lista das avaliacoes da acompanhante: <?php echo $acompanhante->getNome(); ?></h2>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <!-- 
        <div class="filtros">
                <span class="select-all">
                        <SELECT NAME="function">
                                <OPTION VALUE="excluir">excluir todos</OPTION>
                                <OPTION VALUE="movimentar">movimentar todos</OPTION>
                        </SELECT>
                        <br/>
                </span>
                <span class="select-all">
                        <SELECT NAME="function">
                                <OPTION VALUE="excluir">excluir todos</OPTION>
                                <OPTION VALUE="movimentar">movimentar todos</OPTION>
                        </SELECT>
                        <br/>
                </span>
                <span class="select-all busca">
                        <input type="text" value="Buscar..." />
                        <input type="button" value="ir"/>
                        <br/>
                </span>
        </div> fim div filtro-->
        <div class="clear"> </div>
        <div class="box-content">
            <div class="box">
                <?php
                /**
                 * Persistindo em listar os usuários
                 */
                try {
					if(Acao::checarPermissao(12, AcompanhanteControll::MODULO))
						
					{
						//meuVarDump("testeee");
							?>
					 <a class="classBt" href=acompanhante/adicionarAvaliacao/<?php echo $acompanhante->getId(); ?> >
                                Adicionar Avaliacao
                            </a>
							                <?php 
					}
					//meuVarDump("testeee");
                    $objetos = Avaliacao::listar("avaliacao"); 
                    $paginacao = new Paginacao($objetos, 20);
						
                  
                    ?>
                    <div class="table">
                        <table id="lista" class="widefat fixed">
                            <thead>
                                <tr>
                                    <th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
                                    <th width="1%"></th>
                                    <th width="28%" align="left">Nota</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($paginacao->getDados() as $objeto) {
                                    ?>
                                    <tr>
                                        <th width="1%">
                                            <input type="checkbox" id="ids" name="ids[]" value="" style="visibility:hidden;"/>
                                        </th>
                                         <td width="1%"></td>
                                        <td width="28%" align="left"><?php echo $objeto->getNota(); ?></td>
                                        <td width="28%" align="left">
                                        <?php
                                        //$avaliacao = Avaliacao::buscar($objeto->getId()); 
                                        	//echo $avaliacao->getNota(); 
                                        ?>
                                        </td>
                                        
                                        <td width="20%">						
                                            <a href="comentario/ver/<?php echo $objeto->getId(); ?>">Ver</a> 
                                            <?php
                                            if (Acao::checarPermissao(3, AvaliacaoControll::MODULO)) {
                                            ?>
                                                <a href="avaliacao/editar/<?php echo $objeto->getId(); ?>">Editar</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(4, AvaliacaoControll::MODULO)) {
                                            ?>    
                                                <a href="avaliacao/excluir/<?php echo $objeto->getId(); ?>">Excluir</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!--fim div table-->
                    <div class="table-footer">
                        <span class="page"><?php echo $paginacao->getLinks(); ?></span>
                    </div>
                    <?php
	                } catch (Exception $e) {
	                    ?>
	                    <div class="exception">
	                        <?php echo $e->getMessage(); ?>
	                    </div>
	                    <?php
	                }
	                ?>
            </div> <!--fim div box-->
        </div> <!--fim div box-content-->
    </div><!--fim div dashboard-wrap-->
</div><!--fim div wrap-->