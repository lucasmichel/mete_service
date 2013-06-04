<?php
header('Content-Type: text/html; charset=utf-8', true);
?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "encontro.php");
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
                    $objetos = Encontro::listar("data_horario");                    
                    $paginacao = new Paginacao($objetos, 20);
                    ?>
                    <div class="table">
                        <table id="lista" class="widefat fixed">
                            <thead>
                                <tr>
                                    <th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
                                    <th width="1%"></th>
                                    <th width="15%" align="left">Cliente</th>                                    
                                    <th width="15%" align="left">Acompanhante(s)</th>
                                    <th width="15%" align="left">Total de serviços contratados</th>
                                    <th width="5%" align="left">Situação</th>
                                    <th width="10%" align="left">Data Hora</th>
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
                                        <td align="left">
                                            <?php 
                                                $obj = Cliente::buscar($objeto->getClienteId());
                                                echo $obj->getNome(); 
                                            ?>
                                        </td>
                                        <td align="left">
                                            <?php 
                                                
                                                $servicosEcontro = ServicosDoEncontro::listarPorEcontro($objeto);
                                                $totalServicos = count($servicosEcontro);
                                                foreach ($servicosEcontro as $servico) {
                                                   $acompanhante = Acompanhante::buscar($servico->getAcompanhanteId());
                                                   echo '<p>'.$acompanhante->getNome().'</p>';
                                                }
                                            ?>
                                        </td>
                                        
                                        <td align="left">
                                            <?php    
                                            
                                                echo $totalServicos;
                                            
                                            ?>
                                        </td>
                                        
                                        <td align="left">
                                            <?php    
                                            $encontro = Encontro::buscar($objeto->getId());
                                            if($encontro->buscarSituacaoEcontro())
                                                echo "Aprovado";
                                            else{
                                                echo "Esperando aprovacao";
                                            }
                                            ?>
                                        </td>
                                        
                                        <td align="left">
                                            <?php    
                                            
                                                echo $objeto->getDataHorario();
                                            
                                            ?>
                                        </td>
                                        
                                        
                                        <td width="20%">						
                                            <?php
                                            if (Acao::checarPermissao(1, EncontroControll::MODULO)) {
                                            ?>
                                            <a href="encontro/ver/<?php echo $objeto->getId(); ?>">Ver</a> 
                                            <?php
                                            }
                                            if (Acao::checarPermissao(3, EncontroControll::MODULO)) {
                                            ?>
                                                <a href="encontro/editar/<?php echo $objeto->getId(); ?>">Editar</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(4, EncontroControll::MODULO)) {
                                            ?>    
                                                <a href="encontro/excluir/<?php echo $objeto->getId(); ?>">Excluir</a>
                                            <?php
                                            }
                                            if (Acao::checarPermissao(5, EncontroControll::MODULO)) {
                                            	?>
                                                <a href="encontro/relatorio/<?php echo $objeto->getId(); ?>">Relatorio</a>
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