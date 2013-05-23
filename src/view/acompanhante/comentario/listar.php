<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $acompanhante = $this->getDados('acompanhante');
?>
<div class="wrap">
    <?php
    //meuVarDump("testeee");
    //include_once(VIEW . DS . "default" . DS . "tops" . DS . "comentario.php");
    ?>
    <h2>Lista de comentarios da acompanhante: <?php echo $acompanhante->getNome(); ?></h2> </br>
     
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
                // meuVarDump("testeee");
                 try {
                        if(Acao::checarPermissao(2, AcompanhanteControll::MODULO))
                        {
					?>
                            <a class="classBt" href=acompanhante/adicionarComentario/<?php echo $acompanhante->getId(); ?> >
                                Adicionar Comentario
                            </a>
                    <?php 
                        }
                    
                        $objetos = Comentario::listarPorAcompanhante($acompanhante);                   
                        $paginacao = new Paginacao($objetos, 20);

                    ?>
                      <div class="table">
                        <table id="lista" class="widefat fixed">
                            <thead>
                                <tr>
                                    <th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
                                    <th width="1%"></th>
                                    <th width="35%" align="left">Comentario</th>
                                    <th width="15%" align="left">Cliente</th>
                                    <th width="10%" align="left">DataCadastro</th>
                                    <th width="10%" align="left">Açoes</th>

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
                                        <td  align="left"><?php echo $objeto->getComentario(); ?></td>
                                        <td align="left">
                                        <?php
                                            $cliente = Cliente::buscar($objeto->getClienteId()); 
                                            echo $cliente->getNome(); 
                                        ?>
                                        </td>
                                        <td align="left">
                                        <?php
                                        
                                            echo $objeto->getDataCadastro(); 
                                        ?>
                                        </td>
                                        
                                        <td >						
                                            <a href="comentario/ver/<?php echo $objeto->getId(); ?>">Ver</a> 
                                            <?php
                                            if (Acao::checarPermissao(3, ComentarioControll::MODULO)) {
                                            ?>
                                                <a href="comentario/editar/<?php echo $objeto->getId(); ?>">Editar</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(4, ComentarioControll::MODULO)) {
                                            ?>    
                                                <a href="comentario/excluir/<?php echo $objeto->getId(); ?>">Excluir</a>
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