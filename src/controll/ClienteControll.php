<?php
/**
 * Classe ClienteControll
 * Controlador do modulo de usuários
 * @package controll
 */
class ClienteControll extends Controll {

    /**
     * Constante referente ao número do modulo serve para o controle de acesso
     */
    const MODULO = 4;

    /**
     * Acao index()
     */
    public function index(){
        // código da ação serve para o controle de acesso//
        static $acao = 1;
        // definindo a tela //
        $this->setTela('listar',array('cliente'));
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
        $objeto = Cliente::buscar($id);
        // jogando o usuário no atributo $dados do controlador //
        $this->setDados($objeto,'cliente');
        // definindo a tela //
        $this->setTela('ver',array('cliente'));
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
            $this->setTela('add',array('cliente'));
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
    		
    		/*2 por padrão é o perfil do cliente*/
    		$perfil = Perfil::buscar(2);
    		$usuario = new Usuario();
    		$cliente = new Cliente();
    		
    		
    		$usuario->setPerfil($perfil);
    		$usuario->setLogin(trim($dados['email']));
    		$usuario->setSenha(trim($dados['senha']));
    		$usuario->setEmail(trim($dados['email']));
    		
    		
    		$cliente->setCpf(trim($dados['cpf']));
    		$cliente->setNome(trim($dados['nome']));
    		
    		
    		if($usuario->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($cliente->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($insert == true){
    			$usuario = $usuario->inserir();
    			$cliente->setUsuarioId($usuario->getId());
    			$cliente->setUsuarioIdPerfil($usuario->getPerfil()->getId());
    			$cliente = $cliente->inserir();
    		}
    		
            // setando a mensagem de sucesso //
            $this->setFlash('Cliente cadastrado com sucesso.');
            // setando a url //
            $this->setPage();
        }        
        catch (Exception $e) {
            //retorna os campos prar serem preenchidos novamente
            if(isset($cliente))
            	$this->setDados($cliente,'cliente');
            
            if(isset($usuario))
            	$this->setDados($usuario,'usuario');
            // setando a mensagem de excessão //
            $this->setFlash($e->getMessage());
            // definindo a tela //
            $this->setTela('add',array('cliente'));
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
        $objeto = Cliente::buscar($id);
        // checando se o formulário nao foi passado //
        if(!$this->getDados('POST')){
            // Jogando perfil no atributo $dados do controlador //
            $this->setDados($objeto,'cliente');
            // Definindo a tela //
            $this->setTela('editar',array('cliente'));
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
        	
        	$usuario = Usuario::buscar(trim($dados['idUsuario'])); 
        	$cliente = Cliente::buscar(trim($dados['idCliente']));
        	
        	$usuario->setId(trim($dados['idUsuario']));
        	$usuario->setLogin(trim($dados['email']));
        	$usuario->setSenha(trim($dados['senha']));
        	$usuario->setEmail(trim($dados['email']));
        	
        	$cliente->setId(trim($dados['idCliente']));
        	$cliente->setCpf(trim($dados['cpf']));
        	$cliente->setNome(trim($dados['nome']));
        	
        	if($usuario->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($cliente->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($insert == true){
    			$usuario = $usuario->editar();
    			$cliente = $cliente->editar();
    		}
        	    
            $this->setFlash('Cliente editado com sucesso');
			$this->setPage();
        }
        catch (Exception $e) {
            //retorna os campos prar serem preenchidos novamente
            if(isset($cliente))
            	$this->setDados($cliente,'cliente');
            
            if(isset($usuario))
            	$this->setDados($usuario,'usuario');
            // setando a mensagem de excessão //
            $this->setFlash($e->getMessage());
            // definindo a tela //
            $this->setTela('editar',array('cliente'));
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
        $objeto = Cliente::buscar($id);
        // checando se o usuário a ser excluído é diferente do logado //
        
        // excluíndo ele //
        $objeto->excluir();
        // setando mensagem de sucesso //
        $this->setFlash('Cliente excluído com sucesso.');
        
        // setando a url //
        $this->setPage();
    }
}
?>