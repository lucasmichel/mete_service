<?php
class  AcaoControll extends controll{
	
	const MODULO = 9;
	/**
	 * Acao index()
	 */
	public function index(){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
		// definindo a tela //
		$this->setTela('listar',array('acao'));
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
		$ac = Acao::buscar($id);
		// jogando o usuário no atributo $dados do controlador //
		$this->setDados($ac,'acao');
		// definindo a tela //
		$this->setTela('ver',array('acao'));
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
			$this->setTela('add',array('acao'));
		} else {
			// caso passar o formulário //
			// chamando o metodo privado _add() passando os dados do post por parametro //
			$this->_add($this->getDados('POST'));
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
		$objeto = Acao::buscar($id);
		// checando se o formulário nao foi passado //
		if(!$this->getDados('POST')){
			// Jogando perfil no atributo $dados do controlador //
			$this->setDados($objeto,'acao');
			// Definindo a tela //
			$this->setTela('editar',array('acao'));
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
		$objeto = Acao::buscar($id);
		// checando se o usuário a ser excluído é diferente do logado //
		
		//ATENÇÃO
		//checar se a ação esta sendo utilizada
		
		// excluíndo ele //
		$objeto->excluir();
		// setando mensagem de sucesso //
		$this->setFlash('Acao excluído com sucesso.');
	
		// setando a url //
		$this->setPage();
	}
	
}

?>