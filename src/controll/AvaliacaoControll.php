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
        $this->setTela('listar',array('acompanhante'));
        // guardando a url //
        $this->getPage();
    }
    
    
    
    public function visualizarAvaliacao($idAcompanhnate){
    	//meuVarDump($acao);
    	// código da ação serve para o controle de acesso//
    	static $acao = 1;
    	// buscando o usuário //
    	$objeto = Avaliacao::buscar($idAcompanhnate);
    	// jogando o usuário no atributo $dados do controlador //
    	$this->setDados($objeto,'avaliacao');
    	// definindo a tela //
    	$this->setTela('listar',array('avaliacao'));
    }

    /**
     * Acao ver($id)
     * @param $id
     */
    public function ver($id){
        // código da ação serve para o controle de acesso//
        static $acao = 1;
        // buscando o usuário //
        $objeto = Acompanhante::buscar($id);
        // jogando o usuário no atributo $dados do controlador //
        $this->setDados($objeto,'acompanhante');
        // definindo a tela //
        $this->setTela('ver',array('acompanhante'));
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
            $this->setTela('add',array('acompanhante'));
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
    		
	        // instanciando o novo Usuário //
	        $usuario = new Usuario(0,
        		/*2 por padrão é o perfil da garota*/
        		Perfil::buscar(2),
        		trim($dados['email']),
        		trim($dados['senha']),
        		trim($dados['email']));
        
	        
	        $acompanhante = new Acompanhante(0,
	        		trim($dados['nome']),
	        		trim($dados['idade']),
	        		trim($dados['altura']),
	        		trim($dados['peso']),
	        		trim($dados['busto']),
	        		trim($dados['cintura']),
	        		trim($dados['quadril']),
	        		trim($dados['olhos']),
	        		trim($dados['pernoite']),
	        		trim($dados['atendo']),
	        		trim($dados['especialidade']),
	        		trim($dados['horarioAtendimento']),
	        		null,
	        		null,
	        		null);	        
	        
	        
            $usuario->inserir();            
            /*agora set o id du usuario na acompanhante*/
            $acompanhante->setUsuarioId($usuario->getId());
            $acompanhante->setUsuarioIdPerfil($usuario->getPerfil()->getId());
                        
            $acompanhante->inserir();
            
            // setando a mensagem de sucesso //
            $this->setFlash('Acompanhante cadastrada com sucesso.');
            // setando a url //
            $this->setPage();
        }        
        catch (Exception $e) {
            //retorna os campos prar serem preenchidos novamente
            if(isset($acompanhante))
            	$this->setDados($acompanhante,'acompanhante');
            
            if(isset($usuario))
            	$this->setDados($usuario,'usuario');
            // setando a mensagem de excessão //
            $this->setFlash($e->getMessage());
            // definindo a tela //
            $this->setTela('add',array('acompanhante'));
        }
    }

    /**
     * Acao editar($id)
     * @param $id
     */
    public function editar($id){
    	//meuVarDump("testeee");
        // código da ação //
        static $acao = 3; 
    	// checando se o formulário nao foi passado //
    	if(!$this->getDados('POST')){
    		// Buscando o usuário //
    		$objeto = Acompanhante::buscar($id);
    		// Jogando perfil no atributo $dados do controlador //
    		$this->setDados($objeto,'acompanhante');
    		// Definindo a tela //
    		$this->setTela('editar',array('avaliacao/editar'));
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
    		
	       $avaliacao = new Avaliacao();
    		//meuVarDump($dados['nota']);
    		$avaliacao->setNota($dados['nota']);
    		//$avaliacao->getClienteId($dados['clienteId']);
    		$avaliacao->setAcompanhanteId($id);
    		$comentario = $comentario->alterar();
    		//$comentariooAcompanhanteId = $comentario->getId();
    		//$comentario->inserir();
    		// setando a mensagem de sucesso //
    		$this->setFlash('Avaliacao Alterado com sucesso.');
    		// setando a url //
    		$this->setPage();
        }        
        catch (Exception $e) {
            //retorna os campos prar serem preenchidos novamente
            if(isset($acompanhante))
            	$this->setDados($acompanhante,'acompanhante');
            
            if(isset($usuario))
            	$this->setDados($usuario,'usuario');
            // setando a mensagem de excessão //
            $this->setFlash($e->getMessage());
            // definindo a tela //
            $this->setTela('editar',array('acompanhante'));
        }
    }

    /**
     * Acao excluir($id)
     * @param $id
     */
    public function excluir($id){
        // código da ação //
    	//meuVarDump("testeee");
        static $acao = 4;
        // buscando o usuário //			
        $objeto = Avaliacao::buscar($id);
        
        // excluíndo ele //
        $objeto->excluir();
        // setando mensagem de sucesso //
		$this->setFlash('Avaliacao excluída com sucesso.');
        
        
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