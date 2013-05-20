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
        
        
        
        if(($modulo->getLink() != "acao")&&
            ($modulo->getLink() != "modulo")&&
            ($modulo->getLink() != "usuario")&&			 
            ($modulo->getLink() != "perfil")){
        

			$classname = $modulo->getLink() . "Controll";
                        
            if(class_exists($classname)){
                        
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
	    }else{
                
                ?>
                    <li>
	                <div class="menu-image icon-home"> </div>
	                <div class="menu-toggle"><br/> </div>
	                <span class="tooltip" title="<?php echo "Falta criar o controlador de :".$modulo->getNome();?>">
                            <a class="menu-top-first menu-iten" tabindex="1" href="#">
                                <?php echo "ERRRO: ".$modulo->getLink() . "Controll não encontrado"?>
                            </a>
	                </span>
	            </li>
                <?php
                
                
            }	
        }
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>
<!-- <li>
    <a class="menu-top-first menu-botton" tabindex="1" ></a>
</li>-->

<?php 
	$control = Controll::getControll();
	$usuario = $control->getUsuario();
	
	if($usuario->getPerfil()->getId() ==1){
?>

<li>
    
    <a class="menu-top-first " tabindex="1" >ADMINISTRAÇÃO</a>
    	
    
</li>



<?php
try{
    $modulos = Modulo::listar();
     
    
    foreach($modulos as $modulo) {
        
    	
        
        if(($modulo->getLink() == "acao")||
        ($modulo->getLink() == "modulo")||
        ($modulo->getLink() == "usuario")|| 
        ($modulo->getLink() == "perfil")){
        
			$classname = $modulo->getLink() . "Controll";
            if(class_exists($classname)){
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
                else{
                
                    ?>
                        <li>
                            <div class="menu-image icon-home"> </div>
                            <div class="menu-toggle"><br/> </div>
                            <span class="tooltip" title="<?php echo "Falta criar o controlador de :".$modulo->getNome();?>">

                                <a class="menu-top-first menu-iten" tabindex="1" href="#">
                                    <?php echo "ERRRO: ".$modulo->getLink() . "Controll não encontrado"?>
                                </a>
                                    
                            </span>
                        </li>
                    <?php
                }
	    }
        }
    
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>




<?php 
}
?>

<li>
    <div class="menu-image icon-home"> </div>
    <div class="menu-toggle"><br/> </div>
    <span class="tooltip" title="Sair"><a class="menu-top-first menu-botton" tabindex="1" href="logout">Sair</a></span>
</li>

</ul>
