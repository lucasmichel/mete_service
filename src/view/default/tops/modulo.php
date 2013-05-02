<?php
header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
    $(document).ready(function($){	
        $("select#select-action").change(function(){
            window.location="modulo/" + $(this).val();
        });
    });
</script>
<div id="icon-index" class="icon32 icon-usuario-modulo"></div>
<h2>
    Módulos
    <span class="select-function">
        <select id="select-action">
        
        	<?php
            if (Acao::checarPermissao(1, ModuloControll::MODULO)) {
            ?>
            	<option <?php if (getAcaoAtual() == 'index') { ?> selected="selected" <?php } ?> value="">listar</option>
            <?php
            }
            if (Acao::checarPermissao(2, ModuloControll::MODULO)) {
            ?>
                <option <?php if (getAcaoAtual() == 'adicionar') { ?> selected="selected" <?php } ?> value="adicionar">cadastrar</option>
			<?php
            }
            if (Acao::checarPermissao(1, ModuloControll::MODULO)) {
            	if (getAcaoAtual() == 'ver') {
            ?>
                <option selected="selected" value="ver">ver</option>
			<?php
            	}
            }
            if (Acao::checarPermissao(3, ModuloControll::MODULO)) {
            	if (getAcaoAtual() == 'editar') {
            ?>
                <option selected="selected" value="editar">editar</option>
			<?php
            	}
            }
                ?>
        </select>
        <br/>
    </span>
</h2>