<?php
/**
 * Classe UsuarioControll
 * Controlador do modulo de usuários
 * @package controll
 */
class AvaliacaoControll extends Controll {

    /**
     * Constante referente ao número do modulo serve para o controle de acesso
     */
    const MODULO = 9;

    /**
     * Acao index()
     */
    public function index(){
        // código da ação serve para o controle de acesso//
        static $acao = 1;
        // definindo a tela //
        $this->setTela('listar',array('avaliacao'));
        // guardando a url //
        $this->getPage();
    }
    
    
    
    public function visualizarAvaliacao($id){
    	//meuVarDump("teste");
    	static $acao = 1;
 	// buscando o usuário //
 	$avaliacao = Avaliacao::buscar($id);
 	// jogando o usuário no atributo $dados do controlador //
 	$this->setDados($avaliacao,'avaliacao');
 	// definindo a tela //
 	$this->setTela('ver',array('avaliacao'));
    }

    /**
     * Acao ver($id)
     * @param $id
     */
 public function ver($id){
 	// código da ação serve para o controle de acesso//
 	static $acao = 1;
 	// buscando o usuário //
 	$avaliacao = Avaliacao::buscar($id);
 	// jogando o usuário no atributo $dados do controlador //
 	$this->setDados($avaliacao,'avaliacao');
 	// definindo a tela //
 	$this->setTela('ver',array('avaliacao'));
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
            $this->setTela('add',array('avaliacao'));
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
    	// persistindo em inserir o usuário //
    try {
 		$avaliacao = new Avaliacao();
 		//meuVarDump($dados);
 		$avaliacao->setNota($dados['nota']);
 		$avaliacao->setAcompanhanteId($dados['acompanhanteId']);
 		$avaliacao->setClienteId($dados['clienteId']);
 		$avaliacao->inserir();
 		// setando a mensagem de sucesso //
 		$this->setFlash('Avaliacao cadastrado com sucesso.');
 		// setando a url //
 		$this->setPage();
 	}
 
 
 	catch (Exception $e) {
 		//retorna os campos prar serem preenchidos novamente
 		if(isset($avaliacao))
 			$this->setDados($avaliacao,'avaliacao');
                // setando a mensagem de excessão //
 		$this->setFlash($e->getMessage());
 		// definindo a tela //
 		$this->setTela('add',array('avaliacao'));
 	}
    }

    /**
     * Acao editar($id)
     * @param $id
     */
    public function editar($id){
    	//meuVarDump($id);
        // código da ação //
    static $acao = 3;
 	// Buscando o usuário //
 	$objeto = Avaliacao::buscar($id);
 	// checando se o formulário nao foi passado //
 	if(!$this->getDados('POST')){
 		// Jogando perfil no atributo $dados do controlador //
 		$this->setDados($objeto,'avaliacao');
 		// Definindo a tela //
 		$this->setTela('editar',array('avaliacao'));
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
    	// persistindo em inserir o usuário //
    	try {
 		//meuVarDump($dados['id']);
 		$avaliacao = new Avaliacao();
 		$avaliacao->setNota($dados['nota']);
 		$avaliacao->setId($dados['id']);
 		$avaliacao->setClienteId($dados['clienteId']);
 		$avaliacao->setAcompanhanteId($dados['acompanhanteId']);
 		//$comentario->setNome($dados['comentario_id']);
 		//$comentario->getCliente_id($dados['cliente_id']);
 		//$comentario->setAcompanhante_id($dados['acompanhante_id']);
 		$avaliacao->editar();
 		// setando a mensagem de sucesso //
 		$this->setFlash('Avaliacao alterado com sucesso.');
 		// setando a url //
 		$this->setPage();
 	}
 
 
 	catch (Exception $e) {
 		//retorna os campos prar serem preenchidos novamente
 		if(isset($avaliacao))
 			$this->setDados($avaliacao,'avaliacao');
 
 		// setando a mensagem de excessão //
 		$this->setFlash($e->getMessage());
 		// definindo a tela //
 		$this->setTela('add',array('avaliacao'));
 	}
    }

    /**
     * Acao excluir($id)
     * @param $id
     */
    public function excluir($id){
      static $acao = 4;
 	// buscando o usuário //
 	$objeto = Avaliacao::buscar($id);
 	// checando se o usuário a ser excluído é diferente do logado //
 
 	//ATENÇÃO
 	//checar se o modulo esta sendo utilizada
 
 	// excluíndo ele //
 	$objeto->excluir();
 	// setando mensagem de sucesso //
 	$this->setFlash('Avaliacao excluido com sucesso.');
 
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
    	$this->setDados($objeto,'acompanhante');
    	// definindo a tela //
    	$this->setTela('servico',array('acompanhante'));
    }
    
    
    /**
     * Acao foto($id)
     * @param $id
     */
    public function foto($id){
    	// código da ação serve para o controle de acesso//
    	static $acao = 6;
    	// buscando o usuário //
    	$objeto = Acompanhante::buscar($id);
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($objeto,'acompanhante');
    	// definindo a tela //
    	$this->setTela('foto',array('acompanhante'));
    }
}
?>