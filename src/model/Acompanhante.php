<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acompanhante
 *
 * @author kaykylopes
 */
class Acompanhante {
    private $id;
    private $nome;
    private $idade;
    private $altura;
    private $peso;
    private $busto;
    private $cintura;
    private $quadril;
    private $olhos;
    private $pernoite;
    private $atendo;
    private $especialidade;
    private $horario_atendimento;
    private $excluido;
    private $usuario_id;
    private $usuario_id_perfil;
    
    function __construct($id = 0, 
    		$nome = '', 
    		$idade = '', 
    		$altura = '', 
    		$peso = '', 
    		$busto = '', $cintura = '', $quadril = '', $olhos = '', $pernoite = '',
    	    $atendo = true, $especialidade = '' , $horario_atendimento = null, $excluido = 0, 
    		$usuario_id = null, $usuario_id_perfil = null) {
    	
        $this->id = $id;
        $this->nome = $nome;
        $this->idade = $idade;
        $this->altura = $altura;
        $this->peso = $peso; 
        $this->busto = $busto;
        $this->cintura = $cintura;
        $this->quadril = $quadril;
        $this->olhos = $olhos;
        $this->pernoite = $pernoite;
        $this->atendo = $atendo;
        $this->especialidade = $especialidade;
        $this->horario_atendimento = $horario_atendimento;
        $this->excluido = $excluido;
        $this->usuario_id = $usuario_id;
        $this->usuario_id_perfil = $usuario_id_perfil;
    }
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getBusto() {
        return $this->busto;
    }

    public function getCintura() {
        return $this->cintura;
    }

    public function getQuadril() {
        return $this->quadril;
    }

    public function getOlhos() {
        return $this->olhos;
    }

    public function getPernoite() {
        return $this->pernoite;
    }

    public function getAtendo() {
        return $this->atendo;
    }

    public function getEspecialidade() {
        return $this->especialidade;
    }

    public function getHorarioAtendimento() {
        return $this->horario_atendimento;
    }

    public function getExcluido() {
    	return $this->excluido;
    }
    
    public function getUsuarioId() {
        return $this->usuario_id;
    }

    public function getUsuarioIdPerfil() {
        return $this->usuario_id_perfil;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setIdade($idade) {
        $this->idade = $idade;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setBusto($busto) {
        $this->busto = $busto;
    }

    public function setCintura($cintura) {
        $this->cintura = $cintura;
    }

    public function setQuadril($quadril) {
        $this->quadril = $quadril;
    }

    public function setOlhos($olhos) {
        $this->olhos = $olhos;
    }

    public function setPernoite($pernoite) {
        $this->pernoite = $pernoite;
    }

    public function setAtendo($atendo) {
        $this->atendo = $atendo;
    }

    public function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
    }

    public function setHorarioAtendimento($horario_atendimento) {
        $this->horario_atendimento = $horario_atendimento;
    }

    public function setExcluido($excluido) {
    	$this->excluido = $excluido;
    }
    
    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function setUsuarioIdPerfil($usuario_id_perfil) {
        $this->usuario_id_perfil = $usuario_id_perfil;
    }


    /**
     * Metodo _validarCampos()
     * @return boolean
     */
    public function _validarCampos(){
    	if($this->getNome() == null){
    		throw new CamposObrigatorios();
    		return false;
    	}
    	else{
    		return true;
    	}
    }
    
    public function inserir(){
    	// validando os campos //
    	if(!$this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = AcompanhanteDAO::getInstancia();
    		// retornando o Usuario //
    		return  self::construirObjeto($instancia->inserir($this));
    	}
    	
    }
    
    public function editar(){
    	// validando os campos //
    	if(!$this->_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = AcompanhanteDAO::getInstancia();
    		// executando o metodo //
    		return self::construirObjeto($instancia->editar($this));
    	}
    		
    	
    }
    
    public function excluir(){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	$acompanhante = $instancia->excluir($this->getId());
    	// retornando o resultado //
    	return $acompanhante;
    }
    
    public static function listar($ordenarPor){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	$acompanhante = $instancia->listar($ordenarPor);
    	// checando se o retorno foi falso //
    	if(!$acompanhante)
    		// levantando a excessao ListaVazia //
    		throw new ListaVazia(ListaVazia::ACOMPANHANTES);
    	// percorrendo os usuarios //
    	foreach($acompanhante as $acompanhante){
    		// instanciando e jogando dentro da colecao $objetos o Usuario //
    		$objetos[] = self::construirObjeto($acompanhante);
    		
    	}
    	// retornando a colecao $objetos //
    	return $objetos;
    }
    
    public static function buscar($id){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	$acompanhante = $instancia->buscarPorId($id);
    	// checando se o resultado foi falso //
    	if(!$acompanhante)
    		// levanto a excessao RegistroNaoEncontrado //
    		throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ACOMPANHANTE);
    	// instanciando e retornando o Usuario //    	
    	return self::construirObjeto($acompanhante);
    }
    
    
    private function construirObjeto($dados){
		$acompanhante =	new Acompanhante();
		$acompanhante->setId(trim($dados['id']));
    	$acompanhante->setNome(trim($dados['nome']));
    	$acompanhante->setIdade(trim($dados['idade']));
    	$acompanhante->setAltura(trim($dados['altura']));
    	$acompanhante->setPeso(trim($dados['peso']));
    	$acompanhante->setBusto(trim($dados['busto']));
    	$acompanhante->setCintura(trim($dados['cintura']));
    	$acompanhante->setQuadril(trim($dados['quadril']));
    	$acompanhante->setOlhos(trim($dados['olhos']));
    	$acompanhante->setPernoite(trim($dados['pernoite']));
    	$acompanhante->setAtendo(trim($dados['atendo']));
    	$acompanhante->setEspecialidade(trim($dados['especialidade']));
    	$acompanhante->setHorarioAtendimento(trim($dados['horario_atendimento']));
    	$acompanhante->setExcluido(trim($dados['excluido']));
    	$acompanhante->setUsuarioId(trim($dados['usuarios_id']));
    	$acompanhante->setUsuarioIdPerfil(trim($dados['usuarios_id_perfil']));  	
    		
		return $acompanhante; 
    }
    
    
    /*PARA WEBSERVICE*/
    public static function listarParaWebService(){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	$acompanhantes = $instancia->listar("nome");
    	// checando se o retorno foi falso //
    	if(!$acompanhantes)
    		// levantando a excessao ListaVazia //
    		throw new ListaVazia(ListaVazia::ACOMPANHANTES);
    	return $acompanhantes;
    }
    
    public static function buscarParaWebService($id){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	$acompanhante = $instancia->buscarPorId($id);
    	// checando se o resultado foi falso //
    	if(!$acompanhante)
    		// levanto a excessao RegistroNaoEncontrado //
    		throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ACOMPANHANTE);
    	// instanciando e retornando o Usuario //
    	return $acompanhante;
    }
    /*PARA WEBSERVICE*/
    
    
}

?>