<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
$(document).ready(function($){
    $('#login').focus();
    $('form').validate({
        messages: {
            login: { required: 'Digite seu email.' },
            senha: { required: 'Digite sua senha.' }
        }
    });
});
</script>
<div id="user-login" class="border">
    <form method="post" action="cadastrarUsuario">
        <ul>
            <li>
                <label for="login">Email:</label>
                <input type="text" id="login" name="login" value="" class="required" />
            </li>
            <li>
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" value="" class="required" /> <input type="submit" value=" SALVAR USUARIO " />
            </li>
        </ul>
    </form>
</div>