<?php
header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
    $(document).ready(function($){	
        $("select#select-action").change(function(){
            window.location="encontro/" + $(this).val();
        });
    });
</script>
<div id="icon-index" class="icon32 icon-usuario-modulo"></div>
<h2>
   Encontro
    <span class="select-function">
        <select id="select-action">
            <option <?php if (getAcaoAtual() == 'index') { ?> selected="selected" <?php } ?> value="">listar</option>
            <?php
            if (Acao::checarPermissao(2, EncontroControll::MODULO)) {
                ?>
                <option <?php if (getAcaoAtual() == 'add') { ?> selected="selected" <?php } ?> value="add">cadastrar</option>
                <?php
            }
            if (getAcaoAtual() == 'ver') {
                ?>
                <option selected="selected" value="ver">ver</option>
                <?php
            }
            if (getAcaoAtual() == 'editar') {
                ?>
                <option selected="selected" value="editar">editar</option>
                <?php
            }
                ?>
        </select>
        <br/>
    </span>
</h2>
