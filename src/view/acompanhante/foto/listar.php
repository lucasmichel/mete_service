<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $acompanhante = $this->getDados('acompanhante');
    $usuario = $this->getDados('usuario');
?>
<script type="text/javascript">
    $(document).ready(function($){
        $("#ok").click(function() {
            $("#cadastro").submit();
        });                
                
                
    });
</script>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "acompanhanteFoto.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Fotos da Acompanhante</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro" enctype="multipart/form-data" action="acompanhante/adicionarFoto/<?php echo $acompanhante->getId();?>">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">

                                    <li>
                                        <label for="email">Subir fotos</label>                                                                                
                                        <input type="file" class="frmCampoTexto" multiple="true" id="foto[]" name="foto[]" accept="image/x-png, image/gif, image/jpeg" > 
                                    </li>
                                </ul>
                            </fieldset>
                        
                            
                        <br />
                                               
                            
                            <fieldset>
                                <legend>Fotos existentes na galeria:</legend>

                                <table width="100%" border="0" align="center" cellspacing="0">
                                    <tr>
                                            
                                        
                                        
                                        <?
                                            try {
                                                
                                                $cont = 0;
                                                $contaLinha = 0;

                                                $fotos = Fotos::listarPorIdAcompanhante($acompanhante->getId());

                                                foreach ($fotos as $foto) {
                                                    
                                                    $contaLinha++;
                                            ?>


                                                <td style="padding: 10px;">        

                                                    <p align="center"> 
                                                        <?php
                                                        //$pastas = explode("/", $foto->getNome());
                                                        
                                                        //$caminho = "/".$pastas[4]."/".$pastas[5]."/".$pastas[6]."/".$pastas[7]."/".$pastas[8];
                                                        ?>

                                                        <img src="<?php echo BASE.'/img/foto/'.$foto->getNome();?>" width="150" height="150" />
                                                        <br />
                                                        <input type="checkbox" name="idFoto[]" value="<?php echo $foto->getId();?>" >Excluir foto?

                                                    </p>
                                                </td>

                                             <? 
                                                    if($contaLinha == 5 ){
                                                        echo'</tr><tr>';
                                                        $contaLinha = 0;
                                                    }    $cont++;    
                                                }
                                        }
                                        
                                        catch (Exception $e){
                                            echo '
                                            <div class="exception">
                                                '.$e->getMessage().'
                                            </div>
                                            ';
                                            
                                        }
                                        
                                        ?>
                                        
                                        
                                        
                                    </tr>
                                </table>
                            </fieldset>
                            
                            
                            <ul id="bts">
                                <li>
                                    <input type="button" class="classBt" value=" Salvar alteração " id="ok"/>
                                </li>
                            </ul>
                        </form>
                    </div><!--fim div inside-->
                </div><!--fim div table-->
                <div class="table-footer"></div>
            </div><!--fim div box-->
        </div><!--fim div box-content-->
    </div><!--fim div dashboard-wrap-->
</div><!--fim div wrap-->