<?php


class  ServicoControll extends Controll{
	const MODULO = 6;
	
	/**
	 * Acao index()
	 */
	public function index(){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
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
		$this->setDados($objeto,'servico');
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
			$servico = new Servico();
			$servico->setNome($dados['nome']);
			$servico->inserir();
			// setando a mensagem de sucesso //
			$this->setFlash('Serviço cadastrado com sucesso.');
			// setando a url //
			$this->setPage();
		}
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
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
		static $acao = 3;

		$objeto = Servico::buscar($id);
		// checando se o formulário nao foi passado //
		if(!$this->getDados('POST')){
			// Jogando perfil no atributo $dados do controlador //
			$this->setDados($objeto,'servico');
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
		try {
			
			$servico = new Servico();
			$servico->setId($dados['idServico']);
			$servico->setNome($dados['nome']);			
			$servico->editar();
			$this->setFlash('serviço editado com sucesso');
			$this->setPage();
		}
		catch (Exception $e) {
			//retorna os campos prar serem preenchidos novamente
			$this->setDados($servico,'servico');
			// setando a mensagem de excessão //
			$this->setFlash($e->getMessage());
			// definindo a tela //
			$this->setTela('editar',array('servico'));
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
		$objeto = Servico::buscar($id);
		
		$objeto->excluir();
		// setando mensagem de sucesso //
		$this->setFlash('serviço excluido com sucesso.');
		
		$this->setPage();
	}
        
        
	/**
	 * Acao excluir($id)
	 * @param $id
	 */
	public function servicosMaisUtilizados(){
            $servico = new Servico();
            $listarServicosMaisUtilizados = $servico->listarServicosMaisUtilizados();            
            // jogando o usuário no atributo $dados do controlador //
            
            $totalServicos = ServicosDoEncontro::totalDeServicos();
            
            $this->setDados($listarServicosMaisUtilizados,'listarServicosMaisUtilizados');
            $this->setDados($totalServicos,'totalServicos');
            // definindo a tela //
            $this->setTela('servicosMaisUtilizados',array('servico'));
	}
}
?>