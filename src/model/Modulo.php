<?php

/**
 * Classe Modulo
 * @package model
 */
class Modulo {

    /**
     * Atributos
     */
    private $id;
    private $nome;
    private $link;
    private $excluido;

    /**
     * Description of Acompanhante
     *
     * @author kaykylopes
     */
    
    /** 		
     * Metodo construtor()
     * @param $id
     * @param $nome
     * @return Modulo
     */
    public function __construct($id = 0, $nome = '', $link = '', $excluido = 0) {
        $this->id = $id;
        $this->nome = $nome;
        $this->link = $link;
        $this->excluido = $excluido;
    }
    
    /**
     * Metodo validar campos
     * @return 
     */
    private function _validarCampos(){
    	
    	$retorno = true;
    	
		if(($this->getNome() == '')||
        	($this->getLink() == '')){			
            throw new CamposObrigatorios();
            $retorno = false;
		}
		else if($this->getId() == 0){
        	if($this->_testarNomeExiste($this->getNome()))
        		throw new Exception("Nome do módulo já cadastrado em nossa base de dados");
        	
        	if($this->_testarLinkExiste($this->getLink()))
        		throw new Exception("Nome do link já cadastrado em nossa base de dados");
        	
        }
            
        else if($this->getId() != 0){
			if($this->_testarNomeExisteEdicao($this->getId(), $this->getNome()))            	
            	throw new Exception("Nome do módulo já cadastrado em nossa base de dados");
			if($this->_testarLinkExisteEdicao($this->getId(), $this->getLink()))
				throw new Exception("Nome do link já cadastrado em nossa base de dados");
			
		}
		else{
        	$retorno = true;
        }
        return $retorno; 
    }

    /**
     * Metodo listar()
     * @return Modulo[]
     */
    public static function listar() {
        $instancia = ModuloDAO::getInstancia();
        $modulos = $instancia->listar();
        if (!$modulos)
            throw new ListaVazia(ListaVazia::MODULOS);
        foreach ($modulos as $modulo) {
            $objetos[] = new Modulo($modulo['id'], $modulo['nome'], $modulo['link'], $modulo['excluido']);
        }
        return $objetos;
    }

    /**
     * Metodo buscar($id)
     * @param $id
     * @return Modulo
     */
    public static function buscar($id) {
        $instancia = ModuloDAO::getInstancia();
        $modulo = $instancia->buscar($id);        
        if (!$modulo)
            throw new RegistroNaoEncontrado(RegistroNaoEncontrado::MODULO);
        return new Modulo($modulo['id'], $modulo['nome'], $modulo['link'], $modulo['excluido']);
    }

    public function inserir(){
    	// validando os campos //
    	if($this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = ModuloDAO::getInstancia();
    		// executando o metodo //    		
    		$modulo = $instancia->inserir($this);
    		// retornando o Usuario //
    		return  $modulo;
    	}    	
    }
    
    public function editar(){
    	// validando os campos //
    	if($this->_validarCampos()){
	    	// recuperando a instancia da classe de acesso a dados //
	    	$instancia = ModuloDAO::getInstancia();
	    	// executando o metodo //
	    	$modulo = $instancia->editar($this);
	    	// retornando o Usuario //
	    	return  $modulo;
    	}
    }
    
    public function excluir(){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = ModuloDAO::getInstancia();
    	// executando o metodo //
    	$modulo = $instancia->excluir($this->getId());
    	// retornando o resultado //
    	return $modulo;
    }
    
    
    
    
    private static function _testarNomeExiste($nome){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = ModuloDAO::getInstancia();
    	// executando o metodo //
    	$modulo = $instancia->testarNomeExiste($nome);
    	// checando se o resultado foi falso //
    	if($modulo)
    		return true;
    	// instanciando e retornando o bollean//
    	else
    		return false;
    }
    
    private static function _testarLinkExiste($link){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = ModuloDAO::getInstancia();
    	// executando o metodo //
    	$modulo = $instancia->testarLinkExiste($link);
    	// checando se o resultado foi falso //
    	if($modulo)
    		return true;
    	// instanciando e retornando o bollean//
    	else
    		return false;
    }
    
    
    private static function _testarNomeExisteEdicao($id,$nome){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = ModuloDAO::getInstancia();
    	// executando o metodo //
    	$modulo = $instancia->testarNomeExisteEdicao($id, $nome);
    	// checando se o resultado foi falso //
    	if($modulo)
    		return true;
    	// instanciando e retornando o bollean//
    	else
    		return false;
    }
    
    private static function _testarLinkExisteEdicao($id, $link){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = ModuloDAO::getInstancia();
    	// executando o metodo //
    	$modulo = $instancia->testarLinkExisteEdicao($id, $link);
    	// checando se o resultado foi falso //
    	if($modulo)
    		return true;
    	// instanciando e retornando o bollean//
    	else
    		return false;
    }
    
    /**
     * Metodos getters() e setters()
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }
    public function getExcluido(){
    	return $this->excluido;
    }
    public function setExcluido($excluido){
    	$this->excluido = $excluido;
    }

}

?>