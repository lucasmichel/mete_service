<?php
class  ModuloControll extends Controll{
	
	const MODULO = 3;
	
	public function acaoListar($id){
		// código da ação serve para o controle de acesso//
		static $acao = 5;
		// definindo a tela //
	
		$modulo = Modulo::buscar($id);
		$this->setDados($modulo,'modulo');
		$this->setTela('listar',array('modulo/acao'));
		// guardando a url //
		$this->getPage();
	}
	
	
	public function acaoVer($codigoAcao,$idModulo){
		// código da ação serve para o controle de acesso//
		static $acao = 5;
		// definindo a tela //
	
		$modulo = Modulo::buscar($codigoAcao,$idModulo);
		$this->setDados($modulo,'modulo');
		$this->setTela('ver',array('modulo'));
		// guardando a url //
		$this->getPage();
	}
	
	public function acaoAdd($id){		
		// código da ação serve para o controle de acesso//
		static $acao = 6;
		// checando se o formulário nao foi passado //
		
		if(!$this->getDados('POST')) {
			//  definindo a  tela //
			$modulo = Modulo::buscar($id);
			$this->setDados($modulo,'modulo');
			$this->setTela('add',array('modulo/acao'));
		} else {
			// caso passar o formulário //
			// chamando o metodo privado _add() passando os dados do post por parametro //
			$this->_acaoAdd($this->getDados('POST'));
		}
		
	}
	
	
	private function _acaoAdd($dados){
			
		// persistindo em inserir o usuário //
		try {
			
			$modulo = Modulo::buscar($dados['idModulo']);
			
			$acao = new Acao();
			$acao->setCodigoAcao(trim($dados['codigoAcao']));
			$acao->setNome($dados['nome']);
			$acao->setModulo($modulo);
			
			$acao->inserir();
			// setando a mensagem de sucesso //
			$this->setFlash('Ação do módulo '.$modulo->getNome().' cadastrada com sucesso.');
			// setando a url //
			$this->setPage();
		}
	
	
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			if(isset($modulo))
				$this->setDados($modulo,'modulo');
	
			if(isset($acao))
				$this->setDados($acao,'acao');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('add',array('modulo/acao'));
		}
	}
	
	
	
	public function acaoEditar($codigoAcao,$idModulo){
		// código da ação serve para o controle de acesso//
		static $acao = 7;
		
		if(!$this->getDados('POST')) {
		
			// definindo a tela //
			$acao = Acao::buscar($codigoAcao,$idModulo);
			$modulo = Modulo::buscar($idModulo);
			
			$this->setDados($acao,'acao');
			$this->setDados($modulo,'modulo');
			
			$this->setTela('editar',array('modulo/acao'));
			// guardando a url //
			$this->getPage();
		}
		else{
			// caso passar o formulário //
			// chamando o metodo privado _add() passando os dados do post por parametro //
			$this->_acaoEditar($this->getDados('POST'));
		}
		
	}
	
	
	
	private function _acaoEditar($dados){
		// persistindo em inserir o usuário //
		try {
			
			$modulo = Modulo::buscar($dados['idModulo']);
			
			$acao = new Acao();
			$acao->setId(trim($dados['idAcao']));
			$acao->setCodigoAcao(trim($dados['codigoAcao']));
			$acao->setNome(trim($dados['nome']));
			$acao->setModulo($modulo);
			$acao->editar();
			
			// setando a mensagem de sucesso //
			$this->setFlash('Ação do módulo '.$modulo->getNome().' editada com sucesso.');
			// setando a url //
			$this->setPage();
		}
	
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			if(isset($modulo))
				$this->setDados($modulo,'modulo');
	
			if(isset($acao))
				$this->setDados($acao,'acao');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('editar',array('modulo/acao'));
		}
	}
	
	
	public function acaoExcluir($codigoAcao,$idModulo){
		// código da ação serve para o controle de acesso//
		static $acao = 8;		
		// buscando o usuário //
		$acao = Acao::buscar($codigoAcao,$idModulo);		
		$acao->excluir();
		// setando mensagem de sucesso //
		$this->setFlash('Ação excluída com sucesso.');
		// setando a url //
		$this->setPage();		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
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
			
			
			
			$modulo = new Modulo();
			$modulo->setNome($dados['nome']);
			$modulo->setLink(retiraAcentos(mb_strtolower( $dados['nome'], 'UTF-8' )));
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
	
	
	private function _editar($dados){
			
		// persistindo em inserir o usuário //
		try {
			$modulo = new Modulo();
			$modulo->setId($dados['id']);
			$modulo->setNome($dados['nome']);
			$modulo->setLink(retiraAcentos(mb_strtolower( $dados['nome'], 'UTF-8' )));
			$modulo->editar();
			// setando a mensagem de sucesso //
			$this->setFlash('Modulo editado com sucesso.');
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
	 * Acao excluir($id)
	 * @param $id
	 */
	public function excluir($id){
		// código da ação //
		static $acao = 4;
		
		
		// persistindo em inserir o usuário //
		try {
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
		
		
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			if(isset($modulo))
				$this->setDados($modulo,'modulo');
		
			if(isset($usuario))
				$this->setDados($modulo,'modulo');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setPage();
		}
		
	}
	
}

?>