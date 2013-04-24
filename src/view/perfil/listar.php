<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<div class="wrap">
	<?php 
		include_once(VIEW . DS . "default" . DS . "tops" . DS . "perfil.php");
	?>
	<div id="dashboard-wrap">
		<div class="metabox"></div>
		<!-- <div class="filtros">
			<span class="select-all">
				<SELECT NAME="function">
					<OPTION VALUE="excluir">excluir todos</OPTION>
					<OPTION VALUE="movimentar">movimentar todos</OPTION>
				</SELECT>
				<br/>
			</span>
			<span class="select-all">
				<SELECT NAME="function">
					<OPTION VALUE="excluir">excluir todos
					<OPTION VALUE="movimentar">movimentar todos
				</SELECT>
				<br/>
			</span>
			<span class="select-all busca">
				<input type="text" value="Buscar..." />
				<input type="button" value="ir"/>
				<br/>
			</span>
		</div> --><!-- fim div filtro-->
		<div class="clear"> </div>
		<div class="box-content">
			<div class="box">
				<?php
					/**
					 * Persistindo em listar os perfis
					 */	
					try {
						$perfis = Perfil::listar();
						$paginacao = new Paginacao($perfis,20);
				?>
				<div class="table">
					<table class="widefat fixed">
						<thead>
							<tr>
								<th width="1%"><input type="checkbox" id="all" style="visibility:hidden;"/></th>
								<th width="1%"></th>
								<th width="78%" align="left">Nome</th>
								<th width="20%" align="left">Ações</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							foreach($paginacao->getDados() as $perfil){
						?>
							<tr>
								<th width="1%">
									<input type="checkbox" id="ids" name="ids[]" value="" style="visibility:hidden;"/>
								</th>
								<td width="1%"></td>
								<td width="78%" align="left"><?php echo $perfil->getNome();?></td>
								<td width="20%">						
									<a href="perfil/ver/<?php echo $perfil->getId();?>">Ver</a> 
									<?php 
										if(Acao::checarPermissao(2,PerfilControll::MODULO)){
									?>
									<a href="perfil/editar/<?php echo $perfil->getId();?>">Editar</a> 
									<a href="perfil/excluir/<?php echo $perfil->getId();?>">Excluir</a>
									<?php 
										}
									?>
								</td>
							</tr>
						<?php 
							}
						?>
						</tbody>
					</table>
				</div><!--fim div table-->
				<div class="table-footer">
					<span class="page"><?php echo $paginacao->getLinks();?></span>
				</div>
				<?php 
					}
					catch(ListaVazia $e){
				?>
				<div class="exception">
					<?php echo $e->getMessage();?>
				</div>
				<?php
					}
				?>
			</div> <!--fim div box-->
		</div> <!--fim div box-content-->
	</div><!--fim div dashboard-wrap-->
</div><!--fim div wrap-->