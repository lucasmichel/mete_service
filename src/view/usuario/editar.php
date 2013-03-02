<script type="text/javascript">
	$(document).ready(function($){
		$('form').validate( {
			messages: {
				login: { required: 'Digite um nome' },
				senha: { required: 'Digite uma senha' },
				perfil: { required: 'Selecione um perfil' }
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
						<span>Editar Usuário</span>
					</h3>
					<div class="inside">
						<form method="post">
							<input type="hidden" id="id" name="id" value="<?php echo $usuario->getId();?>" />
							<fieldset>
								<legend>Dados</legend>
								<ul class="list-cadastro">
									<li>
										<label for="login">Login</label>
										<input type="text" id="login" name="login" value="<?php echo $usuario->getLogin();?>" class="required" />
									</li>
									<li>
										<label for="senha">Senha</label>
										<input type="password" id="senha" name="senha" value="" class="required" />
									</li>
									<li>
										<label for="perfil">Perfil</label>
										<select id="perfil" name="perfil" class="required" >
											<option value="">Selecione</option>
											<?php 
												try {
													$perfis = Perfil::listar();
													foreach($perfis as $perfil){
														$select = ($usuario->getPerfil()->getId() == $perfil->getId()) ? "selected='selected'" : '';
											?>
											<option <?php echo $select;?> value="<?php echo $perfil->getId();?>"><?php echo $perfil->getNome();?></option>
											<?php 
													}
												}
												catch(ListaVazia $e){}
											?>
										</select>
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