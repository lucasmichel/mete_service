<?php
class  ModuloControll extends Controll{
	
	const MODULO = 8;
	/**
	 * Acao index()
	 */
	public function index(){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
		// definindo a tela //
		$this->setTela('listar',array('modulo'));
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
		$modulo = Modulo::buscar($id);
		// jogando o usuário no atributo $dados do controlador //
		$this->setDados($modulo,'modulo');
		// definindo a tela //
		$this->setTela('ver',array('modulo'));
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
			$this->setTela('add',array('modulo'));
		} else {
			// caso passar o formulário //
			// chamando o metodo privado _add() passando os dados do post por parametro //
			$this->_add($this->getDados('POST'));
		}
	}
	
	/**
	 * Metodo _add($dados)
	 * @param $dados
	 * @return modulo
	 */
	private function _add($dados){
		 
		// persistindo em inserir o usuário //
		try {
			$modulo = new Servico();
			$modulo->setNome($dados['nome']);
			$modulo->setLink($dados['link']);
			$modulo->inserir();
			// setando a mensagem de sucesso //
			$this->setFlash('Modulo cadastrado com sucesso.');
			// setando a url //
			$this->setPage();
			}
	
		
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			if(isset($modulo))
				$this->setDados($modulo,'modulo');
	
			if(isset($usuario))
				$this->setDados($modulo,'modulo');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('add',array('modulo'));
		}
	}
	
	
	/**
	 * Acao editar($id)
	 * @param $id
	 */
	public function editar($id){
		// código da ação //
		static $acao = 3;
		// Buscando o usuário //
		$objeto = Modulo::buscar($id);
		// checando se o formulário nao foi passado //
		if(!$this->getDados('POST')){
			// Jogando perfil no atributo $dados do controlador //
			$this->setDados($objeto,'modulo');
			// Definindo a tela //
			$this->setTela('editar',array('modulo'));
		}
		// caso passar o formulario //
		else
			// chamando o metodo privado _editar() passando os dados do post por parametro //
			$this->_editar($this->getDados('POST'));
	}
	
	/**
	 * Acao excluir($id)
	 * @param $id
	 */
	public function excluir($id){
		// código da ação //
		static $acao = 4;
		// buscando o usuário //
		$objeto = modulo::buscar($id);
		// checando se o usuário a ser excluído é diferente do logado //
	
		//ATENÇÃO
		//checar se o modulo esta sendo utilizada
		
		// excluíndo ele //
		$objeto->excluir();
		// setando mensagem de sucesso //
		$this->setFlash('Modulo excluído com sucesso.');
	
		// setando a url //
		$this->setPage();
	}
	
}

?>