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
    private $horarioAtendimento;
    private $excluido;
    private $usuarioId;
    private $usuarioIdPerfil;
    
    function __construct($id = 0, 
    		$nome = '', 
    		$idade = '', 
    		$altura = '', 
    		$peso = '', 
    		$busto = '', $cintura = '', $quadril = '', $olhos = '', $pernoite = '',
    	    $atendo = true, $especialidade = '' , $horarioAtendimento = null, $excluido = 0, 
    		$usuarioId = null, $usuarioIdPerfil = null) {
    	
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
        $this->horarioAtendimento = $horarioAtendimento;
        $this->excluido = $excluido;
        $this->usuarioId = $usuarioId;
        $this->usuarioIdPerfil = $usuarioIdPerfil;
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
        return $this->horarioAtendimento;
    }

    public function getExcluido() {
    	return $this->excluido;
    }
    
    public function getUsuarioId() {
        return $this->usuarioId;
    }

    public function getUsuarioIdPerfil() {
        return $this->usuarioIdPerfil;
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

    public function setHorarioAtendimento($horarioAtendimento) {
        $this->horarioAtendimento = $horarioAtendimento;
    }

    public function setExcluido($excluido) {
    	$this->excluido = $excluido;
    }
    
    public function setUsuarioId($usuarioId) {
        $this->usuarioId = $usuarioId;
    }

    public function setUsuarioIdPerfil($usuarioIdPerfil) {
        $this->usuarioIdPerfil = $usuarioIdPerfil;
    }


    /**
     * Metodo _validarCampos()
     * @return boolean
     */
    public function _validarCampos(){
    	$retorno = true;
    	if($this->getNome() == null){
    		throw new CamposObrigatorios("Acompanhante");
    		$retorno = false;
    	}
    	else{
    		$retorno = true;
    	}
    	return $retorno;
    }
    
    public function inserir(){
    	// validando os campos //
    	if(self::_validarCampos()){
    		// recuperando a instancia da classe de acesso a dados //
    		$instancia = AcompanhanteDAO::getInstancia();
    		// retornando o Usuario //
    		return $instancia->inserir($this);
    	}
    	
    }
    
    public function editar(){
    	// validando os campos //
    	if(self::_validarCampos()){
            // recuperando a instancia da classe de acesso a dados //
            $instancia = AcompanhanteDAO::getInstancia();
            // executando o metodo //
            if($instancia->editar($this))
                return $this;
            else
                return null;
    	}
    }
    
    public function excluir(){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	
    	$usuario = Usuario::buscar($this->getUsuarioId());    	
    	$usuario = $usuario->excluir();    	
    	$acompanhante = $instancia->excluir($this->getId());
    	
    	// retornando o resultado //
    	return $acompanhante;
    }
    
    public function excluirPorIdUsuario(){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	
    	$usuario = Usuario::buscar($this->getUsuarioId());    	
    	$usuario = $usuario->excluir();    	
    	$acompanhante = $instancia->excluirPorIdUsuario($this->getUsuarioId());
    	
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
    
    
    
    public static function buscarPorIdUsuario($id){
    	// recuperando a instancia da classe de acesso a dados //
    	$instancia = AcompanhanteDAO::getInstancia();
    	// executando o metodo //
    	$acompanhante = $instancia->buscarPorIdUsuario($id);
    	// checando se o resultado foi falso //
    	if(!$acompanhante)
    		// levanto a excessao RegistroNaoEncontrado //
    		throw new RegistroNaoEncontrado(RegistroNaoEncontrado::ACOMPANHANTE);
    	// instanciando e retornando o Usuario //    	
    	return self::construirObjeto($acompanhante);
    }
    
    
    private static function construirObjeto($dados){
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
    	
    	foreach($acompanhantes as $acompanhante){
    		// instanciando e jogando dentro da colecao $objetos o Usuario //
    		
    		//$obj = self::construirObjeto($acompanhante);
                $da['id'] = $acompanhante['id'];
                $da['nome'] = $acompanhante['nome'];
                $da['idade'] = $acompanhante['idade'];
                $da['altura'] = $acompanhante['altura'];
                $da['peso'] = $acompanhante['peso'];
                $da['busto'] = $acompanhante['busto'];
                $da['cintura'] = $acompanhante['cintura'];
                $da['quadril'] = $acompanhante['quadril'];
                $da['olhos'] = $acompanhante['olhos'];
                $da['pernoite'] = $acompanhante['pernoite'];
                $da['atendo'] = $acompanhante['atendo'];
                $da['especialidade'] = $acompanhante['especialidade'];
                $da['horarioAtendimento'] = $acompanhante['horario_atendimento'];
                $da['excluido'] = $acompanhante['excluido'];
                $da['usuarioId'] = $acompanhante['usuarios_id'];
                $da['usuarioIdPerfil'] = $acompanhante['usuarios_id_perfil'];
            
    		$objetos[] = $acompanhante; 
    	
	}
    	return $objetos;
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
    	
    	
    	
    	return  $acompanhante;
    }
    
    public static function objetoParaArray(Acompanhante $acompanhante){
        $da['id'] = $acompanhante->getId();
        $da['nome'] = $acompanhante->getNome();
        $da['idade'] = $acompanhante->getIdade();
        $da['altura'] = $acompanhante->getAltura();
        $da['peso'] = $acompanhante->getPeso();
        $da['busto'] = $acompanhante->getBusto();
        $da['cintura'] = $acompanhante->getCintura();
        $da['quadril'] = $acompanhante->getQuadril();
        $da['olhos'] = $acompanhante->getOlhos();
        $da['pernoite'] = $acompanhante->getPernoite();
        $da['atendo'] = $acompanhante->getAtendo();
        $da['especialidade'] = $acompanhante->getEspecialidade();
        $da['horarioAtendimento'] = $acompanhante->getHorarioAtendimento();
        $da['excluido'] = $acompanhante->getExcluido();
        $da['usuarioId'] = $acompanhante->getUsuarioId();
        $da['usuarioIdPerfil'] = $acompanhante->getUsuarioIdPerfil();
                        
        return $da;
    }


    /*PARA WEBSERVICE*/
    
    
}

?>
