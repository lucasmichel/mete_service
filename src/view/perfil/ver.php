<?php
	$perfil = $this->getDados('VIEW');
	$modulos = array();
	foreach($perfil->getAcoes() as $acao){
		if(!in_array($acao->getModulo(),$modulos))
			$modulos[] = $acao->getModulo();
		$acoes[$acao->getModulo()->getId()][] = $acao;
	}
?>
<div class="wrap">
	<?php 
		include_once(VIEW . DS . "default" . DS . "tops" . DS . "perfil.php");
	?>
	<div id="dashboard-wrap">
		<div class="metabox">
		</div>
		<div class="clear"> </div>
		<div class="box-content">
			<div class="box">
				<div class="table">
					<h3 class="hndle">
					<span>Ver Perfil</span>
					</h3>
					<div class="inside">
						<ul class="list-cadastro">
							<li>
								<h4>Dados</h4>
								<ul>
									<li>
										<strong>Nome</strong><br />
										<?php echo $perfil->getNome();?>
									</li>
								</ul>
							</li>
						</ul>
						<ul class="list-cadastro">
							<li>
								<h4>Módulos / Ações</h4>
								<ul>
									<?php 
										foreach($modulos as $modulo){
									?>
									<li style="color:#333333;"><strong><?php echo $modulo->getNome();?></strong></li>
									<li>
										<ol>
											<?php 
												foreach($acoes[$modulo->getId()] as $acao){
											?>
											<li><?php echo $acao->getNome();?></li>
											<?php 
												}
											?>
										</ol>
									</li>
									<?php 
										}
									?>
								</ul>
							</li>
						</ul>
					<hr> </hr>
					<ul id="bts">
						<li>
							<input type="button" class="bts border" value="Voltar" onclick="location.href='voltar'" />
						</li>
					</ul>
					</div> <!--fim div inside-->
				</div><!--fim div table-->
				<div class="table-footer"></div>
			</div> <!--fim div box-->
		</div> <!--fim div box-content-->
	</div><!--fim div dashboard-wrap-->
</div><!--fim div wrap-->