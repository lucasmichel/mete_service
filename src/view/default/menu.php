<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<ul id="nav">
<li>
    <div class="menu-image icon-home"> </div>
    <div class="menu-toggle"><br/> </div>
    <span class="tooltip" title="Início">
            <a class="menu-top-first menu-top" tabindex="1" href="">Início</a>
    </span>
</li>
<?php
try{
    $modulos = Modulo::listar();
    foreach($modulos as $modulo) {
        $classname = $modulo->getLink() . "Controll";
        if(Acao::checarPermissao(1, $classname::MODULO)){
        ?>
            <li>
                <div class="menu-image icon-home"> </div>
                <div class="menu-toggle"><br/> </div>
                <span class="tooltip" title="<?php echo $modulo->getNome() ?>">

                <a class="menu-top-first menu-iten" tabindex="1" href="<?php echo $modulo->getLink() ?>">
                        <?php echo $modulo->getNome() ?></a>
                </span>
            </li>
        <?php
        }
    }

}catch(ListaVazia $e){}
?>
<li>
    <div class="menu-image icon-home"> </div>
    <div class="menu-toggle"><br/> </div>
    <span class="tooltip" title="Sair"><a class="menu-top-first menu-botton" tabindex="1" href="logout">Sair</a></span>
</li>
</ul>
