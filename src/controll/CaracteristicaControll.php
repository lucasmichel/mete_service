<?php

class CaracteristicaControll extends controll {
	const MODULO = 1;
	
	/**
	 * Acao index()
	 */
	public function index(){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
		// definindo a tela //
		$this->setTela('listar',array('caracteristica'));
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
		$caracteristica = Caracteristica::buscar($id);
		// jogando o usuário no atributo $dados do controlador //
		$this->setDados($caracteristica,'VIEW');
		// definindo a tela //
		$this->setTela('ver',array('caracteristica'));
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
			$this->setTela('add',array('caracteristica'));
		} else {
			// caso passar o formulário //
			// chamando o metodo privado _add() passando os dados do post por parametro //
			$this->_add($this->getDados('POST'));
		}
	}
	
	/**
	 * Metodo _add($dados)
	 * @param $dados
	 * @return Usuario
	 */
	private function _add($dados){
		// instanciando o novo Usuário //
		$caracteristica = new Caractecristica(0,(!empty($caracteristica['nome'])) ? Perfil::buscar($dados['nome']) : null,$dados['acompanhante_id']);
		// persistindo em inserir o usuário //
		try {
			$fotos->inserir();
			// setando a mensagem de sucesso //
			$this->setFlash('Caracteristica cadastrado com sucesso.');
			// setando a url //
			$this->setPage();
		}
		// capturando a excessão CamposObrigatorios //
		catch(CamposObrigatorios $e){
			//retorna os campos prar serem preenchidos novamente
			$this->setDados($caracteristica,'caracteristica');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('add',array('caracteristica'));
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
		$caracteristica = Caractecristica::buscar($id);
		// checando se o formulário nao foi passado //
		if(!$this->getDados('POST')){
			// Jogando perfil no atributo $dados do controlador //
			$this->setDados($caracteristica,'VIEW');
			// Definindo a tela //
			$this->setTela('editar',array('caracteristica'));
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
		$caracteristica = new Fotos($caracteristica['id'],
				(!empty($dados['nome'])) ? Perfil::buscar($caracteristica['nome']) : null,
				null, 0
		);
		try {
			$caracteristica->editar();
			$this->setFlash('Caracteristica editado com sucesso');
			$this->setPage();
		}
		catch(CamposObrigatorios $e){
			$this->setFlash($e->getMessage());
			$this->setDados($fotos,'VIEW');
			$this->setTela('editar',array('caracteristicas'));
		}
	}
	
	/**
	 * Acao excluir($id)
	 * @param $id
	 */
	public function excluir($id){
		// código da ação //
		static $acao = 4;
		// buscando o usuário //
		$caracteristica = Usuario::buscar($id);
		// checando se o usuário a ser excluído é diferente do logado //
		if($caracteristica->getId() != parent::getUsuario()->getId()){
			// excluíndo ele //
			$caracteristica->excluir();
			// setando mensagem de sucesso //
			$this->setFlash('Caracteristica excluida com sucesso.');
		}
		else
			$this->setFlash('Voc� n�o pode se auto-excluir.');
		// setando a url //
		$this->setPage();
	}
}

?>