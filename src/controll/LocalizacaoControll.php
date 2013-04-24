<?php
class LocalizacaoControll extends Controll{
	const MODULO = 7;
	/**
	 * Acao index()
	 */
	public function index(){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
		// definindo a tela //
		$this->setTela('listar',array('localizacao'));
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
		$modulo = Localizacao::buscar($id);
		// jogando o usuário no atributo $dados do controlador //
		$this->setDados($modulo,'localizacao');
		// definindo a tela //
		$this->setTela('ver',array('localizacao'));
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
			$this->setTela('add',array('localizacao'));
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
			$localizacao = new Localizacao();
			$localizacao->setLatitude($dados['latitude']);
			$localizacao->setLongitude($dados['longitude']);
			$localizacao->setBairro($dados['bairro']);
			$localizacao->setCidade($dados['cidade']); 
			$localizacao->setServicoAcompanhanteId($dados['servico_acompanhante_id']);
			$localizacao->inserir();
			// setando a mensagem de sucesso //
			$this->setFlash('Localizao cadastrado com sucesso.');
			// setando a url //
			$this->setPage();
		}
	
	
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			if(isset($localizacao))
				$this->setDados($localizacao,'localizacao');
	
			if(isset($usuario))
				$this->setDados($localizacao,'localizacao');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('add',array('localizacao'));
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
		$objeto = Localizacao::buscar($id);
		// checando se o formulário nao foi passado //
		if(!$this->getDados('POST')){
			// Jogando perfil no atributo $dados do controlador //
			$this->setDados($objeto,'localizacao');
			// Definindo a tela //
			$this->setTela('editar',array('localizacao'));
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
		$objeto = Encontro::buscar($id);
		// checando se o usuário a ser excluído é diferente do logado //
	
		//ATENÇÃO
		//checar se o modulo esta sendo utilizada
	
		// excluíndo ele //
		$objeto->excluir();
		// setando mensagem de sucesso //
		$this->setFlash('Encontro excluido com sucesso.');
	
		// setando a url //
		$this->setPage();
	}
	
	/**
	 * Acao foto($id)
	 * @param $id
	 */
	public function servico($id){
		// código da ação serve para o controle de acesso//
		static $acao = 5;
		// buscando o usuário //
		$objeto = Acompanhante::buscar($id);
		// jogando o usuário no atributo $dados do controlador //
		$this->setDados($objeto,'localizacao');
		// definindo a tela //
		$this->setTela('listar',array('localizacao'));
	}
	
	
	/**
	 * Acao foto($id)
	 * @param $id
	 */
	
}

?>