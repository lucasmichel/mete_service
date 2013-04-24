<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
	$(document).ready(function($){
		$("#senhaAtual").focus();
	});

	function validarCamposObrigatorios(){
		if(($.trim($("#senhaAtual").val()) == '')||($.trim($("#novaSenha").val()) == '')||($.trim($("#confirmarNovaSenha").val()) == '')){
			jAlert('Preencha os campos obrigatórios.','Alerta');
			return false;
		}
		if($("#novaSenha").val() != $("#confirmarNovaSenha").val()){
			jAlert("Nova senha e confirmação estão diferentes.","Alerta");
			return false;
		}
		return true;
	}
</script>
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
						<span>Trocar Senha</span>
					</h3>
					<div class="inside">
						<form id="trocarSenha" name="trocarSenha" method="post" onSubmit="return validarCamposObrigatorios();">
							<fieldset>
								<legend>Dados</legend>
								<ul class="list-cadastro">
									<li>
										<label for="senhaAtual">Senha Atual</label>
										<input type="password" id="senhaAtual" name="senhaAtual" value="" />
									</li>
									<li>
										<label for="novaSenha">Nova Senha</label>
										<input type="password" id="novaSenha" name="novaSenha" value="" />
									</li>
									<li>
										<label for="confirmarNovaSenha">Confirme a Nova Senha</label>
										<input type="password" id="confirmarNovaSenha" name="confirmarNovaSenha" value="" />
									</li>
								</ul>
							</fieldset>
							<ul id="bts">
								<li>
									<input type="submit" class="bt-cadastro border" value=" OK " />
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