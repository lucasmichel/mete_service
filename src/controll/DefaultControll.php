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
        $this->setTela(($this->getUsuario()) ? 'home' : 'login');
        //$this->setTela(($this->getUsuario()) ? 'home' : 'loginTesteAndroid');
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

    /* PARA ANDROID */
    
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
    	
    	try {
    
    		$encoded = $this->descriptografarTexto($dados);
    
    		$usuario = new Usuario();
    		$acompanhante = new Acompanhante();
    		
    		$usuario->setId(trim($encoded->{'idUsuario'}));
    		$usuario->setLogin(trim($encoded->{'email'}));
    		$usuario->setSenha(trim($encoded->{'senha'}));
    		$usuario->setEmail(trim($encoded->{'email'}));
    
    		$acompanhante->setId(trim($encoded->{'id'}));
    		$acompanhante->setNome(trim($encoded->{'nome'}));
    		$acompanhante->setIdade(trim($encoded->{'idade'}));
    		$acompanhante->setAltura(trim($encoded->{'altura'}));
    		$acompanhante->setPeso(trim($encoded->{'peso'}));
    		$acompanhante->setBusto(trim($encoded->{'busto'}));
    		$acompanhante->setCintura(trim($encoded->{'cintura'}));
    		$acompanhante->setQuadril(trim($encoded->{'quadril'}));
    		$acompanhante->setOlhos(trim($encoded->{'olhos'}));
    		$acompanhante->setPernoite(trim($encoded->{'pernoite'}));
    		$acompanhante->setAtendo(trim($encoded->{'atendo'}));
    		$acompanhante->setEspecialidade(trim($encoded->{'especialidade'}));
    		$acompanhante->setHorarioAtendimento(trim($encoded->{'horario_atendimento'}));
    		
    		if($usuario->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($acompanhante->_validarCampos())
    			$insert = true;
    		else
    			$insert = false;
    		
    		if($insert == true){
    			$usuario = $usuario->editar();
    			$acompanhante = $acompanhante->editar();
    		}
    		
			
    		$arrayRetorno["dados"] = $usuario;
    		$arrayRetorno["status"] = 0;
    		$arrayRetorno["messagem"] = "Acompanhante editada com suceso";
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
    	
    	try {
    
    		$encoded = $this->descriptografarTexto($dados);
    
    		$perfil = Perfil::buscar(2);
			$usuario = new Usuario();
    		$cliente = new Cliente();
    		$usuario->setId(trim($encoded->{'idUsuario'}));
    		$usuario->setLogin(trim($encoded->{'email'}));
    		$usuario->setSenha(trim($encoded->{'senha'}));
    		$usuario->setEmail(trim($encoded->{'email'}));
    
    		$cliente->setId(trim($encoded->{'id'}));
    		$cliente->setCpf(trim($encoded->{'cpf'}));
    		$cliente->setNome(trim($encoded->{'nome'}));
    			
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
    		
    		$arrayRetorno["dados"] = $usuario;
			$arrayRetorno["status"] = 0;
    		$arrayRetorno["messagem"] = "Cliente editado com suceso";
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
    
    
    public function cadastrarUsuario() {
        if ($this->getDados('POST')) {
            $this->_cadastrarUsuario($this->getDados('POST'));
        }
        else{
	    $this->setTela('cadastrarUsuario');
            $this->getPage();
        }
    }
    
    
    private function _cadastrarUsuario($dados) {
        
        // O Curl irá fazer uma requisição para a API do Vimeo
        // e irá receber o JSON com as informações do vídeo.
        /*$curl = curl_init("http://leonardogalvao.com.br/teste/json.php");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $jsonCriptografado = curl_exec($curl);
        curl_close($curl);
        $encoded = json_decode(base64_decode( $jsonCriptografado));*/



        // As informações pode ser recuperadas da seguinte forma.
        // Resultado do echo: Forest aerials 5D 1080p KAHRS / 395 segundos
        //echo $encoded->{'login'} . " / " . $encoded->{'senha'} . " segundos";
        try {	    
            
            $encoded = $this->descriptografarTexto($dados);            
            $tipoUsuario = $encoded->{'tipo'};
            
            if(($tipoUsuario != 1)&&($tipoUsuario != 2)){
            	$arrayRetorno["dados"] = null;
                $arrayRetorno["status"] = 1;
                $arrayRetorno["messagem"] = 'tipo de usuario não definido ou definido errado';
                header('Cache-Control: no-cache, must-revalidate');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Content-type: application/json');
                $retorno = base64_encode(json_encode($arrayRetorno));
                echo $retorno;
            }            
            
            /*identifica o tipo 1 é cliente e 2 é prostituta*/
            if($tipoUsuario == 1){                
                
                $perfil = Perfil::buscar(2);
                $usuario = new Usuario();
                $cliente = new Cliente();
                
                $usuario->setPerfil($perfil);
                $usuario->setLogin(trim($encoded->{'email'}));
                $usuario->setSenha(trim($encoded->{'senha'}));
                $usuario->setEmail(trim($encoded->{'email'}));
                
                
                $cliente->setCpf(trim($encoded->{'cpf'}));
                $cliente->setNome(trim($encoded->{'nome'}));
                $cliente->setExcluido(0);
                
                
                
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
                $arrayRetorno["dados"] = $usuario;
                $arrayRetorno["status"] = 0;
                $arrayRetorno["messagem"] = "Cliente cadastrado com suceso";
                header('Cache-Control: no-cache, must-revalidate');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Content-type: application/json');
                $retorno = base64_encode(json_encode($arrayRetorno));
                echo $retorno;
                
            }
            /*identifica o tipo 1 é cliente e 2 é prostituta*/
            else if($tipoUsuario == 2){
                
                $perfil = Perfil::buscar(3);
                
                $usuario = new Usuario();
                $acompanhante = new Acompanhante();
                
                
                $usuario->setPerfil($perfil);
                $usuario->setLogin(trim($encoded->{'email'}));
                $usuario->setSenha(trim($encoded->{'senha'}));
                $usuario->setEmail(trim($encoded->{'email'}));
                
                $acompanhante->setNome(trim($encoded->{'nome'}));
                $acompanhante->setIdade(trim($encoded->{'idade'}));
                $acompanhante->setAltura(trim($encoded->{'altura'}));
                $acompanhante->setPeso(trim($encoded->{'peso'}));
                $acompanhante->setBusto(trim($encoded->{'busto'}));
                $acompanhante->setCintura(trim($encoded->{'cintura'}));
                $acompanhante->setQuadril(trim($encoded->{'quadril'}));
                $acompanhante->setOlhos(trim($encoded->{'olhos'}));
                $acompanhante->setPernoite(trim($encoded->{'pernoite'}));
                $acompanhante->setAtendo(trim($encoded->{'atendo'}));
                $acompanhante->setEspecialidade(trim($encoded->{'especialidade'}));
                $acompanhante->setHorarioAtendimento(trim($encoded->{'horario_atendimento'}));
                $acompanhante->setExcluido(0);
                
                
                if($usuario->_validarCampos())
                	$insert = true;
                else
                	$insert = false;
                
                if($acompanhante->_validarCampos())
                	$insert = true;
                else
                	$insert = false;
                
                if($insert == true){
                	$usuario = $usuario->inserir();
	                $acompanhante->setUsuarioId($usuario->getId());
	                $acompanhante->setUsuarioIdPerfil($usuario->getPerfil()->getId());
	                $acompanhante->inserir();
                }
                $arrayRetorno["dados"] = $usuario;
                $arrayRetorno["status"] = 0;
                $arrayRetorno["messagem"] = "Acompanhante cadastrada com suceso";
                header('Cache-Control: no-cache, must-revalidate');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Content-type: application/json');
                $retorno = base64_encode(json_encode($arrayRetorno));
                echo $retorno;
            }
            
            
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
        try {
            
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
    
    public function listarAcompanhante() {
     try {
            $arrayRetorno["dados"] = Acompanhante::listarParaWebService();
            $arrayRetorno["status"] = 0;
            $arrayRetorno["messagem"] = "OK";
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');
            $retorno = json_encode($arrayRetorno);
            echo $retorno;
            
            /*$retorno = base64_encode(json_encode($arrayRetorno));
            echo $retorno;*/
        } catch (Exception $e) {
        	$arrayRetorno["dados"] = null;
            $arrayRetorno["status"] = 1;
            $arrayRetorno["messagem"] = $e->getMessage();
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');
            $retorno = json_encode($arrayRetorno);
            echo $retorno;
            /*$retorno = base64_encode(json_encode($arrayRetorno));
	    	echo $retorno;*/
        }
    }
    
    public function listarUsuarios() {
    	try {
    		$arrayRetorno = Usuario::listarParaWebService();
    		$arrayRetorno["status"] = 0;
    		$arrayRetorno["messagem"] = "OK";
    
    		header('Cache-Control: no-cache, must-revalidate');
    		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    		header('Content-type: application/json');
    		$retorno = base64_encode(json_encode($arrayRetorno));
    		echo $retorno;
    	} catch (Exception $e) {
    		$arrayRetorno["status"] = 1;
    		$arrayRetorno["messagem"] = $e->getMessage();
    		header('Cache-Control: no-cache, must-revalidate');
    		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    		header('Content-type: application/json');
    		$retorno = base64_encode(json_encode($arrayRetorno));
    		echo $retorno;
    	}
    }
    
    public function listarServicos() {
    	try {
    		$arrayRetorno = Servico::listarParaWebService();
    		$arrayRetorno["status"] = 0;
    		$arrayRetorno["messagem"] = "OK";
    
    		header('Cache-Control: no-cache, must-revalidate');
    		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    		header('Content-type: application/json');
    		$retorno = base64_encode(json_encode($arrayRetorno));
    		echo $retorno;
    	} catch (Exception $e) {
    		$arrayRetorno["status"] = 1;
    		$arrayRetorno["messagem"] = $e->getMessage();
    		header('Cache-Control: no-cache, must-revalidate');
    		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    		header('Content-type: application/json');
    		$retorno = base64_encode(json_encode($arrayRetorno));
    		echo $retorno;
    	}
    }
    
}

?>
