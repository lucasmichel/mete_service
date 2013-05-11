<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
$(document).ready(function($){
    /*$("#salvar").click(function() {
        
        //$("#form").subimt();
    });*/
    
    
});
</script>
<h2>SUBIR FOTO TESTE</h2>
<div id="user-login" class="border">
    
    <form method="post" enctype="multipart/form-data">
        <ul>            
            <li>
                <label for="email">Subir fotos</label>                                                                                
                <input type="file" class="frmCampoTexto" multiple="true" id="foto[]" name="uploadedfile" id="uploadedfile" accept="image/x-png, image/gif, image/jpeg" > 
            </li>
        </ul>
        <ul id="bts">
            <li>
                <input type="submit" class="classBt" value=" Salvar " id="salvar" name="salvar"/>
            </li>
        </ul>
    </form>
</div>