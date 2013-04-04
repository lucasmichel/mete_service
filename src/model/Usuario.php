<?php
/**
 * Classe Usuario
 * @package model
 */
class Usuario {

    /**
     * Atributos
     */		
    private $id;
    private $perfil;
    private $login;
    private $senha;
    private $email;
    private $dataUltimoLogin;
    private $excluido;


    /**
     * Metodo construtor()
     * @param $id
     * @param $perfil
     * @param $login
     * @param $senha
     * @return Usuario
     */		
    public function __construct($id = 0,
            Perfil $perfil = null,
            $login = '',
            $senha = null,
            $email = '',
            $dataUltimoLogin = null, 
            $excluido = 0){
       
            $this->id = $id;
            $this->perfil = $perfil;
            $this->login = $login;
            $this->senha = $senha;
            $this->email = $email;
            $this->dataUltimoLogin = $dataUltimoLogin;
            $this->excluido = $excluido;
    }

    /**
     * Metodo _validarCampos()
     * @return boolean
     */
    public function _validarCampos(){
		if(($this->getPerfil() == null)||
        	($this->getLogin() == '')||
            ($this->getEmail() == '')||
            ($this->getSenha() == null)){			
            throw new CamposObrigatorios();
            return false;
		}
        else if($this->_testarEmailExiste($this->getEmail())){
        	throw new Exception("Email já cadastrado en nossa base de dados");
        }
            
        else if($this->getId() != 0){
			if($this->_testarEmailExisteEdicao($this->getId(), $this->getEmail())){
            	// levanto a excessao//
            	throw new Exception("Email já cadastrado en nossa base de dados");
			}
		}
		else{
        	return true;
        }
    }

    /**
     * Metodo inserir()
     * @return Usuario
     */
    public function inserir(){
        // validando os campos //
        if($this->_validarCampos())
        {
        	// recuperando a instancia da classe de acesso a dados //
            $instancia = UsuarioDAO::getInstancia();
            // executando o metodo //
            $usuario = $instancia->inserir($this);
            // retornando o Usuario //
            return $usuario;
		}
				            
    }

    /**
     * Metodo editar()
     * @return Usuario
     */
    public function editar(){
		// validando os campos //
        if($this->_validarCampos()){
        	// recuperando a instancia da classe de acesso a dados //
            $instancia = UsuarioDAO::getInstancia();
            // executando o metodo //
            $usuario = $instancia->editar($this);
            // retornando o Usuario //
            return $usuario;
		}
    }

    /**
     * Metodo excluir()
     * @return boolean
     */
    public function excluir(){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = UsuarioDAO::getInstancia();
            // executando o metodo //
            $usuario = $instancia->excluir($this->getId());
            // retornando o resultado //
            return $usuario;
    }

    /**
     * Metodo listar()
     * @return Usuario[]
     */
    public static function listar($ordenarPor){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = UsuarioDAO::getInstancia();
            // executando o metodo //
            $usuarios = $instancia->listar($ordenarPor);
            // checando se o retorno foi falso //
            if(!$usuarios)
                    // levantando a excessao ListaVazia //
                    throw new ListaVazia(ListaVazia::USUARIOS);
            // percorrendo os usuarios //
            foreach($usuarios as $usuario){
                    // instanciando e jogando dentro da colecao $objetos o Usuario //
                    $objetos[] = new Usuario($usuario['id'],
                            Perfil::buscar($usuario['id_perfil']),
                            $usuario['login'],
                            NULL,
                            $usuario['email'],
                            $usuario['dataUltimoLogin'],
                            $usuario['excluido']
                            );
            }
            // retornando a colecao $objetos //
            return $objetos;
    }

    /**
     * Metodo logar($login,$senha)
     * @param $login
     * @param $senha
     * @return Usuario
     */
    public static function logar($login,$senha){
            // verificando se $login ou $senha estao vazios //
            if((empty($login))||(empty($senha)))
                    // levantando a excessao CamposObrigatorios //
                    throw new CamposObrigatorios();
            // recuperando a instancia da classe de acesso a dados //
            $instancia = UsuarioDAO::getInstancia();
            // executando o metodo //
            $usuario = $instancia->logar($login,$senha);            
            // checando se o retorno foi falso //
            if(!$usuario)
                    // levantando a excessao LoginInvalido //
                    throw new LoginInvalido();
            // retornando o Usuario //
            
            $user = new Usuario($usuario['id'],
                            Perfil::buscar($usuario['id_perfil']),
                            $usuario['login'],
                            NULL,
                            $usuario['email'],
                            $usuario['dataUltimoLogin'],
                            $usuario['excluido']
                            );
            /*grava a hora do login*/
            $instancia->gravarDataHoraLogin($user->getId());
            return $user;
    }

    /**
     * Metodo buscar($id)
     * @param $id
     * @return Usuario
     */
    public static function buscar($id){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = UsuarioDAO::getInstancia();
            // executando o metodo //
            $usuario = $instancia->buscarPorId($id);
            // checando se o resultado foi falso //
            if(!$usuario)
                    // levanto a excessao RegistroNaoEncontrado //
                    throw new RegistroNaoEncontrado(RegistroNaoEncontrado::USUARIO);
            // instanciando e retornando o Usuario //
            
            $a = new Usuario($usuario['id'],
                            Perfil::buscar($usuario['id_perfil']),
                            $usuario['login'],
                            NULL,
                            $usuario['email'],
                            $usuario['dataUltimoLogin'],
                            $usuario['excluido']);    
            return $a;
    }

    public function trocarSenha($senhaAtual,$novaSenha){
            if((empty($senhaAtual))||(empty($novaSenha)))
                    throw new CamposObrigatorios();
            $instancia = UsuarioDAO::getInstancia();
            $usuario = $instancia->trocarSenha($this->getId(),$senhaAtual,$novaSenha);
            return $usuario;
    }
    
    
    public static function logarAndroid($login,$senha){        
            if((empty($login))||(empty($senha)))                    
                    throw new CamposObrigatorios();            
            $instancia = UsuarioDAO::getInstancia();            
            $usuario = $instancia->logar($login,$senha);            
            if(!$usuario)            
                    throw new LoginInvalido();            
            /*grava a hora do login*/
            $instancia->gravarDataHoraLogin($usuario['id']);            
            return $usuario;
    }
    
    
    
    
    
    /**
     * Metodo testarEmailExiste($email)
     * @param $email
     * @return Usuario
     */
    private static function _testarEmailExiste($email){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = UsuarioDAO::getInstancia();
    	// executando o metodo //
    	$usuario = $instancia->testarEmailExiste($email);
    	// checando se o resultado foi falso //
    	if($usuario)
	    	return true;
    	// instanciando e retornando o bollean//
    	else
			return false;
    }
    
    
    /**
     * Metodo testarEmailExiste($email)
     * @param $email
     * @return Usuario
     */
    private static function _testarEmailExisteEdicao($id, $email){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = UsuarioDAO::getInstancia();
    	// executando o metodo //
    	$usuario = $instancia->testarEmailExisteEdicao($id, $email);
    	// checando se o resultado foi falso //
    	if($usuario)
    		return true;
    	// instanciando e retornando o bollean//
    	else
    		return false;
    }
    
    
    /**
     * Metodos getters() e setters()
     */
    public function getId(){
            return $this->id;
    }
    public function setId($id){
            $this->id = $id;
    }
    public function getPerfil(){
            return $this->perfil;
    }
    public function setPerfil(Perfil $perfil){
            $this->perfil = $perfil;
    }
    public function getLogin(){
            return $this->login;
    }
    public function setLogin($login){
            $this->login = $login;
    }
    public function getSenha(){
            return $this->senha;
    }
    public function setSenha($senha){
            $this->senha = $senha;
    }

    public function getEmail(){
            return $this->email;
    }
    public function setEmail($email){
            $this->email = $email;
    }

    public function getDataUltimoLogin(){
            return $this->dataUltimoLogin;
    }
    /*não vai existir pois so quem pode setar datadologine é camada de dados
     public function setDataUltimoLogin($dataUltimoLogin){
            $this->dataUltimoLogin = $dataUltimoLogin;
    }*/
    
    
    
    
    /*PARA WEBSERVICE*/
    
    public static function listarParaWebService(){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = UsuarioDAO::getInstancia();
    	// executando o metodo //
    	$usuarios = $instancia->listar("email");
    	// checando se o retorno foi falso //
    	if(!$usuarios)
    		// levantando a excessao ListaVazia //
    		throw new ListaVazia(ListaVazia::USUARIOS);
    	
    	return $usuarios;
    }
    
    /*PARA WEBSERVICE*/
}
?>