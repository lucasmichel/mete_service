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
        $encoded = json_decode(base64_decode( $jsonCriptografado));

	echo '<pre>';
	var_dump($encoded);
	die();*/
	
	/*
        $jsonCriptografado = $dados['textoCriptografado'];
        
        $jsonDescriptografado = base64_decode($jsonCriptografado);
        $encoded = json_decode($jsonDescriptografado);*/



	/*echo '<pre>';
	var_dump($encoded);
	die();*/


        // As informações pode ser recuperadas da seguinte forma.
        // Resultado do echo: Forest aerials 5D 1080p KAHRS / 395 segundos
        //echo $encoded->{'login'} . " / " . $encoded->{'senha'} . " segundos";
        try {

	    /*$jsonCriptografado = $dados['textoCriptografado'];        
            $jsonDescriptografado = base64_decode($jsonCriptografado);
            $encoded = json_decode($jsonDescriptografado);*/
            
            $encoded = $this->descriptografarTexto($dados);            
            $tipoUsuario = $encoded->{'tipo'};
            
            if(($tipoUsuario != 1)&&($tipoUsuario != 2)){
                throw new Exception ('tipo de usuario não definido ou definido errado');
            }            
            
            /*identifica o tipo 1 é cliente e 2 é prostituta*/
            if($tipoUsuario == 1){                
                
                $perfil = Perfil::buscar($tipoUsuario);
                $usuario = new Usuario(0,$perfil,$encoded->{'login'}, $encoded->{'senha'},$encoded->{'login'});
                $usuario = $usuario->inserir();
                $arrayRetorno["status"] = 0;
                $arrayRetorno["messagem"] = "Usuário Cadastrado com suceso";
                header('Cache-Control: no-cache, must-revalidate');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Content-type: application/json');
                $retorno = base64_encode(json_encode($arrayRetorno));
                echo $retorno;
                
            }
            /*identifica o tipo 1 é cliente e 2 é prostituta*/
            else if($tipoUsuario == 2){
                
                $perfil = Perfil::buscar($tipoUsuario);
                $usuario = new Usuario(0,$perfil,$encoded->{'login'}, $encoded->{'senha'},$encoded->{'login'});
                $usuario = $usuario->inserir();
                $arrayRetorno["status"] = 0;
                $arrayRetorno["messagem"] = "Usuário Cadastrado com suceso";
                header('Cache-Control: no-cache, must-revalidate');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Content-type: application/json');
                $retorno = base64_encode(json_encode($arrayRetorno));
                echo $retorno;
                
            }
            
            
            
            
            
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
            
            $arrayRetorno = Usuario::logarAndroid($dados['email'], $dados['senha']);
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
