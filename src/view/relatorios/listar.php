<?php
//meuVarDump("testeee");
header('Content-Type: text/html; charset=utf-8', true);
?>
<div class="wrap">
    <?php
    //meuVarDump("testeee");
   // include_once(VIEW . DS . "default" . DS . "tops" . DS . "avaliacao.php");
    ?>
    <h2 width="30%" > Relatorio de avaliacao</h2>
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
                    $objetos = Avaliacao::listar("avaliacao");
                    $paginacao = new Paginacao($objetos, 20);
                    ?>
                    <div class="table">
                        <table id="lista" class="widefat fixed">
                            <thead>
                                <tr>
                                    <th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
                                    <th width="1%"></th>
                                    <th width="30%" align="left">Cliente</th>
                                   
                                    <th width="30%" align="left">Acompanhante</th>                                    
                                    <th width="30%" align="left">Data cadastro</th>
                                    <th width="30%" align="left">Nota</th>
                                    
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
                                        
                                        <td align="left">
                                        <?php
                                            $usuario = Cliente::buscar($objeto->getClienteId()); 
                                            echo $usuario->getNome(); 
                                        ?>
                                        </td>
                                          <td align="left">
                                        <?php
                                            $acomp = Acompanhante::buscar($objeto->getAcompanhanteId()); 
                                            echo $acomp->getNome(); 
                                        ?>
                                        </td>
                                        
                                        <td align="left">
                                        <?php                                        
                                            echo $objeto->getDataCadastro(); 
                                        ?>
                                        </td>
                                         <td align="left"><?php echo $objeto->getNota(); ?></td>
                                       
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