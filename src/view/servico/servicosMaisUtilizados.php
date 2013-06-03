<?php 
    header('Content-Type: text/html; charset=utf-8', true); 
    $listarServicosMaisUtilizados = $this->getDados('listarServicosMaisUtilizados');
    $totalServicos = $this->getDados('totalServicos');
    //meuVarDump($listarServicosMaisUtilizados);
?>


<script type="text/javascript">
$(function () { 
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Serviços Mais Consumidos'
        },
        
        yAxis: {
            title: {
                text: 'Total de serviços utilizados: <?php echo $totalServicos;?>'
            }
        },
        series: [
            
        <?php 
           for($i = 0; $i <= count($listarServicosMaisUtilizados); $i++ ){
               $servico = $listarServicosMaisUtilizados['servico'][$i];
               $total = $listarServicosMaisUtilizados['total'][$i];
               //echo $servico->getNome(); 
               //echo $total;
               
               if($i == count($listarServicosMaisUtilizados)){
                   echo'{
                            name: \''.$servico->getNome().'\',
                            data: ['.$total.']
                        }';
               }
               else{
                    echo'{
                            name: \''.$servico->getNome().'\',
                            data: ['.$total.']
                          },';
               }
               
               
               
            }
        ?>   
        ]
    });
})





</script>


<div class="wrap">
    
    <h2><span>Serviços mais utilizados</span></h2>
    
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        
        <div class="clear"> </div>
        <div class="box-content">
            <div class="box">
                <?php                		
                /**
                 * Persistindo em listar os usuários
                 */
                try {
                    
                    
                    ?>
                    <div class="table">
                        
                        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                        <br>
                        
                        <table id="lista" class="widefat fixed">
                            <thead>
                                <tr>
                                    <th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
                                    <th width="1%"></th>
                                    <th width="28%" align="left">Serviço</th>
                                    <th width="28%" align="left">Totalr</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                for($i = 0; $i <= count($listarServicosMaisUtilizados); $i++ ){
                                
                                    ?>
                                    <tr>
                                        <th width="1%">
                                            <input type="checkbox" id="ids" name="ids[]" value="" style="visibility:hidden;"/>
                                        </th>
                                        <td width="1%"></td>
                                        <td width="28%" align="left">
                                        <?php 
                                            $servico = $listarServicosMaisUtilizados['servico'][$i];
                                            echo $servico->getNome(); 
                                        ?>
                                        </td>
                                        <td width="28%" align="left">
                                        <?php 
                                            $total = $listarServicosMaisUtilizados['total'][$i];
                                            echo $total;
                                        ?>
                                        </td>
                                        
                                        
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!--fim div table-->                    
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
