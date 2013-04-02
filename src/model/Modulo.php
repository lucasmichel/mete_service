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
    public function __construct($id = 0, $nome = '', $link = '') {
        $this->id = $id;
        $this->nome = $nome;
        $this->link = $link;
    }
    
    /**
     * Metodo validar campos
     * @return 
     */
    private function _validarCampos(){
    	if(($this->getNome() == '')||($this->getId() == null)||($this->getLink() == '')){
    		throw new CamposObrigatorios();
    		return false;
    	}
    	else{
    		return true;
    	}
    }

    /**
     * Metodo listar()
     * @return Modulo[]
     */
    public static function listar() {
        $instancia = ModuloDAO::getInstancia();
        $modulos = $instancia->listar();
        if (!$modulos)
            throw new ListaVazia(ListaVazia::MODULO);
        foreach ($modulos as $modulo) {
            $objetos[] = new Modulo($modulo['id'], $modulo['nome'], $modulo['link']);
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
        return new Modulo($modulo['id'], $modulo['nome'], $modulo['link']);
    }

    public function inserir(){
    	// validando os campos //
    	if($this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = ModuloDAO::getInstancia();
    		// executando o metodo //
    		$modulo = $instancia->inserir($this);
    		// retornando o Usuario //
    		return  $modulo = $instancia->inserir($this);
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
	    	return  $modulo = $instancia->editar($this);
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

}

?>