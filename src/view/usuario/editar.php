<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
    $(document).ready(function($){
        $('#login').focus();
        /*$('form').validate( {
            messages: {
                login: { required: 'Digite um nome' },
                senha: { required: 'Digite uma senha' },
                perfil: { required: 'Selecione um perfil' }
            }
        });*/
                
        $("#ok").click(function() {
            if($("#login").val()==""){
                alert('é necessário definir o login');
                $("#login").focus();
                return false;
            }
            else if($("#senha").val()==""){
                alert('é necessário definir a senha');
                $("#senha").focus();
                return false;
            }
            else if($("#email").val()==""){
                alert('é necessário definir o email');
                $("#email").focus();
                return false;
            }
            else if($("#perfil").val()==""){
                alert('é necessário definir o perfil');
                $("#perfil").focus();
                return false;
            }
            else{
                $("#cadastro").submit();
            }
            
          
        });                
                
                
    });
</script>
<?php 
	$usuario = $this->getDados('VIEW');
?>
<div class="wrap">
    <?php
    include_once(VIEW . DS . "default" . DS . "tops" . DS . "usuario.php");
    ?>
    <div id="dashboard-wrap">
        <div class="metabox"></div>
        <div class="clear"></div>
        <div class="box-content">
            <div class="box">
                <div class="table">
                    <h3 class="hndle">                        
                        <span>Cadastrar Usuário</span>
                    </h3>
                    <div class="inside">
                        <form method="post" id="cadastro">
                            <input type="hidden" id="id" name="id" value="<?php if($usuario != null) echo $usuario->getId();  ?>" />
                                   
                            
                            <fieldset>
                                <legend>Dados</legend>
                                <ul class="list-cadastro">
                                    <li>
                                        <label for="login">Login</label>
                                        <input type="text" id="login" name="login" value="<?php if($usuario != null) echo $usuario->getLogin();  ?>" class="required" />
                                    </li>
                                    <li>
                                        <label for="senha">Senha</label>
                                        <input type="password" id="senha" name="senha" value="" class="required" />
                                    </li>
                                    <li>
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" value="<?php if($usuario != null) echo $usuario->getEmail();  ?>" class="required" />
                                    </li>
                                    <li>
                                        <label for="perfil">Perfil</label>
                                        <select id="perfil" name="perfil" class="required">
                                            <option value="">Selecione</option>
                                            <?php
                                            if($usuario!=null){
                                                $idPerfil = $usuario->getPerfil()->getId();
                                            }
                                            else {
                                                $idPerfil = null;
                                            }
                                            try {
                                                $perfis = Perfil::listar();
                                                foreach ($perfis as $perfil) {
                                                    ?>
                                            <option <?php if($idPerfil == $perfil->getId()) {
                                                        echo "selected"; 
                                                    }
                                                    ?> value="<?php echo $perfil->getId(); ?>"><?php echo $perfil->getNome(); ?>
                                            </option>
                                                    <?php
                                                }
                                            } catch (ListaVazia $e) {
                                                
                                            }
                                            ?>
                                        </select>
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