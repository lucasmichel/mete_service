<?php
header('Content-Type: text/html; charset=utf-8', true);
?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "cliente.php");
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
                    $objetos = Cliente::listar("nome");
                    $paginacao = new Paginacao($objetos, 20);
                    ?>
                    <div class="table">
                        <table id="lista" class="widefat fixed">
                            <thead>
                                <tr>
                                    <th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
                                    <th width="1%"></th>
                                    <th width="28%" align="left">Nome</th>
                                    <th width="28%" align="left">Email</th>
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
                                        <td width="28%" align="left">
                                        <?php
                                        $usuario = Usuario::buscar($objeto->getUsuarioId()); 
                                        	echo $usuario->getEmail(); 
                                        ?>
                                        </td>
                                        
                                        <td width="20%">						
                                            <a href="cliente/ver/<?php echo $objeto->getId(); ?>">Ver</a> 
                                            <?php
                                            if (Acao::checarPermissao(3, ClienteControll::MODULO)) {
                                            ?>
                                                <a href="cliente/editar/<?php echo $objeto->getId(); ?>">Editar</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(4, ClienteControll::MODULO)) {
                                            ?>    
                                                <a href="cliente/excluir/<?php echo $objeto->getId(); ?>">Excluir</a>
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