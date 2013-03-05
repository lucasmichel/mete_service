<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<!DOCTYPE html PUBLIC >
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Idealizza Sistemas</title>
	<style type="text/css">
		body {
			background-color: #8BA23C
		}
		div#aviso {
			margin-top: 80px;
			padding-top: 30px;
			padding-bottom: 30px;
			text-align: center;
			background-color: #fff;			
		}
		div#mensagem {
			padding-top: 50px;
			background-color: #8BA23C;
			color: #fff;
			text-align: center;
			font-family: sans-serif;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div id="aviso">
		<img src="img/logo_idealizza.png" title="Idealizza"/>
	</div>
	<div id="mensagem">
		<?php 
			if(!empty($GLOBALS["erro"]["msg"]))
				echo $GLOBALS["erro"]["msg"];
			if(!empty($GLOBALS['erro']['hora_publicacao']))
				echo " (Previsão de retorno: " . $GLOBALS['erro']['hora_publicacao'] . ")";
		?>		
	</div>	
</body>
</html>