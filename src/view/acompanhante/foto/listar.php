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
                        <form method="post" id="cadastro" enctype="multipart/form-data" action="acompanhante/fotoAdd">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">
                                                                    
                                    <li>
                                        <label for="email">Foto</label>
                                        <!-- <input type="file" id="foto" name="foto" multiple accept="image/*"/>-->
                                        <input type="file" id="foto" name="foto" multiple accept="image/*"/>
                                    </li>
                                </ul>
                            </fieldset>
                            <ul id="bts">
                                <li>
                                    <input type="button" class="classBt" value=" OK " id="ok"/>
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