<?php


class  ServicoControll extends Controll{
	const MODULO = 1;
	
	/**
	 * Acao index()
	 */
	public function index(){
		// código da ação serve para o controle de acesso//
		static $acao = 3;
		// definindo a tela //
		$this->setTela('listar',array('servico'));
		// guardando a url //
		$this->getPage();
	}
	/**
	 * Acao ver($id)
	 * @param $id
	 */
	public function ver($id){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
		// buscando o usuário //
		$objeto = Servico::buscar($id);
		// jogando o usuário no atributo $dados do controlador //
		$this->setDados($objeto,'VIEW');
		// definindo a tela //
		$this->setTela('ver',array('servico'));
	}
	/**
	 * Acao add()
	 */
	public function add() {
		// código da ação serve para o controle de acesso//
		static $acao = 2;
		// checando se o formulário nao foi passado //
		if(!$this->getDados('POST')) {
			//  definindo a  tela //
			$this->setTela('add',array('servico'));
		} else {
			// caso passar o formulário //
			// chamando o metodo privado _add() passando os dados do post por parametro //
			$this->_add($this->getDados('POST'));
		}
	}
	
	private function _add($dados){
		 
		// persistindo em inserir o usuário //
		try {
	
			// instanciando o novo Usuário //
			$servico = new Servico(0,
					/*2 por padrão é o perfil da garota*/
					Perfil::buscar(2),
					trim($dados['nome']));
								 
			//$servico = new Servico(trim($dados['nome']));
				
			 
			$servico->inserir();
	
			/*agora set o id du usuario na acompanhante*/
			$servico->setUsuarioId($servico->getId());
			//$servico->setUsuarioIdPerfil($servico->getPerfil()->getId());
	
			$servico->inserir();
	
			// setando a mensagem de sucesso //
			$this->setFlash('Servico cadastrada com sucesso.');
			// setando a url //
			$this->setPage();
		}
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			if(isset($acompanhante))
				$this->setDados($servico,'servico');
	
			if(isset($servico))
				$this->setDados($servico,'servico');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('add',array('servico'));
		}
	}
	
	/**
	 * Acao editar($id)
	 * @param $id
	 */
	public function editar($id){
		// código da ação //
		static $acao = 2;
		// Buscando o usuário //
		$objeto = Servico::buscar($id);
		// checando se o formulário nao foi passado //
		if(!$this->getDados('POST')){
			// Jogando perfil no atributo $dados do controlador //
			$this->setDados($objeto,'VIEW');
			// Definindo a tela //
			$this->setTela('editar',array('servico'));
		}
		// caso passar o formulario //
		else
			// chamando o metodo privado _editar() passando os dados do post por parametro //
			$this->_editar($this->getDados('POST'));
	}
	
	/**
	 * Metodo _editar($dados)
	 * @param $dados
	 * @return Usuario
	 */
	private function _editar($dados){
		$servico = new Servico(
				$dados['id'],
				(!empty($dados['nome'])) ? Perfil::buscar($dados['nome']) : null);
		try {
			$servico->editar();
			$this->setFlash('servico editado com sucesso');
			$this->setPage();
		}
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			$this->setDados($servico,'servico');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('add',array('servico'));
		}
	}
	
	/**
	 * Acao excluir($id)
	 * @param $id
	 */
	public function excluir($id){
		// código da ação //
		static $acao = 2;
		// buscando o usuário //
		$objeto = Servico::buscar($id);
		// checando se o usuário a ser excluído é diferente do logado //
		if($objeto->getId() != parent::getUsuario()->getId()){
			// excluíndo ele //
			$objeto->excluir();
			// setando mensagem de sucesso //
			$this->setFlash('servico excluido com sucesso.');
		}
		else
			$this->setFlash('Voce n�oo pode se auto-excluir.');
		// setando a url //
		$this->setPage();
	}
}
?>