<?php
header('Content-Type: text/html; charset=utf-8', true);
$modulo = $this->getDados('comentario');
?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "comentario.php");
    ?>
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
                    $objetos = Acao::listarPorModulo($modulo);
                    $paginacao = new Paginacao($objetos, 20);
                    

                    
                    if(Acao::checarPermissao(6, ComentarioControll::MODULO))
                    {
                    ?>
                    
                    <span>Ações do Módulo: <?php echo $modulo->getNome();?>
                    <a class="classBt" href=modulo/acaoAdd/<?php echo $modulo->getId(); ?> >
                    	Adicionar ação
                    </a></span>
                   <?php 
                   }
                   ?>
                    
                    <div class="table">
                        <table id="lista" class="widefat fixed">
                            <thead>
                                <tr>
                                    <th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
                                    <th width="1%"></th>
                                    <th width="28%" align="left">Nome da ação</th>
                                    <th width="28%" align="left">Código da ação</th>
                                    <th width="20%" align="left">Ações</th>
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
                                        <td width="28%" align="left"><?php echo $objeto->getNome(); ?></td>
                                        <td width="28%" align="left"><?php echo $objeto->getCodigoAcao(); ?></td>
                                        
                                        
                                        <td width="20%">
                                        	<?php                                        	
                                            if (Acao::checarPermissao(5, ModuloControll::MODULO)) {
											?>
                                            	<a href="comentario/acaoVer/<?php echo $objeto->getCodigoAcao(); ?>">Ver</a> 
                                            <?php
                                            }
                                            if (Acao::checarPermissao(7, ModuloControll::MODULO)) {
											?>
                                                <a href="comentario/acaoEditar/<?php echo $objeto->getCodigoAcao();?>/<?php echo $modulo->getId(); ?>">Editar</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(8, ModuloControll::MODULO)) {
											?>    
                                                <a href="comentario/acaoExcluir/<?php echo $objeto->getCodigoAcao(); ?>">Excluir</a>
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