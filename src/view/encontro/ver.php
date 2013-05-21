<?php
    header('Content-Type: text/html; charset=utf-8', true);
    $econtro = $this->getDados('encontro');    
    $cliente = $this->getDados('cliente');
?>
<script type="text/javascript">
    $(document).ready(function($){
    	
        //$('#email').focus();
        
        $("#selTodos").click(function() {            
            var checkedStatus = this.checked;
            if(checkedStatus){
                $(':checkbox:not(:checked)').attr('checked', 'checked');
            }
            else{
                $(':checkbox:checked').removeAttr('checked');
            }
        });
                
        $("#ok").click(function() {
            /*
        	var senha = $.trim($("#senha").val());
        	var email = $.trim($("#email").val());
        	var nome = $.trim($("#nome").val());
        	var cpf = $.trim($("#cpf").val());
        	        	
        	if(email.length <= 0){
            	alert('é necessário um email');
                $("#email").focus();
                return false;
			}
        	            
            else if(!validaEmail(email)){
            	alert('email invalido');
                $("#email").focus();
                return false;
			}
            
            else if(senha.length <= 0){
                alert('é necessário definir a senha');
                $("#senha").focus();
                return false;
            }

            else if(nome.length <= 0){
                alert('é necessário definir o nome');
                $("#nome").focus();
                return false;
            }

            else if(cpf.length <= 0){
                alert('é necessário definir o CPF');
                $("#cpf").focus();
                return false;
            }

            else if(!$('#cpf').validateCPF()){
                alert('CPF inválido!');
                $("#cpf").focus();
                return false;
            }
            
            else{
                $("#cadastro").submit();
            }*/
            $("#cadastro").submit();
        });                
                
    });
</script>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "encontro.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Ver Encontro</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">                                    
                                    
                                    <li>
                                        <label for="clienteId">Cliente</label>
                                        <select disabled="true" id="clienteId" name="clienteId" class="required">
                                            <option value="">Selecione</option>
                                            <?php
                                            try {
                                                $listaObj = Cliente::listar("nome");
                                                foreach ($listaObj as $obj) {
                                                    ?>
                                            <option <?php 
                                                    if($cliente != null)
                                                        if($cliente->getId() == $obj->getId()) {
                                                            echo "selected"; 
                                                        }
                                                    ?> value="<?php echo $obj->getId(); ?>"><?php echo $obj->getNome(); ?>
                                            </option>
                                                    <?php
                                                }
                                            } catch (ListaVazia $e) {
                                                
                                            }
                                            ?>
                                        </select>
                                    </li>
                                    
                                    <li>
                                        <label for="clienteId">Data / hora</label>
                                        <input disabled="true" type="text" id="dataHora" name="dataHora" value="<?php if($econtro != null) echo $econtro->getDataHorario();  ?>" />
                                    </li>
                                    
                                    <li>
                                        <h4>Serviços</h4>
                                        <table class="widefat fixed" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th  width="10%">Sel.Todos<input disabled type="checkbox" id="selTodos" name="selTodos" /></th>
                                                
                                                    
                                                    <th width="28%" align="right">Acompanhante</th>
                                                    <th width="28%" align="right">Serviço</th>
                                                    <th width="28%" align="right">Valor</th>
                                                    <!--<th width="20%" align="left">Ações</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            
                                                $listaServEnc = ServicosDoEncontro::listar('id');
                                            
                                                $encontro = new Encontro();
                                            
                                            
                                                $listaObj = ServicosAcompanhante::listar();
                                                foreach ($listaObj as $objeto) {
                                            ?>  
                                                <tr>
                                                    <th width="1%">
                                                        <input disabled type="checkbox" id="ids" name="ids[]" value="<?php echo $objeto->getId();?>" 
                                                            <?php
                                                                foreach ($listaServEnc as $servEnc) {
                                                                    if($servEnc->getServicosAcompanhanteId() == $objeto->getId()){
                                                                        echo 'checked = "true"';
                                                                    }
                                                                    

                                                                }
                                                            ?>       
                                                        />
                                                    </th>
                                                
                                                    <td width="28%" align="right">
                                                        <?php 
                                                            $obj = Acompanhante::buscar($objeto->getAcompanhanteId());
                                                            echo $obj->getNome(); 
                                                        ?>
                                                    </td>
                                                
                                                    <td width="28%" align="right">
                                                        <?php 
                                                            $obj = Servico::buscar($objeto->getServicoId());
                                                            echo $obj->getNome();
                                                        ?>
                                                    </td>
                                                
                                                    <td width="28%" align="right">
                                                        <?php 
                                                            echo $objeto->getValor();
                                                        ?>
                                                    </td>
                                                </tr>
                                            
                                            
                                            <?php      
                                              }
                                              //meuVarDump($listaObj);
                                            ?>
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </li>

                                </ul>
                            </fieldset>
                            <ul id="bts">
                                <li>
                                    <input type="button" class="bt-cadastro border" value=" OK " id="ok"/>
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
