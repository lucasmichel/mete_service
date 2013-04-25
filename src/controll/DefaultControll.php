<?php

/**
 * Classe DefaultControll
 * Controlador default da aplicação
 * @package controll
 */
class DefaultControll extends Controll {

    /**
     * Acao index()
     */
    public function index() {
        //$this->setTela(($this->getUsuario()) ? 'home' : 'login');
        $this->setTela(($this->getUsuario()) ? 'home' : 'loginTesteAndroid');
        $this->getPage();
    }

    /**
     * Acao logar()
     * Verifica se foram passados os dados do formulário POST
     */
    public function logar() {
        parent::getUsuario() ? $this->setTela('home') : ($this->getDados('POST') ? $this->_logar($this->getDados('POST')) : $this->setTela('login'));
    }

    /**
     * Metodo _logar($dados)
     * Persiste em logar o usuário com os dados passados por parametro no formulário
     * @param $dados
     */
    private function _logar($dados) {
        /**
         * Persistindo em logar
         */
        try {        	
            $usuario = Usuario::logar($dados['login'], $dados['senha']);   
            
            //guardando o usuário no controlador            
            $this->setUsuario($usuario);
            //recuperando se houver alguma url guardada
            $urlRecover = $this->getUrlRecover();
            //redirecionando
            header("Location: " . (($urlRecover) ? $urlRecover : 'index'));
        }

        /**
         * Capturando a excessão CamposObrigatorios
         */ catch (CamposObrigatorios $e) {
            $this->setFlash($e->getMessage());
            $this->setTela('login');
        }

        /**
         * Capturando a excessão LoginInvalido
         */ catch (LoginInvalido $e) {
            $this->setFlash($e->getMessage());
            $this->setTela('login');
        }
    }

    /**
     * Acao logout()
     * Destroi a sessão e redireciona para a tela default de login
     */
    public function logout() {
        session_destroy();
        header("Location: index");
    }

    public function voltar() {
        $this->setPage();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* PARA ANDROID *//* PARA ANDROID */
    /* PARA ANDROID *//* PARA ANDROID */
    
    
    
    
    
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    public function cadastrarAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_cadastrarAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('cadastrarUsuario');
    		$this->getPage();
    	}
    }
    
    private function _cadastrarAcompanhante($dados) {
    	$executa = new WebServiceControll();
    	$executa->_cadastrarAcompanhante($dados);
    }
    
    public function editarAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_editarAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _editarAcompanhante($dados) {
    	$executa = new WebServiceControll();
    	$executa->_editarAcompanhante($dados);
    }

    public function excluirAcompanhante() {
    	if ($this->getDados('POST')) {
    		$this->_excluirAcompanhante($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _excluirAcompanhante($dados) {
    	$executa = new WebServiceControll();
    	$executa->_excluirAcompanhante($dados);
    }
    
    public function buscarAcompanhantePorId() {
    	if ($this->getDados('POST')) {
    		$this->_buscarAcompanhantePorId($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarAcompanhante');
    		$this->getPage();
    	}
    }
    
    private function _buscarAcompanhantePorId($dados) {
    	$executa = new WebServiceControll();
    	$executa->_buscarAcompanhantePorId($dados);
    }
    
    public function listarAcompanhante() {
    	$executa = new WebServiceControll();
    	$executa->listarAcompanhante();
    }    
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    /******ACOMPANHANTE******/
    
    /******CLIENTE******/
    /******CLIENTE******/
    /******CLIENTE******/
    public function cadastrarCliente() {
    	if ($this->getDados('POST')) {
    		$this->_cadastrarCliente($this->getDados('POST'));
    	}
    	else{
    		meuVarDump($this->getDados('POST'));
    		//$this->setTela('cadastrarUsuario');
    		//
    	}
    }
    
    private function _cadastrarCliente($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_cadastrarCliente($dados);
    	 
    }
    
    public function editarCliente() {
    	if ($this->getDados('POST')) {
    		$this->_editarCliente($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('editarCliente');
    		$this->getPage();
    	}
    }
    
    private function _editarCliente($dados) {
    	
    	$executa = new WebServiceControll();
    	$executa->_editarCliente($dados);
    	
    }
    
    public function excluirCliente() {
    	if ($this->getDados('POST')) {
    		$this->_excluirCliente($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('excluirUsuario');
    		$this->getPage();
    	}
    }
    
    
    private function _excluirCliente($dados) {
    
    	$executa = new WebServiceControll();
    	$executa->_excluirCliente($dados);
    
    }
    /******CLIENTE******/
    /******CLIENTE******/
    /******CLIENTE******/
    
    /******FOTO******/
    /******FOTO******/
    /******FOTO******/
    public function cadastrarFoto() {    	
    	if ($this->getDados('POST')) {
    		$this->_cadastrarFoto($this->getDados('POST'));
    	}
    	else{
    		$this->setTela('cadastrarFoto');
    		$this->getPage();
    	}
    	
    }
    
   	private function _cadastrarFoto($dados) {
    	
   		$executa = new WebServiceControll();
   		$executa->_cadastrarFoto($dados);
    	
    }
    /******FOTO******/
    /******FOTO******/
    /******FOTO******/
    
    
    /******SERVIÇO******/
    /******SERVIÇO******/
    /******SERVIÇO******/ 
    public function listarServicos() {
    	$executa = new WebServiceControll();
    	$executa->listarServicos();
    }
    /******SERVIÇO******/
    /******SERVIÇO******/
    /******SERVIÇO******/
    
    
    

    public function logarAndroid() {
        if ($this->getDados('POST')) {
            $this->_logarAndroid($this->getDados('POST'));
        }
        else{
            
            $this->setTela('loginTesteAndroid');
            $this->getPage();
		}
    }

    private function _logarAndroid($dados) {
    	
    	/*
    	PARA TESTE
    	meuVarDump($dados);    	
    	 
    	$usuarioinsercao[] = $dados;   	
    	 
    	$arrayRetorno["dados"] = $usuarioinsercao;
    	$arrayRetorno["status"] = 0;
    	$arrayRetorno["mensagem"] = 'ok';
    	 
    	meuVarDump(json_encode($arrayRetorno));
    	meuVarDump(base64_encode(json_encode($arrayRetorno)));
    	 
    	$dadosTransferir = base64_encode(json_encode($arrayRetorno));
    	 
    	$dadosenvio['textoCriptografado'] = $dadosTransferir;
    	 
    	meuVarDump($dadosTransferir);
    	 
    	$executa = new WebServiceControll();
    	$executa->_logarAndroid($dadosenvio);
    	PARA TESTE
    	*/
    	$executa = new WebServiceControll();
    	$executa->_logarAndroid($dados);
    }
    











	
    
    
    
    
    
    
    
    /*APAGAR DEPOIS*/
    public function testeNovaEstruturaDados() {
    	try {
    
    
    		//$this->getDados('POST')
    
    		// O Curl irá fazer uma requisição para a API do Vimeo
    		// e irá receber o JSON com as informações do vídeo.
    		$curl = curl_init("http://leonardogalvao.com.br/teste/json.php");
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    		$jsonCriptografado = curl_exec($curl);
    		curl_close($curl);
    		
    		//$encoded = json_decode(base64_decode( $jsonCriptografado));
    		$encoded = json_decode($jsonCriptografado);
    		
    		meuVarDump($encoded);
    		
    		
    		//$encoded = base64_decode($jsonCriptografado);
    
    		meuVarDump($encoded);
    
    		// As informações pode ser recuperadas da seguinte forma.
    		// Resultado do echo: Forest aerials 5D 1080p KAHRS / 395 segundos
    		//echo $encoded->{'login'} . " / " . $encoded->{'senha'} . " segundos";
    
    		$jsonCriptografado = $dados['textoCriptografado'];
    		$jsonDescriptografado = base64_decode($jsonCriptografado);
    		$encoded = json_decode($jsonDescriptografado);
    
    		$arrayRetorno["dados"] = Usuario::logarAndroid(trim($encoded->{'email'}), trim($encoded->{'senha'}));
    		$arrayRetorno["status"] = 0;
    		$arrayRetorno["messagem"] = "OK";
    		header('Cache-Control: no-cache, must-revalidate');
    		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    		header('Content-type: application/json');
    		$retorno = base64_encode(json_encode($arrayRetorno));
    		echo $retorno;
    	} catch (Exception $e) {
    		$arrayRetorno["dados"] = null;
    		$arrayRetorno["status"] = 1;
    		$arrayRetorno["messagem"] = $e->getMessage();
    		header('Cache-Control: no-cache, must-revalidate');
    		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    		header('Content-type: application/json');
    		$retorno = base64_encode(json_encode($arrayRetorno));
    		echo $retorno;
    	}
    }
    /*APAGAR DEPOIS*/
    
}

?>