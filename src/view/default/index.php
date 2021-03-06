<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<!DOCTYPE html PUBLIC>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $this->getTitle() ?></title>
	<?php echo $this->getHtmlBase() . "\n"; ?>
	
	<!--CSS-->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="lib/js/jquery-tooltip/jquery.tooltip.css" />
	
	<!--JAVASCRIPT-->
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="lib/js/highcharts/highcharts.js"></script>
        <script type="text/javascript" src="lib/js/highcharts/modules/exporting.js"></script>
        
	<!--<script type="text/javascript" src="lib/js/jquery-1.4.2.js" ></script>-->
	<script type="text/javascript" src="lib/js/jquery.meio.mask.js"></script>
	<script type="text/javascript" src="lib/js/jquery.cpf.validate.1.0.min.js"></script>
	<script type="text/javascript" src="lib/js/jquery-validate/jquery.validate.js"></script>	
	<script type="text/javascript" src="lib/js/jquery-tooltip/jquery.tooltip.js"></script>
	<script type="text/javascript">
            $(document).ready(function(){
                $('input').setMask();
                $('.tooltip').tooltip({left: 5,top: -15,track: true,opacity: 1,showBody: ' - ',extraClass: 'tip'});
            });
	</script>
</head>

<body class="admin">

	<div id="wrap">
		<div id="content">
		
			<div id="head">				
				<img src="img/images.jpg" width="60" height="40" />
                                <h1><?php echo $this->getTitle();?></h1>
				<div id="head-info">
					<?php
						if($this->getUsuario()){
					?>
					<div id="user_info">
						<p>
							Olá, <a class="profile"><?php echo $this->getUsuario()->getLogin(); ?></a>
							<span class="turbo-nag hidden" style="display: inline;"></span>
							| <a title="Trocar senha" href="usuario/trocarSenha" class="logout" style="#464646">Trocar senha</a>
							| <a title="Sair" href="logout" class="logout">Sair</a>
						</p>
					</div>
					<?php
						}
					?>
				</div>				
			</div>
			<!--fim div head-->
			
			<div id="main">			
				<div id="popup">
					<div id="flash">
						<div id="flash" style="color:#000;">
							<?php echo $this->getFlash() . "\n";?>
						</div>						
					</div>				
				</div>
				
				<?php
					if($this->getUsuario()){
						include "menu.php";
					}
				?>
							
				<div id="main-content">
					<?php $this->getHtmlContent() . "\n"; ?>				
				</div>
				
			</div>
			<!--fim div main-->
		</div>
		<!--fim div content-->
	</div>
	<!--fim div wrap-->
	
	<div class="footer"></div>	
	
</body>
</html>